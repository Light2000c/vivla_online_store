<?php

namespace App\Livewire\Pages;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductSize;
use Livewire\Component;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class Products extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';


    private $products = [];
    public $categories;
    public $previousSelected;
    public $selectedCategory = "";
    public $price_range;
    public $hiddenRange;
    public $min_price;
    public $max_price;
    public $filter = "";
    public $product_images = [];

    public $activeProduct;
    public $product_size = [];
    public $size;
    public $selectedSize;
    

    public function mount() {}

    public function render()
    {
        $this->load();

        return view('livewire.pages.products', [
            "products" => $this->products
        ]);
    }

    public function load()
    {

        if ($this->filter == "") {
            $this->products = Product::orderBy("created_at", "DESC")->paginate(16);
            $this->categories = Category::orderBy("created_at", "DESC")->get();
        } else {
            if ($this->selectedCategory && !$this->hiddenRange) {
                $this->products = Product::where("category", 'LIKE', '%' . $this->selectedCategory . '%')->orderBy("created_at", "DESC")->paginate(16);
                $this->categories = Category::orderBy("created_at", "DESC")->get();
            }

            if ($this->selectedCategory && $this->hiddenRange) {
                $this->products = Product::where("category", 'LIKE', '%' . $this->selectedCategory . '%')
                    ->where("price", ">=", $this->min_price)
                    ->where("price", "<=", $this->max_price)
                    ->orderBy("created_at", "DESC")->paginate(16);
            }


            if ($this->selectedCategory && $this->hiddenRange) {
                $this->products = Product::where("price", ">=", $this->min_price)
                    ->where("price", "<=", $this->max_price)
                    ->orderBy("created_at", "DESC")->paginate(16);
            }
        }
    }



    public function updatedHiddenRange()
    {
        // dd($this->hiddenRange);
    }


    public function filterProduct()
    {
        // dd($this->selectedCategory);
        // dd($this->hiddenRange);

        $this->filter = "yes";

        if ($this->hiddenRange) {
            [$this->min_price, $this->max_price] = explode(",", $this->hiddenRange);
        }

        $this->load();
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->selectedCategory = "";
        $this->hiddenRange = "";
        $this->price_range = "";

        $this->filter = "";

        $this->load();
        $this->resetPage();
    }


    public function addToCart($id)
    {

        try {
            $product = Product::find($id);


            if (!$product) {
                return;
            }

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
            return $this->showToast("error", "Something went wrong while updating the cart");
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

            if ($wish) {
                return $this->dispatch('cartUpdated');
            }
        } catch (\Exception $e) {
            return $this->showToast("error", "Something went wrong while updating the cart");
        }
    }

    public function removeFromWishlist($id)
    {
        try {

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
        } catch (\Exception $e) {
            return $this->showToast("error", "Something went wrong while updating the cart");
        }
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


    public function isInCart($productId)
    {
        $sessionCart = session()->get('cart', []);
        return array_key_exists($productId, $sessionCart);
    }

    public function resetModalValues()
    {
        // $this->activeProduct = [];
        // $this->product_size = [];
        $this->selectedSize = "";
    }


    public function openQuickView($productId)
    {
        try{
        $this->resetModalValues();

        $product = Product::find($productId);

        if (!$product) {
            return;
        }

        $this->activeProduct = $product;

        $this->product_images = $product->image()->get();

        $this->getProductSize($product);

        $this->dispatch('openViewModal', ['productId' => $productId]);

    } catch (\Exception $e) {
        return $this->showToast("error", "Something went wrong, please try again.");
    }
    }

    public function getProductSize($product)
    {

        $this->product_size = $product->size()->get();
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


    public function showToast($icon, $title)
    {
        $this->dispatch(
            'message',
            icon: $icon,
            title: $title,
        );
    }


    public function addQuickViewCart($id)
    {

        try{
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

    } catch (\Exception $e) {
        return $this->showToast("error", "Something went wrong, please try again.");
    }
    }



    public function removeQuickViewCart($id)
    {

        try{

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

    } catch (\Exception $e) {
        return $this->showToast("error", "Something went wrong, please try again.");
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

        try{
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

    } catch (\Exception $e) {
        return $this->showToast("error", "Something went wrong, please try again.");
    }
    }



    public function removeQuickViewCartGuest($id)
    {

        try{

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

    } catch (\Exception $e) {
        return $this->showToast("error", "Something went wrong, please try again.");
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
}
