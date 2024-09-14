<?php

namespace App\Livewire\Pages;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Home extends Component
{

    private $categories;
    private $new_products;

    public function render()
    {
        $this->load();

        return view('livewire.pages.home', [
            'new_products' => $this->new_products,
            'categories' => $this->categories
        ]);
    }

    public function load()
    {
        $this->categories = Category::get();
        $this->new_products = Product::get();
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


    public function addToSessionCart($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return;
        }

        $cart = session()->get('cart', []);

        if (array_key_exists($id, $cart)) {
            return;
        }


        $cart[$id] = [
            'product_id' => $product->id,
            'quantity' => 1,
            'price' => $product->price,
        ];


        session()->put('cart', $cart);

        return $this->dispatch('cartUpdated');
    }


    public function removeFromSessionCart($id)
    {
        $cart = session()->get('cart', []);

        if (array_key_exists($id, $cart)) {

            unset($cart[$id]);

            session()->put('cart', $cart);

            $this->dispatch('cartUpdated');
        }
    }


    public function isInCart($productId)
    {
        $sessionCart = session()->get('cart', []);
        return array_key_exists($productId, $sessionCart);
    }
}
