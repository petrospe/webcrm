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
echo "<p>Not permitted</p>";
exit;
}
?>
<html>
<head><title>Matter Type Insert</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href= "css/adminsettingsstyle.css" rel="stylesheet" type="text/css">
<script src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $("#commentForm").validate();
  });
</script>
</head>
<body>
<div id="stylized" class="myform">
<h3>Matter Type Insert</h3>
Please fill the value
<FORM ACTION="insertmod2.php" METHOD="POST" NAME="insertmod_form" id="commentForm">
<table>
<tr>
<td>
<input type="text" name="mtidescr" class="required" size="60"</td>
</tr>
</table>
<TABLE>
<TR>
<TH><input type="submit" value="Submit" name="Submit" class="button"></TH>
</FORM>
<th><INPUT TYPE="button" VALUE="Close" onClick="self.close()" class="button"></th>
</TR>
</TABLE>
<!-------------end form------------>
</body>
</html>
