<?php
session_start();

// Elimina tutte le variabili di sessione
$_SESSION = [];

// Distrugge la sessione
session_destroy();

// Reindirizza alla pagina di login
header("Location: login.php");
exit;
?>
