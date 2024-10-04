<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Transaction;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class Transactions extends Component
{

    use WithPagination;

    protected $paginationTheme = "bootstrap";
    private $transactions;
    public $search = "";
    public $activeTransaction;
    public $status;
    public $groupSelect;
    public $selectedItems = [];

    public $statusList = [

        [
            "id" => 0,
            "name" => "Order Placed"
        ],
        [
            "id" => 1,
            "name" => "Pending Confirmation"
        ],
        [
            "id" => 2,
            "name" => "Waiting To Be Sent"
        ],
        [
            "id" => 3,
            "name" => "Sent"
        ],
        [
            "id" => 4,
            "name" => "Delivered"
        ],
    ];

    public function render()
    {

        $this->load();

        return view('livewire.admin.transactions', [
            "transactions" => $this->transactions
        ])->layout("layouts.admin.app");
    }


    public function load()
    {
        if (!$this->search) {
            $transactions = Transaction::orderBy("created_at", "DESC")->paginate(10);
            $this->transactions = $transactions;
        } else {
            $transactions = Transaction::orderBy("created_at", "DESC")->where("reference", "LIKE", '%' . $this->search . '%')->paginate(10);
            $this->transactions = $transactions;
        }
    }

    public function resetSelectItem()
    {
        $this->selectedItems = [];
    }

    public function getTotal($id)
    {


        $transaction = Transaction::find($id);

        if (!$transaction) {
            return null;
        }

        $orders = $transaction->order()->get();

        $total = $orders->sum("total");
        $quantity = $orders->sum("quantity");

        return number_format($total)  . ' for ' . $quantity . ' item';
    }

    public function openUpdateModal($id)
    {

        $this->activeTransaction = "";
        $this->status = "";

        $transaction = Transaction::find($id);

        if (!$transaction) {
            return $this->showToast("error", "Order not found!!");
        }

        $this->activeTransaction = $transaction;
        $this->status = $transaction->status;

        $this->dispatch("openUpdateModal");
    }

    public function updateOrderStatus()
    {

        $this->validate([
            "status" => "required",
        ]);

        $transaction = Transaction::find($this->activeTransaction->id);

        if (!$transaction) {
            return $this->showToast("error", "Order not found!!");
        }

        $transaction->status = $this->status;
        $saved = $transaction->save();

        if (!$saved) {
            return $this->showToast("error", "Order was not successfully updated!!");
        }


        $this->load();
        $this->dispatch("closeUpdateModal");
        return $this->showToast("success", "Order has been successfully updated!!");
    }

    public function delete($id)
    {

        if(Auth::user()->role != 2){
            return $this->showToast("error", "You don't have permission to perform this action");
        }

        $transaction = Transaction::find($id);

        if (!$transaction) {
            return $this->showToast("error", "Transaction was not successfully deleted");
        }

        $deleted = $transaction->delete();

        if (!$deleted) {
            return $this->showToast("error", "Transaction was not successfully deleted");
        }

        $this->load();
        return $this->showToast("success", "Transaction has been deleted");
    }


    public function deleteSelected()
    {
        
        if (empty($this->selectedItems)) {
            return $this->showToast("info", "you haven't selected any Transaction yet!");
        }

        if(Auth::user()->role != 2){
            return $this->showToast("error", "You don't have permission to perform this action");
        }

        $delete = Transaction::whereIn("id", $this->selectedItems)->delete();

        if (!$delete) {
            return $this->showToast("error", "Transactions was not successfully deleted");
        }

        $this->load();
        $this->resetSelectItem();
        return $this->showToast("success", "Transactions has been deleted");
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
