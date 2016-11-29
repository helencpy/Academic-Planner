<?php
include('connection.php');
session_start();
$user_check=$_SESSION['username'];
 
$sql = mysqli_query($db,"SELECT * FROM `users` join `t_major` on `t_major`.major_id= `users`.major_id WHERE username='$user_check' ");
$row=mysqli_fetch_array($sql,MYSQLI_ASSOC);
 
$login_user=$row['username'];
$student_id=$row['student_id'];
$major=$row['major'];
$cgpa=$row['cgpa'];
if(!isset($user_check))
{
header("Location: home.php");
}