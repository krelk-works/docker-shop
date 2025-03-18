@extends('layouts.app')
@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-lg border-0 overflow-hidden">
                <div class="row g-0">
                    {{-- Imagen del producto --}}
                    <div class="col-lg-6 d-flex align-items-center bg-light">
                        <img id="shoe-image" src="{{ $shoe->image }}" 
                            class="img-fluid w-100 h-100 object-fit-cover" 
                            alt="{{ $shoe->brand->name }} - {{ $shoe->model->name }}">
                    </div>
                    
                    {{-- Información del producto --}}
                    <div class="col-lg-6">
                        <div class="card-body p-5">
                            <h2 class="card-title fw-bold">{{ $shoe->brand->name }} - {{ $shoe->model->name }}</h2>
                            <p class="text-muted fs-5">{{ $shoe->description ?? 'No hay descripción disponible.' }}</p>
                            <h3 class="text-primary fw-bold mb-4">€{{ number_format($shoe->price, 2) }}</h3>

                            {{-- Selección de color --}}
                            <h5>Seleccionar Color:</h5>
                            <div class="d-flex gap-2 mb-3">
                                @foreach($colors as $color)
                                    <button class="color-btn btn" data-image="{{ $color->image_url }}" style="background-color: {{ $color->hex_code }}; width: 30px; height: 30px; border: 1px solid #000;"></button>
                                @endforeach
                            </div>

                            {{-- Tabla de tallas --}}
                            <h5>Seleccionar Talla:</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th>Talla</th>
                                            <th>Disponibilidad</th>
                                            <th>Seleccionar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($sizes as $size)
                                            <tr>
                                                <td>{{ $size->name }}</td>
                                                <td>
                                                    @if($shoe->stock > 0)
                                                        <span class="badge bg-success">Disponible</span>
                                                    @else
                                                        <span class="badge bg-danger">Agotado</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($shoe->stock > 0)
                                                        <input type="radio" name="size_id" value="{{ $size->id }}">
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {{-- Botones de acción --}}
                            <div class="d-grid gap-3 mt-3">
                                <form action="" method="POST">
                                    @csrf
                                    <input type="hidden" name="selected_color" id="selected-color" value="">
                                    <input type="hidden" name="selected_size" id="selected-size" value="">
                                    <button type="submit" class="btn btn-success btn-lg">
                                        <i class="bi bi-cart-plus"></i> Agregar al carrito
                                    </button>
                                </form>

                                <button onclick="window.location='{{ route('merchandising.index') }}';" class="btn btn-info btn-lg">
                                    Personalizar
                                </button>

                                <a href="{{ route('shoes.index') }}" class="btn btn-outline-secondary btn-lg">
                                    <i class="bi bi-arrow-left"></i> Volver a la tienda
                                </a>
                            </div>
                        </div>
                    </div>
                </div> {{-- Fin row --}}
            </div> {{-- Fin card --}}
        </div>
    </div>
</div>

{{-- Script para manejar cambios en color y talla --}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let selectedColorInput = document.getElementById("selected-color");
        let selectedSizeInput = document.getElementById("selected-size");

        // Manejar la selección de colores
        document.querySelectorAll(".color-btn").forEach(button => {
            button.addEventListener("click", function () {
                let newImage = this.getAttribute("data-image");
                document.getElementById("shoe-image").src = newImage;
                selectedColorInput.value = this.style.backgroundColor;
            });
        });

        // Manejar la selección de talla
        document.querySelectorAll('input[name="size_id"]').forEach(input => {
            input.addEventListener("change", function () {
                selectedSizeInput.value = this.value;
            });
        });
    });
</script>

@endsection
