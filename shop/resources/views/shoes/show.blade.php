@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detalles del Producto: {{ $producto->name }}</h2>

    <!-- Sección de imágenes (vacías por ahora) -->
    <div class="mb-4">
        <div style="width: 500px; height: 200px; background-color: #f0f0f0; display: flex; justify-content: center; align-items: center;">
            <span>Sin imagen</span>
        </div>
    </div>

    <!-- Descripción -->
    <p><strong>Referéncia del Producto:</strong> {{ $producto->id }}</p>
    <p><strong>Fecha de Creación:</strong> {{ $producto->created_at }}</p>

    <!-- Botones para Editar y Desactivar -->
    <div class="mb-4">
        <a href="#" class="btn btn-secondary">Editar Producto</a>
        <a href="#" class="btn btn-danger">Desactivar Producto</a>
    </div>

    <!-- Tallas y Stock -->
    <h4>Tallas Disponibles</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Talla</th>
                <th>Stock</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tallas as $talla)
                <tr>
                    <td>{{ $talla['size'] }}</td>
                    <td>{{ $talla['stock'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
