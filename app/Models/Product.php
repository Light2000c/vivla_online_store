<?php

namespace App\Models;

use App\Models\Cart;
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


    public function cart(){
        return $this->hasMany(Cart::class);
    }

    public function order(){
        return $this->hasMany(Order::class);
    }

    public function wishlist(){
        return $this->hasMany(Wishlist::class);
    }
}
