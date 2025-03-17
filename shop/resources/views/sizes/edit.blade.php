@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Talla</h2>
    <form action="{{ route('sizes.update', $size->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label class="form-label">Nombre de la Talla</label>
            <input type="text" name="name" class="form-control" value="{{ $size->name }}" required>
        </div>
        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="{{ route('sizes.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
