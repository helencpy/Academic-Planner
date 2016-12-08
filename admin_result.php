<?php
	include("check.php");
	mysqli_query($db, "DELETE FROM `temp` WHERE username like '$login_user'");
	unset($semester);
	unset($session);
	
	
		if(isset($_POST['button_upload'])){
		
			if(!isset($_GET['session_upload'])||$_POST['semester_upload']=="null"){
				echo '<script type="text/javascript">';
				echo 'setTimeout(function (){swal({html:true,title: "Opps!", text:"Please select session and semester.",type: "warning"}, function(){window.location = "admin_result.php";})}, 100);';
				echo '</script>';
			}
			else{
		
				$s_u=$_GET['session_upload'];
				$sem=$_POST['semester_upload'];
				$c_c=$_POST['course_upload'];
				$file = $_FILES['file']['tmp_name'];
				
				if($file!=null){
				
					$handle = fopen($file, "r");
					$c = 0;
					while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
					{
						if($c!=0){
							$student_id = $filesop[0];
							$grade = $filesop[1];
							$session =$s_u;
							$semester=$sem;
							$course_code=$c_c;
							

							$sql = mysqli_query($db,"INSERT INTO results (student_id,course_code, grade,session,semester) 
							VALUES ('$student_id','$course_code','$grade','$session','$semester')");
						}
						$c = $c + 1;
					}

					if($sql){
						
						echo '<script type="text/javascript">';
						echo 'setTimeout(function (){swal({html:true,title: "Success!", text:"You database has imported successfully. You have inserted the records",type: "success"}, function(){window.location = "admin_result.php";})}, 50);';
						echo '</script>';
					
					}else{
					
					echo '<script type="text/javascript">';
						echo 'setTimeout(function (){swal({html:true,title: "Sorry!", text:"There is some problem.",type: "warning"}, function(){window.location = "admin_result.php";})}, 50);';
						echo '</script>';
					
					} 
				}
				else{
					echo '<script type="text/javascript">';
						echo 'setTimeout(function (){swal({html:true,title: "Opps!", text:"Please upload a file.",type: "warning"}, function(){window.location = "admin_result.php";})}, 50);';
						echo '</script>';
				}
			}

	}

if(isset($_POST['button_delete'])) {
	
	//$errors = array_filter($checkbox);
	if(!empty($_POST["checkbox"])){
	 $checkbox=$_POST["checkbox"];
	}else{
		$checkbox=null;
	}
	//echo $checkbox;
	if(count($checkbox) <1){
			echo '<script type="text/javascript">';
			echo 'setTimeout(function (){swal({html:true,title: "Opps!", text:"Please select a record of results.",type: "warning"}, function(){window.location = "admin_result.php";})}, 50);';
			echo '</script>';
		}
		else{
?>
	<script type="text/javascript">
	
			setTimeout(function (){swal({
			title: "Delete these record?", 
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
					
					var del_id=<?php echo json_encode($checkbox); ?>;
					
					$.ajax({
							url: "delete.php",
							type: "POST",
							data: {result_id1:del_id}
							});
						
					setTimeout(function (){swal({title: "Success!", text:"Record deleted.", type: "success"}, function(){window.location = "admin_result.php";})}, 100);
				}})}, 100);
		</script>
	
<?php	
}}
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
		setTimeout(function (){swal({html:true,title: "Opps!", text:"Please select course.",type: "warning"}, function(){window.location = "admin_result.php";})}, 100);
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
		window.location.href = "admin_result.php?session_selected="+session_value+"&major_selected="+major_value;
	}
	else {
		window.location.href = "admin_result.php?session_selected="+session_value;
	}
   }
   
   function sessionselect2(sessi,second) {
	   var session_value = sessi.options[sessi.selectedIndex].value;
	   //var second_value = second.options[second.selectedIndex].value;
	   //var second = <?php echo(json_encode(isset($_GET["major_selected"]))); ?>;
	   var s=second;
	
		window.location.href = "admin_result.php?session_delete="+session_value;
	}
	
	function sessionselect3(sessi,second) {
	   var session_value = sessi.options[sessi.selectedIndex].value;	  
		window.location.href = "admin_result.php?session_upload="+session_value;
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
							<li><a href="admin_course.php"><i class="fa fa-book fa-lg" aria-hidden="true"></i>&nbsp&nbsp&nbsp Courses</a></li>
                            <li><a class="menu-top-active" href="admin_result.php"><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i>&nbsp&nbsp&nbsp Result</a></li>
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
                    <h4 class="page-head-line"><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i>&nbsp&nbsp&nbsp Student Academic Result</h4>

                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                      <div class="Compose-Message">               
                <div class="panel panel-info">
                    <div class="panel-heading">
                        Check Result
                    </div>
                    <div class="panel-body">
					 <form method="post">
					 <label>Session : </label><br>
									<?php
			
										echo '<select class="selectpicker" name="session" data-live-search="true" data-size="10" data-width="25%" onchange="javascript:sessionselect(this,0)">';
									
										if(isset($_GET["session_selected"]))
									{
										$sess = $_GET['session_selected'];
										$session_result = mysqli_query($db, "SELECT * FROM t_session");
										echo '<option data-hidden="true" value=$sess>'.$sess.'</option>';
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
						
						<label>Semester: </label><br>
						<select class="selectpicker" name="semester"><br>
						
						<?php
							if (isset($_POST['semester'])){
								$sm=$_POST['semester'];
								echo '<option data-hidden="true" value="'.$sm.'">'.$sm.'</option>	';
							}
						?>
							<option data-hidden="true" value="null">Select semester</option>							
								<option value="1" >1</option>
								<option value="2" >2</option>
								<option value="3" >3</option>
						</select><br><br>
						
						                        <label>Course : </label><br>
                        <select class="selectpicker" name="course" data-live-search="true" data-size="10" data-width="50%">
									<?php
									
									if(isset($_POST['search_result']))
											{
												$course_code = mysqli_real_escape_string($db, $_POST['course']);
												$sessi = $_GET['session_selected'];	
												if($course_code=="null"||$course_code==null){
													echo '<option data-hidden="true" value="null">Select course.</option>';
												}
												else{
													$sql="SELECT * FROM courses where course_code like '$course_code' AND session like '$sessi'";
													$result = mysqli_query($db,$sql);
													$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
													
													$courseName=$row['course_name'];												
													echo "<option  data-hidden='true' value=".$course_code.">".$course_code."\t\t". $courseName."</option>";
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
					
					<button class="btn btn-info" type="submit" name="search_result"><span class="glyphicon glyphicon-search"></span> Search </button><br><br>
					</form>
					<form method="post">
					<?php
					if(isset($_POST['search_result'])){
						
						
						if($_POST['session']!="null" && isset($_GET["session_selected"])){
							$session1=$_GET["session_selected"];
							$course1=$_POST['course'];
							$semester1=$_POST['semester'];
							
							$a=1;
							
							$ResultQuery="SELECT * FROM `results` 
								join `courses` on `courses`.course_code like`results`.course_code 
								where `results`.session LIKE '$session1' AND `results`.course_code = '$course1' AND `results`.semester='$semester1'";
							$result2 = mysqli_query($db,$ResultQuery);
						
				
					//echo "<h3><b>Session $session1 Semester $semester1</b></h3>";
					echo '<div style="height:300px;overflow:auto;">';
					echo "<table class='table table-striped table-inverse'><thead class='bg-primary'>
								<tr>
								<th></th>
									<th>No</th>
									<th>Student id</th>
									<th>Grade</th>
								</tr> </thead><tbody>";
					
					while($row2 = mysqli_fetch_array($result2)){
					$rslt_id=$row2['result_id'];
							echo "<tr>";
								echo "<td><input type='checkbox' name='checkbox[]'  value='" . $rslt_id . "'></td>";
								echo "<td>" . $a . "</td>";
								echo "<td>" . $row2['student_id'] . "</td>";
								echo "<td>" . $row2['grade'] . "</td>";
								
								// $result_id=$row2['result_id'];
								// echo "<td>
									
									// <button 
													// class='btn btn-default btn-sm' 
													// type='submit'
													// id='delete_result'
													// name='delete_result'
													// value='$result_id'
													// data-toggle='tooltip' title='Delete'><span class='glyphicon glyphicon-trash'></span></button>
									
									// </td>";
									
							echo "</tr>";
							$a++;
						}
							echo "</tbody>";
							echo "</table>";
							echo "</div>";
							
						
						}
						
						else{
							echo '<script type="text/javascript">';
							echo 'setTimeout(function (){swal({html:true,title: "Opps!", text:"Please select course.",type: "warning"}, function(){window.location = "admin_result.php";})}, 100);';
							echo '</script>';
						}
						echo '<hr/>';
						echo '<button class="btn btn-danger" type="submit" name="button_delete"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp&nbsp Delete</button>&nbsp;';
					}
					?>
					
					
					</form>
					
					</div>
					
					
					
                     <!--<div class="panel-footer text-muted">
                        <strong>Note : </strong>Please note that we track all messages so don't send any spams.
                    </div> -->
               
                </div>
						</div>

				</div>
            

			</div>
			
			
			<!--upload result-->
			
				

					 <div class="panel panel-info">
                    <div class="panel-heading">
                        Upload Student Result
                    </div>
                    <div class="panel-body">
                        <form name="import" method="post" enctype="multipart/form-data">
                         <label>Session : </label><br>
									<?php
			
										echo '<select class="selectpicker" name="session_upload" data-live-search="true" data-size="10" data-width="25%" onchange="javascript:sessionselect3(this,0)">';
									
										if(isset($_GET["session_upload"]))
									{
										$sess = $_GET['session_upload'];
										$session_result = mysqli_query($db, "SELECT * FROM t_session");
										echo '<option data-hidden="true" value=$sess>'.$sess.'</option>';
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
						
						<label>Semester: </label><br>
						<select class="selectpicker" name="semester_upload"><br>
							<option data-hidden="true" value="null">Select semester</option>							
								<option value="1" >1</option>
								<option value="2" >2</option>
								<option value="3" >3</option>
						</select><br><br>
						
						<label>Course : </label><br>
                        <select class="selectpicker" name="course_upload" data-live-search="true" data-size="10" data-width="50%">
									<?php
									
									if(isset($_POST['button_upload']))
											{
												/* $course_code = mysqli_real_escape_string($db, $_POST['course']);
												$sessi = $_GET['session_upload'];	
												if($course_code=="null"||$course_code==null){
													echo '<option data-hidden="true" value="null">Select course.</option>';
												}
												else{
													$sql="SELECT * FROM courses where course_code like '$course_code' AND session like '$sessi'";
													$result = mysqli_query($db,$sql);
													$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
													
													$courseName=$row['course_name'];												
													echo "<option  data-hidden='true' value=".$course_code.">".$course_code."\t\t". $courseName."</option>";
												} */
										}
									else{
									echo '<option data-hidden="true" value="null">Select course.</option>';
									}
									
									
									if(isset($_GET["session_upload"]))
									{
										$sessi = $_GET['session_upload'];	
										
											$result = mysqli_query($db, "SELECT * FROM courses WHERE session like '$sess'");
										
										while($getCourseArray = mysqli_fetch_array($result))
										{
											echo "<option value={$getCourseArray['course_code']}>{$getCourseArray['course_code']}\t\t{$getCourseArray['course_name']}</option>";
										}
									}
									?>
						</select><br><br>

						<label class="control-label">Select File</label>
						<input name="file" type="file" class="file file-loading"  data-show-upload="false" data-allowed-file-extensions='["csv"]'/>
						
						
						<a href='result_template.csv' target="_blank">Download file template</a>
						
						 <hr />

						<button class="btn btn-warning" type="submit" name="button_upload"><i class="fa fa-upload" aria-hidden="true"></i>&nbsp&nbsp Upload Excel File</button>&nbsp;

						</form>

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
