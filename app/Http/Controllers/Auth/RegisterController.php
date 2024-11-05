<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
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

        // dd($request);

        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);


        $user =  User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->full_phone,
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

        try {
            $carts = session()->get('cart', []);

            if (!empty($carts)) {
                foreach ($carts as $id => $item) {

                    $product = Product::find($item['product_id']);

                    if (!$product) {
                        continue;
                    }

                    $sizeId = $item['product_size_id'] ?? null;

                    $cart =  Cart::where("user_id", Auth::user()->id)->where("product_id", $product->id)->where("product_size_id", $sizeId)->first();

                    if ($cart) {
                        continue;
                    }

                    Auth::user()->cart()->create([
                        'product_id' => $item['product_id'],
                        'quantity' => $item['quantity'],
                        'product_size_id' => $sizeId,
                    ]);
                }

                session()->forget('cart');
            }
        } catch (\Exception $e) {
        }
    }
}
