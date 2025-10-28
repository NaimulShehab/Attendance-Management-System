<?php
session_start();

if (!isset($_SESSION['user_name']) || empty($_SESSION['user_name'])) {
    header('Location: teacher_login.php');
    exit();
}

include('database.php');

if (isset($_POST['save'])) {
    $b_id = $_POST['b_id'];
    $c_id = $_POST['c_id'];
    $att_date = $_POST['att_date'];
    $att_status_array = $_POST['att_status'] ?? []; 

    $t_name = mysqli_real_escape_string($conn, $_SESSION['user_name']);

    $errors = []; // Initialize an errors array

    foreach ($att_status_array as $std_id => $status) {
        $std_id = mysqli_real_escape_string($conn, $std_id);
        $status = mysqli_real_escape_string($conn, $status);
        $b_id_safe = mysqli_real_escape_string($conn, $b_id);
        $c_id_safe = mysqli_real_escape_string($conn, $c_id);
        $att_date_safe = mysqli_real_escape_string($conn, $att_date);

        // Check if record exists
        $sql_check = "SELECT att_id FROM attendance_table 
                      WHERE std_id = '$std_id' 
                      AND c_id = '$c_id_safe' 
                      AND b_id = '$b_id_safe' 
                      AND att_date = '$att_date_safe'";
        
        $result = mysqli_query($conn, $sql_check);

        if (mysqli_num_rows($result) > 0) {
            // Record exists, update it
            $sql_update = "UPDATE attendance_table 
                          SET att_status = '$status', t_name = '$t_name' 
                          WHERE std_id = '$std_id' 
                          AND c_id = '$c_id_safe' 
                          AND b_id = '$b_id_safe' 
                          AND att_date = '$att_date_safe'";
            
            if (!mysqli_query($conn, $sql_update)) {
                $errors[] = "Failed to update attendance for student ID $std_id.";
            }
        } else {
            // Record doesn't exist, insert new
            $sql_insert = "INSERT INTO attendance_table 
                           (std_id, c_id, b_id, att_date, att_status, t_name) 
                           VALUES 
                           ('$std_id', '$c_id_safe', '$b_id_safe', '$att_date_safe', '$status', '$t_name')";

            if (!mysqli_query($conn, $sql_insert)) {
                $errors[] = "Failed to save attendance for student ID $std_id.";
            }
        }
    }

    if (empty($errors)) {
        // Set success message
        $_SESSION['message'] = "Attendance saved successfully.";
        header('Location: take_attendance.php');
        exit();
    } else {
        // Set error messages
        $_SESSION['errors'] = $errors;
        header('Location: take_attendance.php');
        exit();
    }
} else {
    echo "<h2>Error</h2>";
    echo "<p>Invalid request to save attendance.</p>";
}

mysqli_close($conn);
?>