<?php
session_start(); // Starting Session
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
if (empty($_POST['Employee_ID']) || empty($_POST['password'])) {
$error = "Employee_ID or Password is invalid";
}
else
{
// Define $username and $password
$Employee_ID=$_POST['Employee_ID'];
$password=$_POST['password'];
$BranchNo=$_POST['Branch_No'];
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$connection = mysql_connect("mansci-db.uwaterloo.ca", "hmasha", "database");
// To protect MySQL injection for Security purpose
$Employee_ID = stripslashes($Employee_ID);
$password = stripslashes($password);
$BranchNo = stripslashes($BranchNo);
$Employee_ID = mysql_real_escape_string($Employee_ID);
$BranchNo = mysql_real_escape_string($Branch_No);
$password = mysql_real_escape_string($password);
// Selecting Database
$db = mysql_select_db("hmasha_project", $connection);
// SQL query to fetch information of registerd users and finds user match.
$query = mysql_query("select * from Employees where password='$password' AND Employee_ID='$Employee_ID'AND `Job_title` LIKE '%manager'", $connection);
$rows = mysql_num_rows($query);
if ($rows == 1) {
$_SESSION['login_user']=$Employee_ID; // Initializing Session
//$_SESSION['user_branch']=$BranchNo;
header("location: profile.php"); // Redirecting To Other Page
} else {
$error = "Username or Password is invalid";
}
mysql_close($connection); // Closing Connection
}
}
?>