@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Búsqueda</h1>
        
        <div class="row">
            @foreach($products as $product)
                <div class="col-md-4">
                    <div class="card mb-3">
                        <img src="{{ asset('storage/products/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <p class="card-text"><strong>Precio: </strong>€{{ $product->price }}</p>
                            <a href="{{ route('shoes.preview', $product->id) }}" class="btn btn-primary">Ver más</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
