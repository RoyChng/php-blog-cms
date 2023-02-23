<?php

    /**
     * Redirect to given relative URL
     * 
     * @param string Path to retirect to (relative path)
     * 
     * @return void
     */
    function redirect($path){
        $server_name = $_SERVER["SERVER_NAME"];

        if(isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] !== "off"){
            $protocol = "https";
        } else{
            $protocol = "http";
        }

        header("Location: $protocol://$server_name/$path");
        // header("Location: article.php?id=$id");
        exit();
    }

?>