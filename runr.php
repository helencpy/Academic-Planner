<?php
include("check.php");
$files = glob('output/*'); // glob() function searches for all the path names matching pattern
foreach($files as $file){ 
  if(is_file($file))
    unlink($file); // delete
}



$current_cgpa = $_GET['current_cgpa'];
$elective_ctg = $_GET['elective_ctg']; 
//$grade = $_GET['grade']; 
$major=$_GET['major'];
$w_currentCGPA = $_GET['w_currentCGPA'];
$w_interest = $_GET['w_interest'];
$w_prediction = $_GET['w_prediction'];
$w_difficulty = $_GET['w_difficulty'];


$sum1=0;
$a1=0;
$sum2=0;
$a2=0;
$sum3=0;
$a3=0;
$sum4=0;
$a4=0;

$sql="SELECT * FROM `results` join `courses` on `courses`.course_code like`results`.course_code where `results`.student_id like '$student_id' order by `results`.session";
$result = mysqli_query($db,$sql);
while($row = mysqli_fetch_array($result)) {
	$temp=$row['course_code'];
	//echo $temp." = ".$_GET[$temp];
	
	if($row['category']==1){
		$sum1+=$_GET[$temp];
		$a1++;
	}
	else if($row['category']==2){
		$sum2+=$_GET[$temp];
		$a2++;
	}
	else if($row['category']==3){
		$sum3+=$_GET[$temp];
		$a3++;
	}
	else if($row['category']==4){
		$sum4+=$_GET[$temp];
		$a4++;
	}
}
$mean1=$sum1/$a1;
$mean2=$sum2/$a2;
$mean3=$sum3/$a3;
$mean4=$sum4/$a4;





/* echo "w_predict  =".$w_prediction."<br>";
echo "w_currentCGPA  =".$w_currentCGPA."<br>";
echo "w_interest  =".$w_interest."<br>";
echo "w_difficulty  =".$w_difficulty."<br>"; */

$output1 = shell_exec("\"C:\\xampp\\htdocs\\AcademicPlanner\\R\\R-3.3.1\\bin\\Rscript.exe\" C:/xampp/htdocs/AcademicPlanner/R/R-3.3.1/bin/testmath.R $mean1");
	$output1 = round($output1, 4);
	
	$output2 = shell_exec("\"C:\\xampp\\htdocs\\AcademicPlanner\\R\\R-3.3.1\\bin\\Rscript.exe\" C:/xampp/htdocs/AcademicPlanner/R/R-3.3.1/bin/testprg.R $mean2");
	$output2 = round($output2, 4);
	
	$output3 = shell_exec("\"C:\\xampp\\htdocs\\AcademicPlanner\\R\\R-3.3.1\\bin\\Rscript.exe\" C:/xampp/htdocs/AcademicPlanner/R/R-3.3.1/bin/testtheory.R $mean3");
	$output3 = round($output3, 4);
	
	$output4 = shell_exec("\"C:\\xampp\\htdocs\\AcademicPlanner\\R\\R-3.3.1\\bin\\Rscript.exe\" C:/xampp/htdocs/AcademicPlanner/R/R-3.3.1/bin/testother.R $mean4");
	$output4 = round($output4, 4);

	/* echo "math:".$output1;
	echo "prg:".$output2;
	echo "theory:".$output3;
	echo "other:".$output4; */
	
// execute R script from shell
exec(".\R\R-3.3.1\bin\Rscript .\R\R-3.3.1\bin\multiple_regression.R $w_currentCGPA $w_interest $w_prediction $w_difficulty"); 
//$f=fopen("analysis-output.txt", "r");
//while(!feof($f)) { 
//	    echo fgets($f) . "<br />";
//	}

//	fclose($f);


$myFile = "analysis-output.txt";
$lines = file($myFile);//file in to an array
$getNumberLine= $lines[7];
$parts = preg_split('/\s+/', $getNumberLine);

 echo $parts[1]; // piece2
echo $parts[2]; // piece2
echo $parts[3]; // piece2
echo $parts[4]; // piece2
echo $parts[5]; // piece2 

$getElective="SELECT * FROM t_elective join `courses` on `courses`.course_code like`t_elective`.course_code where t_elective.major_id='$major' and t_elective.category= $elective_ctg";
$result = mysqli_query($db,$getElective);
//$row = mysqli_fetch_array($result);

unset($score);
$score = array();

while($row = mysqli_fetch_array($result)){
	$a=$parts[1];
	$b=$parts[2]*$current_cgpa;
	$c=$parts[3]*4;
	
	if($row['category']==1){
	$d=$parts[4]*$output1;
	}
	else if($row['category']==2){
	$d=$parts[4]*$output2;
	}
	else if($row['category']==3){
	$d=$parts[4]*$output3;
	}
	else if($row['category']==4){
	$d=$parts[4]*$output4;
	}
	$e=$parts[5]*$row['difficulty'];
	$score[$row['course_name']]=$a+$b+$c+$d+$e;
	//print($row['course_name']);
	//print($score[$row['course_name']]);
}

$getElective="SELECT * FROM t_elective join `courses` on `courses`.course_code like`t_elective`.course_code where t_elective.major_id='$major' and t_elective.category!= $elective_ctg";
$result = mysqli_query($db,$getElective);
//$row = mysqli_fetch_array($result);

while($row = mysqli_fetch_array($result)){
	$a=$parts[1];
	$b=$parts[2]*$current_cgpa;
	$c=$parts[3]*0;
	
	if($row['category']==1){
	$d=$parts[4]*$output1;
	}
	else if($row['category']==2){
	$d=$parts[4]*$output2;
	}
	else if($row['category']==3){
	$d=$parts[4]*$output3;
	}
	else if($row['category']==4){
	$d=$parts[4]*$output4;
	}
	
	$e=$parts[5]*$row['difficulty'];
	$score[$row['course_name']]=$a+$b+$c+$d+$e;
	//print($row['course_name']);
	//print($score[$row['course_name']]);
}
arsort($score);

//foreach($score as $x => $x_value) {
//    echo "Key=" . $x . ", Value=" . $x_value;
//    echo "<br>";
//}
$redirect = "recommendation.php?".http_build_query($score);
header( "Location: $redirect");
					
					
//exec(".\R\R-3.3.1\bin\Rscript .\R\R-3.3.1\bin\calculation.R $w_currentCGPA $w_interest $w_prediction $w_difficulty"); 



?>
