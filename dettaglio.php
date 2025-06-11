<?php
session_start();

if (!isset($_SESSION['utente'])) {
    header("Location: login.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scarpe, Abbigliamento e Accessori Uomo</title>
    <link rel="stylesheet" href="dettaglio-style.css">
</head>
<body>
    <div class="top-container">
        <div class="logo">
            <a href="index.php"><img src="img/logo.svg" alt=""></a>
        </div>

        <div class="central-navbar">
            <a href="">Novità e in evidenza</a>
            <a href="uomo.php">Uomo</a>
            <a href="">Donna</a>
            <a href="">Kids</a>
            <a href="">Jordan</a>
        </div>

        <div class="right-elements">
            <div class="search-bar">
                <input type="text" placeholder="Cerca">
            </div>
            <div class="preferiti">
                <svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" role="img" width="24px" height="24px" fill="none">
                    <path stroke="currentColor" stroke-width="1.5" d="M16.794 3.75c1.324 0 2.568.516 3.504 1.451a4.96 4.96 0 010 7.008L12 20.508l-8.299-8.299a4.96 4.96 0 010-7.007A4.923 4.923 0 017.205 3.75c1.324 0 2.568.516 3.504 1.451l.76.76.531.531.53-.531.76-.76a4.926 4.926 0 013.504-1.451"></path>
                </svg>
            </div>

            <div class="carrello">
                <a href="carrello.php">
                    <svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" role="img" width="24px" height="24px" fill="none">
                    <path stroke="currentColor" stroke-width="1.5" d="M8.25 8.25V6a2.25 2.25 0 012.25-2.25h3a2.25 2.25 0 110 4.5H3.75v8.25a3.75 3.75 0 003.75 3.75h9a3.75 3.75 0 003.75-3.75V8.25H17.5"/>
                </svg>
                </a>
            </div>
        </div>
    </div>

    <div class="middle">

        <div class="content">

        </div>
    </div>

    <div class="footer"></div>
    <script src="dettaglio-script.js"></script>
</body>
</html>