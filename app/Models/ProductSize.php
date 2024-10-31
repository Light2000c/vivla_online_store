<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\Size;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductSize extends Model
{
    use HasFactory;

    protected $fillable = [
        "product_id",
        "size_id",
        "quantity"
    ];


    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    public function cart()
    {
        return $this->hasMany(Cart::class);
    }

    public function hasSize($sizeId)
    {
        return $this->contains("size_id", $sizeId);
    }
}
