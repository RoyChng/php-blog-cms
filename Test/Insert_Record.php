<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Record</title>
</head>
<body>
    <h1>Insert Record</h1>
    <?php 
        $inserted_row = false;
        if($_SERVER["REQUEST_METHOD"] && isset($_POST["insert"])){
            include_once("Connect_DB.php");
            $input_studentname = $_POST["studentname"];
            $input_studentclass = $_POST["studentclass"];
            $input_studentphone = $_POST["studentphone"];
            $input_studentemail = $_POST["studentemail"];
            
            $insert_sql = "INSERT INTO tblmembers (studentname, studentclass, studentphone, studentemail) VALUES ('$input_studentname', '$input_studentclass', $input_studentphone, '$input_studentemail')";
            $insert_result = mysqli_query($db_connection, $insert_sql);

            $id = mysqli_insert_id($db_connection);

            $select_sql = "SELECT studentid, studentname, studentclass, studentphone, studentemail FROM tblmembers WHERE studentid = $id";
            $select_result = mysqli_query($db_connection, $select_sql);

            if($insert_result && mysqli_num_rows($select_result) > 0){
                echo "<p>Successfully inserted row</p>";
                $inserted_row = true;
                $row = mysqli_fetch_assoc($select_result);
            } else{
                echo "<p>Failed to insert row</p>";
            }
        } ?>

        <form method="post">
            <table>
                <tbody>
                    <tr>
                        <td>
                            <label for="studentname">Student Name:</label>
                            <input type="text" name="studentname" id="studentname">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="studentclass">Student Class:</label>
                            <input type="text" name="studentclass" id="studentclass">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="studentphone">Student Phone:</label>
                            <input type="number" name="studentphone" id="studentphone">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="studentemail">Student Email:</label>
                            <input type="email" name="studentemail" id="studentemail">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <button name="insert">Insert</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>

        <?php if($inserted_row){ ?>
       <table border="1" width="800">
            <tbody>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Class</th>
                    <th>Phone</th>
                    <th>Email</th>
                </tr>
                
                <tr>
                    <td><?= $row["studentid"] ?></td>
                    <td><?= $row["studentname"] ?></td>
                    <td><?= $row["studentclass"] ?></td>
                    <td><?= $row["studentphone"] ?></td>
                    <td><?= $row["studentemail"] ?></td>
                </tr>
            </tbody>
        </table>
    <?php } ?>
</body>
</html>