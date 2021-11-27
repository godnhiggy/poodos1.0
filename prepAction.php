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
$prep = $_POST["prep"];


if($_POST["prep"]){
  //echo "<br>we are in";
  // prepare and bind
  $stmt = $con->prepare("UPDATE $jobNumber SET prep=(?) WHERE boxNumber=(?)");
  //$stmt = $con->prepare("INSERT INTO $jobNumber (printQR) VALUES (?)");
  $stmt->bind_param("si", $prep, $boxNumber);
  $stmt->execute();
  //$_SESSION["jobNumber"]=$jobNumber;
  //echo "<br>Inserted Prep Data";

  $stmt = $con->prepare("INSERT INTO prep (jobNumber, boxNumber, creator) VALUES (?, ?, ?)");
  $stmt->bind_param("sis", $jobNumber, $boxNumber, $_SESSION["username"]);
  $stmt->execute();

header("Location: folders.php");
}
else{
  header("Location: prep.php");
}




$stmt->close();
$conn->close();
?>
