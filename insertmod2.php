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

$query=mysql_query("INSERT INTO attributes (descr) VALUES ('$attdescr')");

mysql_close();
}

if(isset($_POST['doydescr']))
{
$doydescr = $_POST['doydescr'];

$query=mysql_query("INSERT INTO doy (descr) VALUES ('$doydescr')");

mysql_close();
}

if(isset($_POST['mtidescr']))
{
$mtidescr = $_POST['mtidescr'];

$query=mysql_query("INSERT INTO casetype (descr) VALUES ('$mtidescr')");

mysql_close();
}

if(isset($_POST['dmidescr']))
{
$dmidescr = $_POST['dmidescr'];

$query=mysql_query("INSERT INTO thesaurus (descr) VALUES ('$dmidescr')");

mysql_close();

}
  
if(isset($_POST['catdescr']))
{
$catdescr = $_POST['catdescr'];

$query=mysql_query("INSERT INTO categories (descr) VALUES ('$catdescr')");

mysql_close();
}
  
if(isset($_POST['itemdescr']))
{
$itemdescr = $_POST['itemdescr'];
$catid = $_POST['catid'];
$query=mysql_query("INSERT INTO courts (descr, type) VALUES ('$itemdescr', '$catid')");

mysql_close();
}
  
if(isset($_POST['stdescr']))
{
$stdescr = $_POST['stdescr'];
  
$query=mysql_query("INSERT INTO status (descr) VALUES ('$stdescr')");
  
mysql_close();
}

if(isset($_POST['offexpdescr']))
{
$offexpdescr = $_POST['offexpdescr'];
  
$query=mysql_query("INSERT INTO officeexptype (descr) VALUES ('$offexpdescr')");
  
mysql_close();
}
  
if(isset($_POST['doctypedescr']))
{
$doctypedescr = $_POST['doctypedescr'];
  
$query=mysql_query("INSERT INTO doctype (descr) VALUES ('$doctypedescr')");
  
mysql_close();
}

if(isset($_POST['sendtypedescr']))
{
$sendtypedescr = $_POST['sendtypedescr'];
  
$query=mysql_query("INSERT INTO sendtype (descr) VALUES ('$sendtypedescr')");
  
mysql_close();
}
?>