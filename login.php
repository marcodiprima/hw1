<?php

require_once 'dbconf.php';

if(isset($_POST["username"]) && isset($_POST["password"])){

    $conn = mysqli_connect($dbconf['host'], $dbconf['username'], $dbconf['password'], $dbconf['dbname']) or die(msqli_error($conn));

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

if($_SERVER["REQUEST_METHOD"]==="POST"){
    
    $query = "SELECT * FROM utenti where username = '$username'";
    if($result = $conn->query($query)){
        if($result->num_rows == true){ //se c'è solo una riga
            $row = $result->fetch_array(MYSQLI_ASSOC);  
            if(password_verify($password, $row['password'])){
                session_start();
                
                //IMPOSTO LE VARIABILI DI SESSIONE E REINDIRIZZO L'UTENTE ALLA HOME
                $_SESSION['loggato'] = true;
                $_SESSION['id'] = $row['id']; //inserisco un id di sessione
                $_SESSION['username'] = $row['username'];

                header("Location: homepage.php");
            }else{
                echo "La password non è corretta";
            }
        }
            $error = "username e/o password errati";
    }else{
        $error = "Errore in fase di log-in";
    }

    $conn->close();
}
}

?>

<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="login.css" rel="stylesheet">
        <script src="login.js" defer="true"></script>
    </head>

    <main class="session">
    <div class="sinistra"></div>
    <form method="POST" class="log-in">
        <h4>Bentornato</h4>
        <?php
            // Verifica la presenza di errori
            if (isset($error)) {
                echo "<span class='error'>$error</span>";
            }
                
        ?>
            <div class="username">
                <label for='username'>Username</label>
                <div class="container"><input type='username' name='username' required></div>
                <span>Username non valido</span>
            </div>

            <div class="password">
                <label for='password'>Password</label>
                <div class="container"><input type='password' name='password' required></div>
                <span>Password non valid</span>
            </div>
            
            <div class="submit">
                <input type="submit" id="log" class="button" value="Registrati">
            </div>

        <p>Non hai ancora un account? <a href="registrazione.php">Registrati</a></p>
    </form>
    </main>

</html>