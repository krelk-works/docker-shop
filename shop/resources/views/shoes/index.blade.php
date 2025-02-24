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
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($shoes as $shoe)
                <tr>
                    <td><img src="{{ asset('img/nike.png') }}" alt="Imagen del producto" class="img-fluid" style="max-width: 100px;"></td>
                    <td>{{ $shoe->name }}</td>
                    <td>{{ $shoe->id }}</td>
                    <td>
                        <a href="{{ route('shoes.show', $shoe->id) }}" class="btn btn-primary btn-sm">Ver Detalles</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
