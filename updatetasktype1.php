<?php
session_start();
if (!isset($_SESSION['user']))
{
header("Location: login.php");
}
?>
<?php
require "config.php";

 error_reporting(E_ALL);
 ini_set("display_errors",1);

$id=$_GET['id'];
  
//select update row
$result=mysql_query("SELECT id, descr, en_descr, lbl_ef1, lbl_ef2, lbl_ef3, lbl_ef4, lbl_ef5, lbl_ef6, lbl_ef7, lbl_ef8, lbl_ef9, lbl_ef10, txt_ef1_sql, txt_ef2_sql, txt_ef3_sql, txt_ef4_sql, txt_ef5_sql, txt_ef6_sql, txt_ef7_sql, txt_ef8_sql, txt_ef9_sql, txt_ef10_sql FROM proceduretypes WHERE id = $id") or die("SELECT Error: ".mysql_error()); /*contacts is the name of the MySQL table where the form data will be saved.
name and email are the respective table fields*/

$row=mysql_fetch_array($result);

mysql_close();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><title>Modify Task Type</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="images/favicon.ico" />
<link href= "css/adminsettingsstyle.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript">
function show_alert()
{
alert("The form data will be added to your database.");
}
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $("#commentForm").validate();
  });
</script>
</head>
<body>
<h3>Modify Task Type</h3>
<form action="updatetasktype2.php" method="post" name="updatetasktype_form" id="commentForm">
<table>
<tr><td><h4>Task Type Informations</h4></td></tr>
<tr>
<td>Task Type Name</td>
</tr>
<tr>
<td><a href="#selector"><input type="text" name="tasktypename" value="<?php echo $row['descr']; ?>" class="required" size="80" /></a></td>
</tr>
<tr>
<td>International Name</td>
</tr>
<tr>
<td><input type="text" name="inttasktypename" value="<?php echo $row['en_descr']; ?>" size="80" /></td>
</tr>
</table>
<table>
<tr>
<td>Extra Field 1</td>
<td>SQL Query for Extra Field 1</td>
</tr>
<tr>
<td><input type="text" name="extrafield1" value="<?php echo $row['lbl_ef1']; ?>" size="50" /></td>
<td><input type="text" name="queryfield1" value="<?php echo $row['txt_ef1_sql']; ?>" size="50" /></td>
</tr>    
<tr>
 <td>Extra Field 2</td>
<td>SQL Query for Extra Field 2</td>
 </tr>
 <tr>
 <td><input type="text" name="extrafield2" value="<?php echo $row['lbl_ef2']; ?>" size="50" /></td>
<td><input type="text" name="queryfield2" value="<?php echo $row['txt_ef2_sql']; ?>" size="50" /></td>
 </tr>     
<tr>
 <td>Extra Field 3</td>
<td>SQL Query for Extra Field 3</td>
 </tr>
 <tr>
 <td><input type="text" name="extrafield3" value="<?php echo $row['lbl_ef3']; ?>" size="50" /></td>
<td><input type="text" name="queryfield3" value="<?php echo $row['txt_ef3_sql']; ?>" size="50" /></td>
 </tr>    
<tr>
 <td>Extra Field 4</td>
<td>SQL Query for Extra Field 4</td>
 </tr>
 <tr>
 <td><input type="text" name="extrafield4" value="<?php echo $row['lbl_ef4']; ?>" size="50" /></td>
<td><input type="text" name="queryfield4" value="<?php echo $row['txt_ef4_sql']; ?>" size="50" /></td>
 </tr>    
<tr>
 <td>Extra Field 5</td>
<td>SQL Query for Extra Field 5</td>
 </tr>
 <tr>
 <td><input type="text" name="extrafield5" value="<?php echo $row['lbl_ef5']; ?>" size="50" /></td>
<td><input type="text" name="queryfield5" value="<?php echo $row['txt_ef5_sql']; ?>" size="50" /></td>
 </tr>    
<tr>
 <td>Extra Field 6</td>
<td>SQL Query for Extra Field 6</td>
 </tr>
 <tr>
 <td><input type="text" name="extrafield6" value="<?php echo $row['lbl_ef6']; ?>" size="50" /></td>
<td><input type="text" name="queryfield6" value="<?php echo $row['txt_ef6_sql']; ?>" size="50" /></td>
 </tr>
<tr>
 <td>Extra Field 7</td>
<td>SQL Query for Extra Field 7</td>
 </tr>
 <tr>
 <td><input type="text" name="extrafield7" value="<?php echo $row['lbl_ef7']; ?>" size="50" /></td>
<td><input type="text" name="queryfield7" value="<?php echo $row['txt_ef7_sql']; ?>" size="50" /></td>
 </tr>
<tr>
 <td>Extra Field 8</td>
<td>SQL Query for Extra Field 8</td>
 </tr>
 <tr>
 <td><input type="text" name="extrafield8" value="<?php echo $row['lbl_ef8']; ?>" size="50" /></td>
<td><input type="text" name="queryfield8" value="<?php echo $row['txt_ef8_sql']; ?>" size="50" /></td>
 </tr>
<tr>
 <td>Extra Field 9</td>
<td>SQL Query for Extra Field 9</td>
 </tr>
 <tr>
 <td><input type="text" name="extrafield9" value="<?php echo $row['lbl_ef9']; ?>" size="50" /></td>
<td><input type="text" name="queryfield9" value="<?php echo $row['txt_ef9_sql']; ?>" size="50" /></td>
 </tr>
<tr>
 <td>Extra Field 10</td>
<td>SQL Query for Extra Field 10</td>
 </tr>
 <tr>
 <td><input type="text" name="extrafield10" value="<?php echo $row['lbl_ef10']; ?>" size="50" /></td>
<td><input type="text" name="queryfield10" value="<?php echo $row['txt_ef10_sql']; ?>" size="50" /></td>
<td><input type="hidden" name="id" value="<?php echo $row['id']; ?>" /></td>
 </tr>
</table>
<br />
<table>
<tr>
<td><input type="submit" value="Update" name="Submit" onclick="show_alert()" class="button" /></td>
<td><input type="reset" value="Reset" name="Reset" class="button" /></td>
<td><input type="button" value="Back" onclick="document.location = 'adminsettings.php';" class="button" /></td>
</tr>
</table>
</form>
</body>
</html>