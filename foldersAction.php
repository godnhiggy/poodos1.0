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
$folders = $_POST["folders"];

if($_POST["folders"]){
  //echo "<br>we are in";
  // prepare and bind
  $stmt = $con->prepare("UPDATE $jobNumber SET folders=(?) WHERE boxNumber=(?)");
  //$stmt = $con->prepare("INSERT INTO $jobNumber (printQR) VALUES (?)");
  $stmt->bind_param("si", $folders, $boxNumber);
  $stmt->execute();
  //$_SESSION["jobNumber"]=$jobNumber;
//  echo "Inserted printQRData";

$stmt = $con->prepare("INSERT INTO folders (jobNumber, boxNumber, creator) VALUES (?, ?, ?)");
$stmt->bind_param("sis", $jobNumber, $boxNumber, $_SESSION["username"]);
$stmt->execute();

header("Location: docIndex.php");
}else{
  header("Location: folders.php");
}





$stmt->close();
$conn->close();
?>
