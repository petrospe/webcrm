<?php
session_start();
if (!isset($_SESSION['user']))
{
header("Location: login.php");
}
?>
<?php
require "config.php";
//User Permissions

$access=mysql_result($permission, 42);
if($access != "1")
{
echo "Not permitted";
exit;
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8" />
  <title>Program Options</title>
  <link rel="shortcut icon" href="images/favicon.ico" />
  <link href= "css/adminsettingsstyle.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.min.js" ></script>
<script type="text/javascript" src="js/jquery.validate.js" ></script>
<script type="text/javascript" >
  $(document).ready(function(){
    $("#commentForm").validate();
  });
</script>
</head>
<body>
<h3>Program Options</h3>
<?php
  error_reporting(E_ALL);
  ini_set("display_errors",1);
  
//Details to be updated
$sql = "SELECT  id, programtitle,officetitle,officesubtitle,officestreet,officezipcode,officecity,
 SUBSTRING(officetime,95,7),SUBSTRING(officewhether,91,8) FROM settings WHERE id =1";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$formVars = array();
?>
<form action="programoptions2.php" method="post" name="updateoffice" id="commentForm">
<table>
<tr>
<td>Title:</td>
<td><textarea rows="2" cols="60" name="programtitle"><?php echo $row['programtitle']; ?></textarea></td>
</tr>
<tr>
<td>Company Title:</td>
<td><textarea rows="2" cols="60" name="officetitle"><?php echo $row['officetitle']; ?></textarea></td>
</tr>
<tr>
<td>Company Subtitle:</td>
<td><textarea rows="2" cols="60" name="officesubtitle"><?php echo $row['officesubtitle']; ?></textarea></td>
</tr>
<tr>
<td>Company Address:</td>
<td><textarea rows="2" cols="60" name="officestreet"><?php echo $row['officestreet']; ?></textarea></td>
</tr>
<tr>
<td>Company Postal Code:</td>
<td><textarea rows="2" cols="60" name="officezipcode"><?php echo $row['officezipcode']; ?></textarea></td>
</tr>
<tr>
<td>Company City:</td>
<td><textarea rows="2" cols="60" name="officecity"><?php echo $row['officecity']; ?></textarea></td>
</tr>
</table>
<table> 
</table>
  <br/>
<table>
<tr>
  <td>Office time:</td>
</tr>
<tr>
  <td><span style="font-size:11px"><em>Choose font color for the time. The time tool is from <a href="http://www.kfsoft.info/home/digitClockDemo.php" target="_blank">KF Software House</a>. Only 7 chars is accepted ex. #736F6E</em></span></td>
</tr>
<tr>
  <td><input type="text" name="officetime" minlength="7" maxlength="7" value="<?php echo $row['SUBSTRING(officetime,95,7)']; ?>" ></td>
</tr>
<tr>
<td>Office Whether:</td>
</tr>
<tr>
<td><span style="font-size:11px"><em>You can setup whether for your location. The whether tool is from <a href="http://www.zazar.net/developers/jquery/zweatherfeed/" target="_blank">Yahoo! Weather Feed Plugin</a> follow the instractions and copy-paste the code at the following field. Only 8 chars accepted ex. GRXX0004</em></span></td>
</tr>
<tr>
  <td><input type="text" name="officewhether" minlength="8" maxlength="8" value="<?php echo $row['SUBSTRING(officewhether,91,8)']; ?>" ></td>
</tr>
</table>
<table>
<tr>
  <td><input type="button" value="Reload Page" onclick="window.location.reload( true )" /></td>
  <td><input type="submit" value="Update" name="Submit" /></td>
  <td><input type="button" value="Back" onclick="history.go(-1)" /></td>
</tr>
</table>
</form>
</body>
</html>
