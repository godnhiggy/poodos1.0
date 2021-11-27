<?php
session_start();
$jobNumber=$_SESSION["jobNumber"];
/*
Author: Javed Ur Rehman
Website: http://www.allphptricks.com/
*/
require_once 'phpqrcode-2010100721_1.1.4/phpqrcode/qrlib.php';



require('db.php');
//include("auth.php"); //include auth.php file on all secure pages
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Poodos SCANNING </title>
<link rel="stylesheet" href="css/style.css" />

</head>
<body>

<center><h1>Poodos</h1></center>
<center><h2>DOCUMENT SCANNING</h2></center>
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

  ?>
  <br><br>
  <form action="ocrAction.php" method="POST" enctype="multipart/form-data">
    <h2>Latest Scanned Folder</h2>
<?php
    ///////////  FInd BACKGROUND IMAGE
    $files = scandir('../ocrImages', SCANDIR_SORT_DESCENDING);
    //print_r(scandir('images'));
    $newest_file = $files[0];
    //echo "<span style='color: white'>THis is the file......".$newest_file."</span>";
    $pic = "../ocrImages/".$newest_file;
    ?>
     <img src="<?php echo $pic;?>" alt="Girl in a jacket" width="500" height="500">
    <span>
      <br>
      <input type="text" name="ocr" value="ocrValue">
      <br>
      <input type="radio" name="largeDoc" value="yesLargeDoc">

      <label for="html">Any Large Documents?</label><br>

    <input type="submit" value="Submit" name="ocrImageSubmit">
  </span>
  </form>

      <br><br>


  </div>
  <div class="column right" style="background-color:#bbb;">
    <h2>Job/Box Status</h2>
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
