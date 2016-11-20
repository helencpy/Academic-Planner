<?php
session_start();
include("connection.php"); //Establishing connection with our database
 
$error = ""; //Variable for storing our errors.

if(isset($_POST['submit']))
{
	
if(empty($_POST['username']) || empty($_POST['password']))
{

echo '<script type="text/javascript">';
echo 'setTimeout(function (){swal({html:true,title: "Opps!", text:"Please fill in the required fields.",type: "warning"}, function(){window.location = "home.php";})}, 100);';
echo '</script>';

}else
{
// Define $username and $password
$username=$_POST['username'];
$password=$_POST['password'];

// To protect from MySQL injection
$username = stripslashes($username);
$password = stripslashes($password);
$username = mysqli_real_escape_string($db, $username);
$password = mysqli_real_escape_string($db, $password);
//$password = md5($password);

//Check username and password from database
$sql="SELECT * FROM users WHERE username='$username' and password='$password'";
$result=mysqli_query($db,$sql);
$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
 
//If username and password exist in our database then create a session.
//Otherwise echo error.

if(mysqli_num_rows($result) > 0)
{
	$login_user=$row['username'];
	$_SESSION['username'] = $login_user; // Initializing Session
if($row['admin']==1){
	header("location: admin_course.php");
}
else
{
header("location: result.php"); // Redirecting To Other Page
}
}else
{

echo '<script type="text/javascript">';
echo 'setTimeout(function (){swal({html:true,title: "Opps!", text:"Incorrect username or password.",type: "warning"}, function(){window.location = "home.php";})}, 100);';
echo '</script>';

}
 
}
}
unset($_POST['cancel']);
 unset($_POST['submit']);
?>
<script src="sweetalert-master/dist/sweetalert.min.js"></script> 
<link rel="stylesheet" type="text/css" href="sweetalert-master/dist/sweetalert.css"/>
