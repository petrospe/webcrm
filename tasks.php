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

$access=mysql_result($permission, 14);
if($access != "1")
{
echo "<p>Not permitted</p>";
exit;
}

//this code is bringing in the values for the dropdown persons
$sql1="SELECT id as pid, descr as persondescr FROM person WHERE isdeleted=0 ORDER BY persondescr";
/* You can add order by clause to the sql statement if the names are to be displayed in alphabetical order */
$quer2 = mysql_query ($sql1);

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

//this code is bringing in the values for the dropdown actiontype
$sql3="SELECT id as acid, descr as actiondescr FROM proceduretypes ORDER BY actiondescr";
/* You can add order by clause to the sql statement if the names are to be displayed in alphabetical order */
$final3 = mysql_query ($sql3);

//this code is bringing in the values for the dropdown actiontype
$sql4="SELECT id as acid, descr as actiondescr FROM proceduretypes ORDER BY actiondescr";
/* You can add order by clause to the sql statement if the names are to be displayed in alphabetical order */
$final4 = mysql_query ($sql4);

//this code is bringing in the values for the dropdown status
$sql5="SELECT id as stid, descr as statdescr FROM status ORDER BY statdescr";
/* You can add order by clause to the sql statement if the names are to be displayed in alphabetical order */
$final5 = mysql_query ($sql5);

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

$('#tabs').tabs('select','tabs-4');
    
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
<script type="text/javascript" >
function reload(form)
{
var val=form.personid.options[form.personid.options.selectedIndex].value;
self.location="tasks.php?personid=" + val ;
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

<div class="tasks">

<div id="tabs">
    <ul>
        <li><a href="myaccount.php" onclick="window.location=('myaccount.php')"><span><?php echo mysql_result($module,7); ?></span></a></li>
        <li><a href="person.php" onclick="window.location=('person.php')"><span><?php echo mysql_result($module,0); ?></span></a></li>
        <li><a href="matters.php" onclick="window.location=('matters.php')"><span><?php echo mysql_result($module,1); ?></span></a></li>
        <li><a href="#tabs-4"><span><?php echo mysql_result($module,2); ?></span></a></li>  
        <li><a href="billing.php" onclick="window.location=('billing.php')"><span><?php echo mysql_result($module,3); ?></span></a></li>
        <li><a href="files.php" onclick="window.location=('files.php')"><span><?php echo mysql_result($module,4); ?></span></a></li>
        <li><a href="protocol.php" onclick="window.location=('protocol.php')"><span><?php echo mysql_result($module,5); ?></span></a></li>
        <li><a href="adminsettings.php" onclick="window.location=('adminsettings.php')"><span><?php echo mysql_result($module,6); ?></span></a></li>
    </ul>
    <div id="tabs-4">
<h3>Task Options</h3>
<form action="inserttas.php" method="post" name="tasktype_form">
<table>
<tr>
<td><select style="width: 390px;" name="actiontypeid">
<option value="">Select an Action Type</option>
<?php
// printing the list box select command
while($nt3=mysql_fetch_array($final3)){//Array or records stored in $nt1
echo "<option value='$nt3[acid]'>$nt3[actiondescr]</option>";
/* Option values are added by looping through the array */
}
?>
</select>
</td>
<td>
<input type="submit" value="Create New Task" id="button-3"/>
</td>
</tr>
</table>
</form>
<p><em>Choosing a Default Action Type, you will have the ability to fill extra fields for this action type</em></p>
<h3>Task Search Criteria</h3>
<form name="form" action="tasksearch.php" method="get">
<table>
<tr>
<td><em>Task Search</em></td>
<td>Order by</td>
</tr>
<tr>
<td><input type="text" name="taskname" /></td>
<td><select name="orderby">
<option value= "ca.actionstartdate desc">Last Task</option>
<option value= "ca.lastupdate desc">Last Changed</option>
<option value= "ca.actionstartdate">Oldest Task</option>
<option value= "ca.descr">Task Description</option>
<option value= "pt.descr">Task Type</option>
<option value= "p1.descr">Person</option>
<option value= "c.descr">Matter</option>
<option value= "st.descr">Status</option>
<option value= "u.full_name">User</option>
</select>
</td>
</tr>
</table>
<table class="lined">
<tr>
<td><select style="width: 390px;" name="personid" onchange="reload(this.form)">
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
</tr>
<tr>
<td><select style="width: 390px;" name="caseid">
<option value="">Select Matter</option>
<?php
// printing the list box select command
while($nt=mysql_fetch_array($quer)){//Array or records stored in $nt
echo "<option value='$nt[cid]'>$nt[casedescr],[Code $nt[cid]]</option>";
/* Option values are added by looping through the array */
}
?>
</select>
</td>
</tr>
</table>
<table>
<tr>
<td><font size="2">From Date:</font></td>
<td><font size="2">Status:</font></td>
</tr>
<tr>
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
<td><select name="status">
<option value="">Select Status</option>
<?php
// printing the list box select command
while($nt5=mysql_fetch_array($final5)){//Array or records stored in $nt1
echo "<option value='$nt5[stid]'>$nt5[statdescr]</option>";
/* Option values are added by looping through the array */
}
?>
</select>
</td>
</tr>
<tr>
<td><font size="2">To Date:</font></td>
</tr>
<tr>
<td>
<?php
Function ShowToDate($year_interval,$YearIntervalType) {
GLOBAL $day,$month,$year;

//DAY
echo "<select name='tday'>\n";
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
echo " / <select name='tmonth'>\n";
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
  echo " / <select name='tyear'>\n";
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
ShowToDate(4,"Both");
?>
</td>
</tr>
</table>
  <br/>
<table>
<tr>
<td><select style="width: 390px;" name="action">
<option value="">Or select an Action Type</option>
<?php
// printing the list box select command
while($nt4=mysql_fetch_array($final4)){//Array or records stored in $nt1
echo "<option value='$nt4[acid]'>$nt4[actiondescr]</option>";
/* Option values are added by looping through the array */
}
?>
</select>
</td>
</tr>
</table>
  <br/>
<table>
<tr>
<td><input type="submit" name="Submit" value="Search" id="button-4" /></td>
</tr>
</table>
</form>
    </div>
  </div>
</div>
<?php include "footer.php"; ?></body>
</html>
