<?php include('session.php'); ?>

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
	<title>Cases Information</title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>


<div id="profile">
<b id="welcome">View Case Information in branch: <i><?php echo $login_branch; ?></i></b>
<b id="logout" ><a href="logout.php">Log out</a></b>
<b id="previous"><a href="profile.php">Homepage</a></b>
</div>
<hr color="#FFFFFF" />

<div id="login2" >
<form action="select_case.php" method="post">
<label for="Case_ID"><font color="#B4AA58" font size="5px" >Select Case: </label>
<select name='Case_ID' >
<?php

// SQL statement
$sql = "SELECT DISTINCT w.Case_ID FROM `FBICase` AS c, `Works_On` AS w WHERE w.Case_ID = c.Case_ID AND w.Branch_No = '$login_branch'";
//$result = mysql_query($sql); 	
$stmt = $mysqli->prepare($sql);
$stmt->execute();
$stmt->bind_result($CaseID); 
/* fetch values */ 
//echo '<label for="FBICase"><font color="#B4AA58">Pick Case: </label>'; 
//echo '<select name="Case_Name">'; 
while ($stmt->fetch()) 
{
echo "<option value='" . $CaseID ."'>" . $CaseID . "</option>"; 
}
?>
</select>
<input name="submit" id="loginsubmit" type="submit" value="Continue" size="5" >
</form>
</div>

<div id="addemp" >
<form name="form1" id="radiogroup" dir="rtl" method="post" action="case_all.php" >
	<input name="submit" type="submit" id="loginsubmit" value="Open/Cold " size="5" >
</form> 
</div>

<div style=" text-align: left; text-indent: 0px; padding: 0px 0px 0px 0px; margin: 0px 0px 0px 0px;">
<table id="forum" width="80%" border="1" align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC" style="border-color: #ABAB80; border-style: solid; background-color: #223C5F;">

 <thead>

  <tr>

    <th width="10%" align="center" bgcolor="#E6E6E6"><strong>Case ID</strong></td>
   <th width="10%" align="center" bgcolor="#E6E6E6"><strong>Case Name</strong></td>
<th width="15%" align="center" bgcolor="#E6E6E6"><strong>Division Assigned</strong></td>
	<th width="10%" align="center" bgcolor="#E6E6E6"><strong>Start Date</strong></td>
   <th width="10%" align="center" bgcolor="#E6E6E6"><strong>End Date</strong></td>
   <th width="10%" align="center" bgcolor="#E6E6E6"><strong>POI SSN</strong></td>
	<th width="25%" align="center" bgcolor="#E6E6E6"><strong>POI Name</strong></td>
     </tr>

    </thead>
	</div>
<?php
$req= $_POST['Case_ID'];

if ( isset($_POST['submit'])) {  

$sql2 = "SELECT c.Case_ID,`Case_Name`,`Division_name`,`Start_Date`,`End_Date`,p.SSN,`Name`
FROM `Person_Interest` AS p,`Works_On` AS w, `FBICase` AS c, `Divisions` AS d
WHERE w.Division_No=d.Division_No AND w.Case_ID=c.Case_ID AND w.SSN=p.SSN AND w.Branch_No=d.Branch_No AND d.Branch_No='$login_branch' AND c.Case_ID= $req";
}
else{
$sql2 = "SELECT c.Case_ID,`Case_Name`,`Division_name`,`Start_Date`,`End_Date`,p.SSN,`Name`
FROM `Person_Interest` AS p,`Works_On` AS w, `FBICase` AS c, `Divisions` AS d
WHERE w.Division_No=d.Division_No AND w.Case_ID=c.Case_ID AND w.SSN=p.SSN AND w.Branch_No=d.Branch_No AND d.Branch_No='$login_branch'";
}

$stmt2 = $mysqli->prepare($sql2);
$stmt2->execute();
$stmt2->bind_result($CaseID,$CaseName,$DivisionName,$Strtdate,$Enddate,$PSSN,$Pname); 
	
	while($stmt2->fetch())
   {
	   
echo "<tr>";
echo "<td>$CaseID</td>";
echo "<td>$CaseName</td>";
echo "<td>$DivisionName</td>";
echo "<td>$Strtdate</td>";
echo "<td>$Enddate</td>";
echo "<td>$PSSN</td>";
echo "<td>$Pname</td>";
	}
	
?>

<?php
$stmt->close();
$stmt2->close(); 
$mysqli->close();
?>

</table>
</body>
</html>