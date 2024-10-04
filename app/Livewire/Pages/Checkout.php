<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Mail\InfoMail;
use App\Mail\PaymentMail;



class Checkout extends Component
{

    public $carts;
    public $subTotal;
    public $address = [];
    public $whatsAppUrl;

    public function mount()
    {
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

        $this->subTotal = $this->carts->sum(function ($cart) {
            if ($cart->product->discount) {
                return $cart->quantity * ($cart->product->price - ($cart->product->price * $cart->product->discount / 100));
            }
            return $cart->quantity * $cart->product->price;
        });
        $this->setWhatsappUrl();
    }

    public function pay()
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
            if ($cart->quantity > $cart->product->quantity) {
                return $this->showToast("info", "please re-confirm carts and try again");
            }
        }

        $this->dispatch('submit-payment-form');
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

        $phone = '2348131658436';

        $this->whatsAppUrl = "https://wa.me/$phone?text=$encodedMessage";

        // dd($this->whatsAppUrl);
    }




    //********************************************************************** */

    //********************************************************************** */

    public function showToast($icon, $title)
    {

        $this->dispatch(
            'message',
            icon: $icon,
            title: $title,
        );
    }
}
