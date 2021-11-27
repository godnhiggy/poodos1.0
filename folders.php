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
<title>Poodos Folder Scan</title>
<link rel="stylesheet" href="css/style.css" />

</head>
<body>

<center><h1>Poodos</h1></center>
<center><h2>Folder Scan</h2></center>
<center><h3><?php echo "Job Number - ".$jobNumber;?></h3></center>
<div class="row">
  <div class="column left" style="background-color:#aaa;">
    <h2>Job in Poodos</h2>
    <!--identify current box that is being worked on-->
        <?php
        $sql = "SELECT * FROM $jobNumber";
        $result = $con->query($sql);
        $numrows = $result->num_rows;
        if ($result->num_rows > 0) {

          while($row = $result->fetch_assoc()) {

            $boxNumber = $row['boxNumber'];
            $printQR = $row['printQR'];
            $prep = $row['prep'];
            $folders = $row["folders"];
            $docIndex = $row["docIndex"];
            $qa = $row["qa"];
            $status = $row['finalize'];


              // a $status of 1 means the box is in poodos
              if($status==1){
                $_SESSION["boxNumber"] = $boxNumber;
                $currentBoxNumber = $boxNumber;
                $currentBoxNumberConfirmed = "yes";
                $printQRCurrent = $printQR;
                $prepCurrent = $prep;
                $foldersCurrent = $folders;
                $docIndexCurrent = $docIndex;
                $qaCurrent = $qa;
                $status = $statusCurrent;

                echo "Box Number ".$boxNumber." of ".$numrows." is in Poodos";
              }


}
}
if($currentBoxNumberConfirmed!=="yes" || $prepCurrent !=="2" || $printQRCurrent !=="2"){
  header("Location: start.php");
  //echo "Q A Completed<br>";
}
?>
<br><br>

    <?php
    if($currentBoxNumberConfirmed="yes" && $printQRCurrent =="2"){
      echo "QRCodes Printed<br>";
    }
      //else{

  //echo "<input type='checkbox' name='printQR' value='2'>";
  //echo "<label for='printQR'> <a href='printQR.php' >Print QR Labels</a></label><br>";
//}

if($currentBoxNumberConfirmed="yes" && $prepCurrent =="2" && $printQRCurrent =="2"){
  //header("Location: folders.php");
  echo "Prep Work Done<br>";
}
  //else{

//echo "<input type='checkbox' name='prep' value='2'>";
//echo "<label for='prep'> Prep Work</a></label><br>";
//}



  ?>
  <br><br>
  <form action="foldersAction.php" method="POST">
  <input type='checkbox' name='folders' value='2'>
  <label for='folders'> <a href='ocr.php' >Folder Scanning</a></label><br>




  <input type="submit" value="Submit">
</form>

      <br><br>


  </div>
  <div class="column right" style="background-color:#bbb;">
    <h2>Column 2</h2>
    <?php
    if($printQRCurrent==2){echo "<b>QR Completed!</b><br>";}else{echo "QR not finished<br>";}
    if($prepCurrent==2){echo "<b>Prep Completed!</b><br>";}else{echo "Prep not finished<br>";}
    if($foldersCurrent==2){echo "<b>Folders Completed!</b><br>";}else{echo "Folders not finished<br>";}
    if($docIndexCurrent==2){echo "<b>Document Indexing Completed!</b><br>";}else{echo "Document Indexing not finished<br>";}
    if($qaCurrent==2){echo "<b>QA Completed!</b><br>";}else{echo "QA not finished<br>";}
    if($statusCurrent==2){echo "<b>Finalized Completed!</b><br>";}else{echo "Finalized not finished<br>";}
    ?>
  </div>
</div>



</body>
</html>
