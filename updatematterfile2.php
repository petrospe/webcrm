<?php
session_start();
if (!isset($_SESSION['user']))
{
header("Location: login.php");
}
?>
<?php
session_start();
$_SESSION['fpid'];
?>
<meta HTTP-EQUIV="REFRESH" content="0; url=close.html">
<?php

$documentid=$_SESSION['fpid'];
$personid=$_POST['personid'];
$caseid=$_POST['caseid'];

require "config.php";

unset($_SESSION['taskid']);

//check if person and matter are null
if($personid == "" && $caseid == "")
{
header ("location: updatematterfile1.php");
mysql_close();
}
else
//check if person is null
if($caseid != "")
{
$sql1=mysql_query("UPDATE document set personid=NULL where id=$documentid") or die("UPDATE1 Error: ".mysql_error());
$sql2=mysql_query("UPDATE document set caseid=$caseid where id=$documentid") or die("UPDATE2 Error: ".mysql_error());
$sql3=mysql_query("UPDATE document set modifydate = NOW() WHERE id = $documentid") or die("UPDATE3 Error: ".mysql_error());
mysql_close();
}
else
//check if case is null
if($caseid == "")
{
$sql1=mysql_query("UPDATE document set caseid=NULL where id=$documentid") or die("UPDATE1 Error: ".mysql_error());
$sql2=mysql_query("UPDATE document set personid=$personid where id=$documentid") or die("UPDATE2 Error: ".mysql_error());
$sql3=mysql_query("UPDATE document set modifydate = NOW() WHERE id = $documentid") or die("UPDATE3 Error: ".mysql_error());
mysql_close();
}
?>