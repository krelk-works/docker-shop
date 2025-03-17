document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll(".add-to-cart").forEach(button => {
      button.addEventListener("click", function () {
          let productId = this.dataset.id;
          let quantity = 1;

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
              alert(data.message);
          });
      });
  });
});
