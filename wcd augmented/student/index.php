<?php

ob_start();
session_start();

if($_SESSION['name']!='oasis')
{
  header('location: ../index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Online Attendance Management System </title>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="../css/main.css">

</head>
<body>
<header>

  <h1>Online Attendance Management System </h1>
  <div class="navbar">
  <a href="index.php">Home</a>
  <a href="students.php">Students</a>
  <a href="report.php">My Report</a>
  <a href="account.php">My Account</a>
  <a href="../logout.php">Logout</a>

</div>

</header>
<center>
<div class="row">
    <div class="content">
      <p>Be attentive and be regular :)</p>
    <img src="../img/tcr.png" height="200px" width="300px" />

  </div>
</div>
</center>
</body>
</html>
