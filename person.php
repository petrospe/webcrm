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

$access=mysql_result($permission, 0);
if($access != "1")
{
echo "<p>Not permitted</p>";
exit;
}

// Fetch groups for the attributes drop-down.
$sql = "SELECT id as attid, descr as attdescr FROM attributes ORDER BY descr";
$result = mysql_query($sql);
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
<h3>Person Options</h3>
<table>
<tr>
<td>
<form name="input" action="insertperson.php" method="post">
  <input type="submit" value="Create New Person" id="button-3" />
</form>
</td>
</tr>
</table>
<h3>Person Search Criteria</h3>
  <form name="input" action="personsearch.php" method="get">
  <table>
<tr>
<td><em>Person Search</em></td>
  <td><em>Order by</em></td>
</tr>
<tr>
<td><input type="text" name="q" /></td>
<td><select name="orderby">
<option value = "p.descr">Name</option>
<option value= 'p.id desc'>Last Inserted</option>
<option value= "at.descr">Attribute</option>
<option value= "p.occupation">Occupation</option>
<option value= "p.company">Company</option>
<option value= "p.street1">Address</option>
<option value= "p.city1">City</option>
<option value= "p.zipcode1">Postal Code</option>
<option value= "p.phone1">Phone 1</option>
<option value= "p.phone2">Phone 2</option>
<option value= "p.mobile">Cellphone</option>
<option value= "p.fax">Fax</option>
<option value= "pn.descr">Notes</option>
<option value= "p.email">Email</option>
<option value= "p.website">Website</option>
<option value= "p.street2">Street 2</option>
<option value= "p.personextra1">City 2</option>
<option value= "p.personextra2">Postal Code 2</option>
<option value= "p.phone3">Phone 3</option>
<option value= "p.afm">Tax Reg. No</option>
<option value= "d.descr">Inland Revenue</option>
<option value= "p.personextra3">IC or Passport</option>
</select></td>
</tr>
<tr>
<td><em>Attribute</em></td>
</tr>
<tr>
<td><select name="t">
     <option value ="IS NOT NULL">Select</option>
<?php
// printing the list box select command
while($nt=mysql_fetch_array($result)){//Array or records stored in $nt
echo "<option value='".$nt['attid']."'>$nt[attdescr]</option>";
/* Option values are added by looping through the array */
}
?>
</select></td>
</tr>
<tr>
  <td><hr />Show only phones &amp; e-mails:
  <input type="checkbox" name="lite" value="1" />|
</td>
  <td><hr/>Show second address:
  <input type="checkbox" name="address" value="1" />|
</td>
  <td><hr/> Show personal items:
  <input type="checkbox" name="personal" value="1" />
</td>
</tr>
</table>
  <br/>
<table>
<tr>
  <th><input type="submit" name="Submit" value="Search" id="button-4" /></th>
</tr>
</table>
  </form>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>
</body>
</html>