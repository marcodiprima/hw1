<?php

    session_start();

    //facciamolo diventare un array vuoto

    $_SESSION = array();

    //distruggiamo la sessione corrente
    session_destroy();

    header("location: login.php");
    exit;

?>