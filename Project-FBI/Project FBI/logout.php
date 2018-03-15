<?php
session_start();
if(session_destroy()) // Destroying All Sessions
{
header("Location: index0.php"); // Redirecting To Home Page
}
?>