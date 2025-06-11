<?php
require_once 'server.php';

$messaggio = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prevenzione SQL injection
    $email = $conn->real_escape_string($email);
    $password = $conn->real_escape_string($password);

    $sql = "SELECT * FROM utenti WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // Se vuoi salvare l'utente in sessione:
        session_start();
        $_SESSION['utente'] = $row;

        $conn->close();
        header("Location: index.php");
        exit;
    } else {
        $messaggio = "Errore: credenziali non valide.";
        }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nike - Login</title>
    <link rel="stylesheet" href="login-style.css">
</head>
<body>
    <div class="login-container">
        <div class="logos">
            <img src="img/logo.svg" alt="Nike" class="logo">
            <img src="img/logo-jordan.svg" alt="Jordan" class="logo">
        </div>

        <h1>Accedi al tuo account o <a href="signin.php" class="link-accedi">registrati</a>.</h1>
        <p class="country">Italia <a href="#">Modifica</a></p>

        <?php if (!empty($messaggio)): ?>
            <p class="messaggio <?= strpos($messaggio, 'Errore') !== false ? 'errore' : '' ?>">
                <?= $messaggio ?>
            </p>
        <?php endif; ?>

        <form class="login-form" method="POST">
            <input type="email" name="email" placeholder="E-mail*" required>
            <input type="password" name="password" placeholder="Password*" required>
            <button type="submit">Accedi</button>
        </form>

        <p class="privacy">
            Continuando, accetti le <a href="#">condizioni d'uso</a> di Nike<br>
            e confermi di aver letto <a href="#">l'informativa sulla privacy</a> di Nike.
        </p>
    </div>
</body>
</html>
