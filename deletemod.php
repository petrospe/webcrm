<?php
session_start();
if (!isset($_SESSION['user']))
{
header("Location: login.php");
}
?> 
<html>
<meta HTTP-EQUIV="REFRESH" content="0; url=adminsettings.php">
<body>
<script language="javascript">
<!--
setTimeout("self.close();",10000)
//-->
</script>
<?php
error_reporting(E_ALL);
 ini_set("display_errors",1);

require "config.php";
//User Permissions

$access=mysql_result($permission, 42);
if($access != "1")
{
echo "<p>Not permitted</p>";
exit;
}

// Get the search variable from URL

if(isset($_GET['q']))
{
  $var = $_GET['q'] ;

$attributedeletion=mysql_query("DELETE FROM attributes WHERE id=$var");

echo "The entry was successfully DELETED from your database.";
mysql_close();
}

if(isset($_GET['p']))
{
  $var = $_GET['p'] ;

$doydeletion=mysql_query("DELETE FROM doy WHERE id=$var");

echo "The entry was successfully DELETED from your database.";
mysql_close();
}

if(isset($_GET['o']))
{
  $var = $_GET['o'] ;

$restoreperson=mysql_query("UPDATE person SET isdeleted=0 WHERE id=$var");

echo "The entry was successfully RESTORED in your database.";
mysql_close();
}

if(isset($_GET['n']))
{
  $var = $_GET['n'] ;
$personnotesdeletion=mysql_query("DELETE FROM personnotes WHERE personid=$var");
$persondeletion=mysql_query("DELETE FROM person WHERE id=$var");

echo "The entry was successfully DELETED from your database.";
mysql_close();
}

if(isset($_GET['m']))
{
  $var = $_GET['m'] ;

$mattertypedeletion=mysql_query("DELETE FROM casetype WHERE id=$var");

echo "The entry was successfully DELETED from your database.";
mysql_close();
}

if(isset($_GET['l']))
{
  $var = $_GET['l'] ;

$defaultmatterdeletion=mysql_query("DELETE FROM thesaurus WHERE id=$var");

echo "The entry was successfully DELETED from your database.";
mysql_close();
}

if(isset($_GET['k']))
{
  $var = $_GET['k'] ;

$restorematter=mysql_query("UPDATE cases SET isdeleted=0 WHERE id=$var");

echo "The entry was successfully RESTORED in your database.";
mysql_close();
}

if(isset($_GET['j']))
{
  $var = $_GET['j'] ;
$matternotesdeletion=mysql_query("DELETE FROM casenotes WHERE caseid=$var");
$casetopersondeletion=mysql_query("DELETE FROM casetoperson WHERE caseid=$var");
$casedeletion=mysql_query("DELETE FROM cases WHERE id=$var");

echo "The entry was successfully DELETED from your database.";
mysql_close();
}

if(isset($_GET['i']))
{
  $var = $_GET['i'] ;

$tasktypedeletion=mysql_query("DELETE FROM proceduretypes WHERE id=$var");

echo "The entry was successfully DELETED from your database.";
mysql_close();
}

if(isset($_GET['h']))
{
$var = $_GET['h'] ;
$permitiondelete=mysql_query("SELECT * FROM courts WHERE type=$var");
$num_rows = mysql_num_rows($permitiondelete);

  if($num_rows > "0")
{
mysql_close();
}
$categorydeletion=mysql_query("DELETE FROM categories WHERE id=$var");

echo "The entry was successfully DELETED from your database.";
mysql_close();
}
  
if(isset($_GET['g']))
{
  $var = $_GET['g'] ;

$itemdeletion=mysql_query("DELETE FROM courts WHERE id=$var");

echo "The entry was successfully DELETED from your database.";
mysql_close();
}
  
if(isset($_GET['f']))
{
  $var = $_GET['f'] ;

$statusdeletion=mysql_query("DELETE FROM status WHERE id=$var");

echo "The entry was successfully DELETED from your database.";
mysql_close();
}

if(isset($_GET['e']))
{
  $var = $_GET['e'] ;

$restoretask=mysql_query("UPDATE case2action SET isdeleted=0 WHERE id=$var");

echo "The entry was successfully RESTORED in your database.";
mysql_close();
}  

if(isset($_GET['d']))
{
  $var = $_GET['d'] ;

$taskdeletion=mysql_query("DELETE FROM case2action WHERE id=$var");

echo "The entry was successfully DELETED from your database.";
mysql_close();
}
  
if(isset($_GET['c']))
{
  $var = $_GET['c'] ;

$offexpdeletion=mysql_query("DELETE FROM officeexptype WHERE id=$var");

echo "The entry was successfully DELETED from your database.";
mysql_close();
}

if(isset($_GET['ea']))
{
  $var = $_GET['ea'] ;

$restorebilling=mysql_query("UPDATE case2action SET isdeleted=0 WHERE id=$var");

echo "The entry was successfully RESTORED in your database.";
mysql_close();
}  

if(isset($_GET['da']))
{
  $var = $_GET['da'] ;

$billingdeletion=mysql_query("DELETE FROM case2action WHERE id=$var");

echo "The entry was successfully DELETED from your database.";
mysql_close();
} 
 
if(isset($_GET['b']))
{
  $var = $_GET['b'] ;

$doctypedeletion=mysql_query("DELETE FROM doctype WHERE id=$var");

echo "The entry was successfully DELETED from your database.";
mysql_close();
}
  
if(isset($_GET['a']))
{
  $var = $_GET['a'] ;

$restoredocument=mysql_query("UPDATE document SET isdeleted=0 WHERE id=$var");

echo "The entry was successfully RESTORED in your database.";
mysql_close();
}  

if(isset($_GET['az']))
{
  $var = $_GET['az'] ;

$documentdeletion=mysql_query("DELETE FROM document WHERE id=$var");

echo "The entry was successfully DELETED from your database.";
mysql_close();
}
  
if(isset($_GET['ay']))
{
  $var = $_GET['ay'] ;

$sendtypedeletion=mysql_query("DELETE FROM sendtype WHERE id=$var");

echo "The entry was successfully DELETED from your database.";
mysql_close();
}
  
if(isset($_GET['ax']))
{
  $var = $_GET['ax'] ;

$restoreprotocol=mysql_query("UPDATE case2action SET isdeleted=0 WHERE id=$var");

echo "The entry was successfully RESTORED in your database.";
mysql_close();
}  

if(isset($_GET['aw']))
{
  $var = $_GET['aw'] ;

$protocoldeletion=mysql_query("DELETE FROM case2action WHERE id=$var");

echo "The entry was successfully DELETED from your database.";
mysql_close();
}
?>
</body>
</html>