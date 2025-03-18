@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Lista de Modelos</h2>
    <a href="{{ route('models.create') }}" class="btn btn-primary mb-3">Añadir Nuevo Modelo</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Marca</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($models as $model)
                <tr>
                    <td>{{ $model->name }}</td>
                    <td>{{ $model->brand->name }}</td>
                    <td>
                        <a href="{{ route('models.edit', $model->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $model->id }}">
                            Eliminar
                        </button>

                        <!-- Modal Único para este Modelo -->
                        <div class="modal fade" id="deleteModal{{ $model->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $model->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel{{ $model->id }}">Eliminar Modelo</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-left">
                                        ¿Seguro que quieres eliminar el modelo <strong>{{ $model->name }}</strong>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <form action="{{ route('models.destroy', $model->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger">Eliminar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
