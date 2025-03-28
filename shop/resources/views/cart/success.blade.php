@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h2>¡Pago exitoso!</h2>
    <p>Gracias por tu compra. Recibirás un correo de confirmación pronto.</p>
    <a href="{{ route('cart.index') }}" class="btn btn-primary">Volver al carrito</a>
</div>
@endsection