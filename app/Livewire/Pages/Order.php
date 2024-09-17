<?php

namespace App\Livewire\Pages;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Order extends Component
{
    public $id;
    public $orders;
    public $transaction;
    public $total;
    public $quantity;

    public function mount($id) {
        $this->id = $id;
     
    }

    public function render()
    {
        $this->load();

        return view('livewire.pages.order');
    }

    public function load()
    {

        $transaction = Transaction::where("reference",$this->id)->first();
        $this->transaction = $transaction;

        if (!$transaction && $transaction->user()->is(Auth::user())) {
            return redirect()->route("dashboard");
        }

        $this->orders = $transaction->order()->orderBy("created_at", "DESC")->get();

        $this->total = $this->orders->sum("total");
        $this->quantity = $this->orders->sum("quantity");
    }
}
