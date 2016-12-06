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


echo "w_predict  =".$w_prediction."<br>";
echo "w_currentCGPA  =".$w_currentCGPA."<br>";
echo "w_interest  =".$w_interest."<br>";
echo "w_difficulty  =".$w_difficulty."<br>";
$sum=0;
$a=0;

$sql="SELECT * FROM `results` join `courses` on `courses`.course_code like`results`.course_code where `results`.student_id like '$student_id' order by `results`.session";
$result = mysqli_query($db,$sql);
while($row = mysqli_fetch_array($result)) {
	$temp=$row['course_code'];
	echo $temp." = ".$_GET[$temp];
	$sum+=$_GET[$temp];
	$a++;
}
echo " xxx ";
echo $sum;
echo " xxx ";

echo $a;
$mean=$sum/$a;
echo " xxx ";

echo $mean;

?>
