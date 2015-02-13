<?php
session_start();
if (!isset($_SESSION['user']))
{
header("Location: login.php");
}
?>
<meta HTTP-EQUIV="REFRESH" content="0; url=billing.php">
<?php

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
$expencedate=$year.$month.$day.$hour.$minute.'00'; //Action start date
$userid=$_SESSION['userid'];
$descr=mysql_real_escape_string($_POST['descr']); //This value has to be the same as in the HTML form file
$notes=mysql_real_escape_string($_POST['notes']); //This value has to be the same as in the HTML form file
$cost=mysql_real_escape_string($_POST['cost']); //This value has to be the same as in the HTML form file

$entryid=md5(uniqid()); // a random 32 digits code is generated

// check for an empty string and display a message.
if ($personid  == "" && $caseid == "")
  {
  echo "<p><a href='insertexpense.php' style='text-decoration: none;'>Please enter Person or Matter ...</a></p>";
  exit;
  }

if ($cost == "")
  {
  echo "<p><a href='insertexpense.php' style='text-decoration: none;'>Please enter a value cost ...</a></p>";
  exit;
  }

if($caseid == "")
{
$sql=mysql_query("INSERT INTO case2action (descr, statusid, userid, personid, procedureid, actiontypeid, actionstartdate, notes, cost, entryid) VALUES ('$descr', $statusid, $userid, $personid,1, 2, '$expencedate', '$notes', $cost, '$entryid')") or die("INSERT case2action Error: ".mysql_error());
}
else
if($caseid != "")
{
$sql=mysql_query("INSERT INTO case2action (descr, statusid, userid, caseid, procedureid, actiontypeid, actionstartdate, notes, cost, entryid) VALUES ('$descr', $statusid, $userid, $caseid,1, 2, '$expencedate', '$notes', $cost, '$entryid')") or die("INSERT case2action Error: ".mysql_error());
}

echo "The form data was successfully added to your database.";
mysql_close();
?>