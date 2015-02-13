<?php
session_start();
if (!isset($_SESSION['user']))
{
header("Location: login.php");
}
?>
<?php
session_start();
$_SESSION['fpid'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><title>Change Matter-Person</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href= "css/jquery-ui.custom.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/jquery-ui.custom.min.js"></script>
  <script type="text/javascript">
       $(function(){
         $("#button-3").button();
         $("#button-4").button();
       });
  </script>
<script type="text/javascript">
function reload(form)
{
var val=form.personid.options[form.personid.options.selectedIndex].value;
self.location="updatematterfile1.php?personid=" + val ;
}
</script>
    <style type="text/css">       /*demo page css*/       
      body{ font: 80% "Trebuchet MS", sans-serif;}     
    </style>
</head>
<body>
  <div class="ui-state-default ui-widget">
<h3>Change Matter-Person</h3>
Please choose the Person whose matter belongs to
<?php
require "config.php";

//this code is bringing in the values for the dropdown persons
$sql1="SELECT id as pid, descr as persondescr FROM person WHERE isdeleted=0 ORDER BY persondescr";
/* You can add order by clause to the sql statement if the names are to be displayed in alphabetical order */
$quer2 = mysql_query ($sql1);

if(isset($_GET['personid'])) {
  
$personid=$_GET['personid']; //This line is added to take care if your global variable is off
if(strlen($personid) > 0 and !is_numeric($personid)){//check if $cat is numeric data or not.
echo "Data Error";
exit;
}
if(isset($personid) and strlen($personid) > 0){
//this code is bringing in the values for the dropdown cases
$sql2="SELECT c.id as cid, c.descr as casedescr
FROM casetoperson cp
left join cases c on c.id = cp.caseid
where c.isdeleted = 0 and cp.personid = $personid
order by casedescr";
/* You can add order by clause to the sql statement if the names are to be displayed in alphabetical order */
$quer = mysql_query ($sql2);
}else{
$sql2="SELECT id as cid, descr as casedescr FROM cases";
$quer = mysql_query ($sql2);
}

  }
?>
<form action="updatematterfile2.php" method="post" name="updatematterfile_form">
<table>
<tr>
<td><select name="personid" onchange="reload(this.form)">
<option value="">Select Person</option>
<?php
// printing the list box select command
while($nt2=mysql_fetch_array($quer2)){//Array or records stored in $nt2
if($nt2['pid']==@$personid){
echo "<option selected='selected' value='$nt2[pid]'>$nt2[persondescr]</option>";}
else{echo "<option value='$nt2[pid]'>$nt2[persondescr]</option>";}
}
/* Option values are added by looping through the array */
?>
</select></td>
</tr>
<tr>
<td><select name="caseid">
<option value="">Select Matter</option>
<?php
// printing the list box select command
while($nt=mysql_fetch_array($quer)){//Array or records stored in $nt
echo "<option value='$nt[cid]'>$nt[casedescr],[Code $nt[cid]]</option>";
/* Option values are added by looping through the array */
}
?>
</select></td>
</tr>
</table>
<table>
<tr>
  <th><input type="submit" value="Submit" name="Submit" id="button-3" /></th>
  <th><input type="button" value="Close" onclick="self.close()" id="button-4" /></th>
</tr>
</table>
  </form>
  </div>
</body>
</html>