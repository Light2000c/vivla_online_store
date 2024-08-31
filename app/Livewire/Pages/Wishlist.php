<?php

namespace App\Livewire\Pages;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Wishlist as ModelsWishlist;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Wishlist extends Component
{
    private $wishlists;

    public function render()
    {
        $this->load();
        return view('livewire.pages.wishlist', [
            "wishlists" => $this->wishlists,
        ]);
    }

    public function load()
    {
        $this->wishlists = Auth::check() ? Auth::user()->wishlist()->get() : null;
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

    public function delete($id)
    {

        $wish = ModelsWishlist::find($id);

        if (!$wish) {
            return;
        }

        $delete = $wish->delete();

        if (!$delete) {
            return;
        }

        return $this->load();
    }
}
