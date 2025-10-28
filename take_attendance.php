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
    <title>Take Attendance</title>
    <link rel="stylesheet" href="style/take_attendance.css">
    <style>
        /* Add styles for notifications */
        .notification {
            padding: 15px;
            margin: 10px 0;
            border-radius: 5px;
            color: #ffffff;
            width: 300px;
        }
        .success {
            background-color: #4CAF50; /* Green */
        }
        .error {
            background-color: #f44336; /* Red */
        }
    </style>
</head>
<body>
    <div class="nav">
        <a href="home_page.php">Home Page</a>
        <a href="view_attendance.php">Show Attendance</a>
        <a href="batch_data_insert.php">Enter New Batch</a>
        <a href="course_data_insert.php">Enter New Course</a>
        <a href="student_data_insert.php">Enter New Student</a>
        <a href="assign_batch_student.php">Assign Batch for Student</a>
    </div>
    
    <h1>Take Attendance</h1>

    <!-- Display Notifications -->


    <div class="attendance_form">
        <form action="#" method="post">
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

            <div class="Choose_date">
                <input type="date" name="att_date" required>
            </div>
            
            <div class="Submit_btn">
                <input type="submit" name="submit" value="Find Students">
            </div>
        </form>
    </div>

    <?php
    if (isset($_POST['submit']) && !empty($_POST['b_id'])) {
        $b_id = mysqli_real_escape_string($conn, $_POST['b_id']);
        $c_id = mysqli_real_escape_string($conn, $_POST['c_id']);
        $att_date = mysqli_real_escape_string($conn, $_POST['att_date']);

        $sql_student_id_name = "
            SELECT sb.std_id, si.std_name 
            FROM student_batch_info sb 
            INNER JOIN student_info si 
            ON sb.std_id = si.std_id 
            WHERE sb.b_id = '$b_id'";

        $result = mysqli_query($conn, $sql_student_id_name);
        if ($result && mysqli_num_rows($result) > 0) {
            echo "<form action='save_attendance.php' method='post'>";
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
                echo "<td>";
                echo "<input type='radio' name='att_status[{$row_std['std_id']}]' value='present' required> Present<br>";
                echo "<input type='radio' name='att_status[{$row_std['std_id']}]' value='absent'> Absent<br>";
                echo "<input type='radio' name='att_status[{$row_std['std_id']}]' value='late'> Late";
                echo "</td>";
                echo "</tr>";
            }
            
            echo "</tbody>";
            echo "</table>";
            echo "<input type='hidden' name='b_id' value='$b_id'>";
            echo "<input type='hidden' name='c_id' value='{$c_id}'>";
            echo "<input type='hidden' name='att_date' value='{$att_date}'>";
            echo "<input type='submit' name='save' value='Save Attendance'>";
            echo "</form>";
        } else {
            echo "<p>No students found for this batch.</p>";
        }
    }
   
    if (isset($_SESSION['message'])) {
        echo "<div class='notification success'>{$_SESSION['message']}</div>";
        unset($_SESSION['message']);
    }

    if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
        echo "<div class='notification error'><ul>";
        foreach ($_SESSION['errors'] as $error) {
            echo "<li>" . htmlspecialchars($error) . "</li>";
        }
        echo "</ul></div>";
        unset($_SESSION['errors']);
    }


    mysqli_close($conn);
    ?>
</body>
</html>