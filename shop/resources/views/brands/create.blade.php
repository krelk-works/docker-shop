@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Añadir Nueva Marca</h2>
    <form action="{{ route('brands.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nombre de la Marca</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('brands.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
