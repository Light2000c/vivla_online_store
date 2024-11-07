<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Mail\InfoMail;
use App\Mail\PaymentMail;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Price;
use App\Models\Size;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Stripe\Exception\CardException;
use Stripe\StripeClient;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class StripeController extends Controller
{
    public $stripe;
    public $reference;
    public $shipping;
    public $tax;

    public function __construct()
    {
        $this->stripe = new StripeClient(config('stripe.sk'));

        $this->shipping = Price::where("name", "shipping")->first();
        $this->tax = Price::where("name", "tax")->first();
    }


    public function checkout(Request $request)
    {
        $request->validate([
            'fullName' => 'required',
            'amount' => 'required|numeric',
        ]);

        $total_amount = $request->amount + $this->shipping->price + $this->getTax($request->amount);

        try {
            $session = $this->stripe->checkout->sessions->create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => 'Purchase from Vivla Closet',
                        ],
                        // 'unit_amount' => $request->amount * 100,
                        'unit_amount' => intval($total_amount * 100),
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                // 'customer_email' => Auth::user()->email,
                'success_url' => route('checkout.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('checkout.cancel'),
            ]);

            return redirect($session->url);
        } catch (\Exception $e) {
            // dd($e->getMessage())
            // return back()->with('error', 'Failed to create Stripe Checkout session: ' . $e->getMessage());
            return back()->with('error', 'Something went wrong while trying to checkout, please try again');
        }
    }




    public function success(Request $request)
    {
        $sessionId = $request->query('session_id');

        try {

            $session =  $this->stripe->checkout->sessions->retrieve($sessionId);

            // dd($session);

            if ($session->payment_status == 'paid') {

                $this->saveTransaction($session);

                $reference = $this->reference ? $this->reference : "";

                $date = now()->format('Y-m-d H:i:s');

                $amount = $session->amount_total / 100;

                $details = [
                    "name" => Auth::user()->name,
                    "email" => Auth::user()->email,
                    "order_number" => $reference,
                    "order_date" => $date,
                    "total_amount" => $amount

                ];

                try {

                    Mail::to(Auth::user()->email)->send(new PaymentMail($details));

                    Mail::to("sales@vivlavivcloset.com")->send(new InfoMail($details));
                } catch (\Exception $e) {
                    return $this->error();
                }

                return view('payment.paymentsuccess', ['session' => $session, 'reference' => $reference]);
            } else {
                return $this->error();
            }
        } catch (\Exception $e) {
            return $this->error();
        }
    }

    public function error()
    {
        return view('payment.paymenterror');
    }



    public function cancel()
    {
        return redirect()->route("checkout");
    }



    public function savePayment($data)
    {
        $amount = $data->amount_total / 100;

        try {
            $payment = request()->user()->payment()->create([
                "amount" => $amount,
                "currency" => $data->currency
            ]);

            if (!$payment) {
                return false;
            }

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }




    public function saveTransaction($session)
    {
        DB::beginTransaction(); // Begin a transaction

        try {

            $random_number = $this->generateReference();

            // $address = auth::user()->address()->where("active", 1)->first();
            // if (!$address) {
            //     return $this->error();
            // }

            if (!$this->savePayment($session)) {
                DB::rollBack();
                return $this->error();
            }

            $transaction = request()->user()->transaction()->create([
                "reference" => $random_number,
                // "address_id" => $address->id
            ]);

            $this->reference = $random_number;

            if (!$transaction) {
                return $this->error();
            }

            $transactionId = $transaction->id;


            DB::table('carts')->where('user_id', Auth::id())->orderBy('id')->chunk(1000, function ($carts) use ($transactionId) {
                $orders = $carts->map(function ($item) use ($transactionId) {
                    $productPrice = DB::table('products')
                        ->where('id', $item->product_id)
                        ->value('price');

                    $productDiscount = DB::table('products')
                        ->where('id', $item->product_id)
                        ->value('discount');



                    if ($productDiscount) {
                        $total = $item->quantity * ($productPrice - (($productPrice * $productDiscount) / 100));
                    } else {
                        $total = $productPrice * $item->quantity;
                    }

                    return [
                        'user_id' => $item->user_id,
                        'product_id' => $item->product_id,
                        'product_size_id' => $item->product_size_id,
                        'price' => $productDiscount ? $productPrice - (($productPrice * $productDiscount) / 100) : $productPrice,
                        'quantity' => $item->quantity,
                        'transaction_id' => $transactionId,
                        'total' => $total,
                    ];
                });

                DB::table('orders')->insert($orders->toArray());

                DB::table('carts')->whereIn('id', $carts->pluck('id'))->delete();
            });

            $this->updateProdQuantity($transactionId);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error();
        }
    }


    public function updateProdQuantity($transactionId)
    {
        $orders = Order::with('product')->where("transaction_id", $transactionId)->get();

        if ($orders->count()) {
            foreach ($orders as $order) {
                $product = $order->product;

                if ($order->product->size()->count()) {
                    if ($order->productSize->quantity >= $order->quantity) {
                        $order->productSize->decrement('quantity', $order->quantity);
                    }
                } else {
                    if ($product->quantity >= $order->quantity) {
                        $product->decrement('quantity', $order->quantity);
                    }
                }
            }
        }
    }

    public function generateReference()
    {
        $random_number = "TN" . random_int(100000, 999999);
        return $random_number;
    }

    public function getTax($total)
    {

        $percentage = $this->tax->price ?? 8.25;
        $tax = ($total * $percentage) / 100;

        return $tax;
    }
}
