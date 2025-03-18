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
                        
                        <!-- Botón para abrir el modal -->
                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $size->id }}">
                            Eliminar
                        </button>

                        <!-- Modal de Confirmación -->
                        <div class="modal fade" id="deleteModal{{ $size->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $size->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel{{ $size->id }}">Confirmar Eliminación</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        ¿Seguro que quieres eliminar la talla <strong>{{ $size->name }}</strong>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <form action="{{ route('sizes.destroy', $size->id) }}" method="POST" style="display:inline;">
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
