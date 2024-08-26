<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
        // $this->middleware('auth')->only('logout');
    }

    public function index(){
        return view("admin.login");
    }

    public function login(Request $request)
    {

        $this->validate($request, [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);


        if (!Auth::attempt($request->only("email", "password", true))) {
            return back()->with("error", "User was not able to login.");
        }


        return redirect()->route("admin-dashboard");
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route("login");
    }
}
