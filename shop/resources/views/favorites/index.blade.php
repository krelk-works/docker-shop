@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Mis Calzados Favoritos</h2>

    @auth
        <div class="alert alert-success">
            <h4>Hola, {{ auth()->user()->name }} 👋</h4>
            <p>Aquí puedes ver y administrar tus calzados favoritos.</p>
        </div>

        @php
            $favorites = [
                ['id' => 1, 'name' => 'Nike Air Max', 'color' => 'Negro', 'price' => 120, 'image' => 'nike_air_max.jpg'],
                ['id' => 2, 'name' => 'Adidas Ultraboost', 'color' => 'Blanco', 'price' => 150, 'image' => 'adidas_ultraboost.jpg'],
                ['id' => 3, 'name' => 'Puma RS-X', 'color' => 'Rojo', 'price' => 110, 'image' => 'puma_rsx.jpg']
            ];
        @endphp

        @if(count($favorites) > 0)
            <div class="row">
                @foreach($favorites as $favorite)
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="position-relative">
                                <img src="{{ asset('images/' . $favorite['image']) }}" class="card-img-top" alt="{{ $favorite['name'] }}">
                                <button class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2 remove-favorite" data-id="{{ $favorite['id'] }}">
                                    ❌
                                </button>
                            </div>
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ $favorite['name'] }}</h5>
                                <p class="card-text"><strong>{{ number_format($favorite['price'], 2) }} €</strong></p>
                                <p class="text-muted">Color: {{ $favorite['color'] }}</p>
                                <button class="btn btn-primary">Ver Producto</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-warning text-center">
                <h4>No tienes productos en favoritos.</h4>
                <a href="{{ route('shop.index') }}" class="btn btn-primary mt-3">Ir a la Tienda</a>
            </div>
        @endif

    @else
        <div class="alert alert-warning">
            <h4>¡No has iniciado sesión!</h4>
            <p>Para ver tus favoritos, inicia sesión.</p>
            <a href="{{ route('login') }}" class="btn btn-primary">Iniciar Sesión</a>
            <a href="{{ route('register') }}" class="btn btn-secondary">Registrarse</a>
        </div>
    @endauth
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".remove-favorite").forEach(button => {
            button.addEventListener("click", function() {
                let productId = this.dataset.id;
                let card = this.closest(".col-md-4");

                // Simula eliminación con una animación
                card.style.transition = "opacity 0.5s";
                card.style.opacity = "0";
                
                setTimeout(() => {
                    card.remove();
                }, 500);

                console.log("Producto eliminado de favoritos: " + productId);
            });
        });
    });
</script>
@endsection
