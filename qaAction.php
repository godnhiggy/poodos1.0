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
$qa = $_POST["qa"];

if($_POST["qa"]){
  //echo "<br>we are in";
  // prepare and bind
  $stmt = $con->prepare("UPDATE $jobNumber SET qa=(?) WHERE boxNumber=(?)");
  //$stmt = $con->prepare("INSERT INTO $jobNumber (printQR) VALUES (?)");
  $stmt->bind_param("si", $qa, $boxNumber);
  $stmt->execute();
  //$_SESSION["jobNumber"]=$jobNumber;
//  echo "Inserted printQRData";

$stmt = $con->prepare("INSERT INTO qa (jobNumber, boxNumber, creator) VALUES (?, ?, ?)");
$stmt->bind_param("sis", $jobNumber, $boxNumber, $_SESSION["username"]);
$stmt->execute();

header("Location: finalize.php");
}else{
  header("Location: qa.php");
}





$stmt->close();
$conn->close();
?>
