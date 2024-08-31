<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class Users extends Component
{
    private $users;
    public $groupSelect;
    public $selectedItems = [];
    public $activeUser;
    public $activeCart;
    public $activeWishes;

    public function render()
    {
        $this->load();

        return view('livewire.admin.users', [
            "users" => $this->users,
        ])->layout("layouts.admin.app");
    }


    public function load()
    {
        $this->users = User::where("role", "!=", 1)->orderBy("created_at", "DESC")->get();
    }

    public function resetSelectItem()
    {
        $this->selectedItems = [];
    }

    public function delete($id)
    {

        $user = User::find($id);

        if (!$user) {
            return $this->showToast("error", "Member was not successfully deleted");
        }

        $deleted = $user->delete();

        if (!$deleted) {
            return $this->showToast("error", "Member was not successfully deleted");
        }

        $this->load();
        return $this->showToast("success", "Member has been deleted");
    }


    public function deleteSelected()
    {
        if (empty($this->selectedItems)) {
            return $this->showToast("info", "you haven't selected any member yet!");
        }

        $delete = User::whereIn("id", $this->selectedItems)->delete();

        if (!$delete) {
            return $this->showToast("error", "Member was not successfully deleted");
        }

        $this->load();
        $this->resetSelectItem();
        return $this->showToast("success", "Members has been deleted");
    }

    public function showToast($icon, $title)
    {
        $this->dispatch(
            'message',
            icon: $icon,
            title: $title,
        );
    }

    public function viewUser($id){

        $this->resetValues();

        $user = User::find($id);

        if(!$user){
            return;
        }

        $this->activeUser = $user;
        $this->activeCart = $user->cart()->get();
        $this->activeWishes = $user->wishlist()->get();


        $this->dispatch("openViewModal");
    }

    public function resetValues(){
        $this->activeUser = "";
        $this->activeCart = "";
        $this->activeWishes = "";
    }
}
