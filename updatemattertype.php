<?php
session_start();
if (!isset($_SESSION['user']))
{
header("Location: login.php");
}
?>
<html>
<head><title>Matter Type Update</title>
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
<h3>Matter Type Update</h3>
Please fill the value
<?php
require "config.php";
//User Permissions

$access=mysql_result($permission, 42);
if($access != "1")
{
echo "<p>Not permitted</p>";
exit;
}

$mtid=$_GET['mtid'];

//this code is bringing in the values for the dropdown task types
$sql1="SELECT descr FROM casetype WHERE id = $mtid";
/* You can add order by clause to the sql statement if the names are to be displayed in alphabetical order */
$result = mysql_query ($sql1);
$row=mysql_fetch_array($result);
$formVars = array();
mysql_close();
?>
<FORM ACTION="updatemod2.php" METHOD="POST" NAME="updateattribute_form" id="commentForm">
<table>
<tr>
<td>
<input type="text" name="mtdescr" value="<?php echo $row[descr]; ?>" class="required" size="60">
</td>
<input type=hidden name=mtid value="<?php echo $mtid; ?>">
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