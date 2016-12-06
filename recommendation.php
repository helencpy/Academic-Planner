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
	  var current_cgpa=document.getElementsByName('current_cgpa')[0].value;
	   var elective_ctg=document.getElementsByName('elective_ctg')[0].value;
	  
		window.location.href = "recommendation.php?major_selected="+mjr_value+"&cgpa_input="+current_cgpa+"&interest_input="+elective_ctg;
		//window.location.href = "recommendation.php?major_selected="+mjr_value;
	
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
                            <li><a href="planner.php"><i class="fa fa-calculator fa-lg" aria-hidden="true"></i>&nbsp&nbsp&nbsp Planner</a></li>
                            <li><a class="menu-top-active" href="recommendation.php"><i class="fa fa-thumbs-up fa-lg" aria-hidden="true"></i>&nbsp&nbsp&nbsp Recommendation</a></li>
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
                    <h4 class="page-head-line"><i class="fa fa-thumbs-up fa-lg" aria-hidden="true"></i>&nbsp&nbsp&nbsp Recommendation</h4>

                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                      <div class="Compose-Message">               
                <div class="panel panel-info">
                    <div class="panel-heading">
                        Recommendation of Elective Courses
                    </div>
                    <div class="panel-body">

						<div class="alert alert-info">
                            Recommendation of elective courses is based on the following factors:<br>
							1. Current CGPA<br>
							2. Interest<br>
							3. Predicted Grade<br>
							4. Average Previous GPA of the Elective Course<br>
							
						</div>

						
					<form  action="runr.php" method="get">
					
					<div class="col-lg-2">
						<label><p>Current CGPA:<br></p></label>
							
							<?php
							if (isset($_GET["cgpa_input"])){
								$cgpa_input=$_GET["cgpa_input"];
								echo "<input class='form-control' type='number' step=0.01 value=$cgpa_input min='0.01' max='4' name='current_cgpa'>";
							}
							else{
								echo "<input class='form-control' type='number' step=0.01 value=$cgpa min='0.01' max='4' name='current_cgpa'>";
							}
							?>
					</div>
						
					<div class="clearfix"></div><br>
					
					<div class="col-lg-4">
						<label><p>Interest:<br></p></label>
							<div class="clearfix"></div>
							<select class="selectpicker" name="elective_ctg" data-size="10" data-width="100%" >
							
							<?php
								if (isset($_GET["interest_input"])){
									$interest_input=$_GET["interest_input"];
								
									if($interest_input=="null"){
										echo '<option data-hidden="true" value="null">Choose your interest.</option>';
									}
									else{
										$interest_slct_sql = mysqli_query($db, "SELECT * FROM t_elective_ctg
													WHERE id = '$interest_input'");
													$getInterestResult=mysqli_fetch_array($interest_slct_sql,MYSQLI_ASSOC);
										
											echo '<option data-hidden="true" value="'.$interest_input.'">'.$getInterestResult[category].'</option>';
									}
									}
								else{
									
									echo '<option data-hidden="true" value="null">Choose your interest.</option>';
								}

								$result = mysqli_query($db, "SELECT * FROM t_elective_ctg");

										while($getCategoryElective = mysqli_fetch_array($result))
										{
											echo "<option value={$getCategoryElective['id']}>{$getCategoryElective['category']}</option>";
										}
								?>
							</select>	
							
						</div>
					<div class="clearfix"></div>
					
					<br>
					<div class="col-lg-10">
						<label><p>Grade of Courses:<br></p></label>
						(To predict the grade of elective course)
					<?php
					$sql="SELECT * FROM `results` join `courses` on `courses`.course_code like`results`.course_code where `results`.student_id like '$student_id' order by `results`.session";
					$result = mysqli_query($db,$sql);
					$row = mysqli_fetch_array($result);
					echo '<div style="height:300px;overflow:auto;">';
					echo "<table class='table table-bordered table-striped table-hover'>
					<thead>
					<tr>
					<th>Course Code</th>
					<th>Course Name</th>
					<th>Grade</th>
					</tr>
					</thead>";
					$c_c=$row['course_code'];
					echo "<tbody>";
					echo "<tr>";
						echo "<td>" . $row['course_code'] . "</td>";
						echo "<td>" . $row['course_name'] . "</td>";
						 echo "<td><select class='selectpicker' name=$c_c data-width='auto'>
									<option data-hidden='true' value=". $row['grade'] .">". $row['grade'] ."</option>
									<option value='4'>A+/A</option>
									<option value='3.7'>A-</option>
									<option value='3.3'>B+</option>
									<option value='3.0'>B</option>
									<option value='2.7'>B-</option>
									<option value='2.3'>C+</option>
									<option value='2.0'>C</option>
									<option value='1.7'>C-</option>
									<option value='1.3'>D+</option>
									<option value='1.0'>D</option>
									<option value='0'>F</option>
									</Select>
									</td>"; 
						//echo "<td>".$row['grade']."</td>";
						echo "</tr>";
						
						
						
					while($row = mysqli_fetch_array($result)) {
					$c_c=$row['course_code'];
					echo "<tr>";
						echo "<td>" . $row['course_code'] . "</td>";
						echo "<td>" . $row['course_name'] . "</td>";
						
						$user_grade=$row['grade'];
						$grade_sql = mysqli_query($db, "SELECT * FROM grade_point
											WHERE grade like '$user_grade'");
											$getGradeResult=mysqli_fetch_array($grade_sql,MYSQLI_ASSOC);
						
						 echo "<td><select class='selectpicker' name=$c_c data-width='auto'>						 						 
									<option data-hidden='true' value=". $getGradeResult['pointer'] .">". $user_grade ."</option>
									<option value='4'>A+/A</option>
									<option value='3.7'>A-</option>
									<option value='3.3'>B+</option>
									<option value='3.0'>B</option>
									<option value='2.7'>B-</option>
									<option value='2.3'>C+</option>
									<option value='2.0'>C</option>
									<option value='1.7'>C-</option>
									<option value='1.3'>D+</option>
									<option value='1.0'>D</option>
									<option value='0'>F</option>
									</Select>
									</td>"; 
						//echo "<td>".$row['grade']."</td>";
						echo "</tr>";
					}
					
					echo "</tbody>";
					echo "</table>";
					echo '</div>';
					?>
					</div>
			
					<div class="clearfix"></div>
					<br>
					<div class="col-lg-10">
					<label><p>Average Previous GPA of the 
					
						<select class="selectpicker" name="major" data-size="10" data-live-search="true" data-width="55%" onchange="javascript:majorselect(this)";>	
									<?php
									
									$resultMajor = mysqli_query($db, "SELECT * FROM t_major
									WHERE major_id like '$user_major_id'");
									$getMajorResult=mysqli_fetch_array($resultMajor,MYSQLI_ASSOC);
									

										$major_name=$getMajorResult['major'];
										$major_id=$getMajorResult['major_id'];
										
										if(isset($_GET["major_selected"])){
											$mjr_slct=$_GET["major_selected"];
											$mjr_slct_sql = mysqli_query($db, "SELECT * FROM t_major
											WHERE major_id like '$mjr_slct'");
											$getMjrSlctResult=mysqli_fetch_array($mjr_slct_sql,MYSQLI_ASSOC);
											
											echo '<option data-hidden="true" value="'.$mjr_slct.'">'.$getMjrSlctResult["major"].'</option>';
										}
										else{
										echo '<option data-hidden="true" value="'.$major_id.'">'.$major_name.'</option>';
										}
									
									$result = mysqli_query($db, "SELECT * FROM t_major");									
									while($getMajorArray = mysqli_fetch_array($result))
									{
										echo "<option value={$getMajorArray['major_id']}>{$getMajorArray['major']}</option>";
									}
									?>
						</select>
					
					Elective Course:</p></label>
					
					<?php
					$getElective="SELECT * FROM t_elective join `courses` on `courses`.course_code like`t_elective`.course_code where t_elective.major_id='$major'";
					$electiveResult = mysqli_query($db,$getElective);

					while($row = mysqli_fetch_array($electiveResult)){
					$elec_c_c=$row['course_code'];	
					$getResult="SELECT * FROM results where course_code like '$elec_c_c' and session like '2014/2015'";
					$result = mysqli_query($db,$getResult);
					$sumOfResult=0;
					$j=0;

					while ($resultRow = mysqli_fetch_array($result)){
					 $sumOfResult+=$resultRow['grade_point'];
					 $j++;
					}
					if($sumOfResult!=0){
					$difficulty=$sumOfResult/$j;
					$difficulty=($difficulty/$row['credit']);
					$updateElectiveCourseOfDifficulty=mysqli_query($db,"
													update t_elective 
													set 
													difficulty='$difficulty'
													where course_code='$elec_c_c'");
}					
}
					
					
					if(isset($_GET["major_selected"])){
						$mjr_get=$_GET["major_selected"];
						$getElective="SELECT * FROM t_elective join `courses` on `courses`.course_code like`t_elective`.course_code where t_elective.major_id='$mjr_get'";
					}
					else{
						$getElective="SELECT * FROM t_elective join `courses` on `courses`.course_code like`t_elective`.course_code where t_elective.major_id='$major_id'";
					}
					$session_result = mysqli_query($db,$getElective);
					echo '<div style="height:300px;overflow:auto;">';
					echo '<table class="table table-bordered table-striped table-hover">';
					
					echo "
					<thead>
					<tr>
					<th>Elective Course</th>
					<th>Average Previous GPA</th>
					</tr>
					</thead>";
					
					echo '<tbody>';
			
					while($row = mysqli_fetch_array($session_result)){
					$difficulty=$row['difficulty'];
					
					if ($difficulty>=1){
						$percentage_difficulty=($row['difficulty']/4)*100;
					}
					
					echo '<tr><td>';
					echo $row['course_name'].": ";	
					echo'</td><td>';
					if($difficulty>0){
					echo '<progress class="progress progress-striped" value="'.$difficulty.'" max="4.0"></progress><br>';
					}
					else{
						echo "No related data<br><br>";
					} 
					
					echo '</td></tr>';
					}
					echo '</tbody></table>';
					echo '</div>';
					?>
					</div>
					
					<div class="clearfix"></div>
					<br>
					<div class="col-lg-12">
					
					<div class="alert alert-warning">
                          <label><p>Weightage for each factors of recommendation: </p></label> (Can be adjusted)
                    

				<table>
					<tr>
						<td>
							Current CGPA
						</td>
						<td>
							<input id="w_currentCGPA" name="w_currentCGPA" class="rating rating-loading" data-show-clear="false" data-show-caption="false" data-size="xxs" value="5">
						</td>
					<tr>
						<td>
							Interest
						</td>
						<td>
							<input id="w_interest" name="w_interest" class="rating rating-loading" data-show-clear="false" data-show-caption="false" data-size="xxs" value="5">
						</td>
					</tr>
					<tr>
						<td>
							Predicted Grade Of Elective Courses
						</td>
						<td>
							<input id="w_prediction" name="w_prediction" class="rating rating-loading" data-show-clear="false" data-show-caption="false" data-size="xxs" value="5">
						</td>
					</tr>
					<tr>
						<td>
							Average of Previous GPA of Elective Courses 
						</td>
						<td>
							<input id="w_difficulty" name="w_difficulty" class="rating rating-loading" data-show-clear="false" data-show-caption="false" data-size="xxs" value="5">
						</td>
					</tr>
				</table>
					</div>				
				</div>
					
					<div class="clearfix"></div>
					<br>
					<div class="col-lg-10">
			<button class="btn btn-default " type="submit" name="recommend">Recommend</button><br><br>
				 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title" id="myModalLabel">Elective Courses Recommendation List</h4>
                                        </div>
                                        <div class="modal-body">
                                         <?php
										  if(!empty($_GET)){
					
											$score = $_GET;
											$i=1;
											if(isset($score) ){
												foreach($score as $x => $x_value) {
												// echo $i.". ".$x . ", Value=" . $x_value;
												$x = str_replace("_"," ",$x);
												echo "<div style='text-align:left' color:black><font color='black'>".$i.". ".$x ."</font></br></div>";

												$i=$i+1;
												}
											}
										  }
										?>									  
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
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
