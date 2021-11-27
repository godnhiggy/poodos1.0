<?php
session_start();
$jobNumber=$_SESSION["jobNumber"];
/*
Author: Javed Ur Rehman
Website: http://www.allphptricks.com/
*/
require_once 'phpqrcode-2010100721_1.1.4/phpqrcode/qrlib.php';



require('db.php');
include("auth.php"); //include auth.php file on all secure pages
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Poodos Prep</title>
<link rel="stylesheet" href="css/style.css" />

</head>
<body>

<center><h2>Poodos Prep</h2></center>
<center><h3><?php echo "Job Number - ".$jobNumber;?></h3></center>
<center><button onclick="window.print()">Print this page</button></center><br><br><br><br><br>
<div class="row">
  <div>


        <?php
        $sql = "SELECT * FROM $jobNumber";
        $result = $con->query($sql);
        $numrows = $result->num_rows;
        if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {

              $boxNumber = $row['boxNumber'];
              $status = $row['finalize'];
              //create QRCODE from job number and box number
              //QRcode::png("This is a good thing");
              $path = 'images/';
              $file = $path.$jobNumber."-".$boxNumber.".png";

              // Test to output
              $text = $file;
              QRcode::png($text, $file, 'L', 10);
              echo "<center>".$text."</center><br>";
              echo"<center><image src='".$file."'></center>";
              echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";


}}
?>

      <br><br>

  </div>

</div>





</body>
</html>
