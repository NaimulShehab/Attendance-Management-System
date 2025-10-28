<?php
session_start();

$user_profile= $_SESSION['user_name'];

if($user_profile == true){

}
else{
    header('location:teacher_login.php');
}

include('database.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Batch to Students</title>
    <link rel="stylesheet" href="style/assign_batch_student.css">
</head>
<body>

    <div class="nav">
            <a href="home_page.php">Home Page</a>
            <a href="take_attendance.php">Take Attendance</a>
            <a href="view_attendance.php">Show Attendance</a>
            <a href="batch_data_insert.php">Enter New Batch</a>
            <a href="course_data_insert.php">Enter New Course</a>
            <a href="student_data_insert.php">Enter New Student</a>
    </div>

    <form action="#" method="post">
    <div class="choose_batch">
                <select name="b_id" required>
                    <option value="">Choose Batch</option>
                    <?php
                    $sql_choose_batches = "SELECT * FROM batch_info";
                    $result_batches = mysqli_query($conn, $sql_choose_batches);
                    if ($result_batches) {
                        while ($row_batch = mysqli_fetch_assoc($result_batches)) {
                            echo "<option value='{$row_batch['b_id']}'>{$row_batch['b_name']}</option>";
                        }
                    }
         ?>
        </select>
    </div>

    <div class="choose_std">
                <select name="std_id" required>
        <option value="">Choose Student</option>
        <?php
        $sql_choose_std = "SELECT si.std_id 
                           FROM student_info si
                           LEFT JOIN student_batch_info sbi ON si.std_id = sbi.std_id
                           WHERE sbi.std_id IS NULL";

        $result_std = mysqli_query($conn, $sql_choose_std);
        if ($result_std) {
            while ($row_std = mysqli_fetch_assoc($result_std)) {
                echo "<option value='{$row_std['std_id']}'>{$row_std['std_id']}</option>";
            }
        }
        ?>
    </select>    
    </div>
    <div><input type="submit" value="Submit" name="submit"></div>
    </form>

    <?php
    if (isset($_POST['submit']) && !empty($_POST['b_id']) && !empty($_POST['std_id'])){
        $std_id = $_POST['std_id'];
        $b_id = $_POST['b_id'];

        $sql= "INSERT INTO student_batch_info (std_id, b_id) VALUES  ('$std_id', '$b_id')";
        if(mysqli_query($conn,$sql)){
                echo "<p>Batch Assign Successfull.</p>";
            }else{
                echo "<p>Batch Assign failed..</p>";
            }
    }
    ?>

</body>