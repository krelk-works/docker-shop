@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Añadir Nuevo Modelo</h2>
    <form action="{{ route('models.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nombre del Modelo</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Marca</label>
            <select name="brand_id" class="form-control" required>
                @foreach($brands as $brand)
                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('models.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
