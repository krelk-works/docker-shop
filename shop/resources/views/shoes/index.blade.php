@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Lista de Zapatos</h2>
    <a href="{{ route('shoes.create') }}" class="btn btn-primary mb-3">Añadir Nuevo Zapato</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Imagen</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Descuento</th>
                <th>Color</th>
                <th>Talla</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($shoes as $shoe)
                <tr>
                    <td>
                        @if($shoe->image)
                            <img src="{{ $shoe->image }}" width="50" height="50">
                        @else
                            No Image
                        @endif
                    </td>
                    <td>{{ $shoe->brand->name }}</td>
                    <td>{{ $shoe->model->name }}</td>
                    <td>${{ number_format($shoe->price, 2) }}</td>
                    <td>{{ $shoe->stock }}</td>
                    <td>{{ $shoe->discount }}%</td>
                    <td>{{ $shoe->color->name }}</td>
                    <td>{{ $shoe->size->name }}</td>
                    <td>
                        @if($shoe->active)
                            <span class="badge bg-success">Activo</span>
                        @else
                            <span class="badge bg-danger">Inactivo</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('shoes.edit', $shoe->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('shoes.destroy', $shoe->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que quieres eliminar este zapato?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
