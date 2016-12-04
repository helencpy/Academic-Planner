<?php
	include("check.php");
	mysqli_query($db, "DELETE FROM `temp` WHERE username like '$login_user'");
	unset($semester);
	unset($session);
		
		if(isset($_POST['cancel'])){
			header('location:admin_course.php');
		}
		
		if(isset($_POST['submit']))
		{	
	
			if($_POST['session']=="null"){	
				
				echo '<script type="text/javascript">';
				echo 'setTimeout(function (){swal({html:true,title: "Opps!", text:"Please select session.",type: "warning"}, function(){window.location = "add_course.php";})}, 50);';
				echo '</script>';
			}
			else{
	
					$course_code=$_POST['course_code'];
					$session=$_POST['session'];
					$sql="Select * from courses where course_code like '$course_code' AND session like '$session'";
					$result=mysqli_query($db,$sql);
					if (mysqli_num_rows($result) > 0){
						
						echo '<script type="text/javascript">';
						echo 'setTimeout(function (){swal({html:true,title: "Opps!", text:"Course code already existed.",type: "warning"}, function(){window.location = "add_course.php";})}, 50);';
						echo '</script>';
						
					}
					else{
						
						$course_code=$_POST['course_code'];
						$course_name=$_POST['course_name'];
						$credit=$_POST['credit'];
						$semester_available=$_POST['semester_available'];
						$pre_requisite=$_POST['pre_requisite'];
						$course_info=$_POST['course_info'];
						$session=$_POST['session'];
						$elective=$_POST['elective'];
						$category=$_POST['category'];
						
						if($elective>0){
						
								$sql = mysqli_query($db,"INSERT INTO t_elective (course_code, major_id,category) 
										VALUES ('$course_code','$elective','$category')");
				
						}
						
						$query1=mysqli_query($db,"
						INSERT INTO `courses`( 
						`course_code`, 
						`course_name`, 
						`semester_available`, 
						`pre_requisite`, 
						`credit`, 
						`course_info`,
						`session`,
						`category`) 
						VALUES (
						'$course_code',
						'$course_name',
						'$semester_available',
						'$pre_requisite',
						'$credit',
						'$course_info',
						'$session',
						'$category')");
						
						
						

							echo '<script type="text/javascript">';
							echo 'setTimeout(function (){swal({html:true,title: "Success!", text:"Course added.",type: "success"}, function(){window.location = "admin_course.php";})}, 50);';
							echo '</script>';
						
					}
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
							<li><a href="admin_home.php"><i class="fa fa-home fa-lg" aria-hidden="true"></i>&nbsp&nbsp&nbsp Home</a></li>
							<li><a class="menu-top-active" href="course_info.php"><i class="fa fa-book fa-lg" aria-hidden="true"></i>&nbsp&nbsp&nbspCourses</a></li>
                            <li><a href="result.php"><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i>&nbsp&nbsp&nbsp Result</a></li>
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
                        <a href="admin_course.php">Course Information</a>&nbsp>&nbsp Add Course 
                    </div>
                    <div class="panel-body">
                       <form method="post" action="">
					   
					<label>Course Code : </label><br>
					<input type="text" class="form-control" id="course_code" name="course_code" required style="width:15em" placeholder="Please enter course code." value="<?php if(isset($_POST['course_code'])) echo $_POST['course_code'];?>"/>
					
					<label>Course Name : </label><br> 
					<input type="text" class="form-control" id="course_name" name="course_name" required style="width:25em" placeholder="Please enter course name." value="<?php if(isset($_POST['course_name'])) echo $_POST['course_name'];?>"/>
					
					<label>Session : </label><br>
					<select class="selectpicker" name="session" required>
					
							<?php
							if(isset($_POST['session'])){
								$s=$_POST['session'];
								echo '<option data-hidden="true" value='.$s.'>'.$s.'</option>';
							}
							else{
							echo '<option data-hidden="true" value="null">Choose session.</option>';	
							}							
								
								$result = mysqli_query($db, "SELECT * FROM t_session");
										while($getSessionArray = mysqli_fetch_array($result))
										{
											echo "<option value={$getSessionArray['session']}>{$getSessionArray['session']}</option>";
										}
								?>
							
					</select><br>
					
					<label>Credit : </label><br>
					<select class="selectpicker" name="credit" required><br>
							<option data-hidden="true" value="null">Choose credit.</option>
							
								<option value="1" >1</option>
								<option value="2" >2</option>
								<option value="3" >3</option>
								<option value="4" >4</option>
								<option value="5" >5</option>
								<option value="5" >6</option>
							
					</select><br>
					
					<label>Semester Available : </label><br>
					<select class="selectpicker" name="semester_available" required><br>
							<option data-hidden="true" value="null">Choose semester available.</option>	
								<option value="1" >1</option>
								<option value="2" >2</option>
								<option value="3" >3</option>
								<option value="1 and 2" >1 and 2</option>
							
					</select><br>
					
					<label>Pre-requisite : </label><br>
					<select class="selectpicker" name="pre_requisite" data-size="10" data-live-search="true" data-width="75%">
									<option data-hidden="true" value=null>Select Pre-requisite.</option>
									<?php
										$result = mysqli_query($db, "SELECT * FROM courses");
										while($getCourseArray = mysqli_fetch_array($result))
										{
											echo "<option value={$getCourseArray['course_code']}>{$getCourseArray['course_code']}\t\t{$getCourseArray['course_name']}</option>";
										}
									?>
					</select><br>
					
					<label>Elective		:</label><br>
						<select class="selectpicker" name="elective" data-size="10" data-live-search="true" data-width="40%">	
									<?php

										echo '<option data-hidden="true" value="null">Not an elective.</option>';

										$major_name=$getElectiveResult['major'];
										$major_id=$getElectiveResult['major_id'];
										echo '<option data-hidden="true" value="'.$major_id.'">'.$major_name.'</option>';
									
									$result = mysqli_query($db, "SELECT * FROM t_major");									
									while($getMajorArray = mysqli_fetch_array($result))
									{
										echo "<option value={$getMajorArray['major_id']}>{$getMajorArray['major']}</option>";
									}
										echo "<option value=0}>Not an elective.</option>";
									?>
						</select><br>
						
						<label>Category		:</label><br>
						<select class="selectpicker" name="category" data-size="10" data-live-search="true" data-width="40%">	
									<?php
									
									echo '<option data-hidden="true" value="null">Select Category.</option>';
									
										$result = mysqli_query($db, "SELECT * FROM `t_elective_ctg`");
										while($getCategoryArray = mysqli_fetch_array($result))
										{
											echo "<option value={$getCategoryArray['id']}>{$getCategoryArray['category']}</option>";
										}
									?>
						</select><br>
					
					<label>Course Information : </label><br>
					<textarea class="form-control" rows="5" name="course_info"><?php if(isset($_POST['course_info'])) echo $_POST['course_info'];?></textarea><br>
					

					<button class="btn btn-success" type="submit" name="submit" value="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp Save</button>
					<button class="btn btn-default" type="submit" name="cancel" value="Cancel" formnovalidate>Cancel</button>
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
