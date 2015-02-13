<?php
session_start();
if (!isset($_SESSION['user']))
{
header("Location: login.php");
}
?>
<html>
<meta HTTP-EQUIV="REFRESH" content="0; url=adminsettings.php">
<head>
<script language="javascript">
<!--
setTimeout("self.close();",10000)
//-->
</script>
</head>
<body>
<?php
  // Get the search variable from URL

  $id = $_GET['id'] ;

if ($id == "1")
  {
  echo "<p><a href = 'adminsettings.php'>Deletion not allowed</a></p>";
  exit;
  }

require "config.php";

$result1 = mysql_query("DELETE FROM users WHERE id = $id" ) or die("Error: ".mysql_error());
$result2 = mysql_query("DELETE FROM useraccess WHERE userid = $id" ) or die("Error: ".mysql_error());

echo "The entry was successfully DELETED from your database.";
mysql_close();
?>
</body>
</html>