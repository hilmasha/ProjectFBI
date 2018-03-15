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
	<title>Add Division</title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>

<div id="profile">
<b id="welcome">Create Division in Branch : <i><?php echo $login_branch; ?></i></b>
<b id="logout" ><a href="logout.php">Log out</a></b>
<b id="previous"><a href="profile.php">Homepage</a></b>
</div>
<hr color="#FFFFFF" />
<div id="login" style="margin:0 auto;">

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
<label><strong><font color="#B4AA58">Division Name*</strong></label>
	<input id="text" name="Division_name" placeholder="Division" type="text" maxlength="30" pattern=".{2,30}" required title="2 to 30 characters" color=#20355F>
<label><strong>Division No* </strong></label>
	<input id="text" name="Division_No"  placeholder="##" type="text" maxlength="2" size="2" pattern=".{2,2}" required title="2 numbers required" color=#20355F>	
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
	$Name=test_input($_POST['Division_name']);
	$ID=test_input($_POST['Division_No']);
	$Manager=test_input($_POST['Employee_ID']);
	
	 $sql = "INSERT INTO `Divisions` (`Division_name`,`Division_No`,`Branch_No`) VALUES ('$Name','$ID','$login_branch')";
	  $stmt = $mysqli->prepare($sql);
	   $stmt->execute();
	   $stmt->bind_result($ID,$Name);
	

}	
?>
<span>
<div id="login" style="margin:0 auto;">
<?php 

if(!mysqli_query($mysqli,$stmt)|| mysqli_errno())
{
	echo   mysqli_error($mysqli);
	
} 
if(mysqli_query($mysqli,$stmt)||!mysqli_errno()){
	echo "Successfully added";
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