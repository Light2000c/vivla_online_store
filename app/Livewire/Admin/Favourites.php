<?php

namespace App\Livewire\Admin;

use App\Models\Wishlist;
use Livewire\Component;
use Livewire\WithPagination;

class Favourites extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    private $wishlists;
    public $groupSelect;
    public $selectedItems = [];

    public $search = "";

    public function render()
    {

        $this->load();

        return view('livewire.admin.favourites', [
            "wishlists" => $this->wishlists
        ])->layout("layouts.admin.app");
    }

    public function load()
    {
        $searchTerm = '%' . $this->search . '%';

        if (!$this->search) {
            $this->wishlists = Wishlist::orderBy('created_at', 'DESC')->paginate(3);
        } else {
            $this->wishlists = Wishlist::whereHas('product', function ($query) use ($searchTerm) {
                $query->where('name', 'LIKE', $searchTerm);
            })
                ->whereHas('user', function ($query) use ($searchTerm) {
                    $query->where('name', 'LIKE', $searchTerm);
                })
                ->orderBy('created_at', 'DESC')
                ->paginate(3);
        }
    }

    public function delete($id)
    {

        try {
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
        } catch (\Exception $e) {
            return $this->showToast("error", "something went wrong, wish was not successfully deleted");
        }
    }

    public function updateselectedItems() {}

    public function deleteSelected()
    {

        try {

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
        } catch (\Exception $e) {
            return $this->showToast("error", "something went wrong, wishes were not successfully deleted");
        }
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
