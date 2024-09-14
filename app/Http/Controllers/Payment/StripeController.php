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

class StripeController extends Controller
{
    public $stripe;

    public function __construct()
    {
        $this->stripe = $this->stripe = new StripeClient(config('stripe.sk'));
    }

    public function index()
    {
        $carts = Auth::user()->cart()->get();
        $itemCount = $carts->sum("quantity");
        $amount = (int) $carts->sum(function ($cart) {
            if ($cart->product->discount) {
                return $cart->quantity * ($cart->product->price - ($cart->product->price * $cart->product->discount / 100));
            }
            return $cart->quantity * $cart->product->price;
        });

        return view('payment.stripe', [
            'itemCount' => $itemCount,
            'amount' => $amount,
        ]);
    }

    public function checkout(Request $request)
    {


        $this->validate($request, [
            'fullName' => 'required',
            'cardNumber' => 'required',
            'month' => 'required',
            'year' => 'required',
            'cvv' => 'required',
            'amount' => 'required',
        ]);


        $token = $this->createToken($request);

        $charge = null;
        try {

            $charge = $this->stripe->charges->create([
                "amount" => $request->amount,
                "currency" => "usd",
                "source" => $token,
                "description" => "Purchased items from vivla closet.",

            ]);


            if ($charge["status"] == "succeeded") {

               return $this->saveTransaction();
            }
        } catch (Exception $e) {
            // dd($e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }



    private function createToken($cardData)
    {

        $token = null;
        try {
            $token = $this->stripe->tokens->create([
                'card' => [
                    'number' => $cardData['cardNumber'],
                    'exp_month' => $cardData['month'],
                    'exp_year' => $cardData['year'],
                    'cvc' => $cardData['cvv']
                ]
            ]);
        } catch (CardException $e) {
            dd($e->getMessage());
            return back()->with('error', $e->getMessage());
            // dd($e->getMessage());
        }

        return $token;
    }

    public function saveTransaction()
    {


        $random_number = $this->generateReference();


        $cart = auth()->user()->cart()->get();

        if ($cart->isEmpty()) {
            return response()->json([
                "status" => "failed",
                "message" => "User has not added any product to cart yet"
            ]);
        }


        $transaction = request()->user()->transaction()->create([
            "reference" => $random_number,
        ]);


        if (!$transaction) {
            return back()->with('error', "Something went wrong, please try again.");
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

         
            // dd("good it entered");
            return redirect()->route("dashboard");
        } catch (\Exception $e) {
            // Handle exceptions and rollback
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
