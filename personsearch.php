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

error_reporting(E_ALL);
 ini_set("display_errors",1);

require "config.php";
//User Permissions

$access=mysql_result($permission, 2);
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
<link rel="stylesheet"  href= "css/persontablestyle.css" />
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
<?php
  // Get the search variable from URL

  $var1 = @$_GET['q'] ;
  $var2 = @$_GET['t'] ;
  $var5 = @$_GET['lite'];
  $var6 = @$_GET['address'];
  $var7 = @$_GET['personal'];
  $var8 = @$_GET['orderby'];
  $var9 = @$_GET['p'];

//Set $var4 value
if($var2 !="IS NOT NULL")
{
$var4 = '='.$var2;
}
if($var2 =="IS NOT NULL")
{
$var4 = $var2;
}

// Check if $var9 has value
if($var9 =="")
{
  if($var1 !="")
  {
echo "<h4>Person results</h4>";
echo "<p><a href='person.php'>Return to Person Options</a>. <a href='#' onclick='window.location.reload( true );'>Reload</a>. <a href ='#' onclick='window.print();'>Print</a></p>";
echo "<p>Your search &quot;" . $var1 . "&quot; returned:</p>";
  
// how many rows to show per page
$rowsPerPage = 100;
// by default we show first page
$pageNum = 1;
// if $_GET['page'] defined, use it as page number
if(isset($_GET['page']))
{
    $pageNum = $_GET['page'];
}
// counting the offset
$offset = ($pageNum - 1) * $rowsPerPage;

$result = mysql_query( "SELECT p.id as id, p.descr as Name, at.descr as Attribute, p.occupation as Occupation, p.company as Company, p.street1 as Address, p.city1 as City, p.zipcode1 as TK, p.phone1 as Tel1, p.phone2 as Tel2, p.mobile as Cellphone, p.fax as Fax, pn.descr as notes, p.email as email, p.website as website, p.street2 as street2, p.personextra1 as city2, p.personextra2 as zipcode2, p.phone3 as phone3, p.afm as afm, p.personextra3 as IC, d.descr as doy
FROM person p 
left join personnotes pn on pn.personid = p.id
left join attributes at on at.id = p.attributeid
left join doy d on d.id = p.doyid
where isdeleted = 0 and
  (p.descr like '%$var1%' or p.occupation like '%$var1%' or p.company like '%$var1%' or p.street1 like '%$var1%' or p.city1 like '%$var1%' or p.zipcode1 like '%$var1%' or
  p.phone1 like '%$var1%' or p.phone2 like '%$var1%' or p.mobile like '%$var1%' or p.fax like '%$var1%' or p.email like '%$var1%' or p.website like '%$var1%' or
  p.street2 like '%$var1%' or p.personextra1 like '%$var1%' or p.personextra2 like '%$var1%' or p.phone3 like '%$var1%' or p.afm like '%$var1%' or p.personextra3 like '%$var1%')
and p.attributeid $var4
order by $var8 LIMIT $offset, $rowsPerPage")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

// how many rows we have in database
$query0   = "SELECT COUNT(p.id) AS numrows FROM person p
where p.isdeleted = 0 and (p.descr like '%$var1%' or p.occupation like '%$var1%' or p.company like '%$var1%' or p.street1 like '%$var1%' or p.city1 like '%$var1%' or p.zipcode1 like '%$var1%' or
  p.phone1 like '%$var1%' or p.phone2 like '%$var1%' or p.mobile like '%$var1%' or p.fax like '%$var1%' or p.email like '%$var1%' or p.website like '%$var1%' or
  p.street2 like '%$var1%' or p.personextra1 like '%$var1%' or p.personextra2 like '%$var1%' or p.phone3 like '%$var1%' or p.afm like '%$var1%' or p.personextra3 like '%$var1%')
and p.attributeid $var4";
$result0  = mysql_query($query0) or die("Error, query 1 failed ".mysql_error());
$row0     = mysql_fetch_array($result0, MYSQLI_ASSOC);
$numrows0 = $row0['numrows'];

print "$numrows0 records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Name</th>";
if ($var7 == '1')
{
echo"<th>Attribute</th>
<th>Occupation</th>";
}
echo"<th>Company</th>";
if ($var5 != '1')
{
echo"<th>Address</th>
<th>City</th>

<th>Postal Code</th>";
}
echo"<th>Phone 1</th>
<th>Phone 2</th>
<th>Cellphone</th>
<th>Fax</th>
<th>Notes</th>";

$email_list = array();
while($row2 = mysql_fetch_assoc($result)){
$email_list[] = $row2['email'];
}
//var_dump($email_list);

$total_emails = count($email_list);
// go through the list and trim off the newline character.
for ($counter=0; $counter<$total_emails; $counter++) {
$email_list[$counter] = trim($email_list[$counter]);
}
// implode the list into a single variable, put commas in, apply as $to value.
$to =implode(";",$email_list);

echo"<th><a href='mailto:?bcc=" . $to . "'>Email</a></th>

<th>Website</th>";
if ($var6 == '1')
{
echo"<th>Street 2</th>
<th>City 2</th>
<th>Postal Code 2</th>
<th>Phone 3</th>";
}
if ($var7 == '1')
{
echo"<th>Tax Reg. No</th>
<th>Inland Revenue</th>
<th>IC or Passport</th>";
}
echo"<th>Delete Person</th>
</tr>
</thead>";

if ($num_rows > "0")
{
mysqli_data_seek($result, 0);
}

while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateperson3.php?pid=" . $row['id'] . "'>".$row['Name']."</a></td>";
if ($var7 == '1')
{
  echo "<td>" . $row['Attribute'] . "</td>";
  echo "<td>" . $row['Occupation'] . "</td>";
}
  echo "<td>" . $row['Company'] . "</td>";
if ($var5 != '1')
{
  echo "<td>" . $row['Address'] . "</td>";
  echo "<td>" . $row['City'] . "</td>";
  echo "<td>" . $row['TK'] . "</td>";
}
  echo "<td>" . $row['Tel1'] . "</td>";
  echo "<td>" . $row['Tel2'] . "</td>";
  echo "<td>" . $row['Cellphone'] . "</td>";
  echo "<td>" . $row['Fax'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td><a href='mailto:" . $row['email'] . "'>" . $row['email'] . "</a></td>";
  echo "<td>" . $row['website'] . "</td>";
if ($var6 == '1')
{
  echo "<td>" . $row['street2'] . "</td>";
  echo "<td>" . $row['city2'] . "</td>";
  echo "<td>" . $row['zipcode2'] . "</td>";
  echo "<td>" . $row['phone3'] . "</td>";
}
if ($var7 == '1')
{
  echo "<td>" . $row['afm'] . "</td>";
  echo "<td>" . $row['doy'] . "</td>";
  echo "<td>" . $row['IC'] . "</td>";
}
  echo "<td><a href='deleteperson3.php?pid=".$row['id']."' onclick='return confirmDelete();'>Delete it</a></td>";
  echo "</tr>";
  }
echo "</table>";
  }
  if($var1 =="")
  {
echo "<h4>Person results</h4>";
echo "<p><a href='person.php'>Return to Person Options</a>. <a href='#' onclick='window.location.reload( true );'>Reload</a>. <a href ='#' onclick='window.print();'>Print</a></p>";
echo "<p>Your search &quot;" . $var1 . "&quot; returned:</p>";
  
// how many rows to show per page
$rowsPerPage = 100;
// by default we show first page
$pageNum = 1;
// if $_GET['page'] defined, use it as page number
if(isset($_GET['page']))
{
    $pageNum = $_GET['page'];
}
// counting the offset
$offset = ($pageNum - 1) * $rowsPerPage;

$result = mysql_query( "SELECT p.id as id, p.descr as Name, at.descr as Attribute, p.occupation as Occupation, p.company as Company, p.street1 as Address, p.city1 as City, p.zipcode1 as TK, p.phone1 as Tel1, p.phone2 as Tel2, p.mobile as Cellphone, p.fax as Fax, pn.descr as notes, p.email as email, p.website as website, p.street2 as street2, p.personextra1 as city2, p.personextra2 as zipcode2, p.phone3 as phone3, p.afm as afm, p.personextra3 as IC, d.descr as doy
FROM person p
left join personnotes pn on pn.personid = p.id
left join attributes at on at.id = p.attributeid
left join doy d on d.id = p.doyid
where isdeleted = 0 and p.attributeid $var4
order by $var8 LIMIT $offset, $rowsPerPage")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

// how many rows we have in database
$query0   = "SELECT COUNT(p.id) AS numrows FROM person p
where p.isdeleted = 0 and p.attributeid $var4";
$result0  = mysql_query($query0) or die("Error, query 2 failed ".mysql_error());
$row0     = mysql_fetch_array($result0, MYSQLI_ASSOC);
$numrows0 = $row0['numrows'];

print "$numrows0 records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Name</th>";
if ($var7 == '1')
{
echo"<th>Attribute</th>
<th>Occupation</th>";
}
echo"<th>Company</th>";
if ($var5 != '1')
{
echo"<th>Address</th>
<th>City</th>

<th>Postal Code</th>";
}
echo"<th>Phone 1</th>
<th>Phone 2</th>
<th>Cellphone</th>
<th>Fax</th>
<th>Notes</th>";

$email_list = array();
while($row2 = mysql_fetch_assoc($result)){
$email_list[] = $row2['email'];
}
//var_dump($email_list);

$total_emails = count($email_list);
// go through the list and trim off the newline character.
for ($counter=0; $counter<$total_emails; $counter++) {
$email_list[$counter] = trim($email_list[$counter]);
}
// implode the list into a single variable, put commas in, apply as $to value.
$to =implode(";",$email_list);

echo"<th><a href='mailto:?bcc=" . $to . "'>Email</a></th>

<th>Website</th>";
if ($var6 == '1')
{
echo"<th>Street 2</th>
<th>City 2</th>
<th>Postal Code 2</th>
<th>Phone 3</th>";
}
if ($var7 == '1')
{
echo"<th>Tax Reg. No</th>
<th>Inland Revenue</th>
<th>IC or Passport</th>";
}
echo"<th>Delete Person</th>
</tr>
</thead>";

if ($num_rows > "0")
{
mysqli_data_seek($result, 0);
}

while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td><a href='updateperson3.php?pid=" . $row['id'] . "'>".$row['Name']."</a></td>";
if ($var7 == '1')
{
  echo "<td>" . $row['Attribute'] . "</td>";
  echo "<td>" . $row['Occupation'] . "</td>";
}
  echo "<td>" . $row['Company'] . "</td>";
if ($var5 != '1')
{
  echo "<td>" . $row['Address'] . "</td>";
  echo "<td>" . $row['City'] . "</td>";
  echo "<td>" . $row['TK'] . "</td>";
}
  echo "<td>" . $row['Tel1'] . "</td>";
  echo "<td>" . $row['Tel2'] . "</td>";
  echo "<td>" . $row['Cellphone'] . "</td>";
  echo "<td>" . $row['Fax'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td><a href='mailto:" . $row['email'] . "'>" . $row['email'] . "</a></td>";
  echo "<td>" . $row['website'] . "</td>";
if ($var6 == '1')
{
  echo "<td>" . $row['street2'] . "</td>";
  echo "<td>" . $row['city2'] . "</td>";
  echo "<td>" . $row['zipcode2'] . "</td>";
  echo "<td>" . $row['phone3'] . "</td>";
}
if ($var7 == '1')
{
  echo "<td>" . $row['afm'] . "</td>";
  echo "<td>" . $row['doy'] . "</td>";
  echo "<td>" . $row['IC'] . "</td>";
}
  echo "<td><a href='deleteperson3.php?pid=".$row['id']."' onclick='return confirmDelete();'>Delete it</a></td>";
  echo "</tr>";
  }
echo "</table>";
  }
}
else
if($var9 != "")
{
$result = mysql_query( "SELECT p.id as id, p.descr as Name, at.descr as Attribute, p.occupation as Occupation, p.company as Company, p.street1 as Address, p.city1 as City, p.zipcode1 as TK, p.phone1 as Tel1, p.phone2 as Tel2, p.mobile as Cellphone, p.fax as Fax, pn.descr as notes, p.email as email, p.website as website, p.street2 as street2, p.personextra1 as city2, p.personextra2 as zipcode2, p.phone3 as phone3, p.afm as afm, p.personextra3 as IC, d.descr as doy
FROM person p 
left join personnotes pn on pn.personid = p.id
left join attributes at on at.id = p.attributeid
left join doy d on d.id = p.doyid
where isdeleted = 0 and p.id = '$var9'")
or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

echo"<p>Info for $num_rows person</p>";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Name</th>
<th>Attribute</th>
<th>Occupation</th>
<th>Company</th>
<th>Address</th>
<th>City</th>
<th>Postal Code</th>
<th>Phone 1</th>
<th>Phone 2</th>
<th>Cellphone</th>
<th>Fax</th>
<th>Notes</th>
<th>Email</th>
<th>Website</th>
<th>Street 2</th>
<th>City 2</th>
<th>Postal Code 2</th>
<th>Phone 3</th>
<th>Tax Reg. No</th>
<th>Inland Revenue</th>
<th>IC or Passport</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>".$row['Name']."</td>";
  echo "<td>" . $row['Attribute'] . "</td>";
  echo "<td>" . $row['Occupation'] . "</td>";
  echo "<td>" . $row['Company'] . "</td>";
  echo "<td>" . $row['Address'] . "</td>";
  echo "<td>" . $row['City'] . "</td>";
  echo "<td>" . $row['TK'] . "</td>";
  echo "<td>" . $row['Tel1'] . "</td>";
  echo "<td>" . $row['Tel2'] . "</td>";
  echo "<td>" . $row['Cellphone'] . "</td>";
  echo "<td>" . $row['Fax'] . "</td>";
  echo "<td>" . $row['notes'] . "</td>";
  echo "<td><a href='mailto:" . $row['email'] . "'>" . $row['email'] . "</a></td>";
  echo "<td>" . $row['website'] . "</td>";
  echo "<td>" . $row['street2'] . "</td>";
  echo "<td>" . $row['city2'] . "</td>";
  echo "<td>" . $row['zipcode2'] . "</td>";
  echo "<td>" . $row['phone3'] . "</td>";
  echo "<td>" . $row['afm'] . "</td>";
  echo "<td>" . $row['doy'] . "</td>";
  echo "<td>" . $row['IC'] . "</td>";
  echo "</tr>";
  }
echo "</table>";

}
?>
<?php
// how many pages we have when using paging?
  if (isset($numrows0))
{
$maxPage = ceil($numrows0/$rowsPerPage);
// print the link to access each page
$self = $_SERVER['REQUEST_URI'];
$nav  = '';

for($page = 1; $page <= $maxPage; $page++)
{
   if ($page == $pageNum)
   {
      $nav .= " $page "; // no need to create a link to current page
   }
   else
   {
      $nav .= " <a href=\"$self&page=$page\">$page</a> ";
   }
}
if ($pageNum > 1)
{
   $page  = $pageNum - 1;
   $prev  = " <a href=\"$self&page=$page\">[Prev]</a> ";

   $first = " <a href=\"$self&page=1\">[First Page]</a> ";
}
else
{
   $prev  = '&nbsp;'; // we're on page one, don't print previous link
   $first = '&nbsp;'; // nor the first page link
}

if ($pageNum < $maxPage)
{
   $page = $pageNum + 1;
   $next = " <a href=\"$self&page=$page\">[Next]</a> ";

   $last = " <a href=\"$self&page=$maxPage\">[Last Page]</a> ";
}
else
{
   $next = '&nbsp;'; // we're on the last page, don't print next link
   $last = '&nbsp;'; // nor the last page link
}

// print the navigation link
echo $first . $prev . $nav . $next . $last;
  }
?>
<?php
// Check if $var9 has value
if($var9 =="")
{echo "<p><a href='person.php'>Return to Person Options</a></p>";}
else
if($var9 != "")
{echo "<p><a href='#' onclick='history.go(-2)'>Back to Matter Results</a></p>";}
?>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>
</body>
</html>
