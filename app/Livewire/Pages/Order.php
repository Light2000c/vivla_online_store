<?php

namespace App\Livewire\Pages;

use App\Models\Price;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf;

class Order extends Component
{
    public $id;
    public $orders;
    public $transaction;
    public $total;
    public $quantity;
    public $shipping;
    public $tax;

    public function mount($id)
    {
        $this->id = $id;
    }

    public function render()
    {
        $this->load();

        return view('livewire.pages.order');
    }

    public function load()
    {

        $transaction = Transaction::where("reference", $this->id)->first();
        $this->transaction = $transaction;

        if (!$transaction && $transaction->user()->is(Auth::user())) {
            return redirect()->route("dashboard");
        }

        $this->orders = $transaction->order()->orderBy("created_at", "DESC")->get();

        $this->total = $this->orders->sum("total");
        $this->quantity = $this->orders->sum("quantity");
        $this->shipping = Price::where("name", "shipping")->first();
        $this->tax = Price::where("name", "tax")->first();
    }


    public function getTax($total)
    {

        $percentage = $this->tax->price ?? 8.25;
        $tax = ($total * $percentage) / 100;

        return $tax;
    }

    public function generatePdf()
    {

        $this->dispatch("openPdf", ["id" => $this->id]);
        // return redirect()->route('generate.pdf');
    }
}
