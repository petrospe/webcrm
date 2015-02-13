<?php
session_start();
if (!isset($_SESSION['user']))
{
header("Location: login.php");
}
?>
<meta HTTP-EQUIV="REFRESH" content="0; url=close.html">
<script language="javascript">
<!--
setTimeout("self.close();",10000)
//-->
</script>
<?php

require "config.php";

if(isset($_POST['attdescr']))
{
$attdescr = $_POST['attdescr'];
$attid = $_POST['attid'];

$query=mysql_query("UPDATE attributes SET descr = '$attdescr' WHERE id=$attid");

mysql_close();
}

if(isset($_POST['doydescr']))
{
$doydescr = $_POST['doydescr'];
$doyid = $_POST['doyid'];

$query=mysql_query("UPDATE doy SET descr = '$doydescr' WHERE id=$doyid");

mysql_close();
}

if(isset($_POST['mtdescr']))
{
$mtdescr = $_POST['mtdescr'];
$mtid = $_POST['mtid'];

$query=mysql_query("UPDATE casetype SET descr = '$mtdescr' WHERE id=$mtid");

mysql_close();
}

if(isset($_POST['dmdescr']))
{
$dmdescr = $_POST['dmdescr'];
$dmid = $_POST['dmid'];

$query=mysql_query("UPDATE thesaurus SET descr = '$dmdescr' WHERE id=$dmid");

mysql_close();
}
  
if(isset($_POST['catdescr']))
{
$catdescr = $_POST['catdescr'];
$catid = $_POST['catid'];

$query=mysql_query("UPDATE categories SET descr = '$catdescr' WHERE id=$catid");

mysql_close();
}
  
if(isset($_POST['itemdescr']))
{
$itemdescr = $_POST['itemdescr'];
$itemid = $_POST['itemid'];

$query=mysql_query("UPDATE courts SET descr = '$itemdescr' WHERE id=$itemid");

mysql_close();
}
  
if(isset($_POST['stdescr']))
{
$stdescr = $_POST['stdescr'];
$stid = $_POST['stid'];

$query=mysql_query("UPDATE status SET descr = '$stdescr' WHERE id=$stid");

mysql_close();
}
  
if(isset($_POST['offexpdescr']))
{
$offexpdescr = $_POST['offexpdescr'];
$offexpid = $_POST['offexpid'];

$query=mysql_query("UPDATE officeexptype SET descr = '$offexpdescr' WHERE id=$offexpid");

mysql_close();
}

if(isset($_POST['doctypedescr']))
{
$doctypedescr = $_POST['doctypedescr'];
$doctypeid = $_POST['doctypeid'];

$query=mysql_query("UPDATE doctype SET descr = '$doctypedescr' WHERE id=$doctypeid");

mysql_close();
}
  
if(isset($_POST['sendtypedescr']))
{
$sendtypedescr = $_POST['sendtypedescr'];
$sendtypeid = $_POST['sendtypeid'];

$query=mysql_query("UPDATE sendtype SET descr = '$sendtypedescr' WHERE id=$sendtypeid");

mysql_close();
}
?>