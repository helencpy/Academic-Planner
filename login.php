<?php
session_start();
include("connection.php"); //Establishing connection with our database
 
$error = ""; //Variable for storing our errors.

if(isset($_POST['submit']))
{
	
if(empty($_POST['username']) || empty($_POST['password']))
{

echo '<script type="text/javascript">';
echo 'setTimeout(function (){swal({html:true,title: "Opps!", text:"Please fill in the required fields.",type: "warning"}, function(){window.location = "home.html";})}, 100);';
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
	echo '<script type="text/javascript">';
	echo 'setTimeout(function (){swal({html:true,title: "Success!", text:"You have successfully logged in.",type: "success"}, function(){window.location = "admin_home.php";})}, 50);';
	echo '</script>';
}
else
{
echo '<script type="text/javascript">';
echo 'setTimeout(function (){swal({html:true,title: "Success!", text:"You have successfully logged in.",type: "success"}, function(){window.location = "home.php";})}, 50);';
echo '</script>';
}
}else
{

echo '<script type="text/javascript">';
echo 'setTimeout(function (){swal({html:true,title: "Opps!", text:"Incorrect username or password.",type: "warning"}, function(){window.location = "home.html";})}, 100);';
echo '</script>';

}
 
}
}
unset($_POST['cancel']);
 unset($_POST['submit']);
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>Academic Planner</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME ICONS  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
     <!-- HTML5 Shiv and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	<!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/bootstrap-select.css">
	 <script src="js/bootstrap-select.js"></script>
	
    <script src="sweetalert-master/dist/sweetalert.min.js"></script> 
	<link rel="stylesheet" type="text/css" href="sweetalert-master/dist/sweetalert.css"/>

	<script>
function validateForm() {
    var x = document.forms["myForm"]["username"].value;
	var y = document.forms["myForm"]["password"].value;
    if (x == ""||y=="") {
       setTimeout(function (){swal({html:true,title: "Opps!", text:"Please fill in username and password.",type: "warning"}, function(){window.location = "home.html";})}, 100);
        return false;
    }
}

$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
	if (sessionStorage.scrollTop != "undefined") {
		$(window).scrollTop(sessionStorage.scrollTop);
	}
});

$(window).scroll(function() {
  sessionStorage.scrollTop = $(this).scrollTop();
});
</script>
	
</head>
<body>
    <header>
        <div class="container">
            <div class="row">
               
			  
               <form name="myForm" method="post" action="login.php" onsubmit="return validateForm()">
					
						<input type="text" name="username" placeholder="Username" style="color: #000000;"/>
					
						<input type="password" name="password" placeholder="Password" style="color: #000000;"/>
							
						<button class="btn btn-info" type="submit" name="submit" value="Login"><span class="glyphicon glyphicon-user"></span> &nbsp;Log Me In</button>
					
				</form>
				
            </div>      
        </div>         
    </header>
    <!-- HEADER END-->
    <div class="navbar navbar-inverse set-radius-zero">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">
                     <img src="assets/img/try.png" />
                </a>

            </div>

            <div class="left-div">
                <div class="user-settings-wrapper">
                    <ul class="nav">

                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                                <span class="glyphicon glyphicon-education" style="font-size: 25px;"></span>
                            </a>
                           
                        </li>


                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- LOGO HEADER END-->
    <section class="menu-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="navbar-collapse collapse ">
                        <ul id="menu-top" class="nav navbar-nav navbar-right">
						<li><a class="menu-top-active" href="#about"><i class="fa fa-home fa-lg" aria-hidden="true"></i>&nbsp&nbsp&nbsp Home</a></li>
						
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
				 <div class="dashboard-div-wrapper bk-clr-one">
					<div class="col-md-9"><br>
                    <div id="carousel-example-generic" class="carousel slide">
					<a name="about"></a>
                        <!-- Indicators -->
                        <ol class="carousel-indicators hidden-xs">
                            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            <div class="item active">
                                <a href="planner.php"><img class="img-responsive img-full" src="img/slide-1.jpg" alt="">
								<div class="carousel-caption">
								<h4>Planner</h4>
								<p style="color:white; font-size:100%;">Offer the best recommendation of minimum expected grade to be achieved based on the student’s current CGPA </p>
							</div>
                            </div>
                            <div class="item">
                                <a href="result.php"><img class="img-responsive img-full" src="img/slide-2.jpg" alt="">
								<div class="carousel-caption">
								<h4>Result</h4>
								<p style="color:white;font-size:100%;">Help students to keep track their past performance. </p>
							</div>
                            </div>
                            <div class="item">
                                <a href="target.php"><img class="img-responsive img-full" src="img/slide-3.jpg" alt="">
								<div class="carousel-caption">
								<h4>Target</h4>
								<p style="color:white;font-size:100%;">Help students to set the target grades of courses for all semester.</p>
							</div>
                            </div>
                        </div>

                        <!-- Controls -->
                        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                            <span class="icon-prev"></span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                            <span class="icon-next"></span>
                        </a>
                    </div>
					</div><br>
                    <h2 style="color:#6C3483;"><i class="fa fa-graduation-cap fa-3x" aria-hidden="true"></i><br>
                        <small><b>Welcome to</b></small>
                    </h2>
					
                    <h2 style="color:black;"><b>Academic Planner</b></h2>
					<br>
                    <h4>
                        <small>
                            <strong>Faculty of Computer Science & Information Technology, <br> University of Malaya</strong>
                        </small>
                    </h4>
					<br><br><br>
                </div>
            </div>
        </div>
                </div>

            </div>
            

    <!-- CONTENT-WRAPPER SECTION END-->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    &copy; 2016 Academic Project | By : cpyian@siswa.um.edu.my
                </div>

            </div>
        </div>
    </footer>
    <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY SCRIPTS -->
	
   
	
</body>
</html>

