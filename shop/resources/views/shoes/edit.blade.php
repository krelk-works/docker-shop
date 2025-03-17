@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Zapato</h2>
    <form action="{{ route('shoes.update', $shoe->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Marca</label>
            <select name="brand_id" class="form-control">
                @foreach($brands as $brand)
                    <option value="{{ $brand->id }}" {{ $shoe->brand_id == $brand->id ? 'selected' : '' }}>
                        {{ $brand->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Imagen Actual</label><br>
            @if($shoe->image)
                <img src="{{ asset('storage/' . $shoe->image) }}" width="100">
            @else
                No Image
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label">Nueva Imagen</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="{{ route('shoes.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
