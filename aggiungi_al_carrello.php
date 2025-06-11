<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if (!isset($_SESSION['utente'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require 'server.php';  // Connessione DB

    $id_utente = $_SESSION['utente']; // Assumendo che sia ID utente
    $id_prodotto = $_POST['id_prodotto'] ?? null;
    $quantita = $_POST['quantita'] ?? null;

    if (!$id_prodotto || !$quantita) {
        die('Dati mancanti');
    }

    // Prepara query per inserire o aggiornare quantità
    $stmt = $conn->prepare("INSERT INTO carrello (id_utente, id_prodotto, quantita) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE quantita = quantita + ?");
    $stmt->bind_param("iiii", $id_utente, $id_prodotto, $quantita, $quantita);

    if ($stmt->execute()) {
        header("Location: dettaglio.php?id=$id_prodotto&success=1");
        exit;
    } else {
        die("Errore nel salvataggio: " . $conn->error);
    }
} else {
    die("Metodo non consentito");
}
