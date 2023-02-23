<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View All Records</title>
    <style>
        td,th{
            padding: 10px;
        }
    </style>
</head>
<body>
    <h1>View All Records</h1>
    <?php
        include_once("Connect_DB.php");
        $sql = "SELECT studentid, studentname, studentclass, studentphone, studentemail FROM tblmembers";
        $result = mysqli_query($db_connection, $sql);
        if(mysqli_num_rows($result) > 0){
    ?>
        <table border="1" width="800">
            <tbody>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Class</th>
                    <th>Phone</th>
                    <th>Email</th>
                </tr>
                <?php while($row = mysqli_fetch_assoc($result)){ ?>
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