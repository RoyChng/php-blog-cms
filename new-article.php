<?php

require "includes/database.php";
require "includes/article.php";

$title = "";
$content = "";
$published_at = "";

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])){
    $conn = getDb();

    $title = $_POST["title"];
    $content = $_POST["content"];
    $published_at = $_POST["published_at"];

    $errors = validateArticle($title, $content, $published_at);

    
    if(empty($errors)){
        if($published_at === ""){
            $published_at = null;
        }

        $sql = "INSERT INTO article (title, content, published_at) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sss", $title, $content, $published_at);
        $successful = mysqli_stmt_execute($stmt);

        if($successful){
            redirect("article.php?id=$id")
        } else{
            echo "Error creating article";
            echo mysqli_stmt_error($stmt);
        }
    }
}
?>

<?php require "includes/header.html"; ?>
    <h1>Add article</h1>
<?php require "includes/article-form.php" ?>
<?php require "includes/footer.html"; ?>