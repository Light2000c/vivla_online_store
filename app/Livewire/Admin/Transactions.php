<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class Transactions extends Component
{
    public function render()
    {
        return view('livewire.admin.transactions')->layout("layouts.admin.app");
    }
}
