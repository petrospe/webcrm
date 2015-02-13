<?php
session_start();
if (!isset($_SESSION['user']))
{
header("Location: login.php");
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
<head><title>Change Task Type</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link rel="stylesheet" href="css/jquery-ui.custom.css">
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/jquery-ui.custom.min.js"></script>
  <script type="text/javascript">
       $(function(){
         $("#button-3").button();
         $("#button-4").button();
       });
  </script>
    <style type="text/css">       /*demo page css*/       
      body{ font: 80% "Trebuchet MS", sans-serif;}     
    </style>
</head>
<body>
  <div class="ui-state-default ui-widget">
<h3>Change Task Type</h3>
Please choose Task Type. Warning previous extrafields notes may be lost.
<?php
$tid=$_GET['tid'];

require "config.php";

//this code is bringing in the values for the dropdown task types
$sql1="SELECT id as taid, descr as typedescr FROM proceduretypes ORDER BY typedescr";
/* You can add order by clause to the sql statement if the names are to be displayed in alphabetical order */
$quer1 = mysql_query ($sql1);

mysql_close();

?>
<form action="updatetypetask2.php" method="post" name="updatetypetask_form">
<table>
<tr>
<td><select name="typeid">
<option value="">Select Task Type</option>
<?PHP
// printing the list box select command
while($nt1=mysql_fetch_array($quer1)){
echo "<option value=$nt1[taid]>$nt1[typedescr]</option>";
}
/* Option values are added by looping through the array */
?>
</select>
</td>
  <td><input type="hidden" name="taskid" value="<?php echo $tid; ?>"></td>
</tr>
</table>
<table>
<tr>
  <th><input type="submit" value="Submit" name="Submit" id="button-3"></th>
  <th><input type="button" value="Close" onclick="self.close()" id="button-4"></th>
</tr>
</table>
</form>
  </div>
</body>
</html>