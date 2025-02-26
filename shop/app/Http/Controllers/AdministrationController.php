<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;  // Ajusta según la ubicación de tu modelo
use App\Models\Shoe;  // Ajusta según la ubicación de tu modelo

class AdministrationController extends Controller
{
    /**
     * Muestra el listado de stocks.
     */
    public function index()
    {
        $ultimosProductos = Shoe::orderBy('created_at', 'desc')->take(4)->get();
        $ultimosPedidos = Order::orderBy('created_at', 'desc')->take(4)->get();
        return view('administration.home', compact('ultimosProductos', 'ultimosPedidos'));
    }

    public function login()
    {
        return view('administration.login');
    }

    /**
     * Muestra el formulario para crear un nuevo stock.
     */
    public function create()
    {
        // Obtenemos todos los zapatos, colores y tallas para seleccionarlos en el formulario
        $shoes = Shoe::all();
        $colors = Color::all();
        $sizes = Size::all();

        return view('stocks.create', compact('shoes', 'colors', 'sizes'));
    }

    /**
     * Guarda un nuevo stock en la base de datos.
     */
    public function store(Request $request)
    {
        // Validamos la entrada
        $request->validate([
            'shoe_id'   => 'required|exists:shoes,id',
            'color_id'  => 'required|exists:color_shoe,id',
            'size_id'   => 'required|exists:shoe_size,id',
            'quantity'  => 'required|integer|min:0',
        ]);



        // Creamos el registro de stock
        Stock::create($request->all());

        // Redirigimos con un mensaje de éxito
        return redirect()->route('stocks.index')->with('success', 'Stock creado correctamente.');
    }

    /**
     * Muestra un registro concreto de stock.
     */
    public function show($id)
    {
        $stock = Stock::with(['shoe', 'colorShoe', 'shoeSize'])->findOrFail($id);
        return view('stocks.show', compact('stock'));
    }

    /**
     * Muestra el formulario para editar un stock existente.
     */
    public function edit($id)
    {
        $stock = Stock::findOrFail($id);

        $shoes = Shoe::all();
        $colors = Color::all();
        $sizes = Size::all();

        return view('stocks.edit', compact('stock', 'shoes', 'colors', 'sizes'));
    }

    /**
     * Actualiza un stock en la base de datos.
     */
    public function update(Request $request, $id)
    {
        // Validamos la entrada
        $request->validate([
            'shoe_id'   => 'required|exists:shoes,id',
            'color_id'  => 'required|exists:color_shoe,id',
            'size_id'   => 'required|exists:shoe_size,id',
            'quantity'  => 'required|integer|min:0',
        ]);

        // Actualizamos el registro
        $stock = Stock::findOrFail($id);
        $stock->update($request->all());

        return redirect()->route('stocks.index')
                         ->with('success', 'Stock actualizado correctamente.');
    }

    /**
     * Elimina un registro de stock de la base de datos.
     */
    public function destroy($id)
    {
        $stock = Stock::findOrFail($id);
        $stock->delete();

        return redirect()->route('stocks.index')
                         ->with('success', 'Stock eliminado correctamente.');
    }
}
