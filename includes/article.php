<?php

/**
 * Gets an article
 * 
 * @param int The article's ID
 * @param object The database connection
 * 
 * @return bool|mysqli_result Returns false if an error occurred, or the result set if successful
 */
function getArticle($id, $conn){
    $stmt = mysqli_prepare($conn, "SELECT * FROM article WHERE id = ? ");
    $bind_successful = mysqli_stmt_bind_param($stmt, "i", $id);
    $successful = mysqli_stmt_execute($stmt);
    if($successful){
        return mysqli_stmt_get_result($stmt);
    } else{
        echo mysqli_stmt_error($stmt);
        return false;
    }
}

/**
 * Validates article
 * 
 * @param string The title of the article
 * @param string The content of the article
 * @param string the date of the article in the format YYYY-MM-DDTHH:MM
 * 
 * @return array Returns array of error messages
 */
function validateArticle($title, $content, $published_at){
    $errors = [];

    if($title === ""){
        $errors[] = "Title is required";
    }

    if($content === ""){
        $errors[] = "Content is required";
    }

    if($published_at !== ""){
        $date_time = date_create_from_format("Y-m-d\TH:i", $published_at);
        
        if($date_time === false){
            $errors[] = "Invalid date!";
        } else{
            if(date_get_last_errors() && date_get_last_errors()["warning_count"] > 0){
                $errors[] = "Invalid date!";
            }

        }
    }

    return $errors;
}

?>