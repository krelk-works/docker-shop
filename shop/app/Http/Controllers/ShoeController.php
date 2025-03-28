<?php

namespace App\Http\Controllers;

use App\Models\Shoe;
use App\Models\Brand;
use App\Models\ShoeModel;
use App\Models\Category;
use App\Models\Color;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ShoeController extends Controller
{
    public function index()
    {
        $shoes = Shoe::with(['brand', 'model', 'category', 'color', 'size'])->get();
        return view('shoes.index', compact('shoes'));
    }

    public function create()
    {
        $brands = Brand::all();
        $models = ShoeModel::all();
        $categories = Category::all();
        $colors = Color::all();
        $sizes = Size::all();

        return view('shoes.create', compact('brands', 'models', 'categories', 'colors', 'sizes'));
    }

    public function store(Request $request)
    {
        // Asegurar que los checkbox envíen valores correctos
        $request->merge([
            'featured' => $request->has('featured'),
            'active' => $request->has('active'),
            'main' => $request->has('main'),
        ]);

        // Validar datos
        $request->validate([
            'brand_id' => 'required|exists:brands,id',
            'model_id' => 'required|exists:models,id',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'color_id' => 'required|exists:colors,id',
            'size_id' => 'required|exists:sizes,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'featured' => 'boolean',
            'discount' => 'integer|min:0|max:100',
            'active' => 'boolean',
            'main' => 'boolean',
            'stock' => 'integer|min:0'
        ]);

        // Verificar si ya existe un zapato con los mismos datos
        $exists = Shoe::where([
            'brand_id' => $request->brand_id,
            'model_id' => $request->model_id,
            'category_id' => $request->category_id,
            'color_id' => $request->color_id,
            'size_id' => $request->size_id
        ])->exists();

        if ($exists) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Ya existe un zapato con esta combinación de marca, modelo, categoría, color y talla.']);
        }

        // Subir imagen y guardar la URL correcta
        $imageUrl = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = uniqid() . '_' . time() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('shoes', $imageName, 'public');

            // Generar la URL correcta
            $imageUrl = asset('storage/' . $imagePath);
        }

        // Si se ha seleccionado como main habrá que desmarcar todos los calzados que tengan la misma marca y modelo
        if ($request->main) {
            Shoe::where('brand_id', $request->brand_id)
                ->where('model_id', $request->model_id)
                ->update(['main' => false]);
        }

        // Crear el zapato con la URL de la imagen
        Shoe::create(array_merge($request->all(), ['image' => $imageUrl]));

        return redirect()->route('shoes.index')->with('success', 'Zapato creado con éxito.');
    }

    // public function preview(Shoe $shoe)
    // {
    //     // Obtener colores disponibles para este zapato
    //     $colors = Color::whereHas('shoes', function ($query) use ($shoe) {
    //         $query->where('model_id', $shoe->model_id)
    //             ->where('brand_id', $shoe->brand_id);
    //     })->get();

    //     // Obtener tallas disponibles para este zapato
    //     $sizes = Size::whereHas('shoes', function ($query) use ($shoe) {
    //         $query->where('model_id', $shoe->model_id)
    //             ->where('brand_id', $shoe->brand_id);
    //     })->get();

    //     return view('shoes.preview', compact('shoe', 'colors', 'sizes'));
    // }

    public function preview(Shoe $shoe)
    {
        $shoe = Shoe::with(['brand', 'model'])->findOrFail($shoe->id);

        // Obtener colores disponibles para este zapato
        $colors = Color::whereHas('shoes', function ($query) use ($shoe) {
            $query->where('model_id', $shoe->model_id)
                ->where('brand_id', $shoe->brand_id);
        })->get();

        // Obtener tallas disponibles para este zapato
        $sizes = Size::whereHas('shoes', function ($query) use ($shoe) {
            $query->where('model_id', $shoe->model_id)
                ->where('brand_id', $shoe->brand_id);
        })->get();

        return view('shoes.preview', compact('shoe', 'colors', 'sizes'));
    }

    public function edit(Shoe $shoe)
    {
        $brands = Brand::all();
        $models = ShoeModel::all();
        $categories = Category::all();
        $colors = Color::all();
        $sizes = Size::all();

        return view('shoes.edit', compact('shoe', 'brands', 'models', 'categories', 'colors', 'sizes'));
    }

    public function update(Request $request, Shoe $shoe)
    {
        $request->merge([
            'featured' => $request->has('featured'),
            'active' => $request->has('active'),
            'main' => $request->has('main'),
        ]);

        $request->validate([
            'brand_id' => 'required|exists:brands,id',
            'model_id' => 'required|exists:models,id',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'color_id' => 'required|exists:colors,id',
            'size_id' => 'required|exists:sizes,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'featured' => 'boolean',
            'discount' => 'integer|min:0|max:100',
            'active' => 'boolean',
            'main' => 'boolean',
            'stock' => 'integer|min:0'
        ]);

        // Verificar si se ha subido una nueva imagen
        if ($request->hasFile('image')) {
            // Eliminar la imagen anterior si existe
            if ($shoe->image) {
                // Extraer la ruta relativa del archivo desde la URL completa
                $parsedUrl = parse_url($shoe->image, PHP_URL_PATH); // Extrae solo el path de la URL
                $relativePath = str_replace('/storage/', '', $parsedUrl); // Quita el prefijo "/storage/"

                // Intentar eliminar la imagen anterior del almacenamiento
                Storage::disk('public')->delete($relativePath);
            }

            // Guardar la nueva imagen
            $image = $request->file('image');
            $imageName = uniqid() . '_' . time() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('shoes', $imageName, 'public');

            // Generar la nueva URL completa
            $imageUrl = asset('storage/shoes/' . $imageName);
            $shoe->image = $imageUrl;
        }

        // Actualizar el zapato con los nuevos valores
        $shoe->update($request->except('image') + ['image' => $shoe->image]);

        return redirect()->route('shoes.index')->with('success', 'Zapato actualizado con éxito.');
    }

    public function stockChart()
    {
        $shoes = Shoe::with('model')->orderBy('stock', 'asc')->limit(5)->get();
        return response()->json($shoes);
    }

    public function topSellingShoes()
    {
        $topShoes = Shoe::select('name')
            ->withCount('carts') // Verifica que la relación esté bien
            ->orderByDesc('carts_count')
            ->limit(10)
            ->get();
    
        dd($topShoes); // Verifica qué datos obtiene
    
        return view('administration.chart', compact('topShoes'));
    }
    
    



    public function destroy(Shoe $shoe)
    {
        $shoe->delete();
        return redirect()->route('shoes.index')->with('success', 'Zapato eliminado con éxito.');
    }

  




}
