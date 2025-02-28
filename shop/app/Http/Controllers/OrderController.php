<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Cargar la relación user con los pedidos y obtener todos los pedidos
        $orders = Order::with('user')->get();
        return view('orders.allOrders', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::findOrFail($id);

        return view('orders.edit', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Obtener el producto por su ID
        $order = Order::findOrFail($id);
        //$categories = Category::all();
    
        // Pasar el producto y las categorías a la vista
        return view('orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validación del formulario
        $request->validate([
            'status' => 'required|in:pending,shipped,completed,processing,cancelled|max:255',
        ]);
    
        // Encontrar el pedido por su ID
        $order = Order::findOrFail($id);
    
        // Actualizar el estado del pedido
        $order->status = $request->status;
        $order->save();
    
        // Redirigir con un mensaje de éxito
        return redirect()->route('orders.index')->with('status', 'Estado del pedido actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function search(Request $request)
    {
        // Obtener los pedidos con los usuarios relacionados filtrados por el estado y correo de usuario que vendran en la request
        $orders = Order::with('user')
            ->where('status', $request->status)
            ->whereHas('user', function ($query) use ($request) {
                $query->where('email', 'like', "%{$request->email}%");
            })
            ->get();
        return view('orders.allOrders', compact('orders'));
    }
}
