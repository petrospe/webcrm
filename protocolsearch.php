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

$access=mysql_result($permission, 39);
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
<link rel="stylesheet"  href= "css/protocoltablestyle.css" />
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
<?php
// Get the search variable from URL

  $var1 = @$_GET['personidfrom'] ;
  $var2 = @$_GET['personidto'] ;
  $var3 = @$_GET['matterid'] ;
  $var4 = @$_GET['fday'] ;
  $var5 = @$_GET['fmonth'] ;
  $var6 = @$_GET['fyear'];
$datefrom=$var6.$var5.$var4;
  $var7 = @$_GET['tday'] ;
  $var8 = @$_GET['tmonth'] ;
  $var9 = @$_GET['tyear'];
$dateto=$var9.$var8.$var7;
  $var10 = @$_GET['r'];
  $var11 = @$_GET['orderby'] ;
  $var12 = @$_GET['sendtypeid'] ;
  $var13 = @$_GET['notes'] ;

echo "<h4>Protocol results</h4>";
echo "<p><a href='protocol.php'>Return to Protocol Options</a>. <a href='#' onclick='window.location.reload( true );'>Reload</a></p>";
echo "<p>Your search returned: </p>";

// Option 1
if($var1 == "" && $var2 == "" && $var3 == "")
{
if($var12 == "" && $var10 == "ANY" && $var13 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto)
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 2
if($var12 == "" && $var10 == "ANY" && $var13 != "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.notes like '%$var13%'
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 3
if($var12 == "" && $var10 == "0" && $var13 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.pinout = 0
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 4
if($var12 == "" && $var10 == "0" && $var13 != "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.pinout = 0 and ca.notes like '%$var13%'
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 5
if($var12 == "" && $var10 == "1" && $var13 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.pinout = 1
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 6
if($var12 == "" && $var10 == "1" && $var13 != "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.pinout = 1 and ca.notes like '%$var13%'
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 7
if($var12 != "" && $var10 == "ANY" && $var13 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.sendtypeid = $var12
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 8
if($var12 != "" && $var10 == "ANY" && $var13 != "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.notes like '%$var13%' and ca.sendtypeid = $var12
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 9
if($var12 != "" && $var10 == "0" && $var13 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.pinout = 0 and ca.sendtypeid = $var12
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 10
if($var12 != "" && $var10 == "0" && $var13 =! "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.pinout = 0 and ca.notes like '%$var13%' and ca.sendtypeid = $var12
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 11
if($var12 != "" && $var10 == "1" && $var13 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.pinout = 1 and ca.sendtypeid = $var12
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 12
if($var12 != "" && $var10 == "1" && $var13 =! "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.pinout = 1 and ca.notes like '%$var13%' and ca.sendtypeid = $var12
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
}
//Option 13
if($var1 != "" && $var2 != "" && $var3 != "")
{
if($var12 == "" && $var10 == "ANY" && $var13 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.fromid = $var1 and ca.toid = $var2 and ca.caseid = $var3
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 14
if($var12 == "" && $var10 == "ANY" && $var13 != "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.notes like '%$var13%' and ca.fromid = $var1 and ca.toid = $var2 and ca.caseid = $var3
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 15
if($var12 == "" && $var10 == "0" && $var13 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.pinout = 0 and ca.fromid = $var1 and ca.toid = $var2 and ca.caseid = $var3
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 16
if($var12 == "" && $var10 == "0" && $var13 != "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.pinout = 0 and ca.notes like '%$var13%' and ca.fromid = $var1 and ca.toid = $var2 and ca.caseid = $var3
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 17
if($var12 == "" && $var10 == "1" && $var13 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.pinout = 1 and ca.fromid = $var1 and ca.toid = $var2 and ca.caseid = $var3
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 18
if($var12 == "" && $var10 == "1" && $var13 != "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.pinout = 1 and ca.notes like '%$var13%' and ca.fromid = $var1 and ca.toid = $var2 and ca.caseid = $var3
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 19
if($var12 != "" && $var10 == "ANY" && $var13 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.sendtypeid = $var12 and ca.fromid = $var1 and ca.toid = $var2 and ca.caseid = $var3
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 20
if($var12 != "" && $var10 == "ANY" && $var13 != "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.notes like '%$var13%' and ca.sendtypeid = $var12 and ca.fromid = $var1 and ca.toid = $var2 and ca.caseid = $var3
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 21
if($var12 != "" && $var10 == "0" && $var13 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.pinout = 0 and ca.sendtypeid = $var12 and ca.fromid = $var1 and ca.toid = $var2 and ca.caseid = $var3
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 22
if($var12 != "" && $var10 == "0" && $var13 =! "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.pinout = 0 and ca.notes like '%$var13%' and ca.sendtypeid = $var12 and ca.fromid = $var1 and ca.toid = $var2 and ca.caseid = $var3
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 23
if($var12 != "" && $var10 == "1" && $var13 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.pinout = 1 and ca.sendtypeid = $var12 and ca.fromid = $var1 and ca.toid = $var2 and ca.caseid = $var3
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 24
if($var12 != "" && $var10 == "1" && $var13 =! "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.pinout = 1 and ca.notes like '%$var13%' and ca.sendtypeid = $var12 and ca.fromid = $var1 and ca.toid = $var2 and ca.caseid = $var3
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
}
//Option 25
if($var1 != "" && $var2 != "" && $var3 == "")
{
if($var12 == "" && $var10 == "ANY" && $var13 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.fromid = $var1 and ca.toid = $var2
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 26
if($var12 == "" && $var10 == "ANY" && $var13 != "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.notes like '%$var13%' and ca.fromid = $var1 and ca.toid = $var2
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 27
if($var12 == "" && $var10 == "0" && $var13 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.pinout = 0 and ca.fromid = $var1 and ca.toid = $var2
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 28
if($var12 == "" && $var10 == "0" && $var13 != "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.pinout = 0 and ca.notes like '%$var13%' and ca.fromid = $var1 and ca.toid = $var2
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 29
if($var12 == "" && $var10 == "1" && $var13 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.pinout = 1 and ca.fromid = $var1 and ca.toid = $var2
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 30
if($var12 == "" && $var10 == "1" && $var13 != "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.pinout = 1 and ca.notes like '%$var13%' and ca.fromid = $var1 and ca.toid = $var2
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 31
if($var12 != "" && $var10 == "ANY" && $var13 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.sendtypeid = $var12 and ca.fromid = $var1 and ca.toid = $var2
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 32
if($var12 != "" && $var10 == "ANY" && $var13 != "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.notes like '%$var13%' and ca.sendtypeid = $var12 and ca.fromid = $var1 and ca.toid = $var2
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 33
if($var12 != "" && $var10 == "0" && $var13 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.pinout = 0 and ca.sendtypeid = $var12 and ca.fromid = $var1 and ca.toid = $var2
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 34
if($var12 != "" && $var10 == "0" && $var13 =! "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.pinout = 0 and ca.notes like '%$var13%' and ca.sendtypeid = $var12 and ca.fromid = $var1 and ca.toid = $var2
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 35
if($var12 != "" && $var10 == "1" && $var13 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.pinout = 1 and ca.sendtypeid = $var12 and ca.fromid = $var1 and ca.toid = $var2
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 36
if($var12 != "" && $var10 == "1" && $var13 =! "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.pinout = 1 and ca.notes like '%$var13%' and ca.sendtypeid = $var12 and ca.fromid = $var1 and ca.toid = $var2
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
}
//Option 37
if($var1 != "" && $var2 == "" && $var3 != "")
{
if($var12 == "" && $var10 == "ANY" && $var13 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.fromid = $var1 and ca.caseid = $var3
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 38
if($var12 == "" && $var10 == "ANY" && $var13 != "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.notes like '%$var13%' and ca.fromid = $var1 and ca.caseid = $var3
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 39
if($var12 == "" && $var10 == "0" && $var13 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.pinout = 0 and ca.fromid = $var1 and ca.caseid = $var3
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 40
if($var12 == "" && $var10 == "0" && $var13 != "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.pinout = 0 and ca.notes like '%$var13%' and ca.fromid = $var1 and ca.caseid = $var3
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 41
if($var12 == "" && $var10 == "1" && $var13 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.pinout = 1 and ca.fromid = $var1 and ca.caseid = $var3
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 42
if($var12 == "" && $var10 == "1" && $var13 != "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.pinout = 1 and ca.notes like '%$var13%' and ca.fromid = $var1 and ca.caseid = $var3
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 43
if($var12 != "" && $var10 == "ANY" && $var13 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.sendtypeid = $var12 and ca.fromid = $var1 and ca.caseid = $var3
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 44
if($var12 != "" && $var10 == "ANY" && $var13 != "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.notes like '%$var13%' and ca.sendtypeid = $var12 and ca.fromid = $var1 and ca.caseid = $var3
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 45
if($var12 != "" && $var10 == "0" && $var13 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.pinout = 0 and ca.sendtypeid = $var12 and ca.fromid = $var1 and ca.caseid = $var3
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 46
if($var12 != "" && $var10 == "0" && $var13 =! "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.pinout = 0 and ca.notes like '%$var13%' and ca.sendtypeid = $var12 and ca.fromid = $var1 and ca.caseid = $var3
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 47
if($var12 != "" && $var10 == "1" && $var13 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.pinout = 1 and ca.sendtypeid = $var12 and ca.fromid = $var1 and ca.caseid = $var3
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 48
if($var12 != "" && $var10 == "1" && $var13 =! "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.pinout = 1 and ca.notes like '%$var13%' and ca.sendtypeid = $var12 and ca.fromid = $var1 and ca.caseid = $var3
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
}
//Option 49
if($var1 == "" && $var2 != "" && $var3 != "")
{
if($var12 == "" && $var10 == "ANY" && $var13 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.toid = $var2 and ca.caseid = $var3
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 50
if($var12 == "" && $var10 == "ANY" && $var13 != "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.notes like '%$var13%' and ca.toid = $var2 and ca.caseid = $var3
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 51
if($var12 == "" && $var10 == "0" && $var13 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.pinout = 0 and ca.toid = $var2 and ca.caseid = $var3
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 52
if($var12 == "" && $var10 == "0" && $var13 != "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.pinout = 0 and ca.notes like '%$var13%' and ca.toid = $var2 and ca.caseid = $var3
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 53
if($var12 == "" && $var10 == "1" && $var13 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.pinout = 1 and ca.toid = $var2 and ca.caseid = $var3
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 54
if($var12 == "" && $var10 == "1" && $var13 != "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.pinout = 1 and ca.notes like '%$var13%' and ca.toid = $var2 and ca.caseid = $var3
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 55
if($var12 != "" && $var10 == "ANY" && $var13 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.sendtypeid = $var12 and ca.toid = $var2 and ca.caseid = $var3
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 56
if($var12 != "" && $var10 == "ANY" && $var13 != "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.notes like '%$var13%' and ca.sendtypeid = $var12 and ca.toid = $var2 and ca.caseid = $var3
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 57
if($var12 != "" && $var10 == "0" && $var13 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.pinout = 0 and ca.sendtypeid = $var12 and ca.toid = $var2 and ca.caseid = $var3
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 58
if($var12 != "" && $var10 == "0" && $var13 =! "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.pinout = 0 and ca.notes like '%$var13%' and ca.sendtypeid = $var12 and ca.toid = $var2 and ca.caseid = $var3
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 59
if($var12 != "" && $var10 == "1" && $var13 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.pinout = 1 and ca.sendtypeid = $var12 and ca.toid = $var2 and ca.caseid = $var3
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 60
if($var12 != "" && $var10 == "1" && $var13 =! "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.pinout = 1 and ca.notes like '%$var13%' and ca.sendtypeid = $var12 and ca.toid = $var2 and ca.caseid = $var3
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
}
//Option 61
if($var1 != "" && $var2 == "" && $var3 == "")
{
if($var12 == "" && $var10 == "ANY" && $var13 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.fromid = $var1
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 62
if($var12 == "" && $var10 == "ANY" && $var13 != "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.notes like '%$var13%' and ca.fromid = $var1
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 63
if($var12 == "" && $var10 == "0" && $var13 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.pinout = 0 and ca.fromid = $var1
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 64
if($var12 == "" && $var10 == "0" && $var13 != "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.pinout = 0 and ca.notes like '%$var13%' and ca.fromid = $var1
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 65
if($var12 == "" && $var10 == "1" && $var13 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.pinout = 1 and ca.fromid = $var1
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 66
if($var12 == "" && $var10 == "1" && $var13 != "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.pinout = 1 and ca.notes like '%$var13%' and ca.fromid = $var1
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 67
if($var12 != "" && $var10 == "ANY" && $var13 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.sendtypeid = $var12 and ca.fromid = $var1
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 68
if($var12 != "" && $var10 == "ANY" && $var13 != "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.notes like '%$var13%' and ca.sendtypeid = $var12 and ca.fromid = $var1
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 69
if($var12 != "" && $var10 == "0" && $var13 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.pinout = 0 and ca.sendtypeid = $var12 and ca.fromid = $var1
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 70
if($var12 != "" && $var10 == "0" && $var13 =! "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.pinout = 0 and ca.notes like '%$var13%' and ca.sendtypeid = $var12 and ca.fromid = $var1
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 71
if($var12 != "" && $var10 == "1" && $var13 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.pinout = 1 and ca.sendtypeid = $var12 and ca.fromid = $var1
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 72
if($var12 != "" && $var10 == "1" && $var13 =! "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.pinout = 1 and ca.notes like '%$var13%' and ca.sendtypeid = $var12 and ca.fromid = $var1
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
}
//Option 73
if($var1 == "" && $var2 != "" && $var3 == "")
{
if($var12 == "" && $var10 == "ANY" && $var13 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.toid = $var2
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 74
if($var12 == "" && $var10 == "ANY" && $var13 != "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.notes like '%$var13%' and ca.toid = $var2
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 75
if($var12 == "" && $var10 == "0" && $var13 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.pinout = 0 and ca.toid = $var2
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 76
if($var12 == "" && $var10 == "0" && $var13 != "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.pinout = 0 and ca.notes like '%$var13%' and ca.toid = $var2
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 77
if($var12 == "" && $var10 == "1" && $var13 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.pinout = 1 and ca.toid = $var2
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 78
if($var12 == "" && $var10 == "1" && $var13 != "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.pinout = 1 and ca.notes like '%$var13%' and ca.toid = $var2
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 79
if($var12 != "" && $var10 == "ANY" && $var13 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.sendtypeid = $var12 and ca.toid = $var2
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 80
if($var12 != "" && $var10 == "ANY" && $var13 != "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.notes like '%$var13%' and ca.sendtypeid = $var12 and ca.toid = $var2
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 81
if($var12 != "" && $var10 == "0" && $var13 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.pinout = 0 and ca.sendtypeid = $var12 and ca.toid = $var2
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 82
if($var12 != "" && $var10 == "0" && $var13 =! "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.pinout = 0 and ca.notes like '%$var13%' and ca.sendtypeid = $var12 and ca.toid = $var2
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 83
if($var12 != "" && $var10 == "1" && $var13 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.pinout = 1 and ca.sendtypeid = $var12 and ca.toid = $var2
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 84
if($var12 != "" && $var10 == "1" && $var13 =! "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.pinout = 1 and ca.notes like '%$var13%' and ca.sendtypeid = $var12 and ca.toid = $var2
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
}
//Option 85
if($var1 == "" && $var2 == "" && $var3 != "")
{
if($var12 == "" && $var10 == "ANY" && $var13 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.caseid = $var3
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 86
if($var12 == "" && $var10 == "ANY" && $var13 != "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.notes like '%$var13%' and ca.caseid = $var3
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 87
if($var12 == "" && $var10 == "0" && $var13 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.pinout = 0 and ca.caseid = $var3
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 88
if($var12 == "" && $var10 == "0" && $var13 != "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.pinout = 0 and ca.notes like '%$var13%' and ca.caseid = $var3
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 89
if($var12 == "" && $var10 == "1" && $var13 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.pinout = 1 and ca.caseid = $var3
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 90
if($var12 == "" && $var10 == "1" && $var13 != "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.pinout = 1 and ca.notes like '%$var13%' and ca.caseid = $var3
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 91
if($var12 != "" && $var10 == "ANY" && $var13 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.sendtypeid = $var12 and ca.caseid = $var3
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 92
if($var12 != "" && $var10 == "ANY" && $var13 != "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.notes like '%$var13%' and ca.sendtypeid = $var12 and ca.caseid = $var3
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 93
if($var12 != "" && $var10 == "0" && $var13 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.pinout = 0 and ca.sendtypeid = $var12 and ca.caseid = $var3
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 94
if($var12 != "" && $var10 == "0" && $var13 =! "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.pinout = 0 and ca.notes like '%$var13%' and ca.sendtypeid = $var12 and ca.caseid = $var3
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 95
if($var12 != "" && $var10 == "1" && $var13 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.pinout = 1 and ca.sendtypeid = $var12 and ca.caseid = $var3
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
//Option 96
if($var12 != "" && $var10 == "1" && $var13 =! "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, aacode as aacode,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, 
case when p2.descr is null then 'Person no exist' else p2.descr end as personto,
case when c.descr is null then 'Matter no exist' else c.descr end as matter,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, ca.notes as notes,
ca.pinout as pinout, 
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 6 and (ca.actionstartdate between $datefrom and $dateto) and ca.pinout = 1 and ca.notes like '%$var13%' and ca.sendtypeid = $var12 and ca.caseid = $var3
order by $var11")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Protocol Type</th>
<th>Protocol Code</th>
<th>Date</th>
<th>Time</th>
<th>From Person</th>
<th>To Person</th>
<th>About Matter</th>
<th>Notes</th>
<th>Send Type</th>
<th>User</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateprotocol1.php?tid=".$row['Code']."'>".$row['Name']."</a></td>";
  echo "<td>". $row['aacode'] ."</td>";
  echo "<td>" . $row['actionstartdate'] . "</td>";
  echo "<td>" . $row['actionstarttime'] . "</td>";
  echo "<td>". $row['personfrom'] ."</td>";
  echo "<td>". $row['personto'] ."</td>";
  echo "<td>" . $row['matter'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td>" . $row['sendtype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td><a href='deleteprotocol.php?q=".$row['Code']."' onclick='return confirmDelete();' >Delete Protocol</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
}
?>
<p><a href="protocol.php">Return to Protocol Options</a></p>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>
</body>
</html>