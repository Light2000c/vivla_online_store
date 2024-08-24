<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class TeamMembers extends Component
{
    public function render()
    {
        return view('livewire.admin.team-members')->layout("layouts.admin.app");
    }
}
