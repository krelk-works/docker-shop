@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Lista de Marcas</h2>
    <a href="{{ route('brands.create') }}" class="btn btn-primary mb-3">Añadir Nueva Marca</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($brands as $brand)
            <tr>
                <td>{{ $brand->name }}</td>
                <td>
                    <a href="{{ route('brands.edit', $brand->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <button class="btn btn-danger btn-sm delete-btn" type="button" data-bs-toggle="modal" data-bs-target="#deleteBrandModal" data-id="{{ $brand->id }}">Eliminar</button>

                    <!-- Modal -->
                    <div class="modal fade" id="deleteBrandModal" tabindex="-1" aria-labelledby="deleteBrandModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteBrandModalLabel">Confirmar Eliminación</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    ¿Seguro que quieres eliminar esta marca?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <form id="deleteBrandForm" action="{{ route('brands.destroy', $brand->id) }}" method="GET" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
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
