<?php
session_start();
if (!isset($_SESSION['user']))
{
header("Location: login.php");
}
?>
<?php
session_start(tt);
$_SESSION['aid']=$_POST['actiontypeid'];
?>
<html>
<meta http-equiv="refresh" content="0;url=inserttask.php"> 
</html>