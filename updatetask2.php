<?php
session_start();
if (!isset($_SESSION['user']))
{
header("Location: login.php");
}
?>
<?php
session_start(b);
$_SESSION['bill']; // 5
?>
<?php
$billing = $_SESSION['bill'];

$status=$_POST['statusid'];
$day=$_POST['day'];
$month=$_POST['month'];
$year=$_POST['year'];
$hour=$_POST['hour'];
$minute=$_POST['minute'];
$actionstartdate=$year.$month.$day.$hour.$minute.'00'; //Action start date
$durhour=$_POST['dhour'];
$durminute=$_POST['dminute'];
$duration='19800101'.$durhour.$durminute.'00'; //Duration of action
$Description=$_POST['descr'];
$Notes=$_POST['Notes'];
$Code=$_POST['Code'];
$officeexptypeid=$_POST['actiontypeid'];

//extra action fields
$extraaction1=$_POST['extraaction1']; //This value has to be the same as in the HTML form file
$extraaction2=$_POST['extraaction2']; //This value has to be the same as in the HTML form file
$extraaction3=$_POST['extraaction3']; //This value has to be the same as in the HTML form file
$extraaction4=$_POST['extraaction4']; //This value has to be the same as in the HTML form file
$extraaction5=$_POST['extraaction5']; //This value has to be the same as in the HTML form file
$extraaction6=$_POST['extraaction6']; //This value has to be the same as in the HTML form file
$extraaction7=$_POST['extraaction7']; //This value has to be the same as in the HTML form file
$extraaction8=$_POST['extraaction8']; //This value has to be the same as in the HTML form file
$extraaction9=$_POST['extraaction9']; //This value has to be the same as in the HTML form file
$extraaction10=$_POST['extraaction10']; //This value has to be the same as in the HTML form file
$extraaction1t=$_POST['extraaction1t']; //This value has to be the same as in the HTML form file
$extraaction2t=$_POST['extraaction2t']; //This value has to be the same as in the HTML form file
$extraaction3t=$_POST['extraaction3t']; //This value has to be the same as in the HTML form file
$extraaction4t=$_POST['extraaction4t']; //This value has to be the same as in the HTML form file
$extraaction5t=$_POST['extraaction5t']; //This value has to be the same as in the HTML form file
$extraaction6t=$_POST['extraaction6t']; //This value has to be the same as in the HTML form file
$extraaction7t=$_POST['extraaction7t']; //This value has to be the same as in the HTML form file
$extraaction8t=$_POST['extraaction8t']; //This value has to be the same as in the HTML form file
$extraaction9t=$_POST['extraaction9t']; //This value has to be the same as in the HTML form file
$extraaction10t=$_POST['extraaction10t']; //This value has to be the same as in the HTML form file

require "config.php";
//User Permissions

$access=mysql_result($permission, 18);
if($access != "1")
{
echo "<p><a href='#' onClick='history.go(-1);' style='text-decoration:none'>Not permitted</a></p>";
exit;
}

if ($billing == "5")
{header('Location:billing.php');
unset($_SESSION['bill']);}

if ($billing == "")
{header('Location:tasks.php');
unset($_SESSION['bill']);}

unset($_SESSION['aid']);

$result = mysql_query( "SELECT ca.descr as caname, ca.proceduretypeid as Typeid, pt.descr as Type, ca.statusid as statusid, date_format(ca.actionstartdate,'%d') as taday, date_format(ca.actionstartdate,'%m') as tamonth, date_format(ca.actionstartdate,'%Y') as tayear, date_format(ca.actionstartdate,'%H') as tahour, date_format(ca.actionstartdate,'%i') as taminute, date_format(ca.duration,'%H') as duhour, date_format(ca.duration,'%i') as duminute, ca.notes as notes, ca.officeexptypeid as officeexptypeid,
ca.extraaction1 as extra1, ca.extraaction2 as extra2, ca.extraaction3 as extra3, ca.extraaction4 as extra4, ca.extraaction5 as extra5, ca.extraaction6 as extra6, ca.extraaction7 as extra7, ca.extraaction8 as extra8, ca.extraaction9 as extra9, ca.extraaction10 as extra10
FROM case2action ca
left join proceduretypes pt on pt.id = ca.proceduretypeid
where ca.id = $Code")
or die("SELECT Error: ".mysql_error());
$row = mysql_fetch_array($result);

// check for an empty string and display a message.
if ($Description  == "" && $row['Type'] == "")
  {
  echo "<p>Please enter a Task Description or Action Type ...</p>";
  exit;
  }

if ($Description  == "" && $row['Type'] != "")
  {
$TDescr = $row['Type'];
$query=mysql_query("UPDATE case2action set descr = '$TDescr' WHERE id = $Code") or die("UPDATE1 Error: ".mysql_error());
  }

//check changed fields
if ($Description != $row['caname'] && $TDescr == "")
{
$query1=mysql_query("UPDATE case2action set descr = '$Description' WHERE id = $Code") or die("UPDATE1 Error: ".mysql_error());
}
if ($status != $row['statusid'])
{
$query2=mysql_query("UPDATE case2action set statusid = $status WHERE id = $Code") or die("UPDATE2 Error: ".mysql_error());
}
if ($day != $row['taday'] || $month != $row['tamonth'] || $year != $row['tayear'] || $hour != $row['tahour'] || $minute != $row['taminute'])
{
$query3=mysql_query("UPDATE case2action set actionstartdate =  '$actionstartdate' WHERE id = $Code") or die("UPDATE3 Error: ".mysql_error());
}
if ($durhour != $row['duhour'] || $durminute != $row['duminute'])
{
$query4=mysql_query("UPDATE case2action set duration = '$duration' WHERE id = $Code") or die("UPDATE4 Error: ".mysql_error());
}
if ($Notes != $row['notes'])
{
$query5=mysql_query("UPDATE case2action set notes = '$Notes' WHERE id = $Code") or die("UPDATE1 Error: ".mysql_error());
}
if ($officeexptypeid != $row['officeexptypeid'])
{
$query5=mysql_query("UPDATE case2action set officeexptypeid = '$officeexptypeid' WHERE id = $Code") or die("UPDATE1 Error: ".mysql_error());
}

//Update task if exist extra fields

if($extraaction1 != $row['extra1'] && $extraaction1 != "")
{
$sql1=mysql_query("UPDATE case2action set extraaction1 = '$extraaction1' WHERE id = $Code")  or die("UPDATE extraaction1 Error: ".mysql_error());
}
if($extraaction1t !=  $row['extra1'] && $extraaction1 == "")
{
$sql2=mysql_query("UPDATE case2action set extraaction1 = '$extraaction1t' WHERE id = $Code")  or die("UPDATE extraaction1 Error: ".mysql_error());
}
if($extraaction2 !=  $row['extra2'] && $extraaction2 != "")
{
$sql3=mysql_query("UPDATE case2action set extraaction2 = '$extraaction2' WHERE id = $Code")  or die("UPDATE extraaction2 Error: ".mysql_error());
}
if($extraaction2t != $row['extra2'] && $extraaction2 == "")
{
$sql4=mysql_query("UPDATE case2action set extraaction2 = '$extraaction2t' WHERE id = $Code")  or die("UPDATE extraaction2 Error: ".mysql_error());
}
if($extraaction3 !=  $row['extra3'] && $extraaction3 != "")
{
$sql5=mysql_query("UPDATE case2action set extraaction3 = '$extraaction3' WHERE id = $Code")  or die("UPDATE extraaction3 Error: ".mysql_error());
}
if($extraaction3t != $row['extra3'] && $extraaction3 == "")
{
$sql51=mysql_query("UPDATE case2action set extraaction3 = '$extraaction3t' WHERE id = $Code")  or die("UPDATE extraaction3 Error: ".mysql_error());
}
if($extraaction4 !=  $row['extra4'] && $extraaction4 != "")
{
$sql6=mysql_query("UPDATE case2action set extraaction4 = '$extraaction4' WHERE id = $Code")  or die("UPDATE extraaction4 Error: ".mysql_error());
}
if($extraaction4t != $row['extra4'] && $extraaction4 == "")
{
$sql61=mysql_query("UPDATE case2action set extraaction4 = '$extraaction4t' WHERE id = $Code")  or die("UPDATE extraaction4 Error: ".mysql_error());
}

if($extraaction5 != $row['extra5'] && $extraaction5 != "")
{
$sql7=mysql_query("UPDATE case2action set extraaction5 = '$extraaction5' WHERE id = $Code")  or die("UPDATE extraaction5 Error: ".mysql_error());
}
if($extraaction5t != $row['extra5'] && $extraaction5 == "")
{
$sql71=mysql_query("UPDATE case2action set extraaction5 = '$extraaction5t' WHERE id = $Code")  or die("UPDATE extraaction5 Error: ".mysql_error());
}
if($extraaction6 != $row['extra6'] && $extraaction6 != "")
{
$sql8=mysql_query("UPDATE case2action set extraaction6 = '$extraaction6' WHERE id = $Code")  or die("UPDATE extraaction6 Error: ".mysql_error());
}
if($extraaction6t != $row['extra6'] && $extraaction6 == "")
{
$sql81=mysql_query("UPDATE case2action set extraaction6 = '$extraaction6t' WHERE id = $Code")  or die("UPDATE extraaction6 Error: ".mysql_error());
}
if($extraaction7 !=  $row['extra7'] && $extraaction7 != "")
{
$sql9=mysql_query("UPDATE case2action set extraaction7 = '$extraaction7' WHERE id = $Code")  or die("UPDATE extraaction7 Error: ".mysql_error());
}
if($extraaction7t != $row['extra7'] && $extraaction7 == "")
{
$sql91=mysql_query("UPDATE case2action set extraaction7 = '$extraaction7t' WHERE id = $Code")  or die("UPDATE extraaction7 Error: ".mysql_error());
}
if($extraaction8 !=  $row['extra8'] && $extraaction8 != "")
{
$sql92=mysql_query("UPDATE case2action set extraaction8 = '$extraaction8' WHERE id = $Code")  or die("UPDATE extraaction8 Error: ".mysql_error());
}
if($extraaction8t != $row['extra8'] && $extraaction8 == "")
{
$sql93=mysql_query("UPDATE case2action set extraaction8 = '$extraaction8t' WHERE id = $Code")  or die("UPDATE extraaction8 Error: ".mysql_error());
}
if($extraaction9 !=  $row['extra9'] && $extraaction9 != "")
{
$sql10=mysql_query("UPDATE case2action set extraaction9 = '$extraaction9' WHERE id = $Code")  or die("UPDATE extraaction9 Error: ".mysql_error());
}
if($extraaction9t != $row['extra9'] && $extraaction9 == "")
{
$sql101=mysql_query("UPDATE case2action set extraaction9 = '$extraaction9t' WHERE id = $Code")  or die("UPDATE extraaction9 Error: ".mysql_error());
}
if($extraaction10 !=  $row['extra10'] && $extraaction10 != "")
{
$sql11=mysql_query("UPDATE case2action set extraaction10 = '$extraaction10' WHERE id = $Code")  or die("UPDATE extraaction10 Error: ".mysql_error());
}
if($extraaction10t != $row['extra10'] && $extraaction10 == "")
{
$sql111=mysql_query("UPDATE case2action set extraaction10 = '$extraaction10t' WHERE id = $Code")  or die("UPDATE extraaction10 Error: ".mysql_error());
}

echo "The data was successfully updated in your database.";
mysql_close();
exit;
?>