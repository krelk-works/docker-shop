<?php

namespace App\Http\Controllers;

use App\Models\ShoeModel;
use App\Models\Brand;
use Illuminate\Http\Request;

class ShoeModelController extends Controller
{
    public function index()
    {
        $models = ShoeModel::with('brand')->get();
        return view('models.index', compact('models'));
    }

    public function create()
    {
        $brands = Brand::all();
        return view('models.create', compact('brands'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:models|max:255',
            'description' => 'nullable|string',
            'brand_id' => 'required|exists:brands,id',
        ]);

        ShoeModel::create($request->all());

        return redirect()->route('models.index')->with('success', 'Modelo creado con éxito.');
    }

    public function show(ShoeModel $model)
    {
        return view('models.show', compact('model'));
    }

    public function edit(ShoeModel $model)
    {
        $brands = Brand::all();
        return view('models.edit', compact('model', 'brands'));
    }

    public function update(Request $request, ShoeModel $model)
    {
        $request->validate([
            'name' => 'required|unique:models,name,' . $model->id,
            'description' => 'nullable|string',
            'brand_id' => 'required|exists:brands,id',
        ]);

        $model->update($request->all());

        return redirect()->route('models.index')->with('success', 'Modelo actualizado con éxito.');
    }

    public function destroy(ShoeModel $model)
    {
        $model->delete();
        return redirect()->route('models.index')->with('success', 'Modelo eliminado con éxito.');
    }
}

