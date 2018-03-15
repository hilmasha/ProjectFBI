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
	<title>Other Intelligence</title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
<div id="profile">
<b id="welcome">Agencies Working With Branch: <i><?php echo $login_branch; ?></i></b>
<b id="logout"><a href="logout.php">Log Out</a></b>
<b id="previous"><a href="profile.php">Homepage</a></b>
</div>
<hr color="#FFFFFF" />

<div id="login" display="inline" margin="auto">
<form action="otherintel_all.php" method="post">
<label><strong><font color=#ABAB80>Active FBI Partners </strong></label>
<input name="orgsubmit" type="submit" id="loginsubmit" value=" View " size="20%">
</form>
</div>

<div id="login" display="inline">
<form action="otherintel_all.php" method="post">
<label><strong><font color=#ABAB80>Branch Partners </strong></label>
<input name="allorg" type="submit" id="loginsubmit" value=" View " size="20%">
</form>
</div>
<div style=" text-align: left; text-indent: 0px; padding: 0px 0px 0px 0px; margin: 0px 0px 0px 0px;">
<table id="forum" width="80%" border="1" align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC" style="border-color: #ABAB80; border-style: solid; background-color: #223C5F;">

 <thead>

  <tr>
   <th width="20%" align="center" bgcolor="#E6E6E6"><strong>Organization Name</strong></td>
   <th width="15%" align="center" bgcolor="#E6E6E6"><strong>Country</strong></td>
    <th width="10%" align="center" bgcolor="#E6E6E6"><strong>File #</strong></td>
	<th width="15%" align="center" bgcolor="#E6E6E6"><strong>Contact Name</strong></td>
   <th width="25%" align="center" bgcolor="#E6E6E6"><strong>Contact Email</strong></td>
   <th width="15%" align="center" bgcolor="#E6E6E6"><strong>Phone #</strong></td>
</tr>
</thead>
</div>

<?php
if(isset($_POST['orgsubmit'])){
	$sql ="select Distinct `Org_name`,`Country`,`File_no`,`Contact_Name`,`Email`,`Phone` from `Contact_Information` as ci ,`Share_information` AS s natural join `Other_Intelligence_Agencies` AS oia where s.`Org_id` in (Select `Org_id` from `Share_information`as s natural join `Other_Intelligence_Agencies` as oia Group by `Org_id`ORDER BY count(*) DESC)AND ci.`Org_id` = oia.`Org_id`";
	
}
elseif(isset($_POST['allorg'])){

$sql = "SELECT `Org_name`,`Country`,`File_no`,`Contact_Name`,`Email`,`Phone` 
	FROM `Other_Intelligence_Agencies`AS oia NATURAL JOIN `Contact_Information` as ci, `Share_information` as S
	where oia.Org_id = S.Org_id AND S.`Branch_no`='$login_branch' ";
}
	//$result=mysql_query($sql);
	$stmt = $mysqli->prepare($sql);
// Prepared statement, stage 2: execute
    $stmt->execute();
// Bind result variables 
    $stmt->bind_result($OrgName,$Country,$File_no,$ContactName,$Email,$Phone); 

	while($stmt->fetch())
   {
	   
echo "<tr>";
echo "<td>$OrgName</td>";
echo "<td>$Country</td>";
echo "<td>$File_no</td>";
echo "<td>$ContactName</td>";
echo "<td>$Email</td>";
echo "<td>$Phone</td>";
   }
?>

<?php
   $stmt->close();
   $mysqli->close();
  ?>
  </body>