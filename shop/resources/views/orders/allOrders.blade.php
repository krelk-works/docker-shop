@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="text-center mb-4">Lista de Pedidos</h2>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <!-- Buscador de pedidos -->
        <form action="{{ route('orders.search') }}" method="GET" class="mb-4">
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>Buscar por email</th>
                        <th>Selecciona un estado</th>
                        <th>Buscar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <!-- Campo texto para email -->
                        <td>
                            <input type="text" name="email" class="form-control" placeholder="Buscar por email"
                                value="{{ old('email') }}">
                        </td>
                        <!-- Select de estado -->
                        <td>
                            <select name="status" class="form-control" value="{{ old('status') }}">
                                <option value="">Selecciona un estado</option>
                                <option value="pending">Pendiente</option>
                                <option value="shipped">Enviado</option>
                                <option value="completed">Completado</option>
                                <option value="processing">Procesando</option>
                                <option value="cancelled">Cancelado</option>
                            </select>
                        </td>
                        <!-- Botón de búsqueda -->
                        <td>
                            <button type="submit" class="btn btn-primary w-100">
                                Buscar
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID del Pedido</th>
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

                        <td>{{ $order->status }}</td>
                        <td>{{ $order->total }} €</td>
                        <td>{{ $order->created_at }}</td>
                        <td>
                            <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-primary btn-sm">Editar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
