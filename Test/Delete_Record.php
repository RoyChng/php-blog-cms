<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Record</title>
    <style>
        td,th{
            padding: 10px;
        }
    </style>
</head>
<body>
    <h1>Delete Record</h1>
    <?php
        include_once("Connect_DB.php");


        if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["delete"])){
            $delete_id = $_POST["deleteid"];

            $delete_sql = "DELETE FROM tblmembers WHERE studentid = $delete_id";
            $delete_result = mysqli_query($db_connection, $delete_sql);

            if($delete_result && mysqli_affected_rows($db_connection) > 0){
                echo "<p>Successfully Deleted Row</p>";
            } else{
                echo "<p>Failed to delete row </p>";
            }
        }

        $select_sql = "SELECT studentid, studentname, studentclass, studentphone, studentemail FROM tblmembers";
        $select_result = mysqli_query($db_connection, $select_sql); 
    ?>
    <form method="post">
        <label for="deleteid">ID To Delete</label>
        <input type="number" name="deleteid">
        <button name="delete">Delete</button>
    </form>
    <h2>All records</h2>
    <?php  if(mysqli_num_rows($select_result) > 0){ ?>
        <table border="1" width="800">
            <tbody>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Class</th>
                    <th>Phone</th>
                    <th>Email</th>
                </tr>
                <?php while($row = mysqli_fetch_assoc($select_result)){ ?>
                    <tr>
                        <td><?= $row["studentid"] ?></td>
                        <td><?= $row["studentname"] ?></td>
                        <td><?= $row["studentclass"] ?></td>
                        <td><?= $row["studentphone"] ?></td>
                        <td><?= $row["studentemail"] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else {?>
        <p>No records to show</p>
    <?php } ?>
</body>
</html>