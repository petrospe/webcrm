<?php
session_start();
if (!isset($_SESSION['user']))
{
header("Location: login.php");
}
?> 
<html>
<meta HTTP-EQUIV="REFRESH" content="0; url=billing.php">
<body>
<script language="javascript">
<!--
setTimeout("self.close();",10000)
//-->
</script>
<?php
require "config.php";
//User Permissions

$access=mysql_result($permission, 29);
if($access != "1")
{
echo "<p><a href='#' onClick='history.go(-1);' style='text-decoration:none'>Not permitted</a></p>";
exit;
}

// Get the search variable from URL

  $var = @$_GET['q'] ;

// check for an empty string and display a message.
if ($var == "")
  {
  echo "<p>Please enter a search...</p>";
  exit;
  }

$query = mysql_query("SELECT actiontypeid as type from case2action where id = $var ") or die("Error: ".mysql_error());
$row = mysql_fetch_array($query);

if($row['type'] != '1')
{ 
$result1 = mysql_query("UPDATE case2action set isdeleted = 1 where id = $var " ) or die("Error: ".mysql_error());
$result2 = mysql_query("UPDATE case2action set userdel = $userid where id = $var " ) or die("Error: ".mysql_error());
$result3 = mysql_query("UPDATE case2action set datedel = NOW() where id = $var " ) or die("Error: ".mysql_error());
}
else
{
$result1 = mysql_query("UPDATE case2action set cost = 0 where id = $var " ) or die("Error: ".mysql_error());
}
echo "The entry was successfully DELETED from your database.";
'mysql_close';
die();
?>
</body>
</html>