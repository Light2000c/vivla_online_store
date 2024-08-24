<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class Favourites extends Component
{
    public function render()
    {
        return view('livewire.admin.favourites')->layout("layouts.admin.app");
    }
}
