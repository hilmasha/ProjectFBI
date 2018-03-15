<?php include('session.php'); 
$error=''; // Variable To Store Error Message
?>

<?php
// Enable error logging: 
error_reporting(E_ALL ^ E_NOTICE);
// mysqli connection via user-defined function
include ('./my_connect.php');
$mysqli = get_mysqli_conn();
?>

<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="drop_menu.css">
	<title>Add Agent</title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>

<div id="profile" >
<b id="welcome">Add Agent to Branch : <i><?php echo $login_branch;?></i></b>

<b id="logout" ><a href="logout.php">Log out</a></b>
<b id="previous"><a href="profile.php">Homepage</a></b>
</div>

<hr color="#FFFFFF" />

<div id="login" style="margin:0 auto;">

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
<label><strong><font color="#B4AA58">Agent ID* :</strong></label>
	<input id="text" name="Employee_ID"  placeholder="A000" type="text" maxlength="4" size="4" pattern=".{4,4}" required title="4 characters required" color=#20355F>
<label><strong>Agent Name*:</strong></label>
	<input id="text" name="Employee_Name" placeholder="John Doe" type="text" maxlength="30" pattern=".{5,30}" required title="5 to 30 characters" color=#20355F>
<label><strong>Agent Position* :</strong></label>
	<input id="text" name="Job_title" placeholder="Position" type="text" maxlength="30" size="30" pattern=".{3,30}" required title="3 to 30 characters" color=#20355F>
<label><strong>Agent SSN* :</strong></label>
	<input id="text" name="SSN" placeholder="#########" type="text"  size="9" pattern="\d*" maxlength="9" required title="9 numbers needed" color=#20355F>
<label><strong>Temporary Password* :</strong></label>
	<input id="password" name="password" placeholder="********" type="password" color=#20355F maxlength="8" size="8" pattern=".{8,8}" required title="8 characters">
	<input name="submit" type="submit" id="loginsubmit" value=" Add " size="8">
</div>

<?php
	function test_input($data)
	{
	$data = trim($data);
	$$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
	}	

if($_SERVER["REQUEST_METHOD"] == "POST")
	{
	$Name=test_input($_POST['Employee_Name']);
	$ID=test_input($_POST['Employee_ID']);
	$Title=test_input($_POST['Job_title']);
	$SSN=test_input($_POST['SSN']);
	$Password=test_input($_POST['password']);
	
	 $sql = "INSERT INTO `Employees` (`Employee_ID`,`Employee_Name`,`Job_title`,`ESSN`,`Branch_No`,`password`) VALUES ('$ID','$Name','$Title','$SSN','$login_branch','$Password')";
	 $stmt = $mysqli->prepare($sql);
	 $stmt->execute();
	 $stmt->bind_result($ID,$Name,$Title,$SSN,$Password);
	
	
?>

<span>
<div id="login" style="margin-top:0 auto;">

<?php 
if(!mysqli_query($mysqli,$stmt) || mysqli_errno())
{
	echo   mysqli_error($mysqli);
	
} 
if(mysqli_query($mysqli,$stmt) || !mysqli_errno()){
	echo"Successfully added";
}
}
 ?>
 </span>
 
 <?php 
 $stmt->close();
  $mysqli->close();
 ?>
</div>

</form>
</body>
</html>