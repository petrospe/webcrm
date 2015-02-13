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

$access=mysql_result($permission, 40);
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
<h3>Update Protocol</h3>
<?php
$tid=$_GET['tid'];

//Task to be updated
$sql="SELECT ca.id as Code, ca.descr as Name, aacode as aacode, ca.sendtypeid as sendtypeid,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, ca.fromid as person1id,
case when p2.descr is null then 'Person no exist' else p2.descr end as personto, ca.toid as person2id,
case when c.descr is null then 'Matter no exist' else c.descr end as matter, ca.caseid as matterid,
date_format(ca.actionstartdate,'%d') as day, date_format(ca.actionstartdate,'%m') as month, date_format(ca.actionstartdate,'%Y') as year, date_format(ca.actionstartdate,'%H') as hour, date_format(ca.actionstartdate,'%i') as minute, u.full_name as username, ca.notes as Notes, ca.pinout as pinout,
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.id=$tid
group by ca.id";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$formVars = array();

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
<h4><em>
<?php
if($row['pinout'] == 0)
{
echo 'Incoming Protocol';
}
else if($row['pinout'] == 1)
{
echo 'Outgoing Protocol';
}
?>
</em></h4>
<form action="updateprotocol2.php" method="post" name="updateprotocol_form">
<table>
<tr>
<td><font size="2">Protocol Number: </font></td>
<td><input type="text" name="aacode" value="<?php echo $row['aacode']; ?>" /></td>
</tr>
</table>
<table>
<tr>
<td><font size="2">Date:</font></td>
<td><select name="day">
<option value="<?php echo $row['day']; ?>"><?php echo $row['day']; ?></option>
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
<select name="month">
<option value="<?php echo $row['month']; ?>"><?php echo $row['month']; ?></option>
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
<select name="year">
<option value="<?php echo $row['year']; ?>"><?php echo $row['year']; ?></option>
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
<td><font size="2">Time:</font></td>
<td><select name="hour">
<option value="<?php echo $row['hour']; ?>"><?php echo $row['hour']; ?></option>
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
<select name="minute">
<option value="<?php echo $row['minute']; ?>"><?php echo $row['minute']; ?></option>
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
<td><select name="sendtypeid">
<option value="<?php echo $row['sendtypeid'];?>"><?php echo $row['sendtype'];?></option>
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
<option value="<?php echo $row['person1id'];?>"><?php echo $row['personfrom'];?></option>
<?php
// printing the list box select command
while($nt1=mysql_fetch_array($final1)){
echo "<option value='$nt1[p1id]'>$nt1[persondescr1]</option>";
/* Option values are added by looping through the array */
}
?>
</select></td>
<td><select style="width: 390px;" name="personidto">
<option value="<?php echo $row['person2id'];?>"><?php echo $row['personto'];?></option>
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
<option value="<?php echo $row['matterid'];?>"><?php echo $row['matter'];?></option>
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
<td><textarea name="notes" rows="4" cols="60"><?php echo $row['Notes']; ?></textarea></td>
<td><input type="hidden" name="id" value="<?php echo $row['Code'];?>" /></td>
</tr>
</table>
  <br/>
<table>
<tr>
  <th><input type="submit" value="Update" name="Submit" id="button-3" /></th>
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