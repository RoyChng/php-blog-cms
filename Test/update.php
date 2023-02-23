<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

        include_once("Connect_DB.php");

        $input_studentid = "";
        $input_studentname = "";
        $input_studentclass = "";
        $input_studentphone = "";
        $input_studentemail = "";

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            if(isset($_POST["update"])){
                $input_studentid = $_POST["studentid"];
                $input_studentname = $_POST["studentname"];
                $input_studentclass = $_POST["studentclass"];
                $input_studentphone = $_POST["studentphone"];
                $input_studentemail = $_POST["studentemail"];

                $sql = "UPDATE tblmembers SET studentname='$input_studentname', studentclass='$input_studentclass', studentphone=$input_studentphone, studentemail='$input_studentemail' WHERE studentid = $input_studentid";
                mysqli_query($db_connection, $sql);
                if(mysqli_affected_rows($db_connection) > 0){
                    echo "<p>Successfully updated row</p>";
                } else{
                    echo "<p>Failed to update row</p>";
                }
            } else if(isset($_POST["select"]) || isset($_POST["cancel"])){
                $selected_studentid = isset($_POST["cancel"]) ? $_POST["studentid"] : $_POST["selectid"];

                $sql = "SELECT studentid, studentname, studentclass, studentphone, studentemail FROM tblmembers WHERE studentid = $selected_studentid LIMIT 1";
                $result = mysqli_query($db_connection, $sql);
                if(mysqli_num_rows($result) > 0){
                    $row = mysqli_fetch_assoc($result);

                    $input_studentid = $row["studentid"];
                    $input_studentname = $row["studentname"];
                    $input_studentclass = $row["studentclass"];
                    $input_studentphone = $row["studentphone"];
                    $input_studentemail = $row["studentemail"];

                    echo isset($_POST["cancel"]) ? "<p>Cancelled successfully</p>" : "";
                } else{
                    echo "<p>No results found</p>";
                }
            }
        }
        ?>
    <form method="post">
        <p>
            <label for="selectid">Select Student ID:</label>
            <input type="number" name="selectid">
            <button name="select">Select</button>
        </p>
        <table>
            <tbody>
                <tr>
                    <td>
                        <label for="studentid">Student ID:</label>
                        <input type="number" name="studentid" id="studentid" value="<?= $input_studentid ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="studentname">Student Name:</label>
                        <input type="text" name="studentname" id="studentname" value="<?= $input_studentname ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="studentclass">Student Class:</label>
                        <input type="text" name="studentclass" id="studentclass" value="<?= $input_studentclass ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="studentphone">Student Phone:</label>
                        <input type="text" name="studentphone" id="studentphone" value="<?= $input_studentphone ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="studentemail">Student Email:</label>
                        <input type="text" name="studentemail" id="studentemail" value="<?= $input_studentemail ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <button name="cancel">Cancel</button>
                        <button name="update">Update</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
    </body>
</html>