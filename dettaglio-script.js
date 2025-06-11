document.addEventListener("DOMContentLoaded", function() {
  function getParam(name) {
    var query = window.location.search.substring(1);
    var vars = query.split("&");
    for (var i = 0; i < vars.length; i++) {
      var pair = vars[i].split("=");
      if (decodeURIComponent(pair[0]) === name) {
        return decodeURIComponent(pair[1]);
      }
    }
    return null;
  }

  var productId = getParam("id");
  var content = document.querySelector(".content");

  if (!productId) {
    content.innerHTML = "<p>ID prodotto mancante.</p>";
    return;
  }

  fetch("https://raw.githubusercontent.com/gioovannisale02/nike-data/main/db.json")
    .then(function(response) {
      if (!response.ok) {
        return Promise.reject("Errore nella risposta della rete.");
      }
      return response.json();
    })
    .then(function(data) {
      var product = null;
      for (var i = 0; i < data.products.length; i++) {
        if (data.products[i].id == productId) {
          product = data.products[i];
          break;
        }
      }

      if (!product) {
        content.innerHTML = "<p>Prodotto non trovato.</p>";
        return;
      }

      var productHTML = "";
      productHTML += '<div class="product-detail">';
      productHTML += '  <div class="product-image">';
      productHTML += '    <img src="' + product.image + '" alt="' + product.name + '">';
      productHTML += '  </div>';
      productHTML += '  <div class="product-info">';
      productHTML += '    <h2>' + product.name + '</h2>';
      productHTML += '    <form method="POST" action="aggiungi_al_carrello.php">';
      productHTML += '      <div class="price-quantity" style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">';
      productHTML += '        <p style="margin:0;">€ ' + product.price.toFixed(2) + '</p>';
      productHTML += '        <label for="quantita" style="margin-left: 20px;">Quantità:</label>';
      productHTML += '        <input type="number" name="quantita" id="quantita" value="1" min="1" required style="width: 50px; padding: 5px;">';
      productHTML += '      </div>';
      productHTML += '      <input type="hidden" name="id_prodotto" value="' + product.id + '">';
      productHTML += '      <button type="submit" style="padding: 10px 15px; background-color: black; color: white; border: none; cursor: pointer; border-radius: 5px;">Aggiungi al carrello</button>';
      productHTML += '    </form>';
      productHTML += '  </div>';
      productHTML += '</div>';

      content.innerHTML = productHTML;
    })
    .catch(function(error) {
      console.log("Errore nel caricamento dei dati:", error);
      content.innerHTML = "<p>Errore nel caricamento del prodotto.</p>";
    });
});
