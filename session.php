<?php
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$connection = mysql_connect("http://ec2-54-166-222-59.compute-1.amazonaws.com", "root", "user");
// Selecting Database
$db = mysql_select_db("custombeauty", $connection);
session_start();// Starting Session
// Storing Session
$user_check=$_SESSION['login_user'];
// SQL Query To Fetch Complete Information Of User
$ses_sql=mysql_query("select * from employee_login where employee_id='$user_check'", $connection);
$row = mysql_fetch_assoc($ses_sql);
$login_session =$row['employee_id'];
$login_branch =$row['Branch_No'];
$login_name =$row['Employee_Name'];
if(!isset($login_session)){
mysql_close($connection); // Closing Connection
header('Location: index0.php'); // Redirecting To Home Page
}
?>
