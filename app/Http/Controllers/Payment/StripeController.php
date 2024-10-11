<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Mail\InfoMail;
use App\Mail\PaymentMail;
use App\Models\Cart;
use App\Models\Order;
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

    public function __construct()
    {
        $this->stripe = $this->stripe = new StripeClient(config('stripe.sk'));
    }


    public function checkout(Request $request)
    {
        $this->validate($request, [
            'fullName' => 'required',
            'amount' => 'required|numeric',
        ]);


        try {
            $session = $this->stripe->checkout->sessions->create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => 'Purchase from Vivla Closet',
                        ],
                        'unit_amount' => $request->amount * 100,
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('checkout.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('checkout.cancel'),
            ]);

            return redirect($session->url);
        } catch (\Exception $e) {

            dd($e->getMessage());
            return back()->with('error', 'Failed to create Stripe Checkout session: ' . $e->getMessage());
        }
    }

    public function success(Request $request)
    {


        $sessionId = $request->query('session_id');

        try {

            $session =  $this->stripe->checkout->sessions->retrieve($sessionId);

            // dd($session);
            if ($session->payment_status == 'paid') {


                $this->saveTransaction();

                $reference = $this->reference ? $this->reference : "";

                $date = now()->format('Y-m-d H:i:s');

                $details = [
                    "name" => Auth::user()->name,
                    "email" => Auth::user()->email,
                    "order_number" => $reference,
                    "order_date" => $date
                ];

                $sent = Mail::to(Auth::user()->email)->send(new PaymentMail($details));

                //sent to admin organisation email
                $sent_to_admin = Mail::to("tegaonitsha@gmail.com")->send(new InfoMail($details));

                if (!$sent) {
                    return $this->error();
                }

                if (!$sent_to_admin) {
                    return $this->error();
                }

                return view('payment.paymentsuccess', ['session' => $session, 'reference' => $reference]);
            } else {
                return $this->error();
                // dd('Payment not completed.');
                // return redirect('/')->with('error', 'Payment not completed.');
            }
        } catch (\Exception $e) {
            return $this->error();
            // dd('Failed to retrieve payment details: ' . $e->getMessage());
            // return redirect('/')->with('error', 'Failed to retrieve payment details: ' . $e->getMessage());
        }
    }

    public function error()
    {

        try {
            return view('payment.paymenterror');
        } catch (\Exception $e) {
            dd('Failed to retrieve payment details: ' . $e->getMessage());
            // return redirect('/')->with('error', 'Failed to retrieve payment details: ' . $e->getMessage());
        }
    }

    public function cancel()
    {
        return redirect()->route("checkout");
        // return view('checkout.cancel');
    }




    public function saveTransaction()
    {

        $random_number = $this->generateReference();


        $cart = auth()->user()->cart()->get();

        if ($cart->isEmpty()) {
            return $this->error();
        }

        $address = auth::user()->address()->where("active", 1)->first();

        if (!$address) {
            // return $this->error();
        }


        $transaction = request()->user()->transaction()->create([
            "reference" => $random_number,
            "address_id" => $address->id
        ]);

        $this->reference = $random_number;


        if (!$transaction) {
            return $this->error();
        }

        $transactionId = $transaction->id;

        try {
            DB::transaction(function () use ($transactionId) {
                DB::table('carts')->orderBy('id')->chunk(1000, function ($carts) use ($transactionId) {
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
                            'price' =>  $productDiscount ? $productPrice - (($productPrice * $productDiscount) / 100) : $productPrice,
                            'quantity' => $item->quantity,
                            'transaction_id' => $transactionId,
                            'total' => $total,
                        ];
                    });

                    DB::table('orders')->insert($orders->toArray());

                    DB::table('carts')->whereIn('id', $carts->pluck('id'))->delete();
                });
            });

            $this->updateProdQuantity($transactionId);


            // return redirect()->route("dashboard");
        } catch (\Exception $e) {
            // return back()->with('error', "Something went wrong, please try again.");
            return $this->error();
        }
    }

    public function updateProdQuantity($transactionId)
    {
        $orders = Order::with('product')->where("transaction_id", $transactionId)->get();

        if ($orders->count()) {
            foreach ($orders as $order) {
                $product = $order->product;

                if ($product->quantity >= $order->quantity) {
                    $new_quantity = $product->quantity - $order->quantity;

                    $product->quantity = $new_quantity;
                    $product->save();
                } else {
                }
            }
        }
    }

    public function generateReference()
    {
        $random_number = "TN" . random_int(100000, 999999);
        return $random_number;
    }
}
