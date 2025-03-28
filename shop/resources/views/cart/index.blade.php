@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Carrito de Compras</h2>

    @php
        $total = 0; // Inicializamos el total
    @endphp

    @if(count($cartItems) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Producto</th>
                    <th>Talla</th>
                    <th>Color</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cartItems as $key => $item)
                    @php
                        $subtotal = auth()->check() 
                                    ? ($item->shoe ? $item->shoe->price * $item->quantity : 0) 
                                    : ($item['price'] * $item['quantity']);

                        $total += $subtotal;
                    @endphp

                    <tr>
                        <!-- Imagen del zapato -->
                        <td class="align-middle">
                            @if(auth()->check() && isset($item->shoe->image))
                                <img src="{{ $item->shoe->image }}" alt="{{ $item->shoe->brand->name . ' ' . $item->shoe->model->name }}" class="img-thumbnail" width="80">
                            @elseif(!auth()->check() && isset($item['image']))
                                <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="img-thumbnail" width="80">
                            @else
                                <img src="{{ asset('images/placeholder.png') }}" alt="Imagen no disponible" class="img-thumbnail" width="80">
                            @endif
                        </td>

                        <!-- Nombre del producto con enlace -->
                        <td class="align-middle">
                            @if(auth()->check() && isset($item->shoe))
                                <a href="{{ url('/shoes/preview/' . $item->shoe->id) }}" class="text-decoration-none">
                                    {{ $item->shoe->brand->name . ' ' . $item->shoe->model->name }}
                                </a>
                            @elseif(!auth()->check() && isset($item['name']))
                                <a href="#" class="text-decoration-none">{{ $item['name'] }}</a>
                            @else
                                <span class="text-danger">Zapato no encontrado</span>
                            @endif
                        </td>

                        <!-- Talla -->
                        <td class="align-middle">
                            @if(auth()->check() && isset($item->shoe->size))
                                {{ $item->shoe->size->name }}
                            @elseif(!auth()->check() && isset($item['size']))
                                {{ $item['size'] }}
                            @else
                                <span class="text-danger">-</span>
                            @endif
                        </td>

                        <!-- Color (como cuadrado visual) -->
                        <td class="align-middle">
                            @if(auth()->check() && isset($item->shoe->color))
                                <div style="width: 25px; height: 25px; background-color: {{ $item->shoe->color->hex_code }}; border: 1px solid #000;"></div>
                            @elseif(!auth()->check() && isset($item['color']))
                                <div style="width: 25px; height: 25px; background-color: {{ $item['color'] }}; border: 1px solid #000;"></div>
                            @else
                                <span class="text-danger">-</span>
                            @endif
                        </td>

                        <!-- Precio -->
                        <td class="align-middle">
                            @if(auth()->check() && isset($item->shoe))
                                €{{ number_format($item->shoe->price, 2) }}
                            @elseif(!auth()->check() && isset($item['price']))
                                €{{ number_format($item['price'], 2) }}
                            @else
                                <span class="text-danger">-</span>
                            @endif
                        </td>

                        <!-- Cantidad con botones mejorados -->
                        <td class="align-middle">
                            <div class="d-flex align-items-center">
                                <button class="btn btn-sm btn-outline-danger update-quantity me-2" 
                                    data-id="{{ auth()->check() ? $item->shoe->id : $key }}" 
                                    data-action="decrease">-</button>

                                <input type="text" class="form-control text-center quantity-input" 
                                    value="{{ auth()->check() ? $item->quantity : $item['quantity'] }}" readonly style="width: 50px;">

                                <button class="btn btn-sm btn-outline-success update-quantity ms-2" 
                                    data-id="{{ auth()->check() ? $item->shoe->id : $key }}" 
                                    data-action="increase">+</button>
                            </div>
                        </td>

                        <!-- Subtotal -->
                        <td class="align-middle">€{{ number_format($subtotal, 2) }}</td>

                        <!-- Botón de eliminación -->
                        <td class="align-middle">
                            <form action="{{ route('cart.remove', auth()->check() ? ($item->shoe ? $item->shoe->id : null) : $key) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>


        <div class="d-flex justify-content-between align-items-center">
            <h4>Total: <strong>€{{ number_format($total, 2) }}</strong></h4>

            <div>
                <form action="{{ route('cart.clear') }}" method="POST" class="d-inline">
                    @csrf
                    <button class="btn btn-warning">Vaciar Carrito</button>
                </form>
                
                <form action="{{ route('checkout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">Pagar con Stripe</button>
                </form>            
            </div>
        </div>
    @else
        <p>No hay productos en el carrito.</p>
    @endif
</div>
@endsection
