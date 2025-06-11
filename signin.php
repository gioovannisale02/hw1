<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'server.php';

$messaggio = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $indirizzo = $_POST['indirizzo'];

    // Pulizia input per sicurezza
    $nome = $conn->real_escape_string($nome);
    $cognome = $conn->real_escape_string($cognome);
    $email = $conn->real_escape_string($email);
    $password = $conn->real_escape_string($password); // password in chiaro (sconsigliato)
    $indirizzo = $conn->real_escape_string($indirizzo); // indirizzo tipo TEXT

    // Query SQL
    $sql = "INSERT INTO utenti (nome, cognome, email, password, indirizzo) 
            VALUES ('$nome', '$cognome', '$email', '$password', '$indirizzo')";

    if ($conn->query($sql) === TRUE) {
        $conn->close();
        header("Location: index.php");
        exit;
    } else {
        $messaggio = "Errore: " . $conn->error;
    }

    $conn->close();
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ti diamo il benvenuto in Nike - Accedi</title>
    <link rel="stylesheet" href="login-style.css">
</head>
<body>
    <div class="login-container">
        <div class="logos">
            <img src="img/logo.svg" alt="Nike" class="logo">
            <img src="img/logo-jordan.svg" alt="Jordan" class="logo">
        </div>

        <h1>Inserisci i tuoi dati per unirti a noi o <a href="login.php" class="link-accedi">accedi</a>.</h1>
        <p class="country">Italia <a href="#">Modifica</a></p>

        <?php if (!empty($messaggio)): ?>
            <p class="messaggio"><?= $messaggio ?></p>
        <?php endif; ?>

        <form class="login-form" method="POST">
            <input type="text" name="nome" placeholder="Nome*" required>
            <input type="text" name="cognome" placeholder="Cognome*" required>
            <input type="email" name="email" placeholder="E-mail*" required>
            <input type="password" name="password" placeholder="Password*" required>
            <input type="text" name="indirizzo" placeholder="Indirizzo*" required>
            <button type="submit">Continua</button>
        </form>

        <p class="privacy">
            Continuando, accetti le <a href="#">condizioni d'uso</a> di Nike<br>
            e confermi di aver letto <a href="#">l'informativa sulla privacy</a> di Nike.
        </p>
    </div>
</body>
</html>