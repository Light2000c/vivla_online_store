<?php

namespace App\Livewire\Admin;

use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Payments extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    private $payments;
    public $groupSelect;
    public $selectedItems = [];

    public $search = "";


    public function render()
    {
        $this->load();

        return view('livewire.admin.payments', [
            "payments" => $this->payments
        ])->layout("layouts.admin.app");
    }

    public function load()
    {
        $searchTerm = '%' . $this->search . '%';

        if (!$this->search) {
            $this->payments = Payment::orderBy('created_at', 'DESC')->paginate(3);
        } else {
            $this->payments = Payment::whereHas('user', function ($query) use ($searchTerm) {
                $query->where('name', 'LIKE', $searchTerm);
            })
                ->orderBy('created_at', 'DESC')
                ->paginate(3);
        }
    }

    public function delete($id)
    {

        
        try {

            if (Auth::user()->role != 2) {
                return $this->showToast("error", "You don't have permission to perform this action");
            }

            $payment = Payment::find($id);


            if (!$payment) {
                return $this->showToast("error", "payment was not successfully deleted");
            }

            $deleted = $payment->delete();

            if (!$deleted) {
                return $this->showToast("error", "payment was not successfully deleted");
            }

            $this->load();
            return $this->showToast("success", "payment has been deleted");
        } catch (\Exception $e) {
            return $this->showToast("error", "something went wrong, payment was not successfully deleted");
        }
    }

    public function updateselectedItems() {}

    public function deleteSelected()
    {

        try {

            
            if (empty($this->selectedItems)) {
                return $this->showToast("info", "you haven't selected any item yet!");
            }

            if (Auth::user()->role != 2) {
                return $this->showToast("error", "You don't have permission to perform this action");
            }

            $delete = Payment::whereIn("id", $this->selectedItems)->delete();

            if (!$delete) {
                return $this->showToast("error", "payments was not successfully deleted");
            }

            $this->load();
            $this->resetValue();
            return $this->showToast("success", "payments has been deleted");
        } catch (\Exception $e) {
            return $this->showToast("error", "something went wrong, payments were not successfully deleted");
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
