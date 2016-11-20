<?php
include("check.php");
$files = glob('output/*'); // glob() function searches for all the path names matching pattern
foreach($files as $file){ 
  if(is_file($file))
    unlink($file); // delete
}



$current_cgpa = $_GET['current_cgpa'];
$elective_ctg = $_GET['elective_ctg']; 
$grade = $_GET['grade']; 
$w_currentCGPA = $_GET['w_currentCGPA'];
$w_interest = $_GET['w_interest'];
$w_prediction = $_GET['w_prediction'];
$w_difficulty = $_GET['w_difficulty'];


echo "w_predict  =".$w_prediction."<br>";
echo "w_currentCGPA  =".$w_currentCGPA."<br>";
echo "w_interest  =".$w_interest."<br>";
echo "w_difficulty  =".$w_difficulty."<br>";

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

$getElective="SELECT * FROM t_elective join `courses` on `courses`.course_code like`t_elective`.course_code where t_elective.major_id=1 and category= $elective_ctg";
$result = mysqli_query($db,$getElective);
//$row = mysqli_fetch_array($result);

unset($score);
$score = array();

while($row = mysqli_fetch_array($result)){
	$a=$parts[1];
	$b=$parts[2]*$current_cgpa;
	$c=$parts[3]*4;
	$d=$parts[4]*4;
	$e=$parts[5]*$row['difficulty'];
	$score[$row['course_name']]=$a+$b+$c+$d+$e;
	//print($row['course_name']);
	//print($score[$row['course_name']]);
}

$getElective="SELECT * FROM t_elective join `courses` on `courses`.course_code like`t_elective`.course_code where t_elective.major_id=1 and category!= $elective_ctg";
$result = mysqli_query($db,$getElective);
//$row = mysqli_fetch_array($result);

while($row = mysqli_fetch_array($result)){
	$a=$parts[1];
	$b=$parts[2]*$current_cgpa;
	$c=$parts[3]*0;
	$d=$parts[4]*4;
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
