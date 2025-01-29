<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\GuestTransaction;

class GuestOrder extends Component
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
        
        return view('livewire.admin.guest-order',[
            "orders" => $this->orders,
        ])->layout("layouts.admin.app");
    }

    public function load()
    {

        $transaction = GuestTransaction::where("reference", $this->id)->first();
        $this->transaction = $transaction;

        if (!$transaction) {
            return redirect()->route("dashboard");
        }

        $this->orders = $transaction->guestOrder()->orderBy("created_at", "DESC")->get();

        // $address = Address::find($transaction->address_id);

        // $this->address = $address;

        // if (!$this->address) {
            // dd("jdsk");
            // return $this->redirect("/home");
            // $this->redirect(route('admin-transaction'));
            // $this->redirectIntended('/admin/transactions');
        // }

        // if (!$this->address || $this->address->user_id !== $transaction->user_id) {
        //     $this->address = [];
        // }


        $this->total = $this->orders->sum("total");
        $this->quantity = $this->orders->sum("quantity");
    }
}
