@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Producto: {{ $producto->name }}</h2>
    

    <!-- Slider de fotos (placeholder) -->

    <div class="container my-4">
    <div class="row g-2">
        <!-- Imagen grande -->
        <div class="col-12 col-md-6">
            <img src="{{asset('img/nike.png') }}" class="img-fluid rounded" alt="Imagen 1">
        </div>
        <!-- Imágenes pequeñas (2 en fila) -->
        <div class="col-6 col-md-3">
            <img src="{{asset('img/nike2.png') }}" class="img-fluid rounded" alt="Imagen 2">
        </div>
        <div class="col-6 col-md-3">
            <img src="{{asset('img/nike2.png') }}" class="img-fluid rounded" alt="Imagen 3">
        </div>
        <!-- Otra fila con imágenes pequeñas -->
        <div class="col-6 col-md-4">
            <img src="{{asset('img/nike3.png') }}" class="img-fluid rounded" alt="Imagen 4">
        </div>
        <div class="col-6 col-md-4">
            <img src="{{asset('img/nike3.png') }}" class="img-fluid rounded" alt="Imagen 5">
        </div>
        <div class="col-12 col-md-4">
            <img src="{{asset('img/nike.png') }}" class="img-fluid rounded" alt="Imagen 6">
        </div>
    </div>
</div>





    <!-- Botón para añadir nueva foto -->
    <button class="btn btn-primary mb-4">Añadir Nueva Foto</button>

    <!-- Referencia del producto -->
    <p><strong>ID del Producto:</strong> {{ $producto->id }}</p>

    <!-- Tallas del producto -->
    <h4>Tallas Disponibles</h4>
    <ul id="lista-tallas">
        @foreach ($tallasConStock as $item)
    <tr>
        <td>{{ $item['talla'] }}</td>
        <td>{{ $item['stock'] }}</td>
    </tr>
        @endforeach
    </ul>

    <!-- Botones para añadir y eliminar tallas -->
    <button class="btn btn-danger" onclick="mostrarConfirmacionEliminar()">Eliminar Talla</button>

    <!-- Botón para gestionar el stock -->
    <button class="btn btn-info mt-4" onclick="mostrarStock()">Gestionar Stock</button>

    <!-- Tabla de stock oculta por defecto -->
    <div id="tabla-stock" style="display: none;" class="mt-4">
        <h4>Stock de Tallas</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Talla</th>
                    <th>Stock</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tallasConStock as $item)
                    <tr>
                        <td>{{ $item['talla'] }}</td>
                        <td>{{ $item['stock'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        // Función para mostrar la tabla de stock
        function mostrarStock() {
            var tabla = document.getElementById('tabla-stock');
            tabla.style.display = tabla.style.display === 'none' ? 'block' : 'none';
        }
    </script>

    <!-- Botón para eliminar el producto -->
    <button class="btn btn-danger mt-4" onclick="confirmarEliminarProducto()">Eliminar Producto</button>
</div>

<!-- Botón para abrir el modal -->
<button class="btn btn-success mt-4" data-bs-toggle="modal" data-bs-target="#modalAgregarTalla">
    Añadir Nueva Talla
</button>



<!-- Modal para agregar una nueva talla -->
<div class="modal fade" id="modalAgregarTalla" tabindex="-1" aria-labelledby="modalAgregarTallaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAgregarTallaLabel">Añadir Nueva Talla</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('shoes.addSize', $producto->id) }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="talla" class="form-label">Talla</label>
                        <input type="text" class="form-control" id="talla" name="talla" required>
                    </div>
                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="number" class="form-control" id="stock" name="stock" required min="0">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar Talla</button>
                </div>
            </form>
        </div>
    </div>
</div>

@if (session('success'))
    <div class="alert alert-success mt-4">
        {{ session('success') }}
    </div>
@endif



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
