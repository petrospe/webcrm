<?php
session_start();
if (!isset($_SESSION['user']))
{
header("Location: login.php");
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<?php
require "config.php";
//User Permissions

$access=mysql_result($permission, 6);
if($access != "1")
{
echo "<p><a href='#' onclick='history.go(-1);' style='text-decoration:none'>Not permitted</a></p>";
exit;
}
?> 
<head>
<title>
<?php
$title=mysql_query("SELECT programtitle,officetitle,officetime,officewhether,version FROM settings WHERE id=1");
$programtitle = mysql_fetch_array($title);
echo $programtitle['programtitle'];
?>
</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
  <link rel="shortcut icon" href="images/favicon.ico" >
<link rel="stylesheet"  href= "css/jquery-ui.custom.css" >
<link href="css/jquery.zweatherfeed.css" rel="stylesheet" type="text/css" >
<link href="css/programstyle.css" rel="stylesheet" type="text/css" >
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
<h3>New Matter Insert</h3>
<h4>CAUTION The persons associated with the case must be entered in the database first</h4>
<form action="matterindb.php" method="post" name="insertmatter_form" id="commentForm">
<table>
<tr>
<td><font size="2">Matter Description:</font></td>
<td><font size="2">Matter Type:</font></td>
</tr>
<tr>
<td><input type="text" name="descr" maxlength="250" size="60" /></td>
<?php

// Fetch groups for the casetype drop-down.
$sql1 = "SELECT id as ctid, descr as ctdescr FROM casetype ORDER BY descr";
$result1 = mysql_query ($sql1);

// Fetch groups for the thesaurus drop-down.
$sql2 = "SELECT id as theid, descr as thedescr FROM thesaurus ORDER BY descr";
$result2 =  mysql_query ($sql2);

// Fetch groups for the person drop-down.
$sql3 = "SELECT id as pid, descr as pdescr FROM person WHERE isdeleted=0 ORDER BY descr";
$result3 =  mysql_query ($sql3);

// Fetch groups for the attributes drop-down.
$sql4 = "SELECT id as attid, descr as attdescr FROM attributes ORDER BY descr";
$result4 =  mysql_query ($sql4);

?>
<td><select name="SetType">
     <option value ="">Select</option>
<?php
// printing the list box select command
while($nt1=mysql_fetch_array($result1)){//Array or records stored in $nt1
echo "<option value='".$nt1['ctid']."'>$nt1[ctdescr]</option>";
/* Option values are added by looping through the array */
}
?>
</select></td>
</tr>
<tr>
<td><font size="2">Default Matter Descriptions:</font></td>
</tr>
<tr>
<td><select name="thesaurus">
     <option value ="">Select</option>
<?php
// printing the list box select command
while($nt2=mysql_fetch_array($result2)){//Array or records stored in $nt1
echo "<option value= '$nt2[thedescr]'>$nt2[thedescr]</option>";
/* Option values are added by looping through the array */
}
?>
</select></td>
</tr>
<tr>
<td><font size="2">Open Date:</font></td>
</tr>
<tr>
<td>
<?php
Function ShowFromDate($year_interval,$YearIntervalType) {
GLOBAL $day,$month,$year;

//DAY
echo "<select name='day'>\n";
$i=1;
$CurrDay=date("d");
If(!IsSet($day)) $day=$CurrDay;
while ($i <= 31)
      {
       If(IsSet($day)) {
         If($day == $i || ($i == substr($day,1,1) && (substr($day,0,1) == 0))) {
                  echo"<option selected> $day\n";
                  $i++;
         }Else{
                If($i<10) {
                   echo "<option> 0$i\n";
                }Else {
                   echo "<option> $i\n";
                }
                $i++;
         }
       }Else {
              If($i == $CurrDay)
                If($i<10) {
                   echo "<option selected> 0$i\n";
                }Else {
                   echo"<option selected> $i\n";
                }
              Else {
                If($i<10) {
                   echo "<option> 0$i\n";
                }Else {
                   echo "<option> $i\n";
                }
              }
              $i++;
       }
      }
echo "</select>\n";

//MONTH
echo " / <select name='month'>\n";
$i=1;
$CurrMonth=date("m");
while ($i <= 12)
     {
      If(IsSet($month)) {
         If($month == $i || ($i == substr($month,1,1) && (substr($month,0,1) == 0))) {
            echo"<option selected> $month\n";
            $i++;
         }Else{
            If($i<10) {
               echo "<option> 0$i\n";
            }Else {
               echo "<option> $i\n";
            }
            $i++;
         }
      }Else {
            If($i == $CurrMonth) {
              If($i<10) {
                 echo "<option selected> 0$i\n";
              }Else {
                 echo "<option selected> $i\n";
              }
            }Else {
              If($i<10){
                 echo "<option> 0$i\n";
              }Else {
                 echo "<option> $i\n";
              }
            }
            $i++;
      }
}
  echo "</select>\n";

//YEAR
  echo " / <select name='year'>\n";
  $CurrYear=date("Y");
  If($YearIntervalType == "Past") {
      $i=$CurrYear-$year_interval+1;
      while ($i <= $CurrYear)
           {
            If($i == $year) {
               echo "<option selected> $i\n";
            }ElseIf ($i == $CurrYear && !IsSet($year)) {
               echo "<option selected> $i\n";
            }Else {
               echo "<option> $i\n";
            }
            $i++;
           }
       echo "</select>\n";
  }
  If($YearIntervalType == "Future") {
      $i=$CurrYear+$year_interval;
      while ($CurrYear < $i)
           {
            if ($year == $CurrYear) echo "<option selected> $CurrYear\n";
              else echo "<option> $CurrYear\n";
            $CurrYear++;
           }
       echo "</select>\n";
  }
  If($YearIntervalType == "Both") {
      $i=$CurrYear-$year_interval+1;
      while ($i < $CurrYear+$year_interval)
           {
            if ($i == $CurrYear) echo "<option selected> $i\n";
              else echo "<option> $i\n";
            $i++;
           }
       echo "</select>\n";
  }
}

//Ussage Example :
ShowFromDate(4,"Both");
?>
</td>
</tr>
<tr>
<td><font size="2">Close Date:</font></td>
</tr>
<tr>
<td><select name="cday">
<option value =""></option>
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
<select name="cmonth">
<option value=""></option>
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
<select name="cyear">
<option value=""></option>
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
</table>
<br/>
<table>
<tr>
<td><font size="2">Associated Person:</font></td>
<td><font size="2">Matter Person attribute:</font></td>
</tr>
<tr>
<td><select name="personid" class="required">
     <option value ="">Select</option>
<?PHP
// printing the list box select command
while($nt3=mysql_fetch_array($result3)){//Array or records stored in $nt3
echo "<option value='".$nt3['pid']."'>$nt3[pdescr]</option>";
/* Option values are added by looping through the array */
}
?>
</select></td>
<td><select name="SetAttribute">
     <option value ="">Select</option>
<?PHP
// printing the list box select command
while($nt4=mysql_fetch_array($result4)){//Array or records stored in $nt4
echo "<option value='".$nt4['attid']."'>$nt4[attdescr]</option>";
/* Option values are added by looping through the array */
}
?>
</select></td>
</tr>
</table>
<br/>
<table>
<tr><td><h4>Notes</h4></td></tr>
<tr>
<td><textarea rows="4" cols="110" name="notes"></textarea></td>
</tr>
</table>
<br/>
<table>
<tr>
<th><input type="submit" value="Insert" name="Submit" id="button-3" onclick="show_alert()" /></th>
<th><input type="reset" value="Reset" name="Reset" id="button-4" /></th>
<th><input type="button" value="Back" onclick="document.location = 'matters.php';" id="button-5" /></th>
</tr>
</table>
</form>
    </div>
  </div>
</div>
<?php include "footer.php"; ?></body>
</html>
