<?php

namespace App\Livewire\Pages;

use App\Models\Product;
use Livewire\Component;
use App\Services\CartService;
use App\Models\Cart as ModelCart;
use Exception;
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
            $this->subTotal = $this->calculateSubTotal($this->carts);
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

            $this->subTotal = $this->calculateSessionSubTotal($sessionCarts);
        }
    }

    private function calculateSubTotal($carts)
    {
        return $carts->sum(function ($cart) {
            if ($cart->product->discount) {
                return $cart->quantity * ($cart->product->price - ($cart->product->price * $cart->product->discount / 100));
            }
            return $cart->quantity * $cart->product->price;
        });
    }

    private function calculateSessionSubTotal($sessionCarts)
    {
        return collect($sessionCarts)->sum(function ($item) {
            $product = Product::find($item['product_id']);
            if (!$product) {
                return 0;
            }
            return $item['quantity'] * ($product->discount
                ? ($product->price - ($product->price * $product->discount / 100))
                : $product->price);
        });
    }

    public function update($id, $value)
    {

        try {
            $update = CartService::updateCart($id, $value);

            if ($update) {
                $this->load();
                $this->dispatch('cartUpdated');
                return $this->showToast("success", "Cart updated");
            }
        } catch (\Exception $e) {
            return $this->showToast("error", "Something went wrong while updating the cart");
        }
    }

    public function inc($id)
    {
        try {

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
        } catch (\Exception $e) {
            return $this->showToast("error", "Something went wrong while updating the cart");
        }
    }

    public function dec($id)
    {

        try {
            $save = CartService::dec($id);

            if ($save) {
                $this->load();
                $this->dispatch('cartUpdated');
                return $this->showToast("success", "Cart updated");
            }
        } catch (\Exception $e) {
            return $this->showToast("error", "Something went wrong while updating the cart");
        }
    }

    public function delete($id)
    {

        try {
            $delete = CartService::delete($id);

            if ($delete) {
                $this->load();

                $this->dispatch('cartUpdated');
                return $this->showToast("success", "Cart updated");
            }
        } catch (\Exception $e) {
            return $this->showToast("error", "Something went wrong while updating the cart");
        }
    }

    public function clearCarts()
    {

        try {
            if (Auth::check()) {

                $carts = Auth::user()->cart()->get();

                if (!$carts) {
                    return $this->showToast("success", "No carts to clear");
                }

                $delete =  $carts->delete();

                if ($delete) {
                    return $this->showToast("success", "User Cart has been cleared");
                }
            } else {

                session()->forget('cart');

                $this->dispatch('cartUpdated');
                return $this->showToast("success", "Cart cleared");
            }
        } catch (Exception $e) {
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

        try {

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
                    return $this->showToast("success", "Cart updated");
                } else {
                    return $this->showToast("failed", "Product is out of stock");
                }
            }

            return $this->showToast("error", "Item not found in cart");
        } catch (\Exception $e) {
            return $this->showToast("error", "Something went wrong while updating the cart");
        }
    }

    public function decSessionCart($id)
    {

        try {
            $cart = session()->get('cart', []);


            if (array_key_exists($id, $cart)) {

                if ($cart[$id]['quantity'] > 1) {
                    $cart[$id]['quantity'] -= 1;

                    session()->put('cart', $cart);

                    $this->dispatch('cartUpdated');

                    return $this->showToast("success", "Cart updated");
                }
            }
        } catch (\Exception $e) {
            return $this->showToast("error", "Something went wrong while updating the cart");
        }
    }

    public function removeFromSessionCart($id)
    {
        try {
            $cart = session()->get('cart', []);

            if (array_key_exists($id, $cart)) {

                unset($cart[$id]);

                session()->put('cart', $cart);

                $this->dispatch('cartUpdated');
            }
        } catch (\Exception $e) {
            return $this->showToast("error", "Something went wrong while updating the cart");
        }
    }
}
