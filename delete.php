<?php
include('check.php');
session_start();
if(isset($_GET['id']))
{
$course_code=$_GET['id'];
$query1=mysqli_query($db,"delete from courses where course_code='$course_code'");
if($query1)
{
header('location:courses.php');
}
}


if(isset($_POST['CourseCode']))
{
$course_code=$_POST['CourseCode'];
$query1=mysqli_query($db,"delete from temp where course_code='$course_code'");
/**if($query1)
{
header('location:planner2.php');
}**/
}

if(isset($_GET['r']))
{
$course_code=$_GET['r'];
$query1=mysqli_query($db,"delete from temp2 where course_code='$course_code'");
if($query1)
{
header('location:recommendation2.php');
}
}

if(isset($_POST['deleteSession']))
{
$deleteSession=$_POST['deleteSession'];
$query1=mysqli_query($db,"delete from t_session where session='$deleteSession'");

}

if(isset($_POST['deleteCourse']))
{
$deleteCourse=$_POST['deleteCourse'];
$query1=mysqli_query($db,"delete from temp where course_code='$deleteCourse'");

}

//used
if(isset($_POST['courses'])&&isset($_POST['session']))
{
	
	echo "<script>";
	echo "alert('hello');";
	echo "</script>";
	
$courses=$_POST['courses'];
$session=$_POST['session'];
$query1=mysqli_query($db,"delete from courses where course_code='$courses' AND session='$session'");

}
?>