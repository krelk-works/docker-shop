@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Producto: {{ $shoe->name }}</h2>
    

    <!-- Slider de fotos (placeholder) -->

    <!-- <div class="container my-4">
    <div class="row g-2"> -->
        <!-- Imagen grande -->
        <!-- <div class="col-12 col-md-6">
            <img src="{{asset('img/nike.png') }}" class="img-fluid rounded" alt="Imagen 1">
        </div> -->
        <!-- Imágenes pequeñas (2 en fila) -->
        <!-- <div class="col-6 col-md-3">
            <img src="{{asset('img/nike2.png') }}" class="img-fluid rounded" alt="Imagen 2">
        </div>
        <div class="col-6 col-md-3">
            <img src="{{asset('img/nike2.png') }}" class="img-fluid rounded" alt="Imagen 3">
        </div> -->
        <!-- Otra fila con imágenes pequeñas -->
        <!-- <div class="col-6 col-md-4">
            <img src="{{asset('img/nike3.png') }}" class="img-fluid rounded" alt="Imagen 4">
        </div>
        <div class="col-6 col-md-4">
            <img src="{{asset('img/nike3.png') }}" class="img-fluid rounded" alt="Imagen 5">
        </div>
        <div class="col-12 col-md-4">
            <img src="{{asset('img/nike.png') }}" class="img-fluid rounded" alt="Imagen 6">
        </div>
    </div> -->

    <!-- Foto principal del producto -->

    <img src="{{ asset('storage/products/' . $shoe->image) }}" alt="Imagen del producto" class="img-fluid" style="max-width: 200px;">

    <form action="{{ route('shoe.update', $shoe->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="photo" class="form-label">Nueva imágen</label>
            <input type="file" name="photo" id="photo" accept="image/*" class="form-control">
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Nombre del Producto</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $shoe->name) }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea name="description" id="description" class="form-control" rows="3">{{ old('description', $shoe->description) }}</textarea>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Precio</label>
            <input type="number" name="price" id="price" class="form-control" step="0.01" value="{{ old('price', $shoe->price) }}" required>
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Categoría</label>
            <select name="category_id" id="category_id" class="form-select" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @if ($category->id == old('category_id', $shoe->category_id)) selected @endif>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <p><strong>ID del Producto:</strong> {{ $shoe->id }}</p>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>

    <!-- Botón para añadir nueva foto, no funciona muy bien -->

    <!-- <button class="btn btn-primary mb-4">Añadir Nueva Foto</button> -->

    <!-- Referencia del producto -->
    



    <!-- Botones para añadir y eliminar tallas -->
    <!-- <button class="btn btn-danger" onclick="mostrarConfirmacionEliminar()">Eliminar Talla</button> -->

    <!-- Botón para abrir el modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tallasModal">
    Ver Tallas Disponibles
</button> -->



<!-- Botón para abrir el modal -->
<!-- <button class="btn btn-success mt-4" data-bs-toggle="modal" data-bs-target="#modalAgregarTalla">
    Añadir Nueva Talla
</button> -->


@if (session('success'))
    <!-- <div class="alert alert-success mt-4">
        {{ session('success') }}
    </div> -->
@endif



<!-- <script>
    // Función para mostrar el cuadro de texto para añadir talla
    function mostrarCuadroNuevaTalla() {
        document.getElementById('cuadro-nueva-talla').style.display = 'block';
    }

    // Función para añadir una nueva talla (simulado)
    function añadirTalla() {
        var nuevaTalla = document.getElementById('nueva-talla').value;
        if (nuevaTalla) {
            var lista = document.getElementById('lista-tallas');
            var nuevaLi = document.createElement('li');
            nuevaLi.textContent = nuevaTalla;
            lista.appendChild(nuevaLi);
            alert('Talla añadida: ' + nuevaTalla);
            document.getElementById('cuadro-nueva-talla').style.display = 'none';
        } else {
            alert('Por favor, escribe una talla.');
        }
    }

    // Función para mostrar confirmación antes de eliminar una talla
    function mostrarConfirmacionEliminar() {
        if (confirm('¿Estás seguro de que deseas eliminar esta talla?')) {
            alert('Talla eliminada (simulación)');
        }
    }

    // Función para mostrar la tabla de stock (simulación)
    function mostrarStock() {
        alert('Tabla de stock mostrada (simulación)');
    }

</script> -->
@endsection
