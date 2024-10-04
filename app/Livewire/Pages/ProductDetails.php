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
    public $related_products;

    public function mount($id)
    {
        $this->product = Product::find($id);
        $this->related_products = Product::where("category", $this->product->category)->take(5)->get();
    }

    public function render()
    {
        return view('livewire.pages.product-details');
    }

    public function load()
    {
        $this->product = Product::find($this->product->id);
        $this->related_products = Product::where("category", $this->product->category)->take(5)->get();
    }

    public function getCategory($category)
    {
        $categories = explode(",", $category);

        $new_category = "";

        foreach ($categories as $cat) {
            if ($new_category == "") {
                $new_category = $new_category . ' ' . $cat;
            } else {
                $new_category = $new_category . ' | ' . $cat;
            }
        }
        return $new_category;
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
            // $this->emit('triggerShowActive');
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

        if (!Auth::check()) {
            return redirect()->route("login");
        }

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

        if (!Auth::check()) {
            return redirect()->route("login");
        }

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


        if ($cart->product && ($cart->quantity < $cart->product->quantity)) {

            $cart->quantity++;
            $save =  $cart->save();

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

    public function getCartQuantity($id)
    {
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

    public function getSessionCartQuantity($id)
    {
        $cart = session()->get('cart', []);


        if (array_key_exists($id, $cart)) {

            return $cart[$id]['quantity'];
        }
        return 0;
    }


    public function isInCart($productId)
    {
        $sessionCart = session()->get('cart', []);
        return array_key_exists($productId, $sessionCart);
    }
}
