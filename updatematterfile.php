<?php
session_start();
if (!isset($_SESSION['user']))
{
header("Location: login.php");
}
?>
<?php
session_start();
$_SESSION['fpid']=$_GET['fpid'];
?>
<html>
<meta http-equiv="refresh" content="0;url=updatematterfile1.php"> 
</html>