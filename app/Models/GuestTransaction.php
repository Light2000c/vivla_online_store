<?php

namespace App\Models;

use App\Models\GuestOrder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GuestTransaction extends Model
{
    use HasFactory;

    public $fillable = [
        "name",
        "email",
        "phone",
        "street",
        "city",
        "country",
        "reference",
        "status",
    ];

    public function guestOrder(){
        return $this->hasMany(GuestOrder::class);
    }
}
