<?php
	include("check.php");
	mysqli_query($db, "DELETE FROM `temp` WHERE username like '$login_user'");
	unset($semester);
	unset($session);
	
	if(isset($_POST['button_upload'])){
		
			if($_POST['session_upload']=="null"){
				echo '<script type="text/javascript">';
				echo 'setTimeout(function (){swal({html:true,title: "Opps!", text:"Please select session.",type: "warning"}, function(){window.location = "admin_course.php";})}, 100);';
				echo '</script>';
			}
			else{
		
				$s_u=$_POST['session_upload'];
				$file = $_FILES['file']['tmp_name'];
				
				if($file!=null){
				
					$handle = fopen($file, "r");
					$c = 0;
					while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
					{
						if($c!=0){
							$course_code = $filesop[0];
							$course_name = $filesop[1];
							$semester_available = $filesop[2];
							$pre_requisite = $filesop[3];
							$credit = $filesop[4];
							$course_info = $filesop[5];
							$session =$s_u;

							$sql = mysqli_query($db,"INSERT INTO courses (course_code, course_name,semester_available,pre_requisite,credit,course_info,session) 
							VALUES ('$course_code','$course_name','$semester_available','$pre_requisite','$credit','$course_info','$session')");
						}
						$c = $c + 1;
					}

					if($sql){
						
						echo '<script type="text/javascript">';
						echo 'setTimeout(function (){swal({html:true,title: "Success!", text:"You database has imported successfully. You have inserted the records",type: "success"}, function(){window.location = "admin_course.php";})}, 50);';
						echo '</script>';
					
					}else{
					
					echo '<script type="text/javascript">';
						echo 'setTimeout(function (){swal({html:true,title: "Sorry!", text:"There is some problem.",type: "warning"}, function(){window.location = "admin_course.php";})}, 50);';
						echo '</script>';
					
					} 
				}
				else{
					echo '<script type="text/javascript">';
						echo 'setTimeout(function (){swal({html:true,title: "Opps!", text:"Please upload a file.",type: "warning"}, function(){window.location = "admin_course.php";})}, 50);';
						echo '</script>';
				}
			}

	}	
	if(isset($_POST['button_edit'])){
		if($_POST['course']=="null"){
			echo '<script type="text/javascript">';
			echo 'setTimeout(function (){swal({html:true,title: "Opps!", text:"Please select a course.",type: "warning"}, function(){window.location = "admin_course.php";})}, 50);';
			echo '</script>';
		}
		else{
		$_SESSION['session1']=$_GET["session_selected"];
		$_SESSION['course1']=$_POST['course'];
		
		header("Location:edit_course.php");
		}
		
	}
	if(isset($_POST['button_add'])){
			
		header("Location:add_course.php");
		
	}
	
	if(isset($_POST['session_add'])){
			
		header("Location:add_session.php");
		
	}
	
	if(isset($_POST['button_delete'])){
		if($_POST['course']=="null"){
			echo '<script type="text/javascript">';
			echo 'setTimeout(function (){swal({html:true,title: "Opps!", text:"Please select a course.",type: "warning"}, function(){window.location = "admin_course.php";})}, 50);';
			echo '</script>';
		}
		else{
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
					swal("Cancelled", "Delete action has been cancelled.", "error");
				}
				else
				{
					
					<?php $course_code = mysqli_real_escape_string($db, $_POST['course']); ?>
					var course_code=<?php echo json_encode($course_code); ?>;
					<?php $session = mysqli_real_escape_string($db, $_GET["session_selected"]); ?>
					var session=<?php echo json_encode($session); ?>;
					
					$.ajax({
							url: "delete.php",
							type: "POST",
							data: {courses:course_code, session:session}
							});
						
					setTimeout(function (){swal({title: "Success!", text:"Course deleted.", type: "success"}, function(){window.location = "admin_course.php";})}, 100);
				}})}, 100);
		</script>
	
<?php	
	}
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
	
	<link href="bootstrap-fileinput/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
    <script src="bootstrap-fileinput/js/fileinput.js" type="text/javascript"></script>
    <script src="bootstrap-fileinput/js/fileinput_locale_fr.js" type="text/javascript"></script>
     <script src="bootstrap-fileinput/js/fileinput_locale_es.js" type="text/javascript"></script>

	
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
		setTimeout(function (){swal({html:true,title: "Opps!", text:"Please select course.",type: "warning"}, function(){window.location = "admin_course.php";})}, 100);
	<?php } else{			?>	
		$('#myModal').modal('show');
	<?php }} ?>
});

$(window).scroll(function() {
  sessionStorage.scrollTop = $(this).scrollTop();
});

function majorselect(maj,second) {
      var major_value = maj.options[maj.selectedIndex].value;
	  //var second_value = second.options[second.selectedIndex].value;
	  //var second = <?php echo(json_encode(isset($_GET["session_selected"]))); ?>;
	  var s=second;
	 var num2=1;
	if(s==num2) {
		var session_value = 
		<?php 
		if(isset($_GET["session_selected"])){
		echo(json_encode($_GET["session_selected"])); 
		}
		else{
			echo "none";
		}
		?>;
		window.location.href = "admin_course.php?session_selected="+session_value+"&major_selected="+major_value;
	}
	else {
		window.location.href = "admin_course.php?major_selected="+major_value;
	}
   }
   
   function sessionselect(sessi,second) {
	   var session_value = sessi.options[sessi.selectedIndex].value;
	   //var second_value = second.options[second.selectedIndex].value;
	   //var second = <?php echo(json_encode(isset($_GET["major_selected"]))); ?>;
	   var s=second;
	 var num2=1;
		if(s==num2) {
		var major_value = 
		<?php 
		if(isset($_GET["major_selected"])){
		echo(json_encode($_GET["major_selected"])); 
		}
		else{
			echo "none";
		}
		?>;
		window.location.href = "admin_course.php?session_selected="+session_value+"&major_selected="+major_value;
	}
	else {
		window.location.href = "admin_course.php?session_selected="+session_value;
	}
   }
   
   function sessionselect2(sessi,second) {
	   var session_value = sessi.options[sessi.selectedIndex].value;
	   //var second_value = second.options[second.selectedIndex].value;
	   //var second = <?php echo(json_encode(isset($_GET["major_selected"]))); ?>;
	   var s=second;
	
		window.location.href = "admin_course.php?session_delete="+session_value;
	}


   
   $('#pdffile').change(function(){
     $('#subfile').val($(this).val());
});
   
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
                <a class="navbar-brand" href="">
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
							<li><a href="admin_home.php"><i class="fa fa-home fa-lg" aria-hidden="true"></i>&nbsp&nbsp&nbsp Home</a></li>
							<li><a class="menu-top-active" href="admin_course.php"><i class="fa fa-book fa-lg" aria-hidden="true"></i>&nbsp&nbsp&nbsp Courses</a></li>
                            <li><a href="admin_result.php"><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i>&nbsp&nbsp&nbsp Result</a></li>
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
                    <h4 class="page-head-line"><i class="fa fa-book fa-lg" aria-hidden="true"></i>&nbsp&nbsp&nbsp Courses</h4>

                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                      <div class="Compose-Message">               
                <div class="panel panel-info">
                    <div class="panel-heading">
                        Course Information
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
										echo '<option data-hidden="true" value=$sess>Batch '.$sess.'</option>';
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
						</select>
						
						<button class="btn btn-primary" type="submit" name="session_add"><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp&nbsp Manage Session</button>&nbsp;
						
						<br><br>
                      <!--  <label>Major :  </label><br>
								//  	<?php
									// if(isset($_GET["session_selected"])){
										// echo '<select class="selectpicker" name="major" data-live-search="true" data-size="10" data-width="50%" onchange="javascript:majorselect(this,1)">';
									// }
									// else{
										// echo '<select class="selectpicker" name="major" data-live-search="true" data-size="10" data-width="50%" onchange="javascript:majorselect(this,0)">';
									// }
									
									// if(isset($_GET["major_selected"]))
									// {
										// $majorSelected = $_GET['major_selected'];
										// $get_majorSelected = mysqli_query($db,"SELECT * FROM t_major WHERE `major_id`=$majorSelected");
										// $row=mysqli_fetch_array($get_majorSelected,MYSQLI_ASSOC);
										
										// $major_result = mysqli_query($db, "SELECT * FROM t_major");
										// echo '<option data-hidden="true" value=$majorSelected> '.$row[major].'</option>';
										// while($getMajorArray = mysqli_fetch_array($major_result))
										// {
											// echo "<option value={$getMajorArray['major_id']}>{$getMajorArray['major']}</option>";
										// }
									// }
									// else{
										// $major_result = mysqli_query($db, "SELECT * FROM t_major");
										// echo '<option data-hidden="true" value="null">Select major.</option>';
										// while($getMajorArray = mysqli_fetch_array($major_result))
										// {
											// echo "<option value={$getMajorArray['major_id']}>{$getMajorArray['major']}</option>";
										// }
									// }
									// ?> 
						</select><br><br> -->
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
													echo "<option data-hidden='true' value=".$course_code.">".$course_code."\t\t". $courseName."</option>";
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
						</select><br>
                        <hr />
                        <button class="btn btn-info" type="submit" name="button_find"><span class="glyphicon glyphicon-search"></span> Search </button>&nbsp;
						<button class="btn btn-success" type="submit" name="button_edit"><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp&nbsp Edit</button>&nbsp;
						<button class="btn btn-danger" type="submit" name="button_delete"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp&nbsp Delete</button>&nbsp;
						<button class="btn btn-warning" type="submit" name="button_add"><span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp Add</button>&nbsp;
						
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
														
														echo "<tr>";
														echo "<th>Elective:</th>";
														
														$resultElective = mysqli_query($db, "SELECT * FROM `t_elective` join `t_major` on
															`t_major`.major_id = `t_elective`.major_id
															WHERE `t_elective`.course_code like '$course_code'");
															$getElectiveResult=mysqli_fetch_array($resultElective,MYSQLI_ASSOC);
															
															if($getElectiveResult==0){
																echo "<td>No<br></td>";
															}
															else{
																	echo "<td>" . $getElectiveResult['major'] . "<br></td>";
															}
														echo "</tr>";
														
														echo "<tr>";
														echo "<th>Category:</th>";
														
														if ($row['category']==0){
															echo '<td>Unknown<br></td>';
														}
														else{
															$category_id=$row['category'];
															$resultCategory = mysqli_query($db, "SELECT * FROM `t_elective_ctg` WHERE id = '$category_id'");
															$getCategoryResult=mysqli_fetch_array($resultCategory,MYSQLI_ASSOC);
															
															
															echo '<td>'.$getCategoryResult['category'].'<br></td>';
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
					</div>
					<div class="row">

					 <div class="col-md-12">

					 <div class="panel panel-info">
                    <div class="panel-heading">
                        Upload List of Courses
                    </div>
                    <div class="panel-body">
                        <form name="import" method="post" enctype="multipart/form-data">
                        <label>Batch : </label><br>
									<?php
			
										echo '<select class="selectpicker" name="session_upload" data-live-search="true" data-size="10" data-width="25%">';
									
										$session_result = mysqli_query($db, "SELECT * FROM t_session");
										echo '<option data-hidden="true" value="null">Select batch.</option>';
										while($getSessionArray = mysqli_fetch_array($session_result))
										{
											echo "<option value={$getSessionArray['session']}>{$getSessionArray['session']}</option>";
										}
									
									?>
						</select><br><br>
						

						<label class="control-label">Select File</label>
						<input name="file" type="file" class="file file-loading"  data-show-upload="false" data-allowed-file-extensions='["csv"]'/>
						
						
						<a href='course_template.csv' target="_blank">Download file template</a>
						
						 <hr />

						<button class="btn btn-warning" type="submit" name="button_upload"><i class="fa fa-upload" aria-hidden="true"></i>&nbsp&nbsp Upload Excel File</button>&nbsp;

						</form>

                    </div>
				</div>
				</div>	
				

				<!--	 <div class="col-md-6">

					                <div class="panel panel-info">
                    <div class="panel-heading">
                        Delete Multiple of Courses
                    </div>
                    <div class="panel-body">
                        <form name="import" method="post" enctype="multipart/form-data">
                        <label>Session : </label><br>
									<?php
			
										echo '<select class="selectpicker" name="session_delete" data-live-search="true" data-size="10" data-width="50%" onchange="javascript:sessionselect2(this,0)">';
									if(isset($_GET["session_delete"]))
									{
										$sess = $_GET['session_delete'];
										$session_result = mysqli_query($db, "SELECT * FROM t_session");
										echo '<option data-hidden="true" value=$sess>Session '.$sess.'</option>';
										while($getSessionArray = mysqli_fetch_array($session_result))
										{
											echo "<option value={$getSessionArray['session']}>{$getSessionArray['session']}</option>";
										}
									}
									else{
										$session_result = mysqli_query($db, "SELECT * FROM t_session");
										echo '<option data-hidden="true" value="null">Select session.</option>';
										while($getSessionArray = mysqli_fetch_array($session_result))
										{
											echo "<option value={$getSessionArray['session']}>{$getSessionArray['session']}</option>";
										}
									}
									
									?>
						</select><br><br>
						
						<label>Course : </label><br>
                        <select class="selectpicker" name="course_delete" data-live-search="true" data-size="10" data-width="50%" multiple>
									<?php
									
								
									echo '<option data-hidden="true" value="null">Select course.</option>';
						
																		
									if(isset($_GET["session_delete"]))
									{
										$sessi = $_GET['session_delete'];	
										
											$result = mysqli_query($db, "SELECT * FROM courses WHERE session like '$sessi'");
										
										while($getCourseArray = mysqli_fetch_array($result))
										{
											echo "<option value={$getCourseArray['course_code']}>{$getCourseArray['course_code']}\t\t{$getCourseArray['course_name']}</option>";
										}
									}
									?>
						</select><br>
						
						 <hr />

						<button class="btn btn-warning" type="submit" name="button_upload"><i class="fa fa-upload" aria-hidden="true"></i>&nbsp&nbsp Upload Excel File</button>&nbsp;

						</form>

                    </div>
				</div>
				</div>	-->
				</div>	
					
					
					
                     <!--<div class="panel-footer text-muted">
                        <strong>Note : </strong>Please note that we track all messages so don't send any spams.
                    </div> -->
               
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
