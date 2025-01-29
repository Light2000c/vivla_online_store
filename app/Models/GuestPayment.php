<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuestPayment extends Model
{
    use HasFactory;

    public $fillable = [
        "name",
        "amount",
        "reference",
        "currency",
        "type",
    ];
}
