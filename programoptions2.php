<?php
session_start();
if (!isset($_SESSION['user']))
{
header("Location: login.php");
}
?>
<meta HTTP-EQUIV="REFRESH" content="0; url=myaccount.php">
<?php
  error_reporting(E_ALL);
  ini_set("display_errors",1);
  
require "config.php";

$programtitle=$_POST['programtitle']; //This value has to be the same as in the HTML form file
$officetitle=$_POST['officetitle']; //This value has to be the same as in the HTML form file
$officesubtitle=$_POST['officesubtitle']; //This value has to be the same as in the HTML form file
$officestreet=$_POST['officestreet']; //This value has to be the same as in the HTML form file
$officezipcode=$_POST['officezipcode']; //This value has to be the same as in the HTML form file
$officecity=$_POST['officecity']; //This value has to be the same as in the HTML form file
$officetime=$_POST['officetime']; //This value has to be the same as in the HTML form file
$officewhether=$_POST['officewhether']; //This value has to be the same as in the HTML form file

//compare statements
 $result = mysql_query( "SELECT programtitle,officetitle,officesubtitle,officestreet,officezipcode,officecity,SUBSTRING(officetime,95,7),
   SUBSTRING(officewhether,91,8) FROM settings WHERE id = 1") or die("SELECT Error: ".mysql_error());
$row = mysql_fetch_array($result);

if ($programtitle != $row['programtitle'])
{
mysql_query("UPDATE settings set programtitle = '$programtitle' WHERE id = 1") or die("UPDATE1 document Error: ".mysql_error());
}  
if ($officetitle != $row['officetitle'])
{
mysql_query("UPDATE settings set officetitle = '$officetitle' WHERE id = 1") or die("UPDATE2 document Error: ".mysql_error());
}  
if ($officesubtitle != $row['officesubtitle'])
{
mysql_query("UPDATE settings set officesubtitle = '$officesubtitle' WHERE id = 1") or die("UPDATE3 document Error: ".mysql_error());
}  
if ($officestreet != $row['officestreet'])
{
mysql_query("UPDATE settings set officestreet = '$officestreet' WHERE id = 1") or die("UPDATE4 document Error: ".mysql_error());
} 
if ($officezipcode != $row['officezipcode'])
{
mysql_query("UPDATE settings set officezipcode = '$officezipcode' WHERE id = 1") or die("UPDATE5 document Error: ".mysql_error());
}  
if ($officecity != $row['officecity'])
{
mysql_query("UPDATE settings set officecity = '$officecity' WHERE id = 1") or die("UPDATE6 document Error: ".mysql_error());
}
if ($officetime != $row['SUBSTRING(officetime,95,7)'])
{
mysql_query("UPDATE settings set officetime = REPLACE (officetime,SUBSTRING(officetime,95,7), '$officetime') WHERE id = 1") or die("UPDATE7 document Error: ".mysql_error());
}
if ($officewhether != $row['SUBSTRING(officewhether,91,8)'])
{
mysql_query("UPDATE settings set officewhether = REPLACE (officewhether,SUBSTRING(officewhether,91,8),'$officewhether') WHERE id = 1") or die("UPDATE8 document Error: ".mysql_error());
}

echo "The form data was successfully added to your database.";
?>



















