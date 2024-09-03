<?php

namespace App\Livewire\Pages;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
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
    public $selectedCategory = null;
    public $range;

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

        if ($this->selectedCategory) {
            $this->products = Product::where("category", $this->selectedCategory)->orderBy("created_at", "DESC")->paginate(10);
            $this->categories = Category::orderBy("created_at", "DESC")->get();
        } else {
            $this->products = Product::orderBy("created_at", "DESC")->paginate(10);
            $this->categories = Category::orderBy("created_at", "DESC")->get();
        }
    }




    public  function filterProduct()
    {
        // dd($this->selectedCategory);
        // dd($this->range);

        // return redirect()->route('products', ['category' => $this->selectedCategory]);

        if ($this->selectedCategory == $this->previousSelected) {
            return;
        }

        $this->load();
        $this->previousSelected = $this->selectedCategory;
        $this->resetPage();
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
