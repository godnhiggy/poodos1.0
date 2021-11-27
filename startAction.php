<?php
session_start();

$jobNumber=$_POST["jobNumber"];
//echo $jobNumber;
if($jobNumber=="newJob"){
  header("Location: createJob.php");

// prepare and bind
}else{
  $_SESSION["jobNumber"] = $jobNumber;
  header("Location: qr.php");
  //echo $_SESSION["jobNumber"];
}



?>
