document.addEventListener("DOMContentLoaded", function () {
    function showCartAlert(message, type = "success") {
        // Crear un ID único para cada alerta
        let alertId = "alert-" + new Date().getTime();
    
        // Crear la alerta con un botón de cierre
        let alertHtml = `
            <div id="${alertId}" class="alert alert-${type} alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;
    
        // Agregar la alerta al contenedor
        $("#alert-container").append(alertHtml);
    
        // Eliminar la alerta automáticamente después de 3 segundos
        setTimeout(() => {
            $("#" + alertId).fadeOut(300, function () {
                $(this).remove();
            });
        }, 3000);
    }

    document.querySelectorAll(".add-to-cart").forEach(button => {
        button.addEventListener("click", function () {
            let productId = this.dataset.id;
            let quantity = 1;

            console.log(productId);
            console.log(quantity);

            showCartAlert("Producto agregado correctamente al carrito.");

            fetch("/cart/add", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({ product_id: productId, quantity: quantity })
            })
            .then(response => response.json())
            .then(data => {
                // alert(data.message);
                const currentBadgeValue = $(".badge").text().trim(); // Limpia espacios al inicio y fin
                // console.log("Badge value: ", currentBadgeValue);

                $(".badge").text(parseInt(currentBadgeValue) + parseInt(quantity));
                
            }).catch(error => {
                console.error("Error:", error);
            });
        });
    });

    document.querySelectorAll(".update-quantity").forEach(button => {
        button.addEventListener("click", function () {
            let productId = this.dataset.id;
            let action = this.dataset.action;

            fetch("/cart/update", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({ product_id: productId, action: action })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload(); // Recargar la página para actualizar el carrito
                }
            }).catch(error => {
                console.error("Error:", error);
            });
        });
    });
});
