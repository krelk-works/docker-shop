@extends('layouts.app')

@section('content')
<div class="container">
    <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="10000">
        <img src="{{asset('img/img_slider1.png') }}" alt="Producto">
        </div>
        <div class="carousel-item" data-bs-interval="2000">
        <img src="{{asset('img/img_slider1.png') }}" alt="Producto">
        </div>
        <div class="carousel-item">
        <img src="{{asset('img/img_slider1.png') }}" alt="Producto">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
    <br>
    <br>
    <h4>Nuestros Destacados</h4>
    <style>
        /* Imágenes cuadradas */
        .image-container img {
            width: 100%;
            aspect-ratio: 1/1; /* Hace que todas sean cuadradas */
            object-fit: cover; /* Evita deformaciones */
            border-radius: 8px; /* Opcional: bordes redondeados */
        }

        /* Scroll horizontal en móviles */
        .image-slider {
            display: flex;
            overflow-x: auto;
            gap: 10px;
            padding-bottom: 10px;
            scrollbar-width: thin; /* Oculta la barra en algunos navegadores */
        }

        .image-slider::-webkit-scrollbar {
            display: none; /* Oculta la barra en Chrome y Safari */
        }

        .image-slider img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
        }

        @media (min-width: 768px) {
            .image-slider { overflow-x: hidden; } /* Oculta el scroll en pantallas grandes */
        }
    </style>

    <div class="container mt-4">
        <!-- Para pantallas grandes (Grid) -->
        <div class="row image-container d-none d-md-flex">
            <div class="col-6 col-md-3"><img src="{{asset('img/nikeDunk.png') }}" alt="Imagen 1"></div>
            <div class="col-6 col-md-3"><img src="{{asset('img/nikeRunning.png') }}" alt="Imagen 2"></div>
            <div class="col-6 col-md-3"><img src="{{asset('img/nikeDunk.png') }}" alt="Imagen 3"></div>
            <div class="col-6 col-md-3"><img src="{{asset('img/nikeRunning.png') }}" alt="Imagen 4"></div>
        </div>

        <!-- Para móviles (Scroll horizontal) -->
        <div class="image-slider d-flex d-md-none">
            <img src="https://via.placeholder.com/100" alt="Imagen 1">
            <img src="https://via.placeholder.com/100" alt="Imagen 2">
            <img src="https://via.placeholder.com/100" alt="Imagen 3">
            <img src="https://via.placeholder.com/100" alt="Imagen 4">
        </div>
    </div>







    </div>
    
</div>

<style>
        .carousel-item img {
            width: 100%;
            height: 400px; /* Ajusta la altura */
            object-fit: cover; /* Evita deformaciones */
        }
    </style>
@endsection