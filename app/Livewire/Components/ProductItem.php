<?php

namespace App\Livewire\Components;

use App\Models\Cart;
use App\Models\Product;
use Livewire\Component;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class ProductItem extends Component
{
    public $product;

    public function render()
    {
        return view('livewire.components.product-item');
    }

    public function addToCart($id)
    {

        $product = Product::find($id);

        $user = Auth::user();

        if ($product->hasCart(Auth::user())) {
            return;
        }

        $cart = $user->cart()->create([
            'product_id' => $product->id,
        ]);

        if ($cart) {
            return $this->dispatch('cartUpdated');
        }
    }

    public function removeFromCart($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return;
        }

        $cart = Cart::where("user_id", Auth::user()->id)->where("product_id", $product->id)->first();


        if ($cart && $cart->user()->is(Auth::user())) {
            $delete = $cart->delete();

            if ($delete) {
                return $this->dispatch('cartUpdated');
            }
        }
    }

    public function addToWishlist($id)
    {

        $product = Product::find($id);

        $user = Auth::user();

        if ($product->hasWish(Auth::user())) {
            return;
        }

        $wish = $user->wishlist()->create([
            'product_id' => $product->id,
        ]);

        if ($wish) {
            return $this->dispatch('cartUpdated');
        }
    }

    public function removeFromWishlist($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return;
        }

        $wish = Wishlist::where("user_id", Auth::user()->id)->where("product_id", $product->id)->first();


        if ($wish && $wish->user()->is(Auth::user())) {
            $delete = $wish->delete();

            if ($delete) {
                return $this->dispatch('cartUpdated');
            }
        }
    }
}
