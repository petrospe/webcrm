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
$typeid=@$_POST['typeid'];

require "config.php";

$sql1=mysql_query("UPDATE case2action set proceduretypeid=$typeid where id=$taskid") or die("UPDATE1 Error: ".mysql_error());

mysql_close();
?>
