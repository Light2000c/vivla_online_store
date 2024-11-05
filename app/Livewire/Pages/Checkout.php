<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Mail\InfoMail;
use App\Mail\PaymentMail;
use App\Models\Address;
use App\Models\Price;
use App\Models\User;
use App\Services\CountryServices;

class Checkout extends Component
{

    public $carts;
    public $subTotal;
    public $address;
    public $whatsAppUrl;

    public $firstname;
    public $lastname;
    public $email;
    public $phone;
    public $updatePhone;
    public $street;
    public $city;
    public $country;
    public $activeAddress;
    public $countries = [];
    public $shipping;


    public function mount()
    {

        $this->countries = CountryServices::getAllCountries();
        $this->load();
    }

    public function render()
    {
        return view('livewire.pages.checkout');
    }

    public function load()
    {
        $this->carts = Auth::user()->cart()->orderBy("created_at", "DESC")->get();
        $this->address = Auth::user()->address()->where("active", 1)->first();
        $this->shipping = Price::where("name", "shipping")->first();

        if ($this->address) {
            $this->setValues($this->address);
        }

        $this->subTotal = $this->carts->sum(function ($cart) {
            if ($cart->product->discount) {
                return $cart->quantity * ($cart->product->price - ($cart->product->price * $cart->product->discount / 100));
            }
            return $cart->quantity * $cart->product->price;
        });

        $this->setWhatsappUrl();

        $this->dispatch('initializePhoneInputs', [
            'address' => $this->address ? true : false,
            'phone' => $this->address->phone ?? ''
        ]);
    }


    public function setValues($address)
    {

        $this->firstname = $address->firstname ?? "";
        $this->lastname = $address->lastname ?? "";
        $this->email = $address->email ?? "";
        $this->updatePhone = $address->phone ?? "";
        $this->street = $address->street ?? "";
        $this->city = $address->city ?? "";
        $this->country = $address->country ?? "";
    }


    public function saveAddress()
    {



        $validators = $this->validate([
            "firstname" => "required",
            "lastname" => "required",
            "email" => "required",
            "phone" => "required",
            "street" => "required",
            "city" => "required",
            "country" => "required",
        ]);

        try {

            $user = User::find(Auth::user()->id);

            $validators["active"] = 1;

            $address = $user->address()->create($validators);

            if ($address) {
                $this->load();
                $this->showToast("success", "Address has been successfully added");
            }
        } catch (\Exception $e) {
            return $this->showToast("info", "Something went wrong while trying to save address");
        }
    }

    public function updateAddress()
    {


        $address = Address::find($this->address->id);

        if (!$address) {
            return;
        }

        $validated = $this->validate([
            "firstname" => "required",
            "lastname" => "required",
            "email" => "required",
            "updatePhone" => "required",
            "street" => "required",
            "city" => "required",
            "country" => "required",
        ]);

        try {
            if ($address && $address->user->is(Auth::user())) {

                $validated["phone"] = $this->updatePhone;

                unset($validated["updatePhone"]);


                $updated = $address->update($validated);

                if ($updated) {
                    $this->load();
                    $this->showToast("success", "Address has been successfully updated");
                }
            }
        } catch (\Exception $e) {
            return $this->showToast("info", "Something went wrong while trying to save address");
        }
    }

    public function pay()
    {
        $carts = request()->user()->cart()->get();

        if ($carts->isEmpty()) {
            return $this->showToast("info", "You don't have any product on your cart yet!");
        }

        // $default_address = request()->user()->address()->where("active", 1)->first();
        // if (!$default_address) {
        //     return $this->showToast("info", "You haven't set you default address yet");
        // }

        foreach ($carts as $cart) {
            if ($cart->product->size()->count()) {
                if ($cart->quantity > $cart->productSize->quantity) {
                    return $this->showAlert("info", "Product Out of Stock", "Unfortunately, a product you're trying to add is currently out of stock. Please review your cart and confirm available items.");
                }
            } else {
                if ($cart->quantity > $cart->product->quantity) {
                    return $this->showAlert("info", "Product Out of Stock", "Unfortunately, a product you're trying to add is currently out of stock. Please review your cart and confirm available items.");
                }
            }
        }

        $this->dispatch('submit-payment-form');
    }


    public function payWithPaypal()
    {
        $carts = request()->user()->cart()->get();

        if ($carts->isEmpty()) {
            return $this->showToast("info", "You don't have any product on your cart yet!");
        }

        $default_address = request()->user()->address()->where("active", 1)->first();

        if (!$default_address) {
            return $this->showToast("info", "You haven't set you default address yet");
        }

        foreach ($carts as $cart) {
            if ($cart->product->size()->count()) {
                if ($cart->quantity > $cart->productSize->quantity) {
                    return $this->showAlert("info", "Product Out of Stock", "Unfortunately, a product you're trying to add is currently out of stock. Please review your cart and confirm available items.");
                }
            } else {
                if ($cart->quantity > $cart->product->quantity) {
                    return $this->showAlert("info", "Product Out of Stock", "Unfortunately, a product you're trying to add is currently out of stock. Please review your cart and confirm available items.");
                }
            }
        }

        $this->dispatch('submit-paypal-payment-form');
    }


    public function setWhatsappUrl()
    {
        $message = '';

        $message .= "Products: \n";

        $carts = request()->user()->cart()->get();

        if (!$carts->count()) {
            return $this->showToast("info", "You don't have any product on your cart yet!");
        }

        foreach ($this->carts as $cart) {
            $message .= $cart->product->name . " x " . $cart->product->price . "\n";
        }

        $message .= "Total: " . $this->subTotal . " \n";

        $encodedMessage = urlencode($message);

        $phone = '+17138207857';

        $this->whatsAppUrl = "https://wa.me/$phone?text=$encodedMessage";
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
}
