<?php

$servername="localhost";
$username="root";
$password="";
$dbname="attendance_db";



try{
  $conn=mysqli_connect($servername,$username,$password,$dbname);  
}catch(mysqli_sql_exception){
    echo "couldnot connect";
}

// if($conn){
//   echo "database connected!!!";
// }