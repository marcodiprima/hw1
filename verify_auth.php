<?php
    require_once 'dbconf.php';
    session_start();

    function verifyAuth() {
        // Se esiste già una sessione, la ritorno, altrimenti ritorno 0
        if(isset($_SESSION['loggato'])) {
            return $_SESSION['loggato'];
        } else 
            return 0;
    }
?>