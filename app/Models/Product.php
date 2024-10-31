<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Review;
use App\Models\Wishlist;
use App\Models\ProductSize;
use App\Models\ProductImage;
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
        "product_size_id"
    ];


    public function cart()
    {
        return $this->hasMany(Cart::class);
    }

    public function hasCart(User $user)
    {
        return $this->cart->contains("user_id", $user->id);
    }

    public function hasCartWithSize(User $user, $product_size_id)
    {
        return $this->cart->contains(function ($item) use ($user, $product_size_id) {
            return $item->user_id === $user->id && $item->product_size_id === $product_size_id;
        });
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

    public function outOfStock()
    {
        return $this->quantity == 0;
    }

    public function review()
    {
        return $this->hasMany(Review::class);
    }

    public function image()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function size()
    {
        return $this->hasMany(ProductSize::class);
    }
}
