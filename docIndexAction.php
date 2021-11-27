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
$docIndex = $_POST["docIndex"];

if($_POST["docIndex"]){
  //echo "<br>we are in";
  // prepare and bind
  $stmt = $con->prepare("UPDATE $jobNumber SET docIndex=(?) WHERE boxNumber=(?)");
  //$stmt = $con->prepare("INSERT INTO $jobNumber (printQR) VALUES (?)");
  $stmt->bind_param("si", $docIndex, $boxNumber);
  $stmt->execute();
  //$_SESSION["jobNumber"]=$jobNumber;
//  echo "Inserted printQRData";

$stmt = $con->prepare("INSERT INTO docIndex (jobNumber, boxNumber, creator) VALUES (?, ?, ?)");
$stmt->bind_param("sis", $jobNumber, $boxNumber, $_SESSION["username"]);
$stmt->execute();

header("Location: qa.php");
}else{
  header("Location: docIndex.php");
}





$stmt->close();
$conn->close();
?>
