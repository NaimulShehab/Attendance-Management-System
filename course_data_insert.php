<?php
session_start();

$user_profile= $_SESSION['user_name'];

if($user_profile == true){

}
else{
    header('location:teacher_login.php');
}
?>


<?php
    include('database.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Course Entry</title>
    <link rel="stylesheet" href="style/course_data_insert.css">
</head>
<body>

    <div class="nav">
            <a href="home_page.php">Home Page</a>
            <a href="take_attendance.php">Take Attendance</a>
            <a href="view_attendance.php">Show Attendance</a>
            <a href="batch_data_insert.php">Enter New Batch</a>>
            <a href="student_data_insert.php">Enter New Student</a>
            <a href="assign_batch_student.php">Assign Batch for Student</a>
    </div>

    <div class="course_form">
        <form action="#" method="post">
            <h3>New Course Entry</h3>
            <input type="text" name="c_id" placeholder="Enter course id">
            <input type="text" name="c_name" placeholder="Enter course name ">
            <input type="submit" value="Submit">
        </form>
    </div>


    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        if (isset($_POST['c_id']) && isset($_POST['c_name'])) {
            $c_id = $_POST['c_id'];
            $c_name = $_POST['c_name'];

            $sql_course = "INSERT INTO course_info (c_id, c_name) VALUES  ('$c_id', '$c_name');";
            if(mysqli_query($conn,$sql_course)){
                echo "<p>Course insertion successfull.</p>";
            }else{
                echo "<p>Course insertion failed..</p>";
            }
        }else {

            echo "<p>Please provide both course ID and course name.</p>";
        }
    }
    ?>
</body>
</html>