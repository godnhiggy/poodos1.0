<?php
/*
Author: Javed Ur Rehman
Website: http://www.allphptricks.com/
*/
require('db.php');
include("auth.php"); //include auth.php file on all secure pages

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Poodos Home</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<div class="form">
  <h1>Poodos Job that is now on github</h1>
  <h2>Let's get started!</h2>
<p>Welcome <?php echo $_SESSION['username']; ?>!</p>
<p>This is secure area.</p>

<form action="startAction.php" method="POST">
  <label for="jobNumber">Choose a Job:</label>
  <select name="jobNumber" id="jobNumber">
    <option value="newJob">New Job</option>
    <?php
    $sql = "SELECT * FROM job";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {

          $jobNumber = $row['jobNumber'];
    ?>
    <option value="<?php echo $jobNumber;?>"><?php echo $jobNumber;?></option>
  <?php }}?>
  </select>
  <br><br>
  <input type="submit" value="Submit">
</form>



<br /><br /><br /><br />
<!--<p><a href="dashboard.php">Dashboard</a></p>-->
<a href="logout.php">Logout</a>


<br /><br />
<!--<a href="http://www.allphptricks.com/simple-user-registration-login-script-in-php-and-mysqli/">Tutorial Link</a> <br /><br />
For More Web Development Tutorials Visit: <a href="http://www.allphptricks.com/">AllPHPTricks.com</a>-->
</div>
</body>
</html>
