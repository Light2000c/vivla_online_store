<?php

namespace App\Livewire\Pages;

use App\Models\Product;
use Livewire\Component;
use App\Services\CartService;
use App\Models\Cart as ModelCart;
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

        if (Auth::check()) {
            $this->carts = Auth::user()->cart()->get();

            $carts = Auth::user()->cart()->get();

            $this->subTotal = $carts->sum(function ($cart) {
                if ($cart->product->discount) {
                    return $cart->quantity * ($cart->product->price - ($cart->product->price * $cart->product->discount / 100));
                }
                return $cart->quantity * $cart->product->price;
            });
        } else {
            $sessionCarts = session()->get('cart', []);
            $this->carts = collect($sessionCarts)->map(function ($item, $id) {

                $product = Product::find($id);

                if (!$product) {
                    return null;
                }
                return (object) [
                    'id' => $id,
                    'product' => (object) [
                        'price' => $item['price'],
                        'discount' => 0,
                    ],
                    'quantity' => $item['quantity'],
                ];
            })->filter();

            $this->subTotal = collect($sessionCarts)->sum(function ($item) {

                $product = Product::find($item['product_id']); // Assume 'id' is part of the $item array

                if (!$product) {
                    return 0;  // Return 0 for invalid products
                }

                // Calculate based on discount if available
                if ($product->discount) {
                    return $item['quantity'] * ($product->price - ($product->price * $product->discount / 100));
                } else {
                    return $item['quantity'] * $product->price;
                }
            });
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

        $cart = ModelCart::find($id);

        if ($cart->product && ($cart->quantity < $cart->product->quantity)) {
            $save = CartService::inc($id);

            if ($save) {
                $this->load();

                $this->dispatch('cartUpdated');
                return $this->showToast("success", "Cart updated");
            }
        } else {
            return $this->showToast("failed", "Product is out of stock");
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


    // other functions

    public function getProductName($id)
    {

        $product = Product::find($id);

        return !empty($product) ? $product->name : "";
    }

    public function getCartTotal($id, $quantity)
    {
        $product = Product::find($id);

        if (empty($product)) {
            return 0;
        }

        if ($product->discount) {
            return $quantity * ($product->price - ($product->price * $product->discount / 100));
        } else {
            return $quantity * $product->price;
        }
    }

    public function getProductImage($id)
    {

        $product = Product::find($id);

        return !empty($product) ? $product->image : "";
    }

    public function getProductQuantity($id)
    {

        $product = Product::find($id);

        return !empty($product) ? $product->quantity : "";
    }


    public function incSessionCart($id)
    {

        $product = Product::find($id);

        if (!$product) {
            return;
        }

        $cart = session()->get('cart', []);

        if (array_key_exists($id, $cart)) {

            if ($cart[$id]['quantity'] < $product->quantity) {
                $cart[$id]['quantity'] += 1;

                session()->put('cart', $cart);

                $this->dispatch('cartUpdated');

                return true;
            }
        }

        return false;
    }

    public function decSessionCart($id)
    {

        $cart = session()->get('cart', []);


        if (array_key_exists($id, $cart)) {

            if ($cart[$id]['quantity'] > 1) {
                $cart[$id]['quantity'] -= 1;
            } else {
                // unset($cart[$id]);
            }

            session()->put('cart', $cart);

            $this->dispatch('cartUpdated');

            return true;
        }

        return false;
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
}
