

@extends('layouts.app')

@section('content')
<div class="container">
<h2 class="my-4">Registrar Nueva Categoría</h2>

    {{-- Formulario para crear una categoría --}}
    <form action="{{ route('category.store') }}" method="POST">
        @csrf {{-- Token de seguridad obligatorio en Laravel --}}
        
        <div class="mb-3">
            <label for="name" class="form-label">Nombre de la Categoría</label>

            <input type="text" name="name" id="name" class="form-control" required>
            @error('name')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('category.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

@endsection