<?php 
    /*******************************************************
        Controlla che l'username sia unico
    ********************************************************/
    require_once 'dbconf.php';

    if (!isset($_GET["q"])) {
        echo "Hai combinato un po' di errori";
        exit;
    }

    header('Content-Type: application/json');
    
    $conn = mysqli_connect($dbconf['host'], $dbconf['username'], $dbconf['password'], $dbconf['dbname']);

    $username = mysqli_real_escape_string($conn, $_GET["q"]);

    $query = "SELECT username FROM utenti
                WHERE username = '$username'";

    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));

    echo json_encode(array('exists' => mysqli_num_rows($res) > 0 ? true : false));

    mysqli_close($conn);
?>