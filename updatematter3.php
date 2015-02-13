<?php
session_start();
if (!isset($_SESSION['user']))
{
header("Location: login.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
require "config.php";
//User Permissions

$access=mysql_result($permission, 8);
if($access != "1")
{
echo "<p><a href='#' onclick='history.go(-1);' style='text-decoration:none'>Not permitted</a></p>";
exit;
}

$id=$_GET['ccid'];

$query=("SELECT c.id as Code, c.descr as Name, date_format(c.opendate,'%d') as opday, date_format(c.opendate,'%m') as opmonth, date_format(c.opendate,'%Y') as opyear, ct.descr as Type, ct.id as typeid, u.full_name as username, date_format(c.closedate,'%d') as clday, date_format(c.closedate,'%m') as clmonth, date_format(c.closedate,'%Y') as clyear, cn.descr as Notes
FROM cases c
left join casetype ct on ct.id = c.casetypeid
left join casenotes cn on cn.caseid=c.id
left join users u on u.id = c.userid
WHERE c.id = $id ")
or die("SELECT Error: ".mysql_error());
$result=mysql_query($query);
$row=mysql_fetch_array($result);
$formVars = array();

//this code is bringing in the values for the dropdown casetype
$sql1="SELECT id as caid, descr as mtypedescr FROM casetype ORDER BY mtypedescr";
//* You can add order by clause to the sql statement if the names are to be displayed in alphabetical order *//
$final1 = mysql_query ($sql1);

//this code is bringing in the values for the dropdown casetype
$sql2="SELECT id as thid, descr as thesadescr FROM thesaurus ORDER BY thesadescr";
//* You can add order by clause to the sql statement if the names are to be displayed in alphabetical order *//
$final2 = mysql_query ($sql2);
?>
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
<script type="text/javascript" src="js/jquery.validate.js"></script>
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
<h3>Matter Details</h3>
<form method="post" action="updatematter4.php" id="commentForm">
<table>

<tr>
<td><font color="blue">Matter Description:</font></td>
<td><input type="text" name="Name" value="<?php echo $row['Name']; ?>" size="50" /></td>
<td>
<select name="thesaurus">
<option value="">Select Default Matter Description</option>
<?php
// printing the list box select command
while($nt2=mysql_fetch_array($final2)){//Array or records stored in $nt2
echo "<option value='".$nt2['thesadescr']."'>$nt2[thesadescr]</option>";
//* Option values are added by looping through the array *//
}
?>
</select>
</td>
</tr>
<tr>
<td><font color="blue">Matter Type:</font></td>
<td>
<select name="mtypeid">
<option value="<?php echo $row['typeid']; ?>"><?php echo $row['Type']; ?></option>
<?php
// printing the list box select command
while($nt1=mysql_fetch_array($final1)){//Array or records stored in $nt1
echo "<option value='".$nt1['caid']."'>$nt1[mtypedescr]</option>";
//* Option values are added by looping through the array *//
}
?>
</select>
</td>
</tr>
<tr>
<td><font color="blue">Open Date:</font></td>
<td><select name="opday">
<option value="<?php echo $row['opday']; ?>"><?php echo $row['opday']; ?></option>
<option value='01'>01</option>
<option value='02'>02</option>
<option value='03'>03</option>
<option value='04'>04</option>
<option value='05'>05</option>
<option value='06'>06</option>
<option value='07'>07</option>
<option value='08'>08</option>
<option value='09'>09</option>
<option value='10'>10</option>
<option value='11'>11</option>
<option value='12'>12</option>
<option value='13'>13</option>
<option value='14'>14</option>
<option value='15'>15</option>
<option value='16'>16</option>
<option value='17'>17</option>
<option value='18'>18</option>
<option value='19'>19</option>
<option value='20'>20</option>
<option value='21'>21</option>
<option value='22'>22</option>
<option value='23'>23</option>
<option value='24'>24</option>
<option value='25'>25</option>
<option value='26'>26</option>
<option value='27'>27</option>
<option value='28'>28</option>
<option value='29'>29</option>
<option value='30'>30</option>
<option value='31'>31</option>
</select>
/
<select name="opmonth">
<option value="<?php echo $row['opmonth']; ?>"><?php echo $row['opmonth']; ?></option>
<option value='01'>01</option>
<option value='02'>02</option>
<option value='03'>03</option>
<option value='04'>04</option>
<option value='05'>05</option>
<option value='06'>06</option>
<option value='07'>07</option>
<option value='08'>08</option>
<option value='09'>09</option>
<option value='10'>10</option>
<option value='11'>11</option>
<option value='12'>12</option>
</select>
/
<select name="opyear">
<option value="<?php echo $row['opyear']; ?>"><?php echo $row['opyear']; ?></option>
<option value='2005'>2005</option>
<option value='2006'>2006</option>
<option value='2007'>2007</option>
<option value='2008'>2008</option>
<option value='2009'>2009</option>
<option value='2010'>2010</option>
<option value='2011'>2011</option>
<option value='2012'>2012</option>
<option value='2013'>2013</option>
<option value='2014'>2014</option>
</select>
</td>
</tr>
<tr>
<td><font color="blue">Close Date:</font></td>
<td><select name="clday">
<option value="<?php echo $row['clday']; ?>"><?php echo $row['clday']; ?></option>
<option value='01'>01</option>
<option value='02'>02</option>
<option value='03'>03</option>
<option value='04'>04</option>
<option value='05'>05</option>
<option value='06'>06</option>
<option value='07'>07</option>
<option value='08'>08</option>
<option value='09'>09</option>
<option value='10'>10</option>
<option value='11'>11</option>
<option value='12'>12</option>
<option value='13'>13</option>
<option value='14'>14</option>
<option value='15'>15</option>
<option value='16'>16</option>
<option value='17'>17</option>
<option value='18'>18</option>
<option value='19'>19</option>
<option value='20'>20</option>
<option value='21'>21</option>
<option value='22'>22</option>
<option value='23'>23</option>
<option value='24'>24</option>
<option value='25'>25</option>
<option value='26'>26</option>
<option value='27'>27</option>
<option value='28'>28</option>
<option value='29'>29</option>
<option value='30'>30</option>
<option value='31'>31</option>
</select>
/
<select name="clmonth">
<option value="<?php echo $row['clmonth']; ?>"><?php echo $row['clmonth']; ?></option>
<option value='01'>01</option>
<option value='02'>02</option>
<option value='03'>03</option>
<option value='04'>04</option>
<option value='05'>05</option>
<option value='06'>06</option>
<option value='07'>07</option>
<option value='08'>08</option>
<option value='09'>09</option>
<option value='10'>10</option>
<option value='11'>11</option>
<option value='12'>12</option>
</select>
/
<select name="clyear">
<option value="<?php echo $row['clyear']; ?>"><?php echo $row['clyear']; ?></option>
<option value='2005'>2005</option>
<option value='2006'>2006</option>
<option value='2007'>2007</option>
<option value='2008'>2008</option>
<option value='2009'>2009</option>
<option value='2010'>2010</option>
<option value='2011'>2011</option>
<option value='2012'>2012</option>
<option value='2013'>2013</option>
<option value='2014'>2014</option>
</select>
</td>
</tr>
<tr>
<td><font color="blue">Notes:</font></td>
<td><input type="text" name="Notes" value="<?php echo $row['Notes']; ?>" size="50" /></td>
</tr>
<tr>
<td><input type="hidden" name="Code" value="<?php echo $row['Code']; ?>" /></td>
</tr>
<tr>
<td><input type="submit" value="Submit" id="button-3" /></td>
<td><input type="button" value="Back" onclick="document.location = 'matters.php';" id="button-4" /></td>
</tr>
</table>
 </form>
</div>
  </div>
    </div>
<?php include "footer.php"; ?>
</body>
</html>