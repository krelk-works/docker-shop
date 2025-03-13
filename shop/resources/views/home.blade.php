@extends('layouts.app')

@section('content')
    <div class="container">

        <video class="custom-video" autoplay loop muted>
            <source src="{{ asset('videos/videoHome.mp4') }}" type="video/mp4">
            Tu navegador no soporta videos.
        </video>

        <br>
        <br>
        <h4>Nuestros Destacados</h4>

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
@endsection
