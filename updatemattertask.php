<?php
session_start();
if (!isset($_SESSION['user']))
{
header("Location: login.php");
}
?>
<?php
session_start();
$_SESSION['taskid']=$_GET['tid'];
?>
<html>
<meta http-equiv="refresh" content="0;url=updatemattertask1.php"> 
</html>