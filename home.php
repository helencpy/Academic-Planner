<?php
	include("check.php");
	mysqli_query($db, "DELETE FROM `temp` WHERE username like '$login_user'");
	unset($semester);
	unset($session);
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
       setTimeout(function (){swal({html:true,title: "Opps!", text:"Please fill in username and password.",type: "warning"}, function(){window.location = "home.php";})}, 100);
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
               
			   <?php 
			   if(!isset($login_user)){
                echo '<form name="myForm" method="post" action="login.php" onsubmit="return validateForm()">';
					
						echo '<input type="text" name="username" placeholder="Username" style="color: #000000;"/>';
					
						echo '<input type="password" name="password" placeholder="Password" style="color: #000000;"/>';
							
						echo '<button class="btn btn-info" type="submit" name="submit" value="Login"><span class="glyphicon glyphicon-user"></span> &nbsp;Log Me In</button>';
					
				echo '</form>';
			   }
			   else{
				   echo '<div class="col-md-12">';
                   echo 'You are logged in as <em style="color:#AED6F1  ;">'.$login_user.'</em> (<a href="logout.php" style="color:#AED6F1  ;">Logout?</a>)';
                 
                   
                echo '</div>';
			   }
			   ?>
				
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
						
							<li><a class="menu-top-active" href="home.php"><i class="fa fa-home fa-lg" aria-hidden="true"></i>&nbsp&nbsp&nbsp Home</a></li>
                            <li><a href="result.php"><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i>&nbsp&nbsp&nbsp Result</a></li>
							<li><a href="course_info.php"><i class="fa fa-book fa-lg" aria-hidden="true"></i>&nbsp&nbsp&nbspCourses</a></li>
                            <li><a href="planner.php"><i class="fa fa-calculator fa-lg" aria-hidden="true"></i>&nbsp&nbsp&nbsp Planner</a></li>
                            <li><a href="recommendation.php"><i class="fa fa-thumbs-up fa-lg" aria-hidden="true"></i>&nbsp&nbsp&nbsp Recommendation</a></li>
							<li><a href="predict.php"><i class="fa fa-flag fa-lg" aria-hidden="true"></i>&nbsp&nbsp&nbsp Prediction</a></li>
                            <li><a href="cal.php"><i class="fa fa-file-o fa-lg" aria-hidden="true"></i>&nbsp&nbsp&nbsp Calculator</a></li>
                            <li><a href="statistic.php"><i class="fa fa-list-alt fa-lg" aria-hidden="true"></i>&nbsp&nbsp&nbsp Statistic</a></li>
						
						
						
						
						
						
						
						
						
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
                                <a href="recommendation.php"><img class="img-responsive img-full" src="img/slide-1.jpg" alt="">
								<div class="carousel-caption">
								<h4>Recommendation</h4>
								<p style="color:white; font-size:100%;">Offer the best recommendation of academic path to the students </p>
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
                                <a href="planner.php"><img class="img-responsive img-full" src="img/slide-3.jpg" alt="">
								<div class="carousel-caption">
								<h4>Planner</h4>
								<p style="color:white;font-size:100%;">Assist students in calculating their CGPA.</p>
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
