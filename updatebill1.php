<?php
session_start();
if (!isset($_SESSION['user']))
{
header("Location: login.php");
}
?>
<?php
error_reporting(E_ALL);
 ini_set("display_errors",0);

require "config.php";

//User Permissions

$access=mysql_result($permission, 28);
if($access != "1")
{
echo "<p><a href='#' onclick='history.go(-1);' style='text-decoration:none'>Not permitted</a></p>";
exit;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
<head><title>Billing</title>
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
<script type="text/javascript" src="js/keyboard.js"></script>
   <script type="text/javascript">
      <!--
      function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode != 46)
            return false;

         return true;
      }
      //-->
   </script>
    <style type="text/css">       /*demo page css*/       
      body{ font: 80% "Trebuchet MS", sans-serif;}     
    </style> 
</head>
<body>
  <div class="ui-state-default ui-widget">
<h3>Billing</h3>
Please fill the value
<?php
$tid=$_GET['tid'];

//this code is bringing in the values for the dropdown task types
$sql1="SELECT cost as cost FROM case2action WHERE id = $tid";
/* You can add order by clause to the sql statement if the names are to be displayed in alphabetical order */
$result = mysql_query ($sql1);
$row=mysql_fetch_array($result);
$formVars = array();

?>
<form action="updatebill2.php" method="post" name="updatebilling_form">
<table>
<tr>
<td>
  <input onkeypress="return isNumberKey(event)" type="text" style="text-align: right;" name="cost" value="<?php echo $row[cost]; ?>">
</td>
  <td><input type="hidden" name="taskid" value="<?php echo $tid; ?>">Euro &#8364</td>
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
