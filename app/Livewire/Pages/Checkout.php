<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Checkout extends Component
{

    public $carts;
    public $subTotal;
    public $address;
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
    }
}
