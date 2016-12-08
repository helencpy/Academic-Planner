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
	
	<link href="bootstrap-fileinput/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
    <script src="bootstrap-fileinput/js/fileinput.js" type="text/javascript"></script>
    <script src="bootstrap-fileinput/js/fileinput_locale_fr.js" type="text/javascript"></script>
     <script src="bootstrap-fileinput/js/fileinput_locale_es.js" type="text/javascript"></script>

	
	
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

    <!-- LOGO HEADER END-->
   
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

					<form method="post" action="delete.php">
					<?php

						
						

							$session1="2013/2014";
							$course1="WXES1109";
							$semester1="1";
							
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
							
						
						
						
						echo '<hr/>';
						echo '<button class="btn btn-danger" type="submit" name="button_delete"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp&nbsp Delete</button>&nbsp;';
					
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
			
				
				
			
			
			</div>
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->
   
    <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY SCRIPTS -->
	
   
	
</body>
</html>
