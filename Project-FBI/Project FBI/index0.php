<?php
include('login0.php'); // Includes Login Script

if(isset($_SESSION['login_user'])){
header("location: profile.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Login Form</title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="main">

<div id="login">
<h1 style="color:#B4AA58;">Manager Login</h1>

<form action="" method="post">
<label><strong><font color="#B4AA58">Agent ID :</strong> </label>
<input id="text" name="Employee_ID" placeholder="****" type="text" maxlength="4" color=#20355F>
<label><strong>Password :</strong></label>
<input id="password" name="password" placeholder="********" type="password" maxlength="8">
<input name="submit" type="submit" id="loginsubmit" value=" Login ">
<span><?php echo $error; ?></span>
</form>
</div>
</div>
</body>
</html>