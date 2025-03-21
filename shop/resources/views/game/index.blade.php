<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juego Drag & Drop - Premios</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 20px;
        }
        #game-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        #box {
            width: 100px;
            height: 100px;
            background-color: orange;
            border: 2px solid black;
            text-align: center;
            line-height: 100px;
            font-size: 20px;
            font-weight: bold;
            cursor: grab;
            margin: 20px;
        }
        #dropzone {
            width: 150px;
            height: 150px;
            border: 3px dashed black;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 18px;
            margin-top: 20px;
        }
        #message {
            font-size: 20px;
            margin-top: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <h1>🎉 ¡Juega y gana un premio! 🎉</h1>
    <p>Arrastra la caja hasta la zona de premios antes de que termine el tiempo.</p>
    
    <div id="game-container">
        <div id="box" draggable="true">🎁</div>
        <div id="dropzone">🏆 Zona de premios</div>
        <p id="timer">Tiempo: <span id="countdown">10</span> segundos</p>
        <p id="message"></p>
    </div>

    <script>
        let box = document.getElementById("box");
        let dropzone = document.getElementById("dropzone");
        let message = document.getElementById("message");
        let countdown = document.getElementById("countdown");
        let timeLeft = 10;
        let gameActive = true;

        // Timer de 10 segundos
        let timer = setInterval(() => {
            if (timeLeft > 0) {
                timeLeft--;
                countdown.textContent = timeLeft;
            } else {
                clearInterval(timer);
                if (gameActive) {
                    message.textContent = "⏳ ¡Tiempo agotado! No ganaste nada.";
                    box.draggable = false;
                }
            }
        }, 1000);

        // Arrastrar elemento
        box.addEventListener("dragstart", (event) => {
            event.dataTransfer.setData("text", "box");
        });

        // Permitir soltar en la zona
        dropzone.addEventListener("dragover", (event) => {
            event.preventDefault();
        });

        // Soltar el objeto y asignar premio
        dropzone.addEventListener("drop", (event) => {
            event.preventDefault();
            if (!gameActive) return;

            let data = event.dataTransfer.getData("text");
            if (data === "box") {
                gameActive = false;
                box.style.display = "none"; // Oculta la caja

                let premios = ["🎁 ¡Producto gratis!", "🏷️ ¡30% de descuento!", "😞 Nada, suerte la próxima."];
                let premioGanado = premios[Math.floor(Math.random() * premios.length)];

                message.textContent = `🎉 ¡Felicidades! ${premioGanado}`;
                clearInterval(timer); // Detiene el contador

                // Enviar premio al backend para registrar en la base de datos (opcional)
                fetch("{{ route('game.store') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ prize: premioGanado })
            }).then(response => response.json())
            .then(data => console.log("Prize registered:", data))
            .catch(error => console.error("Error:", error));

            }
        });
    </script>

</body>
</html>
