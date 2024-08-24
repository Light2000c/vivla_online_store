<?php

use App\Http\Controllers\admin\LoginController as AdminLoginController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Livewire\Admin\AddProducts;
use App\Livewire\Admin\Carts;
use App\Livewire\Admin\Category;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\EditAccount;
use App\Livewire\Admin\EditProduct;
use App\Livewire\Admin\Favourites;
use App\Livewire\Admin\Orders;
use App\Livewire\Admin\Payments;
use App\Livewire\Admin\Products;
use App\Livewire\Admin\TeamMembers;
use App\Livewire\Admin\Transactions;
use App\Livewire\Admin\Users;
use App\Livewire\Pages\About;
use App\Livewire\Pages\Cart;
use App\Livewire\Pages\Checkout;
use App\Livewire\Pages\Contact;
use App\Livewire\Pages\Home;
use App\Livewire\Pages\ProductDetails;
use App\Livewire\Pages\Products as PagesProducts;
use App\Livewire\Pages\Wishlist;
use App\Livewire\Profile\Dashboard as ProfileDashboard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//Auth Routes
Route::get("login", [LoginController::class, "index"])->name("login");

Route::get("register", [RegisterController::class, "index"])->name("register");

Route::get("admin/login", [AdminLoginController::class, "index"])->name("admin-login");


//Pages Routes
Route::get("/", Home::class)->name("home");

Route::get("/home", Home::class)->name("home");

Route::get("shop", PagesProducts::class)->name("products");

Route::get("shop/1", ProductDetails::class)->name("peoduct-detail");

Route::get("cart", Cart::class)->name("cart");

Route::get("wishlist", Wishlist::class)->name("wishlist");

Route::get("about", About::class)->name("about");

Route::get("contact-us", Contact::class)->name("contact");

Route::get("checkout", Checkout::class)->name("checkout");



//Profile
Route::get("account", ProfileDashboard::class)->name("dashboard");




//admin routes

Route::get("admin/dashboard", Dashboard::class)->name("admin-dashboard");

Route::get("admin/products", Products::class)->name("admin-product");

Route::get("admin/add-product", AddProducts::class)->name("add-product");

Route::get("admin/products/{id}", EditProduct::class)->name("edit-product");

Route::get("admin/categories", Category::class)->name("admin-categories");

Route::get("admin/carts", Carts::class)->name("admin-cart");

Route::get("admin/wishlists", Favourites::class)->name("admin-wishlist");

Route::get("admin/orders", Orders::class)->name("admin-order");

Route::get("admin/team-members", TeamMembers::class)->name("team-member");

Route::get("admin/users", Users::class)->name("users");

Route::get("admin/account", EditAccount::class)->name("edit-account");

Route::get("admin/transactions", Transactions::class)->name("admin-transaction");

Route::get("admin/payments", Payments::class)->name("admin-payment");
