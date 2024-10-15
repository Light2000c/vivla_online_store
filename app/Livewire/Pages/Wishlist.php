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

        try {
            $product = Product::find($id);

            $user = Auth::user();

            if ($product->quantity < 1) {
                return $this->showToast("failed", "Product is out of stock");
            }

            if ($product->hasCart(Auth::user())) {
                return;
            }

            $cart = $user->cart()->create([
                'product_id' => $product->id,
            ]);

            if ($cart) {
                return $this->dispatch('cartUpdated');
            }
        } catch (\Exception $e) {
            return $this->showToast("error", "Something went wrong while updating the cart");
        }
    }

    public function removeFromCart($id)
    {

        try {

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
        } catch (\Exception $e) {
            return $this->showToast("error", "Something went wrong while updating the cart");
        }
    }

    public function delete($id)
    {

        try {

            $wish = ModelsWishlist::find($id);

            if (!$wish) {
                return;
            }

            $delete = $wish->delete();

            if (!$delete) {
                return;
            }

            return $this->load();
        } catch (\Exception $e) {
            return $this->showToast("error", "Something went wrong while updating the cart");
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
