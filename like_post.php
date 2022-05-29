<?php 
    /*******************************************************
        Aggiunge un like dall'utente loggato
    ********************************************************/
    require_once 'dbconf.php';
    if (!$idutente = verifyAuth()) exit;

    $conn = mysqli_connect($dbconf['host'], $dbconf['username'], $dbconf['password'], $dbconf['dbname']);

    $idutente = mysqli_real_escape_string($conn, $idutente);

    $titolo = mysqli_real_escape_string($conn, $_POST["titolo"]);

    // Aggiungo un'entry ai like
    $in_query = "INSERT INTO preferiti(id, titolo) VALUES($idutente, $titolo)";
    // Si attiva il trigger che aggiorna il numero di likes
    // Prendo il nuovo numero di like
    $out_query = "SELECT nlikes FROM posts WHERE id = $postid";

    $res = mysqli_query($conn, $in_query) or die ('Unable to execute query. '. mysqli_error($conn));

    if ($res) {

        $res = mysqli_query($conn, $out_query);

        if (mysqli_num_rows($res) > 0) {

            $entry = mysqli_fetch_assoc($res);

            $returndata = array('ok' => true, 'nlikes' => $entry['nlikes']);

            echo json_encode($returndata);

            mysqli_close($conn);

            exit;

        }
    }

    mysqli_close($conn);
    echo json_encode(array('ok' => false));
?>