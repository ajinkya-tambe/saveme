<?php
    $name = "root";
    $password = "";
    $server = "localhost:3307";
    $db = "db";

    // Connection
    $conn = mysqli_connect($server, $name, $password, $db);
    if(!$conn){
        echo "Connection Failed";
    }

?>
