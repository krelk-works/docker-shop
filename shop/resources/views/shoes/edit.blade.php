@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Producto: {{ $producto->name }}</h2>

    <!-- Slider de fotos (placeholder) -->
    <h4>Imágenes del Producto</h4>
    <div id="carouselExampleControls" class="carousel slide mb-4" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://via.placeholder.com/400x300" class="d-block w-100" alt="Foto 1">
            </div>
            <!-- Agrega más fotos aquí -->
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Siguiente</span>
        </button>
    </div>

    <!-- Botón para añadir nueva foto -->
    <button class="btn btn-primary mb-4">Añadir Nueva Foto</button>

    <!-- Referencia del producto -->
    <p><strong>ID del Producto:</strong> {{ $producto->id }}</p>

    <!-- Tallas del producto -->
    <h4>Tallas Disponibles</h4>
    <ul id="lista-tallas">
        @foreach ($tallas as $talla)
            <li>{{ $talla }}</li>
        @endforeach
    </ul>

    <!-- Botones para añadir y eliminar tallas -->
    <button class="btn btn-success" onclick="mostrarCuadroNuevaTalla()">Añadir Nueva Talla</button>
    <button class="btn btn-danger" onclick="mostrarConfirmacionEliminar()">Eliminar Talla</button>

    <!-- Botón para gestionar el stock -->
    <button class="btn btn-info mt-4" onclick="mostrarStock()">Gestionar Stock</button>

    <!-- Botón para eliminar el producto -->
    <button class="btn btn-danger mt-4" onclick="confirmarEliminarProducto()">Eliminar Producto</button>
</div>

<!-- Cuadro de diálogo para añadir talla -->
<div id="cuadro-nueva-talla" style="display: none;">
    <h5>Añadir Nueva Talla</h5>
    <input type="text" id="nueva-talla" placeholder="Escribe la talla" class="form-control mb-2">
    <button class="btn btn-primary" onclick="añadirTalla()">Añadir</button>
</div>

<script>
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

    // Función para confirmar la eliminación del producto
    function confirmarEliminarProducto() {
        if (confirm('¿Estás seguro de que deseas eliminar este producto?')) {
            alert('Producto eliminado (simulación)');
        }
    }
</script>
@endsection
