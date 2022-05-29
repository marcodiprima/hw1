<?php
  require_once 'verify_auth.php'; 
  if(!isset($_SESSION)){ 
    session_start(); 
  }  
  if (!$idutente = verifyAuth()) {
    header("Location: login.php");
    exit;
  }
?>



<html>
    <?php 
        // Carico le informazioni dell'utente loggato per visualizzarle nella sidebar (mobile)
        $conn = mysqli_connect($dbconf['host'], $dbconf['username'], $dbconf['password'], $dbconf['dbname']);
        $idutente = mysqli_real_escape_string($conn, $idutente);
        $query = "SELECT * FROM utenti WHERE id = $idutente";
        $res_1 = mysqli_query($conn, $query);
        $userinfo = mysqli_fetch_assoc($res_1);   
    ?>

    <head>
        <link rel='stylesheet' href='profilo.css'>
        <script src='news_api.js' defer></script>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="images/news.png">
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Tangerine">

        <title>Geographic Position</title>
    </head>

    <body>
        
        <header>
            <nav>
                <div id="left">
                    <h1>Lispour - news about the cities</h1>
                </div>
                <div id="right">
                    <a href="homepage.php" <?php if(!isset($_GET['username'])) echo "class='here'"; ?> >Home &nbsp</a>
                    <a href="logout.php">Logout</a><br>
                </div>
            </nav>
        </header>

        <form name=cerca_news id=cerca_news>
        <div>Di quale città vuoi conoscere le news?</div>
        <input type=text id=testo>
        <input type=submit id=invio value="cerca">
        </form>

        <main id='contenitore'>
        <div class='visualizza'>

        </div>
</main>
    </body>
</html>