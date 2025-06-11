<?php

$host = 'localhost';
$db = 'nike';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);


if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}
?>