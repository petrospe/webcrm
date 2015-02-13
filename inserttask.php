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

$access=mysql_result($permission, 15);
if($access != "1")
{
echo "<p><a href='#' onclick='history.go(-1);' style='text-decoration:none'>Not permitted</a></p>";
exit;
}
?>
<?php
session_start(tt);
$_SESSION['aid'];
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
<script type="text/JavaScript">
function reload(form)
{
var val=form.personid.options[form.personid.options.selectedIndex].value;
self.location="inserttask.php?personid=" + val ;
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
<h3>New Task Insert</h3>
<?php
  if($_SESSION['aid'] != '') {

$tasktype=$_SESSION['aid'];
 
 //this code is bringing in the values for extraactiontype fields
 $sql="SELECT  distinct  id as prid, descr as actiondescr, lbl_ef1 as extraaction1,  lbl_ef2 as  extraaction2, lbl_ef3 as extraaction3, lbl_ef4 as  extraaction4, lbl_ef5  as extraaction5, lbl_ef6 as extraaction6,  lbl_ef7  as extraaction7,  lbl_ef8 as extraaction8,  lbl_ef9 as extraaction9,  lbl_ef10 as  extraaction10 ,
 txt_ef1_sql as extraquery1, txt_ef2_sql as extraquery2, txt_ef3_sql as extraquery3, txt_ef4_sql as extraquery4, txt_ef5_sql as extraquery5, txt_ef6_sql as extraquery6, txt_ef7_sql as extraquery7, txt_ef8_sql as extraquery8, txt_ef9_sql as extraquery9, txt_ef10_sql as extraquery10   
 FROM proceduretypes
 WHERE id = $tasktype";
 
 $final = mysql_query ($sql); 
 $row2 = mysql_fetch_array($final);

  if($row2['extraquery1']!= '') {
  $exraquery1 = mysql_query($row2['extraquery1']);
  }
  if($row2['extraquery2']!= '') {
  $exraquery2 = mysql_query($row2['extraquery2']);
  }
  if($row2['extraquery3']!= '') {
  $exraquery3 = mysql_query($row2['extraquery3']);
  }
  if($row2['extraquery4']!= '') { 
  $exraquery4 = mysql_query($row2['extraquery4']);
  }
  if($row2['extraquery5']!= '') {
  $exraquery5 = mysql_query($row2['extraquery5']);
  }
  if($row2['extraquery6']!= '') {
  $exraquery6 = mysql_query($row2['extraquery6']);
  }
  if($row2['extraquery7']!= '') {
  $exraquery7 = mysql_query($row2['extraquery7']);
  }
  if($row2['extraquery8']!= '') {
  $exraquery8 = mysql_query($row2['extraquery8']);
  }
  if($row2['extraquery9']!= '') {   
  $exraquery9 = mysql_query($row2['extraquery9']);
  }
  if($row2['extraquery10']!= '') {
  $exraquery10 = mysql_query($row2['extraquery10']);
  } 
    
  }
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
<form action="taskindb.php" method="post" name="inserttask_form" id="commentForm">
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
<td><font size="2">Task Date:</font></td>
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
<td><font size="2">Task Status:</font></td>
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
<td><font size="2">Task Time:</font></td>
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
<tr>
<td><font size="2">Duration:</font></td> 
<td><select name="durhour">
<option value='00'>00</option>
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
</select>
:
<select name="durminute">
<option value='00'>00</option>
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
<option value='32'>32</option>
<option value='33'>33</option>
<option value='34'>34</option>
<option value='35'>35</option>
<option value='36'>36</option>
<option value='37'>37</option>
<option value='38'>38</option>
<option value='39'>39</option>
<option value='40'>40</option>
<option value='41'>41</option>
<option value='42'>42</option>
<option value='43'>43</option>
<option value='44'>44</option>
<option value='45'>45</option>
<option value='46'>46</option>
<option value='47'>47</option>
<option value='48'>48</option>
<option value='49'>49</option>
<option value='50'>50</option>
<option value='51'>51</option>
<option value='52'>52</option>
<option value='53'>53</option>
<option value='54'>54</option>
<option value='55'>55</option>
<option value='56'>56</option>
<option value='57'>57</option>
<option value='58'>58</option>
<option value='59'>59</option>
</select>
</td>
</tr>
</table>
<br/>
<table>
<tr>
<td><h4>Task Description</h4><span style="font-size:11px"><em>If you choose a Default Action Type, it isn't essensial to fill Task Description. Then Task Description will be same to Action Type.</em></span>
</td>
<td><h4>Notes</h4></td>
</tr>
<tr>
<td><textarea rows="4" cols="50" name="descr"></textarea></td>
<td><textarea rows="4" cols="50" name="notes"></textarea></td>
</tr>
</table>

<?php
if($_SESSION['aid'] != '')
{  

echo"<table>";
echo"<tr>";
echo"<td>You selected " .$row2['actiondescr']. "</td>";
echo"<td><input type='hidden' name='actiontypeid' value='$row2[prid]' /></td>";
echo"</tr>";
echo"</table>";


  
if($row2['extraaction1'] != '')
 {
 echo"<table>";
 echo"<tr>";
echo"<td>" . $row2['extraaction1'] . " :</td>";
echo"<td><input type='text' name='extraaction1t' size='50' /></td>";
   if($row2['extraquery1'] != '')
   {
echo"<td>";
echo"<select style='width: 300px;' name='extraaction1'>";
echo"<option value=''>Select from list</option>";
while($nteq1 = mysql_fetch_array($exraquery1)){
echo"<option value='$nteq1[descr]'>$nteq1[descr]</option>";
}
echo "</select>";
echo"</td>";
   }
 echo"</tr>";
 echo"</table>";

 }

if($row2['extraaction2'] != '')
 {
 echo"<table>";
 echo"<tr>";
echo"<td>" . $row2['extraaction2'] . " :</td>";
echo"<td><input type='text' name='extraaction2t' size='50' /></td>";
   if($row2['extraquery2'] != '')
   {
echo"<td>";
echo"<select style='width: 300px;' name='extraaction2'>";
echo"<option value=''>Select from list</option>";
while($nteq2 = mysql_fetch_array($exraquery2)){
echo"<option value='$nteq2[descr]'>$nteq2[descr]</option>";
}
echo "</select>";
echo"</td>";
   }
 echo"</tr>";
 echo"</table>";

 }

if($row2['extraaction3'] != '')
 {
 echo"<table>";
 echo"<tr>";
echo"<td>" . $row2['extraaction3'] . " :</td>";
echo"<td><input type='text' name='extraaction3t' size='50' /></td>";
   if($row2['extraquery3'] != '')
   {
echo"<td>";
echo"<select style='width: 300px;' name='extraaction3'>";
echo"<option value=''>Select from list</option>";
while($nteq3 = mysql_fetch_array($exraquery3)){
echo"<option value='$nteq3[descr]'>$nteq3[descr]</option>";
}
echo "</select>";
echo"</td>";
   }
 echo"</tr>";
 echo"</table>";

 }

if($row2['extraaction4'] != '')
 {
 echo"<table>";
 echo"<tr>";
echo"<td>" . $row2['extraaction4'] . " :</td>";
echo"<td><input type='text' name='extraaction4t' size='50' /></td>";
   if($row2['extraquery4'] != '')
   {
echo"<td>";
echo"<select style='width: 300px;' name='extraaction4'>";
echo"<option value=''>Select from list</option>";
while($nteq4 = mysql_fetch_array($exraquery4)){
echo"<option value='$nteq4[descr]'>$nteq4[descr]</option>";
}
echo "</select>";
echo"</td>";
   }
 echo"</tr>";
 echo"</table>";

 }

if($row2['extraaction5'] != '')
 {
 echo"<table>";
 echo"<tr>";
echo"<td>" . $row2['extraaction5'] . " :</td>";
echo"<td><input type='text' name='extraaction5t' size='50' /></td>";
   if($row2['extraquery5'] != '')
   {
echo"<td>";
echo"<select style='width: 300px;' name='extraaction5'>";
echo"<option value=''>Select from list</option>";
while($nteq5 = mysql_fetch_array($exraquery5)){
echo"<option value='$nteq5[descr]'>$nteq5[descr]</option>";
}
echo "</select>";
echo"</td>";
   }
 echo"</tr>";
 echo"</table>";

 }

if($row2['extraaction6'] != '')
 {
 echo"<table>";
 echo"<tr>";
echo"<td>" . $row2['extraaction6'] . " :</td>";
echo"<td><input type='text' name='extraaction6t' size='50' /></td>";
   if($row2['extraquery6'] != '')
   {
echo"<td>";
echo"<select style='width: 300px;' name='extraaction6'>";
echo"<option value=''>Select from list</option>";
while($nteq6 = mysql_fetch_array($exraquery6)){
echo"<option value='$nteq6[descr]'>$nteq6[descr]</option>";
}
echo "</select>";
echo"</td>";
   }
 echo"</tr>";
 echo"</table>";
 
 }

if($row2['extraaction7'] != '')
 {
 echo"<table>";
 echo"<tr>";
echo"<td>" . $row2['extraaction7'] . " :</td>";
echo"<td><input type='text' name='extraaction7t' size='50' /></td>";
   if($row2['extraquery7'] != '')
   {
echo"<td>";
echo"<select style='width: 300px;' name='extraaction7'>";
echo"<option value=''>Select from list</option>";
while($nteq7 = mysql_fetch_array($exraquery7)){
echo"<option value='$nteq7[descr]'>$nteq7[descr]</option>";
}
echo "</select>";
echo"</td>";
   }
 echo"</tr>";
 echo"</table>";
 
 }

if($row2['extraaction8'] != '')
 {
 echo"<table>";
 echo"<tr>";
echo"<td>" . $row2['extraaction8'] . " :</td>";
echo"<td><input type='text' name='extraaction8t' size='50' /></td>";
   if($row2['extraquery8'] != '')
   {
echo"<td>";
echo"<select style='width: 300px;' name='extraaction8'>";
echo"<option value=''>Select from list</option>";
while($nteq8 = mysql_fetch_array($exraquery8)){
echo"<option value='$nteq8[descr]'>$nteq8[descr]</option>";
}
echo "</select>";
echo"</td>";
   }
 echo"</tr>";
 echo"</table>";
 
 }

if($row2['extraaction9'] != '')
 {
 echo"<table>";
 echo"<tr>";
echo"<td>" . $row2['extraaction9'] . " :</td>";
echo"<td><input type='text' name='extraaction9t' size='50' /></td>";
   if($row2['extraquery9'] != '')
   {
echo"<td>";
echo"<select style='width: 300px;' name='extraaction9'>";
echo"<option value=''>Select from list</option>";
while($nteq9 = mysql_fetch_array($exraquery9)){
echo"<option value='$nteq9[descr]'>$nteq9[descr]</option>";
}
echo "</select>";
echo"</td>";
   }
 echo"</tr>";
 echo"</table>";
 
 }

if($row2['extraaction10'] != '')
 {
 echo"<table>";
 echo"<tr>";
echo"<td>" . $row2['extraaction10'] . " :</td>";
echo"<td><input type='text' name='extraaction10t' size='50' /></td>";
   if($row2['extraquery10'] != '')
   {
echo"<td>";
echo"<select style='width: 300px;' name='extraaction10'>";
echo"<option value=''>Select from list</option>";
while($nteq10 = mysql_fetch_array($exraquery10)){
echo"<option value='$nteq10[descr]'>$nteq10[descr]</option>";
}
echo "</select>";
echo"</td>";
   }
 echo"</tr>";
 echo"</table>";
 
 }

}
?>
  <br />
<table>
<tr>
  <th><input type="submit" value="Insert" name="Submit" id="button-3" onclick="show_alert()" /></th>
  <th><input type="reset" value="Reset" name="Reset" id="button-4" /></th> 
  <th><input type="button" value="Back" onclick="document.location = 'tasks.php';" id="button-5" /></th>
</tr>
</table>
</form>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>
</body>
</html>