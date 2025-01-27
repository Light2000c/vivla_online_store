<?php

namespace App\Models;

use App\Models\Product;
use App\Models\ProductSize;
use App\Models\GuestTransaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GuestOrder extends Model
{
    use HasFactory;

    public $fillable = [
        "guest_transaction_id",
        "product_id",
        "product_size_id",
        "price",
        "quantity",
        "total",
    ];

    public function guestTransaction(){
        return $this->belongsTo(GuestTransaction::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function productSize(){
        return $this->belongsTo(ProductSize::class);
    }
}
