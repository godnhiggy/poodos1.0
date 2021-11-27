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


if($_POST["printQR"]){
  //echo "<br>we are in";
  // prepare and bind
  $stmt = $con->prepare("UPDATE $jobNumber SET printQR=(?) WHERE boxNumber=(?)");
  //$stmt = $con->prepare("INSERT INTO $jobNumber (printQR) VALUES (?)");
  $stmt->bind_param("si", $printQR, $boxNumber);
  $stmt->execute();
  //$_SESSION["jobNumber"]=$jobNumber;
//  echo "Inserted printQRData";
$stmt = $con->prepare("INSERT INTO qr (jobNumber, creator) VALUES (?, ?)");
$stmt->bind_param("ss", $jobNumber, $_SESSION["username"]);
$stmt->execute();



header("Location: prep.php");
}else{
  header("Location: qr.php");
}




$stmt->close();
$conn->close();
?>
