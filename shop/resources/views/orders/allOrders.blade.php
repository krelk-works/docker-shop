@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="text-center mb-4">Lista de Pedidos</h2>

@if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
@endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID del Pedidoo</th>
                <th>Usuario</th>
                <th>Email Usuario</th>
                <th>Estado</th>
                <th>Precio Total</th>
                <th>Fecha Pedido</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>{{ $order->user->email }}</td>

                    <td>{{$order->status}}</td>
                    <td>{{$order->total}} €</td>
                    <td>{{$order->created_at}}</td>
                    <td>
                        <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-primary btn-sm">Editar</a>
                    </td>
                </tr>

            @endforeach
        </tbody>
    </table>
</div>
@endsection
