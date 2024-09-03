<?php

namespace App\Livewire\Admin;

use App\Models\Address as ModelsAddress;
use Livewire\Component;
use Livewire\WithPagination;

class Address extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    private $addresses;
    public $groupSelect;
    public $selectedItems = [];
    public $search = "";

    public function render()
    {
        $this->load();

        return view('livewire.admin.address', [
            "addresses" => $this->addresses
        ])->layout("layouts.admin.app");
    }

    public function load()
    {


        // $this->addresses = ModelsAddress::orderBy("created_at", "DESC")->paginate(10); 

        if (!$this->search) {
            $address = ModelsAddress::orderBy("created_at", "DESC")->paginate(10);
            $this->addresses = $address;
        } else {
            $address = ModelsAddress::orderBy("created_at", "DESC")
                ->where("firstname", "LIKE", '%' . $this->search . '%')
                ->orWhere("firstname", "LIKE", '%' . $this->search . '%')
                ->orWhere("street", "LIKE", '%' . $this->search . '%')
                ->orWhere("city", "LIKE", '%' . $this->search . '%')
                ->orWhere("country", "LIKE", '%' . $this->search . '%')
                ->orWhere("phone", "LIKE", '%' . $this->search . '%')
                ->paginate(10);
            $this->addresses = $address;
        }
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
