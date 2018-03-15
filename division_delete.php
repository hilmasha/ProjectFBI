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
	<title>Remove Division</title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>


<div id="profile">
<b id="welcome">Remove Division from Branch : <i><?php echo $login_branch; ?></i></b>
<b id="logout" ><a href="logout.php">Log out</a></b>
<b id="previous"><a href="profile.php"> Homepage</a></b>
</div>
<hr color="#FFFFFF" />

<div id="login" style="margin:0 auto;">

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

<label><strong><font color="#B4AA58">Division #* </strong></label>
	<input id="Division_No" name="Division_No"  placeholder="##" type="text" maxlength="2" size="2" pattern=".{2,2}" required title="2 numbers required">
<input name="submit" type="submit" id="loginsubmit" value=" Remove " size="8">
</html>
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
	$ID=test_input($_POST['Division_No']);
	$sql="DELETE FROM `Divisions` WHERE `Division_No`='$ID' AND `Branch_No`='$login_branch'";
	$stmt = $mysqli->prepare($sql);
	    $stmt->execute();
         $stmt->bind_result($ID);
	} 
?>

<span>
<?php 
$status=mysqli_query($stmt) or die(mysqli_error());
echo "$result"


 ?>
 </span>
 
 <?php 
 $stmt->close();
   $mysqli->close();
 ?>
 
</div>
</div>
</form>
</body>
	