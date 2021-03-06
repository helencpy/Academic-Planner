﻿<?php
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
							<li><a class="menu-top-active" href="course_info.php"><i class="fa fa-book fa-lg" aria-hidden="true"></i>&nbsp&nbsp&nbspCourses</a></li>
                            <li><a href="planner.php"><i class="fa fa-calculator fa-lg" aria-hidden="true"></i>&nbsp&nbsp&nbsp Planner</a></li>
                            <li><a href="recommendation.php"><i class="fa fa-thumbs-up fa-lg" aria-hidden="true"></i>&nbsp&nbsp&nbsp Recommendation</a></li>
							<li><a href="predict.php"><i class="fa fa-flag fa-lg" aria-hidden="true"></i>&nbsp&nbsp&nbsp Prediction</a></li>
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
                    <h4 class="page-head-line"><i class="fa fa-book fa-lg" aria-hidden="true"></i>&nbsp&nbsp&nbspCourses</h4>

                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                      <div class="Compose-Message">               
                <div class="panel panel-info">
                    <div class="panel-heading">
                        Search Course Information
                    </div>
                    <div class="panel-body">
                        <form method="post">
                        <label>Batch : </label><br>
									<?php
									
										echo '<select class="selectpicker" name="session" data-live-search="true" data-size="10" data-width="25%" onchange="javascript:sessionselect(this,0)">';
					
									
									if(isset($_GET["session_selected"]))
									{
										$sess = $_GET['session_selected'];
										$session_result = mysqli_query($db, "SELECT * FROM t_session");
										echo '<option data-hidden="true" value=$sess>Session '.$sess.'</option>';
										while($getSessionArray = mysqli_fetch_array($session_result))
										{
											echo "<option value={$getSessionArray['session']}>{$getSessionArray['session']}</option>";
										}
									}
									else{
										$session_result = mysqli_query($db, "SELECT * FROM t_session");
										echo '<option data-hidden="true" value="null">Select batch.</option>';
										while($getSessionArray = mysqli_fetch_array($session_result))
										{
											echo "<option value={$getSessionArray['session']}>{$getSessionArray['session']}</option>";
										}
									}
									?>
						</select><br>
                        <label>Course : </label><br>
                        <select class="selectpicker" name="course" data-live-search="true" data-size="10" data-width="50%">
									<?php
									if(isset($_POST['button_find']))
											{
												$course_code = mysqli_real_escape_string($db, $_POST['course']);
												if($course_code=="null"||$course_code==null){
													echo '<option data-hidden="true" value="null">Select course.</option>';
												}
												else{
													$sql="SELECT * FROM courses where course_code like '$course_code'";
													$result = mysqli_query($db,$sql);
													$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
													
													$courseName=$row['course_name'];												
													echo "<option value=".$course_code.">".$course_code."\t\t". $courseName."</option>";
												}
										}
									else{
									echo '<option data-hidden="true" value="null">Select course.</option>';
									}
									
									if(isset($_GET["session_selected"]))
									{
										$sessi = $_GET['session_selected'];	
										
											$result = mysqli_query($db, "SELECT * FROM courses WHERE session like '$sess'");
										
										while($getCourseArray = mysqli_fetch_array($result))
										{
											echo "<option value={$getCourseArray['course_code']}>{$getCourseArray['course_code']}\t\t{$getCourseArray['course_name']}</option>";
										}
									}
									?>
						</select>
                        <hr />
                        <button class="btn btn-info" type="submit" name="button_find"><span class="glyphicon glyphicon-search"></span> Search </button>&nbsp;
						
						 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
											
											<?php
											if(isset($_POST['button_find']))
											{
												
												if(isset($course_code)) 
												{
								
													
													
                                            echo '<h4 class="modal-title" id="myModalLabel"><i class="fa fa-info-circle fa-lg" aria-hidden="true"></i><b>&nbsp&nbsp&nbsp'.$course_code.'</b> '.$courseName.'</h4>';
                                        echo '</div>';
                                        echo '<div class="modal-body">';
										
													
														echo '<table>';
														echo "<tr>";
														echo "<th>Credit:</th>";
											
														echo "<td>" . $row['credit'] . " credits <br></td>";
														echo '</tr>';
											
														echo "<tr>";
														echo "<th>Semester Available:</th>";
											
														echo "<td>Semester " . $row['semester_available'] . "<br></td>";
														echo "</tr>";
											
														echo "<tr>";
														echo "<th>Pre-requisite:</th>";
											
														if(!$row['pre_requisite']||$row['pre_requisite']="null"){
															echo"<td>None<br></td>";
														}
														else{
															echo "<td>" . $row['pre_requisite'] . "<br></td>";
														}
														echo "</tr>";
											
											
														echo "</table>";
														
														echo "<table>";
														echo "<tr>";
														echo "<th>Course Info:</th>";
														echo "</tr>";
											
														echo '<tr>';
														echo "<td>" . $row['course_info'] . "<br></td>";
														echo "</tr>";
														echo "</table>";
													
											}
	
										}
							?>
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
