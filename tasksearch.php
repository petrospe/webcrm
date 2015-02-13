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

$access=mysql_result($permission, 16);
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
<meta http-equiv="refresh" content="60" />
<link rel="shortcut icon" href="images/favicon.ico" />
<link rel="stylesheet"  href= "css/jquery-ui.custom.css" />
<link rel="stylesheet"  href= "css/tasktablestyle.css" />
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
<script type="text/javascript">
function confirmDelete() {
  return confirm("Are you sure you wish to delete this entry?");
}
</script>
<script type="text/javascript" src="js/floatingheader.js"></script>
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
<?php
// Get the search variable from URL

  $var1 = $_GET['taskname'] ;
  $var2 = $_GET['personid'] ;
  $var3 = $_GET['caseid'] ;
  $var4 = @$_GET['fday'] ;
  $var5 = @$_GET['fmonth'] ;
  $var6 = @$_GET['fyear'];
$datefrom=$var6.$var5.$var4;
  $var7 = @$_GET['tday'] ;
  $var8 = @$_GET['tmonth'] ;
  $var9 = @$_GET['tyear'];
$dateto=$var9.$var8.$var7;
  $var10 = @$_GET['action'];
  $var11 = @$_GET['orderby'] ;
  $var12 = @$_GET['status'];

echo "<h4>Task results</h4>";
echo "<p> <a href='tasks.php'>Return to Task Options</a>. <a href='#' onclick='window.location.reload( true );'>Reload</a></p>";
echo "<p>Your search returned: </p>";

//Option 1
if($var12 == "")
{
// taskname not null
if($var1 != "")
{
//personid not null
if($var2 !="")
{
if($var3 == "" && $var10 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, pt.descr as Type,
case when ca.personid is not null then p.descr
when cp.personid is not null then group_concat(p1.descr separator '<br/>')
end as Person,
case when
ca.caseid is null then 'Matter no exist'
else c.descr
end as Matter,date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, date_format(ca.duration,'%H:%i') as duration, st.descr as status, ca.notes as Notes
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join cases c on ca.caseid=c.id
left join person p on p.id = ca.personid
left join person p1 on cp.personid = p1.id
left join proceduretypes pt on pt.id = ca.proceduretypeid
left join users u on u.id = ca.userid
left join status st on st.id = ca.statusid
where ca.isdeleted = 0 and ca.actiontypeid = 1 and (ca.actionstartdate between $datefrom and $dateto) and (ca.descr like \"%$var1%\" or u.full_name like \"%$var1%\") and (p.id =$var2 or cp.personid =$var2)
group by ca.id
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Task Description</th>
<th>Task Type</th>
<th>Associated Person</th>
<th>Matter</th>
<th>Date</th>
<th>Time</th>
<th>Duration</th>
<th>Status</th>
<th>User</th>
<th>Notes</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updatetask1.php?tid=" . $row['Code'] . "'>".$row['Name']."</a></td>";
  echo "<td>". $row['Type'] ."</td>";
  echo "<td>". $row['Person'] ."</td>";
  echo "<td>" . $row['Matter'] . "</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>" . $row['duration'] . "</td>";
  echo "<td>" . $row['status'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" . $row['Notes'] . "</td>";
  echo "<td><a href='deletetask1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Task</a></td>";
  echo "</tr>";
  }
echo "</table>";
}
// Option 2
else
if($var3 != "" && $var10 != "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, pt.descr as Type, ca.proceduretypeid as prid,
case when ca.personid is not null then p.descr
when cp.personid is not null then group_concat(p1.descr separator '<br/>')
end as Person,
case when
ca.caseid is null then 'Matter no exist'
else c.descr
end as Matter, ca.caseid as cid, date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, date_format(ca.duration,'%H:%i') as duration, st.descr as status, ca.notes as Notes
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join cases c on ca.caseid=c.id
left join person p on p.id = ca.personid
left join person p1 on cp.personid = p1.id
left join proceduretypes pt on pt.id = ca.proceduretypeid
left join users u on u.id = ca.userid
left join status st on st.id = ca.statusid
where ca.isdeleted = 0 and ca.actiontypeid = 1 and (ca.actionstartdate between $datefrom and $dateto) and (ca.descr like \"%$var1%\" or u.full_name like \"%$var1%\") and ca.caseid=$var3 and  ca.proceduretypeid=$var10 and (p.id =$var2 or cp.personid =$var2)
group by ca.id
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Task Description</th>
<th>Task Type</th>
<th>Associated Person</th>
<th>Matter</th>
<th>Date</th>
<th>Time</th>
<th>Duration</th>
<th>Status</th>
<th>User</th>
<th>Notes</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updatetask1.php?tid=" . $row['Code'] . "'>".$row['Name']."</a></td>";
  echo "<td>". $row['Type'] ."</td>";
  echo "<td>". $row['Person'] ."</td>";
  echo "<td>" . $row['Matter'] . "</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>" . $row['duration'] . "</td>";
  echo "<td>" . $row['status'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" . $row['Notes'] . "</td>";
  echo "<td><a href='deletetask1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Task</a></td>";
  echo "</tr>";
  }
echo "</table>";
}
// Option 3
else
if($var3 != "" && $var10 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, pt.descr as Type,
case when ca.personid is not null then p.descr
when cp.personid is not null then group_concat(p1.descr separator '<br/>')
end as Person,
ca.personid as pid,
case when
ca.caseid is null then 'Matter no exist'
else c.descr
end as Matter,
ca.caseid as cid, date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, date_format(ca.duration,'%H:%i') as duration, st.descr as status, ca.notes as Notes
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join cases c on ca.caseid=c.id
left join person p on p.id = ca.personid
left join person p1 on cp.personid = p1.id
left join proceduretypes pt on pt.id = ca.proceduretypeid
left join users u on u.id = ca.userid
left join status st on st.id = ca.statusid
where ca.isdeleted = 0 and ca.actiontypeid = 1 and (ca.actionstartdate between $datefrom and $dateto) and (ca.descr like \"%$var1%\" or u.full_name like \"%$var1%\") and ca.caseid=$var3 and (p.id =$var2 or cp.personid =$var2)
group by ca.id
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Task Description</th>
<th>Task Type</th>
<th>Associated Person</th>
<th>Matter</th>
<th>Date</th>
<th>Time</th>
<th>Duration</th>
<th>Status</th>
<th>User</th>
<th>Notes</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updatetask1.php?tid=" . $row['Code'] . "'>".$row['Name']."</a></td>";
  echo "<td>". $row['Type'] ."</td>";
  echo "<td>". $row['Person'] ."</td>";
  echo "<td>" . $row['Matter'] . "</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>" . $row['duration'] . "</td>";
  echo "<td>" . $row['status'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" . $row['Notes'] . "</td>";
  echo "<td><a href='deletetask1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Task</a></td>";
  echo "</tr>";
  }
echo "</table>";
}
// Option 4
else
if($var3 == "" && $var10 != "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, pt.descr as Type, ca.proceduretypeid as prid,
case when ca.personid is not null then p.descr
when cp.personid is not null then group_concat(p1.descr separator '<br/>')
end as Person,
case when
ca.caseid is null then 'Matter no exist'
else c.descr
end as Matter,date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, date_format(ca.duration,'%H:%i') as duration, st.descr as status, ca.notes as Notes
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join cases c on ca.caseid=c.id
left join person p on p.id = ca.personid
left join person p1 on cp.personid = p1.id
left join proceduretypes pt on pt.id = ca.proceduretypeid
left join users u on u.id = ca.userid
left join status st on st.id = ca.statusid
where ca.isdeleted = 0 and ca.actiontypeid = 1 and (ca.actionstartdate between $datefrom and $dateto) and (ca.descr like \"%$var1%\" or u.full_name like \"%$var1%\") and ca.proceduretypeid=$var10 and (p.id =$var2 or cp.personid =$var2)
group by ca.id
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Task Description</th>
<th>Task Type</th>
<th>Associated Person</th>
<th>Matter</th>
<th>Date</th>
<th>Time</th>
<th>Duration</th>
<th>Status</th>
<th>User</th>
<th>Notes</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updatetask1.php?tid=" . $row['Code'] . "'>".$row['Name']."</a></td>";
  echo "<td>". $row['Type'] ."</td>";
  echo "<td>". $row['Person'] ."</td>";
  echo "<td>" . $row['Matter'] . "</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>" . $row['duration'] . "</td>";
  echo "<td>" . $row['status'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" . $row['Notes'] . "</td>";
  echo "<td><a href='deletetask1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Task</a></td>";
  echo "</tr>";
  }
echo "</table>";
}
}
//Option 5
//personid is null
if($var2 =="")
{
if($var3 == "" && $var10 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, pt.descr as Type,
case when ca.personid is not null then p.descr
when cp.personid is not null then group_concat(p1.descr separator '<br/>')
end as Person,
case when
ca.caseid is null then 'Matter no exist'
else c.descr
end as Matter,date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, date_format(ca.duration,'%H:%i') as duration, st.descr as status, ca.notes as Notes
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join cases c on ca.caseid=c.id
left join person p on p.id = ca.personid
left join person p1 on cp.personid = p1.id
left join proceduretypes pt on pt.id = ca.proceduretypeid
left join users u on u.id = ca.userid
left join status st on st.id = ca.statusid
where ca.isdeleted = 0 and ca.actiontypeid = 1 and (ca.actionstartdate between $datefrom and $dateto) and (ca.descr like \"%$var1%\" or u.full_name like \"%$var1%\")
group by ca.id
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Task Description</th>
<th>Task Type</th>
<th>Associated Person</th>
<th>Matter</th>
<th>Date</th>
<th>Time</th>
<th>Duration</th>
<th>Status</th>
<th>User</th>
<th>Notes</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updatetask1.php?tid=" . $row['Code'] . "'>".$row['Name']."</a></td>";
  echo "<td>". $row['Type'] ."</td>";
  echo "<td>". $row['Person'] ."</td>";
  echo "<td>" . $row['Matter'] . "</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>" . $row['duration'] . "</td>";
  echo "<td>" . $row['status'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" . $row['Notes'] . "</td>";
  echo "<td><a href='deletetask1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Task</a></td>";
  echo "</tr>";
  }
echo "</table>";
}
// Option 6
else
if($var3 != "" && $var10 != "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, pt.descr as Type, ca.proceduretypeid as prid,
case when ca.personid is not null then p.descr
when cp.personid is not null then group_concat(p1.descr separator '<br/>')
end as Person,
case when
ca.caseid is null then 'Matter no exist'
else c.descr
end as Matter, ca.caseid as cid, date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, date_format(ca.duration,'%H:%i') as duration, st.descr as status, ca.notes as Notes
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join cases c on ca.caseid=c.id
left join person p on p.id = ca.personid
left join person p1 on cp.personid = p1.id
left join proceduretypes pt on pt.id = ca.proceduretypeid
left join users u on u.id = ca.userid
left join status st on st.id = ca.statusid
where ca.isdeleted = 0 and ca.actiontypeid = 1 and (ca.actionstartdate between $datefrom and $dateto) and (ca.descr like \"%$var1%\" or u.full_name like \"%$var1%\") and ca.caseid=$var3 and  ca.proceduretypeid=$var10
group by ca.id
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Task Description</th>
<th>Task Type</th>
<th>Associated Person</th>
<th>Matter</th>
<th>Date</th>
<th>Time</th>
<th>Duration</th>
<th>Status</th>
<th>User</th>
<th>Notes</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updatetask1.php?tid=" . $row['Code'] . "'>".$row['Name']."</a></td>";
  echo "<td>". $row['Type'] ."</td>";
  echo "<td>". $row['Person'] ."</td>";
  echo "<td>" . $row['Matter'] . "</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>" . $row['duration'] . "</td>";
  echo "<td>" . $row['status'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" . $row['Notes'] . "</td>";
  echo "<td><a href='deletetask1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Task</a></td>";
  echo "</tr>";
  }
echo "</table>";
}
// Option 7
else
if($var3 != "" && $var10 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, pt.descr as Type,
case when ca.personid is not null then p.descr
when cp.personid is not null then group_concat(p1.descr separator '<br/>')
end as Person,
ca.personid as pid,
case when
ca.caseid is null then 'Matter no exist'
else c.descr
end as Matter,
ca.caseid as cid, date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, date_format(ca.duration,'%H:%i') as duration, st.descr as status, ca.notes as Notes
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join cases c on ca.caseid=c.id
left join person p on p.id = ca.personid
left join person p1 on cp.personid = p1.id
left join proceduretypes pt on pt.id = ca.proceduretypeid
left join users u on u.id = ca.userid
left join status st on st.id = ca.statusid
where ca.isdeleted = 0 and ca.actiontypeid = 1 and (ca.actionstartdate between $datefrom and $dateto) and (ca.descr like \"%$var1%\" or u.full_name like \"%$var1%\") and ca.caseid=$var3
group by ca.id
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Task Description</th>
<th>Task Type</th>
<th>Associated Person</th>
<th>Matter</th>
<th>Date</th>
<th>Time</th>
<th>Duration</th>
<th>Status</th>
<th>User</th>
<th>Notes</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updatetask1.php?tid=" . $row['Code'] . "'>".$row['Name']."</a></td>";
  echo "<td>". $row['Type'] ."</td>";
  echo "<td>". $row['Person'] ."</td>";
  echo "<td>" . $row['Matter'] . "</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>" . $row['duration'] . "</td>";
  echo "<td>" . $row['status'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" . $row['Notes'] . "</td>";
  echo "<td><a href='deletetask1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Task</a></td>";
  echo "</tr>";
  }
echo "</table>";
}
// Option 8
else
if($var3 == "" && $var10 != "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, pt.descr as Type, ca.proceduretypeid as prid,
case when ca.personid is not null then p.descr
when cp.personid is not null then group_concat(p1.descr separator '<br/>')
end as Person,
case when
ca.caseid is null then 'Matter no exist'
else c.descr
end as Matter,date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, date_format(ca.duration,'%H:%i') as duration, st.descr as status, ca.notes as Notes
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join cases c on ca.caseid=c.id
left join person p on p.id = ca.personid
left join person p1 on cp.personid = p1.id
left join proceduretypes pt on pt.id = ca.proceduretypeid
left join users u on u.id = ca.userid
left join status st on st.id = ca.statusid
where ca.isdeleted = 0 and ca.actiontypeid = 1 and (ca.actionstartdate between $datefrom and $dateto) and (ca.descr like \"%$var1%\" or u.full_name like \"%$var1%\") and ca.proceduretypeid=$var10
group by ca.id
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Task Description</th>
<th>Task Type</th>
<th>Associated Person</th>
<th>Matter</th>
<th>Date</th>
<th>Time</th>
<th>Duration</th>
<th>Status</th>
<th>User</th>
<th>Notes</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updatetask1.php?tid=" . $row['Code'] . "'>".$row['Name']."</a></td>";
  echo "<td>". $row['Type'] ."</td>";
  echo "<td>". $row['Person'] ."</td>";
  echo "<td>" . $row['Matter'] . "</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>" . $row['duration'] . "</td>";
  echo "<td>" . $row['status'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" . $row['Notes'] . "</td>";
  echo "<td><a href='deletetask1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Task</a></td>";
  echo "</tr>";
  }
echo "</table>";
}
}
}
//Option 9 taskname null
else
if($var1 == "")
{
if($var2 == "")
{
if($var3 == "" && $var10 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, pt.descr as Type,
case when ca.personid is not null then p.descr
when cp.personid is not null then group_concat(p1.descr separator '<br/>')
end as Person,
case when
ca.caseid is null then 'Matter no exist'
else c.descr
end as Matter,date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, date_format(ca.duration,'%H:%i') as duration, st.descr as status, ca.notes as Notes
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join cases c on ca.caseid=c.id
left join person p on p.id = ca.personid
left join person p1 on cp.personid = p1.id
left join proceduretypes pt on pt.id = ca.proceduretypeid
left join users u on u.id = ca.userid
left join status st on st.id = ca.statusid
where ca.isdeleted = 0 and ca.actiontypeid = 1 and (ca.actionstartdate between $datefrom and $dateto)
group by ca.id
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";
echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Task Description</th>
<th>Task Type</th>
<th>Associated Person</th>
<th>Matter</th>
<th>Date</th>
<th>Time</th>
<th>Duration</th>
<th>Status</th>
<th>User</th>
<th>Notes</th>
<th>Delete</th>
</tr>";
echo"</thead>";

while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updatetask1.php?tid=" . $row['Code'] . "'>".$row['Name']."</a></td>";
  echo "<td>". $row['Type'] ."</td>";
  echo "<td>". $row['Person'] ."</td>";
  echo "<td>" . $row['Matter'] . "</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>" . $row['duration'] . "</td>";
  echo "<td>" . $row['status'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" . $row['Notes'] . "</td>";
  echo "<td><a href='deletetask1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Task</a></td>";
  echo "</tr>";
  }
echo "</table>";
}
else
//Option 10
if($var3 != "" && $var10 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, pt.descr as Type,
case when ca.personid is not null then p.descr
when cp.personid is not null then group_concat(p1.descr separator '<br/>')
end as Person,
case when
ca.caseid is null then 'Matter no exist'
else c.descr
end as Matter, ca.caseid as cid, date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, date_format(ca.duration,'%H:%i') as duration, st.descr as status, ca.notes as Notes
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join cases c on ca.caseid=c.id
left join person p on p.id = ca.personid
left join person p1 on cp.personid = p1.id
left join proceduretypes pt on pt.id = ca.proceduretypeid
left join users u on u.id = ca.userid
left join status st on st.id = ca.statusid
where ca.isdeleted = 0 and ca.actiontypeid = 1 and (ca.actionstartdate between $datefrom and $dateto) and  ca.caseid=$var3
group by ca.id
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Task Description</th>
<th>Task Type</th>
<th>Associated Person</th>
<th>Matter</th>
<th>Date</th>
<th>Time</th>
<th>Duration</th>
<th>Status</th>
<th>User</th>
<th>Notes</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updatetask1.php?tid=" . $row['Code'] . "'>".$row['Name']."</a></td>";
  echo "<td>". $row['Type'] ."</td>";
  echo "<td>". $row['Person'] ."</td>";
  echo "<td>" . $row['Matter'] . "</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>" . $row['duration'] . "</td>";
  echo "<td>" . $row['status'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" . $row['Notes'] . "</td>";
  echo "<td><a href='deletetask1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Task</a></td>";
  echo "</tr>";
  }
echo "</table>";
}
// Option 11
else
if($var3 == "" && $var10 != "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, pt.descr as Type, ca.proceduretypeid as prid,
case when ca.personid is not null then p.descr
when cp.personid is not null then group_concat(p1.descr separator '<br/>')
end as Person,
case when
ca.caseid is null then 'Matter no exist'
else c.descr
end as Matter,date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, date_format(ca.duration,'%H:%i') as duration, st.descr as status, ca.notes as Notes
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join cases c on ca.caseid=c.id
left join person p on p.id = ca.personid
left join person p1 on cp.personid = p1.id
left join proceduretypes pt on pt.id = ca.proceduretypeid
left join users u on u.id = ca.userid
left join status st on st.id = ca.statusid
where ca.isdeleted = 0 and ca.actiontypeid = 1 and (ca.actionstartdate between $datefrom and $dateto) and ca.proceduretypeid=$var10
group by ca.id
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Task Description</th>
<th>Task Type</th>
<th>Associated Person</th>
<th>Matter</th>
<th>Date</th>
<th>Time</th>
<th>Duration</th>
<th>Status</th>
<th>User</th>
<th>Notes</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updatetask1.php?tid=" . $row['Code'] . "'>".$row['Name']."</a></td>";
  echo "<td>". $row['Type'] ."</td>";
  echo "<td>". $row['Person'] ."</td>";
  echo "<td>" . $row['Matter'] . "</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>" . $row['duration'] . "</td>";
  echo "<td>" . $row['status'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" . $row['Notes'] . "</td>";
  echo "<td><a href='deletetask1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Task</a></td>";
  echo "</tr>";
  }
echo "</table>";
}
// Option 12
else
if($var3 != "" && $var10 != "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, pt.descr as Type, ca.proceduretypeid as prid,
case when ca.personid is not null then p.descr
when cp.personid is not null then group_concat(p1.descr separator '<br/>')
end as Person,
case when
ca.caseid is null then 'Matter no exist'
else c.descr
end as Matter, ca.caseid as cid, date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, date_format(ca.duration,'%H:%i') as duration, st.descr as status, ca.notes as Notes
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join cases c on ca.caseid=c.id
left join person p on p.id = ca.personid
left join person p1 on cp.personid = p1.id
left join proceduretypes pt on pt.id = ca.proceduretypeid
left join users u on u.id = ca.userid
left join status st on st.id = ca.statusid
where ca.isdeleted = 0 and ca.actiontypeid = 1 and (ca.actionstartdate between $datefrom and $dateto) and ca.caseid=$var3 and ca.proceduretypeid=$var10
group by ca.id
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Task Description</th>
<th>Task Type</th>
<th>Associated Person</th>
<th>Matter</th>
<th>Date</th>
<th>Time</th>
<th>Duration</th>
<th>Status</th>
<th>User</th>
<th>Notes</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updatetask1.php?tid=" . $row['Code'] . "'>".$row['Name']."</a></td>";
  echo "<td>". $row['Type'] ."</td>";
  echo "<td>". $row['Person'] ."</td>";
  echo "<td>" . $row['Matter'] . "</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>" . $row['duration'] . "</td>";
  echo "<td>" . $row['status'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" . $row['Notes'] . "</td>";
  echo "<td><a href='deletetask1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Task</a></td>";
  echo "</tr>";
  }
echo "</table>";
}
}
//Option 13
else
if($var2 != "")
{
if($var3 == "" && $var10 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, pt.descr as Type,
case when ca.personid is not null then p.descr
when cp.personid is not null then group_concat(p1.descr separator '<br/>')
end as Person,
case when
ca.caseid is null then 'Matter no exist'
else c.descr
end as Matter,date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, date_format(ca.duration,'%H:%i') as duration, st.descr as status, ca.notes as Notes
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join cases c on ca.caseid=c.id
left join person p on p.id = ca.personid
left join person p1 on cp.personid = p1.id
left join proceduretypes pt on pt.id = ca.proceduretypeid
left join users u on u.id = ca.userid
left join status st on st.id = ca.statusid
where ca.isdeleted = 0 and ca.actiontypeid = 1 and (ca.actionstartdate between $datefrom and $dateto) and (ca.personid = $var2 or cp.personid = $var2)
group by ca.id
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Task Description</th>
<th>Task Type</th>
<th>Associated Person</th>
<th>Matter</th>
<th>Date</th>
<th>Time</th>
<th>Duration</th>
<th>Status</th>
<th>User</th>
<th>Notes</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updatetask1.php?tid=" . $row['Code'] . "'>".$row['Name']."</a></td>";
  echo "<td>". $row['Type'] ."</td>";
  echo "<td>". $row['Person'] ."</td>";
  echo "<td>" . $row['Matter'] . "</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>" . $row['duration'] . "</td>";
  echo "<td>" . $row['status'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" . $row['Notes'] . "</td>";
  echo "<td><a href='deletetask1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Task</a></td>";
  echo "</tr>";
  }
echo "</table>";
}
else
//Option 14
if($var3 != "" && $var10 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, pt.descr as Type,
case when ca.personid is not null then p.descr
when cp.personid is not null then group_concat(p1.descr separator '<br/>')
end as Person,
case when
ca.caseid is null then 'Matter no exist'
else c.descr
end as Matter, ca.caseid as cid, date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, date_format(ca.duration,'%H:%i') as duration, st.descr as status, ca.notes as Notes
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join cases c on ca.caseid=c.id
left join person p on p.id = ca.personid
left join person p1 on cp.personid = p1.id
left join proceduretypes pt on pt.id = ca.proceduretypeid
left join users u on u.id = ca.userid
left join status st on st.id = ca.statusid
where ca.isdeleted = 0 and ca.actiontypeid = 1 and (ca.actionstartdate between $datefrom and $dateto) and (ca.personid = $var2 or cp.personid = $var2) and ca.caseid=$var3
group by ca.id
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Task Description</th>
<th>Task Type</th>
<th>Associated Person</th>
<th>Matter</th>
<th>Date</th>
<th>Time</th>
<th>Duration</th>
<th>Status</th>
<th>User</th>
<th>Notes</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updatetask1.php?tid=" . $row['Code'] . "'>".$row['Name']."</a></td>";
  echo "<td>". $row['Type'] ."</td>";
  echo "<td>". $row['Person'] ."</td>";
  echo "<td>" . $row['Matter'] . "</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>" . $row['duration'] . "</td>";
  echo "<td>" . $row['status'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" . $row['Notes'] . "</td>";
  echo "<td><a href='deletetask1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Task</a></td>";
  echo "</tr>";
  }
echo "</table>";
}
// Option 15
else
if($var3 == "" && $var10 != "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, pt.descr as Type, ca.proceduretypeid as prid,
case when ca.personid is not null then p.descr
when cp.personid is not null then group_concat(p1.descr separator '<br/>')
end as Person,
case when
ca.caseid is null then 'Matter no exist'
else c.descr
end as Matter,date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, date_format(ca.duration,'%H:%i') as duration, st.descr as status, ca.notes as Notes
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join cases c on ca.caseid=c.id
left join person p on p.id = ca.personid
left join person p1 on cp.personid = p1.id
left join proceduretypes pt on pt.id = ca.proceduretypeid
left join users u on u.id = ca.userid
left join status st on st.id = ca.statusid
where ca.isdeleted = 0 and ca.actiontypeid = 1 and (ca.actionstartdate between $datefrom and $dateto) and (ca.personid = $var2 or cp.personid = $var2) and ca.proceduretypeid=$var10
group by ca.id
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Task Description</th>
<th>Task Type</th>
<th>Associated Person</th>
<th>Matter</th>
<th>Date</th>
<th>Time</th>
<th>Duration</th>
<th>Status</th>
<th>User</th>
<th>Notes</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updatetask1.php?tid=" . $row['Code'] . "'>".$row['Name']."</a></td>";
  echo "<td>". $row['Type'] ."</td>";
  echo "<td>". $row['Person'] ."</td>";
  echo "<td>" . $row['Matter'] . "</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>" . $row['duration'] . "</td>";
  echo "<td>" . $row['status'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" . $row['Notes'] . "</td>";
  echo "<td><a href='deletetask1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Task</a></td>";
  echo "</tr>";
  }
echo "</table>";
}
// Option 16
else
if($var3 != "" && $var10 != "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, pt.descr as Type, ca.proceduretypeid as prid,
case when ca.personid is not null then p.descr
when cp.personid is not null then group_concat(p1.descr separator '<br/>')
end as Person,
case when
ca.caseid is null then 'Matter no exist'
else c.descr
end as Matter, ca.caseid as cid, date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, date_format(ca.duration,'%H:%i') as duration, st.descr as status, ca.notes as Notes
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join cases c on ca.caseid=c.id
left join person p on p.id = ca.personid
left join person p1 on cp.personid = p1.id
left join proceduretypes pt on pt.id = ca.proceduretypeid
left join users u on u.id = ca.userid
left join status st on st.id = ca.statusid
where ca.isdeleted = 0 and ca.actiontypeid = 1 and (ca.actionstartdate between $datefrom and $dateto)  and (ca.personid = $var2 or cp.personid = $var2) and ca.caseid=$var3 and ca.proceduretypeid=$var10
group by ca.id
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Task Description</th>
<th>Task Type</th>
<th>Associated Person</th>
<th>Matter</th>
<th>Date</th>
<th>Time</th>
<th>Duration</th>
<th>Status</th>
<th>User</th>
<th>Notes</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updatetask1.php?tid=" . $row['Code'] . "'>".$row['Name']."</a></td>";
  echo "<td>". $row['Type'] ."</td>";
  echo "<td>". $row['Person'] ."</td>";
  echo "<td>" . $row['Matter'] . "</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>" . $row['duration'] . "</td>";
  echo "<td>" . $row['status'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" . $row['Notes'] . "</td>";
  echo "<td><a href='deletetask1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Task</a></td>";
  echo "</tr>";
  }
echo "</table>";
}
}
}
}
//Option 17
if($var12 != "")
{
// taskname not null
if($var1 != "")
{
//personid is not null
if($var2 != "")
{
if($var3 == "" && $var10 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, pt.descr as Type,
case when ca.personid is not null then p.descr
when cp.personid is not null then group_concat(p1.descr separator '<br/>')
end as Person,
case when
ca.caseid is null then 'Matter no exist'
else c.descr
end as Matter,date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, date_format(ca.duration,'%H:%i') as duration, st.descr as status, ca.notes as Notes
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join cases c on ca.caseid=c.id
left join person p on p.id = ca.personid
left join person p1 on cp.personid = p1.id
left join proceduretypes pt on pt.id = ca.proceduretypeid
left join users u on u.id = ca.userid
left join status st on st.id = ca.statusid
where ca.isdeleted = 0 and ca.actiontypeid = 1 and ca.statusid = $var12 and (ca.actionstartdate between $datefrom and $dateto) and (ca.descr like \"%$var1%\" or u.full_name like \"%$var1%\") and (p.id =$var2 or cp.personid =$var2)
group by ca.id
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Task Description</th>
<th>Task Type</th>
<th>Associated Person</th>
<th>Matter</th>
<th>Date</th>
<th>Time</th>
<th>Duration</th>
<th>Status</th>
<th>User</th>
<th>Notes</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updatetask1.php?tid=" . $row['Code'] . "'>".$row['Name']."</a></td>";
  echo "<td>". $row['Type'] ."</td>";
  echo "<td>". $row['Person'] ."</td>";
  echo "<td>" . $row['Matter'] . "</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>" . $row['duration'] . "</td>";
  echo "<td>" . $row['status'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" . $row['Notes'] . "</td>";
  echo "<td><a href='deletetask1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Task</a></td>";
  echo "</tr>";
  }
echo "</table>";
}
// Option 18
else
if($var3 != "" && $var10 != "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, pt.descr as Type, ca.proceduretypeid as prid,
case when ca.personid is not null then p.descr
when cp.personid is not null then group_concat(p1.descr separator '<br/>')
end as Person,
case when
ca.caseid is null then 'Matter no exist'
else c.descr
end as Matter, ca.caseid as cid, date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, date_format(ca.duration,'%H:%i') as duration, st.descr as status, ca.notes as Notes
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join cases c on ca.caseid=c.id
left join person p on p.id = ca.personid
left join person p1 on cp.personid = p1.id
left join proceduretypes pt on pt.id = ca.proceduretypeid
left join users u on u.id = ca.userid
left join status st on st.id = ca.statusid
where ca.isdeleted = 0 and ca.actiontypeid = 1 and ca.statusid = $var12 and (ca.actionstartdate between $datefrom and $dateto) and (ca.descr like \"%$var1%\" or u.full_name like \"%$var1%\") and ca.caseid=$var3 and ca.proceduretypeid=$var10 and (p.id =$var2 or cp.personid =$var2)
group by ca.id
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Task Description</th>
<th>Task Type</th>
<th>Associated Person</th>
<th>Matter</th>
<th>Date</th>
<th>Time</th>
<th>Duration</th>
<th>Status</th>
<th>User</th>
<th>Notes</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updatetask1.php?tid=" . $row['Code'] . "'>".$row['Name']."</a></td>";
  echo "<td>". $row['Type'] ."</td>";
  echo "<td>". $row['Person'] ."</td>";
  echo "<td>" . $row['Matter'] . "</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>" . $row['duration'] . "</td>";
  echo "<td>" . $row['status'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" . $row['Notes'] . "</td>";
  echo "<td><a href='deletetask1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Task</a></td>";
  echo "</tr>";
  }
echo "</table>";
}
// Option 19
else
if($var3 != "" && $var10 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, pt.descr as Type,
case when ca.personid is not null then p.descr
when cp.personid is not null then group_concat(p1.descr separator '<br/>')
end as Person,
ca.personid as pid,
case when
ca.caseid is null then 'Matter no exist'
else c.descr
end as Matter,
ca.caseid as cid, date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, date_format(ca.duration,'%H:%i') as duration, st.descr as status, ca.notes as Notes
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join cases c on ca.caseid=c.id
left join person p on p.id = ca.personid
left join person p1 on cp.personid = p1.id
left join proceduretypes pt on pt.id = ca.proceduretypeid
left join users u on u.id = ca.userid
left join status st on st.id = ca.statusid
where ca.isdeleted = 0 and ca.actiontypeid = 1 and ca.statusid = $var12 and (ca.actionstartdate between $datefrom and $dateto) and (ca.descr like \"%$var1%\" or u.full_name like \"%$var1%\") and ca.caseid=$var3 and (p.id =$var2 or cp.personid =$var2)
group by ca.id
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Task Description</th>
<th>Task Type</th>
<th>Associated Person</th>
<th>Matter</th>
<th>Date</th>
<th>Time</th>
<th>Duration</th>
<th>Status</th>
<th>User</th>
<th>Notes</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updatetask1.php?tid=" . $row['Code'] . "'>".$row['Name']."</a></td>";
  echo "<td>". $row['Type'] ."</td>";
  echo "<td>". $row['Person'] ."</td>";
  echo "<td>" . $row['Matter'] . "</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>" . $row['duration'] . "</td>";
  echo "<td>" . $row['status'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" . $row['Notes'] . "</td>";
  echo "<td><a href='deletetask1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Task</a></td>";
  echo "</tr>";
  }
echo "</table>";
}
// Option 20
else
if($var3 == "" && $var10 != "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, pt.descr as Type, ca.proceduretypeid as prid,
case when ca.personid is not null then p.descr
when cp.personid is not null then group_concat(p1.descr separator '<br/>')
end as Person,
case when
ca.caseid is null then 'Matter no exist'
else c.descr
end as Matter,date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, date_format(ca.duration,'%H:%i') as duration, st.descr as status, ca.notes as Notes
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join cases c on ca.caseid=c.id
left join person p on p.id = ca.personid
left join person p1 on cp.personid = p1.id
left join proceduretypes pt on pt.id = ca.proceduretypeid
left join users u on u.id = ca.userid
left join status st on st.id = ca.statusid
where ca.isdeleted = 0 and ca.actiontypeid = 1 and ca.statusid = $var12 and (ca.actionstartdate between $datefrom and $dateto) and (ca.descr like \"%$var1%\" or u.full_name like \"%$var1%\") and ca.proceduretypeid=$var10 and (p.id =$var2 or cp.personid =$var2)
group by ca.id
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Task Description</th>
<th>Task Type</th>
<th>Associated Person</th>
<th>Matter</th>
<th>Date</th>
<th>Time</th>
<th>Duration</th>
<th>Status</th>
<th>User</th>
<th>Notes</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updatetask1.php?tid=" . $row['Code'] . "'>".$row['Name']."</a></td>";
  echo "<td>". $row['Type'] ."</td>";
  echo "<td>". $row['Person'] ."</td>";
  echo "<td>" . $row['Matter'] . "</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>" . $row['duration'] . "</td>";
  echo "<td>" . $row['status'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" . $row['Notes'] . "</td>";
  echo "<td><a href='deletetask1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Task</a></td>";
  echo "</tr>";
  }
echo "</table>";
}
}
//Option 21
//personid is null
if($var2 == "")
{
if($var3 == "" && $var10 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, pt.descr as Type,
case when ca.personid is not null then p.descr
when cp.personid is not null then group_concat(p1.descr separator '<br/>')
end as Person,
case when
ca.caseid is null then 'Matter no exist'
else c.descr
end as Matter,date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, date_format(ca.duration,'%H:%i') as duration, st.descr as status, ca.notes as Notes
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join cases c on ca.caseid=c.id
left join person p on p.id = ca.personid
left join person p1 on cp.personid = p1.id
left join proceduretypes pt on pt.id = ca.proceduretypeid
left join users u on u.id = ca.userid
left join status st on st.id = ca.statusid
where ca.isdeleted = 0 and ca.actiontypeid = 1 and ca.statusid = $var12 and (ca.actionstartdate between $datefrom and $dateto) and (ca.descr like \"%$var1%\" or u.full_name like \"%$var1%\")
group by ca.id
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Task Description</th>
<th>Task Type</th>
<th>Associated Person</th>
<th>Matter</th>
<th>Date</th>
<th>Time</th>
<th>Duration</th>
<th>Status</th>
<th>User</th>
<th>Notes</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updatetask1.php?tid=" . $row['Code'] . "'>".$row['Name']."</a></td>";
  echo "<td>". $row['Type'] ."</td>";
  echo "<td>". $row['Person'] ."</td>";
  echo "<td>" . $row['Matter'] . "</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>" . $row['duration'] . "</td>";
  echo "<td>" . $row['status'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" . $row['Notes'] . "</td>";
  echo "<td><a href='deletetask1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Task</a></td>";
  echo "</tr>";
  }
echo "</table>";
}
// Option 22
else
if($var3 != "" && $var10 != "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, pt.descr as Type, ca.proceduretypeid as prid,
case when ca.personid is not null then p.descr
when cp.personid is not null then group_concat(p1.descr separator '<br/>')
end as Person,
case when
ca.caseid is null then 'Matter no exist'
else c.descr
end as Matter, ca.caseid as cid, date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, date_format(ca.duration,'%H:%i') as duration, st.descr as status, ca.notes as Notes
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join cases c on ca.caseid=c.id
left join person p on p.id = ca.personid
left join person p1 on cp.personid = p1.id
left join proceduretypes pt on pt.id = ca.proceduretypeid
left join users u on u.id = ca.userid
left join status st on st.id = ca.statusid
where ca.isdeleted = 0 and ca.actiontypeid = 1 and ca.statusid = $var12 and (ca.actionstartdate between $datefrom and $dateto) and (ca.descr like \"%$var1%\" or u.full_name like \"%$var1%\") and ca.caseid=$var3 and ca.proceduretypeid=$var10
group by ca.id
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Task Description</th>
<th>Task Type</th>
<th>Associated Person</th>
<th>Matter</th>
<th>Date</th>
<th>Time</th>
<th>Duration</th>
<th>Status</th>
<th>User</th>
<th>Notes</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updatetask1.php?tid=" . $row['Code'] . "'>".$row['Name']."</a></td>";
  echo "<td>". $row['Type'] ."</td>";
  echo "<td>". $row['Person'] ."</td>";
  echo "<td>" . $row['Matter'] . "</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>" . $row['duration'] . "</td>";
  echo "<td>" . $row['status'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" . $row['Notes'] . "</td>";
  echo "<td><a href='deletetask1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Task</a></td>";
  echo "</tr>";
  }
echo "</table>";
}
// Option 23
else
if($var3 != "" && $var10 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, pt.descr as Type,
case when ca.personid is not null then p.descr
when cp.personid is not null then group_concat(p1.descr separator '<br/>')
end as Person,
ca.personid as pid,
case when
ca.caseid is null then 'Matter no exist'
else c.descr
end as Matter,
ca.caseid as cid, date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, date_format(ca.duration,'%H:%i') as duration, st.descr as status, ca.notes as Notes
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join cases c on ca.caseid=c.id
left join person p on p.id = ca.personid
left join person p1 on cp.personid = p1.id
left join proceduretypes pt on pt.id = ca.proceduretypeid
left join users u on u.id = ca.userid
left join status st on st.id = ca.statusid
where ca.isdeleted = 0 and ca.actiontypeid = 1 and ca.statusid = $var12 and (ca.actionstartdate between $datefrom and $dateto) and (ca.descr like \"%$var1%\" or u.full_name like \"%$var1%\") and ca.caseid=$var3
group by ca.id
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Task Description</th>
<th>Task Type</th>
<th>Associated Person</th>
<th>Matter</th>
<th>Date</th>
<th>Time</th>
<th>Duration</th>
<th>Status</th>
<th>User</th>
<th>Notes</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updatetask1.php?tid=" . $row['Code'] . "'>".$row['Name']."</a></td>";
  echo "<td>". $row['Type'] ."</td>";
  echo "<td>". $row['Person'] ."</td>";
  echo "<td>" . $row['Matter'] . "</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>" . $row['duration'] . "</td>";
  echo "<td>" . $row['status'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" . $row['Notes'] . "</td>";
  echo "<td><a href='deletetask1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Task</a></td>";
  echo "</tr>";
  }
echo "</table>";
}
// Option 24
else
if($var3 == "" && $var10 != "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, pt.descr as Type, ca.proceduretypeid as prid,
case when ca.personid is not null then p.descr
when cp.personid is not null then group_concat(p1.descr separator '<br/>')
end as Person,
case when
ca.caseid is null then 'Matter no exist'
else c.descr
end as Matter,date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, date_format(ca.duration,'%H:%i') as duration, st.descr as status, ca.notes as Notes
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join cases c on ca.caseid=c.id
left join person p on p.id = ca.personid
left join person p1 on cp.personid = p1.id
left join proceduretypes pt on pt.id = ca.proceduretypeid
left join users u on u.id = ca.userid
left join status st on st.id = ca.statusid
where ca.isdeleted = 0 and ca.actiontypeid = 1 and ca.statusid = $var12 and (ca.actionstartdate between $datefrom and $dateto) and (ca.descr like \"%$var1%\" or u.full_name like \"%$var1%\") and ca.proceduretypeid=$var10
group by ca.id
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Task Description</th>
<th>Task Type</th>
<th>Associated Person</th>
<th>Matter</th>
<th>Date</th>
<th>Time</th>
<th>Duration</th>
<th>Status</th>
<th>User</th>
<th>Notes</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updatetask1.php?tid=" . $row['Code'] . "'>".$row['Name']."</a></td>";
  echo "<td>". $row['Type'] ."</td>";
  echo "<td>". $row['Person'] ."</td>";
  echo "<td>" . $row['Matter'] . "</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>" . $row['duration'] . "</td>";
  echo "<td>" . $row['status'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" . $row['Notes'] . "</td>";
  echo "<td><a href='deletetask1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Task</a></td>";
  echo "</tr>";
  }
echo "</table>";
}
}
}
//Option 25 taskname null
else
if($var1 == "")
{
if($var2 == "")
{
if($var3 == "" && $var10 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, pt.descr as Type,
case when ca.personid is not null then p.descr
when cp.personid is not null then group_concat(p1.descr separator '<br/>')
end as Person,
case when
ca.caseid is null then 'Matter no exist'
else c.descr
end as Matter,date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, date_format(ca.duration,'%H:%i') as duration, st.descr as status, ca.notes as Notes
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join cases c on ca.caseid=c.id
left join person p on p.id = ca.personid
left join person p1 on cp.personid = p1.id
left join proceduretypes pt on pt.id = ca.proceduretypeid
left join users u on u.id = ca.userid
left join status st on st.id = ca.statusid
where ca.isdeleted = 0 and ca.actiontypeid = 1 and ca.statusid = $var12 and (ca.actionstartdate between $datefrom and $dateto)
group by ca.id
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Task Description</th>
<th>Task Type</th>
<th>Associated Person</th>
<th>Matter</th>
<th>Date</th>
<th>Time</th>
<th>Duration</th>
<th>Status</th>
<th>User</th>
<th>Notes</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updatetask1.php?tid=" . $row['Code'] . "'>".$row['Name']."</a></td>";
  echo "<td>". $row['Type'] ."</td>";
  echo "<td>". $row['Person'] ."</td>";
  echo "<td>" . $row['Matter'] . "</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>" . $row['duration'] . "</td>";
  echo "<td>" . $row['status'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" . $row['Notes'] . "</td>";
  echo "<td><a href='deletetask1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Task</a></td>";
  echo "</tr>";
  }
echo "</table>";
}
else
//Option 26
if($var3 != "" && $var10 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, pt.descr as Type,
case when ca.personid is not null then p.descr
when cp.personid is not null then group_concat(p1.descr separator '<br/>')
end as Person,
case when
ca.caseid is null then 'Matter no exist'
else c.descr
end as Matter, ca.caseid as cid, date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, date_format(ca.duration,'%H:%i') as duration, st.descr as status, ca.notes as Notes
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join cases c on ca.caseid=c.id
left join person p on p.id = ca.personid
left join person p1 on cp.personid = p1.id
left join proceduretypes pt on pt.id = ca.proceduretypeid
left join users u on u.id = ca.userid
left join status st on st.id = ca.statusid
where ca.isdeleted = 0 and ca.actiontypeid = 1 and ca.statusid = $var12 and (ca.actionstartdate between $datefrom and $dateto) and  ca.caseid=$var3
group by ca.id
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Task Description</th>
<th>Task Type</th>
<th>Associated Person</th>
<th>Matter</th>
<th>Date</th>
<th>Time</th>
<th>Duration</th>
<th>Status</th>
<th>User</th>
<th>Notes</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updatetask1.php?tid=" . $row['Code'] . "'>".$row['Name']."</a></td>";
  echo "<td>". $row['Type'] ."</td>";
  echo "<td>". $row['Person'] ."</td>";
  echo "<td>" . $row['Matter'] . "</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>" . $row['duration'] . "</td>";
  echo "<td>" . $row['status'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" . $row['Notes'] . "</td>";
  echo "<td><a href='deletetask1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Task</a></td>";
  echo "</tr>";
  }
echo "</table>";
}
// Option 27
else
if($var3 == "" && $var10 != "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, pt.descr as Type, ca.proceduretypeid as prid,
case when ca.personid is not null then p.descr
when cp.personid is not null then group_concat(p1.descr separator '<br/>')
end as Person,
case when
ca.caseid is null then 'Matter no exist'
else c.descr
end as Matter,date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, date_format(ca.duration,'%H:%i') as duration, st.descr as status, ca.notes as Notes
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join cases c on ca.caseid=c.id
left join person p on p.id = ca.personid
left join person p1 on cp.personid = p1.id
left join proceduretypes pt on pt.id = ca.proceduretypeid
left join users u on u.id = ca.userid
left join status st on st.id = ca.statusid
where ca.isdeleted = 0 and ca.actiontypeid = 1 and ca.statusid = $var12 and (ca.actionstartdate between $datefrom and $dateto) and ca.proceduretypeid=$var10
group by ca.id
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Task Description</th>
<th>Task Type</th>
<th>Associated Person</th>
<th>Matter</th>
<th>Date</th>
<th>Time</th>
<th>Duration</th>
<th>Status</th>
<th>User</th>
<th>Notes</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updatetask1.php?tid=" . $row['Code'] . "'>".$row['Name']."</a></td>";
  echo "<td>". $row['Type'] ."</td>";
  echo "<td>". $row['Person'] ."</td>";
  echo "<td>" . $row['Matter'] . "</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>" . $row['duration'] . "</td>";
  echo "<td>" . $row['status'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" . $row['Notes'] . "</td>";
  echo "<td><a href='deletetask1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Task</a></td>";
  echo "</tr>";
  }
echo "</table>";
}
// Option 28
else
if($var3 != "" && $var10 != "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, pt.descr as Type, ca.proceduretypeid as prid,
case when ca.personid is not null then p.descr
when cp.personid is not null then group_concat(p1.descr separator '<br/>')
end as Person,
case when
ca.caseid is null then 'Matter no exist'
else c.descr
end as Matter, ca.caseid as cid, date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, date_format(ca.duration,'%H:%i') as duration, st.descr as status, ca.notes as Notes
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join cases c on ca.caseid=c.id
left join person p on p.id = ca.personid
left join person p1 on cp.personid = p1.id
left join proceduretypes pt on pt.id = ca.proceduretypeid
left join users u on u.id = ca.userid
left join status st on st.id = ca.statusid
where ca.isdeleted = 0 and ca.actiontypeid = 1 and ca.statusid = $var12 and (ca.actionstartdate between $datefrom and $dateto) and ca.caseid=$var3 and ca.proceduretypeid=$var10
group by ca.id
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Task Description</th>
<th>Task Type</th>
<th>Associated Person</th>
<th>Matter</th>
<th>Date</th>
<th>Time</th>
<th>Duration</th>
<th>Status</th>
<th>User</th>
<th>Notes</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updatetask1.php?tid=" . $row['Code'] . "'>".$row['Name']."</a></td>";
  echo "<td>". $row['Type'] ."</td>";
  echo "<td>". $row['Person'] ."</td>";
  echo "<td>" . $row['Matter'] . "</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>" . $row['duration'] . "</td>";
  echo "<td>" . $row['status'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" . $row['Notes'] . "</td>";
  echo "<td><a href='deletetask1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Task</a></td>";
  echo "</tr>";
  }
echo "</table>";
}
}
//Option 29
else
if($var2 != "")
{
if($var3 == "" && $var10 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, pt.descr as Type,
case when ca.personid is not null then p.descr
when cp.personid is not null then group_concat(p1.descr separator '<br/>')
end as Person,
case when
ca.caseid is null then 'Matter no exist'
else c.descr
end as Matter,date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, date_format(ca.duration,'%H:%i') as duration, st.descr as status, ca.notes as Notes
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join cases c on ca.caseid=c.id
left join person p on p.id = ca.personid
left join person p1 on cp.personid = p1.id
left join proceduretypes pt on pt.id = ca.proceduretypeid
left join users u on u.id = ca.userid
left join status st on st.id = ca.statusid
where ca.isdeleted = 0 and ca.actiontypeid = 1 and ca.statusid = $var12 and (ca.actionstartdate between $datefrom and $dateto) and (ca.personid = $var2 or cp.personid = $var2)
group by ca.id
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Task Description</th>
<th>Task Type</th>
<th>Associated Person</th>
<th>Matter</th>
<th>Date</th>
<th>Time</th>
<th>Duration</th>
<th>Status</th>
<th>User</th>
<th>Notes</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updatetask1.php?tid=" . $row['Code'] . "'>".$row['Name']."</a></td>";
  echo "<td>". $row['Type'] ."</td>";
  echo "<td>". $row['Person'] ."</td>";
  echo "<td>" . $row['Matter'] . "</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>" . $row['duration'] . "</td>";
  echo "<td>" . $row['status'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" . $row['Notes'] . "</td>";
  echo "<td><a href='deletetask1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Task</a></td>";
  echo "</tr>";
  }
echo "</table>";
}
else
//Option 30
if($var3 != "" && $var10 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, pt.descr as Type,
case when ca.personid is not null then p.descr
when cp.personid is not null then group_concat(p1.descr separator '<br/>')
end as Person,
case when
ca.caseid is null then 'Matter no exist'
else c.descr
end as Matter, ca.caseid as cid, date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, date_format(ca.duration,'%H:%i') as duration, st.descr as status, ca.notes as Notes
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join cases c on ca.caseid=c.id
left join person p on p.id = ca.personid
left join person p1 on cp.personid = p1.id
left join proceduretypes pt on pt.id = ca.proceduretypeid
left join users u on u.id = ca.userid
left join status st on st.id = ca.statusid
where ca.isdeleted = 0 and ca.actiontypeid = 1 and ca.statusid = $var12 and (ca.actionstartdate between $datefrom and $dateto) and (ca.personid = $var2 or cp.personid = $var2) and ca.caseid=$var3
group by ca.id
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Task Description</th>
<th>Task Type</th>
<th>Associated Person</th>
<th>Matter</th>
<th>Date</th>
<th>Time</th>
<th>Duration</th>
<th>Status</th>
<th>User</th>
<th>Notes</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updatetask1.php?tid=" . $row['Code'] . "'>".$row['Name']."</a></td>";
  echo "<td>". $row['Type'] ."</td>";
  echo "<td>". $row['Person'] ."</td>";
  echo "<td>" . $row['Matter'] . "</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>" . $row['duration'] . "</td>";
  echo "<td>" . $row['status'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" . $row['Notes'] . "</td>";
  echo "<td><a href='deletetask1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Task</a></td>";
  echo "</tr>";
  }
echo "</table>";
}
// Option 31
else
if($var3 == "" && $var10 != "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, pt.descr as Type, ca.proceduretypeid as prid,
case when ca.personid is not null then p.descr
when cp.personid is not null then group_concat(p1.descr separator '<br/>')
end as Person,
case when
ca.caseid is null then 'Matter no exist'
else c.descr
end as Matter,date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, date_format(ca.duration,'%H:%i') as duration, st.descr as status, ca.notes as Notes
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join cases c on ca.caseid=c.id
left join person p on p.id = ca.personid
left join person p1 on cp.personid = p1.id
left join proceduretypes pt on pt.id = ca.proceduretypeid
left join users u on u.id = ca.userid
left join status st on st.id = ca.statusid
where ca.isdeleted = 0 and ca.actiontypeid = 1 and ca.statusid = $var12 and (ca.actionstartdate between $datefrom and $dateto) and (ca.personid = $var2 or cp.personid = $var2) and ca.proceduretypeid=$var10
group by ca.id
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Task Description</th>
<th>Task Type</th>
<th>Associated Person</th>
<th>Matter</th>
<th>Date</th>
<th>Time</th>
<th>Duration</th>
<th>Status</th>
<th>User</th>
<th>Notes</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updatetask1.php?tid=" . $row['Code'] . "'>".$row['Name']."</a></td>";
  echo "<td>". $row['Type'] ."</td>";
  echo "<td>". $row['Person'] ."</td>";
  echo "<td>" . $row['Matter'] . "</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>" . $row['duration'] . "</td>";
  echo "<td>" . $row['status'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" . $row['Notes'] . "</td>";
  echo "<td><a href='deletetask1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Task</a></td>";
  echo "</tr>";
  }
echo "</table>";
}
// Option 32
else
if($var3 != "" && $var10 != "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, pt.descr as Type, ca.proceduretypeid as prid,
case when ca.personid is not null then p.descr
when cp.personid is not null then group_concat(p1.descr separator '<br/>')
end as Person,
case when
ca.caseid is null then 'Matter no exist'
else c.descr
end as Matter, ca.caseid as cid, date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, date_format(ca.duration,'%H:%i') as duration, st.descr as status, ca.notes as Notes
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join cases c on ca.caseid=c.id
left join person p on p.id = ca.personid
left join person p1 on cp.personid = p1.id
left join proceduretypes pt on pt.id = ca.proceduretypeid
left join users u on u.id = ca.userid
left join status st on st.id = ca.statusid
where ca.isdeleted = 0 and ca.actiontypeid = 1 and ca.statusid = $var12 and (ca.actionstartdate between $datefrom and $dateto)  and (ca.personid = $var2 or cp.personid = $var2) and ca.caseid=$var3 and ca.proceduretypeid=$var10
group by ca.id
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Task Description</th>
<th>Task Type</th>
<th>Associated Person</th>
<th>Matter</th>
<th>Date</th>
<th>Time</th>
<th>Duration</th>
<th>Status</th>
<th>User</th>
<th>Notes</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updatetask1.php?tid=" . $row['Code'] . "'>".$row['Name']."</a></td>";
  echo "<td>". $row['Type'] ."</td>";
  echo "<td>". $row['Person'] ."</td>";
  echo "<td>" . $row['Matter'] . "</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>" . $row['duration'] . "</td>";
  echo "<td>" . $row['status'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" . $row['Notes'] . "</td>";
  echo "<td><a href='deletetask1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Task</a></td>";
  echo "</tr>";
  }
echo "</table>";
}
}
}
}
?>
<p><a href="tasks.php">Return to Task Options</a></p>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>
</body>
</html>