<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Shoe;
use Illuminate\Support\Facades\Session;

use Stripe\Stripe;
use Stripe\Checkout\Session as SessionStripe;

class CartController extends Controller
{
    /**
     * Verifica si el usuario está autenticado.
     *
     * @return bool
     * @private
     */
    private function isUserAuthenticated()
    {
        return auth()->check();
    }

    /**
     * Muestra la vista del carrito con los productos agregados.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if (auth()->check()) {
            $this->importLocalCart();
            $cartItems = Cart::where('user_id', auth()->id())->with('shoe')->get();
        } else {
            $cartItems = session()->get('cart', []);
        }

        return view('cart.index', compact('cartItems'));
    }

    /**
     * Obtiene la cantidad total de productos en el carrito.
     *
     * @return int
     */
    public function getCartItemCount()
    {
        if (auth()->check()) {
            return Cart::where('user_id', auth()->id())->sum('quantity');
        } else {
            $cart = session()->get('cart', []);
            return array_sum(array_column($cart, 'quantity'));
        }
    }

    /**
     * Agrega un zapato al carrito.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addToCart(Request $request)
    {
        Log::info($request);
        $shoe = Shoe::findOrFail($request->product_id);
        $quantity = $request->quantity ?? 1;

        if ($this->isUserAuthenticated()) {
            $cartItem = Cart::where('user_id', auth()->id())->where('shoe_id', $shoe->id)->first();
        
            if ($cartItem) {
                $cartItem->quantity += $quantity;
                $cartItem->save();
            } else {
                Cart::create([
                    'user_id' => auth()->id(),
                    'shoe_id' => $shoe->id,
                    'quantity' => $quantity,
                ]);
            }
        } else {
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

    /**
     * Elimina un zapato del carrito.
     *
     * @param int $id ID del zapato
     * @return \Illuminate\Http\RedirectResponse
     */
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

        return redirect()->route('cart.index')->with('success', 'Zapato eliminado del carrito.');
    }

    /**
     * Vacía completamente el carrito del usuario.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function clearCart()
    {
        if (auth()->check()) {
            Cart::where('user_id', auth()->id())->delete();
        } else {
            session()->forget('cart');
        }

        return redirect()->route('cart.index')->with('success', 'Carrito vaciado correctamente.');
    }

    /**
     * Actualiza la cantidad de un zapato en el carrito (aumentar o disminuir).
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateQuantity(Request $request)
    {
        $shoeId = $request->product_id;
        $action = $request->action;

        if ($this->isUserAuthenticated()) {
            $cartItem = Cart::where('user_id', auth()->id())->where('shoe_id', $shoeId)->first();

            $isIncreasing = $action === 'increase';
            $isDecreasing = $action === 'decrease' && $cartItem->quantity > 1;

            if ($cartItem) {
                if ($isIncreasing) {
                    $cartItem->quantity += 1;
                } elseif ($isDecreasing) {
                    $cartItem->quantity -= 1;
                }
                $cartItem->save();
            }
        } else {
            $cart = session()->get('cart', []);

            if (isset($cart[$shoeId])) {
                $isIncreasing = $action === 'increase';
                $isDecreasing = $action === 'decrease' && $cart[$shoeId]['quantity'] > 1;

                if ($isIncreasing) {
                    $cart[$shoeId]['quantity'] += 1;
                } elseif ($isDecreasing) {
                    $cart[$shoeId]['quantity'] -= 1;
                }

                session()->put('cart', $cart);
            }
        }

        return response()->json(['success' => true]);
    }

    /**
     * Importa los productos del carrito local (en sesión) al carrito del usuario autenticado en la base de datos.
     *
     * @return void
     * @private
     */
    private function importLocalCart()
    {
        $localCart = session()->get('cart', []);

        if (!empty($localCart)) {
            foreach ($localCart as $key => $item) {
                $shoe = Shoe::find($key);
                if ($shoe) {
                    $cartItem = Cart::where('user_id', auth()->id())->where('shoe_id', $shoe->id)->first();

                    if ($cartItem) {
                        $cartItem->quantity += $item['quantity'];
                        $cartItem->save();
                    } else {
                        Cart::create([
                            'user_id' => auth()->id(),
                            'shoe_id' => $shoe->id,
                            'quantity' => $item['quantity'],
                        ]);
                    }
                }
            }

            session()->forget('cart');
            session()->flash('success', 'Se ha importado tu carrito local.');
        }
    }

       // Checkout con Stripe
       public function checkout(Request $request)
       {
            Stripe::setApiKey(env('STRIPE_SECRET'));
            $cart = null;

            if (auth()->check()) {
                $cart = Cart::where('user_id', auth()->id())->sum('quantity');
            } else {
                $cart_s = session()->get('cart', []);
                $cart = array_sum(array_column($cart_s, 'quantity'));
            }
   
           // $cart = Cart::where('user_id', auth()->id())->first();
           $cartItems = $cart ? $cart->cartShoe : [];
   
           $lineItems = [];
           foreach ($cartItems as $item) {
               $lineItems[] = [
                   'price_data' => [
                       'currency' => 'eur',
                       'product_data' => [
                           'name' => $item->shoe->name,
                       ],
                       'unit_amount' => $item->shoe->price * 100,
                   ],
                   'quantity' => $item->quantity,
               ];
           }
   
           $session = StripeSession::create([
               'payment_method_types' => ['card'],
               'line_items' => $lineItems,
               'mode' => 'payment',
               'success_url' => route('payment.success'),
               'cancel_url' => route('cart.index'),
           ]);
   
           return redirect($session->url);
       }
   
       // Página de éxito
       public function success()
       {
           return view('cart.success');
       }




}
