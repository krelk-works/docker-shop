document.addEventListener("DOMContentLoaded", function () {
    // Aquí jQuery YA está disponible, porque app.js se inyecta en <head> o antes de </body>
    // si usas la directiva @vite correctamente.
    $(function () {
        console.log("Usando jQuery en la vista Blade");
    });

    // Local storage variable for cart
    let cart = localStorage.getItem("cart");
    if (!cart) {
        cart = [];
    } else {
        cart = JSON.parse(cart);
    }

    /**
     * Function to add product to cart
     * @param {int} productId
     * @param {string} productName
     * @param {float} price
     * @param {int} quantity
     * @returns {void}
     */
    function addToCart(productId, productName, price, quantity) {
        let product = {
            productId: productId,
            productName: productName,
            price: price,
            quantity: quantity,
        };
        cart.push(product);
        localStorage.setItem("cart", JSON.stringify(cart));
    }

    /**
     * Function to remove product from cart
     * @param {int} productId
     * @returns {void}
     */
    function removeFromCart(productId) {
        cart = cart.filter((product) => product.productId !== productId);
        localStorage.setItem("cart", JSON.stringify(cart));
    }

    /** Function to add or remove product quantity, if quantity is equal to 0 remove the preduct with removeFromCart function */
    function updateQuantity(productId, quantity) {
        cart = cart.map((product) => {
            if (product.productId === productId) {
                product.quantity = quantity;
            }
            return product;
        });
        cart = cart.filter((product) => product.quantity > 0);
        localStorage.setItem("cart", JSON.stringify(cart));
    }

    console.log("Cart loaded  ...");

    // Click event listener on offline-cart class
    const offlineCart = document.querySelector(".offline-cart");
    offlineCart.addEventListener("click", function () {
        console.log("Offline cart clicked ...");
    });
});
