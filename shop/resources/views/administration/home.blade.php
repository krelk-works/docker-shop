@extends('layouts.app')

@section('content')
<div class="container">
    
<!-- Sección de últimos productos -->
<h2>Últimos Productos</h2>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Nombre</th>
            <th class='d-none d-md-table-cell'>Descripción</th>
            <th>Fecha de Creación</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($ultimosProductos as $producto)
            <tr>
                <td>{{ $producto->name }}</td>

                <td class='d-none d-md-table-cell'>{{ $producto->description }}</td>
                <td>{{ $producto->created_at }}</td>
                <td>
                    <!-- Enlace al detalle del producto -->
                    <a href="{{ route('shoes.show', $producto->id) }}" class="btn btn-primary btn-sm">Ver Detalles</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<br>
<h2>Últimos Pedidos</h2>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Numero de Pedido</th>
            <th>Fecha Pedido</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($ultimosPedidos as $pedido)
            <tr>
                <td>{{ $pedido->id }}</td>
                <td>{{ $pedido->created_at }}</td>
                <td>{{ $pedido->status }}</td>
                <td>
                    <!-- Enlace al detalle del pedido -->
                    <a href="#" class="btn btn-primary btn-sm">Ver Detalles</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

</div>
@endsection
