<?php
session_start();


	



$gpa = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if(isset($_POST['gpa'], $_POST['Continue'] )){
		$gpa = $_SESSION["gpa"] =	$_POST["gpa"] ;
		//echo $gpa;
		
	$output = shell_exec("\"C:\\xampp\\htdocs\\AcademicPlanner\\R\\R-3.3.1\\bin\\Rscript.exe\" C:/xampp/htdocs/AcademicPlanner/R/R-3.3.1/bin/test.R $gpa");
	$output = round($output, 4);
    echo "prediction by linear regression: " .$output; 
	
	
	echo "<br>";
	
	$output1 = shell_exec("\"C:\\Program Files\\R\\R-3.2.4\\bin\\Rscript.exe\" C:/Users/Kuang/Desktop/test1.R $gpa");
	$output1 = round($output1, 4);
    echo "prediction by ann: " .$output1; 
		
		
	}
}


?>


<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
GPA: <input type="number" name="gpa" value="" min="0" max="4" step="0.01" required class="screenmen-input input-short"> 
<input type="submit" name="Continue" value="Press"></input>
</form>