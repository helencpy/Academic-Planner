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
	
	<link rel="stylesheet" href="star/css/star-rating.css" media="all" rel="stylesheet" type="text/css"/>
  <script src="star/js/star-rating.js" type="text/javascript"></script> 
	
	
	<style>
	
	
table {
    min-width: 50%;
    border-collapse: collapse;
}

table, td, th {
   text-align: left;
    padding: 5px;
}

td{
	color: black;
    
}

.modal-header {
      background-color: #AF7AC5;
      color:white !important;
      font-size: 30px;
  }

</style>
<script>
$(document).ready(function(){
	<?php 
	if(!empty($_GET)&&!isset($_GET["major_selected"])){
		 ?>
		$('#myModal').modal('show');
	<?php } ?>
	
    $('[data-toggle="tooltip"]').tooltip();
	if (sessionStorage.scrollTop != "undefined") {
		$(window).scrollTop(sessionStorage.scrollTop);
	}
	
});

$(window).scroll(function() {
  sessionStorage.scrollTop = $(this).scrollTop();
});

function majorselect(mjr) {
	   var mjr_value = mjr.options[mjr.selectedIndex].value;
	  
		window.location.href = "recommendation.php?major_selected="+mjr_value;
	
   }

</script>
</head>
<body>
    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                   You are logged in as <em style="color:#AED6F1  ;"><?php echo $login_user;?>.</em> (<a href="logout.php" style="color:#AED6F1  ;">Logout?</a>)
                  <!-- &nbsp;&nbsp; -->
                   
                </div>

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
							<li><a href="home.php"><i class="fa fa-home fa-lg" aria-hidden="true"></i>&nbsp&nbsp&nbsp Home</a></li>
                            <li><a href="result.php"><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i>&nbsp&nbsp&nbsp Result</a></li>
							<li><a href="course_info.php"><i class="fa fa-book fa-lg" aria-hidden="true"></i>&nbsp&nbsp&nbspCourses</a></li>
                            <li><a class="planner.php" href="planner.php"><i class="fa fa-calculator fa-lg" aria-hidden="true"></i>&nbsp&nbsp&nbsp Planner</a></li>
                            <li><a href="recommendation.php"><i class="fa fa-thumbs-up fa-lg" aria-hidden="true"></i>&nbsp&nbsp&nbsp Recommendation</a></li>
							<li><a class="predict.php" href="predict.php"><i class="fa fa-flag fa-lg" aria-hidden="true"></i>&nbsp&nbsp&nbsp Prediction</a></li>
                            <li><a href="cal.php"><i class="fa fa-file-o fa-lg" aria-hidden="true"></i>&nbsp&nbsp&nbsp Calculator</a></li>
                            <li><a href="statistic.php"><i class="fa fa-list-alt fa-lg" aria-hidden="true"></i>&nbsp&nbsp&nbsp Statistic </a></li>
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
                <div class="col-md-12">
                    <h4 class="page-head-line"><i class="fa fa-thumbs-up fa-lg" aria-hidden="true"></i>&nbsp&nbsp&nbsp Statistic</h4>

                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                      <div class="Compose-Message">               
                <div class="panel panel-info">
                    <div class="panel-heading">
                        Result Statistic
                    </div>
                    <div class="panel-body">

						<div class="alert alert-info">
                            Instruction to generate a statistic view of certain subject of previous batch<br>
							1. Select the subject<br>
							2. Press Output<br>
					
							
						</div>

						

					
					<div class="col-lg-2">
						<label><p>Subject : </p></label>
					<?php
// poorman.php
 
echo "<form action='statistic.php' method='get'>";
//echo "Number values to generate: <input type='number' name='N' />";
?>

<select id="myForm" action="" class="selectpicker" name="N" data-live-search="false" data-size="10" data-width="200%">
										
										<option value="1">Advance Programming</option>
										<option value="2">Software Validation and Verification</option>
										<option value="3">Software Process and Metric</option>
										
								</select>
								<br>
			<?php
			echo "<br>";
echo '<input class="btn btn-info" type="submit" value="Output"></input>&nbsp;';


echo "</form>";
 
if(isset($_GET['N']))
{
  $N = $_GET['N'];
 

  // execute R script from shell
  // this will save a plot at temp.png to the filesystem
  exec(".\R\R-3.3.1\bin\Rscript.exe .\R\R-3.3.1\bin\k\my_rscript.R $N");
  //exec(".\R\R-3.3.1\bin\Rscript .\R\R-3.3.1\bin\multiple_regression.R $w_currentCGPA $w_interest $w_prediction $w_difficulty"); 
 
  // return image tag
  $nocache = rand();
  echo("<img src='temp.png?$nocache' />");
}
?>
					
					</div>
					<div class="clearfix"></div>
					<br>
					<div class="col-lg-10">
		
			</div>
			</form>
						
					
                     <!--<div class="panel-footer text-muted">
                        <strong>Note : </strong>Please note that we track all messages so don't send any spams.
                    </div> -->
                </div>
                     </div>
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
                    &copy; 2016 Academic Project | Front-end modified by : Helen Chong
                </div>

            </div>
        </div>
    </footer>
    <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY SCRIPTS -->
	
</body>
</html>
