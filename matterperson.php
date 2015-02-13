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

$access=mysql_result($permission, 9);
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
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $("#commentForm").validate();
  });
</script>
<script type="text/javascript">
function confirmDelete() {
  return confirm("Are you sure you wish to remove this entry?");
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

$PSID=$_GET['ccid'];

//check if matter no exist or is deleted
$query=mysql_query("SELECT id as CID from cases where id=$PSID and isdeleted=0") or die("SELECT Error:".mysql_error());
$idrow = mysql_fetch_array($query);
$CID=$idrow['CID'];

$result=mysql_query("SELECT cp.id as ctpid, p.id as pid, p.descr as personname, at.descr as attribute, cp.attributeid as attribid, c.descr as mattername, c.id as code
from casetoperson cp
left join person p on p.id = cp.personid
left join attributes at on at.id = cp.attributeid
left join cases c on c.id = cp.caseid
where cp.caseid =$CID and c.isdeleted=0 and p.isdeleted=0
order by p.descr")
or die("Error: Matter $PSID does not exist");
$num_rows = mysql_num_rows($result);

//this code is bringing in the values for the matter description
$mattersql=mysql_query("SELECT descr FROM cases WHERE id = $CID");
$matter = mysql_fetch_array($mattersql);

//this code is bringing in the values for the dropdown persons
$sql3="SELECT id as pesid, descr as persondescr FROM person WHERE isdeleted=0 ORDER BY persondescr";
/* You can add order by clause to the sql statement if the names are to be displayed in alphabetical order */
$final3 = mysql_query ($sql3);

//this code is bringing in the values for the dropdown attributes
$sql4="SELECT id as aid, descr as attdescr FROM attributes ORDER BY attdescr";
/* You can add order by clause to the sql statement if the names are to be displayed in alphabetical order */
$final4 = mysql_query ($sql4);

echo "<h3>Associated Persons with matter '<font color='blue'>".$matter['descr']."</font>'</h3>";
echo "<p>Matter Code $CID.</p>";
echo "<p>It has $num_rows associated persons.</p>";
unset($matter);
echo "<form method='post' action='matterpersoninsert2.php'>";
echo"<table border='1'>
<thead>
<tr>
<th>Person</th>
<th>Associated Person</th>
<th>Matter Person Attribute</th>
<th>Status</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='personsearch.php?p=" . $row['pid'] . "'>Details</a></td>";
  echo "<td>".$row['personname']."</td>";
  echo "<td>".$row['attribute']."</td>";
if($num_rows == "1")
{
  echo "<td>Non Removed</td>";
}
else
{
  echo "<td><a href='matterpersondelete1.php?ctpid=".$row['ctpid']."' onclick='return confirmDelete();'>Remove</a></td>";
}
  echo "</tr>";
  }
echo "<tr>";
  echo "<td><input type='hidden' name='code' value='$CID' /></td>";
  echo "<td><select name='personid'>";
echo "<option value=''>Add Person to associate with this matter</option>";
// printing the list box select command
while($nt3=mysql_fetch_array($final3)){//Array or records stored in $nt1
echo "<option value='".$nt3['pesid']."'>$nt3[persondescr]</option>";
/* Option values are added by looping through the array */
}
echo "</select></td>";
  echo "<td><select name='attributeid'>";
echo "<option value=''>Select Person Attribute</option>";
// printing the list box select command
while($nt4=mysql_fetch_array($final4)){//Array or records stored in $nt2
echo "<option value='".$nt4['aid']."'>$nt4[attdescr]</option>";
/* Option values are added by looping through the array */
}
echo "</select></td>";
  echo "<td><input type='submit' value='Add' /></td>";
echo "</tr>";
echo "</table>";
echo "</form>";
//Add associating persons
?>
<br/>
<input type="button" value="Back" onclick="document.location = 'matters.php';" id="button-3" />
</div>
  </div>
    </div>
<?php include "footer.php"; ?>
</body>
</html>
