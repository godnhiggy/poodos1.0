<?php
/*
Author: Javed Ur Rehman
Website: http://www.allphptricks.com/
*/
include("auth.php"); //include auth.php file on all secure pages
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Poodos New Job</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<div class="form">
  <center><h1>Poodos</h1></center>
  <h2>New Job</h2>

<p>Welcome <?php echo $_SESSION['username']; ?>!</p>
<p>This is secure area.</p>
  <form action="createJobAction.php" method="POST">
    <label for="companyName">Company Name:</label><br>
    <input type="text" id="companyName" name="companyName" value="ABC"><br>
  <br>
    <label for="startDate">Date:</label><br>
    <input type="date" id="startDate" name="startDate" ><br><br>
  <br>
    <label for="numberOfBoxes">Nmber of Boxes:</label><br>
    <input type="number" id="numberOf Boxes" name="numberOfBoxes" ><br><br>
    <input type="submit" value="Submit">
  </form>


</div>
</body>
</html>
