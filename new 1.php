<?php
include("check.php");
	mysqli_query($db, "DELETE FROM `temp` WHERE username like '$login_user'");
	unset($semester);
	unset($session);
	
	if(isset($_POST['button_edit'])){
		print "You pressed Button 1";
	}else if(isset($_POST['button_find'])){
		print "You pressed Button 2";
	}else if(isset($_POST['button_add'])){
		print "You pressed Button 3";
	}else if(isset($_POST['button_delete'])){
		print "You pressed Button 4";
	}

?>
	

<!DOCTYPE html>
<html>
<head>
  

	
	
	

</head>
<body>
<form action='' method='post'>
  <button class="btn btn-info" type="submit" name="button_find"><span class="glyphicon glyphicon-search"></span> Search </button>&nbsp;
						<button class="btn btn-success" type="submit" name="button_edit"><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp&nbsp Edit</button>&nbsp;
						<button class="btn btn-danger" type="submit" name="button_delete"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp&nbsp Delete</button>&nbsp;
						<button class="btn btn-warning" type="submit" name="button_edit"><span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp Add</button>&nbsp;
</form>
	
</body>
</html>
