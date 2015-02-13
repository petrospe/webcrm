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

$access=mysql_result($permission, 33);
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
<link rel="stylesheet" href="css/jquery-ui.custom.css" />
<link href="css/jquery.zweatherfeed.css" rel="stylesheet" type="text/css" />
<link href="css/programstyle.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.custom.min.js"></script>
<script type="text/javascript">
$(function(){

        // Accordion
        $("#accordion").accordion({ header: "h3" });
  
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

$('#tabs').tabs('select','tabs-6');
  
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

<div class="files">

<div id="tabs">
    <ul>
        <li><a href="myaccount.php" onclick="window.location=('myaccount.php')"><span><?php echo mysql_result($module,7); ?></span></a></li>
        <li><a href="person.php" onclick="window.location=('person.php')"><span><?php echo mysql_result($module,0); ?></span></a></li>
        <li><a href="matters.php" onclick="window.location=('matters.php')"><span><?php echo mysql_result($module,1); ?></span></a></li>
        <li><a href="tasks.php" onclick="window.location=('tasks.php')"><span><?php echo mysql_result($module,2); ?></span></a></li>
        <li><a href="billing.php" onclick="window.location=('billing.php')"><span><?php echo mysql_result($module,3); ?></span></a></li>
        <li><a href="#tabs-6"><span><?php echo mysql_result($module,4); ?></span></a></li>
        <li><a href="protocol.php" onclick="window.location=('protocol.php')"><span><?php echo mysql_result($module,5); ?></span></a></li>
        <li><a href="adminsettings.php" onclick="window.location=('adminsettings.php')"><span><?php echo mysql_result($module,6); ?></span></a></li>
    </ul>
    <div id="tabs-6">

<h3>Update File &amp; Details</h3>
<?php
$dcid=$_GET['dcid'];

//File to be updated
$sql = "SELECT d.id as Code, d.descr as Description, date_format(d.createdate,'%d-%m-%Y') as Createdate, date_format(d.modifydate,'%d-%m-%Y') as Modifydate,
d.filename as Filename, d.content as Content, d.filesize as Filesize, d.filetype as Filetype, u.full_name as username, dt.descr as Doctype,dt.id as DID,
case when d.personid is not null then p.descr 
when cp.personid is not null then group_concat(p1.descr) 
end as Person, 
case when d.caseid is null then 'Matter no exist' 
else c.descr 
end as Matter, d.istemplate as Template
FROM document d
left join casetoperson cp on d.caseid = cp.caseid
left join cases c on cp.caseid = c.id
left join person p on d.personid = p.id
left join person p1 on cp.personid = p1.id
left join users u on u.id = d.userid
left join doctype dt on d.doctypeid = dt.id
WHERE d.isdeleted = 0 and d.id = $dcid";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$formVars = array();

//this code is bringing in the values for the dropdown status
$sql3="SELECT id as fid, descr as filedescr FROM doctype ORDER BY fid";
/* You can add order by clause to the sql statement if the names are to be displayed in alphabetical order */
$final3 = mysql_query ($sql3);

?>
<table>
<tr>
<td><font size="3">Person details:</font></td>
<td><a href="javascript: void(0)" onclick="popup('updatematterfile.php?fpid=<?php echo $row['Code']; ?>')"><?php echo $row['Person']; ?></a></td>
</tr>
<tr>
<td><font size="3">Matter details:</font></td>
<td><a href="javascript: void(0)" onclick="popup('updatematterfile.php?fpid=<?php echo $row['Code']; ?>')"><?php echo $row['Matter']; ?></a></td>
</tr>
</table>
  <form action="updatefile2.php" method="post" enctype="multipart/form-data" name="updatefile_form" id="commentForm">
<table>
<tr>
<td><span style="font-size:11px"><em>Select updated file if changes exists</em></span></td>
</tr>
<tr>
<td>
  <input type="hidden" name="MAX_FILE_SIZE" value="2097152" class="required" />
  <input type="file" name="path" id="path" />
</td>
</tr>
</table>
  <br/>
<table>
<tr>
<td><select style="width: 390px;" name="action">
<option value="<?php echo $row['DID']; ?>"><?php echo $row['Doctype']; ?></option>
<?php
// printing the list box select command
while($nt3=mysql_fetch_array($final3)){
echo "<option value='$nt3[fid]'>$nt3[filedescr]</option>";
/* Option values are added by looping through the array */
}
?>
</select></td>
</tr>
<?php
if ($row['Template'] == "0")
{
echo "<tr><td>Template
<input type='checkbox' name='lite' value='1' />
</td></tr>";
}
if ($row['Template'] == "1")
{
echo "<tr><td>Template
<input type='checkbox' name='lite' value='1' checked/>
</td></tr>";
}
?>
</table>
<table>
<tr>
<td>
<h4>File Description</h4><span style="font-size:11px"><em>You have the ability to fill a Description for this file but it's optional.</em></span>
</td>
</tr>
<tr>
<td><textarea rows="2" cols="60" name="descr"><?php echo $row['Description']; ?></textarea></td>
<td><input type="hidden" name="fileid" value="<?php echo $dcid; ?>" /></td>
</tr>
</table>
<table>
<tr>
  <th><input type="button" value="Reload Page" onclick="window.location.reload( true )" id="button-3" /></th>
  <th><input type="submit" value="Update" name="Submit" id="button-4" /></th>
  <th><input type="reset" value="Reset" name="Reset" id="button-5" /></th> 
  <th><input type="button" value="Back" onclick="history.go(-1)" id="button-6" /></th>
</tr>
</table>
</form>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>
</body>
</html>