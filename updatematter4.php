<?php
session_start();
if (!isset($_SESSION['user']))
{
header("Location: login.php");
}
?>
<meta HTTP-EQUIV="REFRESH" content="0; url=matters.php">
<?php

$Name=$_POST['Name'];
$thesaurus=$_POST['thesaurus'];
$mtypeid=$_POST['mtypeid'];
$opday=$_POST['opday'];
$opmonth=$_POST['opmonth'];
$opyear=$_POST['opyear'];
$opendate=$opyear.$opmonth.$opday;
$clday=$_POST['clday'];
$clmonth=$_POST['clmonth'];
$clyear=$_POST['clyear'];
$closedate=$clyear.$clmonth.$clday;
$Notes=$_POST['Notes'];

$Code=$_POST['Code'];
$entrypnid=md5(uniqid()); // a random 32 digits code is generated

//user
$userid=$_SESSION['userid'];

require "config.php";

$result = mysql_query( "SELECT c.descr as cname, c.casetypeid as Type,date_format(c.opendate,'%d') as oday, date_format(c.opendate,'%m') as omonth, date_format(c.opendate,'%Y') as oyear, date_format(c.closedate,'%d') as cday, date_format(c.closedate,'%m') as cmonth, date_format(c.closedate,'%Y') as cyear, cn.descr as cnotes
FROM cases c
left join casenotes cn on cn.caseid=c.id
where c.id = $Code")
or die("SELECT Error: ".mysql_error());
$row = mysql_fetch_array($result);

// check for not null Name and thesaurus
if ($thesaurus != "")
  {
$multidescr=$Name.' '.$thesaurus;

//check changed fields
if ($multidescr != $row['cname'])
{
$query1=mysql_query("UPDATE cases set descr = '$multidescr' WHERE id = $Code") or die("UPDATE1 Error: ".mysql_error());
}
if ($mtypeid != $row['Type'] && $mtypeid != "")
{
$query2=mysql_query("UPDATE cases set casetypeid = $mtypeid WHERE id = $Code") or die("UPDATE2 Error: ".mysql_error());
}
if ($opday != $row['oday'] || $opmonth != $row['omonth'] || $opyear != $row['oyear'])
{
$query3=mysql_query("UPDATE cases set opendate = '$opendate' WHERE id = $Code") or die("UPDATE3 Error: ".mysql_error());
}
if ($clday != $row['cday'] || $clmonth != $row['cmonth'] || $clyear != $row['cyear'])
{
$query4=mysql_query("UPDATE cases set closedate = '$closedate' WHERE id = $Code") or die("UPDATE4 Error: ".mysql_error());
}
// check for close date.
if ($closedate == "")
  {
  $subquery=mysql_query("UPDATE cases SET isactive=1 WHERE id='$Code'") or die("UPDATE cases Error: ".mysql_error());
  $secsubquery=mysql_query("UPDATE cases SET closedate=NULL WHERE id='$Code'") or die("UPDATE cases Error: ".mysql_error());
  }

if ($Notes == "" && $Notes != $row['cnotes'])
{
$query5d=mysql_query("DELETE from casenotes WHERE caseid = $Code") or die("DELETE5d Error: ".mysql_error());
}
if ($row['cnotes'] == "" && $Notes != $row['cnotes'])
{
$query5=mysql_query("INSERT into casenotes (descr, caseid, insertdate, userid) VALUES ('$Notes', $Code, NOW(), $userid)") or die("INSERT Error: ".mysql_error());
}
if ($Notes != $row['cnotes'] && $row['cnotes'] != "")
{
$query5a=mysql_query("UPDATE casenotes set descr = '$Notes' WHERE caseid = $Code") or die("UPDATE5a Error: ".mysql_error());
$query5b=mysql_query("UPDATE casenotes set insertdate = NOW() WHERE caseid = $Code") or die("UPDATE5b Error: ".mysql_error());
$query5c=mysql_query("UPDATE casenotes set userid = $userid WHERE caseid = $Code") or die("UPDATE5c Error: ".mysql_error());
}

echo "The data was successfully updated in your database.<a href='matters.php'>Back to Matter's table</a>";
mysql_close();
  }

//check changed fields
if ($Name != $row['cname'])
{
$query1=mysql_query("UPDATE cases set descr = '$Name' WHERE id = $Code") or die("UPDATE1 Error: ".mysql_error());
}
if ($mtypeid != $row['Type'] && $mtypeid != "")
{
$query2=mysql_query("UPDATE cases set casetypeid = $mtypeid WHERE id = $Code") or die("UPDATE2 Error: ".mysql_error());
}
if ($opday != $row['oday'] || $opmonth != $row['omonth'] || $opyear != $row['oyear'])
{
$query3=mysql_query("UPDATE cases set opendate = '$opendate' WHERE id = $Code") or die("UPDATE3 Error: ".mysql_error());
}
if ($clday != $row['cday'] || $clmonth != $row['cmonth'] || $clyear != $row['cyear'])
{
$query4=mysql_query("UPDATE cases set closedate = '$closedate' WHERE id = $Code") or die("UPDATE4 Error: ".mysql_error());
}

// check for close date.
if ($closedate == "")
  {
  $subquery=mysql_query("UPDATE cases SET isactive=1 WHERE id='$Code'") or die("UPDATE cases Error: ".mysql_error());
  $secsubquery=mysql_query("UPDATE cases SET closedate=NULL WHERE id='$Code'") or die("UPDATE cases Error: ".mysql_error());
  }

if ($Notes == "" && $Notes != $row['cnotes'])
{
$query5d=mysql_query("DELETE from casenotes WHERE caseid = $Code") or die("DELETE5d Error: ".mysql_error());
}
if ($row['cnotes'] == "" && $Notes != $row['cnotes'])
{
$query5=mysql_query("INSERT into casenotes (descr, caseid, insertdate, userid) VALUES ('$Notes', $Code, NOW(), $userid)") or die("INSERT Error: ".mysql_error());
}
if ($Notes != $row['cnotes'] && $row['cnotes'] != "")
{
$query5a=mysql_query("UPDATE casenotes set descr = '$Notes' WHERE caseid = $Code") or die("UPDATE5a Error: ".mysql_error());
$query5b=mysql_query("UPDATE casenotes set insertdate = NOW() WHERE caseid = $Code") or die("UPDATE5b Error: ".mysql_error());
$query5c=mysql_query("UPDATE casenotes set userid = $userid WHERE caseid = $Code") or die("UPDATE5c Error: ".mysql_error());
}

echo "The data was successfully updated in your database.";
mysql_close();
?>