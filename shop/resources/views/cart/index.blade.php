@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Carrito de Compras</h2>

    @if(count($cartItems) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cartItems as $item)
                    <tr>
                        <td>{{ auth()->check() ? $item->product->name : $item['name'] }}</td>
                        <td>{{ auth()->check() ? $item->product->price : $item['price'] }}€</td>
                        <td>{{ auth()->check() ? $item->quantity : $item['quantity'] }}</td>
                        <td>
                            <form action="{{ route('cart.remove', auth()->check() ? $item->product->id : array_search($item, session('cart', []))) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <form action="{{ route('cart.clear') }}" method="POST">
            @csrf
            <button class="btn btn-warning">Vaciar Carrito</button>
        </form>
    @else
        <p>No hay productos en el carrito.</p>
    @endif
</div>
@endsection
