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

$cat=$_GET['id'];
  
$query1=mysql_query("SELECT id, descr FROM courts WHERE type = $cat ORDER BY descr");
$query2=mysql_query("SELECT descr FROM categories WHERE id = $cat");
$row2 = mysql_fetch_array($query2);
?>
<html>
<head><title><?php echo $row2['descr']; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="shortcut icon" href="images/favicon.ico" />
<link href= "css/adminsettingsstyle.css" rel="stylesheet" type="text/css">
<script src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript">
<!--
function popup(url) 
{
 var width  = 590;
 var height = 200;
 var left   = (screen.width  - width)/2;
 var top    = (screen.height - height)/2;
 var params = 'width='+width+', height='+height;
 params += ', top='+top+', left='+left;
 params += ', directories=no';
 params += ', location=no';
 params += ', menubar=no';
 params += ', resizable=no';
 params += ', scrollbars=no';
 params += ', status=no';
 params += ', toolbar=no';
 newwin=window.open(url,'windowname5', params);
 if (window.focus) {newwin.focus()}
 return false;
}
// -->
</script>
<script type="text/javascript">
function confirmDelete() {
  return confirm("Are you sure you wish to delete this entry?");
}
</script>
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
<table>
<tr>
<td><FONT SIZE="4"><?php echo $row2['descr']; ?></FONT></td>
<td align="right"><a href='#' onClick='window.location.reload( true );'>Reload</a></td>
<td><a href="adminsettings.php">Back</a></td>
</tr>
</table>
<h4>Items</h4>
<table>
<tr>
<td>
<input type="submit" value="New Item" onclick="popup('insertitem.php?catid=<?php echo $cat; ?>')" class="button" />
</td>
</tr>
<tr>
<td>
<?php
echo"<table>
<thead>
<tr>
<th>Item</th>
<th>Delete</th>
</tr>
</thead>";
while($row1 = mysql_fetch_array($query1))
  {
  echo "<tr>";
  echo "<td><a href='javascript: void(0)' onclick=popup('updateitem.php?itemid=" . $row1['id'] . "');>" . $row1['descr'] . "</td>";
  echo "<td><A href='deletemod.php?g=".$row1['id']."' onclick='return confirmDelete();'>Delete it</A></td>";
  echo "</tr>";
  }
echo "</table>";
?>
</td>
</tr>
</table>
</body>
</html>
