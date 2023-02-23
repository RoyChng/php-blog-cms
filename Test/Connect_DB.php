<?php

    $db_servername = "localhost";
    $db_username = "Roy";
    $db_password = "roy";
    $db_name = "dbtrainspotting";
    $db_connection = mysqli_connect($db_servername, $db_username, $db_password, $db_name);

    if($db_connection === false){
        die("Database connection error: " . mysqli_connect_error());
    } else{
        echo "Database connected successfully";
    }
?>