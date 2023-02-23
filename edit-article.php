<?php

require "includes/database.php";
require "includes/article.php";
require "includes/url.php";

$article = null;

if(isset($_GET["id"])){   

    $conn = getDb();

    $results = getArticle($_GET["id"], $conn);

    if($results && mysqli_num_rows($results) > 0){
        $article = mysqli_fetch_assoc($results);
        $title = $article["title"];
        $content = $article["content"];
        $published_at = $article["published_at"];
    } else {
        die("Invalid ID");
    }
} else{
    die("ID Not supplied, article not found");
}

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $conn = getDb();
    
    $id = $article["id"];
    $title = $_POST["title"];
    $content = $_POST["content"];
    $published_at = $_POST["published_at"];
    $errors = validateArticle($title, $content, $published_at);

    if(empty($errors)){
        if($published_at === ""){
            $published_at = null;
        }

        $sql = "UPDATE article SET title = ?, content = ?, published_at = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssi", $title, $content, $published_at, $id);
        $successful = mysqli_stmt_execute($stmt);

        if($successful){
            redirect("article.php?id=$id");
        } else{
            echo "Error editing article";
            echo mysqli_stmt_error($stmt);
        }
    }
}
?>

<?php require "includes/header.html"; ?>
    <h1>Edit article</h1>
<?php require "includes/article-form.php" ?>
<?php require "includes/footer.html"; ?>