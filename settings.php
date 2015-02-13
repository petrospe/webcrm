<?php 
session_start();

if (!isset($_SESSION['user']))
{
header("Location: login.php");
}

include ('config.php'); 

if ($_POST['Submit']=='Change')
{
$rsPwd = mysql_query("select user_pwd from users where user_name='$_SESSION[user]'") or die(mysql_error());
list ($oldpwd) = mysql_fetch_row($rsPwd);

if ($oldpwd == md5($_POST['oldpwd']))
 {
  $newpasswd = md5($_POST['newpwd']);
  
  mysql_query("Update users
          SET user_pwd = '$newpasswd'
        WHERE user_name = '$_SESSION[user]'
        ") or die(mysql_error());
  header("Location: settings.php?msg=Password updated...");        
  } else 
  { header("Location: settings.php?msg=ERROR: Password does not match..."); }
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
<title>Change Password</title>
<link type="text/css" href="css/jquery-ui.custom.css" rel="stylesheet" >  
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui.custom.min.js"></script>
    <script type="text/javascript">
       $(function(){
         $("#button-3").button();
         $("#button-4").button();
       });
    </script>
    <style type="text/css">       /*demo page css*/       
      body{ font: 62.5% "Trebuchet MS", sans-serif;}     
    </style>
</head>
<body>
  <div class="ui-state-default ui-widget">
<p> 
  <?php if (isset($_GET['msg'])) { echo "<div class=\"msg\"> $_GET[msg] </div>"; } ?>
</p>
<h2>Change Password</h2>
<form action="settings.php" method="post" name="form3" id="form3">
  <p>Old Password 
    <input name="oldpwd" type="password" >
  </p>
  <p>New Password: 
    <input name="newpwd" type="password" >
  </p>
  <p> 
<input name="Submit" type="submit" id="button-3" value="Change">
<input type="button" value="Close" onclick="self.close()" id="button-4">
  </p>
</form>
  </div>
</body>
</html>