@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detalles del Modelo</h2>
    <p><strong>Nombre:</strong> {{ $model->name }}</p>
    <p><strong>Descripción:</strong> {{ $model->description }}</p>
    <a href="{{ route('models.index') }}" class="btn btn-primary">Volver</a>
</div>
@endsection
