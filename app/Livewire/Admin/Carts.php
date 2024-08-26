<?php

namespace App\Livewire\Admin;

use App\Models\Cart;
use Livewire\Component;

class Carts extends Component
{
    public $carts;
    public $groupSelect;
    public $selectedItems = [];

    public function mount() {}

    public function render()
    {

        $this->load();

        return view('livewire.admin.carts', [
            "carts" => $this->carts,
        ])->layout("layouts.admin.app");
    }

    public function load()
    {
        $this->carts = Cart::orderBy("created_at", "DESC")->get();
    }

    public function delete($id)
    {

        $cart = Cart::find($id);

        if (!$cart) {
            return $this->showToast("error", "cart was not successfully deleted");
        }

        $deleted = $cart->delete();

        if (!$deleted) {
            return $this->showToast("error", "cart was not successfully deleted");
        }

        $this->load();
        return $this->showToast("success", "cart has been deleted");
    }

    public function deleteSelected()
    {
        if (empty($this->selectedItems)) {
            return $this->showToast("info", "you haven't selected any item yet!");
        }

        $delete = Cart::whereIn("id", $this->selectedItems)->delete();

        if (!$delete) {
            return $this->showToast("error", "carts was not successfully deleted");
        }

        $this->load();
        $this->resetValue();
        return $this->showToast("success", "carts has been deleted");
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
