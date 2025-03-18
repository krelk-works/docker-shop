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
                        
                        <!-- Botón para abrir el modal -->
                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $color->id }}">
                            Eliminar
                        </button>

                        <!-- Modal de Confirmación -->
                        <div class="modal fade" id="deleteModal{{ $color->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $color->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel{{ $color->id }}">Confirmar Eliminación</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        ¿Seguro que quieres eliminar el color <strong>{{ $color->name }}</strong>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <form action="{{ route('colors.destroy', $color->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- Fin del modal -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
