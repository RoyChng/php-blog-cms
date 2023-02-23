<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Record</title>
</head>
<body>
    <?php
        $input_studentid = "";
        $input_studentname = "";
        $input_studentclass = "";
        $input_studentphone = "";
        $input_studentemail = "";

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            include_once("Connect_DB.php");

            if(isset($_POST["update"])){
                $input_studentid = $_POST["studentid"];
                $input_studentname = $_POST["studentname"];
                $input_studentclass = $_POST["studentclass"];
                $input_studentphone = $_POST["studentphone"];
                $input_studentemail = $_POST["studentemail"];

                $update_sql = "UPDATE tblmembers SET studentname = '$input_studentname', studentclass = '$input_studentclass', studentphone = $input_studentphone, studentemail = '$input_studentemail'";
                $update_result = mysqli_query($db_connection, $update_sql);

                if($update_result && mysqli_affected_rows($db_connection) > 0){
                    echo "<p>Successfully updated record </p>";
                } else {
                    echo "<p>Failed to update record </p>";
                }
            } else if (isset($_POST["select"]) || isset($_POST["cancel"])){
                $selected_studentid = isset($_POST["cancel"]) ? $_POST["studentid"] : $_POST["selectedid"];

                $select_sql = "SELECT studentid, studentname, studentclass, studentphone, studentemail FROM tblmembers WHERE studentid = $selected_studentid";
                $select_result = mysqli_query($db_connection, $select_sql);
                if($select_result && mysqli_num_rows($select_result) > 0){
                    $select_row = mysqli_fetch_assoc($select_result);

                    $input_studentid = $select_row["studentid"];
                    $input_studentname = $select_row["studentname"];
                    $input_studentclass = $select_row["studentclass"];
                    $input_studentphone = $select_row["studentphone"];
                    $input_studentemail = $select_row["studentemail"];

                    echo isset($_POST['cancel']) ? "<p>Successfully cancelled</p>" : "";
                } else {
                    echo "<p>No results found </p>";
                }
            }
        }
    ?>
    <form method="post">
        <p>
            <label for="selectedid">Select Student ID:</label>
            <input type="number" name="selectedid">
            <button name="select">Select</button>
        </p>
        <table>
            <tbody>
                <tr>
                    <td>
                        <label for="studentid">Student ID:</label>
                        <input type="text" name="studentid" value="<?= $input_studentid ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="studentname">Student Name:</label>
                        <input type="text" name="studentname" value="<?= $input_studentname ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="studentclass">Student Class:</label>
                        <input type="text" name="studentclass" value="<?= $input_studentclass ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="studentphone">Student Phone:</label>
                        <input type="text" name="studentphone" value="<?= $input_studentphone ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="studentemail">Student Email:</label>
                        <input type="text" name="studentemail" value="<?= $input_studentemail ?>">
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