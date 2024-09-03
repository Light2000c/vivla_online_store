<?php

namespace App\Livewire\Components;

use App\Services\CartService;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CartCount extends Component
{

    public $cartCount;
    public $display;



    protected $listeners = ['cartUpdated' => 'updateCartCount'];

    public function mount()
    {
        $this->load();
    }

    public function updateCartCount()
    {
        $this->load();
    }


    public function render()
    {
        return view('livewire.components.cart-count');
    }

    public function load()
    {
        // $this->cartCount = Auth::check() ? Auth::user()->cart()->get() : null;
        if (Auth::check()) {
            $this->cartCount = Auth::user()->cart()->get();
        } else {
            $sessionCart = session()->get('cart', []);
            // $this->cartCount = count($sessionCart);
            $this->cartCount = collect($sessionCart)->sum('quantity');
        }
    }

    public function update($id, $value)
    {


        $update = CartService::updateCart($id, $value);

        if ($update) {
            $this->load();
            $this->dispatch('cartUpdated');
            return $this->showToast("success", "Cart updated");
        }
    }

    public function inc($id)
    {

        $save = CartService::inc($id);

        if ($save) {
            $this->load();

            $this->dispatch('cartUpdated');
            return $this->showToast("success", "Cart updated");
        }
    }

    public function dec($id)
    {

        $save = CartService::dec($id);

        if ($save) {
            $this->load();
            $this->dispatch('cartUpdated');
            return $this->showToast("success", "Cart updated");
        }
    }

    public function delete($id)
    {


        $delete = CartService::delete($id);

        if ($delete) {
            $this->load();

            $this->dispatch('cartUpdated');
            return $this->showToast("success", "Cart updated");
        }
    }


    public function getTotal()
    {
        $total = 0;

        foreach ($this->cartCount as $cart) {
            if ($cart->product->discount) {
                $total = $total + ($cart->quantity * ($cart->product->price - ($cart->product->price * $cart->product->discount / 100)));
            } else {
                $total = $total + ($cart->quantity * $cart->product->price);
            }
        }

        return $total;
    }

    public function showToast($icon, $title)
    {
        $this->dispatch(
            'message',
            icon: $icon,
            title: $title,
        );
    }
}
