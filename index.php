<?php

require "includes/database.php";

$conn = getDb();

$sql = "SELECT * 
        FROM article 
        ORDER BY published_at;";

$results = mysqli_query($conn, $sql);

if($results === false){
    echo mysqli_error($conn);
} else{
    $articles = mysqli_fetch_all($results, MYSQLI_ASSOC);
}
?>

<?php require "includes/header.html"; ?>
    <h1>My Blog</h1>
    <a href="new-article.php">Add Article</a>
    <?php if(empty($articles)) { ?>
        <p>No articles found</p>
    <?php } else { ?>
    <ul>
        <?php foreach($articles as $article){ ?>
            <li>
                <a href="/article.php?id=<?= $article['id'] ?>"><h2><?php echo htmlspecialchars($article['title']) ?></h2></a>
                <p><?php echo htmlspecialchars($article['content']) ?></p>
            </li>
            <?php } ?>
    </ul>
    <?php } ?>
<?php require "includes/footer.html"; ?>