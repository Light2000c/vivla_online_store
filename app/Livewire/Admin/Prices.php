<?php

namespace App\Livewire\Admin;

use App\Models\Price;
use Livewire\Component;
use Livewire\WithPagination;

class Prices extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $name;
    public $price;
    private $prices;
    public $activeprice;
    public $groupSelect;
    public $selectedItems = [];

    public $search = "";

    public function render()
    {
        $this->load();
        return view('livewire.admin.prices', [
            "prices" => $this->prices,
        ])->layout("layouts.admin.app");
    }

    public function load()
    {
        if (!$this->search) {
            $this->prices = Price::orderBy("created_at", "DESC")->paginate(10);
        } else {
            $this->prices = Price::orderBy("created_at", "DESC")
                ->where("name", "LIKE", '%' . $this->search . '%')
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

        $price = Price::find($id);

        if (!$price) {
            return;
        }

        $this->activeprice = $price;
        $this->name = $this->activeprice->name;
        $this->price = $this->activeprice->price;

        return  $this->dispatch("openUpdateModal");
    }

    public function resetValues()
    {
        $this->activeprice = "";
        $this->name = "";
        $this->price = "";
    }

    public function resetSelectItem()
    {
        $this->selectedItems = [];
    }

    public function store()
    {

        $this->validate([
            "name" => "required|unique:prices,name",
            "price" => "required|numeric|min:0",
        ]);

        try {

            $price = Price::create([
                "name" =>  $this->name,
                "price" =>  $this->price
            ]);

            if (!$price) {
                return $this->showToast("error", "price was not successfully added.");
            }

            $this->load();
            $this->dispatch("closeCreateModal");
            $this->resetValues();
            return $this->showToast("success", "price has been added.");
        } catch (\Exception $e) {
            return $this->showToast("error", "Something went wrong, please try again.");
        }
    }



    public function update()
    {

        $validationRules = [
            "name" => "required|unique:prices,name",
            "price" => "required|numeric|min:0",
        ];

        $this->validate($validationRules);

        try {

            $price = Price::find($this->activeprice->id);

            if (!$price) {
                return $this->showToast("error", "No price found with ID " . $this->activeprice->id);
            }

            $price->name = $this->name;
            $price->price = $this->price;

            $updated = $price->save();

            if (!$updated) {
                return $this->showToast("error", "price was not successfully updated.");
            }

            $this->load();
            $this->dispatch("closeUpdateModal");
            $this->resetValues();
            return $this->showToast("success", "price has been updated.");
        } catch (\Exception $e) {
            return $this->showToast("error", "Something went wrong, price was not successfully updated");
        }
    }

    public function delete($id)
    {

        try {

            $price = Price::find($id);

            if (!$price) {
                return $this->showToast("error", "price was not successfully deleted");
            }

            $deleted = $price->delete();

            if (!$deleted) {
                return $this->showToast("error", "price was not successfully deleted");
            }

            $this->load();
            return $this->showToast("success", "price has been deleted");
        } catch (\Exception $e) {
            return $this->showToast("error", "Something went wrong, price was not successfully deleted");
        }
    }

    public function deleteSelected()
    {

        try {

            if (empty($this->selectedItems)) {
                return $this->showToast("info", "you haven't selected any price yet!");
            }

            $delete = Price::whereIn("id", $this->selectedItems)->delete();

            if (!$delete) {
                return $this->showToast("error", "price was not successfully deleted");
            }

            $this->load();
            $this->resetSelectItem();
            return $this->showToast("success", "prices has been deleted");
        } catch (\Exception $e) {
            return $this->showToast("error", "Something went wrong, prices were not successfully deleted");
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
