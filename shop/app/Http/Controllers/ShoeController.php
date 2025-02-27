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
        //foto
        
        $image_path=$request->file('photo');
        if ($image_path) {
            $image_path_name = time().$image_path->getClientOriginalName();
            Storage::disk('products')->put($image_path_name, File::get($image_path)); //disco virtual (products)
        }
      

        // Validación del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        LOG::info('Imagen de calzado: ' . $image_path_name);

 

        // Crear el zapato en la base de datos
        $shoe = Shoe::create([
           
           // 'photo' => $image_path_name,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            // 'image' => $image_path_name,
        ]);

        //return response()->json($shoe, 201);
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
         // Validar que el nombre no esté vacío
         $request->validate([
            'name' => 'required|string|max:30',
        ]);

        $shoe = Shoe::findOrFail($id);  // Obtener el producto por ID
        $shoe->name = $request->input('name');  // Actualizar el nombre
        $shoe->description = $request->input('description');  // Actualizar la descripción
        $shoe->price = $request->input('price');  // Actualizar el precio
        $shoe->category_id = $request->input('category_id');  // Actualizar la categoría
        //$shoe->active = $request->input('active');  // Actualizar el estado
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
