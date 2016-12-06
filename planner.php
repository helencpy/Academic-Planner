<?php
	include("check.php");
	//mysqli_query($db, "DELETE FROM `temp` WHERE username like '$login_user'");
	unset($semester);
	unset($session);
	
		if(isset($_POST['button_add']))
{
	$course = mysqli_real_escape_string($db, $_POST['course']);
	$grade_point = mysqli_real_escape_string($db, $_POST['grade']);

	 $_SESSION['course'] = $course;
	if($course== "null"||$grade_point=="null") {
		if($course== "null"){
			echo '<script type="text/javascript">';
			echo 'setTimeout(function (){swal({html:true,title: "Opps!", text:"Please select a course",type: "warning"}, function(){window.location = "planner.php?session_selected='.$_GET[session_selected].'";})}, 100);';
			echo '</script>';
			
		}
		else{ 			
			echo '<script type="text/javascript">';
			echo 'setTimeout(function (){swal({html:true,title: "Opps!", text:"Please select a grade",type: "warning"}, function(){window.location = "planner.php?session_selected='.$_GET[session_selected].'";})}, 100);';
			echo '</script>';
		}
		
	}
	else{
		
		$sql="SELECT * FROM `temp` where username like '$login_user' and course_code like '$course'";
		$result = mysqli_query($db,$sql);
		if (mysqli_num_rows($result)){
			
			echo '<script type="text/javascript">';
			echo 'setTimeout(function (){swal({html:true,title: "Opps!", text:"Course already been added.",type: "warning"}, function(){window.location = "planner.php?session_selected='.$_GET[session_selected].'";})}, 100);';
			echo '</script>';
		}
		
		else{
			if($grade_point==4){
		mysqli_query($db, "INSERT INTO temp (username, course_code,grade,grade_point) VALUES ('$login_user','$course','A+/A','$grade_point')");
			}
			else if($grade_point==3.7){
		mysqli_query($db, "INSERT INTO temp (username, course_code,grade,grade_point) VALUES ('$login_user','$course','A-','$grade_point')");
			}
			else if($grade_point==3.3){
		mysqli_query($db, "INSERT INTO temp (username, course_code,grade,grade_point) VALUES ('$login_user','$course','B+','$grade_point')");
			}
			else if($grade_point==3.0){
		mysqli_query($db, "INSERT INTO temp (username, course_code,grade,grade_point) VALUES ('$login_user','$course','B','$grade_point')");
			}
			else if($grade_point==2.7){
		mysqli_query($db, "INSERT INTO temp (username, course_code,grade,grade_point) VALUES ('$login_user','$course','B-','$grade_point')");
			}
			else if($grade_point==2.3){
		mysqli_query($db, "INSERT INTO temp (username, course_code,grade,grade_point) VALUES ('$login_user','$course','C+','$grade_point')");
			}
			else if($grade_point==2.0){
		mysqli_query($db, "INSERT INTO temp (username, course_code,grade,grade_point) VALUES ('$login_user','$course','C','$grade_point')");
			}
			else if($grade_point==1.7){
		mysqli_query($db, "INSERT INTO temp (username, course_code,grade,grade_point) VALUES ('$login_user','$course','C-','$grade_point')");
			}
			else if($grade_point==1.3){
		mysqli_query($db, "INSERT INTO temp (username, course_code,grade,grade_point) VALUES ('$login_user','$course','D+','$grade_point')");
			}
			else if($grade_point==1.0){
		mysqli_query($db, "INSERT INTO temp (username, course_code,grade,grade_point) VALUES ('$login_user','$course','D','$grade_point')");
			}
			else if($grade_point==0){
		mysqli_query($db, "INSERT INTO temp (username, course_code,grade,grade_point) VALUES ('$login_user','$course','F','$grade_point')");
			}
		echo '<script type="text/javascript">';
			echo 'setTimeout(function (){swal({html:true,title: "Good Job!", text:"Course added.",type: "success"}, function(){window.location = "planner.php?session_selected='.$_GET[session_selected].'";})}, 100);';
			echo '</script>';
		
		}
	}
}
	
if(isset($_POST['button_activate'])) {
	
	?>
		<script type="text/javascript">
			setTimeout(function (){swal({
			title: "Delete this course?", 
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes, delete it!",
			cancelButtonText: "No, cancel please!",
			closeOnConfirm: false,
			closeOnCancel: false}, 
			function(isConfirm)
			{
				if(!isConfirm)
				{
					swal("Cancelled", "The course is not deleted.", "error");
				}
				else
				{
					<?php $course_code = mysqli_real_escape_string($db, $_POST['button_activate']); ?>
					var course_code=<?php echo json_encode($course_code); ?>;
					
					$.ajax({
							url: "delete.php",
							type: "POST",
							data: {CourseCode:course_code}
							});
						
					setTimeout(function (){swal({title: "Success!", text:"Course deleted.", type: "success"}, function(){window.location = "planner.php";})}, 100);
				}})}, 100);
		</script>
	<?php
}
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
});

$(window).scroll(function() {
  sessionStorage.scrollTop = $(this).scrollTop();
});

   
   function sessionselect(sessi,second) {
	   var session_value = sessi.options[sessi.selectedIndex].value;

		window.location.href = "planner.php?session_selected="+session_value;
	
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
                            <li><a class="menu-top-active" href="planner.php"><i class="fa fa-calculator fa-lg" aria-hidden="true"></i>&nbsp&nbsp&nbsp Planner</a></li>
                            <li><a href="recommendation.php"><i class="fa fa-thumbs-up fa-lg" aria-hidden="true"></i>&nbsp&nbsp&nbsp Recommendation</a></li>
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
                        CGPA Calculator
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
										echo '<option data-hidden="true" value="null">Select Batch.</option>';
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
						<select class="selectpicker" name="grade" data-width="auto">";
									<option data-hidden="true" value="null">Choose your grade.</option>
									<option value="4">A+/A</option>
									<option value="3.7">A-</option>
									<option value="3.3">B+</option>
									<option value="3.0">B</option>
									<option value="2.7">B-</option>
									<option value="2.3">C+</option>
									<option value="2.0">C</option>
									<option value="1.7">C-</option>
									<option value="1.3">D+</option>
									<option value="1.0">D</option>
									<option value="0">F</option>
									</select>
                        <button class="btn btn-success" type="submit" name="button_add"><span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp Add </button>&nbsp;
						<hr />
								<div class="showTable" <?php 
								$sql="SELECT * FROM `temp` join `courses` on `courses`.course_code like`temp`.course_code where `temp`.username like '$login_user' ";
								$result = mysqli_query($db,$sql);
								if (mysqli_num_rows($result) <1){ 
									echo 'style="display:none;"'; 
								} 
								?>>
								<table class='table table-striped table-inverse'>
									<tr>
									<th>Course Code</th>
									<th>Course Name</th>
									<th>Credit</th>
									<th>Grade</th>
									<th>Grade Point</th>
									<th>Delete</th>
									</tr>
									<?php 
									$sql="SELECT * FROM `temp` join `courses` on `courses`.course_code like`temp`.course_code where `temp`.username like '$login_user' ";
									$result = mysqli_query($db,$sql);
									$total_credit=0;
									$total_gp=0;
									
									if (mysqli_num_rows($result) > 0){									
										
									while($row = mysqli_fetch_array($result)){
									$gp=$row['credit']*$row['grade_point'];
									echo "<tr>";								
									echo "<td>" . $row['course_code'] . "</td>";
									echo "<td>" . $row['course_name'] . "</td>";
									echo "<td>" . $row['credit'] . "</td>";
									echo "<td>".$row['grade']."</td>";
									echo "<td>".$gp."</td>";
									//echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete " .$row['course_name']. " ?');\" 
									//		href='delete.php?q=".$row['course_code']."'>Delete</a></td><tr>";
									
									$course_code=$row['course_code'];
									echo "<td>
									
									<button 
													class='btn btn-default btn-sm' 
													type='submit'
													id='button_activate'
													name='button_activate' 
													value='$course_code'><span class='glyphicon glyphicon-remove'></span></button>
									
									</td>";
									
									
									
									echo "</tr>";
									$total_credit+=$row['credit'];
									$total_gp+=$gp;
									
									}
									
									}else{										
										
									echo "<td colspan=\"6\">No courses has been added.</td>";
									
									}
									?>
								</table>
								<b>Total Credit: <?php echo $total_credit?></b>
								
								</div>
								
								
																<?php
						if(isset($_POST['next']))
						{ 														
							$checkTemp="SELECT * FROM `temp` join `courses` on `courses`.course_code like`temp`.course_code where `temp`.username like '$login_user' ";
							$tempResult = mysqli_query($db,$checkTemp);
							
							if(mysqli_fetch_array($tempResult)<1)
							{
								echo '<script type="text/javascript">';
								echo 'setTimeout(function (){swal({html:true,title: "Opps!", text:"Please add a course.",type: "warning"}, function(){window.location = "planner.php";})}, 100);';
								echo '</script>';
							}
							else{
							$gpa=($total_gp/$total_credit);
							
							$sql2="Select * from `$student_id` join `courses` on `courses`.course_code like`$student_id`.course_code where `$student_id`.course_status='1'";
							$result2 = mysqli_query($db,$sql2);
							$total_credit2=0;
							$total_gp2=0;
							while($row2 = mysqli_fetch_array($result2)){
								$total_credit2+=$row2['credit'];
								$total_gp2+=$row2['grade_point'];
								}
							
							$a=($total_credit+$total_credit2);
							$b=($total_gp+$total_gp2);
							$cgpa=($b/$a);
							
							echo '<script type="text/javascript">';
							echo 'setTimeout(function (){swal({html:true,title: "GPA & CGPA", text:" ';
								
								
								echo "GPA	";
								printf (":%.2f ",$gpa);
								echo "&nbsp;&nbsp;&nbsp;&nbsp;";

								echo "CGPA";
								printf (":%.2f ",$cgpa);
									
										echo '"}, function(){window.location = "planner.php";})}, 100);';
								echo '</script>';
							
							
							}
		
						}
						
						?>
						<hr />
						<button class="btn btn-warning" type="submit" name="next"><i class="fa fa-calculator" aria-hidden="true"></i>&nbsp&nbspCalculate</button>
					
						
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
