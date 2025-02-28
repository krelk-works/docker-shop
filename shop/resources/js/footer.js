window.onload = function() {
    console.log('Footer loaded  ...')

    // 1. Seleccionamos el elemento #app
    const appEl = document.getElementById("app");

    // 2. Obtenemos su ancho (incluye bordes y scrollbar si lo hubiera)
    const appWidth = appEl.scrollHeight;

    // 3. Obtenemos la altura máxima de la página
    //    (scrollHeight suele darte la altura total, incluso si hay scroll)
    //    También puedes usar document.documentElement para mayor consistencia.
    const totalPageHeight = Math.max(
        document.body.scrollHeight,
        document.documentElement.scrollHeight
    );

    console.log('Altura total de la página:', document.body.offsetHeight);
    console.log('Altura de #app:', appWidth);

    // 4. Comparamos
    if (appWidth > totalPageHeight) {
        console.log("El ancho de #app es mayor que la altura total de la página.");

        
       
    } else {
        console.log("La altura total de la página es mayor (o igual) al ancho de #app.");

        
    }
}