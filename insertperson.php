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

$access=mysql_result($permission, 1);
if($access != "1")
{
echo "<a href='#' onclick='history.go(-1);' style='text-decoration:none'>Not permitted</a>";
exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>
<?php
$title=mysql_query("SELECT programtitle,officetitle,officetime,officewhether,version FROM settings WHERE id=1");
$programtitle = mysql_fetch_array($title);
echo $programtitle['programtitle'];
?>
</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="shortcut icon" href="images/favicon.ico" />
<link rel="stylesheet"  href= "css/jquery-ui.custom.css" />
<link href="css/jquery.zweatherfeed.css" rel="stylesheet" type="text/css" />
<link href="css/programstyle.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.custom.min.js"></script>
<script type="text/javascript">
$(function(){

        // Accordion
        $('#accordion').accordion({ header: "h3" });
  
        // Tabs
$('#tabs').tabs({
      ajaxOptions: {
        error: function( xhr, status, index, anchor ) {
          $( anchor.hash ).html(
            "Couldn't load this tab. We'll try to fix this as soon as possible. " +
            "If this wouldn't be a demo." );
        }
      }
    });

$('#tabs').tabs('select','tabs-2');
    
        // Dialog      
        $('#dialog').dialog({
          autoOpen: false,
          width: 600,
          buttons: {
            "Ok": function() {
              $(this).dialog("close");
            },
            "Cancel": function() {
              $(this).dialog("close");
            }
          }
        });
        
        // Dialog Link
        $('#dialog_link').click(function(){
          $('#dialog').dialog('open');
          return false;
        });

        // Datepicker
        $('#datepicker').datepicker({
          inline: true
        });
        
        // Slider
        $('#slider').slider({
          range: true,
          values: [17, 67]
        });
        
        // Progressbar
        $("#progressbar").progressbar({
          value: 20
        });
        
        //hover states on the static widgets
        $('#dialog_link, ul#icons li').hover(
          function() { $(this).addClass('ui-state-hover'); },
          function() { $(this).removeClass('ui-state-hover'); }
        );
        
      });
</script>
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
<script type="text/javascript">
$(function(){
        //logo
        $("#logo").load('logo.php');
  
        //header buttons
        $("#button").button();
$("#button").css({ height: '25px', 'padding-top': '0px', 'padding-bottom': '2px' });

        $("#button-2").button();
$("#button-2").css({ width: '120px', height: '25px', 'padding-top': '0px', 'padding-bottom': '2px' });
  
  //section buttons
$("#button-3").button();
$("#button-4").button();
$("#button-5").button();
$("#button-6").button();
   });
</script>
<script type="text/javascript">
function popup(url)
{
 var width  = 500;
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
</script>
<script type="text/javascript" src="js/jquery.MyDigitClock.js"></script>
<script src="js/jquery.zweatherfeed.min.js" type="text/javascript"></script>
</head>
<body>
<?php include "header.php"; ?>

<?php $module=mysql_query("SELECT descr FROM modules");?>

<div class="person">

<div id="tabs">
    <ul>
        <li><a href="myaccount.php" onclick="window.location=('myaccount.php')"><span><?php echo mysql_result($module,7); ?></span></a></li>
        <li><a href="#tabs-2"><span><?php echo mysql_result($module,0); ?></span></a></li>
        <li><a href="matters.php" onclick="window.location=('matters.php')"><span><?php echo mysql_result($module,1); ?></span></a></li>
        <li><a href="tasks.php" onclick="window.location=('tasks.php')"><span><?php echo mysql_result($module,2); ?></span></a></li>
        <li><a href="billing.php" onclick="window.location=('billing.php')"><span><?php echo mysql_result($module,3); ?></span></a></li>
        <li><a href="files.php" onclick="window.location=('files.php')"><span><?php echo mysql_result($module,4); ?></span></a></li>
        <li><a href="protocol.php" onclick="window.location=('protocol.php')"><span><?php echo mysql_result($module,5); ?></span></a></li>
        <li><a href="adminsettings.php" onclick="window.location=('adminsettings.php')"><span><?php echo mysql_result($module,6); ?></span></a></li>
    </ul>
    <div id="tabs-2">
<h3>New Person Insert</h3>
<form action="personindb.php" method="post" name="insertperson_form" id="commentForm">
<table>
<tr><td><h4>Standart Informations</h4></td></tr>
<tr>
<td><font size="2">Full Name:</font></td>
<td><font size="2">Set Attribute:</font></td>
<td><font size="2">Occupation:</font></td>
<td><font size="2">Company:</font></td>
</tr>
<tr>
<td><a href="#selector"><input type="text" name="FullName" class="required" /></a></td>
<?php
// Fetch groups for the attributes drop-down.
$sql4 = "SELECT id as attid, descr as attdescr FROM attributes ORDER BY descr";
$result4 =  mysql_query ($sql4);

// Fetch groups for the doy drop-down.
$sql1 = "SELECT id as did, descr as ddescr FROM doy ORDER BY descr";
$result1 =  mysql_query ($sql1);
?>
<td><select name="SetAttribute">
     <option value ="">Select</option>
<?php
// printing the list box select command
while($nt4=mysql_fetch_array($result4)){//Array or records stored in $nt4
echo "<option value='".$nt4['attid']."'>$nt4[attdescr]</option>";
/* Option values are added by looping through the array */
}
?>
</select></td>
<td><input type="text" name="Occupation" /></td>
<td><input type="text" name="Company" /></td>
</tr>
<tr>
<td><font size="2">Street:</font></td>
<td><font size="2">City:</font></td>
<td><font size="2">Zip Code:</font></td>
</tr>
<tr>
<td><input type="text" name="Street1" /></td>
<td><input type="text" name="City1" /></td>
<td><input type="text" name="ZipCode1" maxlength="5" /></td>
</tr>
<tr>
<td><font size="2">Phone 1:</font></td>
<td><font size="2">Phone 2:</font></td>
<td><font size="2">Cellphone:</font></td>
<td><font size="2">Fax:</font></td>
</tr>
<tr>
<td><input type="text" name="Phone1" maxlength="15" /></td>
<td><input type="text" name="Phone2" maxlength="15" /></td>
<td><input type="text" name="Cellphone" maxlength="15" /></td>
<td><input type="text" name="Fax" maxlength="15" /></td>
</tr>
</table>
<br/>
<table>
<tr><td><h4>Second Address</h4></td></tr>
<tr>
<td><font size="2">Street:</font></td>
<td><font size="2">City:</font></td>
<td><font size="2">Zip Code:</font></td>
<td><font size="2">Phone 3:</font></td>
</tr>
<tr>
<td><input type="text" name="Street2" /></td>
<td><input type="text" name="City2" /></td>
<td><input type="text" name="ZipCode2" maxlength="5" /></td>
<td><input type="text" name="Phone3" maxlength="15" /></td>
</tr>
</table>
<br/>
<table>
<tr><td><h4>Other Informations</h4></td></tr>
<tr>
<td><font size="2">Tax Registration Number:</font></td>
<td><font size="2"></font></td>
<td><font size="2">Inland Revenue</font></td>
<td><font size="2">Identity Card or Passport Number:</font></td>
</tr>
<tr>
<td><input type="text" name="afm" maxlength="12" id ="afm" /></td>
<td></td>
<td><select name="doyid">
     <option value ="">Select</option>
<?PHP
// printing the list box select command
while($nt1=mysql_fetch_array($result1)){//Array or records stored in $nt1
echo "<option value='".$nt1['did']."'>$nt1[ddescr]</option>";
/* Option values are added by looping through the array */
}
?>
</select></td>
<td><input type="text" name="IC" maxlength="15" /></td>
</tr>
<tr>
<td><font size="2">E Mail:</font></td>
<td><font size="2">Website:</font></td>
</tr>
<tr>
<td><input type="text" name="email" /></td>
<td><input type="text" name="website" /></td>
</tr>
</table>
<br/>
<table>
<tr><td><h4>Notes</h4></td></tr>
<tr>
<td><textarea rows="4" cols="88" name="notes"></textarea></td>
</tr>
</table>
<br/>
<table>
<tr>
<th><input type="submit" value="Insert" name="Submit" onclick="show_alert()" id="button-3" /></th>
<th><input type="reset" value="Reset" name="Reset" id="button-4" /></th>
<th><input type="button" value="Back" onclick="document.location = 'person.php';" id="button-5" /></th>
</tr>
</table>
</form>
    </div>
  </div>
</div>
<?php include "footer.php"; ?></body>
</html>
