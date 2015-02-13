<?php
session_start();
if (!isset($_SESSION['user']))
{
header("Location: login.php");
}
?>
<?php
session_start();
$_SESSION['taskid'];
?>
<meta HTTP-EQUIV="REFRESH" content="0; url=close.html">
<?php

$taskid=$_SESSION['taskid'];
$personid=$_POST['personid'];
$caseid=$_POST['caseid'];

require "config.php";

unset($_SESSION['taskid']);

//check if person and matter are null
if($personid == "" && $caseid == "")
{
header ("location: updatemattertask1.php");
}
else
//check if person is null
if($personid == "" && $caseid != "")
{
$sql1=mysql_query("UPDATE case2action set personid=NULL where id=$taskid") or die("UPDATE1 Error: ".mysql_error());
$sql2=mysql_query("UPDATE case2action set caseid=$caseid where id=$taskid") or die("UPDATE2 Error: ".mysql_error());
mysql_close();
}
else
//check if case and person is not null
if($personid != "" && $caseid != "")
{
$sql1=mysql_query("UPDATE case2action set personid=NULL where id=$taskid") or die("UPDATE1 Error: ".mysql_error());
$sql2=mysql_query("UPDATE case2action set caseid=$caseid where id=$taskid") or die("UPDATE2 Error: ".mysql_error());
mysql_close();
}
else
//check if case is null
if($personid != "" && $caseid == "")
{
$sql1=mysql_query("UPDATE case2action set caseid=NULL where id=$taskid") or die("UPDATE1 Error: ".mysql_error());
$sql2=mysql_query("UPDATE case2action set personid=$personid where id=$taskid") or die("UPDATE2 Error: ".mysql_error());
mysql_close();
}
?>