<?php
session_start();
if (!isset($_SESSION['user']))
{
header("Location: login.php");
}
?>
<meta HTTP-EQUIV="REFRESH" content="0; url=close.html">
<?php
$taskid=@$_POST['taskid'];
$cost=@$_POST['cost'];

require "config.php";

$sql1=mysql_query("UPDATE case2action set cost=$cost where id=$taskid") or die("UPDATE1 Error: ".mysql_error());

mysql_close();
?>