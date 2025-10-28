<!-- <?php
session_start();

$user_profile= $_SESSION['user_name'];

if($user_profile == true){

}
else{
    header('location:teacher_login.php');
}
?> -->




<?php
include('database.php');

$sql_student_info_table = "CREATE TABLE student_info (
    std_id varchar(50) NOT NULL PRIMARY KEY,
    std_name varchar(50) NOT NULL,
    std_gender varchar(10) NOT NULL
)";

if (mysqli_query($conn, $sql_student_info_table)) {
    echo "student_info table created!!";
} else {
    echo "student_info table is not created!!";
}

$sql_teacher_info_table = "CREATE TABLE teacher_info (
    t_id varchar(50) NOT NULL PRIMARY KEY,
    t_name varchar(50) NOT NULL,
    t_username varchar (50) NOT NULL UNIQUE,
    t_password varchar (100) NOT NULL
)";

if (mysqli_query($conn, $sql_teacher_info_table)) {
    echo "teacher_info table created!!";
} else {
    echo "teacher_info table is not created!!";
}

$sql_course_info_table = "CREATE TABLE course_info (
    c_id int(20) NOT NULL PRIMARY KEY,
    c_name varchar(50) NOT NULL
)";

if (mysqli_query($conn, $sql_course_info_table)) {
    echo "course_info table created!!";
} else {
    echo "course_info table is not created!!";
}

$sql_batch_info_table = "CREATE TABLE batch_info (
    b_id int NOT NULL PRIMARY KEY,
    b_name varchar(50) NOT NULL,
    b_year int (20) NOT NULL
)";

if (mysqli_query($conn, $sql_batch_info_table)) {
    echo "batch_info table created!!";
} else {
    echo "batch_info table is not created!!";
}

// relational tables:

$sql_student_batch_table = "CREATE TABLE student_batch_info (
    sb_id int(100) PRIMARY KEY AUTO_INCREMENT,
    std_id varchar(50),
    b_id int(100),
    FOREIGN KEY (std_id) REFERENCES student_info(std_id),
    FOREIGN KEY (b_id) REFERENCES batch_info(b_id)

)";
if (mysqli_query($conn, $sql_student_batch_table)) {
    echo "student_batch_info table created!!";
} else {
    echo "student_batch_info table is not created!!";
}


$sql_course_batch_table = "CREATE TABLE course_batch_info (
    cb_id int(100) PRIMARY KEY AUTO_INCREMENT,
    c_id int(20),
    b_id int(100),
    t_id varchar(50),
    FOREIGN KEY (c_id) REFERENCES course_info(c_id),
    FOREIGN KEY (b_id) REFERENCES batch_info(b_id),
    FOREIGN KEY (t_id) REFERENCES teacher_info(t_id)

)";
if (mysqli_query($conn, $sql_course_batch_table)) {
    echo "course_batch_info table created!!";
} else {
    echo "course_batch_info table is not created!!";
}


$sql_attendance_table = "CREATE TABLE attendance_table (
    att_id int(100) PRIMARY KEY AUTO_INCREMENT,
    std_id varchar(50),
    c_id int(20),
    b_id int(100),
    att_date DATE,
    att_status ENUM('Present', 'Absent', 'Late'),
    marked_by varchar(50),

)";
if (mysqli_query($conn, $sql_attendance_table)) {
    echo "attendance table created!!";
} else {
    echo "attendance table is not created!!";
}

?>




