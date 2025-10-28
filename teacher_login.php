<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Login</title>
    <link rel="stylesheet" href="style/teacher_login.css">
</head>
<body>


    <div class="login_form">
        <form action="#" method="post">
            <h3>Attendance Management System</h3>
            <h3>Login For Teachers</h3>
            <input type="text" name="t_username" placeholder="Enter Your Username">
            <input type="password" name="t_password" placeholder="Enter Your Password">
            <input type="submit" value="Log In">
            <p>Your are not registered? <a href="teacher_reg.php">Register Now</a></p>
        </form>
    </div>
    <?php
    include('database.php');
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = $_POST['t_username'];
        $password = $_POST['t_password'];

        $sql= "SELECT * FROM teacher_info WHERE t_username = '$username' && t_password = '$password';";

        $data = mysqli_query($conn,$sql);
        $result = mysqli_num_rows($data);

        if($result==1){

            $_SESSION['user_name']=$username;
            header('location:home_page.php');
        }else{
            echo "log in failed!!!";
        }

    }
    ?>
</body>
</html>