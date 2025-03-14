@extends('layouts.app')
@section('content')

<div class="container">
    <h2>Editar Pedido:</h2>

    <form action="{{ route('order.update', $order->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="status" class="form-label">Estado del Pedido</label>
            <select name="status" id="status" class="form-control">
                <option value="pending" {{ old('status', $order->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="shipped" {{ old('status', $order->status) == 'shipped' ? 'selected' : '' }}>Shipped</option>
                <option value="completed" {{ old('status', $order->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="processing" {{ old('status', $order->status) == 'processing' ? 'selected' : '' }}>Processing</option>
                <option value="cancelled" {{ old('status', $order->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
            <br>
            <button type="submit" class="btn btn-success">Guardar Cambios</button>

        </div>
    </form>
</div>
@endsection