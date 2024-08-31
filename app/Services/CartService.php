<?php

namespace App\Services;

use App\Models\Cart;

class CartService
{

    public static function updateCart($id, $value)
    {
        if ($value < 1) {
            return;
        }

        $cart = Cart::find($id);

        if (!$cart) {
            return;
        }

        if ($value < 1) {
            return;
        }

        $cart->quantity = $value;
        $save = $cart->save();

        return $save;
    }

    public static function inc($id)
    {

        $cart = Cart::find($id);

        if (!$cart) {
            return;
        }

        $cart->quantity++;
        $save =  $cart->save();

        return $save;
    }

    public static function dec($id)
    {
        $cart = Cart::find($id);

        if (!$cart) {
            return;
        }

        if ($cart->quantity == 1) {
            return;
        }

        $cart->quantity--;
        $save = $cart->save();

        return $save;
    }

    public static function delete($id){

        $cart = Cart::find($id);

        if (!$cart) {
            return;
        }

        $delete = $cart->delete();

        return $delete;
    }
}
