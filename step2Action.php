<?php
session_start();
/*
Author: Javed Ur Rehman
Website: http://www.allphptricks.com/
*/
require('db.php');
include("auth.php"); //include auth.php file on all secure pages
$boxNumber = $_SESSION["boxNumber"];
$jobNumber = $_SESSION["jobNumber"];
$printQR = $_POST["printQR"];
$prep = $_POST["prep"];
//echo "printQR = ".$printQR;
//echo "<br>prep = ".$printQR;
//echo "<br>boxNumber = ".$boxNumber;
if($_POST["printQR"]){
  //echo "<br>we are in";
  // prepare and bind
  $stmt = $con->prepare("UPDATE $jobNumber SET printQR=(?) WHERE boxNumber=(?)");
  //$stmt = $con->prepare("INSERT INTO $jobNumber (printQR) VALUES (?)");
  $stmt->bind_param("si", $printQR, $boxNumber);
  $stmt->execute();
  //$_SESSION["jobNumber"]=$jobNumber;
//  echo "Inserted printQRData";
header("Location: step2.php");
}
if($_POST["prep"]){
  //echo "<br>we are in";
  // prepare and bind
  $stmt = $con->prepare("UPDATE $jobNumber SET prep=(?) WHERE boxNumber=(?)");
  //$stmt = $con->prepare("INSERT INTO $jobNumber (printQR) VALUES (?)");
  $stmt->bind_param("si", $prep, $boxNumber);
  $stmt->execute();
  //$_SESSION["jobNumber"]=$jobNumber;
  //echo "<br>Inserted Prep Data";
header("Location: step2.php");
}
//$stmt = $con->prepare("INSERT INTO $jobNumber (boxNumber, finalize) VALUES (?, ?)");
//$stmt->bind_param("is", $x, $y);
//$stmt->execute();




$stmt->close();
$conn->close();
?>
