@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juego de Zapatillas</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
    body { text-align: center; font-family: Arial, sans-serif; }
    .game-container {
        display: flex;
        flex-wrap: wrap; /* Permitir que las cajas se envuelvan en varias filas */
        justify-content: center;
        gap: 20px;
        margin-top: 50px;
    }
    .shoe {
        width: 230px;
        height: 150px;
        cursor: grab;
    }
    .box {
        width: 170px;
        height: 120px;
        display: inline-block;
        background-size: cover;
        background-position: center;
        background-image: url('{{ asset('img/caja_zapatillas.jpg') }}');
    }
</style>
</head>
<body>
    <h1>Arrastra la zapatilla a su caja correcta</h1>
    <p>Tienes <span id="attempts">3</span> intentos</p>
    
    <div class="game-container">
        <img src="{{ asset('img/dunk-low.webp') }}" class="shoe" id="shoe" draggable="true" data-correct="box3">
    </div>
    
    <div class="game-container">
        <div class="box" id="box1"></div>
        <div class="box" id="box2"></div>
        <div class="box" id="box3"></div>
        <div class="box" id="box4"></div>
        <div class="box" id="box5"></div>
        <div class="box" id="box6"></div>
        <div class="box" id="box7"></div>
        <div class="box" id="box8"></div>
        <div class="box" id="box9"></div>
        <div class="box" id="box10"></div>
        

    </div>
    
    <p id="result"></p>
    
    <script>
        let attempts = 3;
        let shoe = document.getElementById('shoe');
        let boxes = document.querySelectorAll('.box');
        let correctBox = shoe.getAttribute('data-correct');

        shoe.addEventListener('dragstart', function(e) {
            e.dataTransfer.setData('shoe', this.id);
        });

        boxes.forEach(box => {
            box.addEventListener('dragover', function(e) {
                e.preventDefault();
            });
            box.addEventListener('drop', function(e) {
                e.preventDefault();
                if (this.id === correctBox) {
                    document.getElementById('result').innerText = "¡Correcto! Has ganado un premio.";
                    saveResult();
                } else {
                    attempts--;
                    document.getElementById('attempts').innerText = attempts;
                    if (attempts === 0) {
                        document.getElementById('result').innerText = "¡Lo siento! No acertaste.";
                    }
                }
            });
        });

        function saveResult() {
            let prizes = ["10% Discount", "20% Discount", "Free Product"];
            let prize = prizes[Math.floor(Math.random() * prizes.length)];

            fetch("{{ route('game.store') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                },
                body: JSON.stringify({ prize: prize })
            })
            .then(response => response.json())
            .then(data => console.log("Prize registered:", data))
            .catch(error => console.error("Error:", error));
        }
    </script>
</body>
</html>
@endsection
