<?php

use App\Http\Controllers\Admin\LoginController as AdminLoginController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Payment\StripeController;
use App\Livewire\Admin\AddProducts;
use App\Livewire\Admin\Address;
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
use App\Livewire\Pages\Order;
use App\Livewire\Pages\ProductDetails;
use App\Livewire\Pages\Products as PagesProducts;
use App\Livewire\Pages\Wishlist;
use App\Livewire\Profile\Dashboard as ProfileDashboard;
use Illuminate\Support\Facades\Artisan;
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

Route::get("/reset-password", function () {
    return view("auth.passwords.email");
})->name("reset-password");


Auth::routes(['verify' => true]);




//Auth Routes
Route::get("login", [LoginController::class, "index"])->name("login");
Route::post("login", [LoginController::class, "login"]);

// Route::post("logout", [LoginController::class, "logout"]);

Route::get("register", [RegisterController::class, "index"])->name("register");
Route::post("register", [RegisterController::class, "store"]);

Route::get("admin/login", [AdminLoginController::class, "index"])->name("admin-login");
Route::post("admin/login", [AdminLoginController::class, "login"]);

Route::get("about", About::class)->name("about");

Route::get("contact-us", Contact::class)->name("contact");

Route::post("logout", [LoginController::class, "logout"])->name("logout")->middleware("auth");

//Pages Routes
Route::get("/", Home::class);

Route::get("/home", Home::class)->name("home");

Route::get("shop", PagesProducts::class)->name("products");

Route::get("shop/{id}", ProductDetails::class)->name("product-detail");

Route::get("cart", Cart::class)->name("cart");


Route::group(["middleware" => ["auth", "verified"]], function () {
    // Route::group(["middleware" => "auth"], function () {

    Route::get("wishlist", Wishlist::class)->name("wishlist");

    Route::get("checkout", Checkout::class)->name("checkout");

    Route::get("order/{id}", Order::class)->name("order");

    //Profile
    Route::get("account", ProfileDashboard::class)->name("dashboard");


    // payment
    Route::post('/pay', [StripeController::class, 'checkout'])->name('pay');
    Route::get('/pay/success', [StripeController::class, 'success'])->name('checkout.success');
    Route::get('/pay/cancel', [StripeController::class, 'cancel'])->name('checkout.cancel');
});




//admin routes

Route::group(["middleware" => ["auth", "is_admin"]], function () {

    Route::get("admin/dashboard", Dashboard::class)->name("admin-dashboard");

    Route::get("admin/products", Products::class)->name("admin-product");

    Route::get("admin/add-product", AddProducts::class)->name("add-product");

    Route::get("admin/products/{id}", EditProduct::class)->name("edit-product");

    Route::get("admin/categories", Category::class)->name("admin-categories");

    Route::get("admin/carts", Carts::class)->name("admin-cart");

    Route::get("admin/wishlists", Favourites::class)->name("admin-wishlist");

    Route::get("admin/orders/{id}", Orders::class)->name("admin-order");

    Route::get("admin/team-members", TeamMembers::class)->name("team-member");

    Route::get("admin/users", Users::class)->name("users");

    Route::get("admin/address", Address::class)->name("admin-address");

    Route::get("admin/account", EditAccount::class)->name("edit-account");

    Route::get("admin/transactions", Transactions::class)->name("admin-transaction");

    Route::get("admin/payments", Payments::class)->name("admin-payment");

    Route::post("logout", [AdminLoginController::class, "logout"])->name("admin-logout");
});


//Payment controller
// Route::get('/pay', [StripeController::class, 'index'])->name('pay');
// Route::post('pay-checkout', [StripeController::class, 'checkout']);
