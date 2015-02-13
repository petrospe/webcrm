<?php
session_start();
if (!isset($_SESSION['user']))
{
header("Location: matterperson.php");
}
?>
<meta HTTP-EQUIV="REFRESH" content="0; url=matters.php">
<?php
require "config.php";
//User Permissions

$access=mysql_result($permission, 12);
if($access != "1")
{
echo "<p><a href='#' onClick='history.go(-2);' style='text-decoration:none'>Not permitted</a></p>";
exit;
}

$casetopersonid=$_GET['ctpid'];

$query=("DELETE FROM casetoperson
WHERE id=$casetopersonid")
or die("DELETE Error: ".mysql_error());
$result=mysql_query($query);
$row=mysql_fetch_array($result);
$formVars = array();

echo "The data was successfully updated in your database.";
mysql_close();
?>