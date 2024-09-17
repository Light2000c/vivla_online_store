<?php

namespace App\Livewire\Admin;

use App\Models\Transaction;
use Livewire\Component;
use Livewire\WithPagination;

class Transactions extends Component
{

    use WithPagination;

    protected $paginationTheme = "bootstrap";
    private $transactions;
    public $search = "";

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
}
