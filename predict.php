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
    $('[data-toggle="tooltip"]').tooltip();
	if (sessionStorage.scrollTop != "undefined") {
		$(window).scrollTop(sessionStorage.scrollTop);
	}
	
	<?php 
	if(isset($_POST['button_find'])){
		 if($_POST['course']=="null"){
		 ?>
		setTimeout(function (){swal({html:true,title: "Opps!", text:"Please select course.",type: "warning"}, function(){window.location = "course_info.php";})}, 100);
	<?php } else{			?>	
		$('#myModal').modal('show');
	<?php }} ?>
});

$(window).scroll(function() {
  sessionStorage.scrollTop = $(this).scrollTop();
});

   
   function sessionselect(sessi,second) {
	   var session_value = sessi.options[sessi.selectedIndex].value;
	   //var second_value = second.options[second.selectedIndex].value;
	   //var second = <?php echo(json_encode(isset($_GET["major_selected"]))); ?>;

		window.location.href = "course_info.php?session_selected="+session_value;
	
   }

</script>
</head>
<body>
    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                   You are logged in as <em style="color:#AED6F1  ;"><?php echo $login_user;?></em> (<a href="logout.php" style="color:#AED6F1  ;">Logout?</a>)
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
							<li><a class="menu-top-active" href="predict.php"><i class="fa fa-flag fa-lg" aria-hidden="true"></i>&nbsp&nbsp&nbsp Prediction</a></li>
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
                    <h4 class="page-head-line"><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i>&nbsp&nbsp&nbspPrediction</h4>

                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                      <div class="Compose-Message">               
                <div class="panel panel-info">
                    <div class="panel-heading">
                        CGPA Predictor 
                    </div>
                    <div class="panel-body">
						<div class="alert alert-info">
                            Instruction on using the CGPA Predictor <br>
							1. Select your major<br>
							2. Select the category of subject that you would like to predict for your potential score<br>
							3. Enter your most recent GPA of one subject from the same category. <br>
							4. Press the calculate button<br>
							
						</div>
                        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                        <label>Major : </label><br>
									
									
									<select name="major" data-width="25%" class="selectpicker" >
    <option value="se">Software Engineering</option>
    <option value="ai">Artificial Intelligence</option>
    <option value="net">Networking</option>
    <option value="mis">Management of Information System</option>
  </select><br>
  
  
  
                        <label>Category : </label><br>
                      <select name="cat" data-width="25%" class="selectpicker">
						<option value="math">Mathematics</option>
						<option value="prg">Programming</option>
						<option value="theory">Theory</option>
						<option value="others">Others</option>
					  </select>
						<br>
						<label>Most Recent GPA : </label><Br><input type="number" name="gpa" value="" min="0" max="4" step="0.01" required > <Br>
						
						
						<?php
						
$gpa = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if(isset($_POST['gpa'], $_POST['Continue'] )){
		$gpa = $_SESSION["gpa"] =	$_POST["gpa"] ;
		$cat = $_SESSION["cat"] =	$_POST["cat"] ;
		$major = $_SESSION["major"] =	$_POST["major"] ;
		echo "<br>";
						
		
		if($major == "se" ){
			
			if($cat == "prg"){
		
					$output = shell_exec("\"C:\\xampp\\htdocs\\AcademicPlanner\\R\\R-3.3.1\\bin\\Rscript.exe\" C:/xampp/htdocs/AcademicPlanner/R/R-3.3.1/bin/k/test.R $gpa");
					
					$output = round($output, 4);
					echo "<label>Prediction using Linear Regression :  $output</label>"; 
					
					echo "<br>";
					
					$output1 = shell_exec("\"C:\\xampp\\htdocs\\AcademicPlanner\\R\\R-3.3.1\\bin\\Rscript.exe\" C:/xampp/htdocs/AcademicPlanner/R/R-3.3.1/bin/k/test1.R $gpa");
					$output1 = round($output1, 4);
					echo "<label>Prediction using ANN : $output1 </label>"; 
			}elseif($cat == "math"){
					$output = shell_exec("\"C:\\xampp\\htdocs\\AcademicPlanner\\R\\R-3.3.1\\bin\\Rscript.exe\" C:/xampp/htdocs/AcademicPlanner/R/R-3.3.1/bin/k/testmath.R $gpa");
					$output = round($output, 4);
					echo "<label>Prediction using Linear Regression :  $output</label>"; 
					echo "<br>";
					
					$output1 = shell_exec("\"C:\\xampp\\htdocs\\AcademicPlanner\\R\\R-3.3.1\\bin\\Rscript.exe\" C:/xampp/htdocs/AcademicPlanner/R/R-3.3.1/bin/k/test1math.R $gpa");
					$output1 = round($output1, 4);
						echo "<label>Prediction using ANN : $output1 </label>"; 
			
			}elseif($cat == "others"){
						$output = shell_exec("\"C:\\xampp\\htdocs\\AcademicPlanner\\R\\R-3.3.1\\bin\\Rscript.exe\" C:/xampp/htdocs/AcademicPlanner/R/R-3.3.1/bin/k/testother.R $gpa");
					$output = round($output, 4);
					echo "<label>Prediction using Linear Regression :  $output</label>"; 
					echo "<br>";
					
					$output1 = shell_exec("\"C:\\xampp\\htdocs\\AcademicPlanner\\R\\R-3.3.1\\bin\\Rscript.exe\" C:/xampp/htdocs/AcademicPlanner/R/R-3.3.1/bin/k/test1math.R $gpa");
					$output1 = round($output1, 4);
						echo "<label>Prediction using ANN : $output1 </label>"; 
			}elseif($cat == "theory"){
			$output = shell_exec("\"C:\\xampp\\htdocs\\AcademicPlanner\\R\\R-3.3.1\\bin\\Rscript.exe\" C:/xampp/htdocs/AcademicPlanner/R/R-3.3.1/bin/k/testtheory.R $gpa");
					$output = round($output, 4);
					echo "<label>Prediction using Linear Regression :  $output</label>"; 
					echo "<br>";
					
					$output1 = shell_exec("\"C:\\xampp\\htdocs\\AcademicPlanner\\R\\R-3.3.1\\bin\\Rscript.exe\" C:/xampp/htdocs/AcademicPlanner/R/R-3.3.1/bin/k/test1theory.R $gpa");
					$output1 = round($output1, 4);
						echo "<label>Prediction using ANN : $output1 </label>"; 
			}else{
				
			}
		
		}
	}
}


?>
                        <hr />
                        
						<input class="btn btn-info" type="submit" name="Continue" value="Predict"></input>&nbsp;
						
						 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
											
											
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
								</div>
                            </div>
                    </div>
				</div>
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
