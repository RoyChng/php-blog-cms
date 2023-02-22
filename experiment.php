<?php
    require("includes/database.php");

    $result = null;
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $conn = getDb();

        $id = $_POST["id"];
        $sql = "SELECT title, content FROM article WHERE id = $id";

        echo "<p> $sql </p>";

        $result = mysqli_query($conn, $sql);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post">
        <label for="id">ID</label>
        <input type="text" id="id" name="id">
        <button>Select</button>
    </form>

    <table border="1" width="800">
        <tbody>
        <?php 
            if($result && mysqli_num_rows($result) > 0){
                while ($row = mysqli_fetch_assoc($result)){
        ?>
            <tr>
                <td><?= $row["title"] ?></td>
                <td><?= $row["content"] ?></td>
            </tr>
        <?php
            }
        } else {
            ?>
        <p>No results to show.</p>
        <?php 
        }
        ?>
        </tbody>
    </table>        
</body>
</html>