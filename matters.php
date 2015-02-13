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

$user_id=$_SESSION['userid'];
$permission=mysql_query("SELECT permit FROM useraccess WHERE userid = '$user_id'") or die("SELECT Error: ".mysql_error());
$access=mysql_result($permission, 5);
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

$('#tabs').tabs('select','tabs-3');
    
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

<div class="matters">

<div id="tabs">
    <ul>
        <li><a href="myaccount.php" onclick="window.location=('myaccount.php')"><span><?php echo mysql_result($module,7); ?></span></a></li>
        <li><a href="person.php" onclick="window.location=('person.php')"><span><?php echo mysql_result($module,0); ?></span></a></li>
        <li><a href="#tabs-3"><span><?php echo mysql_result($module,1); ?></span></a></li>
        <li><a href="tasks.php" onclick="window.location=('tasks.php')"><span><?php echo mysql_result($module,2); ?></span></a></li>
        <li><a href="billing.php" onclick="window.location=('billing.php')"><span><?php echo mysql_result($module,3); ?></span></a></li>
        <li><a href="files.php" onclick="window.location=('files.php')"><span><?php echo mysql_result($module,4); ?></span></a></li>
        <li><a href="protocol.php" onclick="window.location=('protocol.php')"><span><?php echo mysql_result($module,5); ?></span></a></li>
        <li><a href="adminsettings.php" onclick="window.location=('adminsettings.php')"><span><?php echo mysql_result($module,6); ?></span></a></li>
    </ul>
    <div id="tabs-3">
<h3>Matters Options</h3>
<table>
<tr>
<td>
<form name="input" action="insertmatter.php" method="post">
  <input type="submit" value="Create New Matter" id="button-3" />
</form>
</td>
</tr>
</table>
<h3>Matter Search Criteria</h3>
    <form name="form" action="mattersearch.php" method="get">
<table>
<tr>
<td><em>Matter Search</em></td>
<td>Order by</td>
</tr>
<tr>
<td><input type="text" name="p" /></td>
  <td><select name="orderby">
<option value= "c.lastupdate desc">Last Changed</option>
<option value= "c.id">Code</option>
<option value= "c.descr">Name</option>
<option value= "p.descr">Matter Person Name</option>
<option value= "c.opendate">Open Date</option>
<option value= "c.closedate">Close Date</option>
<option value= "ct.descr">Matter Type</option>
<option value= "at.descr">Matter Person Attribute</option>
<option value= "u.full_name">User</option>
<option value= "cn.descr">Notes</option>
</select></td>
</tr>
<tr>
<td><em>Matter Person Attribute</em></td>
</tr>
<tr>
<td><select name="t">
     <option value ="IS NOT NULL">All attributes</option>
     <option value ="IS NULL">None attribute</option>
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
<td><em>Matter status</em></td>
</tr>
<tr>
<td>
Both:
  <input type="radio" name="r" value="ANY" checked="checked" />
  <br />
Active:
  <input type="radio" name="r" value="IS NULL" />
  <br />
Inactive:
  <input type="radio" name="r" value="IS NOT NULL" />
</td>
</tr>
</table>
<table>
<tr>
  <td><hr/>Show only Matters per Person:
  <input type="checkbox" name="MAPE" value="1" />|
</td>
</tr>
</table>
  <br/>
<table>
<tr>
  <th>
  <input type="submit" name="Submit" value="Search" id="button-4" />
  </th>
</tr>
</table>
  </form>
    </div>
  </div>
</div>
<?php include "footer.php"; ?></body>
</html>
