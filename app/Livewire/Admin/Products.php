<?php

namespace App\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;

class Products extends Component
{

    private $products;
    public $groupSelect;
    public $selectedItems = [];

    public function render()
    {
        $this->load();

        return view('livewire.admin.products', [
            "products" => $this->products,
        ])->layout("layouts.admin.app");
    }

    public function load()
    {
        $product = Product::orderBy("created_at", "DESC")->get();
        $this->products = $product;
    }

    public function updateselectedItems() {}

    public function deleteSelected()
    {
        if (empty($this->selectedItems)) {
            return $this->showToast("info", "you haven't selected any item yet!");
        }

        $delete = Product::whereIn("id", $this->selectedItems)->delete();

        if (!$delete) {
            return $this->showToast("error", "products was not successfully deleted");
        }

        $this->load();
        $this->resetValue();
        return $this->showToast("success", "products has been deleted");
    }

    public function resetValue()
    {
        $this->selectedItems = [];
    }

    public function deleteProduct($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return $this->showToast("error", "product was not successfully deleted");
        }

        $deleted = $product->delete();

        if (!$deleted) {
            return $this->showToast("error", "product was not successfully deleted");
        }

        $this->load();
        return $this->showToast("success", "product has been deleted");
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
