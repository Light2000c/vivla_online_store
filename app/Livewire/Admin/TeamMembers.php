<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TeamMembers extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    private $teamMembers;
    public $activeTeamMember;
    public $groupSelect;
    public $selectedItems = [];

    public $search = "";

    public function render()
    {
        $this->load();

        return view('livewire.admin.team-members', [
            "teamMembers" => $this->teamMembers
        ])->layout("layouts.admin.app");
    }

    public function load()
    {
        if (!$this->search) {
            $this->teamMembers = User::where("role", 1)->orWhere("role", 2)->orderBy("created_at", "DESC")->paginate(10);
        } else {
            $this->teamMembers = User::orderBy("created_at", "DESC")
                ->where("role", 1)
                ->orWhere("role", 2)
                ->where(function ($query) {
                    $query->where("name", "LIKE", '%' . $this->search . '%')
                        ->orWhere("email", "LIKE", '%' . $this->search . '%');
                })
                ->paginate(10);
        }
    }

    public function openCreateModal()
    {
        $this->resetValues();

        return  $this->dispatch("openCreateModal");
    }


    public function openUpdateModal($id)
    {
        $this->resetValues();

        $user = User::find($id);

        if (!$user) {
            return;
        }

        $this->activeTeamMember = $user;
        $this->name = $this->activeTeamMember->name;
        $this->email = $this->activeTeamMember->email;

        return  $this->dispatch("openUpdateModal");
    }

    public function resetValues()
    {
        $this->activeTeamMember = "";
        $this->name = "";
        $this->email = "";
        $this->password = "";
        $this->password_confirmation = "";
    }

    public function resetSelectItem()
    {
        $this->selectedItems = [];
    }

    public function store()
    {

        $this->validate([
            "name" => "required",
            "email" => "required|:max:255|unique:users,email",
            "password" => "required|confirmed",
        ]);

        $user = User::create([
            "name" =>  $this->name,
            "email" => $this->email,
            "password" => Hash::make($this->password),
            "role" => 1,
        ]);

        if (!$user) {
            return $this->showToast("error", "Team member was not successfully added.");
        }

        $this->load();
        $this->dispatch("closeCreateModal");
        $this->resetValues();
        return $this->showToast("success", "Team Member added.");
    }



    public function update()
    {

        if (Auth::user()->role != 2) {
            return $this->showToast("error", "You don't have permission to perform this action");
        }

        $validationRules = [
            "name" => "required",
            "email" => $this->activeTeamMember->email === $this->email ? "required" : "required|max:255|unique:categories,name",
        ];

        if ($this->password) {
            $validationRules["password"] = "required|confirmed";
        }

        $this->validate($validationRules);

        try {

            $user = User::find($this->activeTeamMember->id);

            if (!$user) {
                return $this->showToast("error", "No user found with ID " . $this->activeTeamMember->id);
            }

            $user->name = $this->name;
            $user->email = $this->email;

            if ($this->password) {
                $user->password = Hash::make($this->password);
            }

            $updated = $user->save();

            if (!$updated) {
                return $this->showToast("error", "Member info was not successfully updated.");
            }

            $this->load();
            $this->dispatch("closeUpdateModal");
            $this->resetValues();
            return $this->showToast("success", "Member info updated.");
        } catch (\Exception $e) {
            return $this->showToast("error", "Something went wrong, member info was not successfully updated");
        }
    }

    public function delete($id)
    {

        try {

            if (Auth::user()->role != 2) {
                return $this->showToast("error", "You don't have permission to perform this action");
            }

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
        } catch (\Exception $e) {
            return $this->showToast("error", "Something went wrong, member was not successfully deleted");
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
                return $this->showToast("error", "Member was not successfully deleted");
            }

            $this->load();
            $this->resetSelectItem();
            return $this->showToast("success", "Members has been deleted");
        } catch (\Exception $e) {
            return $this->showToast("error", "Something went wrong, members were not successfully deleted");
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
