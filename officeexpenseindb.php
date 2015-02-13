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
$officeexptype=mysql_real_escape_string($_POST['officeexptype']); //This value has to be the same as in the HTML form file
$day=mysql_real_escape_string($_POST['day']); //This value has to be the same as in the HTML form file
$month=mysql_real_escape_string($_POST['month']); //This value has to be the same as in the HTML form file
$year=mysql_real_escape_string($_POST['year']); //This value has to be the same as in the HTML form file
$statusid=mysql_real_escape_string($_POST['statusid']); //This value has to be the same as in the HTML form file
$hour=mysql_real_escape_string($_POST['hour']); //This value has to be the same as in the HTML form file
$minute=mysql_real_escape_string($_POST['minute']); //This value has to be the same as in the HTML form file
$expensedate=$year.$month.$day.$hour.$minute.'00'; //Action start date
$userid=$_SESSION['userid'];
$descr=mysql_real_escape_string($_POST['descr']); //This value has to be the same as in the HTML form file
$notes=mysql_real_escape_string($_POST['notes']); //This value has to be the same as in the HTML form file
$cost=mysql_real_escape_string($_POST['cost']); //This value has to be the same as in the HTML form file

$entryid=md5(uniqid()); // a random 32 digits code is generated

// check for an empty string and display a message.

if ($cost == "")
  {
  echo "<p><a href='insertofficeexpense.php' style='text-decoration: none;'>Please enter a value cost ...</a></p>";
  exit;
  }

if($officeexptype == "")
{
$sql=mysql_query("INSERT INTO case2action (descr, statusid, userid, procedureid, actiontypeid, actionstartdate, notes, cost, entryid) VALUES ('$descr', $statusid, $userid, 1, 4, '$expensedate', '$notes', $cost, '$entryid')") or die("INSERT case2action Error: ".mysql_error());
}
else
if($officeexptype != "")
{
$sql=mysql_query("INSERT INTO case2action (descr, statusid, userid, procedureid, actiontypeid, actionstartdate, notes, cost, entryid, officeexptypeid) VALUES ('$descr', $statusid, $userid,1, 4, '$expensedate', '$notes', $cost, '$entryid', '$officeexptype')") or die("INSERT case2action Error: ".mysql_error());
}

echo "The form data was successfully added to your database.";
mysql_close();
?>