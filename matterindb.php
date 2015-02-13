<?php
session_start();
if (!isset($_SESSION['user']))
{
header("Location: login.php");
}
?>
<meta HTTP-EQUIV="REFRESH" content="0; url=matters.php">
<?php

require "config.php";

//matter table entries
$prodescr=mysql_real_escape_string($_POST['descr']); //This value has to be the same as in the HTML form file
$thesaurus=mysql_real_escape_string($_POST['thesaurus']); //This value has to be the same as in the HTML form file
$descr=$prodescr.$thesaurus; // Matter Description
$SetType=mysql_real_escape_string($_POST['SetType']); //This value has to be the same as in the HTML form file
$opday=mysql_real_escape_string($_POST['day']); //This value has to be the same as in the HTML form file
$opmonth=mysql_real_escape_string($_POST['month']); //This value has to be the same as in the HTML form file
$opyear=mysql_real_escape_string($_POST['year']); //This value has to be the same as in the HTML form file
$opdate=$opyear.$opmonth.$opday; // Insert matter day
$clday=mysql_real_escape_string($_POST['cday']); //This value has to be the same as in the HTML form file
$clmonth=mysql_real_escape_string($_POST['cmonth']); //This value has to be the same as in the HTML form file
$clyear=mysql_real_escape_string($_POST['cyear']); //This value has to be the same as in the HTML form file
$cldate=$clyear.$clmonth.$clday; //Close matter day
$userid=$_SESSION['userid'];

//casetoperson table entries
$personid=mysql_real_escape_string($_POST['personid']); //This value has to be the same as in the HTML form file
$personattribid=mysql_real_escape_string($_POST['SetAttribute']); //This value has to be the same as in the HTML form file

//matternotes table entries
$notes=mysql_real_escape_string($_POST['notes']); //This value has to be the same as in the HTML form file

// check for an empty string and display a message.
if ($descr  == "")
  {
  echo "<p><a href='javascript:' onclick='history.go(-1); return false' style='text-decoration: none;'>Please enter a Matter Name ...</a></p>";
  exit;
  }

// check for an empty string and display a message.
if ($personid  == "")
  {
  echo "<p><a href='javascript:' onclick='history.go(-1); return false' style='text-decoration: none;'>Please enter a Person Name ...</a></p>";
  exit;
  }

// check for not null descr and thesaurus
if ($prodescr != "" && $thesaurus != "")
  {
$multidescr=$prodescr.' '.$thesaurus;

//insert to cases
$sql1=mysql_query("INSERT INTO cases (descr,opendate,closedate,userid,casetypeid) VALUES ('$multidescr','$opdate','$cldate','$userid','$SetType')") or die("INSERT cases Error: ".mysql_error()); /*contacts is the name of the MySQL table where the form data will be saved.
name and email are the respective table fields*/

$id=mysql_insert_id();

// check for close date.
if ($cldate == "")
  {
  $subquery=mysql_query("UPDATE cases SET isactive=1 WHERE id='$id'") or die("UPDATE cases Error: ".mysql_error());
  $secsubquery=mysql_query("UPDATE cases SET closedate=NULL WHERE id='$id'") or die("UPDATE cases Error: ".mysql_error());
  }

// check for empty personid
if ($personid !="")
  {
//insert to casetoperson
$sql2=mysql_query("INSERT INTO casetoperson (caseid,personid,attributeid) VALUES ('$id','$personid','$personattribid')") or die("INSERT casetoperson Error: ".mysql_error());
  }

// check for an empty string and display a message.
if ($notes == "")
  {
  echo "The form data was successfully added to your database. <a href='matters.php'>Back to Matter's table</a>";
  mysql_close();
  }

//second insert notes
$sql3=mysql_query("INSERT INTO casenotes (caseid, descr, insertdate, userid) VALUES ('$id','$notes',NOW(),'$userid')") or die("INSERT notes Error: ".mysql_error());

echo "The form data was successfully added to your database. <a href='matters.php'>Back to Matter's table</a>";
mysql_close();
  }

//insert to cases
$sql1=mysql_query("INSERT INTO cases (descr,opendate,closedate,userid,casetypeid) VALUES ('$descr','$opdate','$cldate','$userid','$SetType')") or die("INSERT cases Error: ".mysql_error()); /*contacts is the name of the MySQL table where the form data will be saved.
name and email are the respective table fields*/

$id=mysql_insert_id();

// check for close date.
if ($cldate == "")
  {
  $subquery=mysql_query("UPDATE cases SET isactive=1 WHERE id='$id'") or die("UPDATE cases Error: ".mysql_error());
  $secsubquery=mysql_query("UPDATE cases SET closedate=NULL WHERE id='$id'") or die("UPDATE cases Error: ".mysql_error());
  }

// check for empty personid
if ($personid !="")
  {
//insert to casetoperson
$sql2=mysql_query("INSERT INTO casetoperson (caseid,personid,attributeid) VALUES ('$id','$personid','$personattribid')") or die("INSERT casetoperson Error: ".mysql_error());
  }

// check for an empty string and display a message.
if ($notes == "")
  {
  echo "The form data was successfully added to your database. <a href='matters.php'>Back to Matter's table</a>";
  mysql_close();
  }

//second insert notes
$sql3=mysql_query("INSERT INTO casenotes (caseid, descr, insertdate, userid) VALUES ('$id','$notes',NOW(),'$userid')") or die("INSERT notes Error: ".mysql_error());

echo "The form data was successfully added to your database.";
mysql_close();
?>