document.addEventListener("DOMContentLoaded", function () {
  var container = document.querySelector(".icon-images-container");

  fetch("https://raw.githubusercontent.com/gioovannisale02/nike-data/main/db.json", {
    cache: "no-store"
  })
    .then(function (response) {
      if (!response.ok) {
        // Non lanciamo un errore, ma rifiutiamo la Promise con un messaggio
        return Promise.reject("Errore HTTP: " + response.status);
      }
      return response.json();
    })
    .then(function (data) {
      container.innerHTML = "";

      var filteredProducts = data.products.filter(function (product) {
        return product.family === "show";
      });

      filteredProducts.forEach(function (product) {
        var div = document.createElement("div");
        div.classList.add("icon-image");

        div.innerHTML = ''
          + '<div class="image-wrapper">'
          + '<img src="' + product.image + '" alt="' + product.name + '">'
          + '<a href="' + product.link + '" class="big-look-button">' + product.name + '</a>'
          + '</div>';

        container.appendChild(div);
      });

      if (filteredProducts.length === 0) {
        container.innerHTML = "<p>Nessun prodotto con family 'show'.</p>";
      }
    })
    .catch(function (error) {
      console.log("Errore nel caricamento delle icone: " + error);
      container.innerHTML = "<p>Impossibile caricare le icone.</p>";
    });
});
