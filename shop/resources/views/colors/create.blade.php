@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Añadir Nuevo Color</h2>
    <form action="{{ route('colors.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nombre del Color</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Código HEX</label>
            <div class="d-flex">
                <input type="color" id="colorPicker" class="form-control form-control-color me-2" style="width: 60px; height: 40px;">
                <input type="text" name="hex_code" id="hexInput" class="form-control" placeholder="#000000" maxlength="7">
            </div>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('colors.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let colorPicker = document.getElementById('colorPicker');
        let hexInput = document.getElementById('hexInput');

        // Sincronizar cuando cambia el input tipo color
        colorPicker.addEventListener('input', function () {
            hexInput.value = colorPicker.value.toUpperCase();
        });

        // Sincronizar cuando se cambia el valor HEX manualmente
        hexInput.addEventListener('input', function () {
            if (/^#([A-Fa-f0-9]{6})$/.test(hexInput.value)) {
                colorPicker.value = hexInput.value;
            }
        });
    });
</script>
@endsection
