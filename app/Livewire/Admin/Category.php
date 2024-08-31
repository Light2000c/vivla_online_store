<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Category as ModelCategory;

class Category extends Component
{
    public $title;
    private $categories;
    public $activeCategory;
    public $groupSelect;
    public $selectedItems = [];

    public function render()
    {
        $this->load();

        return view('livewire.admin.category', [
            "categories" => $this->categories
        ])->layout("layouts.admin.app");
    }

    public function load()
    {
        $this->categories = ModelCategory::orderBy("created_at", "DESC")->get();
    }

    public function openCreateModal()
    {
        $this->resetValues();

        return  $this->dispatch("openCreateModal");
    }

    public function openUpdateModal($id)
    {
        $this->resetValues();

        $category = ModelCategory::find($id);

        if (!$category) {
            return;
        }

        $this->activeCategory = $category;
        $this->title = $this->activeCategory->name;

        return  $this->dispatch("openUpdateModal");
    }

    public function resetValues()
    {
        $this->title = "";
        $this->activeCategory = "";
    }

    public function resetSelectItem()
    {
        $this->selectedItems = [];
    }

    public function store()
    {

        $this->validate([
            "title" => "required|:max:255|unique:categories,name",
        ]);

        $category = ModelCategory::create([
            "name" => $this->title,
        ]);

        if (!$category) {
            return $this->showToast("error", "Category was not successfully created.");
        }

        $this->load();
        $this->dispatch("closeCreateModal");
        $this->resetValues();
        return $this->showToast("success", "Category created.");
    }

    public function update()
    {

        $this->validate([
            "title" => $this->activeCategory->name === $this->title ? "required" : "required|:max:255|unique:categories,name",
        ]);

        $category = ModelCategory::find($this->activeCategory->id);

        if (!$category) {
            return $this->showToast("error", "No category found with ID " . $this->activeCategory->id);
        }

        $updated =  $category->update([
            "name" => $this->title,
        ]);

        if (!$updated) {
            return $this->showToast("error", "Category was not successfully update.");
        }

        $this->load();
        $this->dispatch("closeUpdateModal");
        $this->resetValues();
        return $this->showToast("success", "Category updated.");
    }

    public function delete($id)
    {

        $cart = ModelCategory::find($id);

        if (!$cart) {
            return $this->showToast("error", "category was not successfully deleted");
        }

        $deleted = $cart->delete();

        if (!$deleted) {
            return $this->showToast("error", "category was not successfully deleted");
        }

        $this->load();
        return $this->showToast("success", "category has been deleted");
    }

    public function deleteSelected()
    {
        if (empty($this->selectedItems)) {
            return $this->showToast("info", "you haven't selected any item yet!");
        }

        $delete = ModelCategory::whereIn("id", $this->selectedItems)->delete();

        if (!$delete) {
            return $this->showToast("error", "category was not successfully deleted");
        }

        $this->load();
        $this->resetSelectItem();
        return $this->showToast("success", "category has been deleted");
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
