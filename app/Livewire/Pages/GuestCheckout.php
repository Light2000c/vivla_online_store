<?php

namespace App\Livewire\Pages;

use App\Models\Price;
use App\Models\Product;
use App\Models\ProductSize;
use App\Services\CountryServices;
use Livewire\Component;

class GuestCheckout extends Component
{
    public $name;
    public $email;
    public $phone;
    public $updatePhone;
    public $street;
    public $city;
    public $country;
    public $carts;
    public $subTotal;
    public $countries = [];
    public $shipping;
    public $tax;

    protected $listeners = ['proceedWithPayment'];


    public function render()
    {
        $this->load();

        return view('livewire.pages.guest-checkout');
    }

    public function load()
    {
        $sessionCarts = session()->get('cart', []);

        $this->countries = CountryServices::getAllCountries();
        $this->shipping = Price::where("name", "shipping")->first();
        $this->tax = Price::where("name", "tax")->first();

        $this->carts = collect($sessionCarts)->map(function ($item, $id) {

            $product = Product::find($item['product_id']);

            if (!$product) {
                return null;
            }

            return (object) [
                'id' => $id,
                'product' => (object) [
                    'price' => $item['price'],
                    'discount' => 0,
                ],
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'product_size_id' => $item['product_size_id'] ?? null
            ];
        })->filter();

        $this->subTotal = $this->calculateSessionSubTotal($sessionCarts);

        $this->dispatch('initializePhoneInputs', []);
    }


    private function calculateSessionSubTotal($sessionCarts)
    {
        return collect($sessionCarts)->sum(function ($item) {
            $product = Product::find($item['product_id']);
            if (!$product) {
                return 0;
            }
            return $item['quantity'] * ($product->discount
                ? ($product->price - ($product->price * $product->discount / 100))
                : $product->price);
        });
    }


    public function getProductName($id)
    {

        $product = Product::find($id);
        return $product->name;
    }


    public function getProductPrice($id, $quantity)
    {

        $product = Product::find($id);

        if ($product->discount) {
            return $quantity * ($product->price - ($product->price * $product->discount) / 100);
        } else {
            return $quantity * $product->price;
        }
    }


    public function getTax($total)
    {

        $percentage = $this->tax->price ?? 8.25;
        $tax = ($total * $percentage) / 100;

        return $tax;
    }


    public function showToast($icon, $title)
    {

        $this->dispatch(
            'message',
            icon: $icon,
            title: $title,
        );
    }


    public function showAlert($icon, $title, $text)
    {

        $this->dispatch(
            'alert',
            icon: $icon,
            title: $title,
            text: $text,
            redirectUrl: url('/cart')
        );
    }


    public function proceedWithPayment($phone, $type)
    {

        $this->phone = $phone;


        $validated =   $this->validate([
            "name" => "required",
            "email" => "required",
            "phone" => "required",
            "street" => "sometimes",
            "city" => "sometimes",
            "country" => "sometimes",
        ]);

        $guestData = session()->get("guestData", []);

        $guest = [
            "name" => $this->name,
            "email" => $this->email,
            "phone" => $this->phone,
            "street" => $this->street,
            "city" => $this->city,
            "country" => $this->country,
        ];

        session()->put("guestData", $guest);


        foreach ($this->carts as $sessionCart) {

            $product = Product::find($sessionCart->id);

            if (!$product) {
                return $this->showAlert("info", "Product Don't Exixt", "Unfortunately, a product you're trying to purchase no longer exist. Please review your cart and confirm available items.");
            }


            if ($product->size()->count()) {
                $productSize = ProductSize::find($sessionCart->product_size_id);

                if (!$productSize) {
                    if (!$product) {
                        return $this->showAlert("info", "Product Don't Exixt", "Unfortunately, a product you're trying to purchase no longer exist. Please review your cart and confirm available items.");
                    }
                }
                if ($sessionCart->quantity > $productSize->quantity) {
                    return $this->showAlert("info", "Product Out of Stock", "Unfortunately, a product you're trying to purchase is currently out of stock. Please review your cart and confirm available items.");
                }
            } else {
                if ($sessionCart->quantity > $product->quantity) {
                    return $this->showAlert("info", "Product Out of Stock", "Unfortunately, a product you're trying to purchase is currently out of stock. Please review your cart and confirm available items.");
                }
            }
        }


        if ($type == "card") {
            $this->dispatch('submit-payment-form');
        }

        if ($type == "paypal") {
            $this->dispatch('submit-paypal-payment-form');
        }
    }
}
