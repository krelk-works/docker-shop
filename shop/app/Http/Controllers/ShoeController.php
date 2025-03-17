<?php

namespace App\Http\Controllers;

use App\Models\Shoe;
use App\Models\Brand;
use App\Models\ShoeModel;
use App\Models\Category;
use App\Models\Color;
use App\Models\Size;
use Illuminate\Http\Request;

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
        // Validar los datos de entrada
        $request->validate([
            'brand_id' => 'required|exists:brands,id',
            'model_id' => 'required|exists:models,id',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'color_id' => 'required|exists:colors,id',
            'size_id' => 'required|exists:sizes,id',
            'image' => 'nullable|string',
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

        // Crear el zapato
        Shoe::create($request->all());

        return redirect()->route('shoes.index')->with('success', 'Zapato creado con éxito.');
    }


    public function show(Shoe $shoe)
    {
        return view('shoes.show', compact('shoe'));
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
        $request->validate([
            'brand_id' => 'required|exists:brands,id',
            'model_id' => 'required|exists:models,id',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'color_id' => 'required|exists:colors,id',
            'size_id' => 'required|exists:sizes,id',
            'image' => 'nullable|string',
            'featured' => 'boolean',
            'discount' => 'integer|min:0|max:100',
            'active' => 'boolean',
            'main' => 'boolean',
            'stock' => 'integer|min:0'
        ]);

        $shoe->update($request->all());

        return redirect()->route('shoes.index')->with('success', 'Zapato actualizado con éxito.');
    }

    public function destroy(Shoe $shoe)
    {
        $shoe->delete();
        return redirect()->route('shoes.index')->with('success', 'Zapato eliminado con éxito.');
    }
}
