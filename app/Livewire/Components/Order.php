<?php

namespace App\Livewire\Components;

use App\Models\Transaction;
use Livewire\Component;

class Order extends Component
{

    private $transactions;

    public function render()
    {
        $this->load();

        return view('livewire.components.order', [
            "transactions" => $this->transactions
        ]);
    }

    public function load(){
        $this->transactions = request()->user()->transaction()->orderBy("created_at", "DESC")->get();
    }

    public function getTotal($id){


        $transaction = Transaction::find($id);

        if(!$transaction){
            return null;
        }

        $orders = $transaction->order()->get();

        $total = $orders->sum("total");
        $quantity = $orders->sum("quantity");

        return number_format($total)  .' for '. $quantity .' item';

    }

    
}
