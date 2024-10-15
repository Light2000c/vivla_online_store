<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class EditAccount extends Component
{

    public $name;
    public $email;
    public $current_password;
    public $password;
    public $password_confirmation;

    public function render()
    {

        $this->load();

        return view('livewire.admin.edit-account')->layout("layouts.admin.app");
    }

    public function load()
    {

        $user = Auth::user();

        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function update()
    {

        $user = Auth::user();

        if ($this->current_password || $this->password || $this->password_confirmation) {

            $validate = $this->validate([
                "name" => "required",
                "email" => Auth::user()->email === $this->email ? "required" : "required|unique:users,email",
                "current_password" => "required",
                "password" => "required|confirmed",
            ]);

            $password_match = Hash::check($this->current_password, $user->password);

            if (!$password_match) {
                return $this->addError("current_password", "Old password is incorrect");
            }

            $updated = $user->update([
                "name" => $this->name,
                "email" => $this->email,
                "password" => Hash::make($this->password),
            ]);

            if ($updated) {
                $this->load();
                $this->showToast("success", "Account has been successfully updated");
            }
        } else {
            $validate = $this->validate([
                "name" => "required",
                "email" => Auth::user()->email === $this->email ? "required" : "required|unique:users,email",
            ]);

            $updated = $user->update($validate);

            if ($updated) {
                $this->load();
                $this->showToast("success", "Account has been successfully updated");
            }
        }
    }

    public function showToast($icon, $title)
    {
        $this->dispatch(
            'message',
            icon: $icon,
            title: $title,
        );
    }
}
