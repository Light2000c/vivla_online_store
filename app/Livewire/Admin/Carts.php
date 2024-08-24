<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class Carts extends Component
{
    public function render()
    {
        return view('livewire.admin.carts')->layout("layouts.admin.app");
    }
}
