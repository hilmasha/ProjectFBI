<?php include('session.php'); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Cases Information</title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>

<div id="profile">
<b id="cases">Cases under branch: <i><?php echo $login_branch; ?></i></b>
<b id="logout" ><a href="logout.php">Log out</a></b>
<b id="previous"><a href="select_case.php">Select Case</a></b>
<b id="previous2"><a href="profile.php">Homepage</a></b>
</div>
	<hr color="#FFFFFF" />
<?php
// Enable error logging: 
error_reporting(E_ALL ^ E_NOTICE);
// mysqli connection via user-defined function
include ('./my_connect.php');
$mysqli = get_mysqli_conn();

?>

<?php
	$req = $_REQUEST['Open_Closed'];
		
// SQL statement
if($req !="All")
{	
	$sql = "SELECT  COUNT(DISTINCT w.`Case_ID`)AS NoOfCases ,c.`Case_ID`,`Case_Name`,`Start_Date`,`End_Date`
FROM `Works_On` AS w, `FBICase` AS c
WHERE  w.`Case_ID`=c.`Case_ID` AND w.`Branch_No`='$login_branch' AND`Open_Closed`= '$req' GROUP BY w.`Case_ID` HAVING  COUNT(w.`Case_ID`) >0";

}

	//$result = mysql_query($sql);
	$stmt = $mysqli->prepare($sql);
	
// Prepared statement, stage 2: execute
	$stmt->bind_param('i', $req); 
	$stmt->execute();$stmt->bind_result($NoOfCases,$CaseID,$CaseName,$Strtdate,$Enddate);
	
	?>
<div id="addemp2" >
	<form class="form-inline"name="form1" id="radiogroup" dir="rtl" method="post" action="case_all.php" >
	<label class="radio-inline"><font color="#B4AA58" font size="4px">
	<input type="radio" type="radio" name="Open_Closed" id="Open_Closed" value="1">Closed
	</label><font color="#B4AA58" font size="4px">
	
	<label class="radio-inline">
	<input type="radio" type="radio" name="Open_Closed" id="Open_Closed" value="0">                     Open
	</label><font color="#B4AA58">
	<input name="submit" type="submit" id="loginsubmit" >
</form> 
</div>

<div style=" text-align: left; text-indent: 0px; padding: 0px 0px 0px 0px; margin: 0px 0px 0px 0px;">
	<table id="forum" width="80%" border="1" align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC" style="border-color: #ABAB80; border-style: solid; background-color: #223C5F;">

 <thead>

  <tr>

    <th width="20%" align="center" bgcolor="#E6E6E6"><strong>Case ID</strong></td>
   <th width="20%" align="center" bgcolor="#E6E6E6"><strong>Case Name</strong></td>
   
	<th width="20%" align="center" bgcolor="#E6E6E6"><strong>Case Start</strong></td>
   <th width="20%" align="center" bgcolor="#E6E6E6"><strong>Case End</strong></td>
   
     </tr>

    </thead>
</div>	

<c id="cases"><font color="#B4AA58" font size="4px" margin-bottom="3px"style="background-color:#050028">Number of <i>
<?php
 if($req=='1')
 {
	 echo " Open ";
}
elseif($req=='0')
{
	echo" Closed ";
}	
?>
</i>Cases:

<?php
	while($stmt->fetch())
   {
	   
echo "<tr>";
echo "<td>$CaseID</td>";
echo "<td>$CaseName</td>";
echo "<td>$Strtdate</td>";
echo "<td>$Enddate</td>";
?> 
<i>
<?php 
echo $NoOfCases;
}
?>
</i></c>
<?php
   $stmt->close();
   $mysqli->close();
?>
  </table>
  </body>
  </html>