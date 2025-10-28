<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Registration</title>
    <link rel="stylesheet" href="style/teacher_reg.css">
</head>
<body>
    <div class="reg_form">
        <form action="#" method="post">
            <h3>Teacher Registration Form</h3>
            <input type="text" name="t_id" placeholder="Enter teacher id">
            <input type="text" name="t_name" placeholder="Enter teacher name">
            <input type="text" name="t_username" placeholder="Enter teacher unique username">
            <input type="text" name="t_password" placeholder="Enter teacher password">
            <input type="submit" value="Submit">
            <p>Are you already registerd? <a href="teacher_login.php">Log In</a></p>
        </form>
    </div>
    <?php 
    include('database.php');
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        if (isset($_POST['t_id']) && isset($_POST['t_name']) && isset($_POST['t_username']) && isset($_POST['t_password'])){
            $t_id = $_POST['t_id'];
            $t_name = $_POST['t_name'];
            $t_username = $_POST['t_username'];
            $t_password  = $_POST['t_password'];

            $sql_teacher = "INSERT INTO teacher_info (t_id, t_name, t_username, t_password) VALUES ('$t_id', '$t_name', '$t_username', '$t_password')";
            if (mysqli_query($conn, $sql_teacher)) {
                echo "<p>Teacher information inserted successfully!</p>";
            } else {
                echo "<p>Teacher information insertion failed!!</p>";
            }
        } else {
            echo "<p>Please fill in all teacher details.</p>";
        }
    }
    ?>
</body>
</html>