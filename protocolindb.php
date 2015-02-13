<?php
session_start();
if (!isset($_SESSION['user']))
{
header("Location: login.php");
}
?>
<meta HTTP-EQUIV="REFRESH" content="0; url=protocol.php">
<?php

require "config.php";

//task table entries
$fromid=mysql_real_escape_string($_POST['personidfrom']); //This value has to be the same as in the HTML form file
$toid=mysql_real_escape_string($_POST['personidto']); //This value has to be the same as in the HTML form file
$caseid=mysql_real_escape_string($_POST['caseid']); //This value has to be the same as in the HTML form file
$day=mysql_real_escape_string($_POST['fday']); //This value has to be the same as in the HTML form file
$month=mysql_real_escape_string($_POST['fmonth']); //This value has to be the same as in the HTML form file
$year=mysql_real_escape_string($_POST['fyear']); //This value has to be the same as in the HTML form file
$hour=mysql_real_escape_string($_POST['hour']); //This value has to be the same as in the HTML form file
$minute=mysql_real_escape_string($_POST['minute']); //This value has to be the same as in the HTML form file
$actionstartdate=$year.$month.$day.$hour.$minute.'00'; //Action start date
$userid=$_SESSION['userid'];
$sendtypeid=mysql_real_escape_string($_POST['sendtypeid']); //This value has to be the same as in the HTML form file
$notes=mysql_real_escape_string($_POST['notes']); //This value has to be the same as in the HTML form file
$pinout=mysql_real_escape_string($_POST['pinout']); //This value has to be the same as in the HTML form file
$entryid=md5(uniqid()); // a random 32 digits code is generated

$descr=mysql_real_escape_string($_POST['descr']); //This value has to be the same as in the HTML form file
$aacode=mysql_real_escape_string($_POST['aacode']); //This value has to be the same as in the HTML form file

//Insert incoming protocol query
$sql=mysql_query("INSERT INTO case2action (descr, userid, caseid, actiontypeid, actionstartdate, notes, entryid, fromid, toid, sendtypeid, pinout, aacode) VALUES ('$descr','$userid','$caseid',6,'$actionstartdate','$notes','$entryid','$fromid','$toid','$sendtypeid','$pinout','$aacode')") or die("INSERT case2action Error: ".mysql_error());

echo "The form data was successfully added to your database.";
mysql_close();
?>