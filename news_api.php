<?php

    $query=urlencode($_GET["q"]);
    $url = "https://newsapi.org/v2/everything?q=".$query."&from=2022-04-30&sortBy=publishedAt&apiKey=f88266878c504bce975444f86ead05f2";

    header("Location: $url");
    
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, $url); 
    curl_setopt($ch, CURLOPT_POST,0); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    
    $result = curl_exec($ch); 
    $json = json_decode($result, true);
    echo json_encode($json);
 
    curl_close($ch); 
    

?>