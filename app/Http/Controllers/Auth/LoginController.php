<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;


    protected $redirectTo = '/home';


    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
        // $this->middleware('auth')->only('logout');
    }

    public function index()
    {
        return view("auth.login");
    }

    public function login(Request $request)
    {

        $this->validate($request, [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);


        if (!Auth::attempt($request->only("email", "password", true))) {
            return back()->with("error", "Authentication failed! please check details and try again.");
        }

        $this->moveCartToDb();

        return redirect()->route("home");
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route("home");
    }

    public function moveCartToDb()
    {

        $carts = session()->get('cart', []);

        if (!empty($carts)) {
            foreach ($carts as $id => $item) {

                $product = Product::find($id);

                if (!$product) {
                    continue;
                }

                if ($product->hasCart(Auth::user())) {
                    continue;
                }

                Auth::user()->cart()->create([
                    'product_id' => $id,
                    'quantity' => $item['quantity']
                ]);
            }

            session()->forget('cart');
        }
    }
}
