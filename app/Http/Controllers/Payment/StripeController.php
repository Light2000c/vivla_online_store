<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

                return view('payment.paymentsuccess', ['session' => $session, 'reference' => $reference]);
            } else {
                dd('Payment not completed.');
                // return redirect('/')->with('error', 'Payment not completed.');
            }
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
            // return response()->json([
            //     "status" => "failed",
            //     "message" => "User has not added any product to cart yet"
            // ]);
            dd("User has not added any product to cart yet");
        }


        $transaction = request()->user()->transaction()->create([
            "reference" => $random_number,
        ]);

        $this->reference = $random_number;


        if (!$transaction) {
            // return back()->with('error', "Something went wrong, please try again.");
            dd("Something went wrong, please try again");
        }

        $transactionId = $transaction->id;

        try {
            DB::transaction(function () use ($transactionId) {
                DB::table('carts')->orderBy('id')->chunk(1000, function ($carts) use ($transactionId) {
                    $orders = $carts->map(function ($item) use ($transactionId) {
                        $productPrice = DB::table('products')
                            ->where('id', $item->product_id)
                            ->value('price');

                        $total = $productPrice * $item->quantity;

                        return [
                            'user_id' => $item->user_id,
                            'product_id' => $item->product_id,
                            'quantity' => $item->quantity,
                            'transaction_id' => $transactionId,
                            'total' => $total,
                        ];
                    });

                    DB::table('orders')->insert($orders->toArray());

                    DB::table('carts')->whereIn('id', $carts->pluck('id'))->delete();
                });
            });


            // return redirect()->route("dashboard");
        } catch (\Exception $e) {
            dd($e->getMessage());
            return back()->with('error', "Something went wrong, please try again.");
        }
    }

    public function generateReference()
    {
        $random_number = "TN" . random_int(100000, 999999);
        return $random_number;
    }
}
