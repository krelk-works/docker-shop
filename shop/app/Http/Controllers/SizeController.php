<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function index()
    {
        $sizes = Size::all();
        return view('sizes.index', compact('sizes'));
    }

    public function create()
    {
        return view('sizes.create');
    }

    public function store(Request $request)
    {
        /**
         * Validaciones del name:
         * Debe ser un numero y que no tenga mas de 1 decimal
         * No puede contener ni letras ni caracteres especiales (solo numeros y un punto)
         * No puede ser negativo
         * No puede ser mayor a 100
         * No puede ser menor a 30
         */

        $request->validate([
            'name' => [
                'required',
                'numeric',
                'between:30,100',
                'regex:/^\d+(\.\d{1})?$/', // Permite solo números con máximo 1 decimal
                'unique:sizes',
            ],
        ]);
        
        

        Size::create($request->all());

        return redirect()->route('sizes.index')->with('success', 'Talla creada con éxito.');
    }

    public function edit(Size $size)
    {
        return view('sizes.edit', compact('size'));
    }

    public function update(Request $request, Size $size)
    {
        $request->validate([
            'name' => 'required|unique:sizes,name,' . $size->id
        ]);

        $size->update($request->all());

        return redirect()->route('sizes.index')->with('success', 'Talla actualizada con éxito.');
    }

    public function destroy(Size $size)
    {
        $size->delete();
        return redirect()->route('sizes.index')->with('success', 'Talla eliminada con éxito.');
    }
}
