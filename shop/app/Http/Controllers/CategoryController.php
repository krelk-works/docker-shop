<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all(); //obtiene todas las catgeeorias
        return view('categories.allCategories', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('categories.altaCategoria');
    }

    /**
     * Store a newly created resource in storage sisi.
     */
    public function store(Request $request)
    {
        // Validar los datos y guardar la categoría
        $request->validate([
            'name' => 'required|string|unique:categories|max:30',
        ]);

        $category = Category::create($request->all());
        return redirect()->route('category.index')->with('status', 'Categoría creada con éxito.');
        //return response()->json($category, 201);
    }

    public function toggleStatus($id)
{
    $category = Category::findOrFail($id);
    $category->active = !$category->active; // Alternar estado
    $category->save();

    return redirect()->back()->with('success', 'Estado de la categoría actualizado.');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::with('products')->findOrFail($id);
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);  // Obtener la categoría por ID
        return view('categories.editCategories', compact('category'));  // Pasar la categoría a la vista
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validar que el nombre no esté vacío
        $request->validate([
            'name' => 'required|string|max:30',
        ]);
    
        $category = Category::findOrFail($id);  // Obtener la categoría por ID
        $category->name = $request->input('name');  // Actualizar el nombre
        $category->save();  // Guardar los cambios
    
        return redirect()->route('category.index')->with('status', 'Categoría actualizada con éxito.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('category.index')->with('success', 'Categoría eliminada con éxito.');
    }
}
