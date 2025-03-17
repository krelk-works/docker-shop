<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Shoe;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    // Mostrar carrito
    public function index()
    {
        if (auth()->check()) {
            // Importar automáticamente el carrito local si existe
            $this->importLocalCart();

            // Usuario autenticado: traer carrito desde la BD
            $cartItems = Cart::where('user_id', auth()->id())->with('shoe')->get();
        } else {
            // Usuario invitado: traer carrito desde sesión
            $cartItems = session()->get('cart', []);
        }

        return view('cart.index', compact('cartItems'));
    }

    // Obtener la cantidad total de productos en el carrito
    public function getCartItemCount()
    {
        if (auth()->check()) {
            return Cart::where('user_id', auth()->id())->sum('quantity');
        } else {
            $cart = session()->get('cart', []);
            return array_sum(array_column($cart, 'quantity'));
        }
    }

    // Agregar zapato al carrito
    public function addToCart(Request $request)
    {
        Log::info($request);
        $shoe = Shoe::findOrFail($request->product_id);
        $quantity = $request->quantity ?? 1;

        if (auth()->check()) {
            // Buscar si el zapato ya está en el carrito
            $cartItem = Cart::where('user_id', auth()->id())->where('shoe_id', $shoe->id)->first();
        
            if ($cartItem) {
                // Si ya existe, incrementar la cantidad
                $cartItem->quantity += $quantity;
                $cartItem->save();
            } else {
                // Si no existe, crearlo con la cantidad inicial
                Cart::create([
                    'user_id' => auth()->id(),
                    'shoe_id' => $shoe->id,
                    'quantity' => $quantity,
                ]);
            }
        } else {
            // Carrito en sesión
            $cart = session()->get('cart', []);
            if (isset($cart[$shoe->id])) {
                $cart[$shoe->id]['quantity'] += $quantity;
            } else {
                $cart[$shoe->id] = [
                    "name" => $shoe->brand->name . ' ' . $shoe->model->name,
                    "price" => $shoe->price,
                    "quantity" => $quantity,
                    "image" => $shoe->image
                ];
            }
            session()->put('cart', $cart);
        }
        

        return response()->json(['message' => 'Zapato agregado al carrito']);
    }


    // Eliminar zapato del carrito
    public function removeFromCart($id)
    {
        if (auth()->check()) {
            Cart::where('user_id', auth()->id())->where('shoe_id', $id)->delete();
        } else {
            $cart = session()->get('cart', []);
            if (isset($cart[$id])) {
                unset($cart[$id]);
                session()->put('cart', $cart);
            }
        }

        // return response()->json(['message' => 'Zapato eliminado del carrito']);
        return redirect()->route('cart.index')->with('success', 'Zapato eliminado del carrito.');
    }

    // Vaciar carrito
    public function clearCart()
    {
        if (auth()->check()) {
            Cart::where('user_id', auth()->id())->delete();
        } else {
            session()->forget('cart');
        }

        // return response()->json(['message' => 'Carrito vaciado']);
        return redirect()->route('cart.index')->with('success', 'Carrito vaciado correctamente.');
    }

    public function updateQuantity(Request $request)
    {
        $shoeId = $request->product_id;
        $action = $request->action;

        if (auth()->check()) {
            $cartItem = Cart::where('user_id', auth()->id())->where('shoe_id', $shoeId)->first();

            if ($cartItem) {
                if ($action === 'increase') {
                    $cartItem->quantity += 1;
                } elseif ($action === 'decrease' && $cartItem->quantity > 1) {
                    $cartItem->quantity -= 1;
                }
                $cartItem->save();
            }
        } else {
            $cart = session()->get('cart', []);

            if (isset($cart[$shoeId])) {
                if ($action === 'increase') {
                    $cart[$shoeId]['quantity'] += 1;
                } elseif ($action === 'decrease' && $cart[$shoeId]['quantity'] > 1) {
                    $cart[$shoeId]['quantity'] -= 1;
                }
                session()->put('cart', $cart);
            }
        }

        return response()->json(['success' => true]);
    }

    private function importLocalCart()
    {
        $localCart = session()->get('cart', []);

        if (!empty($localCart)) {
            foreach ($localCart as $key => $item) {
                // Verificar si el zapato existe en la base de datos antes de importarlo
                $shoe = Shoe::find($key);
                if ($shoe) {
                    // Buscar si el usuario ya tiene este zapato en su carrito
                    $cartItem = Cart::where('user_id', auth()->id())->where('shoe_id', $shoe->id)->first();

                    if ($cartItem) {
                        // Si el zapato ya está en el carrito, aumentar la cantidad
                        $cartItem->quantity += $item['quantity'];
                        $cartItem->save();
                    } else {
                        // Si no existe en el carrito, agregarlo
                        Cart::create([
                            'user_id' => auth()->id(),
                            'shoe_id' => $shoe->id,
                            'quantity' => $item['quantity'],
                        ]);
                    }
                }
            }

            // Eliminar el carrito local después de la importación
            session()->forget('cart');

            // Mensaje de éxito en la sesión flash
            session()->flash('success', 'Se ha importado tu carrito local.');
        }
    }



}
