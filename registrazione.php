<?php

require_once 'dbconf.php';

if(isset($_POST["email"]) && isset($_POST["password"])){

    $conn = mysqli_connect($dbconf['host'], $dbconf['username'], $dbconf['password'], $dbconf['dbname']) or die(msqli_error($conn));

    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $error_m = array();

    //VALIDAZIONE EMAIL
    function validateEmail($mail){
        global $conn;
        if(!filter_var($mail, FILTER_VALIDATE_EMAIL)){
            echo "mail non valida";
            //$error_m[] = "{$email}: email non valida"."<br>";
            exit;
        }else{
            $que = "SELECT email FROM utenti where email = '$mail'";  //cambiare valore tabella da username a email
            $res = mysqli_query($conn, $que);

            if(mysqli_num_rows($res) > 0) {
                //echo "mail in uso";
                //$error_m[] = "Email già in uso";
                exit;
            }
        }
    }
    validateEmail($_POST['email']);
    

    //VALIDAZIONE PASSWORD
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    function my_validate_pwd($pwd, $min_length = 8 ) {
        if( strlen( $pwd ) < $min_length ) {
            echo "la password deve essere minimo 8 caratteri";
        }    
         
        if( !preg_match( '/[a-z0-9]+/i', $pwd ) ) {
            return false;
        }
    
        if( !preg_match( '/[!@#$%^&*()\-_=+{};:,<.>]+/', $pwd ) ) {
            return false;
        }
    
        return true;
    }

    my_validate_pwd($password);

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    
    //VALIDAZIONE USERNAME    
    if(!preg_match('/^[a-zA-Z0-9_]{1,15}$/', $_POST['username'])) {
        echo "username non valido";
        //$error_m[] = "Username non valido";
    } else {
        // Cerco se l'username esiste già o se appartiene a una delle 3 parole chiave indicate
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $query = "SELECT username FROM utenti WHERE username = '$username'";
        $res = mysqli_query($conn, $query);
        if (mysqli_num_rows($res) > 0) {
            echo "mail già in uso";
            //$error_m[] = "Username già in uso";
            exit;
        }
    }

    $username = mysqli_real_escape_string($conn, $_POST['username']);

    $nome = mysqli_real_escape_string($conn, $_POST['nome']);
    $cognome = mysqli_real_escape_string($conn, $_POST['cognome']);


    $query = "INSERT INTO utenti(username, password, nome, cognome, email) VALUES('$username', '$hashed_password', '$nome', '$cognome', '$email')";

    if($conn->query($query)===true){
        echo "Registrazione avvenuta con successo";
        header("Location: homepage.php");
    }else{
        echo "Errore durante la registrazione utente $query.".$conn->error;
    }
 
}

?>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="login.css" rel="stylesheet">
        <script src="login.js" defer="true"></script>
        <meta charset="utf-8">

        <title>Lispour - quello che ami</title>
    </head>

    <main class="session">
        <div class="sinistra"></div>
        <section class="destra">
        <h1>Benvenuto</h1>
        <form method="POST" enctype="multipart/form-data" autocomplete="off">

            <div class="nome">
                <label for='nome'>Nome</label>
                <div class="container"><input type='nome' name='nome' required></div>
                <span>Nome non valido</span>
            </div>
            
            <div class="cognome">
                <label for='cognome'>Cognome</label>
                <div class="container"><input type='cognome' name='cognome' required></div>
                <span>Cognome non valido</span>
            </div>

            <div class="username">
                <label for='username'>Username</label>
                <div class="container"><input type='username' name='username' required></div>
                <span>Username non valido</span>
            </div>

            <div class="email">
                <label for='email'>Email</label>
                <div class="container"><input type='email' name='email' placeholder='mariorossi@gmail.com'  required></div>
                <span>Email non valida</span>
            </div>

            <div class="password">
                <label for='password'>Password</label>
                <div class="container"><input type='password' name='password' required></div>
                <span>Password non valid</span>
            </div>
            
            <div class="submit">
                <input type="submit" id="log" class="button" value="Registrati">
            </div>

            <p>Hai già un account? <a href="login.php">Accedi</a></p>
        </form>
        </section>
    </main>
<!DOCTYPE html>

