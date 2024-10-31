<?php

namespace App\Livewire\Pages;

use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\Review;
use App\Models\Wishlist;
use App\Services\CartService;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ProductDetails extends Component
{
    public $product;
    public $related_products;
    public $reviews;

    public $review;
    public $activeTab = 'description';

    public $product_size = [];
    public $size;
    public $selectedSize;
    public $product_images = [];


    public function mount($id)
    {
        $this->product = Product::find($id);
        $this->related_products = Product::where("category", "LIKE", "%" . $this->product->category . "%")
            ->whereNot("id", $this->product->id)->take(5)->get();
        $this->reviews = $this->product->review()->get();
        $this->product_size = $this->product->size()->get();
        $this->product_images = $this->product->image()->get();
    }

    public function render()
    {
        return view('livewire.pages.product-details');
    }

    public function load()
    {
        $this->product = Product::find($this->product->id);
        $this->related_products = Product::where("category", "LIKE", "%" . $this->product->category . "%")
            ->whereNot("id", $this->product->id)->take(5)->get();
        $this->reviews = $this->product->review()->get();
        $this->product_size = $this->product->size()->get();
        $this->product_images = $this->product->image()->get();
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

        try {

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
            return $this->showToast("error", "Something went wrong while updating the wishlist");
        }
    }


    public function addToWishlist($id)
    {

        try {

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
        } catch (\Exception $e) {
            return $this->showToast("error", "Something went wrong while updating the wishlist");
        }
    }

    public function removeFromWishlist($id)
    {

        try {

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

                // if ($delete) {
                //     return $this->dispatch('cartUpdated');
                // }
            }
        } catch (\Exception $e) {
            return $this->showToast("error", "Something went wrong while updating the cart");
        }
    }


    public function update($id, $value)
    {

        try {

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
        } catch (\Exception $e) {
            return $this->showToast("error", "Something went wrong while updating the cart");
        }
    }


    public function inc($id)
    {

        try {

            $product = Product::find($id);

            if (!$product) {
                return;
            }


            if ($product->size()->count()) {
                if (!$this->selectedSize) {
                    return;
                }
                $cart = Cart::where("user_id", Auth::user()->id)->where("product_id", $id)
                    ->where("product_size_id", $this->selectedSize->id)->first();
            } else {
                $cart = Cart::where("user_id", Auth::user()->id)->where("product_id", $id)->first();
            }

            if (!$cart) {
                return;
            }

            $quantity_check = $product->size()->count() ? $cart->quantity < $cart->productSize->quantity : $cart->quantity < $cart->product->quantity;

            if ($cart->product && $quantity_check) {

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
        } catch (\Exception $e) {
            return $this->showToast("error", "Something went wrong while updating the cart");
        }
    }

    public function dec($id)
    {
        try {

            $product = Product::find($id);

            if (!$product) {
                return;
            }

            if ($product->size()->count()) {
                if (!$this->selectedSize) {
                    return;
                }
                $cart = Cart::where("user_id", Auth::user()->id)->where("product_id", $id)
                    ->where("product_size_id", $this->selectedSize->id)->first();
            } else {
                $cart = Cart::where("user_id", Auth::user()->id)->where("product_id", $id)->first();
            }

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
        } catch (\Exception $e) {
            return $this->showToast("error", "Something went wrong while updating the cart");
        }
    }

    public function getCartQuantity($id)
    {

        $product = Product::find($id);

        if (!$product) {
            return null;
        }


        if ($product->size()->count()) {
            if (!$this->selectedSize) {
                return;
            }
            $cart = Cart::where("user_id", Auth::user()->id)->where("product_id", $id)
                ->where("product_size_id", $this->selectedSize->id)->first();
        } else {
            $cart = Cart::where("user_id", Auth::user()->id)->where("product_id", $id)->first();
        }

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

        try {
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


    public function incSessionCart($id)
    {

        try {

            $cart = session()->get('cart', []);

            $product = Product::find($id);

            if (!$product) {
                return;
            }

            if ($product->size()->count()) {
                $productId = $product->id;
                $productSizeId = $this->selectedSize->id ?? null;

                $key = $productId . ($productSizeId ? "_{$productSizeId}" : "");
            } else {
                $key = $product->id;
            }

            if (array_key_exists($key, $cart)) {

                $quantity = $product->size()->count() ? $this->selectedSize->quantity : $product->quantity;

                if ($cart[$key]['quantity'] < $quantity) {
                    $cart[$key]['quantity'] += 1;

                    session()->put('cart', $cart);

                    $this->dispatch('cartUpdated');
                } else {
                    return $this->showToast("failed", "Product is out of stock");
                }
            }
        } catch (\Exception $e) {
            return $this->showToast("error", "Something went wrong while updating the cart");
        }
    }


    public function decSessionCart($id)
    {
        try {

            $cart = session()->get('cart', []);

            $product = Product::find($id);

            if (!$product) {
                return;
            }

            if ($product->size()->count()) {
                $productId = $product->id;
                $productSizeId = $this->selectedSize->id ?? null;

                $key = $productId . ($productSizeId ? "_{$productSizeId}" : "");
            } else {
                $key = $product->id;
            }

            if (array_key_exists($key, $cart)) {

                if ($cart[$key]['quantity'] > 1) {
                    $cart[$key]['quantity'] -= 1;

                    session()->put('cart', $cart);

                    $this->dispatch('cartUpdated');
                }
            }

            return false;
        } catch (\Exception $e) {
            return $this->showToast("error", "Something went wrong while updating the cart");
        }
    }


    public function getSessionCartQuantity($id)
    {
        $cart = session()->get('cart', []);

        $product = Product::find($id);

        if (!$product) {
            return;
        }

        if ($product->size()->count()) {
            $productId = $product->id;
            $productSizeId = $this->selectedSize->id ?? null;

            $key = $productId . ($productSizeId ? "_{$productSizeId}" : "");
        } else {
            $key = $product->id;
        }

        if (array_key_exists($key, $cart)) {
            return $cart[$key]['quantity'] ?? null;
        }


        return 0;
    }


    public function isInCart($productId)
    {
        $sessionCart = session()->get('cart', []);
        return array_key_exists($productId, $sessionCart);
    }

    public function setTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function addReview()
    {


        $this->setTab("review");

        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (!Auth::user()->hasVerifiedEmail()) {
            return redirect()->route('verification.notice');
        }

        $this->validate([
            "review" => "required|max:500",
        ]);

        try {

            $review = auth()->user()->review()->create([
                "product_id" => $this->product->id,
                "review" => $this->review,
            ]);

            if ($review) {
                $this->load();
                $this->review = "";
                return $this->showToast("success", "Review was successfully added");
            } else {
                return $this->showToast("error", "Something went wrong while trying to add review.");
            }
        } catch (\Exception $e) {
            return $this->showToast("error", "Something went wrong while trying to add review.");
        }
    }

    public function deleteReview($id)
    {

        $this->setTab("review");

        if (!Auth::check()) {
            return redirect()->route('login');
        }

        try {

            $review = Review::find($id);

            if ($review && $review->user()->is(Auth::user())) {

                $delete = $review->delete();

                if ($delete) {
                    $this->load();
                    return $this->showToast("success", "Review was successfully deleted");
                } else {
                    return $this->showToast("error", "Review was not successfully deleted.");
                }
            }
        } catch (\Exception $e) {
            return $this->showToast("error", "Something went wrong while trying delete review.");
        }
    }

    public function setSizeQuantity()
    {

        $size = ProductSize::find($this->size);

        if (!$size) {
            return "";
        }

        $this->selectedSize = $size ?? "";
    }

    public function sizeChanged()
    {
        // dd($this->size);
        $this->setSizeQuantity();
    }


    public function addQuickViewCart($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return;
        }

        $user = Auth::user();
        $size = $product->size()->get();

        if ($size->count()) {
            if ($this->selectedSize) {

                if ($product->hasCartWithSize($user, $this->selectedSize->id)) {
                    return;
                }

                $cart =  $user->cart()->create([
                    "product_id" => $product->id,
                    "product_size_id" => $this->selectedSize->id
                ]);

                if ($cart) {
                    $this->showToast("success", "Product has been added to cart");
                    return $this->dispatch('cartUpdated');
                }
            } else {
                return $this->showToast("info", "Please select a size");
            }
        }
    }



    public function removeQuickViewCart($id)
    {

        $product = Product::find($id);

        if (!$product) {
            return;
        }

        $user = Auth::user();
        $size = $product->size()->get();

        if ($size->count()) {
            if ($this->selectedSize) {

                $cart = $user->cart()->where("product_size_id", $this->selectedSize->id)->first();

                if (!$cart) {
                    return $this->showToast("info", "Cart was not found");
                }

                $deleted = $cart->delete();


                if ($deleted) {
                    $this->showToast("success", "Product has been removed from cart");
                    return $this->dispatch('cartUpdated');
                }
            } else {
                return $this->showToast("info", "Please select a size");
            }
        }
    }


    public function hasCartWithSize($id)
    {

        $product = Product::find($id);

        return $product->hasCartWithSize(Auth::user(), $this->selectedSize->id ?? "");
    }


    public function hasCart($id)
    {

        $product = Product::find($id);

        return $product->hasCart(Auth::user());
    }


    public function addQuickViewCartGuest($id)
    {

        $product = Product::find($id);

        if (!$product) {
            return;
        }

        $user = Auth::user();
        $size = $product->size()->get();

        if ($size->count()) {
            if ($this->selectedSize) {

                if ($this->isInQuickViewCart($product->id, $this->selectedSize->id)) {
                    // return;
                    return $this->showToast("info", "Product already exist in cart");
                }

                $cart = session()->get('cart', []);

                if (array_key_exists($id, $cart)) {
                    return;
                }

                $key = $product->id . (isset($this->selectedSize) ? "_{$this->selectedSize->id}" : "");

                $cart[$key] = [
                    'product_id' => $product->id,
                    'quantity' => 1,
                    'price' => $product->price,
                    'product_size_id' => $this->selectedSize->id ?? null,
                ];


                session()->put('cart', $cart);

                return $this->dispatch('cartUpdated');
            } else {
                return $this->showToast("info", "Please select a size");
            }
        }
    }



    public function removeQuickViewCartGuest($id)
    {

        $product = Product::find($id);

        if (!$product) {
            return;
        }

        $size = $product->size()->get();

        if ($size->count()) {
            if ($this->selectedSize) {

                $cart = session()->get('cart', []);

                $productId = $product->id;
                $productSizeId = $this->selectedSize->id ?? null;


                $key = $productId . ($productSizeId ? "_{$productSizeId}" : "");


                if (array_key_exists($key, $cart)) {
                    unset($cart[$key]);
                    session()->put('cart', $cart);

                    return $this->dispatch('cartUpdated');
                }
            } else {
                return $this->showToast("info", "Please select a size");
            }
        }
    }


    public function isInQuickViewCart($productId, $productSizeId)
    {
        $sessionCart = collect(session()->get('cart', []));

        return $sessionCart->contains(function ($item) use ($productId, $productSizeId) {
            return $item['product_id'] === $productId && $item['product_size_id'] === $productSizeId;
        });
    }


    public function showAdd($productId)
    {
        $productSizeId = $this->selectedSize->id ?? "";
        $sessionCart = collect(session()->get('cart', []));

        return $sessionCart->contains(function ($item) use ($productId, $productSizeId) {
            return $item['product_id'] === $productId && $item['product_size_id'] === $productSizeId;
        });
    }
}
