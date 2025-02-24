<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;  // Ajusta según la ubicación de tu modelo
use App\Models\Shoe;  // Ajusta según la ubicación de tu modelo
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $ultimosProductos = Shoe::orderBy('created_at', 'desc')->take(4)->get();
        $ultimosPedidos = Order::orderBy('created_at', 'desc')->take(4)->get();

        return view('home', compact('ultimosProductos', 'ultimosPedidos'));
        LOG::info('Ultimos productos: ' . $ultimosProductos);
        //return view('home', compact('ultimosProductos'));
    }

    public function login()
    {
        return view('auth.login');
    }
}
