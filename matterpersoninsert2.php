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

$id=$_POST['code'];
$personid=$_POST['personid'];
$personattribid=$_POST['attributeid'];

if($personid == '' || $personattribid =='')
{
echo"Missing Person or Attribute";
exit;
}

//insert to casetoperson
$sql2=mysql_query("INSERT INTO casetoperson (caseid,personid,attributeid) VALUES ('$id','$personid','$personattribid')") or die("INSERT casetoperson Error: ".mysql_error());

echo "The form data was successfully added to your database.";
?>
