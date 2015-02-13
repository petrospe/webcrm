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

$access=mysql_result($permission, 38);
if($access != "1")
{
echo "<p><a href='#' onclick='history.go(-1);' style='text-decoration:none'>Not permitted</a></p>";
exit;
}

//increasing protocol number
$query=("SELECT max(aacode) as aacode FROM case2action WHERE actiontypeid=6 and isdeleted=0 and pinout=1")
or die("SELECT Error: ".mysql_error());
$result=mysql_query($query);
$row=mysql_fetch_array($result);

//this code is bringing in the values for the dropdown persons
$sql1="SELECT id as p1id, descr as persondescr1 FROM person WHERE isdeleted=0 ORDER BY persondescr1";
/* You can add order by clause to the sql statement if the names are to be displayed in alphabetical order */
$final1 = mysql_query ($sql1);

//this code is bringing in the values for the dropdown persons
$sql2="SELECT id as p2id, descr as persondescr2 FROM person WHERE isdeleted=0 ORDER BY persondescr2";
/* You can add order by clause to the sql statement if the names are to be displayed in alphabetical order */
$final2 = mysql_query ($sql2);

//this code is bringing in the values for the dropdown sendtype
$sql3="SELECT id as sid, descr as senddescr FROM sendtype ORDER BY senddescr";
/* You can add order by clause to the sql statement if the names are to be displayed in alphabetical order */
$final3 = mysql_query ($sql3);

//this code is bringing in the values for the dropdown persons
$sql4="SELECT id as cid, descr as matterdescr FROM cases WHERE isdeleted=0 ORDER BY matterdescr";
/* You can add order by clause to the sql statement if the names are to be displayed in alphabetical order */
$final4 = mysql_query ($sql4);

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

$('#tabs').tabs('select','tabs-7');
    
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

<div class="protocol">

<div id="tabs">
    <ul>
        <li><a href="myaccount.php" onclick="window.location=('myaccount.php')"><span><?php echo mysql_result($module,7); ?></span></a></li>
        <li><a href="person.php" onclick="window.location=('person.php')"><span><?php echo mysql_result($module,0); ?></span></a></li>
        <li><a href="matters.php" onclick="window.location=('matters.php')"><span><?php echo mysql_result($module,1); ?></span></a></li>
        <li><a href="tasks.php" onclick="window.location=('tasks.php')"><span><?php echo mysql_result($module,2); ?></span></a></li>
        <li><a href="billing.php" onclick="window.location=('billing.php')"><span><?php echo mysql_result($module,3); ?></span></a></li>
        <li><a href="files.php" onclick="window.location=('files.php')"><span><?php echo mysql_result($module,4); ?></span></a></li>
        <li><a href="#tabs-7"><span><?php echo mysql_result($module,5); ?></span></a></li>
        <li><a href="adminsettings.php" onclick="window.location=('adminsettings.php')"><span><?php echo mysql_result($module,6); ?></span></a></li>
    </ul>
    <div id="tabs-7">
<h3>New Protocol Insert</h3>
<h4><em>Outgoing Protocol</em></h4>
<form action="protocolindb.php" method="post" name="protocolindb_form">
<table>
<tr>
<td><font size="2">Protocol Number: </font></td>
<?php
$ipcode= $row['aacode'];
$ipcode++;
?>
  <td><input type="text" name="aacode" value="<?php echo $ipcode; ?>" /></td>
  <td><input type="hidden" name="descr" value="Outgoing Protocol" /></td>
  <td><input type="hidden" name="pinout" value="1" /></td>
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
echo "<select name='fday'>\n";
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
echo " / <select name='fmonth'>\n";
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
  echo " / <select name='fyear'>\n";
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

//Ussage Example :
ShowFromDate(4,"Both");
?>
</td>
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
<td><select name="sendtypeid">
<option value="">Send Type</option>
<?php
// printing the list box select command
while($nt3=mysql_fetch_array($final3)){
echo "<option value='$nt3[sid]'>$nt3[senddescr]</option>";
/* Option values are added by looping through the array */
}
?>
</select></td>
</tr>
</table>
<table>
<tr>
<td>From Person</td>
<td>To Person</td>
</tr>
<tr>
<td><select style="width: 390px;" name="personidfrom">
<option value="">Select Person</option>
<?php
// printing the list box select command
while($nt1=mysql_fetch_array($final1)){
echo "<option value='$nt1[p1id]'>$nt1[persondescr1]</option>";
/* Option values are added by looping through the array */
}
?>
</select></td>
<td><select style="width: 390px;" name="personidto">
<option value="">Select Person</option>
<?php
// printing the list box select command
while($nt2=mysql_fetch_array($final2)){
echo "<option value='$nt2[p2id]'>$nt2[persondescr2]</option>";
/* Option values are added by looping through the array */
}
?>
</select></td>
</tr>
<tr>
<td>About Matter</td>
</tr>
<tr>
<td><select style="width: 390px;" name="caseid">
<option value="">Select Matter</option>
<?php
// printing the list box select command
while($nt4=mysql_fetch_array($final4)){
echo "<option value='$nt4[cid]'>$nt4[matterdescr],[Code $nt4[cid]]</option>";
/* Option values are added by looping through the array */
}
?>
</select></td>
</tr>
</table>
<table>
<tr>
<td>Protocol Notes</td>
</tr>
<tr>
<td><textarea rows="4" cols="60" name="notes"></textarea></td>
</tr>
</table>
  <br/>
<table>
<tr>
  <th><input type="submit" value="Insert" name="Submit" id="button-3" onclick="show_alert()" /></th>
  <th><input type="reset" value="Reset" name="Reset" id="button-4" /></th> 
  <th><input type="button" value="Back" onclick="document.location = 'protocol.php';" id="button-5" /></th>
</tr>
</table>
</form>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>
</body>
</html>
