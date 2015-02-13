<?php
session_start();

if (isset($_SESSION['user']))
 {
 header("Location: myaccount.php");
 }

error_reporting(E_ALL);
ini_set("display_errors",0);

include 'config.php';
  
if (isset($_POST['name'])) {

$user_name = mysql_real_escape_string($_POST['name']);

if ($_POST['Submit']=='Login')
{
$md5pass = md5($_POST['pwd']);
$sql = "SELECT id,user_name FROM users WHERE 
            user_name = '$user_name' AND 
            user_pwd = '$md5pass' AND user_activated='1'"; 
      
$result = mysql_query($sql) or die (mysql_error()); 
$num = mysql_num_rows($result);

    if ( $num != 0 ) {
  // A matching row was found - the user is authenticated. 

     list($user_id,$user_name) = mysql_fetch_row($result);
    // this sets variables in the session 
    $_SESSION['user']= $user_name;  
    $_SESSION['userid']=$user_id;
      
    if (isset($_GET['ret']) && !empty($_GET['ret']))
    {
    header("Location: $_GET[ret]");
    } else
    {
    header("Location: myaccount.php");
    }
    //echo "Logged in...";
    exit();
    } 

header("Location: login.php?msg=Invalid Login");

//echo "Error:";
exit();    
}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  
  <title>Login Page</title>
  <link rel="shortcut icon" href="images/favicon.ico" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
<?php if (isset($_GET['msg'])) { echo "<div class=\"msg\"> $_GET[msg] </div>"; } ?>
</head>
<body>
  <form name="form1" method="post" action="">
    
   <fieldset> 
      <legend>Log in</legend>
      
      <label for="name">User name</label>
      <input type="text" id="name" name="name"/>
      <div class="clear"></div>
      
      <label for="pwd">Password</label>
      <input type="password" id="pwd" name="pwd"/>
      <div class="clear"></div>
      
      <label for="remember_me" style="padding: 0;">Remember me?</label>
      <input type="checkbox" id="remember_me" style="position: relative; top: 3px; margin: 0; " name="remember_me"/>
      <div class="clear"></div>
      
      <input type="submit" style="margin: -20px 0 0 287px;" class="button" name="Submit" value="Login"/>  
    </fieldset>
  </form>
  
</body>

</html>
