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

$access=mysql_result($permission, 7);
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
<link href= "css/mattertablestyle.css" rel="stylesheet" type="text/css" />
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
function confirmDelete() {
  return confirm("Are you sure you wish to delete this entry?");
}
</script>
<script type="text/javascript" src="floatingheader.js"></script>
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
<?php
// Get the search variable from URL

  $var1 = @$_GET['p'] ;
  $var3 = @$_GET['r'] ;
  $var2 = @$_GET['t'] ;
  $var5 = @$_GET['orderby'] ;
  $var6 = @$_GET['MAPE'];

//Set $var4 value
if($var2 !="IS NOT NULL" || $var2 !="IS NULL")
{
$var4 = '='.$var2;
}
if($var2 =="IS NOT NULL")
{
$var4 = $var2;
}
if($var2 =="IS NULL")
{
$var4 = $var2;
}

echo "<h4>Matter results</h4>";
echo "<p><a href='matters.php'>Return to Matters Options</a>. <a href='#' onclick='window.location.reload( true );'>Reload</a></p>";
echo "<p>Your search returned: </p>";

// Check if exist Matters per Person option
if ($var6 != "1")
    {
// Option 1
if ($var3 == "ANY")
  {
if($var1 != "")
{
  $result = mysql_query( "SELECT c.id as Code, c.descr as Name, group_concat(p.descr separator '<br/>') as Person, cp.personid as cpid, group_concat(at.descr separator '<br/>') as personattrib, date_format(c.opendate,'%d-%m-%Y') as opendate, ct.descr as Type, u.full_name as username, date_format(c.closedate,'%d-%m-%Y') as closedate, cn.descr as Notes
FROM cases c
left join casetoperson cp on cp.caseid=c.id
left join person p on p.id = cp.personid
left join casetype ct on ct.id = c.casetypeid
left join attributes at on at.id=cp.attributeid
left join users u on u.id = c.userid
left join casenotes cn on cn.caseid=c.id
where c.isdeleted = 0 and p.isdeleted = 0 and 
(p.descr like '%$var1%' or c.descr like '%$var1%' or ct.descr like '%$var1%' or u.full_name like '%$var1%' or cn.descr like '%$var1%' or c.id like '%$var1%')
and at.id $var4
group by c.id
order by $var5")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Code</th>
<th>Matter Description</th>
<th>Associated Person</th>
<th>Matter Person Attribute</th>
<th>Open Date</th>
<th>Matter Type</th>
<th>User</th>
<th>Close Date</th>
<th>Notes</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updatematter3.php?ccid=" . $row['Code'] . "'>".$row['Code']."</a><br/><a href='matterperson.php?ccid=" . $row['Code'] . "'>Edit Matter Persons</a></td>";
  echo "<td>" . $row['Name'] . "</td>";
  echo "<td>". $row['Person'] ."</td>";
  echo "<td>" . $row['personattrib'] . "</td>";
  echo "<td>" . $row['opendate'] . "</td>";
  echo "<td>" . $row['Type'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" . $row['closedate'] . "</td>";
  echo "<td>" . $row['Notes'] . "</td>";
  echo "<td><a href='deletematter3.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Matter</a></td>";
  echo "</tr>";
  }
echo "</table>";
'mysql_close';
}

// Option 2
else
if ($var1 == "")
{
  $result = mysql_query( "SELECT c.id as Code, c.descr as Name, group_concat(p.descr separator '<br/>') as Person, cp.personid as cpid, group_concat(at.descr separator '<br/>') as personattrib, date_format(c.opendate,'%d-%m-%Y') as opendate, ct.descr as Type, u.full_name as username, date_format(c.closedate,'%d-%m-%Y') as closedate, cn.descr as Notes
FROM cases c
left join casetoperson cp on cp.caseid=c.id
left join person p on p.id = cp.personid
left join casetype ct on ct.id = c.casetypeid
left join attributes at on at.id=cp.attributeid
left join users u on u.id = c.userid
left join casenotes cn on cn.caseid=c.id
where c.isdeleted = 0  and p.isdeleted = 0 and at.id $var4
group by c.id
order by $var5")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);
print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Code</th>
<th>Matter Description</th>
<th>Associated Person</th>
<th>Matter Person Attribute</th>
<th>Open Date</th>
<th>Matter Type</th>
<th>User</th>
<th>Close Date</th>
<th>Notes</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updatematter3.php?ccid=" . $row['Code'] . "'>".$row['Code']."</a><br/><a href='matterperson.php?ccid=" . $row['Code'] . "'>Edit Matter Persons</a></td>";
  echo "<td>" . $row['Name'] . "</td>";
  echo "<td>". $row['Person'] ."</td>";
  echo "<td>" . $row['personattrib'] . "</td>";
  echo "<td>" . $row['opendate'] . "</td>";
  echo "<td>" . $row['Type'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" . $row['closedate'] . "</td>";
  echo "<td>" . $row['Notes'] . "</td>";
  echo "<td><a href='deletematter3.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Matter</a></td>";
  echo "</tr>";
  }
echo "</table>";
'mysql_close';
}
}
// Option 3
if ($var3 != "ANY")
{
if($var1 != "")
{
  $result = mysql_query( "SELECT c.id as Code, c.descr as Name, group_concat(p.descr separator '<br/>') as Person, cp.personid as cpid, group_concat(at.descr separator '<br/>') as personattrib, date_format(c.opendate,'%d-%m-%Y') as opendate, ct.descr as Type, u.full_name as username, date_format(c.closedate,'%d-%m-%Y') as closedate, cn.descr as Notes
FROM cases c
left join casetoperson cp on cp.caseid=c.id
left join person p on p.id = cp.personid
left join casetype ct on ct.id = c.casetypeid
left join attributes at on at.id=cp.attributeid
left join users u on u.id = c.userid
left join casenotes cn on cn.caseid=c.id
where c.isdeleted = 0 and p.isdeleted = 0 and 
(p.descr like '%$var1%' or c.descr like '%$var1%' or ct.descr like '%$var1%' or u.full_name like '%$var1%' or cn.descr like '%$var1%' or c.id like '%$var1%')
and at.id $var4 and c.closedate $var3
group by c.id
order by $var5")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);
print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Code</th>
<th>Matter Description</th>
<th>Associated Person</th>
<th>Matter Person Attribute</th>
<th>Open Date</th>
<th>Matter Type</th>
<th>User</th>
<th>Close Date</th>
<th>Notes</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updatematter3.php?ccid=" . $row['Code'] . "'>".$row['Code']."</a><br/><a href='matterperson.php?ccid=" . $row['Code'] . "'>Edit Matter Persons</a></td>";
  echo "<td>" . $row['Name'] . "</td>";
  echo "<td>". $row['Person'] ."</td>";
  echo "<td>" . $row['personattrib'] . "</td>";
  echo "<td>" . $row['opendate'] . "</td>";
  echo "<td>" . $row['Type'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" . $row['closedate'] . "</td>";
  echo "<td>" . $row['Notes'] . "</td>";
  echo "<td><a href='deletematter3.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Matter</a></td>";
  echo "</tr>";
  }
echo "</table>";
'mysql_close';
}

// Option 4
else
if ($var1 == "")
{
  $result = mysql_query( "SELECT c.id as Code, c.descr as Name, group_concat(p.descr separator '<br/>') as Person, cp.personid as cpid, group_concat(at.descr separator '<br/>') as personattrib, date_format(c.opendate,'%d-%m-%Y') as opendate, ct.descr as Type, u.full_name as username, date_format(c.closedate,'%d-%m-%Y') as closedate, cn.descr as Notes
FROM cases c
left join casetoperson cp on cp.caseid=c.id
left join person p on p.id = cp.personid
left join casetype ct on ct.id = c.casetypeid
left join attributes at on at.id=cp.attributeid
left join users u on u.id = c.userid
left join casenotes cn on cn.caseid=c.id
where c.isdeleted = 0 and p.isdeleted = 0 and at.id $var4 and c.closedate $var3
group by c.id
order by $var5")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);
print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Code</th>
<th>Matter Description</th>
<th>Associated Person</th>
<th>Matter Person Attribute</th>
<th>Open Date</th>
<th>Matter Type</th>
<th>User</th>
<th>Close Date</th>
<th>Notes</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updatematter3.php?ccid=" . $row['Code'] . "'>".$row['Code']."</a><br/><a href='matterperson.php?ccid=" . $row['Code'] . "'>Edit Matter Persons</a></td>";
  echo "<td>" . $row['Name'] . "</td>";
  echo "<td>". $row['Person'] ."</td>";
  echo "<td>" . $row['personattrib'] . "</td>";
  echo "<td>" . $row['opendate'] . "</td>";
  echo "<td>" . $row['Type'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" . $row['closedate'] . "</td>";
  echo "<td>" . $row['Notes'] . "</td>";
  echo "<td><a href='deletematter3.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Matter</a></td>";
  echo "</tr>";
  }
echo "</table>";
'mysql_close';
}
 }
  }
else
// OPTION Matters per Person
if ($var6 == "1")
    {
//Matter Status Both
if($var3 == "ANY")
  {
//Option 5
if($var1 == "")
{
  $result = mysql_query( "SELECT group_concat(c.id separator '<br/>') as Code, p.id as pid, p.descr as Person, group_concat(c.descr separator '<br/>') as Name, group_concat(at.descr separator '<br/>') as personattrib
FROM casetoperson cp
left join person p on p.id = cp.personid
left join cases c on c.id = cp.caseid
left join attributes at on at.id = cp.attributeid
where c.isdeleted = 0 and p.isdeleted = 0 and p.isdeleted = 0 and at.id $var4
group by p.descr
order by $var5")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);
print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Associated Person</th>
<th>Matter Description</th>
<th>Matter Codes</th>
<th>Matter Person Attribute</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='personsearch.php?p=" . $row['pid'] . "'>" . $row['Person'] . "</a></td>";
  echo "<td>" . $row['Name'] . "</td>";
  echo "<td>" . $row['Code'] . "</td>";
  echo "<td>" . $row['personattrib'] . "</td>";
  echo "</tr>";
  }
echo "</table>";
'mysql_close';
}
else
//Option 6
if($var1 != "")
{
  $result = mysql_query( "SELECT group_concat(c.id separator '<br/>') as Code, p.id as pid, p.descr as Person, group_concat(c.descr separator '<br/>') as Name, group_concat(at.descr separator '<br/>') as personattrib
FROM casetoperson cp
left join person p on p.id = cp.personid
left join cases c on c.id = cp.caseid
left join attributes at on at.id = cp.attributeid
where c.isdeleted = 0 and p.isdeleted = 0 and at.id $var4 and 
(p.descr like '%$var1%' or c.descr like '%$var1%')
group by p.descr
order by $var5")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);
print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Associated Person</th>
<th>Matter Description</th>
<th>Matter Codes</th>
<th>Matter Person Attribute</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='personsearch.php?p=" . $row['pid'] . "'>" . $row['Person'] . "</a></td>";
  echo "<td>" . $row['Name'] . "</td>";
  echo "<td>" . $row['Code'] . "</td>";
  echo "<td>" . $row['personattrib'] . "</td>";
  echo "</tr>";
  }
echo "</table>";
'mysql_close';
}
  }
//Matter Status IS NOT BOTH
else
if($var3 != "ANY")
  {
//Option 7
if($var1 == "")
{
  $result = mysql_query( "SELECT group_concat(c.id separator '<br/>') as Code, p.id as pid, p.descr as Person, group_concat(c.descr separator '<br/>') as Name, group_concat(at.descr separator '<br/>') as personattrib
FROM casetoperson cp
left join person p on p.id = cp.personid
left join cases c on c.id = cp.caseid
left join attributes at on at.id = cp.attributeid
where c.isdeleted = 0 and p.isdeleted = 0 and p.isdeleted = 0 and at.id $var4 and c.closedate $var3
group by p.descr
order by $var5")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);
print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Associated Person</th>
<th>Matter Description</th>
<th>Matter Codes</th>
<th>Matter Person Attribute</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='personsearch.php?p=" . $row['pid'] . "'>" . $row['Person'] . "</a></td>";
  echo "<td>" . $row['Name'] . "</td>";
  echo "<td>" . $row['Code'] . "</td>";
  echo "<td>" . $row['personattrib'] . "</td>";
  echo "</tr>";
  }
echo "</table>";
'mysql_close';
}
else
//Option 8
if($var1 != "")
{
  $result = mysql_query( "SELECT group_concat(c.id separator '<br/>') as Code, p.id as pid, p.descr as Person, group_concat(c.descr separator '<br/>') as Name, group_concat(at.descr separator '<br/>') as personattrib
FROM casetoperson cp
left join person p on p.id = cp.personid
left join cases c on c.id = cp.caseid
left join attributes at on at.id = cp.attributeid
where c.isdeleted = 0 and p.isdeleted = 0 and at.id $var4 and 
(p.descr like '%$var1%' or c.descr like '%$var1%')
and c.closedate $var3
group by p.descr
order by $var5")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);
print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Associated Person</th>
<th>Matter Description</th>
<th>Matter Codes</th>
<th>Matter Person Attribute</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='personsearch.php?p=" . $row['pid'] . "'>" . $row['Person'] . "</a></td>";
  echo "<td>" . $row['Name'] . "</td>";
  echo "<td>" . $row['Code'] . "</td>";
  echo "<td>" . $row['personattrib'] . "</td>";
  echo "</tr>";
  }
echo "</table>";
'mysql_close';
}
  }
    }
?>
<p><a href="matters.php">Return to Matters Options</a>.</p>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>
</body>
</html>
