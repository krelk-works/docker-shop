@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center mb-4">Lista de Zapatillas</h2>
    <a href="{{ route('shoes.create') }}" class="btn btn-primary mb-4">Añadir nueva zapatilla</a>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>ID</th>
                <th>Categoria</th>
                <th>Estado</th>
                <th>Acciones</th>
                <th>Editar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($shoes as $shoe)
                <tr>
                    <td><img src="{{ asset('storage/products/' . $shoe->image) }}" alt="Imagen del producto" class="img-fluid" style="max-width: 100px;"></td>
                    <td>{{ $shoe->name }}</td>
                    <td>{{ $shoe->id }}</td>
                    <td>{{ $shoe->category->name }}</td>
                    <td>
                        @if ($shoe->active)
                            <span class="badge bg-success">Activa</span>
                        @else
                            <span class="badge bg-danger">Desactivada</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('shoes.show', $shoe->id) }}" class="btn btn-primary btn-sm">Ver Detalles</a>
                    </td>
                    <td>
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#confirmModal{{ $shoe->id }}">
                            Desactivar
                        </button>
                    </td>
                </tr>


                <!-- Modal de Confirmación -->
                <div class="modal fade" id="confirmModal{{ $shoe->id }}" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmModalLabel">Confirmar Desactivación</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                            </div>
                            <div class="modal-body">
                                ¿Estás seguro de que deseas desactivar el producto "{{ $shoe->name }}"?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <form action="{{ route('shoes.toggle', $shoe->id) }}" method="POST">
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
