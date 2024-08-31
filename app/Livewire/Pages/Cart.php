<?php

namespace App\Livewire\Pages;

use App\Models\Cart as ModelCart;
use App\Services\CartService;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Cart extends Component
{

    public $listeners = ['updateCart'];

    private $carts;
    private $subTotal;

    public function render()
    {
        $this->load();
        return view('livewire.pages.cart', [
            "carts" => $this->carts,
            "subTotal" => $this->subTotal
        ]);
    }

    public function load()
    {
        $this->carts = Auth::user()->cart()->get();

        $carts = Auth::user()->cart()->get();

        $this->subTotal = $carts->sum(function ($cart) {
            if ($cart->product->discount) {
                return $cart->quantity * ($cart->product->price - ($cart->product->price * $cart->product->discount / 100));
            }
            return $cart->quantity * $cart->product->price;
        });
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

        $cartService = new CartService;

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

    public function showToast($icon, $title)
    {
        $this->dispatch(
            'message',
            icon: $icon,
            title: $title,
        );
    }
}
