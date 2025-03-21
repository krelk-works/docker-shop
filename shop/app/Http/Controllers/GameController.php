<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        return view('game.index');
    }

    public function store(Request $request)
    {
        $prize = $request->input('prize');

        // Guardar en la base de datos
        Prize::create([
            'user_id' => Auth::id(), // Guarda el ID del usuario si está autenticado
            'prize' => $prize,
        ]);

        return response()->json(['message' => 'Prize registered', 'prize' => $prize]);
    }




}
