@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Añadir Nuevo Zapato</h2>

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

    <form action="{{ route('shoes.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Marca</label>
            <select name="brand_id" class="form-control">
                @foreach($brands as $brand)
                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Modelo</label>
            <select name="model_id" class="form-control">
                @foreach($models as $model)
                    <option value="{{ $model->id }}">{{ $model->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Categoría</label>
            <select name="category_id" class="form-control">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Precio</label>
            <input type="number" name="price" step="0.01" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Stock</label>
            <input type="number" name="stock" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Descuento (%)</label>
            <input type="number" name="discount" class="form-control" max="100">
        </div>

        <div class="mb-3">
            <label class="form-label">Imagen</label>
            <input type="file" name="image" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Color</label>
            <select name="color_id" class="form-control">
                @foreach($colors as $color)
                    <option value="{{ $color->id }}">{{ $color->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Talla</label>
            <select name="size_id" class="form-control">
                @foreach($sizes as $size)
                    <option value="{{ $size->id }}">{{ $size->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="featured" class="form-check-input">
            <label class="form-check-label">Destacado</label>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="main" class="form-check-input">
            <label class="form-check-label">Imagen Principal</label>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="active" class="form-check-input" checked>
            <label class="form-check-label">Activo</label>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('shoes.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
