@extends('layouts.app')

@section('content')

<div class="container">
    <h2 class="text-center mb-4">Lista de Categorias</h2>
    <a href="{{ route('category.create') }}" class="btn btn-primary mb-4">Añadir nueva categoria</a>


@if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
@endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Estado</th>
                <th>Acciones</th>
                <th>Editar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        @if ($category->active)
                            <span class="badge bg-success">Activa</span>
                        @else
                            <span class="badge bg-danger">Desactivada</span>
                        @endif
                    </td>
                    <td>
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#confirmModal{{ $category->id }}">
                            Desactivar
                        </button>
                    </td>
                    <td>
                        <a href="{{ route('category.edit', $category->id) }}" class="btn btn-primary">Editar</a>
                </tr>

                <!-- Modal de Confirmación -->
                <div class="modal fade" id="confirmModal{{ $category->id }}" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmModalLabel">Confirmar Desactivación</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                            </div>
                            <div class="modal-body">
                                ¿Estás seguro de que deseas desactivar la categoría "{{ $category->name }}"?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <form action="{{ route('categories.toggle', $category->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Desactivar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach
        </tbody>
    </table>
</div>
@endsection

