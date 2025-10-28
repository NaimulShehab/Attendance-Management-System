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
    <title>Student Data Insertion</title>
    <link rel="stylesheet" href="style/student_data_insert.css">
</head>
<body>

    <div class="nav">
            <a href="home_page.php">Home Page</a>
            <a href="take_attendance.php">Take Attendance</a>
            <a href="view_attendance.php">Show Attendance</a>
            <a href="batch_data_insert.php">Enter New Batch</a>
            <a href="course_data_insert.php">Enter New Course</a>
            <a href="assign_batch_student.php">Assign Batch for Student</a>
    </div>

    <div class="student_form">
        <form action="#" method="post">
            <h3>New Student Entry</h3>
            <input type="text" name="std_id" placeholder="Enter Student Id" required>
            <input type="text" name="std_name" placeholder="Enter Student Name" required>
            <select name="std_gender" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
            <input type="submit" value="Submit">
        </form>
    </div>



    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        if (isset($_POST['std_id']) && isset($_POST['std_name']) && isset($_POST['std_gender'])){
            $std_id = $_POST['std_id'];
            $std_name = $_POST['std_name'];
            $std_gender = $_POST['std_gender'];

            $sql_std="INSERT INTO student_info (std_id, std_name, std_gender) VALUES  ('$std_id', '$std_name', '$std_gender')";
            if(mysqli_query($conn,$sql_std)){
                echo "<p>student data insertion successfull.</p>";
            }else{
                echo "<p>student data insertion failed..</p>";
            }
        }else{
            echo "<p>Please provide Student ID , Student name and Student gender.</p>";
        }
    } 
        
    ?>
    
</body>
</html>