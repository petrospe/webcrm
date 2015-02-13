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

$access=mysql_result($permission, 21);
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

$('#tabs').tabs('select','tabs-5');
    
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
<script type="text/javascript" src="js/keyboard.js"></script>
<script type="text/JavaScript">
function reload(form)
{
var val=form.personid.options[form.personid.options.selectedIndex].value;
self.location="insertincome.php?personid=" + val ;
}
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

<div class="billing">

<div id="tabs">
    <ul>
        <li><a href="myaccount.php" onclick="window.location=('myaccount.php')"><span><?php echo mysql_result($module,7); ?></span></a></li>
        <li><a href="person.php" onclick="window.location=('person.php')"><span><?php echo mysql_result($module,0); ?></span></a></li>
        <li><a href="matters.php" onclick="window.location=('matters.php')"><span><?php echo mysql_result($module,1); ?></span></a></li>
        <li><a href="tasks.php" onclick="window.location=('tasks.php')"><span><?php echo mysql_result($module,2); ?></span></a></li>
        <li><a href="#tabs-5"><span><?php echo mysql_result($module,3); ?></span></a></li>
        <li><a href="files.php" onclick="window.location=('files.php')"><span><?php echo mysql_result($module,4); ?></span></a></li>
        <li><a href="protocol.php" onclick="window.location=('protocol.php')"><span><?php echo mysql_result($module,5); ?></span></a></li>
        <li><a href="adminsettings.php" onclick="window.location=('adminsettings.php')"><span><?php echo mysql_result($module,6); ?></span></a></li>
    </ul>
    <div id="tabs-5">
<h3>New Income</h3>
<?php

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
//this code is bringing in the values for the dropdown status
$sql4="SELECT id as sid, descr as statusdescr FROM status ORDER BY sid";
/* You can add order by clause to the sql statement if the names are to be displayed in alphabetical order */
$final4 = mysql_query ($sql4);

?>
<form action="incomeindb.php" method="post" name="insertincome_form" id="commentForm">
<table>
<tr>
<td><select name="personid" onchange="reload(this.form)" class="required">
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
</select>
</td>
<td><select name="caseid">
<option value="">Select Matter</option>
<?php
if(isset($quer)){ 
// printing the list box select command
while($nt=mysql_fetch_array($quer)){//Array or records stored in $nt
echo "<option value='$nt[cid]'>$nt[casedescr],[Code $nt[cid]]</option>";
/* Option values are added by looping through the array */
}
}
?>
</select>
</td>
</tr>
</table>
<table>
<tr>
<td><font size="2">Date:</font></td>
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
                  echo"<option selected='selected'> $day\n </option>";
                  $i++;
         }Else{
                If($i<10) {
                   echo "<option> 0$i\n </option>";
                }Else {
                   echo "<option> $i\n </option>";
                }
                $i++;
         }
       }Else {
              If($i == $CurrDay)
                If($i<10) {
                   echo "<option selected='selected'> 0$i\n </option>";
                }Else {
                   echo"<option selected='selected'> $i\n </option>";
                }
              Else {
                If($i<10) {
                   echo "<option> 0$i\n </option>";
                }Else {
                   echo "<option> $i\n </option>";
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
            echo"<option selected='selected'> $month\n </option>";
            $i++;
         }Else{
            If($i<10) {
               echo "<option> 0$i\n </option>";
            }Else {
               echo "<option> $i\n </option>";
            }
            $i++;
         }
      }Else {
            If($i == $CurrMonth) {
              If($i<10) {
                 echo "<option selected='selected'> 0$i\n </option>";
              }Else {
                 echo "<option selected='selected'> $i\n </option>";
              }
            }Else {
              If($i<10){
                 echo "<option> 0$i\n </option>";
              }Else {
                 echo "<option> $i\n </option>";
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
               echo "<option selected='selected'> $i\n </option>";
            }ElseIf ($i == $CurrYear && !IsSet($year)) {
               echo "<option selected='selected'> $i\n </option>";
            }Else {
               echo "<option> $i\n </option>";
            }
            $i++;
           }
       echo "</select>\n";
  }
  If($YearIntervalType == "Future") {
      $i=$CurrYear+$year_interval;
      while ($CurrYear < $i)
           {
            if ($year == $CurrYear) echo "<option selected='selected'> $CurrYear\n </option>";
              else echo "<option> $CurrYear\n </option>";
            $CurrYear++;
           }
       echo "</select>\n";
  }
  If($YearIntervalType == "Both") {
      $i=$CurrYear-$year_interval+1;
      while ($i < $CurrYear+$year_interval)
           {
            if ($i == $CurrYear) echo "<option selected='selected'> $i\n </option>";
              else echo "<option> $i\n </option>";
            $i++;
           }
       echo "</select>\n";
  }
}

//Usage Example :
ShowFromDate(4,"Both");
?>
</td>
<td><font size="2">Status:</font></td>
<td>
<?php
echo "<select name='statusid'>";
// printing the list box select command
while($nt4=mysql_fetch_array($final4)){//Array or records stored in $nt4
echo "<option value='$nt4[sid]'>$nt4[statusdescr]</option>";
/* Option values are added by looping through the array */
}
echo "</select>";
?>
</td>
</tr>
<tr>
<td><font size="2">Time:</font></td>
<td>
<?php
Function ShowFromTime() {
GLOBAL $hour,$minute;

//HOUR
echo "<select name='hour'>\n";
$i=0;
$CurrHour=date("H", time());
If(!IsSet($day)) $hour=$CurrHour;
while ($i <= 23)
      {
       If(IsSet($hour)) {
         If($hour == $i || ($i == substr($hour,1,1) && (substr($hour,0,1) == 0))) {
                  echo"<option selected='selected'> $hour\n </option>";
                  $i++;
         }Else{
                If($i<10) {
                   echo "<option> 0$i\n </option>";
                }Else {
                   echo "<option> $i\n </option>";
                }
                $i++;
         }
       }Else {
              If($i == $CurrHour)
                If($i<10) {
                   echo "<option selected='selected'> 0$i\n </option>";
                }Else {
                   echo"<option selected='selected'> $i\n </option>";
                }
              Else {
                If($i<10) {
                   echo "<option> 0$i\n </option>";
                }Else {
                   echo "<option> $i\n </option>";
                }
              }
              $i++;
       }
      }
echo "</select>\n";

//MINUTE
echo " : <select name='minute'>\n";
$i=0;
$CurrMinute=date("i",time());
while ($i <= 59)
     {
      If(IsSet($minute)) {
         If($minute == $i || ($i == substr($minute,1,1) && (substr($minute,0,1) == 0))) {
            echo"<option selected='selected'> $minute\n </option>";
            $i++;
         }Else{
            If($i<10) {
               echo "<option> 0$i\n </option>";
            }Else {
               echo "<option> $i\n </option>";
            }
            $i++;
         }
      }Else {
            If($i == $CurrMinute) {
              If($i<10) {
                 echo "<option selected='selected'> 0$i\n </option>";
              }Else {
                 echo "<option selected='selected'> $i\n </option>";
              }
            }Else {
              If($i<10){
                 echo "<option> 0$i\n </option>";
              }Else {
                 echo "<option> $i\n </option>";
              }
            }
            $i++;
      }
}
  echo "</select>\n";
}
//Usage Example :
ShowFromTime();
?>
</td>
</tr>
</table>
  <br/>
<table>
<tr>
<td><h4>Description</h4></td>
<td><h4>Notes</h4></td>
</tr>
<tr>
<td><textarea rows="4" cols="60" name="descr">Income</textarea></td>
<td><textarea rows="4" cols="58" name="notes"></textarea></td>
</tr>
</table>
  <br/>
<font size="4">Income amount :
  <input onkeypress="return isNumberKey(event)" type="text" style="text-align: right; color:347235 " name="cost" class="required" /> Euro &#8364;</font>
  <br/>
  <br/>
<table>
<tr>
<th><input type="submit" value="Insert" name="Submit" id="button-3" onclick="show_alert()" /></th>
<th><input type="reset" value="Reset" name="Reset" id="button-4" /></th> 
<th><input type="button" value="Back" onclick="document.location = 'billing.php';" id="button-5" /></th>
</tr>
</table>
</form>
    </div>
  </div>
</div>
<?php include "footer.php"; ?></body>
</html>
