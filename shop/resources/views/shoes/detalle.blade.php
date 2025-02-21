@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center mb-4">{{ $producto->name }}</h2>

    <div class="card mx-auto" style="max-width: 500px;">
        <img src="{{ asset('img/default.jpg') }}" class="card-img-top" alt="Imagen del producto">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $producto->id }}</p>
            <p><strong>Descripción:</strong> {{ $producto->description ?? 'Sin descripción' }}</p>
            <p><strong>Precio:</strong> ${{ $producto->price ?? 'No especificado' }}</p>
            <a href="{{ route('productos.index') }}" class="btn btn-secondary">Volver a Productos</a>
        </div>
    </div>
</div>
@endsection
