<?php
session_start();

if (!isset($_SESSION['user_name']) || empty($_SESSION['user_name'])) {
    header('Location: teacher_login.php');
    exit();
}


include('database.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Attendance</title>
    <link rel="stylesheet" href="style/view_attendance.css">
</head>
<body>
    <div class="nav">
            <a href="home_page.php">Home Page</a>
            <a href="take_attendance.php">Take Attendance</a>
            <a href="batch_data_insert.php">Enter New Batch</a>
            <a href="course_data_insert.php">Enter New Course</a>
            <a href="student_data_insert.php">Enter New Student</a>
            <a href="assign_batch_student.php">Assign Batch for Student</a>
    </div>

    <h1>View Attendance</h1>
    <div>
        <form action="" method="post">
            <div class="choose_course">
                <select name="c_id" required>
                    <option value="">Choose Course</option>
                    <?php
                    $sql_choose_courses = "SELECT * FROM course_info";
                    $result_courses = mysqli_query($conn, $sql_choose_courses);
                    if ($result_courses) {
                        while ($row_course = mysqli_fetch_assoc($result_courses)) {
                            echo "<option value='{$row_course['c_id']}'>{$row_course['c_name']}</option>";
                        }
                    }
                    ?>
                </select>
            </div>

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

            <div class="choose_date">
                <input type="date" name="att_date" required>
            </div>

            <div class="submit_btn">
                <input type="submit" name="submit" value="Show attendance">
            </div>
        </form>
    </div>

    <?php

    if (isset($_POST['submit']) && !empty($_POST['c_id']) && !empty($_POST['b_id']) && !empty($_POST['att_date'])){
        $c_id = $_POST['c_id'];
        $b_id = $_POST['b_id'];
        $att_date = $_POST['att_date'];

$sql_show_attendance = "
  SELECT sb.std_id, si.std_name, ai.att_status
  FROM student_batch_info sb
  INNER JOIN student_info si ON sb.std_id = si.std_id
  INNER JOIN attendance_table ai ON sb.std_id = ai.std_id
  WHERE sb.b_id = '{$b_id}'
    AND ai.c_id = '{$c_id}'
    AND ai.att_date = '{$att_date}'
  ORDER BY sb.std_id
";
        
        $result = mysqli_query($conn, $sql_show_attendance);
        if ($result && mysqli_num_rows($result) > 0){
            echo "<table>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>Student ID</th>";
            echo "<th>Student Name</th>";
            echo "<th>Status</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            
            while ($row_std = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>{$row_std['std_id']}</td>";
                echo "<td>{$row_std['std_name']}</td>";
                echo "<td>{$row_std['att_status']}</td>";
                echo "</tr>";
            }
        }else {
            echo "<p>Attendance isn't taken.</p>";
        }
    }
    ?>





    <?php
    mysqli_close($conn);
    ?>

</body>
</html>