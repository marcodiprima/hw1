<?php

require_once 'dbconf.php';
session_start();

$conn = mysqli_connect($dbconf['host'], $dbconf['username'], $dbconf['password'], $dbconf['dbname']);

$titolo = mysqli_real_escape_string($conn, $_GET['titolo']); 
$descrizione = mysqli_real_escape_string($conn, $_GET['descrizione']);
$titolino = mysqli_real_escape_string($conn, $_GET['titolino']);
$img = mysqli_real_escape_string($conn, $_GET['img']);

$query = "INSERT INTO likes VALUES('$titolo', '$descrizione', '$titolino', '$img')";
$res = mysqli_query($conn, $query);

mysqli_close($conn);


?>