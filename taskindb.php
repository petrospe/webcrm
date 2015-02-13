<?php
session_start();
if (!isset($_SESSION['user']))
{
header("Location: login.php");
}
?>
<meta HTTP-EQUIV="REFRESH" content="0; url=tasks.php">
<?php
unset($_SESSION['aid']);

require "config.php";

//task table entries
$personid=mysql_real_escape_string($_POST['personid']); //This value has to be the same as in the HTML form file
$caseid=mysql_real_escape_string($_POST['caseid']); //This value has to be the same as in the HTML form file
$day=mysql_real_escape_string($_POST['day']); //This value has to be the same as in the HTML form file
$month=mysql_real_escape_string($_POST['month']); //This value has to be the same as in the HTML form file
$year=mysql_real_escape_string($_POST['year']); //This value has to be the same as in the HTML form file
$statusid=mysql_real_escape_string($_POST['statusid']); //This value has to be the same as in the HTML form file
$hour=mysql_real_escape_string($_POST['hour']); //This value has to be the same as in the HTML form file
$minute=mysql_real_escape_string($_POST['minute']); //This value has to be the same as in the HTML form file
$actionstartdate=$year.$month.$day.$hour.$minute.'00'; //Action start date
$userid=$_SESSION['userid'];
$durhour=mysql_real_escape_string($_POST['durhour']); //This value has to be the same as in the HTML form file
$durminute=mysql_real_escape_string($_POST['durminute']); //This value has to be the same as in the HTML form file
if($durhour == '00' && $durminute == '00')
{
$duration= '1980-01-01 02:00:00'; //Duration of action
}
if($durhour != '00' || $durminute != '00')
{
$duration='19800101'.$durhour.$durminute.'00'; //Duration of action
}
$descr=mysql_real_escape_string($_POST['descr']); //This value has to be the same as in the HTML form file
$notes=mysql_real_escape_string($_POST['notes']); //This value has to be the same as in the HTML form file
$extraaction1=mysql_real_escape_string($_POST['extraaction1']); //This value has to be the same as in the HTML form file
$extraaction2=mysql_real_escape_string($_POST['extraaction2']); //This value has to be the same as in the HTML form file
$extraaction3=mysql_real_escape_string($_POST['extraaction3']); //This value has to be the same as in the HTML form file
$extraaction4=mysql_real_escape_string($_POST['extraaction4']); //This value has to be the same as in the HTML form file
$extraaction5=mysql_real_escape_string($_POST['extraaction5']); //This value has to be the same as in the HTML form file
$extraaction6=mysql_real_escape_string($_POST['extraaction6']); //This value has to be the same as in the HTML form file
$extraaction7=mysql_real_escape_string($_POST['extraaction7']); //This value has to be the same as in the HTML form file
$extraaction8=mysql_real_escape_string($_POST['extraaction8']); //This value has to be the same as in the HTML form file
$extraaction9=mysql_real_escape_string($_POST['extraaction9']); //This value has to be the same as in the HTML form file
$extraaction10=mysql_real_escape_string($_POST['extraaction10']); //This value has to be the same as in the HTML form file
$actiontypeid=mysql_real_escape_string($_POST['actiontypeid']); //This value has to be the same as in the HTML form file
$extraaction1t=mysql_real_escape_string($_POST['extraaction1t']); //This value has to be the same as in the HTML form file
$extraaction2t=mysql_real_escape_string($_POST['extraaction2t']); //This value has to be the same as in the HTML form file
$extraaction3t=mysql_real_escape_string($_POST['extraaction3t']); //This value has to be the same as in the HTML form file
$extraaction4t=mysql_real_escape_string($_POST['extraaction4t']); //This value has to be the same as in the HTML form file
$extraaction5t=mysql_real_escape_string($_POST['extraaction5t']); //This value has to be the same as in the HTML form file
$extraaction6t=mysql_real_escape_string($_POST['extraaction6t']); //This value has to be the same as in the HTML form file
$extraaction7t=mysql_real_escape_string($_POST['extraaction7t']); //This value has to be the same as in the HTML form file
$extraaction8t=mysql_real_escape_string($_POST['extraaction8t']); //This value has to be the same as in the HTML form file
$extraaction9t=mysql_real_escape_string($_POST['extraaction9t']); //This value has to be the same as in the HTML form file
$extraaction10t=mysql_real_escape_string($_POST['extraaction10t']); //This value has to be the same as in the HTML form file

$entryid=md5(uniqid()); // a random 32 digits code is generated

// check for an empty string and display a message.
if ($descr  == "" && $actiontypeid == "")
  {
  echo "<p><a href='javascript:' onclick='history.go(-1); return false' style='text-decoration: none;'>Please enter a Task Description or Action Type ...</a></p>";
  exit;
  }

// check for an empty string and display a message.
if ($personid  == "")
  {
  echo "<p><a href='javascript:' onclick='history.go(-1); return false' style='text-decoration: none;'>Please enter a Person or Matter Name ...</a></p>";
  exit;
  }

//NULL Task Description with NO NULL Action Type
if($descr == "" && $actiontypeid != "")
 {
if($personid ==""  && $caseid != "")
{
$sql1=mysql_query("SELECT descr as proceduredescr FROM proceduretypes WHERE id = $actiontypeid") or die("SELECT procedurestypes Error: ".mysql_error());
$row = mysql_fetch_array($sql1);

$proceduredescr=$row['proceduredescr'];

$sql2=mysql_query("INSERT INTO case2action (descr, statusid, userid, caseid, procedureid, proceduretypeid, actiontypeid, actionstartdate, duration, notes, entryid) VALUES ('$proceduredescr', $statusid, $userid, $caseid,1, $actiontypeid, 1, '$actionstartdate', '$duration', '$notes', '$entryid')") or die("INSERT case2action Error: ".mysql_error());
}
if($caseid == "" && $personid != "")
{
$sql1=mysql_query("SELECT descr as proceduredescr FROM proceduretypes WHERE id = $actiontypeid") or die("SELECT procedurestypes Error: ".mysql_error());
$row = mysql_fetch_array($sql1);

$proceduredescr=$row['proceduredescr'];

$sql2=mysql_query("INSERT INTO case2action (descr, statusid, userid, personid, procedureid, proceduretypeid, actiontypeid, actionstartdate, duration, notes, entryid) VALUES ('$proceduredescr', $statusid, $userid, $personid,1, $actiontypeid, 1, '$actionstartdate', '$duration', '$notes', '$entryid')") or die("INSERT case2action Error: ".mysql_error());
}
if($personid == "" && $caseid == "")
{
$sql1=mysql_query("SELECT descr as proceduredescr FROM proceduretypes WHERE id = $actiontypeid") or die("SELECT procedurestypes Error: ".mysql_error());
$row = mysql_fetch_array($sql1);

$proceduredescr=$row['proceduredescr'];

$sql2=mysql_query("INSERT INTO case2action (descr, statusid, userid, procedureid, proceduretypeid, actiontypeid, actionstartdate, duration, notes, entryid) VALUES ('$proceduredescr', $statusid, $userid,1, $actiontypeid, 1, '$actionstartdate', '$duration', '$notes', '$entryid')") or die("INSERT case2action Error: ".mysql_error());
}
if($personid != "" && $caseid != "")
{
$sql1=mysql_query("SELECT descr as proceduredescr FROM proceduretypes WHERE id = $actiontypeid") or die("SELECT procedurestypes Error: ".mysql_error());
$row = mysql_fetch_array($sql1);

$proceduredescr=$row['proceduredescr'];

$sql2=mysql_query("INSERT INTO case2action (descr, statusid, userid, caseid, procedureid, proceduretypeid, actiontypeid, actionstartdate, duration, notes, entryid) VALUES ('$proceduredescr', $statusid, $userid, $caseid,1, $actiontypeid, 1, '$actionstartdate', '$duration', '$notes', '$entryid')") or die("INSERT case2action Error: ".mysql_error());
}
 }

//NULL Action Type with NO NULL Task Description
if ($actiontypeid == "" && $descr != "")
 {
if($personid ==""  && $caseid != "")
{
$sql4=mysql_query("INSERT INTO case2action (descr, statusid, userid, caseid, procedureid, actiontypeid, actionstartdate, duration, notes, entryid) VALUES ('$descr', $statusid, $userid, $caseid,1, 1, '$actionstartdate', '$duration', '$notes', '$entryid')") or die("INSERT case2action Error: ".mysql_error());
}
if($caseid == "" && $personid != "")
{
$sql4=mysql_query("INSERT INTO case2action (descr, statusid, userid, personid, procedureid, actiontypeid, actionstartdate, duration, notes, entryid) VALUES ('$descr', $statusid, $userid, $personid,1,1, '$actionstartdate', '$duration', '$notes', '$entryid')") or die("INSERT case2action Error: ".mysql_error());
}
if($personid == "" && $caseid == "")
{
$sql4=mysql_query("INSERT INTO case2action (descr, statusid, userid, procedureid, actiontypeid, actionstartdate, duration, notes, entryid) VALUES ('$descr', $statusid, $userid,1, 1, '$actionstartdate', '$duration', '$notes', '$entryid')") or die("INSERT case2action Error: ".mysql_error());
}
if($personid != "" && $caseid != "")
{
$sql4=mysql_query("INSERT INTO case2action (descr, statusid, userid, caseid, procedureid, actiontypeid, actionstartdate, duration, notes, entryid) VALUES ('$descr', $statusid, $userid, $caseid,1, 1, '$actionstartdate', '$duration', '$notes', '$entryid')") or die("INSERT case2action Error: ".mysql_error());
}
 }

//NO NULL Action Type with NO NULL Task Description
if ($actiontypeid != "" && $descr != "")
 {
if($personid ==""  && $caseid != "")
{
$sql5=mysql_query("INSERT INTO case2action (descr, statusid, userid, caseid, procedureid, proceduretypeid, actiontypeid, actionstartdate, duration, notes, entryid) VALUES ('$descr', $statusid, $userid, $caseid,1, $actiontypeid, 1, '$actionstartdate', '$duration', '$notes', '$entryid')") or die("INSERT case2action Error: ".mysql_error());
}
if($caseid == "" && $personid != "")
{
$sql5=mysql_query("INSERT INTO case2action (descr, statusid, userid, personid, procedureid, proceduretypeid, actiontypeid, actionstartdate, duration, notes, entryid) VALUES ('$descr', $statusid, $userid, $personid, 1, $actiontypeid, 1, '$actionstartdate', '$duration', '$notes', '$entryid')") or die("INSERT case2action Error: ".mysql_error());
}
if($personid == "" && $caseid == "")
{
$sql5=mysql_query("INSERT INTO case2action (descr, statusid, userid, procedureid, proceduretypeid, actiontypeid, actionstartdate, duration, notes, entryid) VALUES ('$descr', $statusid, $userid,1, $actiontypeid, 1, '$actionstartdate', '$duration', '$notes', '$entryid')") or die("INSERT case2action Error: ".mysql_error());
}
if($personid != "" && $caseid != "")
{
$sql5=mysql_query("INSERT INTO case2action (descr, statusid, userid, caseid, procedureid, proceduretypeid, actiontypeid, actionstartdate, duration, notes, entryid) VALUES ('$descr', $statusid, $userid, $caseid, 1, $actiontypeid, 1, '$actionstartdate', '$duration', '$notes', '$entryid')") or die("INSERT case2action Error: ".mysql_error());
}
 }

//Update task if exist extra fields
$tid=mysql_insert_id();

if($extraaction1 != "")
{
$sql31=mysql_query("UPDATE case2action set extraaction1 = '$extraaction1' WHERE id = '$tid'")  or die("UPDATE extraaction1 Error: ".mysql_error());
}
if($extraaction1t != "" && $extraaction1 == "")
{
$sql32=mysql_query("UPDATE case2action set extraaction1 = '$extraaction1t' WHERE id = '$tid'")  or die("UPDATE extraaction1 Error: ".mysql_error());
}
if($extraaction2 != "")
{
$sql33=mysql_query("UPDATE case2action set extraaction2 = '$extraaction2' WHERE id = '$tid'")  or die("UPDATE extraaction2 Error: ".mysql_error());
}
if($extraaction2t != "" && $extraaction2 == "")
{
$sql34=mysql_query("UPDATE case2action set extraaction2 = '$extraaction2t' WHERE id = '$tid'")  or die("UPDATE extraaction1 Error: ".mysql_error());
}
if($extraaction3 != "")
{
$sql35=mysql_query("UPDATE case2action set extraaction3 = '$extraaction3' WHERE id = '$tid'")  or die("UPDATE extraaction3 Error: ".mysql_error());
}
if($extraaction3t != "" && $extraaction3 == "")
{
$sql394=mysql_query("UPDATE case2action set extraaction3 = '$extraaction3t' WHERE id = '$tid'")  or die("UPDATE extraaction3 Error: ".mysql_error());
}
if($extraaction4 != "")
{
$sql36=mysql_query("UPDATE case2action set extraaction4 = '$extraaction4' WHERE id = '$tid'")  or die("UPDATE extraaction4 Error: ".mysql_error());
}
if($extraaction4t != "" && $extraaction4 == "")
{
$sql395=mysql_query("UPDATE case2action set extraaction4 = '$extraaction4t' WHERE id = '$tid'")  or die("UPDATE extraaction4 Error: ".mysql_error());
}
if($extraaction5 != "")
{
$sql37=mysql_query("UPDATE case2action set extraaction5 = '$extraaction5' WHERE id = '$tid'")  or die("UPDATE extraaction5 Error: ".mysql_error());
}
if($extraaction5t != "" && $extraaction1 == "")
{
$sql396=mysql_query("UPDATE case2action set extraaction5 = '$extraaction5t' WHERE id = '$tid'")  or die("UPDATE extraaction5 Error: ".mysql_error());
}
if($extraaction6 != "")
{
$sql38=mysql_query("UPDATE case2action set extraaction6 = '$extraaction6' WHERE id = '$tid'")  or die("UPDATE extraaction6 Error: ".mysql_error());
}
if($extraaction6t != "" && $extraaction6 == "")
{
$sql397=mysql_query("UPDATE case2action set extraaction6 = '$extraaction6t' WHERE id = '$tid'")  or die("UPDATE extraaction6 Error: ".mysql_error());
}
if($extraaction7 != "")
{
$sql390=mysql_query("UPDATE case2action set extraaction7 = '$extraaction7' WHERE id = '$tid'")  or die("UPDATE extraaction7 Error: ".mysql_error());
}
if($extraaction7t != "" && $extraaction7 == "")
{
$sql398=mysql_query("UPDATE case2action set extraaction7 = '$extraaction7t' WHERE id = '$tid'")  or die("UPDATE extraaction7 Error: ".mysql_error());
}
if($extraaction8 != "")
{
$sql391=mysql_query("UPDATE case2action set extraaction8 = '$extraaction8' WHERE id = '$tid'")  or die("UPDATE extraaction8 Error: ".mysql_error());
}
if($extraaction8t != "" && $extraaction8 == "")
{
$sql399=mysql_query("UPDATE case2action set extraaction8 = '$extraaction8t' WHERE id = '$tid'")  or die("UPDATE extraaction8 Error: ".mysql_error());
}
if($extraaction9 != "")
{
$sql392=mysql_query("UPDATE case2action set extraaction9 = '$extraaction9' WHERE id = '$tid'")  or die("UPDATE extraaction9 Error: ".mysql_error());
}
if($extraaction9t != "" && $extraaction9 == "")
{
$sql300=mysql_query("UPDATE case2action set extraaction9 = '$extraaction9t' WHERE id = '$tid'")  or die("UPDATE extraaction9 Error: ".mysql_error());
}
if($extraaction10 != "")
{
$sql393=mysql_query("UPDATE case2action set extraaction10 = '$extraaction10' WHERE id = '$tid'")  or die("UPDATE extraaction10 Error: ".mysql_error());
}
if($extraaction10t != "" && $extraaction10 == "")
{
$sql301=mysql_query("UPDATE case2action set extraaction10 = '$extraaction10t' WHERE id = '$tid'")  or die("UPDATE extraaction10 Error: ".mysql_error());
}
echo "The form data was successfully added to your database.";
mysql_close();
?>