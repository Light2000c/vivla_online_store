<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    private $users;
    public $groupSelect;
    public $selectedItems = [];
    public $activeUser;
    public $activeCart;
    public $activeWishes;

    public $search = "";

    public function render()
    {
        $this->load();

        return view('livewire.admin.users', [
            "users" => $this->users,
        ])->layout("layouts.admin.app");
    }


    public function load()
    {
        if (!$this->search) {
            $this->users = User::where("role", 0)->orderBy("created_at", "DESC")->paginate(10);
        } else {
            $this->users = User::orderBy("created_at", "DESC")
                ->where("role", 0)
                ->where(function ($query) {
                    $query->where("name", "LIKE", '%' . $this->search . '%')
                        ->orWhere("email", "LIKE", '%' . $this->search . '%');
                })
                ->paginate(10);
        }
    }

    public function resetSelectItem()
    {
        $this->selectedItems = [];
    }

    public function delete($id)
    {
        try {

            if (Auth::user()->role != 2) {
                return $this->showToast("error", "You don't have permission to perform this action");
            }

            $user = User::find($id);

            if (!$user) {
                return $this->showToast("error", "User was not successfully deleted");
            }

            $deleted = $user->delete();

            if (!$deleted) {
                return $this->showToast("error", "User was not successfully deleted");
            }

            $this->load();
            return $this->showToast("success", "User has been deleted");
        } catch (\Exception $e) {
            return $this->showToast("error", "Something went wrong, User was not successfully deleted");
        }
    }


    public function deleteSelected()
    {
        try {

            if (empty($this->selectedItems)) {
                return $this->showToast("info", "you haven't selected any member yet!");
            }

            if (Auth::user()->role != 2) {
                return $this->showToast("error", "You don't have permission to perform this action");
            }

            $delete = User::whereIn("id", $this->selectedItems)->delete();

            if (!$delete) {
                return $this->showToast("error", "Users were not successfully deleted");
            }

            $this->load();
            $this->resetSelectItem();
            return $this->showToast("success", "Users has been deleted");
        } catch (\Exception $e) {
            return $this->showToast("error", "Something went wrong, Users were not successfully deleted");
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

    public function viewUser($id)
    {

        $this->resetValues();

        $user = User::find($id);

        if (!$user) {
            return;
        }

        $this->activeUser = $user;
        $this->activeCart = $user->cart()->get();
        $this->activeWishes = $user->wishlist()->get();


        $this->dispatch("openViewModal");
    }

    public function resetValues()
    {
        $this->activeUser = "";
        $this->activeCart = "";
        $this->activeWishes = "";
    }
}
