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

$access=mysql_result($permission, 3);
if($access != "1")
{
echo "<p><a href='#' onclick='history.go(-1);' style='text-decoration:none'>Not permitted</a></p>";
exit;
}

$id=$_GET['pid'];

// check for an empty string and display a message.
if ($id == "")
  {
  echo "<p>Please enter the Person ID ...</p>";
  exit;
  }

$query=("SELECT p.id as ID, p.descr as name, at.descr as attribute, p.occupation as occupation, p.company as company, p.street1 as street1, p.city1 as city1, p.zipcode1 as zipcode1, p.phone1 as phone1, p.phone2 as phone2, p.mobile as mobile, p.fax as fax, p.afm as afm, p.email as email, p.website as website, pn.descr as notes, p.street2 as street2, p.personextra1 as city2, p.personextra2 as zipcode2, p.phone3 as phone3, p.personextra3 as IC, p.attributeid as attributeid, p.doyid as doyid, d.descr as doy
FROM person p 
left join personnotes pn on pn.personid = p.id 
left join attributes at on at.id = p.attributeid
left join doy d on d.id = p.doyid
WHERE p.id = $id ")
or die("SELECT Error: ".mysql_error());
$result=mysql_query($query);
$row=mysql_fetch_array($result);
$formVars = array();

//this code is bringing in the values for the dropdown doy
$sql1="SELECT id as did, descr as doydescr FROM doy ORDER BY doydescr";
/* You can add order by clause to the sql statement if the names are to be displayed in alphabetical order */
$final1 = mysql_query ($sql1);

//this code is bringing in the values for the dropdown doy
$sql2="SELECT id as aid, descr as attdescr FROM attributes ORDER BY attdescr";
/* You can add order by clause to the sql statement if the names are to be displayed in alphabetical order */
$final2 = mysql_query ($sql2);
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

$('#tabs').tabs('select','tabs-2');
    
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

<div class="person">

<div id="tabs">
    <ul>
        <li><a href="myaccount.php" onclick="window.location=('myaccount.php')"><span><?php echo mysql_result($module,7); ?></span></a></li>
        <li><a href="#tabs-2"><span><?php echo mysql_result($module,0); ?></span></a></li>
        <li><a href="matters.php" onclick="window.location=('matters.php')"><span><?php echo mysql_result($module,1); ?></span></a></li>
        <li><a href="tasks.php" onclick="window.location=('tasks.php')"><span><?php echo mysql_result($module,2); ?></span></a></li>
        <li><a href="billing.php" onclick="window.location=('billing.php')"><span><?php echo mysql_result($module,3); ?></span></a></li>
        <li><a href="files.php" onclick="window.location=('files.php')"><span><?php echo mysql_result($module,4); ?></span></a></li>
        <li><a href="protocol.php" onclick="window.location=('protocol.php')"><span><?php echo mysql_result($module,5); ?></span></a></li>
        <li><a href="adminsettings.php" onclick="window.location=('adminsettings.php')"><span><?php echo mysql_result($module,6); ?></span></a></li>
    </ul>
    <div id="tabs-2">
<h3>Person Details</h3>
<form method="post" action="updateperson4.php" id="commentForm">
<table>

<tr>
<td><font color="blue">Full Name:</font></td>
<td><input type="text" name="name" value="<?php echo $row['name']; ?>" size="50" class="required" /></td>
</tr>
<tr>
<td><font color="blue">Attribute:</font></td>
<td><select name="attributeid">
           <option value="<?php echo $row['attributeid']; ?>"><?php echo $row['attribute']; ?></option>
<?php
// printing the list box select command
while($nt2=mysql_fetch_array($final2)){//Array or records stored in $nt2
echo "<option value='".$nt2['aid']."'>$nt2[attdescr]</option>";
/* Option values are added by looping through the array */
}
?>
</select>
</td>
</tr>
<tr>
<td><font color="blue">Occupation:</font></td>
<td><input type="text" name="occupation" value="<?php echo $row['occupation']; ?>" size="50" /></td>
</tr>
<tr>
<td><font color="blue">Company:</font></td>
<td><input type="text" name="company" value="<?php echo $row['company']; ?>" size="50" /></td>
</tr>
<tr>
<td><font color="blue">Address:</font></td>
<td><input type="text" name="street1" value="<?php echo $row['street1']; ?>" size="50" /></td>
</tr>
<tr>
<td><font color="blue">City:</font></td>
<td><input type="text" name="city1" value="<?php echo $row['city1']; ?>" size="50" /></td>
</tr>
<tr>
<td><font color="blue">Zipcode:</font></td>
<td><input type="text" name="zipcode1" value="<?php echo $row['zipcode1']; ?>" size="50" /></td>
</tr>
<tr>
<td><font color="blue">Phone 1:</font></td>
<td><input type="text" name="phone1" value="<?php echo $row['phone1']; ?>" size="50" /></td>
</tr>
<tr>
<td><font color="blue">Phone 2:</font></td>
<td><input type="text" name="phone2" value="<?php echo $row['phone2']; ?>" size="50" /></td>
</tr>
<tr>
<td><font color="blue">Cellphone:</font></td>
<td><input type="text" name="mobile" value="<?php echo $row['mobile']; ?>" size="50" /></td>
</tr>
<tr>
<td><font color="blue">Fax:</font></td>
<td><input type="text" name="fax" value="<?php echo $row['fax']; ?>" size="50" /></td>
</tr>
<tr>
<td><font color="blue">Tax Registration Number:</font></td>
<td><input type="text" name="afm" value="<?php echo $row['afm']; ?>" size="50" /></td>
</tr>
<tr>
<td><font color="blue">Inland Revenue:</font></td>
<td>
<select name="doyid">
<option value="<?php echo $row['doyid']; ?>"><?php echo $row['doy']; ?></option>
<?php
// printing the list box select command
while($nt1=mysql_fetch_array($final1)){//Array or records stored in $nt1
echo "<option value='".$nt1['did']."'>$nt1[doydescr]</option>";
/* Option values are added by looping through the array */
}
?>
</select>
</td>
</tr>
<tr>
<td><font color="blue">E Mail:</font></td>
<td><input type="text" name="email" value="<?php echo $row['email']; ?>" size="50" /></td>
</tr>
<tr>
<td><font color="blue">Website:</font></td>
<td><input type="text" name="website" value="<?php echo $row['website']; ?>" size="50" /></td>
</tr>
<tr>
<td><font color="blue">Notes:</font></td>
<td><input type="text" name="notes" value="<?php echo $row['notes']; ?>" size="50" /></td>
</tr>
<tr>
<td><font color="blue">Address 2:</font></td>
<td><input type="text" name="street2" value="<?php echo $row['street2']; ?>" size="50" /></td>
</tr>
<tr>
<td><font color="blue">City 2:</font></td>
<td><input type="text" name="city2" value="<?php echo $row['city2']; ?>" size="50" /></td>
</tr>
<tr>
<td><font color="blue">Zipcode 2:</font></td>
<td><input type="text" name="zipcode2" value="<?php echo $row['zipcode2']; ?>" size="50" /></td>
</tr>
<tr>
<td><font color="blue">Phone 3:</font></td>
<td><input type="text" name="phone3" value="<?php echo $row['phone3']; ?>" size="50" /></td>
</tr>
<tr>
<td><font color="blue">Identity Card or Passport:</font></td>
<td><input type="text" name="IC" value="<?php echo $row['IC']; ?>" size="50" /></td>
</tr>
<tr>
<td><input type="hidden" name="ID" value="<?php echo $row['ID']; ?>" /></td>
</tr>
</table>
<input type="submit" value="Submit" id="button-3" />
<input type="button" value="Back" onclick="document.location = 'person.php';" id="button-4" />
</form>
</div>
  </div>
    </div>
<?php include "footer.php"; ?>
</body>
</html>