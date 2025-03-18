@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Zapato</h2>

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
            <label class="form-label">Modelo</label>
            <select name="model_id" class="form-control">
                @foreach($models as $model)
                    <option value="{{ $model->id }}" {{ $shoe->model_id == $model->id ? 'selected' : '' }}>
                        {{ $model->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Categoría</label>
            <select name="category_id" class="form-control">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $shoe->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Precio</label>
            <input type="number" name="price" step="0.01" class="form-control" value="{{ $shoe->price }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Stock</label>
            <input type="number" name="stock" class="form-control" value="{{ $shoe->stock }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Descuento (%)</label>
            <input type="number" name="discount" class="form-control" max="100" value="{{ $shoe->discount }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Imagen Actual</label><br>
            @if($shoe->image)
                <img src="{{ $shoe->image }}" width="100">
            @else
                No Image
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label">Nueva Imagen</label>
            <input type="file" name="image" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Color</label>
            <select name="color_id" class="form-control">
                @foreach($colors as $color)
                    <option value="{{ $color->id }}" {{ $shoe->color_id == $color->id ? 'selected' : '' }}>
                        {{ $color->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Talla</label>
            <select name="size_id" class="form-control">
                @foreach($sizes as $size)
                    <option value="{{ $size->id }}" {{ $shoe->size_id == $size->id ? 'selected' : '' }}>
                        {{ $size->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="featured" class="form-check-input" {{ $shoe->featured ? 'checked' : '' }}>
            <label class="form-check-label">Destacado</label>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="main" class="form-check-input" {{ $shoe->main ? 'checked' : '' }}>
            <label class="form-check-label">Imagen Principal</label>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="active" class="form-check-input" {{ $shoe->active ? 'checked' : '' }}>
            <label class="form-check-label">Activo</label>
        </div>

        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="{{ route('shoes.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
