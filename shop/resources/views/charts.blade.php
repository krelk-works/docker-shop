@extends('layouts.app')
@section('content')

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráfico de Ventas Mensuales</title>
    <style>
        .legend {
            display: flex;
            flex-direction: column;
            margin-top: 20px;
        }
        .legend-item {
            display: flex;
            align-items: center;
            margin-bottom: 5px;
        }
        .legend-color {
            width: 20px;
            height: 20px;
            display: inline-block;
            margin-right: 10px;
            border-radius: 50%;
        }
    </style>
</head>
<body>

    <h2>Ventas Mensuales</h2>
    <canvas id="graficoVentas" width="400" height="400" style="border:1px solid #000;"></canvas>

    <div class="legend" id="legend"></div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            fetch('/charts-data')
                .then(response => response.json())
                .then(data => {
                    if (!data.ventasMensuales || Object.keys(data.ventasMensuales).length === 0) {
                        console.error("No hay datos de ventas.");
                        return;
                    }
                    
                    dibujarGraficoCircular("graficoVentas", data.ventasMensuales);
                    generarLeyenda("legend", data.ventasMensuales);
                })
                .catch(error => console.error('Error cargando datos:', error));
        });

        function dibujarGraficoCircular(canvasId, datos) {
            const canvas = document.getElementById(canvasId);
            if (!canvas) {
                console.error("Canvas no encontrado");
                return;
            }

            const ctx = canvas.getContext("2d");
            ctx.clearRect(0, 0, canvas.width, canvas.height); // Limpiar canvas antes de dibujar

            const totalVentas = Object.values(datos).reduce((a, b) => a + b, 0); // Suma total
            let inicioAngulo = 0;
            const radio = Math.min(canvas.width, canvas.height) / 2 - 10; // Ajustar radio para que quepa en el canvas
            const centroX = canvas.width / 2;
            const centroY = canvas.height / 2;
            const colores = ["#FF5733", "#33FF57", "#3357FF", "#F3FF33", "#FF33F3", "#33FFF3", "#FF8C33", "#8C33FF", "#33FF8C", "#F33D33"];

            let i = 0;
            Object.entries(datos).forEach(([mes, ventas]) => {
                const proporcion = ventas / totalVentas;
                const angulo = proporcion * 2 * Math.PI;

                // Dibujar porción del gráfico
                ctx.beginPath();
                ctx.moveTo(centroX, centroY);
                ctx.arc(centroX, centroY, radio, inicioAngulo, inicioAngulo + angulo);
                ctx.closePath();
                ctx.fillStyle = colores[i % colores.length];
                ctx.fill();
                ctx.strokeStyle = "#FFF";
                ctx.lineWidth = 2;
                ctx.stroke();

                // Dibujar etiquetas dentro del gráfico
                const medioAngulo = inicioAngulo + angulo / 2;
                const x = centroX + Math.cos(medioAngulo) * (radio / 1.5);
                const y = centroY + Math.sin(medioAngulo) * (radio / 1.5);

                ctx.fillStyle = "black";
                ctx.font = "14px Arial";
                ctx.textAlign = "center";
                ctx.textBaseline = "middle";
                ctx.fillText(mes, x, y);

                inicioAngulo += angulo;
                i++;

                console.log(`Mes ${mes}: ${ventas} ventas`);
            });
        }

        function generarLeyenda(legendId, datos) {
            const legendContainer = document.getElementById(legendId);
            legendContainer.innerHTML = ""; // Limpiar leyenda antes de agregar nuevos elementos

            const colores = ["#FF5733", "#33FF57", "#3357FF", "#F3FF33", "#FF33F3", "#33FFF3", "#FF8C33", "#8C33FF", "#33FF8C", "#F33D33"];
            
            let i = 0;
            Object.entries(datos).forEach(([mes, ventas]) => {
                const legendItem = document.createElement("div");
                legendItem.classList.add("legend-item");

                const colorBox = document.createElement("span");
                colorBox.classList.add("legend-color");
                colorBox.style.backgroundColor = colores[i % colores.length];

                const textLabel = document.createElement("span");
                textLabel.textContent = `Mes ${mes}: ${ventas} ventas`;

                legendItem.appendChild(colorBox);
                legendItem.appendChild(textLabel);
                legendContainer.appendChild(legendItem);
                
                i++;
            });
        }
    </script>

</body>
</html>

@endsection