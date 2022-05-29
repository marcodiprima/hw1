<?php 
    require_once 'verify_auth.php';
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
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="images/icona_uomo.png">
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Tangerine">

        <title>Lispour - quello che ami</title>
    </head>

    <body>
        
        <header>
            <nav>
                <div id="left">
                    <h1>Lispour</h1>
                </div>
                <div id="right">
                    <a href="homepage.php" <?php if(!isset($_GET['username'])) echo "class='here'"; ?> >Home &nbsp</a>
                    <a href="logout.php">Logout</a><br>
                </div>
            </nav>
        </header>

        <main>
            <section id="profilo">
                <div class="propic">
                    <div class="user"><?php echo $userinfo["nome"]." ".$userinfo["cognome"]?></div>
                </div>
                <div class="username">
                    @<?php echo $userinfo['username'] ?>
                </div>
                <div class='post_piaciuti'>
                    Elementi piaciuti: 
                <?php   $countquery = "SELECT COUNT(*) from likes";
                        $res = mysqli_query($conn, $countquery);
                        $useri = mysqli_fetch_assoc($res);  
                        echo $useri['COUNT(*)'];
                ?>
                </div>
            </section>    
        </main>

    </body>
</html>

<?php mysqli_close($conn); ?>