<?php

namespace App\Livewire\Components;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CartCount extends Component
{

    public $cartCount;
    public $display;



    protected $listeners = ['cartUpdated' => 'updateCartCount'];

    public function mount()
    {
        $this->cartCount = Auth::check() ? Auth::user()->cart()->get() : null;
    }

    public function updateCartCount()
    {
        $this->cartCount = Auth::check() ? Auth::user()->cart()->get() : null;
    }


    public function render()
    {
        return view('livewire.components.cart-count');
    }
}
