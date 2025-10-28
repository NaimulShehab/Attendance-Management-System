<?php
session_start();

$user_profile= $_SESSION['user_name'];

if($user_profile == true){

}
else{
    header('location:teacher_login.php');
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Batch Entry</title>
    <link rel="stylesheet" href="style/batch_data_insert.css">
</head>
<body>

    <div class="nav">
            <a href="home_page.php">Home Page</a>
            <a href="take_attendance.php">Take Attendance</a>
            <a href="view_attendance.php">Show Attendance</a>
            <a href="course_data_insert.php">Enter New Course</a>
            <a href="student_data_insert.php">Enter New Student</a>
            <a href="assign_batch_student.php">Assign Batch for Student</a>
    </div>

    <div class="batch_form">
        <form action="#" method="post">
            <h1>New Batch Entry</h1>
            <input type="text" name="b_id" placeholder="Enter Batch ID" required>
            <input type="text" name="b_name" placeholder="Enter Batch Name" required>
            <input type="text" name="b_year" placeholder="Enter Batch Year" required>
            <input type="submit" value="Submit">
        </form>
    </div>



    <?php
    include 'database.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['b_id']) && isset($_POST['b_name']) && isset($_POST['b_year'])) {
            $b_id = $_POST['b_id'];
            $b_name = $_POST['b_name'];
            $b_year = $_POST['b_year'];

            $sql_batch = "INSERT INTO batch_info (b_id, b_name, b_year) VALUES ('$b_id', '$b_name', '$b_year')";
            if (mysqli_query($conn, $sql_batch)) {
                echo "<p>Batch information inserted successfully!</p>";
            } else {
                echo "<p>Batch information insertion failed</p>";
            }
        } else {
            echo "<p>Please provide Batch ID, Batch Name, and Batch Year.</p>";
        }
    }
    ?>
</body>
</html>