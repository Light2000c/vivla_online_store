<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Address;
use App\Models\Wishlist;
use App\Models\Transaction;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;


    protected $fillable = [
        'name',
        'email',
        'role',
        'password',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
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

    public function address(){
        return $this->hasMany(Address::class);
    }

    public function transaction(){
        return $this->hasMany(Transaction::class);
    }
}
