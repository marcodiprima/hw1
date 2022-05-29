<?php
  require_once 'verify_auth.php'; 
  if(!isset($_SESSION)){ 
    session_start(); 
  }  
  if (!$userid = verifyAuth()) {
    header("Location: login.php");
    exit;
  }
?>

<html>
    <?php 
        // Carico le informazioni dell'utente loggato per visualizzarle nella sidebar (mobile)
        $conn = mysqli_connect($dbconf['host'], $dbconf['username'], $dbconf['password'], $dbconf['dbname']);
        $userid = mysqli_real_escape_string($conn, $userid);
        $query = "SELECT * FROM utenti WHERE id = '$userid'";
        $res_1 = mysqli_query($conn, $query);
        $userinfo = mysqli_fetch_assoc($res_1);   
    ?>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="homepage.css" rel="stylesheet">
        <script src="homepage.js" defer="true"></script>
        <link rel="icon" type="image/jpg" href="images/home.png">
        <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
        <title>Devi visitare queste città</title>
    </head>
    <nav class="navig">
        <a href="homepage.php">HOME</a>
        <a href="logout.php">LOGOUT</a>
        <a href="news_home_api.php">NEWS</a>
        <a href="profilo.php">PROFILO</a>
    </nav>

    
    <header>
        <img src="./images/head.jpg">
        <div id ="overlay">
            <h1>LE MIGLIORI CITTA' DA VISITARE</h1>
        </div>
    </header>
    <div class="userpic">
        <h1><strong><?php echo $userinfo["nome"]." ".$userinfo["cognome"] ?></strong></h1>
    </div>

    <body>
    <section id="feed">

        <form name="search_content" id="search_content">
          Visualizza la tua città preferita<br>
          <input type="text" id="element">
          <input type="submit" value="Cerca">
        </form>
  
        <article id='global-view'></article>

        <article id="mod" class="hidden"></article>

        <div class="post_grid">
            <h1>Roma</h1>
            <p>Roma è un contenitore immenso di bellezze dal valore inestimabile e, se
                devo dire la verità, è la città in cui in assoluto ho faticato di più 
                a creare gli itinerari tra tutte quelle in cui sono stato. Prima di 
                partire ho scritto nero su bianco i monumenti, musei, punti panoramici
                e quartieri che non avrei voluto perdere e, con molta pazienza, ho 
                cercato di ordinarli nel modo migliore possibile.</p>
            <strong>Superba</strong>
            <img src="./images/ph1.jpg">
            <div id="cf" class="like"></div>
        </div>

        <div id="cityb">
              <input type="button" id='but1' value="Cerca gli album musicali per questa città">
        </div>
        <article id='city-api'></article>

        <div class="post_grid">
            <h1>Katowice</h1>
            <p>Situata nel sud della Polonia, è la città più sottovalutata della regione.
                Spesso è usata come scalo aeroportuale, o per spendere qualcosa in meno 
                durante il bording nel paese che ha visto il maggior numero di atrocità 
                durante la seconda guerra mondiale. La città è visitabile in un solo giorno, 
                al termine del quale sei catapultato in una miriade di locali con musica 
                techno e drink a 3€. Con pochi złoty,<i> la moneta locale</i>, è possibile 
                arrivare al vecchio campo di concentramento di Auschwitz Birkenau in treno. 
                Un'esperienza unica!</p>
            <strong>Spettacolare</strong>
            <img src="./images/ph2.jpg">
            <div id="cf" class="like"></div>       
        </div>

        <div id="katb">
            <input type="button" id='but2' value="Cerca gli album musicali per questa città">
        </div>
        <article id='kat-api'></article>

        <div class="post_grid">
        <h1>Bali</h1>
        <p>La meta turistica per eccellenza. Una sorta di Hawaii per avventurieri.
             Sì, avrete visto numerosi reels su instagram con paesaggi mozzafiato, 
             e sentito dire della fantastica ospitalità dei locali. Ma dovete ben 
             stare attenti: essendo una meta molto turistica, non manca la criminalità 
             organizzata concentrata principalmente sui furti. Un mio consiglio è di 
             vestirvi il più possibile come i locali, no jeans, no abiti. Date nell'occhio
              il meno possibile. Si risveglierà in voi il vostro Indiana Jones!</p>
        <strong>Fantasmagorica</strong>
        <img src="./images/ph3.jpg">
        <div id="cf" class="like"></div>       
        </div>

        <div id="balib">
            <input type="button" id='but3' value="Cerca gli album musicali per questa città">
        </div>
        <article id='bali-api'></article>

        <div class="post_grid">
        <h1>Berlino</h1>
        <p>Che hai detto? Sei un amante della techno? Bhe, buone notizie. Questo è il 
            posto dove devi fare più di una vacanza. Dopo il processo di Norimberga, 
            sembra aver perso completamente la nomina che si è fatta nel secolo scorso. 
            Il progresso in questa città si nota parecchio. Un miscuglio di ambienti 
            sociali open mind che gli altri paesi europei invidiano. La musica di certo 
            non manca, i secret places in cui vengono organizzati i raves, neanche. Stai 
            alla larga da chi ti offre drinks. Forse l'ultima cosa che puoi trovarci sia 
            effettivamente dell'alcol. La notte puoi fare sogni tranquilli, <strong>bhe
            ad occhi aperti</strong>. La polizia è in ogni dove, ma non andare 
            verso la zona di Tiergarten: potresti non tornare più a casa.</p>
            
        <strong>Egregia</strong>
        <img src="./images/ph4.jpg">
        <div id="cf" class="like"></div>       
        </div>

        <div id="berlib">
            <input type="button" id='but4' value="Cerca gli album musicali per questa città">
        </div>
        <article id='berli-api'></article>

        <div class="post_grid">
        <h1>Chicago</h1>
        <p>Tecnologia e seconda rivoluzione industriale. Dal 1939 la città ha visto la 
            sua più grande crescita. Fino a qualche anno fa, deteneva il record del 
            grattacielo più alto del mondo. Vista panoramica al 109esimo piano. Impossibile 
            da vedere tutta in una settimana. Stiamo pur sempre parlando degli Stati Uniti 
            d'America. Oltre ai diversi musei e monumenti, infinite aziende informatiche 
            ne sono il fulcro (è anche <strong>a due passi</strong>, secono il metro di 
            misura degli americani, dal<strong>MIT</strong>di Boston). Un paradiso per 
            gli <strong>ingegneri informatici</strong>... Anche qui mi vedo a raccomandarvi 
            di non andare nella South city, veramente vicina al <strong>downtown</strong>. 
            In diversi anni ha detenuto il record di maggior numero di omicidi. Ma 
            tranquilli, sono solo sparatorie tra gang, ma standone alla larga non 
            rischierete alcun pericolo.</p>
            <strong>Inaspettata</strong>
        <img src="./images/ph5.jpg">
        <div id="cf" class="like"></div>       
        </div>

        <div id="chicb">
          <input type="button" id='but5' value="Cerca gli album musicali per questa città">
        </div>
        <article id='chic-api'></article>

    </section>

    <footer id='piedi'> 
        <div>
        <hr>
        <p href class='foot'> <?php echo $userinfo["nome"]." ".$userinfo["cognome"] ?> - travel vlogger - p.iva: 0394854829204<p>
        </div>
    </footer>
  </body>
</html>

<?php mysqli_close($conn); ?>