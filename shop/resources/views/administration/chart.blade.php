@extends('layouts.app')
@section('content')


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejemplo Gráfico Canvas</title>
    <!-- Enlace opcional a Bootstrap (versión 5) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Gráfico de Ventas en Canvas (Barras)</h1>

    <!-- Canvas donde se renderiza el gráfico -->
    <canvas id="graficoVentas" width="600" height="300"></canvas>
</div>

<script>
    // Datos fijos de ejemplo (mes y beneficio)
    const ventas = [
      { mes: 'Enero',   beneficio: 200 },
      { mes: 'Febrero', beneficio: 350 },
      { mes: 'Marzo',   beneficio: 280 },
      { mes: 'Abril',   beneficio: 450 },
      { mes: 'Mayo',    beneficio: 380 },
    ];

    // Configuraciones básicas
    const anchoCanvas  = 600;
    const altoCanvas   = 300;
    const margen       = 40;

    // Obtenemos el contexto del canvas
    const canvas = document.getElementById('graficoVentas');
    const ctx    = canvas.getContext('2d');

    // Extraemos los beneficios y calculamos el máximo para escalar las barras
    const datos        = ventas.map(v => v.beneficio);
    const maxBeneficio = Math.max(...datos);

    // Ejes X e Y
    ctx.beginPath();
    // Eje X (abajo)
    ctx.moveTo(margen, altoCanvas - margen);
    ctx.lineTo(anchoCanvas - margen, altoCanvas - margen);
    ctx.stroke();
    
    // Eje Y (izquierda)
    ctx.beginPath();
    ctx.moveTo(margen, altoCanvas - margen);
    ctx.lineTo(margen, margen);
    ctx.stroke();

    // Líneas y etiquetas del eje Y
    const numDivisiones = 5;
    for (let i = 0; i <= numDivisiones; i++) {
        const valorY = (maxBeneficio / numDivisiones) * i;
        const posY   = altoCanvas - margen - ((altoCanvas - 2*margen) / numDivisiones) * i;

        // Línea horizontal
        ctx.beginPath();
        ctx.moveTo(margen, posY);
        ctx.lineTo(anchoCanvas - margen, posY);
        ctx.strokeStyle = '#cccccc';
        ctx.stroke();

        // Etiqueta numérica
        ctx.fillStyle = '#000000';
        ctx.fillText(valorY.toFixed(0), 5, posY + 4); 
    }

    // Dibujar barras
    const totalBarras   = ventas.length;
    const anchoBarra    = 40;           // ancho de cada barra
    const espacioBarras = 20;           // espacio entre barras
    const espacioTotal  = anchoCanvas - 2 * margen;
    // Cuánto "salto" en el eje X (aprox.) para cada barra (barras + espacios)
    // Puedes ajustar esta lógica según necesites
    const step = espacioTotal / totalBarras;

    ventas.forEach((venta, index) => {
        const x = margen + index * step + espacioBarras / 2;
        // Altura proporcional de la barra
        const alturaBarra = ((venta.beneficio / maxBeneficio) * (altoCanvas - 2*margen));
        // Posición Y inicial para pintar la barra
        const y = altoCanvas - margen - alturaBarra;

        // Dibujamos la barra
        ctx.fillStyle = '#007bff'; // color de la barra
        ctx.fillRect(x, y, anchoBarra, alturaBarra);

        // Etiqueta de mes (debajo de la barra)
        ctx.fillStyle = '#000000';
        ctx.textAlign = 'center';
        ctx.fillText(venta.mes, x + anchoBarra/2, altoCanvas - margen + 15);

        // Etiqueta del valor encima de la barra
        ctx.fillText(venta.beneficio, x + anchoBarra/2, y - 5);
    });
</script>

<div class="container mt-5">
    <h2>Grafico Stock</h2>
    <canvas id="stockChart" width="600" height="800"></canvas>
</div>


<script>
  // Realizamos la petición a la API para obtener los datos
  fetch('http://localhost:8000/api/stock-chart')
    .then(response => response.json())
    .then(data => {
      const ctx = document.getElementById('stockChart').getContext('2d');

      // Extraemos los nombres de los productos y el stock
      const labels = data.map(item => item.model.name);  // Nombre del modelo
      const stockValues = data.map(item => item.stock);  // Valores de stock

      // Dimensiones del gráfico
      const canvasWidth = 600;
      const canvasHeight = 400;
      const barWidth = 40;
      const barSpacing = 50; // Espaciado entre las barras

      // Escala Y (basada en el valor máximo de stock)
      const maxStock = Math.max(...stockValues);
      const scaleY = canvasHeight / maxStock;

      // Limpiamos el canvas antes de dibujar
      ctx.clearRect(0, 0, canvasWidth, canvasHeight);

      // Dibujamos el fondo del gráfico
      ctx.fillStyle = '#f4f4f9'; // Color de fondo gris claro
      ctx.fillRect(0, 0, canvasWidth, canvasHeight);

      // Ajustar la posición de las barras para que no queden cortadas
      const offsetX = 30;  // Mover las barras a la izquierda para que no se corten

      // Dibujamos las barras
      stockValues.forEach((stock, index) => {
        const x = offsetX + index * (barWidth + barSpacing); // Ajustamos la posición en X
        const y = canvasHeight - stock * scaleY;
        const barHeight = stock * scaleY;

        // Establecemos el color de la barra y el borde
        ctx.fillStyle = 'rgba(75, 192, 192, 0.6)';
        ctx.strokeStyle = 'rgba(0, 123, 255, 1)'; // Color del borde
        ctx.lineWidth = 2;

        // Dibujamos la barra
        ctx.fillRect(x, y, barWidth, barHeight);
        ctx.strokeRect(x, y, barWidth, barHeight); // Dibuja el borde de la barra

        // Dibujamos el texto (nombre del producto) debajo de cada barra
        ctx.fillStyle = 'black';
        ctx.font = '12px Arial';
        ctx.textAlign = 'center';
        ctx.fillText(labels[index], x + barWidth / 2, canvasHeight - 10);  // Texto debajo de la barra

        // Mostrar el stock exacto encima de la barra
        ctx.fillText(stock, x + barWidth / 2, y - 5);  // Mostrar el stock sobre la barra
      });

      // Dibujar la línea de la base del gráfico (eje X)
      ctx.beginPath();
      ctx.moveTo(0, canvasHeight);
      ctx.lineTo(canvasWidth, canvasHeight);
      ctx.strokeStyle = 'black';
      ctx.lineWidth = 2;
      ctx.stroke();

      // Dibujar la línea del eje Y
      ctx.beginPath();
      ctx.moveTo(0, 0);
      ctx.lineTo(0, canvasHeight);
      ctx.stroke();

      // Añadir etiquetas al eje Y
      ctx.fillStyle = 'black';
      ctx.font = '12px Arial';
      ctx.fillText('Stock', 20, 20); // Etiqueta de Y

      // Añadir título al gráfico
      ctx.fillStyle = 'black';
      ctx.font = '16px Arial';
      ctx.fillText('Gráfico de Stock de Productos', canvasWidth / 2, 30); // Título del gráfico
    });
</script>

<canvas id="topShoesChart" width="600" height="400"></canvas>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const ctx = document.getElementById("topShoesChart").getContext("2d");

        // Datos desde Laravel
        const shoeNames = @json($topShoes->pluck('id_shoe'));
        const salesCounts = @json($topShoes->pluck('cart_count'));

        // Dibujar gráfico en Canvas puro
        function drawChart(ctx, labels, values) {
            const maxVal = Math.max(...values);
            const barWidth = 40;
            const spacing = 20;
            const startX = 50;
            const startY = 350;
            const chartHeight = 300;
            
            ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height);
            ctx.font = "14px Arial";
            ctx.textAlign = "center";

            labels.forEach((label, i) => {
                const barHeight = (values[i] / maxVal) * chartHeight;
                const x = startX + i * (barWidth + spacing);
                const y = startY - barHeight;

                ctx.fillStyle = "#4CAF50";
                ctx.fillRect(x, y, barWidth, barHeight);
                ctx.fillStyle = "#000";
                ctx.fillText(values[i], x + barWidth / 2, y - 5);
                ctx.fillText(label, x + barWidth / 2, startY + 15);
            });
        }

        drawChart(ctx, shoeNames, salesCounts);
    });
</script>













</body>
</html>

@endsection
