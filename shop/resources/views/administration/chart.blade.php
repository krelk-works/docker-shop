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
    <h1>Ejemplo de Gráfico de Ventas en Canvas (Barras)</h1>

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
</body>
</html>
