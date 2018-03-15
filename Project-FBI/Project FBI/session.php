<?php
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$connection = mysql_connect("mansci-db.uwaterloo.ca", "hmasha", "database");
// Selecting Database
$db = mysql_select_db("hmasha_project", $connection);
session_start();// Starting Session
// Storing Session
$user_check=$_SESSION['login_user'];
// SQL Query To Fetch Complete Information Of User
$ses_sql=mysql_query("select * from Employees where Employee_ID='$user_check'", $connection);
$row = mysql_fetch_assoc($ses_sql);
$login_session =$row['Employee_ID'];
$login_branch =$row['Branch_No'];
$login_name =$row['Employee_Name'];
if(!isset($login_session)){
mysql_close($connection); // Closing Connection
header('Location: index0.php'); // Redirecting To Home Page
}
?>