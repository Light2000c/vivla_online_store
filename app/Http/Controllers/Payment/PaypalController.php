<?php

namespace App\Http\Controllers\payment;

use App\Http\Controllers\Controller;
use App\Mail\InfoMail;
use App\Mail\PaymentMail;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Omnipay\Omnipay;

class PaypalController extends Controller
{


    public $paypal;
    public $reference;

    public function __construct()
    {
        // Initialize PayPal REST Gateway
        $this->paypal = Omnipay::create('PayPal_Rest');
        $this->paypal->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->paypal->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $this->paypal->setTestMode(env('PAYPAL_SANDBOX_MODE', true));
    }

    public function checkout(Request $request)
    {

        $transactionId = uniqid();

        $request->validate([
            'fullName' => 'required',
            'amount' => 'required|numeric',
        ]);


        // try {
        // Create a purchase request for PayPal
        $response = $this->paypal->purchase([
            'amount' => $request->amount,
            'currency' => 'USD',
            'returnUrl' => route('checkout.paypal.success', ['transaction_id' => $transactionId]),
            'cancelUrl' => route('checkout.paypal.cancel'),
            'description' => 'Purchase from Vivla Closet',
        ])->send();

        // dd($response->getRedirectUrl());
        // dd($response->getData());
        // dd($response);

        if ($response->isRedirect()) {
            return redirect($response->getRedirectUrl());
        } else {
            dd($response->getMessage());
            return back()->with('error', $response->getMessage());
        }
        // } catch (\Exception $e) {
        //     return back()->with('error', 'Something went wrong while trying to checkout, please try again');
        // }
    }

    public function success(Request $request)
    {
        $paymentId = $request->query('paymentId');
        $payerId = $request->query('PayerID');

        if (!$paymentId || !$payerId) {
            dd("No payment of payment id");
            return $this->error();
        }

        try {
            $response = $this->paypal->completePurchase([
                'transactionReference' => $paymentId,
                'payerId' => $payerId,
            ])->send();

            $data = $response->getData();
            // dd($data);

            if (isset($data['state']) && $data['state'] === 'approved') {
                $this->saveTransaction($data);

                $reference = $this->reference ? $this->reference : "";
                $date = now()->format('Y-m-d H:i:s');
                
                $details = [
                    "name" => Auth::user()->name,
                    "email" => Auth::user()->email,
                    "order_number" => $reference,
                    "order_date" => $date
                ];


                try {
                    Mail::to(Auth::user()->email)->send(new PaymentMail($details));
                    Mail::to("sales@vivlavivcloset.com")->send(new InfoMail($details));
                } catch (\Exception $e) {
                    dd($e->getMessage());
                    return $this->error();
                }

                return view('payment.paymentsuccess', ['reference' => $reference]);
            } else {
                dd("No data ACDK");
                return $this->error();
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
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
      $amount = $data['transactions'][0]['amount']['total'];
      $currency =  $data['transactions'][0]['amount']['currency'];

        try {
            $payment = request()->user()->payment()->create([
                "amount" => $amount,
                "currency" => $currency
            ]);

            if (!$payment) {
                return false;
            }

            return true;
        } catch (\Exception $e) {
            dd($e->getMessage());
            return false;
        }
    }

    public function saveTransaction($data)
    {
        DB::beginTransaction();

        try {
            $random_number = $this->generateReference();

            $address = auth::user()->address()->where("active", 1)->first();
            if (!$address) {
                dd("Something went wrong while trying to save transaction");
                return $this->error();
            }

            if (!$this->savePayment($data)) {
                dd("show 1");
                DB::rollBack();
                return $this->error();
            }

            $transaction = request()->user()->transaction()->create([
                "reference" => $random_number,
                "address_id" => $address->id
            ]);

            $this->reference = $random_number;

            if (!$transaction) {
                dd("Something went wrong while trying to save transaction");
                return $this->error();
            }

            $transactionId = $transaction->id;

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

            dd($e->getMessage());
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

                if ($product->quantity >= $order->quantity) {
                    $product->decrement('quantity', $order->quantity);
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
