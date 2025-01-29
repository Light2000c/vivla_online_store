<?php

namespace App\Http\Controllers\payment;

use App\Http\Controllers\Controller;
use App\Mail\InfoMail;
use App\Mail\PaymentMail;
use App\Models\GuestOrder;
use App\Models\GuestPayment;
use App\Models\GuestTransaction;
use App\Models\Order;
use App\Models\Price;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Omnipay\Omnipay;

class GuestPaypalController extends Controller
{

    public $paypal;
    public $reference;
    public $shipping;
    public $tax;
    public $customer_name;
    public $customer_email;
    public $phone;
    public $street;
    public $city;
    public $country;

    public function __construct()
    {

        $this->middleware(["guest"]);
        
        // Initialize PayPal REST Gateway
        $this->paypal = Omnipay::create('PayPal_Rest');
        $this->paypal->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->paypal->setSecret(env('PAYPAL_CLIENT_SECRET'));
        // $this->paypal->setTestMode(env('PAYPAL_SANDBOX_MODE', true));

        $this->shipping = Price::where("name", "shipping")->first();
        $this->tax = Price::where("name", "tax")->first();
    }

    public function checkout(Request $request)
    {

        $transactionId = uniqid();

        $request->validate([
            'amount' => 'required|numeric',
        ]);

        $total_amount = $request->amount + $this->shipping->price + $this->getTax($request->amount);

        $formatted_amount = number_format($total_amount, 2, '.', '');

        try {
            // Create a purchase request for PayPal
            $response = $this->paypal->purchase([
                'amount' =>  $formatted_amount,
                'currency' => 'USD',
                'returnUrl' => route('guest-checkout.paypal.success', ['transaction_id' => $transactionId]),
                'cancelUrl' => route('guest-checkout.paypal.cancel'),
                'description' => 'Purchase from Vivla Closet',
            ])->send();


            // dd($response);

            if ($response->isRedirect()) {
                return redirect($response->getRedirectUrl());
            } else {
                // return back()->with('error', $response->getMessage());
                return back()->with('error', "Something went wrong while trying to checkout, please try again");
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong while trying to checkout, please try again ');
        }
    }

    public function success(Request $request)
    {

        $paymentId = $request->query('paymentId');
        $payerId = $request->query('PayerID');

        if (!$paymentId || !$payerId) {
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

                $amount = $data['transactions'][0]['amount']['total'];

                $guest = session()->get("guestData", []);


                $details = [
                    "name" => $guest["name"] ?? null,
                    "email" => $guest["email"] ?? null,
                    "order_number" => $reference,
                    "order_date" => $date,
                    "total_amount" => $amount,
                    "method" => "paypal"
                ];

                $guest = session()->get("guestData", []);

                try {
                    Mail::to($guest["email"] ?? "example@gmail.com")->send(new PaymentMail($details));
                    Mail::to("sales@vivlavivcloset.com")->send(new InfoMail($details));
                } catch (\Exception $e) {
                    return $this->error();
                }

                return view('payment.guestpaymentsuccess', ['details' => $details]);
            } else {
                return $this->error();
            }
        } catch (\Exception $e) {
            return $this->error();
        }
    }


    public function error()
    {
        return view('payment.guestpaymenterror');
    }

    public function cancel()
    {
        return redirect()->route("checkout");
    }

    public function savePayment($data)
    {
        $amount = $data['transactions'][0]['amount']['total'];
        $currency =  $data['transactions'][0]['amount']['currency'];

        $guest = session()->get("guestData", []);

        try {
            $payment = GuestPayment::create([
                "name" => $guest["name"] ?? null,
                "amount" => $amount,
                "currency" => $currency,
                "reference" => $this->reference,
                "type" => "paypal"
            ]);

            if (!$payment) {
                return false;
            }

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }



    public function saveTransaction($data)
    {
        DB::beginTransaction();

        try {
            $random_number = $this->generateReference();

            $this->reference = $random_number;

            if (!$this->savePayment($data)) {
                DB::rollBack();
                return $this->error();
            }

            $guest = session()->get("guestData", []);

            $transaction = GuestTransaction::create([
                "name" => $guest["name"] ?? null,
                "email" => $guest["email"] ?? null,
                "phone" => $guest["phone"] ?? null,
                "street" => $guest["street"] ?? null,
                "city" => $guest["city"] ?? null,
                "country" => $guest["country"] ?? null,
                "reference" => $random_number,
            ]);


            if (!$transaction) {
                return $this->error();
            }

            $transactionId = $transaction->id;

            $carts = session()->get('cart', []);

            if (!empty($carts)) {

                $productIds = array_column($carts, 'product_id');


                $products = Product::whereIn('id', $productIds)->get()->keyBy('id');

                foreach ($carts as $id => $item) {

                    $product = $products->get($item['product_id']);

                    if (!$product) {
                        continue;
                    }

                    $productDiscount = $product->discount;
                    $sizeId = $item['product_size_id'] ?? null;

                    $total = $productDiscount
                        ? $item['quantity'] * ($product->price - (($product->price * $productDiscount) / 100))
                        : $product->price * $item['quantity'];

                    GuestOrder::create([
                        'guest_transaction_id' => $transaction->id,
                        'product_id' => $item['product_id'],
                        'product_size_id' => $sizeId,
                        'price' => $item['price'],
                        'quantity' => $item['quantity'],
                        'total' => $total,
                    ]);
                }

                session()->forget('cart');
            }

            $this->updateProdQuantity($transactionId);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error();
        }
    }



    public function updateProdQuantity($transactionId)
    {
        $orders = GuestOrder::with('product')->where("guest_transaction_id", $transactionId)->get();

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
