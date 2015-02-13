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

$access=mysql_result($permission, 32);
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
<link href= "css/filetablestyle.css" rel="stylesheet" type="text/css" />
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
<?php
// Get the search variable from URL

  $filename = $_GET['filename'] ;
  $personid = $_GET['personid'] ;
  $caseid = $_GET['caseid'] ;
  $actionid = $_GET['action'] ;
  $var5 = $_GET['orderby'] ;
  $var6 = $_GET['r'];

function bytesToSize($bytes, $precision = 2)
{  
    $kilobyte = 1024;
    $megabyte = $kilobyte * 1024;
    $gigabyte = $megabyte * 1024;
    $terabyte = $gigabyte * 1024;
   
    if (($bytes >= 0) && ($bytes < $kilobyte)) {
        return $bytes . ' B';
 
    } elseif (($bytes >= $kilobyte) && ($bytes < $megabyte)) {
        return round($bytes / $kilobyte, $precision) . ' KB';
 
    } elseif (($bytes >= $megabyte) && ($bytes < $gigabyte)) {
        return round($bytes / $megabyte, $precision) . ' MB';
 
    } elseif (($bytes >= $gigabyte) && ($bytes < $terabyte)) {
        return round($bytes / $gigabyte, $precision) . ' GB';
 
    } elseif ($bytes >= $terabyte) {
        return round($bytes / $terabyte, $precision) . ' TB';
    } else {
        return $bytes . ' B';
    }
}

echo "<h4>Uploaded Files</h4>";
echo "<p><a href='files.php'>Return to Files Options</a>. <a href='#' onclick='window.location.reload( true );'>Reload</a></p>";
echo "<p>Your search returned: </p>";

//Option 1
if ($var6 == "ALL")
{
if($filename == "" && $personid == "" && $caseid == "" && $actionid == "")
{
  $result = mysql_query( "SELECT d.id as Code, d.descr as Description, date_format(d.createdate,'%d-%m-%Y') as Createdate, date_format(d.modifydate,'%d-%m-%Y') as Modifydate,
d.filename as Filename, d.content as Content, d.filesize as Filesize, d.filetype as Filetype, u.full_name as username, dt.descr as Doctype,
case when d.personid is not null then p.descr 
when cp.personid is not null then group_concat(p1.descr separator '<br />') 
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
WHERE d.isdeleted = 0
group by d.id
order by $var5") or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records. Click <font color='C11B17'>File Name</font> to <font color='41A317'>Download</font>, click <font color='C11B17'>Description</font> to <font color='41A317'>Update</font>";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Template</th>
<th>File Name</th>
<th>Description</th>
<th>Associated Person</th>
<th>Matter Description</th>
<th>Create</th>
<th>Modify</th>
<th>About</th>
<th>User</th>
<th>Size</th>
<th>Type</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
if($row['Template'] == "1")
{  echo "<td>Template</td>";}
else
if($row['Template'] == "0")
{  echo "<td>No Template</td>";}
  echo "<td><a href='download.php?did=" . $row['Code'] . "' >".$row['Filename']."</a></td>";
  echo "<td><a href='updatefile1.php?dcid=" . $row['Code'] . "'>" . $row['Description'] . "</a></td>";
  echo "<td>". $row['Person'] ."</td>";
  echo "<td>" . $row['Matter'] . "</td>";
  echo "<td>" . $row['Createdate'] . "</td>";
  echo "<td>" . $row['Modifydate'] . "</td>";
  echo "<td>" . $row['Doctype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" .bytesToSize($row['Filesize'])."</td>";
  echo "<td>" . $row['Filetype'] . "</td>";
  echo "<td><a href='deletefile1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete File</a></td>";
  echo "</tr>";
  }
echo "</table>";
}

//Option 2
else
if($filename == "" && $personid == "" && $caseid == "" && $actionid != "")
{
  $result = mysql_query( "SELECT d.id as Code, d.descr as Description, date_format(d.createdate,'%d-%m-%Y') as Createdate, date_format(d.modifydate,'%d-%m-%Y') as Modifydate,
d.filename as Filename, d.content as Content, d.filesize as Filesize, d.filetype as Filetype, u.full_name as username, dt.descr as Doctype,
case when d.personid is not null then p.descr 
when cp.personid is not null then group_concat(p1.descr separator '<br />') 
end as Person, 
case when d.caseid is null then 'Matter no exist' 
else c.descr 
end as Matter, d.istemplate as Template
FROM document d
left join casetoperson cp on d.caseid = cp.caseid
left join cases c on d.caseid=c.id
left join person p on d.personid=p.id
left join person p1 on cp.personid = p1.id
left join users u on u.id=d.userid
left join doctype dt on d.doctypeid=dt.id
WHERE d.isdeleted = 0 and dt.id = $actionid
group by d.id
order by $var5") or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records. Click <font color='C11B17'>File Name</font> to <font color='41A317'>Download</font>, click <font color='C11B17'>Description</font> to <font color='41A317'>Update</font>";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Template</th>
<th>File Name</th>
<th>Description</th>
<th>Associated Person</th>
<th>Matter Description</th>
<th>Create</th>
<th>Modify</th>
<th>About</th>
<th>User</th>
<th>Size</th>
<th>Type</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
if($row['Template'] == "1")
{  echo "<td>Template</td>";}
else
if($row['Template'] == "0")
{  echo "<td>No Template</td>";}
  echo "<td><a href='download.php?did=" . $row['Code'] . "'>".$row['Filename']."</a></td>";
  echo "<td><a href='updatefile1.php?dcid=" . $row['Code'] . "'>" . $row['Description'] . "</a></td>";
  echo "<td>". $row['Person'] ."</td>";
  echo "<td>" . $row['Matter'] . "</td>";
  echo "<td>" . $row['Createdate'] . "</td>";
  echo "<td>" . $row['Modifydate'] . "</td>";
  echo "<td>" . $row['Doctype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" .bytesToSize($row['Filesize'])."</td>";
  echo "<td>" . $row['Filetype'] . "</td>";
  echo "<td><a href='deletefile1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete File</a></td>";
  echo "</tr>";
  }
echo "</table>";

}

//Option 3
else
if($filename == "" && $personid == "" && $caseid != "" && $actionid == "")
{
  $result = mysql_query( "SELECT d.id as Code, d.descr as Description, date_format(d.createdate,'%d-%m-%Y') as Createdate, date_format(d.modifydate,'%d-%m-%Y') as Modifydate,
d.filename as Filename, d.content as Content, d.filesize as Filesize, d.filetype as Filetype, u.full_name as username, dt.descr as Doctype,
case when d.personid is not null then p.descr 
when cp.personid is not null then group_concat(p1.descr separator '<br />') 
end as Person, 
case when d.caseid is null then 'Matter no exist' 
else c.descr 
end as Matter, d.istemplate as Template
FROM document d
left join casetoperson cp on d.caseid = cp.caseid
left join cases c on d.caseid=c.id
left join person p on d.personid=p.id
left join person p1 on cp.personid = p1.id
left join users u on u.id=d.userid
left join doctype dt on d.doctypeid=dt.id
WHERE d.isdeleted = 0 and c.id = $caseid
group by d.id
order by $var5") or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records. Click <font color='C11B17'>File Name</font> to <font color='41A317'>Download</font>, click <font color='C11B17'>Description</font> to <font color='41A317'>Update</font>";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Template</th>
<th>File Name</th>
<th>Description</th>
<th>Associated Person</th>
<th>Matter Description</th>
<th>Create</th>
<th>Modify</th>
<th>About</th>
<th>User</th>
<th>Size</th>
<th>Type</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
if($row['Template'] == "1")
{  echo "<td>Template</td>";}
else
if($row['Template'] == "0")
{  echo "<td>No Template</td>";}
  echo "<td><a href='download.php?did=" . $row['Code'] . "'>".$row['Filename']."</a></td>";
  echo "<td><a href='updatefile1.php?dcid=" . $row['Code'] . "'>" . $row['Description'] . "</a></td>";
  echo "<td>". $row['Person'] ."</td>";
  echo "<td>" . $row['Matter'] . "</td>";
  echo "<td>" . $row['Createdate'] . "</td>";
  echo "<td>" . $row['Modifydate'] . "</td>";
  echo "<td>" . $row['Doctype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" .bytesToSize($row['Filesize'])."</td>";
  echo "<td>" . $row['Filetype'] . "</td>";
  echo "<td><a href='deletefile1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete File</a></td>";
  echo "</tr>";
  }
echo "</table>";

}

//Option 4
else
if($filename == "" && $personid != "" && $caseid == "" && $actionid == "")
{
  $result = mysql_query( "SELECT d.id as Code, d.descr as Description, date_format(d.createdate,'%d-%m-%Y') as Createdate, date_format(d.modifydate,'%d-%m-%Y') as Modifydate,
d.filename as Filename, d.content as Content, d.filesize as Filesize, d.filetype as Filetype, u.full_name as username, dt.descr as Doctype,
case when d.personid is not null then p.descr 
when cp.personid is not null then group_concat(p1.descr separator '<br />') 
end as Person, 
case when d.caseid is null then 'Matter no exist' 
else c.descr 
end as Matter, d.istemplate as Template
FROM document d
left join casetoperson cp on d.caseid = cp.caseid
left join cases c on d.caseid=c.id
left join person p on d.personid=p.id
left join person p1 on cp.personid = p1.id
left join users u on u.id=d.userid
left join doctype dt on d.doctypeid=dt.id
WHERE d.isdeleted = 0 and p.id = $personid
group by d.id
order by $var5") or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records. Click <font color='C11B17'>File Name</font> to <font color='41A317'>Download</font>, click <font color='C11B17'>Description</font> to <font color='41A317'>Update</font>";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Template</th>
<th>File Name</th>
<th>Description</th>
<th>Associated Person</th>
<th>Matter Description</th>
<th>Create</th>
<th>Modify</th>
<th>About</th>
<th>User</th>
<th>Size</th>
<th>Type</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
if($row['Template'] == "1")
{  echo "<td>Template</td>";}
else
if($row['Template'] == "0")
{  echo "<td>No Template</td>";}
  echo "<td><a href='download.php?did=" . $row['Code'] . "'>".$row['Filename']."</a></td>";
  echo "<td><a href='updatefile1.php?dcid=" . $row['Code'] . "'>" . $row['Description'] . "</a></td>";
  echo "<td>". $row['Person'] ."</td>";
  echo "<td>" . $row['Matter'] . "</td>";
  echo "<td>" . $row['Createdate'] . "</td>";
  echo "<td>" . $row['Modifydate'] . "</td>";
  echo "<td>" . $row['Doctype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" .bytesToSize($row['Filesize'])."</td>";
  echo "<td>" . $row['Filetype'] . "</td>";
  echo "<td><a href='deletefile1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete File</a></td>";
  echo "</tr>";
  }
echo "</table>";

}

//Option 5
else
if($filename != "" && $personid == "" && $caseid == "" && $actionid == "")
{
  $result = mysql_query( "SELECT d.id as Code, d.descr as Description, date_format(d.createdate,'%d-%m-%Y') as Createdate, date_format(d.modifydate,'%d-%m-%Y') as Modifydate,
d.filename as Filename, d.content as Content, d.filesize as Filesize, d.filetype as Filetype, u.full_name as username, dt.descr as Doctype,
case when d.personid is not null then p.descr 
when cp.personid is not null then group_concat(p1.descr separator '<br />') 
end as Person, 
case when d.caseid is null then 'Matter no exist' 
else c.descr 
end as Matter, d.istemplate as Template
FROM document d
left join casetoperson cp on d.caseid = cp.caseid
left join cases c on d.caseid=c.id
left join person p on d.personid=p.id
left join person p1 on cp.personid = p1.id
left join users u on u.id=d.userid
left join doctype dt on d.doctypeid=dt.id
WHERE d.isdeleted = 0 and d.filename like '%$filename%'
group by d.id
order by $var5") or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records. Click <font color='C11B17'>File Name</font> to <font color='41A317'>Download</font>, click <font color='C11B17'>Description</font> to <font color='41A317'>Update</font>";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Template</th>
<th>File Name</th>
<th>Description</th>
<th>Associated Person</th>
<th>Matter Description</th>
<th>Create</th>
<th>Modify</th>
<th>About</th>
<th>User</th>
<th>Size</th>
<th>Type</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
if($row['Template'] == "1")
{  echo "<td>Template</td>";}
else
if($row['Template'] == "0")
{  echo "<td>No Template</td>";}
  echo "<td><a href='download.php?did=" . $row['Code'] . "'>".$row['Filename']."</a></td>";
  echo "<td><a href='updatefile1.php?dcid=" . $row['Code'] . "'>" . $row['Description'] . "</a></td>";
  echo "<td>". $row['Person'] ."</td>";
  echo "<td>" . $row['Matter'] . "</td>";
  echo "<td>" . $row['Createdate'] . "</td>";
  echo "<td>" . $row['Modifydate'] . "</td>";
  echo "<td>" . $row['Doctype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" .bytesToSize($row['Filesize'])."</td>";
  echo "<td>" . $row['Filetype'] . "</td>";
  echo "<td><a href='deletefile1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete File</a></td>";
  echo "</tr>";
  }
echo "</table>";

}

//Option 6
else
if($filename == "" && $personid == "" && $caseid != "" && $actionid != "")
{
  $result = mysql_query( "SELECT d.id as Code, d.descr as Description, date_format(d.createdate,'%d-%m-%Y') as Createdate, date_format(d.modifydate,'%d-%m-%Y') as Modifydate,
d.filename as Filename, d.content as Content, d.filesize as Filesize, d.filetype as Filetype, u.full_name as username, dt.descr as Doctype,
case when d.personid is not null then p.descr 
when cp.personid is not null then group_concat(p1.descr separator '<br />') 
end as Person, 
case when d.caseid is null then 'Matter no exist' 
else c.descr 
end as Matter, d.istemplate as Template
FROM document d
left join casetoperson cp on d.caseid = cp.caseid
left join cases c on d.caseid=c.id
left join person p on d.personid=p.id
left join person p1 on cp.personid = p1.id
left join users u on u.id=d.userid
left join doctype dt on d.doctypeid=dt.id
WHERE d.isdeleted = 0 and dt.id = $actionid and c.id = $caseid
group by d.id
order by $var5") or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records. Click <font color='C11B17'>File Name</font> to <font color='41A317'>Download</font>, click <font color='C11B17'>Description</font> to <font color='41A317'>Update</font>";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Template</th>
<th>File Name</th>
<th>Description</th>
<th>Associated Person</th>
<th>Matter Description</th>
<th>Create</th>
<th>Modify</th>
<th>About</th>
<th>User</th>
<th>Size</th>
<th>Type</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
if($row['Template'] == "1")
{  echo "<td>Template</td>";}
else
if($row['Template'] == "0")
{  echo "<td>No Template</td>";}
  echo "<td><a href='download.php?did=" . $row['Code'] . "'>".$row['Filename']."</a></td>";
  echo "<td><a href='updatefile1.php?dcid=" . $row['Code'] . "'>" . $row['Description'] . "</a></td>";
  echo "<td>". $row['Person'] ."</td>";
  echo "<td>" . $row['Matter'] . "</td>";
  echo "<td>" . $row['Createdate'] . "</td>";
  echo "<td>" . $row['Modifydate'] . "</td>";
  echo "<td>" . $row['Doctype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" .bytesToSize($row['Filesize'])."</td>";
  echo "<td>" . $row['Filetype'] . "</td>";
  echo "<td><a href='deletefile1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete File</a></td>";
  echo "</tr>";
  }
echo "</table>";

}

//Option 7
else
if($filename == "" && $personid != "" && $caseid == "" && $actionid != "")
{
  $result = mysql_query( "SELECT d.id as Code, d.descr as Description, date_format(d.createdate,'%d-%m-%Y') as Createdate, date_format(d.modifydate,'%d-%m-%Y') as Modifydate,
d.filename as Filename, d.content as Content, d.filesize as Filesize, d.filetype as Filetype, u.full_name as username, dt.descr as Doctype,
case when d.personid is not null then p.descr 
when cp.personid is not null then group_concat(p1.descr separator '<br />') 
end as Person, 
case when d.caseid is null then 'Matter no exist' 
else c.descr 
end as Matter, d.istemplate as Template
FROM document d
left join casetoperson cp on d.caseid = cp.caseid
left join cases c on d.caseid=c.id
left join person p on d.personid=p.id
left join person p1 on cp.personid = p1.id
left join users u on u.id=d.userid
left join doctype dt on d.doctypeid=dt.id
WHERE d.isdeleted = 0 and dt.id = $actionid and p.id = $personid
group by d.id
order by $var5") or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records. Click <font color='C11B17'>File Name</font> to <font color='41A317'>Download</font>, click <font color='C11B17'>Description</font> to <font color='41A317'>Update</font>";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Template</th>
<th>File Name</th>
<th>Description</th>
<th>Associated Person</th>
<th>Matter Description</th>
<th>Create</th>
<th>Modify</th>
<th>About</th>
<th>User</th>
<th>Size</th>
<th>Type</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
if($row['Template'] == "1")
{  echo "<td>Template</td>";}
else
if($row['Template'] == "0")
{  echo "<td>No Template</td>";}
  echo "<td><a href='download.php?did=" . $row['Code'] . "'>".$row['Filename']."</a></td>";
  echo "<td><a href='updatefile1.php?dcid=" . $row['Code'] . "'>" . $row['Description'] . "</a></td>";
  echo "<td>". $row['Person'] ."</td>";
  echo "<td>" . $row['Matter'] . "</td>";
  echo "<td>" . $row['Createdate'] . "</td>";
  echo "<td>" . $row['Modifydate'] . "</td>";
  echo "<td>" . $row['Doctype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" .bytesToSize($row['Filesize'])."</td>";
  echo "<td>" . $row['Filetype'] . "</td>";
  echo "<td><a href='deletefile1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete File</a></td>";
  echo "</tr>";
  }
echo "</table>";

}

//Option 8
else
if($filename != "" && $personid == "" && $caseid == "" && $actionid != "")
{
  $result = mysql_query( "SELECT d.id as Code, d.descr as Description, date_format(d.createdate,'%d-%m-%Y') as Createdate, date_format(d.modifydate,'%d-%m-%Y') as Modifydate,
d.filename as Filename, d.content as Content, d.filesize as Filesize, d.filetype as Filetype, u.full_name as username, dt.descr as Doctype,
case when d.personid is not null then p.descr 
when cp.personid is not null then group_concat(p1.descr separator '<br />') 
end as Person, 
case when d.caseid is null then 'Matter no exist' 
else c.descr 
end as Matter, d.istemplate as Template
FROM document d
left join casetoperson cp on d.caseid = cp.caseid
left join cases c on d.caseid=c.id
left join person p on d.personid=p.id
left join person p1 on cp.personid = p1.id
left join users u on u.id=d.userid
left join doctype dt on d.doctypeid=dt.id
WHERE d.isdeleted = 0 and dt.id = $actionid and d.filename like '%$filename%'
group by d.id
order by $var5") or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records. Click <font color='C11B17'>File Name</font> to <font color='41A317'>Download</font>, click <font color='C11B17'>Description</font> to <font color='41A317'>Update</font>";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Template</th>
<th>File Name</th>
<th>Description</th>
<th>Associated Person</th>
<th>Matter Description</th>
<th>Create</th>
<th>Modify</th>
<th>About</th>
<th>User</th>
<th>Size</th>
<th>Type</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
if($row['Template'] == "1")
{  echo "<td>Template</td>";}
else
if($row['Template'] == "0")
{  echo "<td>No Template</td>";}
  echo "<td><a href='download.php?did=" . $row['Code'] . "'>".$row['Filename']."</a></td>";
  echo "<td><a href='updatefile1.php?dcid=" . $row['Code'] . "'>" . $row['Description'] . "</a></td>";
  echo "<td>". $row['Person'] ."</td>";
  echo "<td>" . $row['Matter'] . "</td>";
  echo "<td>" . $row['Createdate'] . "</td>";
  echo "<td>" . $row['Modifydate'] . "</td>";
  echo "<td>" . $row['Doctype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" .bytesToSize($row['Filesize'])."</td>";
  echo "<td>" . $row['Filetype'] . "</td>";
  echo "<td><a href='deletefile1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete File</a></td>";
  echo "</tr>";
  }
echo "</table>";

}

//Option 9
else
if($filename == "" && $personid != "" && $caseid != "" && $actionid != "")
{
  $result = mysql_query( "SELECT d.id as Code, d.descr as Description, date_format(d.createdate,'%d-%m-%Y') as Createdate, date_format(d.modifydate,'%d-%m-%Y') as Modifydate,
d.filename as Filename, d.content as Content, d.filesize as Filesize, d.filetype as Filetype, u.full_name as username, dt.descr as Doctype,
case when d.personid is not null then p.descr 
when cp.personid is not null then group_concat(p1.descr separator '<br />') 
end as Person, 
case when d.caseid is null then 'Matter no exist' 
else c.descr 
end as Matter, d.istemplate as Template
FROM document d
left join casetoperson cp on d.caseid = cp.caseid
left join cases c on d.caseid=c.id
left join person p on d.personid=p.id
left join person p1 on cp.personid = p1.id
left join users u on u.id=d.userid
left join doctype dt on d.doctypeid=dt.id
WHERE d.isdeleted = 0 and dt.id = $actionid and c.id = $caseid and p.id = $personid
group by d.id
order by $var5") or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records. Click <font color='C11B17'>File Name</font> to <font color='41A317'>Download</font>, click <font color='C11B17'>Description</font> to <font color='41A317'>Update</font>";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Template</th>
<th>File Name</th>
<th>Description</th>
<th>Associated Person</th>
<th>Matter Description</th>
<th>Create</th>
<th>Modify</th>
<th>About</th>
<th>User</th>
<th>Size</th>
<th>Type</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
if($row['Template'] == "1")
{  echo "<td>Template</td>";}
else
if($row['Template'] == "0")
{  echo "<td>No Template</td>";}
  echo "<td><a href='download.php?did=" . $row['Code'] . "'>".$row['Filename']."</a></td>";
  echo "<td><a href='updatefile1.php?dcid=" . $row['Code'] . "'>" . $row['Description'] . "</a></td>";
  echo "<td>". $row['Person'] ."</td>";
  echo "<td>" . $row['Matter'] . "</td>";
  echo "<td>" . $row['Createdate'] . "</td>";
  echo "<td>" . $row['Modifydate'] . "</td>";
  echo "<td>" . $row['Doctype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" .bytesToSize($row['Filesize'])."</td>";
  echo "<td>" . $row['Filetype'] . "</td>";
  echo "<td><a href='deletefile1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete File</a></td>";
  echo "</tr>";
  }
echo "</table>";

}

//Option 10
else
if($filename != "" && $personid == "" && $caseid != "" && $actionid != "")
{
  $result = mysql_query( "SELECT d.id as Code, d.descr as Description, date_format(d.createdate,'%d-%m-%Y') as Createdate, date_format(d.modifydate,'%d-%m-%Y') as Modifydate,
d.filename as Filename, d.content as Content, d.filesize as Filesize, d.filetype as Filetype, u.full_name as username, dt.descr as Doctype,
case when d.personid is not null then p.descr 
when cp.personid is not null then group_concat(p1.descr separator '<br />') 
end as Person, 
case when d.caseid is null then 'Matter no exist' 
else c.descr 
end as Matter, d.istemplate as Template
FROM document d
left join casetoperson cp on d.caseid = cp.caseid
left join cases c on d.caseid=c.id
left join person p on d.personid=p.id
left join person p1 on cp.personid = p1.id
left join users u on u.id=d.userid
left join doctype dt on d.doctypeid=dt.id
WHERE d.isdeleted = 0 and dt.id = $actionid and c.id = $caseid and d.filename like '%$filename%'
group by d.id
order by $var5") or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records. Click <font color='C11B17'>File Name</font> to <font color='41A317'>Download</font>, click <font color='C11B17'>Description</font> to <font color='41A317'>Update</font>";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Template</th>
<th>File Name</th>
<th>Description</th>
<th>Associated Person</th>
<th>Matter Description</th>
<th>Create</th>
<th>Modify</th>
<th>About</th>
<th>User</th>
<th>Size</th>
<th>Type</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
if($row['Template'] == "1")
{  echo "<td>Template</td>";}
else
if($row['Template'] == "0")
{  echo "<td>No Template</td>";}
  echo "<td><a href='download.php?did=" . $row['Code'] . "'>".$row['Filename']."</a></td>";
  echo "<td><a href='updatefile1.php?dcid=" . $row['Code'] . "'>" . $row['Description'] . "</a></td>";
  echo "<td>". $row['Person'] ."</td>";
  echo "<td>" . $row['Matter'] . "</td>";
  echo "<td>" . $row['Createdate'] . "</td>";
  echo "<td>" . $row['Modifydate'] . "</td>";
  echo "<td>" . $row['Doctype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" .bytesToSize($row['Filesize'])."</td>";
  echo "<td>" . $row['Filetype'] . "</td>";
  echo "<td><a href='deletefile1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete File</a></td>";
  echo "</tr>";
  }
echo "</table>";

}

//Option 11
else
if($filename != "" && $personid != "" && $caseid == "" && $actionid != "")
{
  $result = mysql_query( "SELECT d.id as Code, d.descr as Description, date_format(d.createdate,'%d-%m-%Y') as Createdate, date_format(d.modifydate,'%d-%m-%Y') as Modifydate,
d.filename as Filename, d.content as Content, d.filesize as Filesize, d.filetype as Filetype, u.full_name as username, dt.descr as Doctype,
case when d.personid is not null then p.descr 
when cp.personid is not null then group_concat(p1.descr separator '<br />') 
end as Person, 
case when d.caseid is null then 'Matter no exist' 
else c.descr 
end as Matter, d.istemplate as Template
FROM document d
left join casetoperson cp on d.caseid = cp.caseid
left join cases c on d.caseid=c.id
left join person p on d.personid=p.id
left join person p1 on cp.personid = p1.id
left join users u on u.id=d.userid
left join doctype dt on d.doctypeid=dt.id
WHERE d.isdeleted = 0 and dt.id = $actionid and p.id = $personid and d.filename like '%$filename%'
group by d.id
order by $var5") or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records. Click <font color='C11B17'>File Name</font> to <font color='41A317'>Download</font>, click <font color='C11B17'>Description</font> to <font color='41A317'>Update</font>";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Template</th>
<th>File Name</th>
<th>Description</th>
<th>Associated Person</th>
<th>Matter Description</th>
<th>Create</th>
<th>Modify</th>
<th>About</th>
<th>User</th>
<th>Size</th>
<th>Type</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
if($row['Template'] == "1")
{  echo "<td>Template</td>";}
else
if($row['Template'] == "0")
{  echo "<td>No Template</td>";}
  echo "<td><a href='download.php?did=" . $row['Code'] . "'>".$row['Filename']."</a></td>";
  echo "<td><a href='updatefile1.php?dcid=" . $row['Code'] . "'>" . $row['Description'] . "</a></td>";
  echo "<td>". $row['Person'] ."</td>";
  echo "<td>" . $row['Matter'] . "</td>";
  echo "<td>" . $row['Createdate'] . "</td>";
  echo "<td>" . $row['Modifydate'] . "</td>";
  echo "<td>" . $row['Doctype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" .bytesToSize($row['Filesize'])."</td>";
  echo "<td>" . $row['Filetype'] . "</td>";
  echo "<td><a href='deletefile1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete File</a></td>";
  echo "</tr>";
  }
echo "</table>";

}

//Option 12
else
if($filename != "" && $personid != "" && $caseid != "" && $actionid == "")
{
  $result = mysql_query( "SELECT d.id as Code, d.descr as Description, date_format(d.createdate,'%d-%m-%Y') as Createdate, date_format(d.modifydate,'%d-%m-%Y') as Modifydate,
d.filename as Filename, d.content as Content, d.filesize as Filesize, d.filetype as Filetype, u.full_name as username, dt.descr as Doctype,
case when d.personid is not null then p.descr 
when cp.personid is not null then group_concat(p1.descr separator '<br />') 
end as Person, 
case when d.caseid is null then 'Matter no exist' 
else c.descr 
end as Matter, d.istemplate as Template
FROM document d
left join casetoperson cp on d.caseid = cp.caseid
left join cases c on d.caseid=c.id
left join person p on d.personid=p.id
left join person p1 on cp.personid = p1.id
left join users u on u.id=d.userid
left join doctype dt on d.doctypeid=dt.id
WHERE d.isdeleted = 0 and c.id = $caseid and p.id = $personid and d.filename like '%$filename%'
group by d.id
order by $var5") or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records. Click <font color='C11B17'>File Name</font> to <font color='41A317'>Download</font>, click <font color='C11B17'>Description</font> to <font color='41A317'>Update</font>";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Template</th>
<th>File Name</th>
<th>Description</th>
<th>Associated Person</th>
<th>Matter Description</th>
<th>Create</th>
<th>Modify</th>
<th>About</th>
<th>User</th>
<th>Size</th>
<th>Type</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
if($row['Template'] == "1")
{  echo "<td>Template</td>";}
else
if($row['Template'] == "0")
{  echo "<td>No Template</td>";}
  echo "<td><a href='download.php?did=" . $row['Code'] . "'>".$row['Filename']."</a></td>";
  echo "<td><a href='updatefile1.php?dcid=" . $row['Code'] . "'>" . $row['Description'] . "</a></td>";
  echo "<td>". $row['Person'] ."</td>";
  echo "<td>" . $row['Matter'] . "</td>";
  echo "<td>" . $row['Createdate'] . "</td>";
  echo "<td>" . $row['Modifydate'] . "</td>";
  echo "<td>" . $row['Doctype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" .bytesToSize($row['Filesize'])."</td>";
  echo "<td>" . $row['Filetype'] . "</td>";
  echo "<td><a href='deletefile1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete File</a></td>";
  echo "</tr>";
  }
echo "</table>";

}

//Option 13
else
if($filename != "" && $personid != "" && $caseid != "" && $actionid != "")
{
  $result = mysql_query( "SELECT d.id as Code, d.descr as Description, date_format(d.createdate,'%d-%m-%Y') as Createdate, date_format(d.modifydate,'%d-%m-%Y') as Modifydate,
d.filename as Filename, d.content as Content, d.filesize as Filesize, d.filetype as Filetype, u.full_name as username, dt.descr as Doctype,
case when d.personid is not null then p.descr 
when cp.personid is not null then group_concat(p1.descr separator '<br />') 
end as Person, 
case when d.caseid is null then 'Matter no exist' 
else c.descr 
end as Matter, d.istemplate as Template
FROM document d
left join casetoperson cp on d.caseid = cp.caseid
left join cases c on d.caseid=c.id
left join person p on d.personid=p.id
left join person p1 on cp.personid = p1.id
left join users u on u.id=d.userid
left join doctype dt on d.doctypeid=dt.id
WHERE d.isdeleted = 0 and c.id = $caseid and p.id = $personid and d.filename like '%$filename%' and dt.id = $actionid
group by d.id
order by $var5") or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records. Click <font color='C11B17'>File Name</font> to <font color='41A317'>Download</font>, click <font color='C11B17'>Description</font> to <font color='41A317'>Update</font>";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Template</th>
<th>File Name</th>
<th>Description</th>
<th>Associated Person</th>
<th>Matter Description</th>
<th>Create</th>
<th>Modify</th>
<th>About</th>
<th>User</th>
<th>Size</th>
<th>Type</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
if($row['Template'] == "1")
{  echo "<td>Template</td>";}
else
if($row['Template'] == "0")
{  echo "<td>No Template</td>";}
  echo "<td><a href='download.php?did=" . $row['Code'] . "'>".$row['Filename']."</a></td>";
  echo "<td><a href='updatefile1.php?dcid=" . $row['Code'] . "'>" . $row['Description'] . "</a></td>";
  echo "<td>". $row['Person'] ."</td>";
  echo "<td>" . $row['Matter'] . "</td>";
  echo "<td>" . $row['Createdate'] . "</td>";
  echo "<td>" . $row['Modifydate'] . "</td>";
  echo "<td>" . $row['Doctype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" .bytesToSize($row['Filesize'])."</td>";
  echo "<td>" . $row['Filetype'] . "</td>";
  echo "<td><a href='deletefile1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete File</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
}

//Option 14
if ($var6 != "ALL")
{
if($filename == "" && $personid == "" && $caseid == "" && $actionid == "")
{
  $result = mysql_query( "SELECT d.id as Code, d.descr as Description, date_format(d.createdate,'%d-%m-%Y') as Createdate, date_format(d.modifydate,'%d-%m-%Y') as Modifydate,
d.filename as Filename, d.content as Content, d.filesize as Filesize, d.filetype as Filetype, u.full_name as username, dt.descr as Doctype,
case when d.personid is not null then p.descr 
when cp.personid is not null then group_concat(p1.descr separator '<br />') 
end as Person, 
case when d.caseid is null then 'Matter no exist' 
else c.descr 
end as Matter, d.istemplate as Template
FROM document d
left join casetoperson cp on d.caseid = cp.caseid
left join cases c on d.caseid=c.id
left join person p on d.personid=p.id
left join person p1 on cp.personid = p1.id
left join users u on u.id=d.userid
left join doctype dt on d.doctypeid=dt.id
WHERE d.isdeleted = 0 and d.istemplate = $var6
group by d.id
order by $var5") or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records. Click <font color='C11B17'>File Name</font> to <font color='41A317'>Download</font>, click <font color='C11B17'>Description</font> to <font color='41A317'>Update</font>";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Template</th>
<th>File Name</th>
<th>Description</th>
<th>Associated Person</th>
<th>Matter Description</th>
<th>Create</th>
<th>Modify</th>
<th>About</th>
<th>User</th>
<th>Size</th>
<th>Type</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
if($row['Template'] == "1")
{  echo "<td>Template</td>";}
else
if($row['Template'] == "0")
{  echo "<td>No Template</td>";}
  echo "<td><a href='download.php?did=" . $row['Code'] . "'>".$row['Filename']."</a></td>";
  echo "<td><a href='updatefile1.php?dcid=" . $row['Code'] . "'>" . $row['Description'] . "</a></td>";
  echo "<td>". $row['Person'] ."</td>";
  echo "<td>" . $row['Matter'] . "</td>";
  echo "<td>" . $row['Createdate'] . "</td>";
  echo "<td>" . $row['Modifydate'] . "</td>";
  echo "<td>" . $row['Doctype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" .bytesToSize($row['Filesize'])."</td>";
  echo "<td>" . $row['Filetype'] . "</td>";
  echo "<td><a href='deletefile1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete File</a></td>";
  echo "</tr>";
  }
echo "</table>";

}

//Option 15
else
if($filename == "" && $personid == "" && $caseid == "" && $actionid != "")
{
  $result = mysql_query( "SELECT d.id as Code, d.descr as Description, date_format(d.createdate,'%d-%m-%Y') as Createdate, date_format(d.modifydate,'%d-%m-%Y') as Modifydate,
d.filename as Filename, d.content as Content, d.filesize as Filesize, d.filetype as Filetype, u.full_name as username, dt.descr as Doctype,
case when d.personid is not null then p.descr 
when cp.personid is not null then group_concat(p1.descr separator '<br />') 
end as Person, 
case when d.caseid is null then 'Matter no exist' 
else c.descr 
end as Matter, d.istemplate as Template
FROM document d
left join casetoperson cp on d.caseid = cp.caseid
left join cases c on d.caseid=c.id
left join person p on d.personid=p.id
left join person p1 on cp.personid = p1.id
left join users u on u.id=d.userid
left join doctype dt on d.doctypeid=dt.id
WHERE d.isdeleted = 0 and dt.id = $actionid and d.istemplate = $var6
group by d.id
order by $var5") or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records. Click <font color='C11B17'>File Name</font> to <font color='41A317'>Download</font>, click <font color='C11B17'>Description</font> to <font color='41A317'>Update</font>";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Template</th>
<th>File Name</th>
<th>Description</th>
<th>Associated Person</th>
<th>Matter Description</th>
<th>Create</th>
<th>Modify</th>
<th>About</th>
<th>User</th>
<th>Size</th>
<th>Type</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
if($row['Template'] == "1")
{  echo "<td>Template</td>";}
else
if($row['Template'] == "0")
{  echo "<td>No Template</td>";}
  echo "<td><a href='download.php?did=" . $row['Code'] . "'>".$row['Filename']."</a></td>";
  echo "<td><a href='updatefile1.php?dcid=" . $row['Code'] . "'>" . $row['Description'] . "</a></td>";
  echo "<td>". $row['Person'] ."</td>";
  echo "<td>" . $row['Matter'] . "</td>";
  echo "<td>" . $row['Createdate'] . "</td>";
  echo "<td>" . $row['Modifydate'] . "</td>";
  echo "<td>" . $row['Doctype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" .bytesToSize($row['Filesize'])."</td>";
  echo "<td>" . $row['Filetype'] . "</td>";
  echo "<td><a href='deletefile1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete File</a></td>";
  echo "</tr>";
  }
echo "</table>";

}

//Option 16
else
if($filename == "" && $personid == "" && $caseid != "" && $actionid == "")
{
  $result = mysql_query( "SELECT d.id as Code, d.descr as Description, date_format(d.createdate,'%d-%m-%Y') as Createdate, date_format(d.modifydate,'%d-%m-%Y') as Modifydate,
d.filename as Filename, d.content as Content, d.filesize as Filesize, d.filetype as Filetype, u.full_name as username, dt.descr as Doctype,
case when d.personid is not null then p.descr 
when cp.personid is not null then group_concat(p1.descr separator '<br />') 
end as Person, 
case when d.caseid is null then 'Matter no exist' 
else c.descr 
end as Matter, d.istemplate as Template
FROM document d
left join casetoperson cp on d.caseid = cp.caseid
left join cases c on d.caseid=c.id
left join person p on d.personid=p.id
left join person p1 on cp.personid = p1.id
left join users u on u.id=d.userid
left join doctype dt on d.doctypeid=dt.id
WHERE d.isdeleted = 0 and c.id = $caseid and d.istemplate = $var6
group by d.id
order by $var5") or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records. Click <font color='C11B17'>File Name</font> to <font color='41A317'>Download</font>, click <font color='C11B17'>Description</font> to <font color='41A317'>Update</font>";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Template</th>
<th>File Name</th>
<th>Description</th>
<th>Associated Person</th>
<th>Matter Description</th>
<th>Create</th>
<th>Modify</th>
<th>About</th>
<th>User</th>
<th>Size</th>
<th>Type</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
if($row['Template'] == "1")
{  echo "<td>Template</td>";}
else
if($row['Template'] == "0")
{  echo "<td>No Template</td>";}
  echo "<td><a href='download.php?did=" . $row['Code'] . "'>".$row['Filename']."</a></td>";
  echo "<td><a href='updatefile1.php?dcid=" . $row['Code'] . "'>" . $row['Description'] . "</a></td>";
  echo "<td>". $row['Person'] ."</td>";
  echo "<td>" . $row['Matter'] . "</td>";
  echo "<td>" . $row['Createdate'] . "</td>";
  echo "<td>" . $row['Modifydate'] . "</td>";
  echo "<td>" . $row['Doctype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" .bytesToSize($row['Filesize'])."</td>";
  echo "<td>" . $row['Filetype'] . "</td>";
  echo "<td><a href='deletefile1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete File</a></td>";
  echo "</tr>";
  }
echo "</table>";

}

//Option 17
else
if($filename == "" && $personid != "" && $caseid == "" && $actionid == "")
{
  $result = mysql_query( "SELECT d.id as Code, d.descr as Description, date_format(d.createdate,'%d-%m-%Y') as Createdate, date_format(d.modifydate,'%d-%m-%Y') as Modifydate,
d.filename as Filename, d.content as Content, d.filesize as Filesize, d.filetype as Filetype, u.full_name as username, dt.descr as Doctype,
case when d.personid is not null then p.descr 
when cp.personid is not null then group_concat(p1.descr separator '<br />') 
end as Person, 
case when d.caseid is null then 'Matter no exist' 
else c.descr 
end as Matter, d.istemplate as Template
FROM document d
left join casetoperson cp on d.caseid = cp.caseid
left join cases c on d.caseid=c.id
left join person p on d.personid=p.id
left join person p1 on cp.personid = p1.id
left join users u on u.id=d.userid
left join doctype dt on d.doctypeid=dt.id
WHERE d.isdeleted = 0 and p.id = $personid and d.istemplate = $var6
group by d.id
order by $var5") or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records. Click <font color='C11B17'>File Name</font> to <font color='41A317'>Download</font>, click <font color='C11B17'>Description</font> to <font color='41A317'>Update</font>";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Template</th>
<th>File Name</th>
<th>Description</th>
<th>Associated Person</th>
<th>Matter Description</th>
<th>Create</th>
<th>Modify</th>
<th>About</th>
<th>User</th>
<th>Size</th>
<th>Type</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
if($row['Template'] == "1")
{  echo "<td>Template</td>";}
else
if($row['Template'] == "0")
{  echo "<td>No Template</td>";}
  echo "<td><a href='download.php?did=" . $row['Code'] . "'>".$row['Filename']."</a></td>";
  echo "<td><a href='updatefile1.php?dcid=" . $row['Code'] . "'>" . $row['Description'] . "</a></td>";
  echo "<td>". $row['Person'] ."</td>";
  echo "<td>" . $row['Matter'] . "</td>";
  echo "<td>" . $row['Createdate'] . "</td>";
  echo "<td>" . $row['Modifydate'] . "</td>";
  echo "<td>" . $row['Doctype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" .bytesToSize($row['Filesize'])."</td>";
  echo "<td>" . $row['Filetype'] . "</td>";
  echo "<td><a href='deletefile1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete File</a></td>";
  echo "</tr>";
  }
echo "</table>";

}

//Option 18
else
if($filename != "" && $personid == "" && $caseid == "" && $actionid == "")
{
  $result = mysql_query( "SELECT d.id as Code, d.descr as Description, date_format(d.createdate,'%d-%m-%Y') as Createdate, date_format(d.modifydate,'%d-%m-%Y') as Modifydate,
d.filename as Filename, d.content as Content, d.filesize as Filesize, d.filetype as Filetype, u.full_name as username, dt.descr as Doctype,
case when d.personid is not null then p.descr 
when cp.personid is not null then group_concat(p1.descr separator '<br />') 
end as Person, 
case when d.caseid is null then 'Matter no exist' 
else c.descr 
end as Matter, d.istemplate as Template
FROM document d
left join casetoperson cp on d.caseid = cp.caseid
left join cases c on d.caseid=c.id
left join person p on d.personid=p.id
left join person p1 on cp.personid = p1.id
left join users u on u.id=d.userid
left join doctype dt on d.doctypeid=dt.id
WHERE d.isdeleted = 0 and d.filename like '%$filename%' and d.istemplate = $var6
group by d.id
order by $var5") or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records. Click <font color='C11B17'>File Name</font> to <font color='41A317'>Download</font>, click <font color='C11B17'>Description</font> to <font color='41A317'>Update</font>";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Template</th>
<th>File Name</th>
<th>Description</th>
<th>Associated Person</th>
<th>Matter Description</th>
<th>Create</th>
<th>Modify</th>
<th>About</th>
<th>User</th>
<th>Size</th>
<th>Type</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
if($row['Template'] == "1")
{  echo "<td>Template</td>";}
else
if($row['Template'] == "0")
{  echo "<td>No Template</td>";}
  echo "<td><a href='download.php?did=" . $row['Code'] . "'>".$row['Filename']."</a></td>";
  echo "<td><a href='updatefile1.php?dcid=" . $row['Code'] . "'>" . $row['Description'] . "</a></td>";
  echo "<td>". $row['Person'] ."</td>";
  echo "<td>" . $row['Matter'] . "</td>";
  echo "<td>" . $row['Createdate'] . "</td>";
  echo "<td>" . $row['Modifydate'] . "</td>";
  echo "<td>" . $row['Doctype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" .bytesToSize($row['Filesize'])."</td>";
  echo "<td>" . $row['Filetype'] . "</td>";
  echo "<td><a href='deletefile1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete File</a></td>";
  echo "</tr>";
  }
echo "</table>";

}

//Option 19
else
if($filename == "" && $personid == "" && $caseid != "" && $actionid != "")
{
  $result = mysql_query( "SELECT d.id as Code, d.descr as Description, date_format(d.createdate,'%d-%m-%Y') as Createdate, date_format(d.modifydate,'%d-%m-%Y') as Modifydate,
d.filename as Filename, d.content as Content, d.filesize as Filesize, d.filetype as Filetype, u.full_name as username, dt.descr as Doctype,
case when d.personid is not null then p.descr 
when cp.personid is not null then group_concat(p1.descr separator '<br />') 
end as Person, 
case when d.caseid is null then 'Matter no exist' 
else c.descr 
end as Matter, d.istemplate as Template
FROM document d
left join casetoperson cp on d.caseid = cp.caseid
left join cases c on d.caseid=c.id
left join person p on d.personid=p.id
left join person p1 on cp.personid = p1.id
left join users u on u.id=d.userid
left join doctype dt on d.doctypeid=dt.id
WHERE d.isdeleted = 0 and dt.id = $actionid and c.id = $caseid and d.istemplate = $var6
group by d.id
order by $var5") or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records. Click <font color='C11B17'>File Name</font> to <font color='41A317'>Download</font>, click <font color='C11B17'>Description</font> to <font color='41A317'>Update</font>";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Template</th>
<th>File Name</th>
<th>Description</th>
<th>Associated Person</th>
<th>Matter Description</th>
<th>Create</th>
<th>Modify</th>
<th>About</th>
<th>User</th>
<th>Size</th>
<th>Type</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
if($row['Template'] == "1")
{  echo "<td>Template</td>";}
else
if($row['Template'] == "0")
{  echo "<td>No Template</td>";}
  echo "<td><a href='download.php?did=" . $row['Code'] . "'>".$row['Filename']."</a></td>";
  echo "<td><a href='updatefile1.php?dcid=" . $row['Code'] . "'>" . $row['Description'] . "</a></td>";
  echo "<td>". $row['Person'] ."</td>";
  echo "<td>" . $row['Matter'] . "</td>";
  echo "<td>" . $row['Createdate'] . "</td>";
  echo "<td>" . $row['Modifydate'] . "</td>";
  echo "<td>" . $row['Doctype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" .bytesToSize($row['Filesize'])."</td>";
  echo "<td>" . $row['Filetype'] . "</td>";
  echo "<td><a href='deletefile1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete File</a></td>";
  echo "</tr>";
  }
echo "</table>";

}

//Option 20
else
if($filename == "" && $personid != "" && $caseid == "" && $actionid != "")
{
  $result = mysql_query( "SELECT d.id as Code, d.descr as Description, date_format(d.createdate,'%d-%m-%Y') as Createdate, date_format(d.modifydate,'%d-%m-%Y') as Modifydate,
d.filename as Filename, d.content as Content, d.filesize as Filesize, d.filetype as Filetype, u.full_name as username, dt.descr as Doctype,
case when d.personid is not null then p.descr 
when cp.personid is not null then group_concat(p1.descr separator '<br />') 
end as Person, 
case when d.caseid is null then 'Matter no exist' 
else c.descr 
end as Matter, d.istemplate as Template
FROM document d
left join casetoperson cp on d.caseid = cp.caseid
left join cases c on d.caseid=c.id
left join person p on d.personid=p.id
left join person p1 on cp.personid = p1.id
left join users u on u.id=d.userid
left join doctype dt on d.doctypeid=dt.id
WHERE d.isdeleted = 0 and dt.id = $actionid and p.id = $personid and d.istemplate = $var6
group by d.id
order by $var5") or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records. Click <font color='C11B17'>File Name</font> to <font color='41A317'>Download</font>, click <font color='C11B17'>Description</font> to <font color='41A317'>Update</font>";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Template</th>
<th>File Name</th>
<th>Description</th>
<th>Associated Person</th>
<th>Matter Description</th>
<th>Create</th>
<th>Modify</th>
<th>About</th>
<th>User</th>
<th>Size</th>
<th>Type</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
if($row['Template'] == "1")
{  echo "<td>Template</td>";}
else
if($row['Template'] == "0")
{  echo "<td>No Template</td>";}
  echo "<td><a href='download.php?did=" . $row['Code'] . "'>".$row['Filename']."</a></td>";
  echo "<td><a href='updatefile1.php?dcid=" . $row['Code'] . "'>" . $row['Description'] . "</a></td>";
  echo "<td>". $row['Person'] ."</td>";
  echo "<td>" . $row['Matter'] . "</td>";
  echo "<td>" . $row['Createdate'] . "</td>";
  echo "<td>" . $row['Modifydate'] . "</td>";
  echo "<td>" . $row['Doctype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" .bytesToSize($row['Filesize'])."</td>";
  echo "<td>" . $row['Filetype'] . "</td>";
  echo "<td><a href='deletefile1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete File</a></td>";
  echo "</tr>";
  }
echo "</table>";

}

//Option 21
else
if($filename != "" && $personid == "" && $caseid == "" && $actionid != "")
{
  $result = mysql_query( "SELECT d.id as Code, d.descr as Description, date_format(d.createdate,'%d-%m-%Y') as Createdate, date_format(d.modifydate,'%d-%m-%Y') as Modifydate,
d.filename as Filename, d.content as Content, d.filesize as Filesize, d.filetype as Filetype, u.full_name as username, dt.descr as Doctype,
case when d.personid is not null then p.descr 
when cp.personid is not null then group_concat(p1.descr separator '<br />') 
end as Person, 
case when d.caseid is null then 'Matter no exist' 
else c.descr 
end as Matter, d.istemplate as Template
FROM document d
left join casetoperson cp on d.caseid = cp.caseid
left join cases c on d.caseid=c.id
left join person p on d.personid=p.id
left join person p1 on cp.personid = p1.id
left join users u on u.id=d.userid
left join doctype dt on d.doctypeid=dt.id
WHERE d.isdeleted = 0 and dt.id = $actionid and d.filename like '%$filename%' and d.istemplate = $var6
group by d.id
order by $var5") or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records. Click <font color='C11B17'>File Name</font> to <font color='41A317'>Download</font>, click <font color='C11B17'>Description</font> to <font color='41A317'>Update</font>";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Template</th>
<th>File Name</th>
<th>Description</th>
<th>Associated Person</th>
<th>Matter Description</th>
<th>Create</th>
<th>Modify</th>
<th>About</th>
<th>User</th>
<th>Size</th>
<th>Type</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
if($row['Template'] == "1")
{  echo "<td>Template</td>";}
else
if($row['Template'] == "0")
{  echo "<td>No Template</td>";}
  echo "<td><a href='download.php?did=" . $row['Code'] . "'>".$row['Filename']."</a></td>";
  echo "<td><a href='updatefile1.php?dcid=" . $row['Code'] . "'>" . $row['Description'] . "</a></td>";
  echo "<td>". $row['Person'] ."</td>";
  echo "<td>" . $row['Matter'] . "</td>";
  echo "<td>" . $row['Createdate'] . "</td>";
  echo "<td>" . $row['Modifydate'] . "</td>";
  echo "<td>" . $row['Doctype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" .bytesToSize($row['Filesize'])."</td>";
  echo "<td>" . $row['Filetype'] . "</td>";
  echo "<td><a href='deletefile1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete File</a></td>";
  echo "</tr>";
  }
echo "</table>";

}

//Option 22
else
if($filename == "" && $personid != "" && $caseid != "" && $actionid != "")
{
  $result = mysql_query( "SELECT d.id as Code, d.descr as Description, date_format(d.createdate,'%d-%m-%Y') as Createdate, date_format(d.modifydate,'%d-%m-%Y') as Modifydate,
d.filename as Filename, d.content as Content, d.filesize as Filesize, d.filetype as Filetype, u.full_name as username, dt.descr as Doctype,
case when d.personid is not null then p.descr 
when cp.personid is not null then group_concat(p1.descr separator '<br />') 
end as Person, 
case when d.caseid is null then 'Matter no exist' 
else c.descr 
end as Matter, d.istemplate as Template
FROM document d
left join casetoperson cp on d.caseid = cp.caseid
left join cases c on d.caseid=c.id
left join person p on d.personid=p.id
left join person p1 on cp.personid = p1.id
left join users u on u.id=d.userid
left join doctype dt on d.doctypeid=dt.id
WHERE d.isdeleted = 0 and dt.id = $actionid and c.id = $caseid and p.id = $personid and d.istemplate = $var6
group by d.id
order by $var5") or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records. Click <font color='C11B17'>File Name</font> to <font color='41A317'>Download</font>, click <font color='C11B17'>Description</font> to <font color='41A317'>Update</font>";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Template</th>
<th>File Name</th>
<th>Description</th>
<th>Associated Person</th>
<th>Matter Description</th>
<th>Create</th>
<th>Modify</th>
<th>About</th>
<th>User</th>
<th>Size</th>
<th>Type</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
if($row['Template'] == "1")
{  echo "<td>Template</td>";}
else
if($row['Template'] == "0")
{  echo "<td>No Template</td>";}
  echo "<td><a href='download.php?did=" . $row['Code'] . "'>".$row['Filename']."</a></td>";
  echo "<td><a href='updatefile1.php?dcid=" . $row['Code'] . "'>" . $row['Description'] . "</a></td>";
  echo "<td>". $row['Person'] ."</td>";
  echo "<td>" . $row['Matter'] . "</td>";
  echo "<td>" . $row['Createdate'] . "</td>";
  echo "<td>" . $row['Modifydate'] . "</td>";
  echo "<td>" . $row['Doctype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" .bytesToSize($row['Filesize'])."</td>";
  echo "<td>" . $row['Filetype'] . "</td>";
  echo "<td><a href='deletefile1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete File</a></td>";
  echo "</tr>";
  }
echo "</table>";

}

//Option 23
else
if($filename != "" && $personid == "" && $caseid != "" && $actionid != "")
{
  $result = mysql_query( "SELECT d.id as Code, d.descr as Description, date_format(d.createdate,'%d-%m-%Y') as Createdate, date_format(d.modifydate,'%d-%m-%Y') as Modifydate,
d.filename as Filename, d.content as Content, d.filesize as Filesize, d.filetype as Filetype, u.full_name as username, dt.descr as Doctype,
case when d.personid is not null then p.descr 
when cp.personid is not null then group_concat(p1.descr separator '<br />') 
end as Person, 
case when d.caseid is null then 'Matter no exist' 
else c.descr 
end as Matter, d.istemplate as Template
FROM document d
left join casetoperson cp on d.caseid = cp.caseid
left join cases c on d.caseid=c.id
left join person p on d.personid=p.id
left join person p1 on cp.personid = p1.id
left join users u on u.id=d.userid
left join doctype dt on d.doctypeid=dt.id
WHERE d.isdeleted = 0 and dt.id = $actionid and c.id = $caseid and d.filename like '%$filename%' and d.istemplate = $var6
group by d.id
order by $var5") or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records. Click <font color='C11B17'>File Name</font> to <font color='41A317'>Download</font>, click <font color='C11B17'>Description</font> to <font color='41A317'>Update</font>";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Template</th>
<th>File Name</th>
<th>Description</th>
<th>Associated Person</th>
<th>Matter Description</th>
<th>Create</th>
<th>Modify</th>
<th>About</th>
<th>User</th>
<th>Size</th>
<th>Type</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
if($row['Template'] == "1")
{  echo "<td>Template</td>";}
else
if($row['Template'] == "0")
{  echo "<td>No Template</td>";}
  echo "<td><a href='download.php?did=" . $row['Code'] . "'>".$row['Filename']."</a></td>";
  echo "<td><a href='updatefile1.php?dcid=" . $row['Code'] . "'>" . $row['Description'] . "</a></td>";
  echo "<td>". $row['Person'] ."</td>";
  echo "<td>" . $row['Matter'] . "</td>";
  echo "<td>" . $row['Createdate'] . "</td>";
  echo "<td>" . $row['Modifydate'] . "</td>";
  echo "<td>" . $row['Doctype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" .bytesToSize($row['Filesize'])."</td>";
  echo "<td>" . $row['Filetype'] . "</td>";
  echo "<td><a href='deletefile1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete File</a></td>";
  echo "</tr>";
  }
echo "</table>";

}

//Option 24
else
if($filename != "" && $personid != "" && $caseid == "" && $actionid != "")
{
  $result = mysql_query( "SELECT d.id as Code, d.descr as Description, date_format(d.createdate,'%d-%m-%Y') as Createdate, date_format(d.modifydate,'%d-%m-%Y') as Modifydate,
d.filename as Filename, d.content as Content, d.filesize as Filesize, d.filetype as Filetype, u.full_name as username, dt.descr as Doctype,
case when d.personid is not null then p.descr 
when cp.personid is not null then group_concat(p1.descr separator '<br />') 
end as Person, 
case when d.caseid is null then 'Matter no exist' 
else c.descr 
end as Matter, d.istemplate as Template
FROM document d
left join casetoperson cp on d.caseid = cp.caseid
left join cases c on d.caseid=c.id
left join person p on d.personid=p.id
left join person p1 on cp.personid = p1.id
left join users u on u.id=d.userid
left join doctype dt on d.doctypeid=dt.id
WHERE d.isdeleted = 0 and dt.id = $actionid and p.id = $personid and d.filename like '%$filename%' and d.istemplate = $var6
group by d.id
order by $var5") or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records. Click <font color='C11B17'>File Name</font> to <font color='41A317'>Download</font>, click <font color='C11B17'>Description</font> to <font color='41A317'>Update</font>";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Template</th>
<th>File Name</th>
<th>Description</th>
<th>Associated Person</th>
<th>Matter Description</th>
<th>Create</th>
<th>Modify</th>
<th>About</th>
<th>User</th>
<th>Size</th>
<th>Type</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
if($row['Template'] == "1")
{  echo "<td>Template</td>";}
else
if($row['Template'] == "0")
{  echo "<td>No Template</td>";}
  echo "<td><a href='download.php?did=" . $row['Code'] . "'>".$row['Filename']."</a></td>";
  echo "<td><a href='updatefile1.php?dcid=" . $row['Code'] . "'>" . $row['Description'] . "</a></td>";
  echo "<td>". $row['Person'] ."</td>";
  echo "<td>" . $row['Matter'] . "</td>";
  echo "<td>" . $row['Createdate'] . "</td>";
  echo "<td>" . $row['Modifydate'] . "</td>";
  echo "<td>" . $row['Doctype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" .bytesToSize($row['Filesize'])."</td>";
  echo "<td>" . $row['Filetype'] . "</td>";
  echo "<td><a href='deletefile1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete File</a></td>";
  echo "</tr>";
  }
echo "</table>";

}

//Option 25
else
if($filename != "" && $personid != "" && $caseid != "" && $actionid == "")
{
  $result = mysql_query( "SELECT d.id as Code, d.descr as Description, date_format(d.createdate,'%d-%m-%Y') as Createdate, date_format(d.modifydate,'%d-%m-%Y') as Modifydate,
d.filename as Filename, d.content as Content, d.filesize as Filesize, d.filetype as Filetype, u.full_name as username, dt.descr as Doctype,
case when d.personid is not null then p.descr 
when cp.personid is not null then group_concat(p1.descr separator '<br />') 
end as Person, 
case when d.caseid is null then 'Matter no exist' 
else c.descr 
end as Matter, d.istemplate as Template
FROM document d
left join casetoperson cp on d.caseid = cp.caseid
left join cases c on d.caseid=c.id
left join person p on d.personid=p.id
left join person p1 on cp.personid = p1.id
left join users u on u.id=d.userid
left join doctype dt on d.doctypeid=dt.id
WHERE d.isdeleted = 0 and c.id = $caseid and p.id = $personid and d.filename like '%$filename%' and d.istemplate = $var6
group by d.id
order by $var5") or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records. Click <font color='C11B17'>File Name</font> to <font color='41A317'>Download</font>, click <font color='C11B17'>Description</font> to <font color='41A317'>Update</font>";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Template</th>
<th>File Name</th>
<th>Description</th>
<th>Associated Person</th>
<th>Matter Description</th>
<th>Create</th>
<th>Modify</th>
<th>About</th>
<th>User</th>
<th>Size</th>
<th>Type</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
if($row['Template'] == "1")
{  echo "<td>Template</td>";}
else
if($row['Template'] == "0")
{  echo "<td>No Template</td>";}
  echo "<td><a href='download.php?did=" . $row['Code'] . "'>".$row['Filename']."</a></td>";
  echo "<td><a href='updatefile1.php?dcid=" . $row['Code'] . "'>" . $row['Description'] . "</a></td>";
  echo "<td>". $row['Person'] ."</td>";
  echo "<td>" . $row['Matter'] . "</td>";
  echo "<td>" . $row['Createdate'] . "</td>";
  echo "<td>" . $row['Modifydate'] . "</td>";
  echo "<td>" . $row['Doctype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" .bytesToSize($row['Filesize'])."</td>";
  echo "<td>" . $row['Filetype'] . "</td>";
  echo "<td><a href='deletefile1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete File</a></td>";
  echo "</tr>";
  }
echo "</table>";

}

//Option 26
else
if($filename != "" && $personid != "" && $caseid != "" && $actionid != "")
{
  $result = mysql_query( "SELECT d.id as Code, d.descr as Description, date_format(d.createdate,'%d-%m-%Y') as Createdate, date_format(d.modifydate,'%d-%m-%Y') as Modifydate,
d.filename as Filename, d.content as Content, d.filesize as Filesize, d.filetype as Filetype, u.full_name as username, dt.descr as Doctype,
case when d.personid is not null then p.descr 
when cp.personid is not null then group_concat(p1.descr separator '<br />') 
end as Person, 
case when d.caseid is null then 'Matter no exist' 
else c.descr 
end as Matter, d.istemplate as Template
FROM document d
left join casetoperson cp on d.caseid = cp.caseid
left join cases c on d.caseid=c.id
left join person p on d.personid=p.id
left join person p1 on cp.personid = p1.id
left join users u on u.id=d.userid
left join doctype dt on d.doctypeid=dt.id
WHERE d.isdeleted = 0 and c.id = $caseid and p.id = $personid and d.filename like '%$filename%' and dt.id = $actionid and d.istemplate = $var6
group by d.id
order by $var5") or die("SELECT Error: ".mysql_error());
$num_rows = mysql_num_rows($result);

print "$num_rows records. Click <font color='C11B17'>File Name</font> to <font color='41A317'>Download</font>, click <font color='C11B17'>Description</font> to <font color='41A317'>Update</font>";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Template</th>
<th>File Name</th>
<th>Description</th>
<th>Associated Person</th>
<th>Matter Description</th>
<th>Create</th>
<th>Modify</th>
<th>About</th>
<th>User</th>
<th>Size</th>
<th>Type</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
if($row['Template'] == "1")
{  echo "<td>Template</td>";}
else
if($row['Template'] == "0")
{  echo "<td>No Template</td>";}
  echo "<td><a href='download.php?did=" . $row['Code'] . "'>".$row['Filename']."</a></td>";
  echo "<td><a href='updatefile1.php?did=" . $row['Code'] . "'>" . $row['Description'] . "</a></td>";
  echo "<td>". $row['Person'] ."</td>";
  echo "<td>" . $row['Matter'] . "</td>";
  echo "<td>" . $row['Createdate'] . "</td>";
  echo "<td>" . $row['Modifydate'] . "</td>";
  echo "<td>" . $row['Doctype'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" .bytesToSize($row['Filesize'])."</td>";
  echo "<td>" . $row['Filetype'] . "</td>";
  echo "<td><a href='deletefile1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete File</a></td>";
  echo "</tr>";
  }
echo "</table>";

}
}
?>
<p><a href="files.php">Return to File Options</a>.</p>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>
</body>
</html>
