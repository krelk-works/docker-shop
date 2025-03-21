<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Order;

class InvoiceController extends Controller
{
    public function generateInvoice($order_id)
    {
         // Obtener la orden desde la base de datos
    $order = Order::with('items.shoeModel', 'user')->findOrFail($order_id);

    // Calcular el total de la orden sumando los productos
    $totalPrice = $order->items->reduce(function ($total, $item) {
        return $total + ($item->shoe->price * $item->quantity);  // Total por producto (precio * cantidad)
    }, 0);  // Inicializar en 0

    // Pasar el total calculado a la vista
    $pdf = Pdf::loadView('invoices.invoice', compact('order', 'totalPrice'));

    // Descargar el PDF
    return $pdf->download("invoice_{$order->id}.pdf");
    }





}
