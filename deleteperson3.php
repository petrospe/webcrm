<?php
session_start();
if (!isset($_SESSION['user']))
{
header("Location: login.php");
}
?>
<html>
<meta HTTP-EQUIV="REFRESH" content="0; url=person.php">
<script language="javascript">
<!--
setTimeout("self.close();",10000)
//-->
</script>
<body>
<?php
require "config.php";

//User Permissions

$access=mysql_result($permission, 4);
if($access != "1")
{
echo "<p><a href='#' onClick='history.go(-1);' style='text-decoration:none'>Not permitted</a></p>";
exit;
}
  // Get the search variable from URL

  $var = $_GET['pid'] ;
  $userid = $_SESSION['userid'] ;


// check for an empty string and display a message.
if ($var == "")
  {
  echo "<p>Please enter a search...</p>";
  exit;
  }

//Check for associated matters, tasks, billings, files, protocols

$protocols = mysql_query("SELECT personid FROM case2action WHERE personid = $var and actiontypeid = 6");
$num_rows_protocols = mysql_num_rows($protocols);
if ($num_rows_protocols > "0")
{
echo "<p><a href='#' onClick='history.go(-1);' style='text-decoration:none'>This person has $num_rows_protocols associated protocols.</a></p>";
exit;
}

$files = mysql_query("SELECT personid FROM document WHERE personid = $var ");
$num_rows_files = mysql_num_rows($files);
if ($num_rows_files > "0")
{
echo "<p><a href='#' onClick='history.go(-1);' style='text-decoration:none'>This person has $num_rows_files associated files.</a></p>";
exit;
}

$expenses = mysql_query("SELECT personid FROM case2action WHERE personid = $var and actiontypeid in (2,3)");
$num_rows_expenses = mysql_num_rows($expenses);
if ($num_rows_expenses > "0")
{
echo "<p><a href='#' onClick='history.go(-1);' style='text-decoration:none'>This person has $num_rows_expenses associated expenses or incomes.</a></p>";
exit;
}

$tasks = mysql_query("SELECT personid FROM case2action WHERE personid = $var and actiontypeid = 1");
$num_rows_tasks = mysql_num_rows($tasks);
if ($num_rows_tasks > "0")
{
echo "<p><a href='#' onClick='history.go(-1);' style='text-decoration:none'>This person has $num_rows_tasks associated tasks.</a></p>";
exit;
}

$matters = mysql_query("SELECT personid FROM casetoperson WHERE personid = $var");
$num_rows_matters = mysql_num_rows($matters);
if ($num_rows_matters > "0")
{
echo "<p><a href='#' onClick='history.go(-1);' style='text-decoration:none'>This person has $num_rows_matters associated.</a></p>";
exit;
}

$result1 = mysql_query("UPDATE person set isdeleted = 1 where id = $var " ) or die("Error: ".mysql_error());
$result2 = mysql_query("UPDATE person set userdel = $userid where id = $var " ) or die("Error: ".mysql_error());
$result3 = mysql_query("UPDATE person set lastupdate = NOW() where id = $var " ) or die("Error: ".mysql_error());
$result3 = mysql_query("UPDATE person set datedel = NOW() where id = $var " ) or die("Error: ".mysql_error());

echo "The entry was successfully DELETED from your database.";
mysql_close();
?>
</body>
</html>