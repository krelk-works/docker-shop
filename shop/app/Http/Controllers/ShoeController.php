<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Shoe;

use Illuminate\Support\Facades\Log;

class ShoeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shoes = Shoe::all(); // Obtener todos los productos
        return view('shoes.index', compact('shoes'));
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
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validamos la imagen
            'featured' => 'nullable|boolean|integer',
            'discount' => 'nullable|integer|min:0|max:100',
        ]);

        // Manejo de la imagen
        $image_path_name = null;

        if ($request->hasFile('photo')) {
            $image_path = $request->file('photo');
            $image_path_name = time() . '_' . $image_path->getClientOriginalName();
            
            // Guardamos en el storage de Laravel en el disco 'public/products'
            $path = $image_path->storeAs('products', $image_path_name, 'public'); 
        }

        // Log para depuración
        Log::info('Imagen de calzado guardada: ' . $image_path_name);

        // Crear el zapato en la base de datos
        $shoe = Shoe::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'image' => $image_path_name, // Guardamos el nombre de la imagen en la BD
            'featured' => $request->featured ?? false, // Si no se envía, por defecto es false
            'discount' => $request->discount ?? 0, // Si no se envía, por defecto es 0
        ]);

        return redirect()->route('shoes.index')->with('status', 'Producto creado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $producto = Shoe::findOrFail($id);

        return view('shoes.show', compact('producto'));
    }

    public function preview($id)
    {
        $shoe = Shoe::findOrFail($id);

        return view('shoes.preview', compact('shoe'));
    }

    // Función para buscar productos
    public function search(Request $request)
    {
        LOG::info('Buscando producto: ' . $request->input('search'));

        $value = $request->input('search');

        $products = Shoe::where('name', 'like', '%' . $value . '%')->get();

        LOG::info('Productos encontrados: ' . $products);

        return view('shoes.search', compact('products'));
    }
    

    //revisar
    public function deactivate(string $id)
    {
        // Obtener el producto
        $producto = Shoe::findOrFail($id);

        $producto->active = false;
        $producto->save();

    return redirect()->route('home')->with('status', 'Producto desactivado con éxito.');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Obtener el producto por su ID
        $shoe = Shoe::findOrFail($id);
        $categories = Category::all();
    
        // Pasar el producto y las categorías a la vista
        return view('shoes.edit', compact('shoe', 'categories'));
    }

    
    public function addSize(Request $request, $id)
{
    // Validar los datos ingresados
    $request->validate([
        'talla' => 'required|string|max:10',
        'stock' => 'required|integer|min:0',
    ]);

    // Obtener el producto por su ID
    $producto = Shoe::findOrFail($id);

    // Aquí asumimos que tienes una tabla relacionada para tallas (tabla shoe_size, por ejemplo)
    DB::table('shoe_size')->insert([
        'shoe_id' => $producto->id,
        'talla' => $request->input('talla'),
        'stock' => $request->input('stock'),
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    // Redirigir de vuelta con un mensaje de éxito
    return redirect()->route('shoes.edit', $id)->with('success', 'Talla añadida correctamente.');
}
    

public function toggleStatus($id)
{
    $shoe = Shoe::findOrFail($id);
    $shoe->active = !$shoe->active; // Alternar estado
    $shoe->save();

    return redirect()->back()->with('success', 'Estado de la categoría actualizado.');
}




    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validación del formulario, en esta ocasión validamos que sea una imágen pero puede ser que no se quiera actualizar la imágen
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validamos la imagen
            'featured' => 'nullable|boolean|integer',
            'discount' => 'nullable|integer|min:0|max:100',
        ]);

        // Obtenemos los datos del producto
        $shoe = Shoe::findOrFail($id);  // Obtener el producto por ID

        // Manejo de la imagen
        $image_path_name = null;
        if ($request->hasFile('photo')) {
            $image_path = $request->file('photo');
            $image_path_name = time() . '_' . $image_path->getClientOriginalName();
            
            // Guardamos en el storage de Laravel en el disco 'public/products'
            $path = $image_path->storeAs('products', $image_path_name, 'public');

            // Borramos la imágen anterior si existe
            if (file_exists(storage_path('app/public/products/' . $shoe->image))) {
                Storage::delete('public/products/' . $shoe->image);
            }
        }

        $shoe->name = $request->input('name');  // Actualizar el nombre
        $shoe->description = $request->input('description');  // Actualizar la descripción
        $shoe->price = $request->input('price');  // Actualizar el precio
        $shoe->category_id = $request->input('category_id');  // Actualizar la categoría
        $shoe->image = $image_path_name ?? $shoe->image;  // Actualizar la imagen si se subió una nueva
        $shoe->updated_at = now();  // Actualizar la fecha de actualización
        $shoe->featured = $request->input('featured') ?? false;  // Actualizar si es destacado
        $shoe->discount = $request->input('discount') ?? 0;  // Actualizar el descuento
        $shoe->save();  // Guardar los cambios

        return redirect()->route('shoe.index')->with('status', 'Producto actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
