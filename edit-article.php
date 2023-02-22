<?php

require "includes/database.php";
require "includes/article.php";

$article = null;

if(isset($_GET["id"])){   

    $conn = getDb();

    $results = getArticle($_GET["id"], $conn);

    if($results && mysqli_num_rows($results) > 0){
        $article = mysqli_fetch_assoc($results);
        $title = $article["title"];
        $content = $article["content"];
        $published_at = $article["published_at"];
        var_dump($published_at);
    } else {
        die("Invalid ID");
    }
} else{
    die("ID Not supplied, article not found");
}

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $conn = getDb();

    $title = $_POST["title"];
    $content = $_POST["content"];
    $published_at = $_POST["published_at"];

    $errors = validateArticle($title, $content, $published_at);

    if(empty($errors)){
        die("Form is valid");
    }
}
?>

<?php require "includes/header.html"; ?>
    <h1>Edit article</h1>
<?php require "includes/article-form.php" ?>
<?php require "includes/footer.html"; ?>