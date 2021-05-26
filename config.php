<?php
    session_start();
    $host = "localhost";
    $name = "root";
    $password = "";
    $dbname = "railwayreservationsystem";

    $mysqli = mysqli_connect($host, $name, $password, $dbname);

    if(!$mysqli){
        die("Failed to connect to db " . mysqli_error($mysqli));
    }

    
?>