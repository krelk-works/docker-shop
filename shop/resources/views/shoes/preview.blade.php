@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-lg border-0 overflow-hidden">
                <div class="row g-0">
                    {{-- Imagen del producto --}}
                    <div class="col-lg-6 d-flex align-items-center bg-light">
                        <img src="{{ asset('storage/products/' . $shoe->image) }}" 
                            class="img-fluid w-100 h-100 object-fit-cover" 
                            alt="{{ $shoe->name }}">
                    </div>
                    
                    {{-- Información del producto --}}
                    <div class="col-lg-6">
                        <div class="card-body p-5">
                            <h2 class="card-title fw-bold">{{ $shoe->name }}</h2>
                            <p class="text-muted fs-5">{{ $shoe->description ?? 'No hay descripción disponible.' }}</p>
                            <h3 class="text-primary fw-bold mb-4">€{{ number_format($shoe->price, 2) }}</h3>

                            <div class="d-grid gap-3">
                                <a href="#" class="btn btn-success btn-lg">
                                    <i class="bi bi-cart-plus"></i> Agregar al carrito
                                </a>
                                <button onclick="window.location='{{ route('merchandising.index') }}';">Personalizar</button>

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
@endsection
