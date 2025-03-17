@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Lista de Colores</h2>
    <a href="{{ route('colors.create') }}" class="btn btn-primary mb-3">Añadir Nuevo Color</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Nombre</th>
                <th>Código HEX</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($colors as $color)
                <tr>
                    <td>{{ $color->name }}</td>
                    <td>
                        <div style="width: 30px; height: 30px; background-color: {{ $color->hex_code }}; border: 1px solid #000;"></div>
                    </td>
                    <td>
                        <a href="{{ route('colors.edit', $color->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('colors.destroy', $color->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que quieres eliminar este color?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
