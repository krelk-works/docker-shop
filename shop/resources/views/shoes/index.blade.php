@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center mb-4">Lista de Zapatillas</h2>
    <a href="{{ route('shoes.create') }}" class="btn btn-primary">Añadir nueva zapatilla</a>
    <br>
    <br>
    <div class="row">
        @foreach($shoes as $shoe)
            <div class="col-md-4 mb-3">

                <div class="card">
                    <img src="{{ asset('img/nike.png') }}" class="card-img-top" alt="Imagen del producto">
                    <div class="card-body">
                        <h5 class="card-title">{{ $shoe->name }}</h5>
                        <p class="card-text">ID: {{ $shoe->id }}</p>
                        <a href="{{ route('shoes.index', $shoe->id) }}" class="btn btn-primary">Ver Detalles</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
