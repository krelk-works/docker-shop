@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detalles del Producto: {{ $producto->name }}</h2>

    <!-- Sección de imágenes (vacías por ahora) -->
   
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
          <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
          <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
          <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="{{asset('img/nike.png') }}" class="d-block w-100 img-fluid" alt="Imagen 1">
          </div>
          <div class="carousel-item">
            <img src="{{asset('img/nike.png') }}" class="d-block w-100 img-fluid" alt="Imagen 2">
          </div>
          <div class="carousel-item">
            <img src="{{asset('img/nike.png') }}" class="d-block w-100 img-fluid" alt="Imagen 3">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
</div>

<style>
  #carouselExampleIndicators {
    max-width: 60%; /* Puedes ajustar este valor para cambiar el tamaño general del carrusel */
    margin: 0 auto; /* Centra el carrusel */
  }

  .carousel-inner {
    height: 400px; /* Ajusta la altura según tus necesidades */
  }

  .carousel-item img {
    object-fit: cover; /* Asegura que la imagen cubra el espacio sin deformarse */
    height: 500px; /* Ajusta la altura según tus necesidades */
  }
</style>

    <!-- Descripción -->
    <p><strong>Referéncia del Producto:</strong> {{ $producto->id }}</p>
    <p><strong>Fecha de Creación:</strong> {{ $producto->created_at }}</p>

  <!-- Botones para Editar y Desactivar -->
<div class="mb-4">
<a href="{{ route('shoes.edit', $producto->id) }}" class="btn btn-warning">Editar Producto</a>

    <!-- Botón para abrir el modal -->
    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal">
        Desactivar Producto
    </button>
</div>

<!-- Modal de Confirmación -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Confirmación de Desactivación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                ¿Estás seguro que deseas desactivar este producto?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>

                <!-- Botón de confirmación para desactivar el producto -->
                <form action="{{ route('shoes.deactivate', $producto->id) }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-danger">Desactivar</button>
                </form>
            </div>
        </div>
    </div>
</div>


</div>
@endsection
