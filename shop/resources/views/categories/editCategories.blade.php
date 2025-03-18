@extends('layouts.app')

@section('content')

<div class="container">
    <h2>Editar Categoría</h2>

    {{-- Formulario para editar la categoría --}}
    <form action="{{ route('category.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nombre de la Categoría</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $category->name) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>

    {{-- Botón para eliminar la categoría --}}
    <button type="button" class="btn btn-danger mt-3" data-bs-toggle="modal" data-bs-target="#deleteModal">
        Eliminar Categoría
    </button>

    {{-- Modal de confirmación para eliminar la categoría --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirmar Eliminación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar esta categoría?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <form action="{{ route('category.destroy', $category->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
