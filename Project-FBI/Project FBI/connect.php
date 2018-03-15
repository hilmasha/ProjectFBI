<?php

 //starts a session for a new user
session_start();
$dbhost = 'mansci-db.uwaterloo.ca';
$dbuser = 'hmasha';
$dbpassword = 'database';
$dbname = 'hmasha_project';
$conn=mysql_connect($dbhost, $dbuser, $dbpassword) or die("MySQL Error: " . mysql_error());
mysql_select_db($dbname) or die("MySQL Error: " . mysql_error());
?>
