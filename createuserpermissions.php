<?php
session_start();
if (!isset($_SESSION['user']))
{
header("Location: login.php");
}
?>
<?php
error_reporting(E_ALL);
 ini_set("display_errors",1);

require "config.php";
$uid=$_POST['uid'];
header("Location: adminsettings.php");

mysql_query("INSERT into useraccess (moduleid, modview, modviewcode, permit) SELECT moduleid, modview, modviewcode, permit FROM useraccess WHERE userid = 1 ");
mysql_query("UPDATE useraccess SET userid = $uid WHERE userid = 0");
mysql_close();
exit;
?>

