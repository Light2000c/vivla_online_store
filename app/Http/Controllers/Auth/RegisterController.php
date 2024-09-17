<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;


    protected $redirectTo = '/home';


    public function __construct()
    {
        // $this->middleware('guest');
    }


    public function index()
    {
        return view("auth.register");
    }


    public function store(Request $request)
    {

        // $fullPhoneNumber = $request->input('full_phone');

        // dd($fullPhoneNumber);

        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);


        $user =  User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if (!$user) {
            return back()->with("error", "Something went wrong, please try again.");
        }

        if (!Auth::attempt($request->only("email", "password", true))) {
            return back()->with("error", "Authentication failed! please check details and try again.");
        }

        $this->moveCartToDb();

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
