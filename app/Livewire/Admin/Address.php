<?php

namespace App\Livewire\Admin;

use App\Models\Address as ModelsAddress;
use Livewire\Component;

class Address extends Component
{

    public $addresses;
    public $groupSelect;
    public $selectedItems = [];

    public function render()
    {
        $this->load();

        return view('livewire.admin.address', [
            "addresses" => $this->addresses
        ])->layout("layouts.admin.app");
    }

    public function load()
    {
        $address = ModelsAddress::orderBy("created_at", "DESC")->get();
        $this->addresses = $address;
    }

    public function delete($id)
    {

        $address = ModelsAddress::find($id);

        if (!$address) {
            return $this->showToast("error", "address was not successfully deleted");
        }

        $deleted = $address->delete();

        if (!$deleted) {
            return $this->showToast("error", "address was not successfully deleted");
        }

        $this->load();
        return $this->showToast("success", "address has been deleted");
    }

    public function updateselectedItems() {}

    public function deleteSelected()
    {
        if (empty($this->selectedItems)) {
            return $this->showToast("info", "you haven't selected any address yet!");
        }

        $delete = ModelsAddress::whereIn("id", $this->selectedItems)->delete();

        if (!$delete) {
            return $this->showToast("error", "address was not successfully deleted");
        }

        $this->load();
        $this->resetValue();
        return $this->showToast("success", "address has been deleted");
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

