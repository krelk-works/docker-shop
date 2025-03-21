<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prize;


class GameController extends Controller
{
    public function index()
    {
        return view('game.index');
    }

    public function store(Request $request)
    {
        // Validar que se reciba un premio
        $request->validate(['prize' => 'required|string']);

        // Guardar en la base de datos
        $prize = Prize::create([
            'user_id' => auth()->id() ?? null, // Si hay usuario logueado, lo guarda
            'prize' => $request->prize
        ]);

        return response()->json(['message' => 'Prize registered', 'prize' => $prize]);
    }




}
