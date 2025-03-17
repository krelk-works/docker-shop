<?php

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    // Mostrar carrito
    public function index()
    {
        if (auth()->check()) {
            // Usuario autenticado: traer carrito desde la BD
            $cartItems = Cart::where('user_id', auth()->id())->with('product')->get();
        } else {
            // Usuario invitado: traer carrito desde sesión
            $cartItems = session()->get('cart', []);
        }

        return view('cart.index', compact('cartItems'));
    }

    // Agregar producto al carrito
    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $quantity = $request->quantity ?? 1;

        if (auth()->check()) {
            // Guardar en BD si el usuario está logueado
            $cartItem = Cart::updateOrCreate(
                ['user_id' => auth()->id(), 'product_id' => $product->id],
                ['quantity' => \DB::raw("quantity + $quantity")]
            );
        } else {
            // Guardar en sesión si el usuario no está autenticado
            $cart = session()->get('cart', []);
            if (isset($cart[$product->id])) {
                $cart[$product->id]['quantity'] += $quantity;
            } else {
                $cart[$product->id] = [
                    "name" => $product->name,
                    "price" => $product->price,
                    "quantity" => $quantity
                ];
            }
            session()->put('cart', $cart);
        }

        return response()->json(['message' => 'Producto agregado al carrito']);
    }

    // Eliminar producto del carrito
    public function removeFromCart($id)
    {
        if (auth()->check()) {
            Cart::where('user_id', auth()->id())->where('product_id', $id)->delete();
        } else {
            $cart = session()->get('cart', []);
            if (isset($cart[$id])) {
                unset($cart[$id]);
                session()->put('cart', $cart);
            }
        }

        return response()->json(['message' => 'Producto eliminado del carrito']);
    }

    // Vaciar carrito
    public function clearCart()
    {
        if (auth()->check()) {
            Cart::where('user_id', auth()->id())->delete();
        } else {
            session()->forget('cart');
        }

        return response()->json(['message' => 'Carrito vaciado']);
    }
}
