<?php

 //starts a session for a new user
session_start();
$dbhost = 'http://ec2-54-166-222-59.compute-1.amazonaws.com';
$dbuser = 'root';
$dbpassword = 'user';
$dbname = 'custombeauty';
$conn=mysql_connect($dbhost, $dbuser, $dbpassword) or die("MySQL Error: " . mysql_error());
mysql_select_db($dbname) or die("MySQL Error: " . mysql_error());
?>
