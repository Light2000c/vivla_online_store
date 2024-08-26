<?php

namespace App\Livewire\Pages;

use App\Models\Cart;
use App\Models\Product;
use Livewire\Component;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class Products extends Component
{

    private $products;

    public function mount() {}

    public function render()
    {

        $this->load();

        return view('livewire.pages.products', [
            "products" => $this->products,
        ]);
    }

    public function load()
    {
        $products = Product::orderBy("created_at", "DESC")->get();

        $this->products = $products;
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
