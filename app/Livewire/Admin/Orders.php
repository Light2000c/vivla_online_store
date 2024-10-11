<?php

namespace App\Livewire\Admin;

use App\Models\Address;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Orders extends Component
{
    public $id;
    private $orders;
    public $transaction;
    public $total;
    public $quantity;
    public $address;

    public function mount($id)
    {
        $this->id = $id;
    }

    public function render()
    {
        $this->load();

        return view('livewire.admin.orders', [
            "orders" => $this->orders,
        ])->layout("layouts.admin.app");
    }

    public function load()
    {

        $transaction = Transaction::where("reference", $this->id)->first();
        $this->transaction = $transaction;

        if (!$transaction && $transaction->user()->is(Auth::user())) {
            return redirect()->route("dashboard");
        }

        $this->orders = $transaction->order()->orderBy("created_at", "DESC")->get();

        $address = Address::find($transaction->address_id);

        $this->address = $address;

        if (!$this->address) {
            dd("jdsk");
            return $this->redirect("/home");
            // $this->redirect(route('admin-transaction'));
            // $this->redirectIntended('/admin/transactions');
        }

        if ($this->address->user_id !== $transaction->user_id) {
            $this->address = [];
        }


        $this->total = $this->orders->sum("total");
        $this->quantity = $this->orders->sum("quantity");
    }
}
