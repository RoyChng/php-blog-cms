<?php

require "includes/database.php";
require "includes/article.php";

$article = null;

if(isset($_GET["id"])){   

    $conn = getDb();

    $results = getArticle($_GET["id"], $conn);

    if($results){
        $article = mysqli_fetch_assoc($results);
    } 
}
?>

<?php require "includes/header.html"; ?>
    <h1>My Blog</h1>
    <?php if($article === null) { ?>
        <p>Article not found!</p>
    <?php } else { ?>
            <article>
                <h2><?= htmlspecialchars($article['title']) ?></h2>
                <p><?= htmlspecialchars($article['content']) ?></p>
                <a href="/edit-article.php?id=<?= $article['id'] ?>">Edit</a>
            </article>
    <?php } ?>
<?php require "includes/footer.html"; ?>