<?php

namespace App\Livewire\Pages;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Wishlist;
use App\Services\CartService;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ProductDetails extends Component
{
    public $product;

    public function mount($id)
    {
        $this->product = Product::find($id);
    }

    public function render()
    {
        return view('livewire.pages.product-details');
    }

    public function load()
    {
        $this->product = Product::find($this->product->id);
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


    public function update($id, $value)
    {


        $cart = Cart::where("user_id", Auth::user()->id)->where("product_id", $id)->first();

        if (!$cart) {
            return;
        }

        $update = CartService::updateCart($cart->id, $value);

        if ($update) {
            $this->load();
            $this->dispatch('cartUpdated');
            return $this->showToast("success", "Cart updated");
        }
    }

    public function inc($id)
    {


        $cart = Cart::where("user_id", Auth::user()->id)->where("product_id", $id)->first();


        if (!$cart) {
            return;
        }


        $cart->quantity++;
        $save =  $cart->save();



        if ($save) {
            $this->load();

            $this->dispatch('cartUpdated');
            return $this->showToast("success", "Cart updated");
        }
    }

    public function dec($id)
    {

        $cart = Cart::where("user_id", Auth::user()->id)->where("product_id", $id)->first();

        if (!$cart) {
            return;
        }

        if ($cart->quantity == 1) {
            return;
        }

        $cart->quantity--;
        $save = $cart->save();

        if ($save) {
            $this->load();
            $this->dispatch('cartUpdated');
            return $this->showToast("success", "Cart updated");
        }
    }

    public function getCartQuantity($id){
        $cart = Cart::where("user_id", Auth::user()->id)->where("product_id", $id)->first();

        if (!$cart) {
            return;
        }

        return $cart->quantity;
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
