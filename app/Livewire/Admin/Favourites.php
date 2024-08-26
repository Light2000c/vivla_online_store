<?php

namespace App\Livewire\Admin;

use App\Models\Wishlist;
use Livewire\Component;

class Favourites extends Component
{

    public $wishlists;
    public $groupSelect;
    public $selectedItems = [];

    public function render()
    {

        $this->load();

        return view('livewire.admin.favourites', [
            "wishlists" => $this->wishlists
        ])->layout("layouts.admin.app");
    }

    public function load()
    {
        $wishlist = Wishlist::orderBy("created_at", "DESC")->get();
        $this->wishlists = $wishlist;
    }

    public function delete($id)
    {

        $wishlist = Wishlist::find($id);

        if (!$wishlist) {
            return $this->showToast("error", "wish was not successfully deleted");
        }

        $deleted = $wishlist->delete();

        if (!$deleted) {
            return $this->showToast("error", "wish was not successfully deleted");
        }

        $this->load();
        return $this->showToast("success", "wish has been deleted");
    }

    public function updateselectedItems() {}

    public function deleteSelected()
    {
        if (empty($this->selectedItems)) {
            return $this->showToast("info", "you haven't selected any item yet!");
        }

        $delete = Wishlist::whereIn("id", $this->selectedItems)->delete();

        if (!$delete) {
            return $this->showToast("error", "wishes was not successfully deleted");
        }

        $this->load();
        $this->resetValue();
        return $this->showToast("success", "wishes has been deleted");
    }

    public function resetValue()
    {
        $this->selectedItems = [];
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
