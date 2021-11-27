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
$finalize = $_POST["finalize"];

if($_POST["finalize"]){

  //echo "<br>we are in";
  // prepare and bind
  $stmt = $con->prepare("UPDATE $jobNumber SET finalize=(?) WHERE boxNumber=(?)");
  //$stmt = $con->prepare("INSERT INTO $jobNumber (printQR) VALUES (?)");
  $stmt->bind_param("si", $finalize, $boxNumber);
  $stmt->execute();


  $nextBoxNumber = $boxNumber + 1;
  $nextFinalize = "1";
  //echo "<br>we are in";
  // prepare and bind
  $stmt = $con->prepare("UPDATE $jobNumber SET finalize=(?) WHERE boxNumber=(?)");
  //$stmt = $con->prepare("INSERT INTO $jobNumber (printQR) VALUES (?)");
  $stmt->bind_param("si", $nextFinalize, $nextBoxNumber);
  $stmt->execute();



  //$_SESSION["jobNumber"]=$jobNumber;
//  echo "Inserted printQRData";

$stmt = $con->prepare("INSERT INTO finalize (jobNumber, boxNumber, creator) VALUES (?, ?, ?)");
$stmt->bind_param("sis", $jobNumber, $boxNumber, $_SESSION["username"]);
$stmt->execute();


header("Location: qr.php");
}else{
  header("Location: finalize.php");
}





$stmt->close();
$conn->close();
?>
