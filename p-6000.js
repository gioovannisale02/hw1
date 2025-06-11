document.addEventListener("DOMContentLoaded", function() {
  var container = document.querySelector(".content");

  fetch("https://raw.githubusercontent.com/gioovannisale02/nike-data/main/db.json")
    .then(function(response) {
      if (!response.ok) {
        container.innerHTML = "<p>Errore nel caricamento dei prodotti.</p>";
        return null;
      }
      return response.json();
    })
    .then(function(data) {
      if (!data) return;

      var airForceProducts = data.products.filter(function(product) {
        return product.family === "P-6000";
      });

      if (airForceProducts.length === 0) {
        container.innerHTML = "<p>Nessun prodotto disponibile.</p>";
        return;
      }

      airForceProducts.forEach(function(product) {
        var productElement = document.createElement("div");
        productElement.classList.add("product");

        productElement.innerHTML =
          '<a href="dettaglio.php?id=' + product.id + '">' +
          '<img src="' + product.image + '" alt="' + product.name + '">' +
          '<h3>' + product.name + '</h3>' +
          '<p>€ ' + product.price.toFixed(2) + '</p>' +
          '</a>';

        container.appendChild(productElement);
      });
    })
    .catch(function(error) {
      console.log("Errore nel caricamento dei prodotti:", error);
      container.innerHTML = "<p>Errore nel caricamento dei prodotti.</p>";
    });
});
