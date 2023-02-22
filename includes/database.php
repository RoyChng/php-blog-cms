<?php
// $db_username = "root";
// $db_password = "secret";

/**
 * Get the database connection
 * 
 * @return object Connection to MySQL database 
 */
function getDB(){
    $db_host = "localhost";
    $db_name = "cms";
    $db_username = "cms_www";
    $db_password = "W7l3p9**6Lzl5sbV";

    $conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);

    if(mysqli_connect_error()){
        echo mysqli_connect_error();
        exit;
    }

    return $conn;
}
?>