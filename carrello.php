<?php
session_start();
if (!isset($_SESSION['utente'])) {
    header("Location: login.php");
    exit;
}

require_once "server.php"; // Connessione al DB

$id_utente = $_SESSION['utente']['id'];

// Recupero i dati dei prodotti dall'API esterna
$api_json = file_get_contents("https://raw.githubusercontent.com/gioovannisale02/nike-data/main/db.json");
if ($api_json === false) {
    die("Errore nel recupero dei dati dei prodotti dall'API.");
}
$api_data = json_decode($api_json, true);
$prodotti_api = $api_data['products'] ?? $api_data; // fallback se non è dentro 'products'

// Creo una mappa di lookup [id_prodotto => dettagli]
$prodotti_lookup = [];
foreach ($prodotti_api as $p) {
    $prodotti_lookup[$p['id']] = $p;
}

// Recupero dal database i prodotti nel carrello dell’utente
$sql = "SELECT * FROM carrello WHERE id_utente = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_utente);
$stmt->execute();
$result = $stmt->get_result();

$carrello = [];
while ($row = $result->fetch_assoc()) {
    $carrello[] = $row;
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Carrello - Nike Store</title>
    <link rel="stylesheet" href="carrello-style.css">
</head>
<body>
    <div class="top-container">
        <div class="logo">
            <a href="index.php"><img src="img/logo.svg" alt="Nike"></a>
        </div>

        <div class="central-navbar">
            <a href="#">Novità</a>
            <a href="uomo.php">Uomo</a>
            <a href="#">Donna</a>
            <a href="#">Kids</a>
            <a href="#">Jordan</a>
        </div>

        <div class="right-elements">
            <div class="search-bar">
                <input type="text" placeholder="Cerca">
            </div>
            <div class="preferiti"></div>
            <div class="carrello">
                <svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" role="img" width="24px" height="24px" fill="none">
                    <path stroke="currentColor" stroke-width="1.5" d="M8.25 8.25V6a2.25 2.25 0 012.25-2.25h3a2.25 2.25 0 110 4.5H3.75v8.25a3.75 3.75 0 003.75 3.75h9a3.75 3.75 0 003.75-3.75V8.25H17.5"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="middle">
        <div class="content">
            <h1>Il tuo carrello</h1>

            <?php if (count($carrello) === 0): ?>
                <p>Il tuo carrello è vuoto.</p>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>Prodotto</th>
                            <th>Nome</th>
                            <th>Prezzo</th>
                            <th>Quantità</th>
                            <th>Totale</th>
                            <th>Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $totale_carrello = 0;

                        foreach ($carrello as $item):
                            $id_prodotto = $item['id_prodotto'];
                            $quantita = intval($item['quantita']);

                            if (!isset($prodotti_lookup[$id_prodotto])) {
                                echo "<tr><td colspan='6' style='color:red'>Prodotto con ID $id_prodotto non trovato.</td></tr>";
                                continue;
                            }

                            $prodotto = $prodotti_lookup[$id_prodotto];
                            $nome = htmlspecialchars($prodotto['name']);
                            $img = htmlspecialchars($prodotto['image']);
                            $prezzo = floatval($prodotto['price']);
                            $totale = $prezzo * $quantita;
                            $totale_carrello += $totale;
                        ?>
                        <tr>
                            <td><img src="<?= $img ?>" alt="<?= $nome ?>" style="width: 80px;"></td>
                            <td><?= $nome ?></td>
                            <td><?= number_format($prezzo, 2) ?> €</td>
                            <td>
                                <form method="POST" action="aggiorna_carrello.php">
                                    <input type="hidden" name="id_prodotto" value="<?= $id_prodotto ?>">
                                    <input type="number" name="quantita" value="<?= $quantita ?>" min="1">
                                    <button type="submit">Aggiorna</button>
                                </form>
                            </td>
                            <td><?= number_format($totale, 2) ?> €</td>
                            <td>
                                <form method="POST" action="rimuovi_carrello.php" onsubmit="return confirm('Rimuovere il prodotto dal carrello?');">
                                    <input type="hidden" name="id_prodotto" value="<?= $id_prodotto ?>">
                                    <button type="submit">Rimuovi</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <h2>Totale carrello: <?= number_format($totale_carrello, 2) ?> €</h2>
                <a href="checkout.php" class="checkout-btn">Procedi al pagamento</a>
            <?php endif; ?>
        </div>
    </div>

    <div class="footer"></div>
</body>
</html>
