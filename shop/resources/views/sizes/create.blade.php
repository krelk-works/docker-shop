@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Añadir Nueva Talla</h2>
    
    <!-- Mostrar el error en caso de no poder crear la talla -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <h4>Error</h4>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('sizes.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nombre de la Talla</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('sizes.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
