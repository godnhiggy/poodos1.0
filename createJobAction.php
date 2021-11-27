<?php
session_start();
/*
Author: Javed Ur Rehman
Website: http://www.allphptricks.com/
*/
require('db.php');
include("auth.php"); //include auth.php file on all secure pages




$companyName = $_POST["companyName"];
$startDate = $_POST["startDate"];
$numberOfBoxes = $_POST["numberOfBoxes"];
$_SESSION["numberOfBoxes"]=$numberOfBoxes;
$username = $_SESSION["username"];
//echo "Boxes= ".$numberOfBoxes;
//echo "<br>Start Date = ".$startDate;
//echo "<br>Company Name= ".$companyName;

$startDate = str_replace("-", "", "$startDate");
//echo "<br><br>TRY THIS for start date= ".$startDate;
$jobNumber = substr($companyName,0,3);
$jobNumber = $jobNumber.$startDate;
//echo "<br><br>TRY THIS for Job Number= ".$jobNumber;


// prepare and bind
$stmt = $con->prepare("INSERT INTO job (companyName, jobNumber, numberOfBoxes, creator) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssis", $companyName, $jobNumber, $numberOfBoxes, $username);
if ($stmt->execute()){
$_SESSION["jobNumber"]=$jobNumber;
}
// prepare and bind
$stmt = $con->prepare("INSERT INTO boxes (jobNumber, creator) VALUES (?, ?)");
$stmt->bind_param("ss", $jobNumber, $username);
if ($stmt->execute()){



$sql = "CREATE TABLE $jobNumber (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
boxNumber INT(6) NOT NULL,
printQR VARCHAR(5),
prep VARCHAR(5),
folders VARCHAR(5),
smallDoc VARCHAR(5),
largeDoc VARCHAR(5),
docIndex VARCHAR(5),
qa VARCHAR(5),
finalize VARCHAR(5),
creator VARCHAR(100),
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($con->query($sql) === TRUE) {
  //header("Location: step2.php");
  //echo $jobNumber." created successfully";
  for ($x = 1; $x <= $numberOfBoxes; $x++) {
        if($x==1){$y=1;}else{$y=0;}
        $stmt = $con->prepare("INSERT INTO $jobNumber (boxNumber, finalize, creator) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $x, $y, $username);
        $stmt->execute();

  }
  header("Location: qr.php");
} else {
  echo "Error creating table: " . $conn->error;
}

}else{
  echo "no new records";
}
$stmt->close();
$conn->close();
?>
