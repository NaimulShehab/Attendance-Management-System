<?php
session_start();

if (!isset($_SESSION['user_name']) || empty($_SESSION['user_name'])) {
    header('Location: teacher_login.php');
    exit();
}

$user_profile = $_SESSION['user_name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page - Attendance Management System</title>
    <link rel="stylesheet" href="style/home_page.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 class="header-title">Attendance Management System</h1>
            <div class="logout_btn">
                <a href="logout.php"><button>Logout</button></a>
            </div>
        </div>

        <div class="welcome-container">
            <p class="welcome-message">Welcome back, <span class="user-name"><?php echo htmlspecialchars($user_profile); ?></span>!</p>
        </div>

        <div class="nav">
            <a href="take_attendance.php">Take Attendance</a>
            <a href="view_attendance.php">Show Attendance</a>
            <a href="batch_data_insert.php">Enter New Batch</a>
            <a href="course_data_insert.php">Enter New Course</a>
            <a href="student_data_insert.php">Enter New Student</a>
            <a href="assign_batch_student.php">Assign Batch for Student</a>
        </div>
    </div>
</body>
</html>