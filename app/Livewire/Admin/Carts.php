<?php

namespace App\Livewire\Admin;

use App\Models\Cart;
use Livewire\Component;
use Livewire\WithPagination;

class Carts extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    private $carts;
    public $groupSelect;
    public $selectedItems = [];
    public $search = "";

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
        $searchTerm = '%' . $this->search . '%'; // Define the search term

        if (!$this->search) {
            $this->carts = Cart::orderBy('created_at', 'DESC')->paginate(6);
        } else {

            $this->carts = Cart::whereHas('product', function ($query) use ($searchTerm) {
                $query->where('name', 'LIKE', $searchTerm);
            })
                ->whereHas('user', function ($query) use ($searchTerm) {
                    $query->where('name', 'LIKE', $searchTerm);
                })
                ->orderBy('created_at', 'DESC')
                ->paginate(6);
        }
    }


    public function delete($id)
    {

        try{
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

    } catch (\Exception $e) {
        return $this->showToast("error", "Something went wrong please try again.");
    }
    }

    public function deleteSelected()
    {

        try{
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

    } catch (\Exception $e) {
        return $this->showToast("error", "Something went wrong please try again.");
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
