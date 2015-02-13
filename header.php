<?php
  error_reporting(E_ALL);
  ini_set("display_errors",1);

echo $programtitle['officetime'];

$access=mysql_result($permission, 42);
if($access != "1")
{
  echo "<div class='title'>".$programtitle['programtitle']."</div>";
  echo "<div class='subtitle'>".$programtitle['officetitle']."</div>";  
}
if($access == "1")
{
  echo "<div class='title'><a class='title' href='programoptions.php'>".$programtitle['programtitle']."</a></div>";
  echo "<div class='subtitle'>".$programtitle['officetitle']."</div>";
}
?>
<div class="logo"><img src="images/logo.png" alt="logo" /></div>
<div class="menu1">Connected user <?php echo $_SESSION['user']; ?> IP <?php echo $_SERVER['REMOTE_ADDR']; ?> <input type="button" id="button" onclick="popup('settings.php')" value="Password change"/>
  <input type="button" id="button-2" onclick="location.href='logout.php'" value="Logout"/></div>
<div class="clock" id= "clock3"></div>
<br /><br /><br /><br /><br />

