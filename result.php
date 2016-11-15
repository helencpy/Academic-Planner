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
                   <i>Faculty of Computer Science & Information Technology, University of Malaya</i>
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
                     <img src="assets/img/new.png" />
                </a>

            </div>

            <div class="left-div">
                <div class="user-settings-wrapper">
                    <ul class="nav">

                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                                <span class="glyphicon glyphicon-education" style="font-size: 25px;"></span>
                            </a>
                            <div class="dropdown-menu dropdown-settings">
                                <div class="media">
                                    <a class="media-left" href="#">
                                        <img src="assets/img/64-64.jpg" alt="" class="img-rounded" />
                                    </a>
                                    <div class="media-body">
                                        <h4 class="media-heading"><?php echo $login_user;?> </h4>
                                        <h5>
										
										</h5>

                                    </div>
                                </div>
                                <hr />
                                <h5><strong>Personal Bio : </strong></h5>
                               <h5><?php echo $major;?></h5>
                                <hr />
                                <a href="#" class="btn btn-info btn-sm">Full Profile</a>&nbsp; <a href="login.html" class="btn btn-danger btn-sm">Logout</a>

                            </div>
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
                            <li><a href="course_info.php"><i class="fa fa-book fa-lg" aria-hidden="true"></i>&nbsp&nbsp&nbsp Courses</a></li>
                            <li><a class="menu-top-active" href="result.php"><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i>&nbsp&nbsp&nbsp Result</a></li>
                            <li><a href="table.html"><i class="fa fa-calculator fa-lg" aria-hidden="true"></i>&nbsp&nbsp&nbsp Planner</a></li>
                            <li><a href="forms.html"><i class="fa fa-thumbs-up fa-lg" aria-hidden="true"></i>&nbsp&nbsp&nbsp Recommendation</a></li>
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
                        Previous Academic Result
                    </div>
                    <div class="panel-body">
                        
					<table>
					<tr>
					<th><p>Matric Number</p></th>
					<td><p>: <?php echo $student_id;?></p><td>
					</tr>					
					
					<tr>
					<th><p>Major</p></th>
					<td><p>: <?php echo $major;?></p><td>
					</tr>
					
					<tr>
					<th><p>CGPA</p></th>
					<td><p>: 
					
					<?php 
					$sql="SELECT * FROM `results` join `courses` on `courses`.course_code like`results`.course_code where `results`.student_id like '$student_id' order by `results`.session";
					$result = mysqli_query($db,$sql);
					$total_credit=0;
					$total_grade_point=0;
					while($row = mysqli_fetch_array($result)) {
					if($row['grade_point']!=null){
					$total_credit+=$row['credit'];
					$total_grade_point+=$row['grade_point'];
					}
					}
					$CGPA=round(($total_grade_point/$total_credit),2);
					mysqli_query($db, "UPDATE `users` SET `cgpa`=$CGPA WHERE username like '$login_user'");
					printf ("%.2f ",($total_grade_point/$total_credit));
					?>
					</p>
					<td>
					</tr>
					<br>
					
					<tr>
					<th><p>Examination Result</p></th>
					<td><p>:</p><td>
					</tr>
					<br>
					
					</table>
					
					<?php
					$sql="SELECT * FROM `results` where student_id like '$student_id' order by session";
					$result = mysqli_query($db,$sql);
					
					$sessionArray = array();
					$i=1;
					while($row = mysqli_fetch_array($result)){
							
							if($i==1){
								$sessionArray[$i]=$row['session'].",".$row['semester'];
								$old=$sessionArray[$i];
								$i=$i+1;
								//echo "HERE ".$i." HERE";
							}
							
							else{
								if($row['session'].",".$row['semester']!=$old){
									$sessionArray[$i]=$row['session'].",".$row['semester'];
									$old=$sessionArray[$i];
									$i=$i+1;
								}
							}						
					}
					
					$a=1;
					
					foreach($sessionArray as $x => $x_value) {
						
						$total_credit=0;
						$total_grade_point=0;
						
						$pieces=explode(",",$x_value);
						 $session1= $pieces[0];
						 $semester1= $pieces[1];
						 
					$sql2="SELECT * FROM `results` 
							join `courses` on `courses`.course_code like`results`.course_code 
							where `results`.student_id like '$student_id' AND `results`.session LIKE '$session1' AND `results`.semester = '$semester1'
							order by `results`.session";
					$result2 = mysqli_query($db,$sql2);
					
					
					echo "<button type='button' class='btn collapsed' data-toggle='collapse' data-target='#".$a."'>Session $session1 Semester $semester1 </button>";
					echo "<br><br>";
					
					echo "<div id=$a class='collapse'>";
				
					//echo "<h3><b>Session $session1 Semester $semester1</b></h3>";
					
					echo "<table class='table table-striped table-inverse'><thead class='bg-primary'>
								<tr>
									<th>Course Code</th>
									<th>Course Name</th>
									<th>Credit</th>
									<th>Grade</th>
									<th>Grade Point</th>
								</tr> </thead><tbody>";
					
					while($row2 = mysqli_fetch_array($result2)){
					
							echo "<tr>";
								echo "<td>" . $row2['course_code'] . "</td>";
								echo "<td>" . $row2['course_name'] . "</td>";
								echo "<td>" . $row2['credit'] . "</td>";
								echo "<td>" . $row2['grade'] . "</td>";
									if($row2['grade_point']==null||$row2['grade']=="S"){
										echo "<td> - </td>";
									}
									else{
										echo "<td>" . $row2['grade_point'] . "</td>";	
									}
							echo "</tr>";
							
							if($row2['grade']!="S"){
								if($row2['grade_point']!=null){
									
								$total_credit+=$row2['credit'];
								$total_grade_point+=$row2['grade_point'];
								}
							}
						}
							echo "</tbody>";
							echo "</table>";
							
							
							echo "<table>
									<tr>
									<th><p>GPA</p></th>
									<td><p>: ";
									printf ("%.2f ",($total_grade_point/$total_credit));
									echo "</p><td>
									</tr>
									</table><br>";
							$a++;
							echo "</div>";
					
					
					}
					
					?>	
						
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
