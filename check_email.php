<?php
    /*******************************************************
        Controlla che i l'email sia unica
    ********************************************************/
    require_once 'dbconf.php';
    
    // Controllo che l'accesso sia legittimo
    if (!isset($_GET["q"])) {
        echo "Hai combinato un po' di errori";
        exit;
    }

    header('Content-Type: application/json');
    
    $conn = mysqli_connect($dbconf['host'], $dbconf['username'], $dbconf['password'], $dbconf['dbname']);

    $email = mysqli_real_escape_string($conn, $_GET["q"]);

    $query = "SELECT email FROM utenti WHERE email = '$email'";

    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));

    // Torna un JSON con chiave exists e valore boolean
    echo json_encode(array('exists' => mysqli_num_rows($res) > 0 ? true : false));

    mysqli_close($conn);
?>