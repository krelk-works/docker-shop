@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Lista de Tallas</h2>
    <a href="{{ route('sizes.create') }}" class="btn btn-primary mb-3">Añadir Nueva Talla</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sizes as $size)
                <tr>
                    <td>{{ $size->name }}</td>
                    <td>
                        <a href="{{ route('sizes.edit', $size->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('sizes.destroy', $size->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que quieres eliminar esta talla?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
