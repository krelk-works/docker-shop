@extends('layouts.app')

@section('content')
    <div class="container">

        <video class="custom-video" autoplay loop muted>
            <source src="{{ asset('videos/videoHome.mp4') }}" type="video/mp4">
            Tu navegador no soporta videos.
        </video>

        <style>
            .custom-video {
                width: 100%;
                /* Ocupa todo el ancho */
                height: 50vh;
                /* Ajusta la altura al 50% de la pantalla */
                object-fit: cover;
                /* Recorta el video para que se vea bien */
            }
        </style>

        <br>
        <br>
        <h4>Nuestros Destacados</h4>

        <style>
            /* Imágenes cuadradas */
            .image-container img {
                width: 100%;
                aspect-ratio: 1/1;
                /* Hace que todas sean cuadradas */
                object-fit: cover;
                /* Evita deformaciones */
                border-radius: 8px;
                /* Opcional: bordes redondeados */
            }

            /* Scroll horizontal en móviles */
            .image-slider {
                display: flex;
                overflow-x: auto;
                gap: 10px;
                padding-bottom: 10px;
                scrollbar-width: thin;
                /* Oculta la barra en algunos navegadores */
            }

            .image-slider::-webkit-scrollbar {
                display: none;
                /* Oculta la barra en Chrome y Safari */
            }

            .image-slider img {
                width: 100px;
                height: 100px;
                object-fit: cover;
                border-radius: 8px;
            }

            @media (min-width: 768px) {
                .image-slider {
                    overflow-x: hidden;
                }

                /* Oculta el scroll en pantallas grandes */
            }
        </style>

        <div class="container mt-4">
            <!-- Para pantallas grandes (Grid) -->
            <div class="row image-container d-none d-md-flex">
                <div class="col-6 col-md-3"><img src="{{ asset('img/nikeDunk.png') }}" alt="Imagen 1"></div>
                <div class="col-6 col-md-3"><img src="{{ asset('img/nikeRunning.png') }}" alt="Imagen 2"></div>
                <div class="col-6 col-md-3"><img src="{{ asset('img/nikeDunk.png') }}" alt="Imagen 3"></div>
                <div class="col-6 col-md-3"><img src="{{ asset('img/nikeRunning.png') }}" alt="Imagen 4"></div>
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

    <style>
        .carousel-item img {
            width: 100%;
            height: 400px;
            /* Ajusta la altura */
            object-fit: cover;
            /* Evita deformaciones */
        }
    </style>
@endsection
