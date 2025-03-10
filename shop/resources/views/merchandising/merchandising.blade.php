@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personalizar Producto</title>
    <style>
        /* Estilos para el canvas */
        canvas {
            border: 1px solid #000;
            background-color: white;
        }
    </style>
</head>
<body>

    <h1>Personaliza tu Producto</h1>

    <!-- Controles para color y grosor -->
    <div>
        <label for="colorPicker">Color:</label>
        <input type="color" id="colorPicker" value="#000000">
    </div>

    <div>
        <label for="lineWidth">Grosor del pincel:</label>
        <input type="range" id="lineWidth" min="1" max="10" value="2">
    </div>

    <!-- Canvas para dibujar -->
    <canvas id="canvas" width="500" height="500"></canvas>

    <!-- Botón para borrar el dibujo -->
    <button onclick="clearCanvas()">Borrar</button>

    <!-- Botón para guardar la imagen -->
    <form id="saveForm" method="POST" action="{{ route('merchandising.store') }}">
        @csrf
        <input type="hidden" name="image" id="imageInput">
        <button type="submit">Guardar Diseño</button>
    </form>

    <script>
        // Obtener elementos del DOM
        const canvas = document.getElementById('canvas');
        const ctx = canvas.getContext('2d');
        const colorPicker = document.getElementById('colorPicker');
        const lineWidth = document.getElementById('lineWidth');
        const saveForm = document.getElementById('saveForm');
        const imageInput = document.getElementById('imageInput');

        let drawing = false;

        // Variables para el color y grosor
        let currentColor = colorPicker.value;
        let currentLineWidth = lineWidth.value;

        // Establecer el color y grosor al cambiar las opciones
        colorPicker.addEventListener('input', () => {
            currentColor = colorPicker.value;
        });

        lineWidth.addEventListener('input', () => {
            currentLineWidth = lineWidth.value;
        });

        // Cargar la foto de la camiseta en el canvas
        const shirtImage = new Image();
        shirtImage.src = '/img/camisetaBlanca.jpg';  // Ruta de la camiseta
        shirtImage.onload = () => {
            ctx.drawImage(shirtImage, 0, 0, canvas.width, canvas.height);  // Dibujar la imagen de fondo
        };

        // Funciones para empezar a dibujar
        canvas.addEventListener('mousedown', (e) => {
            drawing = true;
            ctx.beginPath();
            ctx.moveTo(e.offsetX, e.offsetY);
        });

        canvas.addEventListener('mousemove', (e) => {
            if (drawing) {
                ctx.lineTo(e.offsetX, e.offsetY);
                ctx.strokeStyle = currentColor;
                ctx.lineWidth = currentLineWidth;
                ctx.lineCap = 'round';
                ctx.stroke();
            }
        });

        canvas.addEventListener('mouseup', () => {
            drawing = false;
        });

        // Función para borrar el contenido del canvas
        function clearCanvas() {
            ctx.clearRect(0, 0, canvas.width, canvas.height); // Borrar todo lo que hay en el canvas
            ctx.drawImage(shirtImage, 0, 0, canvas.width, canvas.height); // Volver a dibujar la imagen de la camiseta
        }

        // Guardar la imagen como base64
        saveForm.addEventListener('submit', (e) => {
            e.preventDefault();  // Evitar envío de formulario por defecto
            const imageData = canvas.toDataURL('image/png');  // Obtener la imagen en formato base64
            imageInput.value = imageData;  // Guardar la imagen base64 en el campo oculto
            saveForm.submit();  // Enviar el formulario con la imagen
        });
    </script>

</body>
</html>

@endsection