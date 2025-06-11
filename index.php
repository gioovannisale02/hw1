<?php
session_start();

if (!isset($_SESSION['utente'])) {
    header("Location: login.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nike</title>
    <link rel="stylesheet" href="index-style.css">
</head>
<body>
    <div class="user-container">
        <div class="user-info">
            <p>Ciao, <?php echo htmlspecialchars($_SESSION['utente']['nome']); ?></p>
            <a href="logout.php" class="logout-button">Esci</a>
        </div>
    </div>
    <div class="top-container">
        <div class="logo">
            <img src="img/logo.svg" alt="">
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
        <div class="video-container">
            <video src="img/video.mp4" autoplay muted loop width="100%"></video>
            <div class="text-overlay">
                <h1>È SEMPRE STAGIONE</h1>
                <p>Preparati all'estate con articoli perfetti per affrontare il caldo.</p>
            </div>
        </div>


        <div class="look-container">
            <div class="look">
                <img src="img/f1.png" alt="">
                <a href="" class="look-button">Acquista il look</a>
            </div>

            <div class="look">
                <img src="img/f2.png" alt="">
                <a href="" class="look-button">Acquista il look</a>
            </div>

              <div class="look">
                <img src="img/f3.png" alt="">
                <a href="" class="look-button">Acquista il look</a>
            </div>
        </div>

        <div class="big-look-container">
            <div class="big-look">
                <img src="img/f4.png" alt="">
                <div class="big-look-overlay">
                    <p>Collezione Nike 24.7</p>
                    <h2>ImpossibilySoft</h2>
                    <a href="" class="big-look-button">Acquista</a>
                </div>
            </div>

            <div class="big-look">
                <img src="img/f5.png" alt="">
                <div class="big-look-overlay">
                    <p>Shox R4</p>
                    <h2>Nike Style By</h2>
                    <a href="" class="big-look-button">Acquista</a>
                </div>
            </div>

            <div class="big-look">
                <img src="img/f6.png" alt="">
                <div class="big-look-overlay">
                    <p>Stabilità, ammortizzazione Air Zoom, design irresistibile</p>
                    <h2>Luka 4 "Gone Fishing"</h2>
                    <a href="" class="big-look-button">Acquista</a>
                </div>
            </div>

            <div class="big-look">
                <img src="img/f7.png" alt="">
                 <div class="big-look-overlay">
                    <p>Novità Kids</p>
                    <h2>Nike Sonic Fly</h2>
                    <a href="" class="big-look-button">Acquista</a>
                </div>
            </div>

        </div>
        

        <div class="mbappe">
            <img src="img/f8.png" alt="">
            <div class="mbappe-overlay">
                <p>La selezione dell'atleta</p>
                <h2>Kylian Mbappé</h2>
                <a href="" class="mbappe-button">Acquista</a>
            </div>
            
        </div>

        <div class="icon-container">
            <div class="title">
                <p>Acquista le nostre icone</p>
            </div>
            <div class="icon-images-container" id="icon-images-container">
                <!-- Le icone saranno caricate qui con JavaScript -->
            </div>
        </div>
    </div>

    <div class="footer"></div>
    <script src="load-product.js" defer></script>
</body>
</html>