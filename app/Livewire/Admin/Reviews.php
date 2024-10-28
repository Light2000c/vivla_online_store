<?php

namespace App\Livewire\Admin;

use App\Models\Review;
use Livewire\Component;
use Livewire\WithPagination;

class Reviews extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    private $reviews;
    public $groupSelect;
    public $selectedItems = [];

    public $search = "";

    public function render()
    {

        $this->load();

        return view('livewire.admin.reviews', [
            "reviews" => $this->reviews
        ])->layout("layouts.admin.app");
    }

    public function load()
    {
        $searchTerm = '%' . $this->search . '%';

        if (!$this->search) {
            $this->reviews = Review::orderBy('created_at', 'DESC')->paginate(3);
        } else {
            $this->reviews = Review::whereHas('product', function ($query) use ($searchTerm) {
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
            $review = Review::find($id);

            if (!$review) {
                return $this->showToast("error", "review was not successfully deleted");
            }

            $deleted = $review->delete();

            if (!$deleted) {
                return $this->showToast("error", "review was not successfully deleted");
            }

            $this->load();
            return $this->showToast("success", "review has been deleted");
        } catch (\Exception $e) {
            return $this->showToast("error", "something went wrong, review was not successfully deleted");
        }
    }

    public function updateselectedItems() {}

    public function deleteSelected()
    {

        try {

            if (empty($this->selectedItems)) {
                return $this->showToast("info", "you haven't selected any item yet!");
            }

            $delete = Review::whereIn("id", $this->selectedItems)->delete();

            if (!$delete) {
                return $this->showToast("error", "reviews was not successfully deleted");
            }

            $this->load();
            $this->resetValue();
            return $this->showToast("success", "reviews has been deleted");
        } catch (\Exception $e) {
            return $this->showToast("error", "something went wrong, reviews were not successfully deleted");
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
