<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Wishlist;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    public $fillable = [
        "name",
        "price",
        "quantity",
        "discount",
        "brand",
        "tag",
        "category",
        "image",
        "description",
    ];


    public function cart()
    {
        return $this->hasMany(Cart::class);
    }

    public function hasCart(User $user)
    {
        return $this->cart->contains("user_id", $user->id);
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function hasWish(User $user)
    {
        return $this->wishlist->contains("user_id", $user->id);
    }
}
