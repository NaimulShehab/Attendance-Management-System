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

$sql_student_info_insert = "INSERT INTO student_info (std_id, std_name, std_gender) VALUES  ('CSE 136', 'Nadia', 'Female'),
        ('CSE 137', 'Mostofa', 'Male'),
        ('CSE 139', 'lija', 'Female'),
        ('CSE 141', 'Rodoshi', 'Female'),
        ('CSE 142', 'Rokoni', 'Male'),
        ('CSE 144', 'Nafim', 'Male'),
        ('CSE 147', 'Dola', 'Female'),
        ('CSE 150', 'Nidhi', 'Female'),
        ('CSE 152', 'Hafsa', 'Female'),
        ('CSE 153', 'Jim', 'Female'),
        ('CSE 155', 'Moutushi', 'Female'),
        ('CSE 156', 'Mymuna', 'Female'),
        ('CSE 158', 'Sobuj', 'Male'),
        ('CSE 159', 'Hridi', 'Female'),
        ('CSE 160', 'Nayeem', 'Male'),
        ('CSE 161', 'Jumana', 'Female'),
        ('CSE 162', 'Shehab', 'Male'),
        ('CSE 163', 'Sakib', 'Male'),
        ('CSE 165', 'Shohan', 'Male'),
        ('CSE 166', 'Sifat', 'Male'),
        ('CSE 171', 'Sabbir', 'Male'),
        ('CSE 173', 'Mesbha', 'Male'),
        ('CSE 175', 'Afrin', 'Female'),
        ('CSE 176', 'Afroza', 'Female')   
        ;";

if(mysqli_query($conn,$sql_student_info_insert)){
    echo "student data inserted!!<br>";
}else{
    echo "student data is not inserted!!";
}

?>