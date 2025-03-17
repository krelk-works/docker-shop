<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index()
    {
        $colors = Color::all();
        return view('colors.index', compact('colors'));
    }

    public function create()
    {
        return view('colors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:colors|max:255',
            'hex_code' => 'nullable|string|max:7'
        ]);

        Color::create($request->all());

        return redirect()->route('colors.index')->with('success', 'Color creado con éxito.');
    }

    public function edit(Color $color)
    {
        return view('colors.edit', compact('color'));
    }

    public function update(Request $request, Color $color)
    {
        $request->validate([
            'name' => 'required|unique:colors,name,' . $color->id,
            'hex_code' => 'nullable|string|max:7'
        ]);

        $color->update($request->all());

        return redirect()->route('colors.index')->with('success', 'Color actualizado con éxito.');
    }

    public function destroy(Color $color)
    {
        $color->delete();
        return redirect()->route('colors.index')->with('success', 'Color eliminado con éxito.');
    }
}
