@extends('layouts.app')

@section('title', $category->name)

@section('content')
    @if ($category->active == 1)
        <div class="container">
            <h1 class="mb-4">{{ $category->name }}</h1>
            
            <div class="row">
                @foreach($category->products as $shoe)
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <img src="{{ $shoe->image ? $shoe->image : asset('images/default-shoe.png') }}" class="card-img-top" alt="{{ $shoe->brand->name }} {{ $shoe->model->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $shoe->brand->name }} - {{ $shoe->model->name }}</h5>
                                <p class="card-text"><strong>Precio: </strong>€{{ number_format($shoe->price, 2) }}</p>
                                <p class="card-text"><strong>Stock: </strong>{{ $shoe->stock }}</p>
                                <a href="{{ route('shoes.preview', $shoe->id) }}" class="btn btn-primary">Ver más</a>
                            </div>
                        </div>
                    </div>
                @endforeach

                @if ($category->products->isEmpty())
                    <div class="alert alert-warning" role="alert">
                        No hay productos en esta categoría.
                    </div>
                @endif
            </div>
        </div>
    @else
        <div class="container">
            <h1 class="mb-4">{{ $category->name }}</h1>
            <div class="alert alert-danger" role="alert">
                Esta categoría se encuentra deshabilitada en estos momentos.
            </div>
        </div>
    @endif
@endsection
