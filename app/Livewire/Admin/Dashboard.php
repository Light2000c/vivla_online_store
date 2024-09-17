<?php

namespace App\Livewire\Admin;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Livewire\Component;

class Dashboard extends Component
{
    public $products;
    public $users;
    public $carts;

    public function render()
    {
        $this->load();
        
        return view('livewire.admin.dashboard')->layout("layouts.admin.app");
    }

    public function load(){
        $this->products = Product::get();
        $this->users = User::get();
        $this->carts = Cart::get();
    }
}
