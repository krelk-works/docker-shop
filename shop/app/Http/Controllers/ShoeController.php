<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Shoe;

class ShoeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Devolver la vista de formulario de creación de calzado
        $categories = Category::all();
        return view('shoes.altaCalzado', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Crear el zapato en la base de datos
        $shoe = Shoe::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
        ]);

        return response()->json($shoe, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        // Obtener el producto por su ID
        $producto = Shoe::findOrFail($id);

        // Simular tallas y stock
        $tallas = [
            ['size' => '36', 'stock' => 5],
            ['size' => '37', 'stock' => 5],
            ['size' => '38', 'stock' => 5],
            ['size' => '39', 'stock' => 3],
            ['size' => '40', 'stock' => 2],
            ['size' => '41', 'stock' => 5],
            ['size' => '42', 'stock' => 3],
            ['size' => '43', 'stock' => 2],
            ['size' => '44', 'stock' => 2],
            ['size' => '45', 'stock' => 1],
            ['size' => '46', 'stock' => 0],
            ['size' => '47', 'stock' => 0],
            ['size' => '48', 'stock' => 0],


        ];

    // Pasar el producto y las tallas a la vista
        return view('shoes.show', compact('producto', 'tallas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
