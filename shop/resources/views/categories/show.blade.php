@extends('layouts.app')

@section('title', $category->name)

@section('content')
    @if ($category->active == 1)
        <div class="container py-4">
            <h1 class="mb-4 text-center">{{ $category->name }}</h1>
            
            <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
                @foreach($category->products as $shoe)
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            <div class="position-relative">
                                <a href="{{ route('shoes.preview', $shoe->id) }}">
                                    <img src="{{ $shoe->image ? $shoe->image : asset('images/default-shoe.png') }}" class="card-img-top p-3 img-fluid" alt="{{ $shoe->brand->name }} {{ $shoe->model->name }}" style="object-fit: cover; height: 250px; border-radius: 10px;">
                                </a>
                                @if ($shoe->stock < 50)
                                    <div class="position-absolute top-0 end-0 bg-warning text-dark p-1 m-2 rounded" style="font-size: 0.8rem;">
                                        Quedan {{ $shoe->stock }} en stock
                                    </div>
                                @endif
                                @if ($shoe->discount > 0)
                                    <div class="position-absolute bottom-0 end-0 bg-danger text-white p-1 m-2 rounded" style="font-size: 0.8rem;">
                                        -{{ $shoe->discount }}%
                                    </div>
                                @endif
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $shoe->brand->name }} {{ $shoe->model->name }}</h5>
                                <p class="card-text mb-2">
                                    <strong>Precio:</strong>
                                    @if ($shoe->discount > 0)
                                        <span class="text-decoration-line-through text-muted">€{{ number_format($shoe->price, 2) }}</span>
                                        <span class="text-success fw-bold"> €{{ number_format($shoe->price * (1 - $shoe->discount / 100), 2) }}</span>
                                    @else
                                        €{{ number_format($shoe->price, 2) }}
                                    @endif
                                </p>
                                
                                <div class="mt-auto d-flex justify-content-center">
                                    <button class="btn btn-outline-primary add-to-cart d-flex align-items-center" data-id="{{ $shoe->id }}">
                                        <i class="bi bi-cart-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                @if ($category->products->isEmpty())
                    <div class="col-12">
                        <div class="alert alert-warning text-center" role="alert">
                            No hay productos en esta categoría.
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @else
        <div class="container py-4">
            <h1 class="mb-4 text-center">{{ $category->name }}</h1>
            <div class="alert alert-danger text-center" role="alert">
                Esta categoría se encuentra deshabilitada en estos momentos.
            </div>
        </div>
    @endif
@endsection