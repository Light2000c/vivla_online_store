<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Price;
use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReceiptController extends Controller
{
    public function index($id)
    {

        $transaction = Transaction::where("reference", $id)->first();

        $orders = $transaction->order()->orderBy("created_at", "DESC")->get();

        $total = $orders->sum("total");
        $quantity = $orders->sum("quantity");
        $shipping = Price::where("name", "shipping")->first();
        $tax = Price::where("name", "tax")->first();

        $data = [
            "date" => date("m/d/y : h:i:s"),
            "transaction" => $transaction,
            "orders" => $orders,
            "tax" => $this->getTax($total, $tax),
            "shipping" => $shipping,
            "quantity" => $quantity,
            "total" => $total
        ];

        $pdf = Pdf::loadView('receipt', $data);

        //    return $pdf->download('payment_receipt.pdf');

        return $pdf->stream('payment_receipt.pdf');
    }

    
    public function getTax($total, $tax)
    {

        $percentage = $tax->price ?? 8.25;
        $tax = ($total * $percentage) / 100;

        return $tax;
    }
}
