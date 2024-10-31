<?php

namespace App\Livewire\Admin;

use App\Models\Size as ModelsSize;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Size extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $name;
    private $sizes;
    public $activeSize;
    public $groupSelect;
    public $selectedItems = [];

    public $search = "";

    public function render()
    {
        $this->load();

        return view('livewire.admin.size', [
            "sizes" => $this->sizes
        ])->layout("layouts.admin.app");
    }

    public function load()
    {
        if (!$this->search) {
            $this->sizes = ModelsSize::orderBy("created_at", "DESC")->paginate(10);
        } else {
            $this->sizes = ModelsSize::orderBy("created_at", "DESC")
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

        $size = ModelsSize::find($id);

        if (!$size) {
            return;
        }

        $this->activeSize = $size;
        $this->name = $this->activeSize->name;

        return  $this->dispatch("openUpdateModal");
    }

    public function resetValues()
    {
        $this->activeSize = "";
        $this->name = "";
    }

    public function resetSelectItem()
    {
        $this->selectedItems = [];
    }

    public function store()
    {

        $this->validate([
            "name" => "required",
        ]);

        $size = ModelsSize::create([
            "name" =>  $this->name
        ]);

        if (!$size) {
            return $this->showToast("error", "Size was not successfully added.");
        }

        $this->load();
        $this->dispatch("closeCreateModal");
        $this->resetValues();
        return $this->showToast("success", "Size has been added.");
    }



    public function update()
    {

        $validationRules = [
            "name" => "required",
        ];



        $this->validate($validationRules);

        try {

            $size = ModelsSize::find($this->activeSize->id);

            if (!$size) {
                return $this->showToast("error", "No size found with ID " . $this->activeSize->id);
            }

            $size->name = $this->name;
  
            $updated = $size->save();

            if (!$updated) {
                return $this->showToast("error", "Size was not successfully updated.");
            }

            $this->load();
            $this->dispatch("closeUpdateModal");
            $this->resetValues();
            return $this->showToast("success", "size has been updated.");
        } catch (\Exception $e) {
            return $this->showToast("error", "Something went wrong, size was not successfully updated");
        }
    }

    public function delete($id)
    {

        try {

            $size = ModelsSize::find($id);

            if (!$size) {
                return $this->showToast("error", "Size was not successfully deleted");
            }

            $deleted = $size->delete();

            if (!$deleted) {
                return $this->showToast("error", "Size was not successfully deleted");
            }

            $this->load();
            return $this->showToast("success", "Size has been deleted");
        } catch (\Exception $e) {
            return $this->showToast("error", "Something went wrong, size was not successfully deleted");
        }
    }

    public function deleteSelected()
    {

        try {

            if (empty($this->selectedItems)) {
                return $this->showToast("info", "you haven't selected any size yet!");
            }

            $delete = ModelsSize::whereIn("id", $this->selectedItems)->delete();

            if (!$delete) {
                return $this->showToast("error", "Size was not successfully deleted");
            }

            $this->load();
            $this->resetSelectItem();
            return $this->showToast("success", "Sizes has been deleted");
        } catch (\Exception $e) {
            return $this->showToast("error", "Something went wrong, sizess were not successfully deleted");
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
