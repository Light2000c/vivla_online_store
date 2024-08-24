<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class EditAccount extends Component
{
    public function render()
    {
        return view('livewire.admin.edit-account')->layout("layouts.admin.app");
    }
}
