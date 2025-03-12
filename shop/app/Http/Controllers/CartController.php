<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('cart.index');
    }

    public function addToCart(Request $request)
    {
        $shoeId = $request->shoe_id;
        $sizeId = $request->size_id;
        $colorId = $request->color_id;
        $quantity = $request->quantity;

        if (Auth::check()) {
            // Usuario autenticado: guardar en la base de datos
            $cart = Cart::updateOrCreate(
                [
                    'user_id' => Auth::id(),
                    'shoe_id' => $shoeId,
                    'size_id' => $sizeId,
                    'color_id' => $colorId
                ],
                ['quantity' => $quantity]
            );
        } else {
            // Usuario no autenticado: guardar en sesión
            $cartItem = [
                'shoe_id' => $shoeId,
                'size_id' => $sizeId,
                'color_id' => $colorId,
                'quantity' => $quantity
            ];
    
            $cart = session()->get('cart', []);
            $cart[] = $cartItem;
            session()->put('cart', $cart);
        }
    
        return response()->json(['message' => 'Producto añadido al carrito']);
    }

    public function mergeCartAfterLogin()
{
    if (!Auth::check()) {
        return;
    }

    $user = Auth::user();
    $cartItems = session()->get('cart', []);

    foreach ($cartItems as $item) {
        Cart::updateOrCreate(
            [
                'user_id' => $user->id,
                'shoe_id' => $item['shoe_id'],
                'size_id' => $item['size_id'],
                'color_id' => $item['color_id']
            ],
            ['quantity' => $item['quantity']]
        );
    }

    session()->forget('cart');
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
