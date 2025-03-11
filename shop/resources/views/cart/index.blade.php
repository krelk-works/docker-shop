@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Carrito de Compras</h2>

    @auth
        <div class="alert alert-success">
            <h4>Bienvenido, {{ auth()->user()->name }} 👋</h4>
            <p>¡Puedes administrar tu carrito y completar la compra!</p>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Imagen</th>
                        <th>Producto</th>
                        <th>Color</th>
                        <th>Talla</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $cart = [
                            ['id' => 1, 'name' => 'Nike Air Max', 'color' => 'Negro', 'size' => '42', 'price' => 120, 'quantity' => 1, 'image' => 'nike_air_max.jpg'],
                            ['id' => 2, 'name' => 'Adidas Ultraboost', 'color' => 'Blanco', 'size' => '41', 'price' => 150, 'quantity' => 2, 'image' => 'adidas_ultraboost.jpg'],
                            ['id' => 3, 'name' => 'Puma RS-X', 'color' => 'Rojo', 'size' => '43', 'price' => 110, 'quantity' => 1, 'image' => 'puma_rsx.jpg']
                        ];
                    @endphp

                    @foreach($cart as $item)
                    <tr>
                        <td><img src="{{ asset('images/' . $item['image']) }}" alt="Zapato" class="img-fluid" style="width: 70px; height: 70px;"></td>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item['color'] }}</td>
                        <td>{{ $item['size'] }}</td>
                        <td>{{ number_format($item['price'], 2) }} €</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center align-items-center">
                                <button class="btn btn-outline-secondary btn-sm quantity-btn" data-action="decrease" data-id="{{ $item['id'] }}">−</button>
                                <span class="mx-2 quantity" data-id="{{ $item['id'] }}">{{ $item['quantity'] }}</span>
                                <button class="btn btn-outline-secondary btn-sm quantity-btn" data-action="increase" data-id="{{ $item['id'] }}">+</button>
                            </div>
                        </td>
                        <td><span class="total-price" data-id="{{ $item['id'] }}">{{ number_format($item['price'] * $item['quantity'], 2) }}</span> €</td>
                        <td>
                            <button class="btn btn-danger btn-sm">Eliminar</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="text-end">
            <h4>Total: <strong id="grand-total">{{ number_format(collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']), 2) }} €</strong></h4>
            <a href="#" class="btn btn-success mt-3">Finalizar Compra</a>
        </div>

    @else
        <div class="alert alert-warning">
            <h4>¡No has iniciado sesión!</h4>
            <p>Para ver y administrar tu carrito de compras, inicia sesión.</p>
            <a href="{{ route('login') }}" class="btn btn-primary">Iniciar Sesión</a>
            <a href="{{ route('register') }}" class="btn btn-secondary">Registrarse</a>
        </div>

        <h4 class="mt-4">Productos destacados</h4>
        <div class="row">
            @php
                $products = [
                    ['name' => 'Nike Air Max', 'price' => 120, 'image' => 'nike_air_max.jpg'],
                    ['name' => 'Adidas Ultraboost', 'price' => 150, 'image' => 'adidas_ultraboost.jpg'],
                    ['name' => 'Puma RS-X', 'price' => 110, 'image' => 'puma_rsx.jpg']
                ];
            @endphp

            @foreach($products as $product)
                <div class="col-md-4">
                    <div class="card mb-3">
                        <img src="{{ asset('images/' . $product['image']) }}" class="card-img-top" alt="{{ $product['name'] }}">
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $product['name'] }}</h5>
                            <p class="card-text"><strong>{{ number_format($product['price'], 2) }} €</strong></p>
                            <a href="{{ route('login') }}" class="btn btn-primary">Iniciar sesión para comprar</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endauth
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let userLoggedIn = @json(auth()->check());

        if (userLoggedIn) {
            console.log("El usuario tiene sesión iniciada.");
        } else {
            console.log("El usuario NO tiene sesión iniciada.");
        }

        // Funcionalidad de botones de cantidad
        document.querySelectorAll(".quantity-btn").forEach(button => {
            button.addEventListener("click", function() {
                let action = this.dataset.action;
                let productId = this.dataset.id;
                let quantityElement = document.querySelector(`.quantity[data-id='${productId}']`);
                let totalPriceElement = document.querySelector(`.total-price[data-id='${productId}']`);
                let pricePerUnit = parseFloat(totalPriceElement.innerText) / parseInt(quantityElement.innerText);
                let currentQuantity = parseInt(quantityElement.innerText);

                if (action === "increase") {
                    currentQuantity++;
                } else if (action === "decrease" && currentQuantity > 1) {
                    currentQuantity--;
                }

                // Actualiza la cantidad en la interfaz
                quantityElement.innerText = currentQuantity;
                totalPriceElement.innerText = (pricePerUnit * currentQuantity).toFixed(2);

                // Recalcula el total general
                let totalGeneral = 0;
                document.querySelectorAll(".total-price").forEach(element => {
                    totalGeneral += parseFloat(element.innerText);
                });
                document.getElementById("grand-total").innerText = totalGeneral.toFixed(2) + " €";
            });
        });
    });
</script>
@endsection
