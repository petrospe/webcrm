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

$access=mysql_result($permission, 42);
if($access != "1")
{
echo "<p>Not permitted</p>";
exit;
}
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
<link rel="stylesheet"  href= "css/adminsettingsstyle.css" />
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

$('#tabs').tabs('select','tabs-8');
    
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
 var width  = 590;
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
<script type="text/javascript">
function confirmDelete() {
  return confirm("Are you sure you wish to delete this entry?");
}
</script>
<script type="text/javascript">
function confirmRestore() {
  return confirm("Do you want to restore this entry?");
}
</script>
<script type="text/javascript" src="js/jquery.MyDigitClock.js"></script>
<script src="js/jquery.zweatherfeed.min.js" type="text/javascript"></script> 
</head>
<body>
<?php include "header.php"; ?>

<?php $module=mysql_query("SELECT descr FROM modules");?>

<div class="adminsettings">

<div id="tabs">
    <ul>
        <li><a href="myaccount.php" onclick="window.location=('myaccount.php')"><span><?php echo mysql_result($module,7); ?></span></a></li>
        <li><a href="person.php" onclick="window.location=('person.php')"><span><?php echo mysql_result($module,0); ?></span></a></li>
        <li><a href="matters.php" onclick="window.location=('matters.php')"><span><?php echo mysql_result($module,1); ?></span></a></li>
        <li><a href="tasks.php" onclick="window.location=('tasks.php')"><span><?php echo mysql_result($module,2); ?></span></a></li>
        <li><a href="billing.php" onclick="window.location=('billing.php')"><span><?php echo mysql_result($module,3); ?></span></a></li>
        <li><a href="files.php" onclick="window.location=('files.php')"><span><?php echo mysql_result($module,4); ?></span></a></li>
        <li><a href="protocol.php" onclick="window.location=('protocol.php')"><span><?php echo mysql_result($module,5); ?></span></a></li>
        <li><a href="#tabs-8"><span><?php echo mysql_result($module,6); ?></span></a></li>  
    </ul>
    <div id="tabs-8">
<table>
<tr>
<td>
<h3>Administration Settings</h3>
</td>
<td align="right"><a href='#' onclick='window.location.reload( true );'>Reload</a></td>
</tr>
</table>
<h4>Section Users</h4>
<form name="input1" action="register.php" method="post">
<input type="submit" value="New User" class="button" />
</form>
<table>
<tr>
<td>
<?php
$query1=mysql_query("SELECT id, full_name, user_name, user_email, joined, country, user_activated FROM users");

echo"<table>
<thead>
<tr>
<th>Full Name</th>
<th>Username</th>
<th>User Email</th>
<th>Joined date</th>
<th>Country</th>
<th>Activation</th>
<th>Delete User</th>
</tr>
</thead>";
while($row = mysql_fetch_array($query1))
  {
  echo "<tr>";
  echo "<td><a href='updateuser1.php?id=" . $row['id'] . "'>" . $row['full_name'] . "</a></td>";
  echo "<td>" . $row['user_name'] . "</td>";
  echo "<td>" . $row['user_email'] . "</td>";
  echo "<td>" . $row['joined'] . "</td>";
  echo "<td>" . $row['country'] . "</td>";
if ($row['user_activated'] == 1)
{
  echo "<td>User is active</td>";
}
else if($row['user_activated'] == 0)
{
  echo "<td>User is not active</td>";
}
  echo "<td><a href='deleteuser.php?id=".$row['id']."' onclick='return confirmDelete();'>Delete it</a></td>";
  echo "</tr>";
  }
echo "</table>";
?>
</td>
</tr>
</table>
<h4>Section Persons</h4>
<table>
<tr>
<td>
<input type="submit" value="New Attribute" onclick="popup('insertattribute.php')" class="button" />
</td>
<td>
<input type="submit" value="New Inland Revenue" onclick="popup('insertdoy.php')" class="button" />
</td>
</tr>
<tr>
<td valign="top">
<?php
$query2=mysql_query("SELECT id, descr FROM attributes ORDER BY descr");

echo"<table>
<thead>
<tr>
<th>Attribute</th>
<th>Delete Attribute</th>
</tr>
</thead>";
while($row2 = mysql_fetch_array($query2))
  {
  echo "<tr>";
  echo "<td><a href='javascript: void(0)' onclick=\"popup('updateattribute.php?attid=" . $row2['id'] . "');\">" . $row2['descr'] . "</a></td>";
  echo "<td><a href='deletemod.php?q=".$row2['id']."' onclick='return confirmDelete();'>Delete it</a></td>";
  echo "</tr>";
  }
echo "</table>";
?>
</td>
<td valign="top">
<?php
$query3=mysql_query("SELECT id, descr FROM doy ORDER BY descr");

echo"<table>
<thead>
<tr>
<th>Inland Revenue</th>
<th>Delete Row</th>
</tr>
</thead>";
while($row3 = mysql_fetch_array($query3))
  {
  echo "<tr>";
  echo "<td><a href='javascript: void(0)' onclick=\"popup('updatedoy.php?doyid=" . $row3['id'] . "');\">" . $row3['descr'] . "</a></td>";
  echo "<td><a href='deletemod.php?p=".$row3['id']."' onclick='return confirmDelete();'>Delete it</a></td>";
  echo "</tr>";
  }
echo "</table>";
?>
</td>
<td valign="top">
<?php
$query4=mysql_query("SELECT p.id as id, p.descr as descr, u.full_name as user
FROM person p
left join users u ON u.id = p.userdel
WHERE isdeleted =1
ORDER BY descr");

echo"<table>
<thead>
<tr>
<th>Deleted Person</th>
<th>Deleted by user</th>
<th>Clean Row</th>
</tr>
</thead>";
while($row4 = mysql_fetch_array($query4))
  {
  echo "<tr>";
  echo "<td><a href='deletemod.php?o=".$row4['id']."' onclick='return confirmRestore();'>" . $row4['descr'] . "</a></td>";
  echo "<td>" .$row4['user']. "</td>";
  echo "<td><a href='deletemod.php?n=".$row4['id']."' onclick='return confirmDelete();'>Delete it</a></td>";
  echo "</tr>";
  }
echo "</table>";
?>
</td>
</tr>
</table>

<h4>Section Matters</h4>
<table>
<tr>
<td>
<input type="submit" value="New Matter Type" onclick="popup('insertmattertype.php')" class="button" />
</td>
<td>
<input type="submit" value="New Default Matter" onclick="popup('insertdefaultmatter.php')" class="button" />
</td>
</tr>
<tr>
<td valign="top">
<?php
$query5=mysql_query("SELECT id, descr FROM casetype ORDER BY descr");

echo"<table>
<thead>
<tr>
<th>Matter Type</th>
<th>Delete Type</th>
</tr>
</thead>";
while($row5 = mysql_fetch_array($query5))
  {
  echo "<tr>";
  echo "<td><a href='javascript: void(0)' onclick=\"popup('updatemattertype.php?mtid=" . $row5['id'] . "');\">" . $row5['descr'] . "</a></td>";
  echo "<td><a href='deletemod.php?m=".$row5['id']."' onclick='return confirmDelete();'>Delete it</a></td>";
  echo "</tr>";
  }
echo "</table>";
?>
</td>

<td valign="top">
<?php
$query6=mysql_query("SELECT id, descr FROM thesaurus ORDER BY descr");

echo"<table>
<thead>
<tr>
<th>Matter Description</th>
<th>Delete Row</th>
</tr>
</thead>";
while($row6 = mysql_fetch_array($query6))
  {
  echo "<tr>";
  echo "<td><a href='javascript: void(0)' onclick=\"popup('updatedefaultmatter.php?dmid=" . $row6['id'] . "');\">" . $row6['descr'] . "</a></td>";
  echo "<td><a href='deletemod.php?l=".$row6['id']."' onclick='return confirmDelete();'>Delete it</a></td>";
  echo "</tr>";
  }
echo "</table>";
?>
</td>

<td valign="top">
<?php
$query7=mysql_query("SELECT c.id as id, c.descr as descr, u.full_name as user
FROM cases c
left join users u ON u.id = c.userdel
WHERE isdeleted =1
ORDER BY descr");

echo"<table>
<thead>
<tr>
<th>Deleted Matter</th>
<th>Deleted by user</th>
<th>Clean Row</th>
</tr>
</thead>";
while($row7 = mysql_fetch_array($query7))
  {
  echo "<tr>";
  echo "<td><a href='deletemod.php?k=".$row7['id']."' onclick='return confirmRestore();'>" . $row7['descr'] . "</a></td>";
  echo "<td>" .$row7['user']. "</td>";
  echo "<td><a href='deletemod.php?j=".$row7['id']."' onclick='return confirmDelete();'>Delete it</a></td>";
  echo "</tr>";
  }
echo "</table>";
?>
</td>
</tr>
</table>
  
<h4>Section Tasks</h4>

<table>
<tr>
<td>
<form name="input1" action="inserttasktype.php" method="post">
<input type="submit" value="New Task" class="button" />
</form>
</td>
<td>
<input type="submit" value="New Category Type" onclick="popup('insertcategory.php')" class="button" />
</td>
<td>
<input type="submit" value="New Status" onclick="popup('insertstatus.php')" class="button" />
</td>
</tr>
<tr>
<td>
<?php
$query8=mysql_query("SELECT id, descr, en_descr FROM proceduretypes");

echo"<table>
<thead>
<tr>
<th>Task Type Name</th>
<th>English Name</th>
<th>Delete Task</th>
</tr>
</thead>";
while($row8 = mysql_fetch_array($query8))
  {
  echo "<tr>";
  echo "<td><a href='updatetasktype1.php?id=" . $row8['id'] . "'>" . $row8['descr'] . "</a></td>";
  echo "<td>" . $row8['en_descr'] . "</td>";
  echo "<td><a href='deletemod.php?i=".$row8['id']."' onclick='return confirmDelete();'>Delete it</a></td>";
  echo "</tr>";
  }
echo "</table>";
?>
</td>
<td valign="top">
<?php
$query9=mysql_query("SELECT id, descr FROM categories");

echo"<table>
<thead>
<tr>
<th>Edit Category Name</th>
<th>Items</th>
<th>Delete Category</th>
</tr>
</thead>";
while($row9 = mysql_fetch_array($query9))
  {
  echo "<tr>";
  echo "<td><a href='javascript: void(0)' onclick=\"popup('updatecategory.php?catid=" . $row9['id'] . "');\">" . $row9['descr'] . "</a></td>";
  echo "<td><a href='categoryitems.php?id=" . $row9['id'] . "'>View Items</a></td>";
  echo "<td><a href='deletemod.php?h=".$row9['id']."' onclick='return confirmDelete();'>Delete it</a></td>";
  echo "</tr>";
  }
echo "</table>";
?>
</td>  
<td valign="top">
<?php
$query10=mysql_query("SELECT id, descr
FROM status
ORDER BY descr");

echo"<table>
<thead>
<tr>
<th>Status Description</th>
<th>Delete</th>
</tr>
</thead>";
while($row10 = mysql_fetch_array($query10))
  {
  echo "<tr>";
  echo "<td><a href='javascript: void(0)' onclick=\"popup('updatestatus.php?stid=" . $row10['id'] . "');\">" . $row10['descr'] . "</a></td>";
  echo "<td><a href='deletemod.php?f=".$row10['id']."' onclick='return confirmDelete();'>Delete it</a></td>";
  echo "</tr>";
  }
echo "</table>";
?>
</td> 
<td valign="top">
<?php
$query11=mysql_query("SELECT ca.id as id, ca.descr as descr, u.full_name as user
FROM case2action ca
left join users u ON u.id = ca.userdel
WHERE ca.isdeleted =1 and ca.actiontypeid = 1
ORDER BY descr");

echo"<table>
<thead>
<tr>
<th>Deleted Task</th>
<th>Deleted by user</th>
<th>Clean Row</th>
</tr>
</thead>";
while($row11 = mysql_fetch_array($query11))
  {
  echo "<tr>";
  echo "<td><a href='deletemod.php?e=".$row11['id']."' onclick='return confirmRestore();'>" . $row11['descr'] . "</a></td>";
  echo "<td>" .$row11['user']. "</td>";
  echo "<td><a href='deletemod.php?d=".$row11['id']."' onclick='return confirmDelete();'>Delete it</a></td>";
  echo "</tr>";
  }
echo "</table>";
?>
</td>
</tr>
</table>

<h4>Section Billing</h4>
<table>
<tr>
<td>
<input type="submit" value="New Office Expense Type" onclick="popup('insertofficeexpensetype.php')" class="button" />
</td>
</tr>
<tr>
<td valign="top">
<?php
$query12=mysql_query("SELECT id, descr FROM officeexptype ORDER BY descr");

echo"<table>
<thead>
<tr>
<th>Office Expense Type</th>
<th>Delete Type</th>
</tr>
</thead>";
while($row12 = mysql_fetch_array($query12))
  {
  echo "<tr>";
  echo "<td><a href='javascript: void(0)' onclick=\"popup('updateofficeexptype.php?offexpid=" . $row12['id'] . "');\">" . $row12['descr'] . "</a></td>";
  echo "<td><a href='deletemod.php?c=".$row12['id']."' onclick='return confirmDelete();'>Delete it</a></td>";
  echo "</tr>";
  }
echo "</table>";
?>
</td>

<td valign="top">
<?php
$query13=mysql_query("SELECT ca.id as id, ca.descr as descr, u.full_name as user
FROM case2action ca
left join users u ON u.id = ca.userdel
WHERE ca.isdeleted =1 and ca.actiontypeid in (2,3,4)
ORDER BY descr");

echo"<table>
<thead>
<tr>
<th>Deleted Billing</th>
<th>Deleted by user</th>
<th>Clean Row</th>
</tr>
</thead>";
while($row13 = mysql_fetch_array($query13))
  {
  echo "<tr>";
  echo "<td><a href='deletemod.php?ea=".$row13['id']."' onclick='return confirmRestore();'>" . $row13['descr'] . "</a></td>";
  echo "<td>" .$row13['user']. "</td>";
  echo "<td><a href='deletemod.php?da=".$row13['id']."' onclick='return confirmDelete();'>Delete it</a></td>";
  echo "</tr>";
  }
echo "</table>";
?>
</td>
</tr>
</table>

<h4>Section Files</h4>
<table>
<tr>
<td>
<input type="submit" value="New Document Type " onclick="popup('insertdoctype.php')" class="button" />
</td>
</tr>
<tr>
<td valign="top">
<?php
$query14=mysql_query("SELECT id, descr FROM doctype ORDER BY descr");

echo"<table>
<thead>
<tr>
<th>Document Type</th>
<th>Delete Type</th>
</tr>
</thead>";
while($row14 = mysql_fetch_array($query14))
  {
  echo "<tr>";
  echo "<td><a href='javascript: void(0)' onclick=\"popup('updatedoctype.php?doctypeid=" . $row14['id'] . "');\">" . $row14['descr'] . "</a></td>";
  echo "<td><a href='deletemod.php?b=".$row14['id']."' onclick='return confirmDelete();'>Delete it</a></td>";
  echo "</tr>";
  }
echo "</table>";
?>
</td>

<td valign="top">
<?php
$query15=mysql_query("SELECT d.id as id, d.descr as descr, u.full_name as user
FROM document d
left join users u ON u.id = d.userdel
WHERE d.isdeleted =1
ORDER BY descr");

echo"<table>
<thead>
<tr>
<th>Deleted Document Description</th>
<th>Deleted by user</th>
<th>Clean Row</th>
</tr>
</thead>";
while($row15 = mysql_fetch_array($query15))
  {
  echo "<tr>";
  echo "<td><a href='deletemod.php?a=".$row15['id']."' onclick='return confirmRestore();'>" . $row15['descr'] . "</a></td>";
  echo "<td>" .$row15['user']. "</td>";
  echo "<td><a href='deletemod.php?az=".$row15['id']."' onclick='return confirmDelete();'>Delete it</a></td>";
  echo "</tr>";
  }
echo "</table>";
?>
</td>
</tr>
</table>
  
<h4>Section Protocol</h4>
<table>
<tr>
<td>
<input type="submit" value="New Send Type " onclick="popup('insertsendtype.php')" class="button" />
</td>
</tr>
<tr>
<td valign="top">
<?php
$query16=mysql_query("SELECT id, descr FROM sendtype ORDER BY descr");

echo"<table>
<thead>
<tr>
<th>Send Type</th>
<th>Delete Type</th>
</tr>
</thead>";
while($row16 = mysql_fetch_array($query16))
  {
  echo "<tr>";
  echo "<td><a href='javascript: void(0)' onclick=\"popup('updatesendtype.php?sendtypeid=" . $row16['id'] . "');\">" . $row16['descr'] . "</a></td>";
  echo "<td><a href='deletemod.php?ay=".$row16['id']."' onclick='return confirmDelete();'>Delete it</a></td>";
  echo "</tr>";
  }
echo "</table>";
?>
</td>

<td valign="top">
<?php
$query17=mysql_query("SELECT ca.id as id, ca.descr as descr, u.full_name as user
FROM case2action ca
left join users u ON u.id = ca.userdel
WHERE ca.isdeleted =1 and ca.actiontypeid = 6
ORDER BY descr");

echo"<table>
<thead>
<tr>
<th>Deleted Send Type</th>
<th>Deleted by user</th>
<th>Clean Row</th>
</tr>
</thead>";
while($row17 = mysql_fetch_array($query17))
  {
  echo "<tr>";
  echo "<td><a href='deletemod.php?ax=".$row17['id']."' onclick='return confirmRestore();'>" . $row17['descr'] . "</a></td>";
  echo "<td>" .$row17['user']. "</td>";
  echo "<td><a href='deletemod.php?aw=".$row17['id']."' onclick='return confirmDelete();'>Delete it</a></td>";
  echo "</tr>";
  }
echo "</table>";
?>
</td>
</tr>
</table>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>
</body>
</html>
