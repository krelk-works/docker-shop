@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Marca</h2>
    <form action="{{ route('brands.update', $brand->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label class="form-label">Nombre de la Marca</label>
            <input type="text" name="name" class="form-control" value="{{ $brand->name }}" required>
        </div>
        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="{{ route('brands.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
