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

$access=mysql_result($permission, 24);
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
<link rel="stylesheet"  href= "css/billingtablestyle.css" />
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

$('#tabs').tabs('select','tabs-5');
    
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

<div class="billing">

<div id="tabs">
    <ul>
        <li><a href="myaccount.php" onclick="window.location=('myaccount.php')"><span><?php echo mysql_result($module,7); ?></span></a></li>
        <li><a href="person.php" onclick="window.location=('person.php')"><span><?php echo mysql_result($module,0); ?></span></a></li>
        <li><a href="matters.php" onclick="window.location=('matters.php')"><span><?php echo mysql_result($module,1); ?></span></a></li>
        <li><a href="tasks.php" onclick="window.location=('tasks.php')"><span><?php echo mysql_result($module,2); ?></span></a></li>
        <li><a href="#tabs-5"><span><?php echo mysql_result($module,3); ?></span></a></li>
        <li><a href="files.php" onclick="window.location=('files.php')"><span><?php echo mysql_result($module,4); ?></span></a></li>
        <li><a href="protocol.php" onclick="window.location=('protocol.php')"><span><?php echo mysql_result($module,5); ?></span></a></li>
        <li><a href="adminsettings.php" onclick="window.location=('adminsettings.php')"><span><?php echo mysql_result($module,6); ?></span></a></li>
    </ul>
    <div id="tabs-5">
<?php
// Get the search variable from URL

  $var1 = @$_GET['billname'] ;
  $var2 = @$_GET['personid'] ;
  $var3 = @$_GET['caseid'] ;
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
  $var13 = @$_GET['r'];
  $var14 = @$_GET['SEI'];
  $var15 = @$_GET['ttype'] ;
  $var16 = @$_GET['assperson'];
  $var17 = @$_GET['matter'];
  $var18 = @$_GET['sdate'];
  $var19 = @$_GET['stime'];
  $var20 = @$_GET['sduration'] ;
  $var21 = @$_GET['sstatus'];
  $var22 = @$_GET['suser'];
  $var23 = @$_GET['snotes'];
  $var24 = @$_GET['rtasks'];
  $var25 = @$_GET['rexpenses'];
  $var26 = @$_GET['rincomes'];
  $var27 = @$_GET['roffice'];

//Set $var28 variable
//4 choises
if($var24 != "" && $var25 != "" && $var26 != "" && $var27 != "") { $var28="and ca.actiontypeid in ($var24,$var25,$var26,$var27)";} else
//3 choises
if($var24 != "" && $var25 != "" && $var26 != "" && $var27 == "") { $var28="and ca.actiontypeid in ($var24,$var25,$var26)";} else
if($var24 != "" && $var25 != "" && $var26 == "" && $var27 != "") { $var28="and ca.actiontypeid in ($var24,$var25,$var27)";} else
if($var24 != "" && $var25 == "" && $var26 != "" && $var27 != "") { $var28="and ca.actiontypeid in ($var24,$var26,$var27)";} else
if($var24 == "" && $var25 != "" && $var26 != "" && $var27 != "") { $var28="and ca.actiontypeid in ($var26,$var25,$var27)";} else
//2 choises
if($var24 != "" && $var25 != "" && $var26 == "" && $var27 == "") { $var28="and ca.actiontypeid in ($var24,$var25)";} else
if($var24 != "" && $var25 == "" && $var26 != "" && $var27 == "") { $var28="and ca.actiontypeid in ($var24,$var26)";} else
if($var24 == "" && $var25 != "" && $var26 != "" && $var27 == "") { $var28="and ca.actiontypeid in ($var25,$var26)";} else
if($var24 != "" && $var25 == "" && $var26 == "" && $var27 != "") { $var28="and ca.actiontypeid in ($var24,$var27)";} else
if($var24 == "" && $var25 != "" && $var26 == "" && $var27 != "") { $var28="and ca.actiontypeid in ($var25,$var27)";} else
if($var24 == "" && $var25 == "" && $var26 != "" && $var27 != "") { $var28="and ca.actiontypeid in ($var26,$var27)";} else
//1 choise
if($var24 != "" && $var25 == "" && $var26 == "" && $var27 == "") { $var28="and ca.actiontypeid = $var24";} else
if($var24 == "" && $var25 != "" && $var26 == "" && $var27 == "") { $var28="and ca.actiontypeid = $var25";} else
if($var24 == "" && $var25 == "" && $var26 != "" && $var27 == "") { $var28="and ca.actiontypeid = $var26";} else
if($var24 == "" && $var25 == "" && $var26 == "" && $var27 != "") { $var28="and ca.actiontypeid = $var27";} else
//No choise
if($var24 = "" && $var25 == "" && $var26 == "" && $var27 == "") { $var28="and ca.actiontypeid = 0";}

echo "<h4>Task results</h4>";
echo "<p><a href='billing.php'>Return to Billing Options</a>. <a href='#' onclick='window.location.reload( true );'>Reload</a></p>";
echo "<p>Your search returned: </p>";

//Option 1
if($var12 == "")
{
// billname not null
if($var1 != "")
{
if($var2 == "")
{
if($var3 == "" && $var10 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name,
case when ca.personid is not null then p.descr
when cp.personid is not null then group_concat(p1.descr separator '<br />')
end as Person,
case when
ca.caseid is null then 'Matter no exist'
else c.descr
end as Matter,
case when ca.actiontypeid = 2 then 'Expense'
when ca.actiontypeid = 3 then 'Income'
when ca.actiontypeid = 4 then (select of.descr from case2action c2a left join officeexptype of on of.id = c2a.officeexptypeid where c2a.id = ca.id)
else pt.descr
end as Type,
ca.actiontypeid as actiontypeid,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, date_format(ca.duration,'%H:%i') as duration, st.descr as status, ca.notes as Notes, ca.cost as Cost
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join cases c on ca.caseid=c.id
left join person p on p.id = ca.personid
left join person p1 on cp.personid = p1.id
left join proceduretypes pt on pt.id = ca.proceduretypeid
left join users u on u.id = ca.userid
left join status st on st.id = ca.statusid
where ca.isdeleted = 0 and (ca.actionstartdate between $datefrom and $dateto) and (ca.descr like \"%$var1%\" or u.full_name like \"%$var1%\" or ca.notes like \"%$var1%\") $var13 $var28
group by ca.id
order by $var11")
or die("SELECT Error: ".mysql_error());

$num_rows = mysql_num_rows($result);

$total = mysql_query( "SELECT sum(CASE WHEN ca.actiontypeid = 3 THEN (ca.cost)*-1 ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 1 THEN (ca.cost) ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 2 THEN (ca.cost) ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 4 THEN (ca.cost) ELSE 0 END) AS total
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join person p on p.id = ca.personid
left join person p1 on cp.personid = p1.id
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and (ca.actionstartdate between $datefrom and $dateto) and (ca.descr like \"%$var1%\" or u.full_name like \"%$var1%\" or ca.notes like \"%$var1%\") $var13 $var28")
or die("SELECT Error: ".mysql_error());

$sum_total = mysql_fetch_row($total);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Task Description</th>";
if($var15 == '1')
{
echo"<th>Task Type</th>";
}
if($var16 == '1')
{
echo"<th>Associated Person</th>";
}
if($var17 == '1')
{
echo"<th>Matter</th>";
}
if($var18 == '1')
{
echo"<th>Date</th>";
}
if($var19 == '1')
{
echo"<th>Time</th>";
}
if($var20 == '1')
{
echo"<th>Duration</th>";
}
if($var21 == '1')
{
echo"<th>Status</th>";
}
if($var22 == '1')
{
echo"<th>User</th>";
}
if($var23 == '1')
{
echo"<th>Notes</th>";
}
echo"<th>Cost</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
if($row['actiontypeid'] ==  '2')
  {
echo "<td><a href='updateexpense1.php?tid=" . $row['Code'] . "'><font color='#C11B17'>".$row['Name']."</font></a></td>";
  }
if($row['actiontypeid'] ==  '3')
  {
  echo "<td><a href='updateincome1.php?tid=" . $row['Code'] . "'><font color='#347235'>".$row['Name']."</font></a></td>";
  }
if($row['actiontypeid'] == '1')
  {
 echo "<td><a href='updatetask3.php?tid=" . $row['Code'] . "'>".$row['Name']."</a></td>";
  }
if($row['actiontypeid'] == '4')
  {
 echo "<td><a href='updateofficeexpense1.php?tid=" . $row['Code'] . "'><font color='#2554C7'>".$row['Name']."</font></a></td>";
  }
if($var15 == '1')
{
  echo "<td>". $row['Type'] ."</td>";
}
if($var16 == '1')
{
  echo "<td>". $row['Person'] ."</td>";
}
if($var17 == '1')
{
  echo "<td>" . $row['Matter'] . "</td>";
}
if($var18 == '1')
{
  echo "<td>" . $row['actionstartdate'] . "</td>";
}
if($var19 == '1')
{
  echo "<td>" . $row['actionstarttime'] . "</td>";
}
if($var20 == '1')
{
  echo "<td>" . $row['duration'] . "</td>";
}
if($var21 == '1')
{
  echo "<td>" . $row['status'] . "</td>";
}
if($var22 == '1')
{
  echo "<td>" . $row['username'] . "</td>";
}
if($var23 == '1')
{
  echo "<td>" . $row['Notes'] . "</td>";
}
if($row['actiontypeid'] ==  '2')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#C11B17'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
if($row['actiontypeid'] ==  '3')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#347235'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
if($row['actiontypeid'] ==  '1')
  {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\">".number_format($row['Cost'], 2, '.', '')."&#8364;</a></td>";
  }
if($row['actiontypeid'] ==  '4')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#2554C7'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
  echo "<td><a href='deletebill1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Bill</a></td>";
  echo "</tr>";
}
  echo "<tr>";
  echo "<td><font color='#990000' size='3'>Total Sum</font></td>";
if($var15 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var16 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var17 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var18 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var19 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var20 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var21 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var22 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var23 == '1')
{
  echo "<td>&nbsp;</td>";
}
  echo "<td><font color='#990000' size='3'>".number_format($sum_total[0], 2, '.', '')."&#8364;</font></td>";
  echo "<td>&nbsp;</td>";
  echo "</tr>";
echo "</table>";

}
// Option 2
else
if($var3 != "" && $var10 != "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, ca.proceduretypeid as prid,
case when ca.personid is not null then p.descr
when cp.personid is not null then group_concat(p1.descr separator '<br />')
end as Person,
case when
ca.caseid is null then 'Matter no exist'
else c.descr
end as Matter,
case when ca.actiontypeid = 2 then 'Expense'
when ca.actiontypeid = 3 then 'Income'
when ca.actiontypeid = 4 then (select of.descr from case2action c2a left join officeexptype of on of.id = c2a.officeexptypeid where c2a.id = ca.id)
else pt.descr
end as Type,
ca.actiontypeid as actiontypeid,
ca.caseid as cid, date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, date_format(ca.duration,'%H:%i') as duration, st.descr as status, ca.notes as Notes, ca.cost as Cost
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join cases c on ca.caseid=c.id
left join person p on p.id = ca.personid
left join person p1 on cp.personid = p1.id
left join proceduretypes pt on pt.id = ca.proceduretypeid
left join users u on u.id = ca.userid
left join status st on st.id = ca.statusid
where ca.isdeleted = 0 and (ca.actionstartdate between $datefrom and $dateto) and (ca.descr like \"%$var1%\" or u.full_name like \"%$var1%\" or ca.notes like \"%$var1%\") and ca.caseid=$var3 and ca.proceduretypeid=$var10 $var13 $var28
group by ca.id
order by $var11")
or die("SELECT Error: ".mysql_error());

$num_rows = mysql_num_rows($result);

$total = mysql_query( "SELECT sum(CASE WHEN ca.actiontypeid = 3 THEN (ca.cost)*-1 ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 1 THEN (ca.cost) ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 2 THEN (ca.cost) ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 4 THEN (ca.cost) ELSE 0 END) AS total
FROM case2action c
left join person p on p.id = ca.personid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and (ca.actionstartdate between $datefrom and $dateto) and (ca.descr like \"%$var1%\" or u.full_name like \"%$var1%\" or ca.notes like \"%$var1%\") and ca.caseid=$var3 and ca.proceduretypeid=$var10 $var13 $var28")
or die("SELECT Error: ".mysql_error());

$sum_total = mysql_fetch_row($total);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Task Description</th>";
if($var15 == '1')
{
echo"<th>Task Type</th>";
}
if($var16 == '1')
{
echo"<th>Associated Person</th>";
}
if($var17 == '1')
{
echo"<th>Matter</th>";
}
if($var18 == '1')
{
echo"<th>Date</th>";
}
if($var19 == '1')
{
echo"<th>Time</th>";
}
if($var20 == '1')
{
echo"<th>Duration</th>";
}
if($var21 == '1')
{
echo"<th>Status</th>";
}
if($var22 == '1')
{
echo"<th>User</th>";
}
if($var23 == '1')
{
echo"<th>Notes</th>";
}
echo"<th>Cost</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
if($row['actiontypeid'] ==  '2')
  {
echo "<td><a href='updateexpense1.php?tid=" . $row['Code'] . "'><font color='#C11B17'>".$row['Name']."</font></a></td>";
  }
if($row['actiontypeid'] ==  '3')
  {
  echo "<td><a href='updateincome1.php?tid=" . $row['Code'] . "'><font color='#347235'>".$row['Name']."</font></a></td>";
  }
if($row['actiontypeid'] == '1')
  {
 echo "<td><a href='updatetask3.php?tid=" . $row['Code'] . "'>".$row['Name']."</a></td>";
  }
if($row['actiontypeid'] == '4')
  {
 echo "<td><a href='updateofficeexpense1.php?tid=" . $row['Code'] . "'><font color='#2554C7'>".$row['Name']."</font></a></td>";
  }
if($var15 == '1')
{
  echo "<td>". $row['Type'] ."</td>";
}
if($var16 == '1')
{
  echo "<td>". $row['Person'] ."</td>";
}
if($var17 == '1')
{
  echo "<td>" . $row['Matter'] . "</td>";
}
if($var18 == '1')
{
  echo "<td>" . $row['actionstartdate'] . "</td>";
}
if($var19 == '1')
{
  echo "<td>" . $row['actionstarttime'] . "</td>";
}
if($var20 == '1')
{
  echo "<td>" . $row['duration'] . "</td>";
}
if($var21 == '1')
{
  echo "<td>" . $row['status'] . "</td>";
}
if($var22 == '1')
{
  echo "<td>" . $row['username'] . "</td>";
}
if($var23 == '1')
{
  echo "<td>" . $row['Notes'] . "</td>";
}
if($row['actiontypeid'] ==  '2')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#C11B17'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
if($row['actiontypeid'] ==  '3')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#347235'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
if($row['actiontypeid'] ==  '1')
  {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\">".number_format($row['Cost'], 2, '.', '')."&#8364;</a></td>";
  }
if($row['actiontypeid'] ==  '4')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#2554C7'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
  echo "<td><a href='deletebill1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Bill</a></td>";
  echo "</tr>";
}
  echo "<tr>";
  echo "<td><font color='#990000' size='3'>Total Sum</font></td>";
if($var15 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var16 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var17 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var18 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var19 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var20 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var21 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var22 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var23 == '1')
{
  echo "<td>&nbsp;</td>";
}
  echo "<td><font color='#990000' size='3'>".number_format($sum_total[0], 2, '.', '')."&#8364;</font></td>";
  echo "<td>&nbsp;</td>";
  echo "</tr>";
echo "</table>";

}
// Option 3
else
if($var3 != "" && $var10 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name,
case when ca.personid is not null then p.descr
when cp.personid is not null then group_concat(p1.descr separator '<br />')
end as Person,
ca.personid as pid,
case when
ca.caseid is null then 'Matter no exist'
else c.descr
end as Matter,
case when ca.actiontypeid = 2 then 'Expense'
when ca.actiontypeid = 3 then 'Income'
when ca.actiontypeid = 4 then (select of.descr from case2action c2a left join officeexptype of on of.id = c2a.officeexptypeid where c2a.id = ca.id)
else pt.descr
end as Type,
ca.actiontypeid as actiontypeid,
ca.caseid as cid, date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, date_format(ca.duration,'%H:%i') as duration, st.descr as status, ca.notes as Notes, ca.cost as Cost
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join cases c on ca.caseid=c.id
left join person p on p.id = ca.personid
left join person p1 on cp.personid = p1.id
left join proceduretypes pt on pt.id = ca.proceduretypeid
left join users u on u.id = ca.userid
left join status st on st.id = ca.statusid
where ca.isdeleted = 0 and (ca.actionstartdate between $datefrom and $dateto) and (ca.descr like \"%$var1%\" or u.full_name like \"%$var1%\" or ca.notes like \"%$var1%\") and ca.caseid=$var3 $var13 $var28
group by ca.id
order by $var11")
or die("SELECT Error: ".mysql_error());

$num_rows = mysql_num_rows($result);

$total = mysql_query( "SELECT sum(CASE WHEN ca.actiontypeid = 3 THEN (ca.cost)*-1 ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 1 THEN (ca.cost) ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 2 THEN (ca.cost) ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 4 THEN (ca.cost) ELSE 0 END) AS total
FROM case2action ca
left join person p on p.id = ca.personid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and (ca.actionstartdate between $datefrom and $dateto) and (ca.descr like \"%$var1%\" or u.full_name like \"%$var1%\" or ca.notes like \"%$var1%\") and ca.caseid=$var3 $var13 $var28")
or die("SELECT Error: ".mysql_error());

$sum_total = mysql_fetch_row($total);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Task Description</th>";
if($var15 == '1')
{
echo"<th>Task Type</th>";
}
if($var16 == '1')
{
echo"<th>Associated Person</th>";
}
if($var17 == '1')
{
echo"<th>Matter</th>";
}
if($var18 == '1')
{
echo"<th>Date</th>";
}
if($var19 == '1')
{
echo"<th>Time</th>";
}
if($var20 == '1')
{
echo"<th>Duration</th>";
}
if($var21 == '1')
{
echo"<th>Status</th>";
}
if($var22 == '1')
{
echo"<th>User</th>";
}
if($var23 == '1')
{
echo"<th>Notes</th>";
}
echo"<th>Cost</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
if($row['actiontypeid'] ==  '2')
  {
echo "<td><a href='updateexpense1.php?tid=" . $row['Code'] . "'><font color='#C11B17'>".$row['Name']."</font></a></td>";
  }
if($row['actiontypeid'] ==  '3')
  {
  echo "<td><a href='updateincome1.php?tid=" . $row['Code'] . "'><font color='#347235'>".$row['Name']."</font></a></td>";
  }
if($row['actiontypeid'] == '1')
  {
 echo "<td><a href='updatetask3.php?tid=" . $row['Code'] . "'>".$row['Name']."</a></td>";
  }
if($row['actiontypeid'] == '4')
  {
 echo "<td><a href='updateofficeexpense1.php?tid=" . $row['Code'] . "'><font color='#2554C7'>".$row['Name']."</font></a></td>";
  }
if($var15 == '1')
{
  echo "<td>". $row['Type'] ."</td>";
}
if($var16 == '1')
{
  echo "<td>". $row['Person'] ."</td>";
}
if($var17 == '1')
{
  echo "<td>" . $row['Matter'] . "</td>";
}
if($var18 == '1')
{
  echo "<td>" . $row['actionstartdate'] . "</td>";
}
if($var19 == '1')
{
  echo "<td>" . $row['actionstarttime'] . "</td>";
}
if($var20 == '1')
{
  echo "<td>" . $row['duration'] . "</td>";
}
if($var21 == '1')
{
  echo "<td>" . $row['status'] . "</td>";
}
if($var22 == '1')
{
  echo "<td>" . $row['username'] . "</td>";
}
if($var23 == '1')
{
  echo "<td>" . $row['Notes'] . "</td>";
}
if($row['actiontypeid'] ==  '2')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#C11B17'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
if($row['actiontypeid'] ==  '3')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#347235'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
if($row['actiontypeid'] ==  '1')
  {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\">".number_format($row['Cost'], 2, '.', '')."&#8364;</a></td>";
  }
if($row['actiontypeid'] ==  '4')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#2554C7'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
  echo "<td><a href='deletebill1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Bill</a></td>";
  echo "</tr>";
}
  echo "<tr>";
  echo "<td><font color='#990000' size='3'>Total Sum</font></td>";
if($var15 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var16 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var17 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var18 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var19 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var20 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var21 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var22 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var23 == '1')
{
  echo "<td>&nbsp;</td>";
}
  echo "<td><font color='#990000' size='3'>".number_format($sum_total[0], 2, '.', '')."&#8364;</font></td>";
  echo "<td>&nbsp;</td>";
  echo "</tr>";
echo "</table>";

}
// Option 4
else
if($var3 == "" && $var10 != "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name,ca.proceduretypeid as prid,
case when ca.personid is not null then p.descr
when cp.personid is not null then group_concat(p1.descr separator '<br />')
end as Person,
case when
ca.caseid is null then 'Matter no exist'
else c.descr
end as Matter,
case when ca.actiontypeid = 2 then 'Expense'
when ca.actiontypeid = 3 then 'Income'
when ca.actiontypeid = 4 then (select of.descr from case2action c2a left join officeexptype of on of.id = c2a.officeexptypeid where c2a.id = ca.id)
else pt.descr
end as Type,
ca.actiontypeid as actiontypeid,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, date_format(ca.duration,'%H:%i') as duration, st.descr as status, ca.notes as Notes, ca.cost as Cost
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join cases c on ca.caseid=c.id
left join person p on p.id = ca.personid
left join person p1 on cp.personid = p1.id
left join proceduretypes pt on pt.id = ca.proceduretypeid
left join users u on u.id = ca.userid
left join status st on st.id = ca.statusid
where ca.isdeleted = 0 and (ca.actionstartdate between $datefrom and $dateto) and (ca.descr like \"%$var1%\" or u.full_name like \"%$var1%\" or ca.notes like \"%$var1%\") and ca.proceduretypeid=$var10 $var13 $var28
group by ca.id
order by $var11")
or die("SELECT Error: ".mysql_error());

$num_rows = mysql_num_rows($result);

$total = mysql_query( "SELECT sum(CASE WHEN ca.actiontypeid = 3 THEN (ca.cost)*-1 ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 1 THEN (ca.cost) ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 2 THEN (ca.cost) ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 4 THEN (ca.cost) ELSE 0 END) AS total
FROM case2action ca
left join person p on p.id = ca.personid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and (ca.actionstartdate between $datefrom and $dateto) and (ca.descr like \"%$var1%\" or u.full_name like \"%$var1%\" or ca.notes like \"%$var1%\") and ca.proceduretypeid=$var10 $var13 $var28")
or die("SELECT Error: ".mysql_error());

$sum_total = mysql_fetch_row($total);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Task Description</th>";
if($var15 == '1')
{
echo"<th>Task Type</th>";
}
if($var16 == '1')
{
echo"<th>Associated Person</th>";
}
if($var17 == '1')
{
echo"<th>Matter</th>";
}
if($var18 == '1')
{
echo"<th>Date</th>";
}
if($var19 == '1')
{
echo"<th>Time</th>";
}
if($var20 == '1')
{
echo"<th>Duration</th>";
}
if($var21 == '1')
{
echo"<th>Status</th>";
}
if($var22 == '1')
{
echo"<th>User</th>";
}
if($var23 == '1')
{
echo"<th>Notes</th>";
}
echo"<th>Cost</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
if($row['actiontypeid'] ==  '2')
  {
echo "<td><a href='updateexpense1.php?tid=" . $row['Code'] . "'><font color='#C11B17'>".$row['Name']."</font></a></td>";
  }
if($row['actiontypeid'] ==  '3')
  {
  echo "<td><a href='updateincome1.php?tid=" . $row['Code'] . "'><font color='#347235'>".$row['Name']."</font></a></td>";
  }
if($row['actiontypeid'] == '1')
  {
 echo "<td><a href='updatetask3.php?tid=" . $row['Code'] . "'>".$row['Name']."</a></td>";
  }
if($row['actiontypeid'] == '4')
  {
 echo "<td><a href='updateofficeexpense1.php?tid=" . $row['Code'] . "'><font color='#2554C7'>".$row['Name']."</font></a></td>";
  }
if($var15 == '1')
{
  echo "<td>". $row['Type'] ."</td>";
}
if($var16 == '1')
{
  echo "<td>". $row['Person'] ."</td>";
}
if($var17 == '1')
{
  echo "<td>" . $row['Matter'] . "</td>";
}
if($var18 == '1')
{
  echo "<td>" . $row['actionstartdate'] . "</td>";
}
if($var19 == '1')
{
  echo "<td>" . $row['actionstarttime'] . "</td>";
}
if($var20 == '1')
{
  echo "<td>" . $row['duration'] . "</td>";
}
if($var21 == '1')
{
  echo "<td>" . $row['status'] . "</td>";
}
if($var22 == '1')
{
  echo "<td>" . $row['username'] . "</td>";
}
if($var23 == '1')
{
  echo "<td>" . $row['Notes'] . "</td>";
}
if($row['actiontypeid'] ==  '2')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#C11B17'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
if($row['actiontypeid'] ==  '3')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#347235'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
if($row['actiontypeid'] ==  '1')
  {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\">".number_format($row['Cost'], 2, '.', '')."&#8364;</a></td>";
  }
if($row['actiontypeid'] ==  '4')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#2554C7'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
  echo "<td><a href='deletebill1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Bill</a></td>";
  echo "</tr>";
}
  echo "<tr>";
  echo "<td><font color='#990000' size='3'>Total Sum</font></td>";
if($var15 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var16 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var17 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var18 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var19 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var20 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var21 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var22 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var23 == '1')
{
  echo "<td>&nbsp;</td>";
}
  echo "<td><font color='#990000' size='3'>".number_format($sum_total[0], 2, '.', '')."&#8364;</font></td>";
  echo "<td>&nbsp;</td>";
  echo "</tr>";
echo "</table>";

}
}
//Option 5
else
if($var2 != "")
{
if($var3 == "" && $var10 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name,
case when ca.personid is not null then p.descr
when cp.personid is not null then group_concat(p1.descr separator '<br />')
end as Person,
case when
ca.caseid is null then 'Matter no exist'
else c.descr
end as Matter,
case when ca.actiontypeid = 2 then 'Expense'
when ca.actiontypeid = 3 then 'Income'
when ca.actiontypeid = 4 then (select of.descr from case2action c2a left join officeexptype of on of.id = c2a.officeexptypeid where c2a.id = ca.id)
else pt.descr
end as Type,
ca.actiontypeid as actiontypeid,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, date_format(ca.duration,'%H:%i') as duration, st.descr as status, ca.notes as Notes, ca.cost as Cost
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join cases c on ca.caseid=c.id
left join person p on p.id = ca.personid
left join person p1 on cp.personid = p1.id
left join proceduretypes pt on pt.id = ca.proceduretypeid
left join users u on u.id = ca.userid
left join status st on st.id = ca.statusid
where ca.isdeleted = 0 and (ca.actionstartdate between $datefrom and $dateto) and (ca.descr like \"%$var1%\" or u.full_name like \"%$var1%\" or ca.notes like \"%$var1%\") and (ca.personid = $var2 or cp.personid = $var2) $var13 $var28
group by ca.id
order by $var11")
or die("SELECT Error: ".mysql_error());

$num_rows = mysql_num_rows($result);

$total = mysql_query( "SELECT sum(CASE WHEN ca.actiontypeid = 3 THEN (ca.cost)*-1 ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 1 THEN (ca.cost) ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 2 THEN (ca.cost) ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 4 THEN (ca.cost) ELSE 0 END) AS total
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and (ca.actionstartdate between $datefrom and $dateto) and (ca.descr like \"%$var1%\" or u.full_name like \"%$var1%\" or ca.notes like \"%$var1%\") and (ca.personid = $var2 or cp.personid = $var2) $var13 $var28")
or die("SELECT Error: ".mysql_error());

$sum_total = mysql_fetch_row($total);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Task Description</th>";
if($var15 == '1')
{
echo"<th>Task Type</th>";
}
if($var16 == '1')
{
echo"<th>Associated Person</th>";
}
if($var17 == '1')
{
echo"<th>Matter</th>";
}
if($var18 == '1')
{
echo"<th>Date</th>";
}
if($var19 == '1')
{
echo"<th>Time</th>";
}
if($var20 == '1')
{
echo"<th>Duration</th>";
}
if($var21 == '1')
{
echo"<th>Status</th>";
}
if($var22 == '1')
{
echo"<th>User</th>";
}
if($var23 == '1')
{
echo"<th>Notes</th>";
}
echo"<th>Cost</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
if($row['actiontypeid'] ==  '2')
  {
echo "<td><a href='updateexpense1.php?tid=" . $row['Code'] . "'><font color='#C11B17'>".$row['Name']."</font></a></td>";
  }
if($row['actiontypeid'] ==  '3')
  {
  echo "<td><a href='updateincome1.php?tid=" . $row['Code'] . "'><font color='#347235'>".$row['Name']."</font></a></td>";
  }
if($row['actiontypeid'] == '1')
  {
 echo "<td><a href='updatetask3.php?tid=" . $row['Code'] . "'>".$row['Name']."</a></td>";
  }
if($row['actiontypeid'] == '4')
  {
 echo "<td><a href='updateofficeexpense1.php?tid=" . $row['Code'] . "'><font color='#2554C7'>".$row['Name']."</font></a></td>";
  }
if($var15 == '1')
{
  echo "<td>". $row['Type'] ."</td>";
}
if($var16 == '1')
{
  echo "<td>". $row['Person'] ."</td>";
}
if($var17 == '1')
{
  echo "<td>" . $row['Matter'] . "</td>";
}
if($var18 == '1')
{
  echo "<td>" . $row['actionstartdate'] . "</td>";
}
if($var19 == '1')
{
  echo "<td>" . $row['actionstarttime'] . "</td>";
}
if($var20 == '1')
{
  echo "<td>" . $row['duration'] . "</td>";
}
if($var21 == '1')
{
  echo "<td>" . $row['status'] . "</td>";
}
if($var22 == '1')
{
  echo "<td>" . $row['username'] . "</td>";
}
if($var23 == '1')
{
  echo "<td>" . $row['Notes'] . "</td>";
}
if($row['actiontypeid'] ==  '2')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#C11B17'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
if($row['actiontypeid'] ==  '3')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#347235'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
if($row['actiontypeid'] ==  '1')
  {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\">".number_format($row['Cost'], 2, '.', '')."&#8364;</a></td>";
  }
if($row['actiontypeid'] ==  '4')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#2554C7'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
  echo "<td><a href='deletebill1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Bill</a></td>";
  echo "</tr>";
}
  echo "<tr>";
  echo "<td><font color='#990000' size='3'>Total Sum</font></td>";
if($var15 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var16 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var17 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var18 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var19 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var20 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var21 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var22 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var23 == '1')
{
  echo "<td>&nbsp;</td>";
}
  echo "<td><font color='#990000' size='3'>".number_format($sum_total[0], 2, '.', '')."&#8364;</font></td>";
  echo "<td>&nbsp;</td>";
  echo "</tr>";
echo "</table>";

}
else
//Option 6
if($var3 != "" && $var10 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name,
case when ca.personid is not null then p.descr
when cp.personid is not null then group_concat(p1.descr separator '<br />')
end as Person,
case when
ca.caseid is null then 'Matter no exist'
else c.descr
end as Matter,
case when ca.actiontypeid = 2 then 'Expense'
when ca.actiontypeid = 3 then 'Income'
when ca.actiontypeid = 4 then (select of.descr from case2action c2a left join officeexptype of on of.id = c2a.officeexptypeid where c2a.id = ca.id)
else pt.descr
end as Type,
ca.actiontypeid as actiontypeid,
ca.caseid as cid, date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, date_format(ca.duration,'%H:%i') as duration, st.descr as status, ca.notes as Notes, ca.cost as Cost
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join cases c on ca.caseid=c.id
left join person p on p.id = ca.personid
left join person p1 on cp.personid = p1.id
left join proceduretypes pt on pt.id = ca.proceduretypeid
left join users u on u.id = ca.userid
left join status st on st.id = ca.statusid
where ca.isdeleted = 0 and (ca.actionstartdate between $datefrom and $dateto) and (ca.descr like \"%$var1%\" or u.full_name like \"%$var1%\" or ca.notes like \"%$var1%\") and (ca.personid = $var2 or cp.personid = $var2) and ca.caseid=$var3 $var13 $var28
group by ca.id
order by $var11")
or die("SELECT Error: ".mysql_error());

$num_rows = mysql_num_rows($result);

$total = mysql_query( "SELECT sum(CASE WHEN ca.actiontypeid = 3 THEN (ca.cost)*-1 ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 1 THEN (ca.cost) ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 2 THEN (ca.cost) ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 4 THEN (ca.cost) ELSE 0 END) AS total
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and (ca.actionstartdate between $datefrom and $dateto) and (ca.descr like \"%$var1%\" or u.full_name like \"%$var1%\" or ca.notes like \"%$var1%\") and (ca.personid = $var2 or cp.personid = $var2) and ca.caseid=$var3 $var13 $var28")
or die("SELECT Error: ".mysql_error());

$sum_total = mysql_fetch_row($total);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Task Description</th>";
if($var15 == '1')
{
echo"<th>Task Type</th>";
}
if($var16 == '1')
{
echo"<th>Associated Person</th>";
}
if($var17 == '1')
{
echo"<th>Matter</th>";
}
if($var18 == '1')
{
echo"<th>Date</th>";
}
if($var19 == '1')
{
echo"<th>Time</th>";
}
if($var20 == '1')
{
echo"<th>Duration</th>";
}
if($var21 == '1')
{
echo"<th>Status</th>";
}
if($var22 == '1')
{
echo"<th>User</th>";
}
if($var23 == '1')
{
echo"<th>Notes</th>";
}
echo"<th>Cost</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
if($row['actiontypeid'] ==  '2')
  {
echo "<td><a href='updateexpense1.php?tid=" . $row['Code'] . "'><font color='#C11B17'>".$row['Name']."</font></a></td>";
  }
if($row['actiontypeid'] ==  '3')
  {
  echo "<td><a href='updateincome1.php?tid=" . $row['Code'] . "'><font color='#347235'>".$row['Name']."</font></a></td>";
  }
if($row['actiontypeid'] == '1')
  {
 echo "<td><a href='updatetask3.php?tid=" . $row['Code'] . "'>".$row['Name']."</a></td>";
  }
if($row['actiontypeid'] == '4')
  {
 echo "<td><a href='updateofficeexpense1.php?tid=" . $row['Code'] . "'><font color='#2554C7'>".$row['Name']."</font></a></td>";
  }
if($var15 == '1')
{
  echo "<td>". $row['Type'] ."</td>";
}
if($var16 == '1')
{
  echo "<td>". $row['Person'] ."</td>";
}
if($var17 == '1')
{
  echo "<td>" . $row['Matter'] . "</td>";
}
if($var18 == '1')
{
  echo "<td>" . $row['actionstartdate'] . "</td>";
}
if($var19 == '1')
{
  echo "<td>" . $row['actionstarttime'] . "</td>";
}
if($var20 == '1')
{
  echo "<td>" . $row['duration'] . "</td>";
}
if($var21 == '1')
{
  echo "<td>" . $row['status'] . "</td>";
}
if($var22 == '1')
{
  echo "<td>" . $row['username'] . "</td>";
}
if($var23 == '1')
{
  echo "<td>" . $row['Notes'] . "</td>";
}
if($row['actiontypeid'] ==  '2')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#C11B17'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
if($row['actiontypeid'] ==  '3')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#347235'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
if($row['actiontypeid'] ==  '1')
  {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\">".number_format($row['Cost'], 2, '.', '')."&#8364;</a></td>";
  }
if($row['actiontypeid'] ==  '4')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#2554C7'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
  echo "<td><a href='deletebill1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Bill</a></td>";
  echo "</tr>";
}
  echo "<tr>";
  echo "<td><font color='#990000' size='3'>Total Sum</font></td>";
if($var15 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var16 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var17 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var18 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var19 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var20 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var21 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var22 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var23 == '1')
{
  echo "<td>&nbsp;</td>";
}
  echo "<td><font color='#990000' size='3'>".number_format($sum_total[0], 2, '.', '')."&#8364;</font></td>";
  echo "<td>&nbsp;</td>";
  echo "</tr>";
echo "</table>";

}
// Option 7
else
if($var3 == "" && $var10 != "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, ca.proceduretypeid as prid,
case when ca.personid is not null then p.descr
when cp.personid is not null then group_concat(p1.descr separator '<br />')
end as Person,
case when
ca.caseid is null then 'Matter no exist'
else c.descr
end as Matter,
case when ca.actiontypeid = 2 then 'Expense'
when ca.actiontypeid = 3 then 'Income'
when ca.actiontypeid = 4 then (select of.descr from case2action c2a left join officeexptype of on of.id = c2a.officeexptypeid where c2a.id = ca.id)
else pt.descr
end as Type,
ca.actiontypeid as actiontypeid,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, date_format(ca.duration,'%H:%i') as duration, st.descr as status, ca.notes as Notes, ca.cost as Cost
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join cases c on ca.caseid=c.id
left join person p on p.id = ca.personid
left join person p1 on cp.personid = p1.id
left join proceduretypes pt on pt.id = ca.proceduretypeid
left join users u on u.id = ca.userid
left join status st on st.id = ca.statusid
where ca.isdeleted = 0 and (ca.actionstartdate between $datefrom and $dateto) and (ca.descr like \"%$var1%\" or u.full_name like \"%$var1%\" or ca.notes like \"%$var1%\") and (ca.personid = $var2 or cp.personid = $var2) and ca.proceduretypeid=$var10 $var13 $var28
group by ca.id
order by $var11")
or die("SELECT Error: ".mysql_error());

$num_rows = mysql_num_rows($result);

$total = mysql_query( "SELECT sum(CASE WHEN ca.actiontypeid = 3 THEN (ca.cost)*-1 ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 1 THEN (ca.cost) ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 2 THEN (ca.cost) ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 4 THEN (ca.cost) ELSE 0 END) AS total
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and (ca.actionstartdate between $datefrom and $dateto) and (ca.descr like \"%$var1%\" or u.full_name like \"%$var1%\" or ca.notes like \"%$var1%\") and (ca.personid = $var2 or cp.personid = $var2) and ca.proceduretypeid=$var10 $var13 $var28")
or die("SELECT Error: ".mysql_error());

$sum_total = mysql_fetch_row($total);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Task Description</th>";
if($var15 == '1')
{
echo"<th>Task Type</th>";
}
if($var16 == '1')
{
echo"<th>Associated Person</th>";
}
if($var17 == '1')
{
echo"<th>Matter</th>";
}
if($var18 == '1')
{
echo"<th>Date</th>";
}
if($var19 == '1')
{
echo"<th>Time</th>";
}
if($var20 == '1')
{
echo"<th>Duration</th>";
}
if($var21 == '1')
{
echo"<th>Status</th>";
}
if($var22 == '1')
{
echo"<th>User</th>";
}
if($var23 == '1')
{
echo"<th>Notes</th>";
}
echo"<th>Cost</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
if($row['actiontypeid'] ==  '2')
  {
echo "<td><a href='updateexpense1.php?tid=" . $row['Code'] . "'><font color='#C11B17'>".$row['Name']."</font></a></td>";
  }
if($row['actiontypeid'] ==  '3')
  {
  echo "<td><a href='updateincome1.php?tid=" . $row['Code'] . "'><font color='#347235'>".$row['Name']."</font></a></td>";
  }
if($row['actiontypeid'] == '1')
  {
 echo "<td><a href='updatetask3.php?tid=" . $row['Code'] . "'>".$row['Name']."</a></td>";
  }
if($row['actiontypeid'] == '4')
  {
 echo "<td><a href='updateofficeexpense1.php?tid=" . $row['Code'] . "'><font color='#2554C7'>".$row['Name']."</font></a></td>";
  }
if($var15 == '1')
{
  echo "<td>". $row['Type'] ."</td>";
}
if($var16 == '1')
{
  echo "<td>". $row['Person'] ."</td>";
}
if($var17 == '1')
{
  echo "<td>" . $row['Matter'] . "</td>";
}
if($var18 == '1')
{
  echo "<td>" . $row['actionstartdate'] . "</td>";
}
if($var19 == '1')
{
  echo "<td>" . $row['actionstarttime'] . "</td>";
}
if($var20 == '1')
{
  echo "<td>" . $row['duration'] . "</td>";
}
if($var21 == '1')
{
  echo "<td>" . $row['status'] . "</td>";
}
if($var22 == '1')
{
  echo "<td>" . $row['username'] . "</td>";
}
if($var23 == '1')
{
  echo "<td>" . $row['Notes'] . "</td>";
}
if($row['actiontypeid'] ==  '2')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#C11B17'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
if($row['actiontypeid'] ==  '3')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#347235'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
if($row['actiontypeid'] ==  '1')
  {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\">".number_format($row['Cost'], 2, '.', '')."&#8364;</a></td>";
  }
if($row['actiontypeid'] ==  '4')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#2554C7'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
  echo "<td><a href='deletebill1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Bill</a></td>";
  echo "</tr>";
}
  echo "<tr>";
  echo "<td><font color='#990000' size='3'>Total Sum</font></td>";
if($var15 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var16 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var17 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var18 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var19 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var20 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var21 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var22 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var23 == '1')
{
  echo "<td>&nbsp;</td>";
}
  echo "<td><font color='#990000' size='3'>".number_format($sum_total[0], 2, '.', '')."&#8364;</font></td>";
  echo "<td>&nbsp;</td>";
  echo "</tr>";
echo "</table>";

}
// Option 8
else
if($var3 != "" && $var10 != "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, ca.proceduretypeid as prid,
case when ca.personid is not null then p.descr
when cp.personid is not null then group_concat(p1.descr separator '<br />')
end as Person,
case when
ca.caseid is null then 'Matter no exist'
else c.descr
end as Matter,
case when ca.actiontypeid = 2 then 'Expense'
when ca.actiontypeid = 3 then 'Income'
when ca.actiontypeid = 4 then (select of.descr from case2action c2a left join officeexptype of on of.id = c2a.officeexptypeid where c2a.id = ca.id)
else pt.descr
end as Type,
ca.actiontypeid as actiontypeid,
ca.caseid as cid, date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, date_format(ca.duration,'%H:%i') as duration, st.descr as status, ca.notes as Notes, ca.cost as Cost
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join cases c on ca.caseid=c.id
left join person p on p.id = ca.personid
left join person p1 on cp.personid = p1.id
left join proceduretypes pt on pt.id = ca.proceduretypeid
left join users u on u.id = ca.userid
left join status st on st.id = ca.statusid
where ca.isdeleted = 0 and (ca.actionstartdate between $datefrom and $dateto) and (ca.descr like \"%$var1%\" or u.full_name like \"%$var1%\" or ca.notes like \"%$var1%\") and (ca.personid = $var2 or cp.personid = $var2) and ca.caseid=$var3 and ca.proceduretypeid=$var10 $var13 $var28
group by ca.id
order by $var11")
or die("SELECT Error: ".mysql_error());

$num_rows = mysql_num_rows($result);

$total = mysql_query( "SELECT sum(CASE WHEN ca.actiontypeid = 3 THEN (ca.cost)*-1 ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 1 THEN (ca.cost) ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 2 THEN (ca.cost) ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 4 THEN (ca.cost) ELSE 0 END) AS total
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and (ca.actionstartdate between $datefrom and $dateto) and (ca.descr like \"%$var1%\" or u.full_name like \"%$var1%\" or ca.notes like \"%$var1%\") and (ca.personid = $var2 or cp.personid = $var2) and ca.caseid=$var3 and ca.proceduretypeid=$var10 $var13 $var28")
or die("SELECT Error: ".mysql_error());

$sum_total = mysql_fetch_row($total);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Task Description</th>";
if($var15 == '1')
{
echo"<th>Task Type</th>";
}
if($var16 == '1')
{
echo"<th>Associated Person</th>";
}
if($var17 == '1')
{
echo"<th>Matter</th>";
}
if($var18 == '1')
{
echo"<th>Date</th>";
}
if($var19 == '1')
{
echo"<th>Time</th>";
}
if($var20 == '1')
{
echo"<th>Duration</th>";
}
if($var21 == '1')
{
echo"<th>Status</th>";
}
if($var22 == '1')
{
echo"<th>User</th>";
}
if($var23 == '1')
{
echo"<th>Notes</th>";
}
echo"<th>Cost</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
if($row['actiontypeid'] ==  '2')
  {
echo "<td><a href='updateexpense1.php?tid=" . $row['Code'] . "'><font color='#C11B17'>".$row['Name']."</font></a></td>";
  }
if($row['actiontypeid'] ==  '3')
  {
  echo "<td><a href='updateincome1.php?tid=" . $row['Code'] . "'><font color='#347235'>".$row['Name']."</font></a></td>";
  }
if($row['actiontypeid'] == '1')
  {
 echo "<td><a href='updatetask3.php?tid=" . $row['Code'] . "'>".$row['Name']."</a></td>";
  }
if($row['actiontypeid'] == '4')
  {
 echo "<td><a href='updateofficeexpense1.php?tid=" . $row['Code'] . "'><font color='#2554C7'>".$row['Name']."</font></a></td>";
  }
if($var15 == '1')
{
  echo "<td>". $row['Type'] ."</td>";
}
if($var16 == '1')
{
  echo "<td>". $row['Person'] ."</td>";
}
if($var17 == '1')
{
  echo "<td>" . $row['Matter'] . "</td>";
}
if($var18 == '1')
{
  echo "<td>" . $row['actionstartdate'] . "</td>";
}
if($var19 == '1')
{
  echo "<td>" . $row['actionstarttime'] . "</td>";
}
if($var20 == '1')
{
  echo "<td>" . $row['duration'] . "</td>";
}
if($var21 == '1')
{
  echo "<td>" . $row['status'] . "</td>";
}
if($var22 == '1')
{
  echo "<td>" . $row['username'] . "</td>";
}
if($var23 == '1')
{
  echo "<td>" . $row['Notes'] . "</td>";
}
if($row['actiontypeid'] ==  '2')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#C11B17'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
if($row['actiontypeid'] ==  '3')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#347235'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
if($row['actiontypeid'] ==  '1')
  {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\">".number_format($row['Cost'], 2, '.', '')."&#8364;</a></td>";
  }
if($row['actiontypeid'] ==  '4')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#2554C7'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
  echo "<td><a href='deletebill1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Bill</a></td>";
  echo "</tr>";
}
  echo "<tr>";
  echo "<td><font color='#990000' size='3'>Total Sum</font></td>";
if($var15 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var16 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var17 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var18 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var19 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var20 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var21 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var22 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var23 == '1')
{
  echo "<td>&nbsp;</td>";
}
  echo "<td><font color='#990000' size='3'>".number_format($sum_total[0], 2, '.', '')."&#8364;</font></td>";
  echo "<td>&nbsp;</td>";
  echo "</tr>";
echo "</table>";

}
}
}
//Option 9 billname null default
else
if($var1 == "")
{
if($var2 == "")
{
if($var3 == "" && $var10 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name,
case when ca.personid is not null then p.descr
when cp.personid is not null then group_concat(p1.descr separator '<br />')
end as Person,
case when
ca.caseid is null then 'Matter no exist'
else c.descr
end as Matter,
case when ca.actiontypeid = 2 then 'Expense'
when ca.actiontypeid = 3 then 'Income'
when ca.actiontypeid = 4 then (select of.descr from case2action c2a left join officeexptype of on of.id = c2a.officeexptypeid where c2a.id = ca.id)
else pt.descr
end as Type,
ca.actiontypeid as actiontypeid,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, date_format(ca.duration,'%H:%i') as duration, st.descr as status, ca.notes as Notes, ca.cost as Cost
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join cases c on ca.caseid=c.id
left join person p on p.id = ca.personid
left join person p1 on cp.personid = p1.id
left join proceduretypes pt on pt.id = ca.proceduretypeid
left join users u on u.id = ca.userid
left join status st on st.id = ca.statusid
where ca.isdeleted = 0 and (ca.actionstartdate between $datefrom and $dateto) $var13 $var28
group by ca.id
order by $var11")
or die("SELECT Error: ".mysql_error());

$num_rows = mysql_num_rows($result);

$total = mysql_query( "SELECT sum(CASE WHEN ca.actiontypeid = 3 THEN (ca.cost)*-1 ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 1 THEN (ca.cost) ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 2 THEN (ca.cost) ELSE 0 END) 
+ sum(CASE WHEN ca.actiontypeid = 4 THEN (ca.cost) ELSE 0 END) AS total
FROM case2action ca
where ca.isdeleted = 0 and (ca.actionstartdate between $datefrom and $dateto) $var13 $var28")
or die("SELECT Error: ".mysql_error());

$sum_total = mysql_fetch_row($total);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Task Description</th>";
if($var15 == '1')
{
echo"<th>Task Type</th>";
}
if($var16 == '1')
{
echo"<th>Associated Person</th>";
}
if($var17 == '1')
{
echo"<th>Matter</th>";
}
if($var18 == '1')
{
echo"<th>Date</th>";
}
if($var19 == '1')
{
echo"<th>Time</th>";
}
if($var20 == '1')
{
echo"<th>Duration</th>";
}
if($var21 == '1')
{
echo"<th>Status</th>";
}
if($var22 == '1')
{
echo"<th>User</th>";
}
if($var23 == '1')
{
echo"<th>Notes</th>";
}
echo"<th>Cost</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
if($row['actiontypeid'] ==  '2')
  {
echo "<td><a href='updateexpense1.php?tid=" . $row['Code'] . "'><font color='#C11B17'>".$row['Name']."</font></a></td>";
  }
if($row['actiontypeid'] ==  '3')
  {
  echo "<td><a href='updateincome1.php?tid=" . $row['Code'] . "'><font color='#347235'>".$row['Name']."</font></a></td>";
  }
if($row['actiontypeid'] == '1')
  {
 echo "<td><a href='updatetask3.php?tid=" . $row['Code'] . "'>".$row['Name']."</a></td>";
  }
if($row['actiontypeid'] == '4')
  {
 echo "<td><a href='updateofficeexpense1.php?tid=" . $row['Code'] . "'><font color='#2554C7'>".$row['Name']."</font></a></td>";
  }
if($var15 == '1')
{
  echo "<td>". $row['Type'] ."</td>";
}
if($var16 == '1')
{
  echo "<td>". $row['Person'] ."</td>";
}
if($var17 == '1')
{
  echo "<td>" . $row['Matter'] . "</td>";
}
if($var18 == '1')
{
  echo "<td>" . $row['actionstartdate'] . "</td>";
}
if($var19 == '1')
{
  echo "<td>" . $row['actionstarttime'] . "</td>";
}
if($var20 == '1')
{
  echo "<td>" . $row['duration'] . "</td>";
}
if($var21 == '1')
{
  echo "<td>" . $row['status'] . "</td>";
}
if($var22 == '1')
{
  echo "<td>" . $row['username'] . "</td>";
}
if($var23 == '1')
{
  echo "<td>" . $row['Notes'] . "</td>";
}
if($row['actiontypeid'] ==  '2')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#C11B17'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
if($row['actiontypeid'] ==  '3')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#347235'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
if($row['actiontypeid'] ==  '1')
  {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\">".number_format($row['Cost'], 2, '.', '')."&#8364;</a></td>";
  }
if($row['actiontypeid'] ==  '4')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#2554C7'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
  echo "<td><a href='deletebill1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Bill</a></td>";
  echo "</tr>";
}
  echo "<tr>";
  echo "<td><font color='#990000' size='3'>Total Sum</font></td>";
if($var15 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var16 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var17 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var18 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var19 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var20 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var21 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var22 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var23 == '1')
{
  echo "<td>&nbsp;</td>";
}
  echo "<td><font color='#990000' size='3'>".number_format($sum_total[0], 2, '.', '')."&#8364;</font></td>";
  echo "<td>&nbsp;</td>";
  echo "</tr>";
echo "</table>";

}
else
//Option 10
if($var3 != "" && $var10 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name,
case when ca.personid is not null then p.descr
when cp.personid is not null then group_concat(p1.descr separator '<br />')
end as Person,
case when
ca.caseid is null then 'Matter no exist'
else c.descr
end as Matter,
case when ca.actiontypeid = 2 then 'Expense'
when ca.actiontypeid = 3 then 'Income'
when ca.actiontypeid = 4 then (select of.descr from case2action c2a left join officeexptype of on of.id = c2a.officeexptypeid where c2a.id = ca.id)
else pt.descr
end as Type,
ca.actiontypeid as actiontypeid,
ca.caseid as cid, date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, date_format(ca.duration,'%H:%i') as duration, st.descr as status, ca.notes as Notes, ca.cost as Cost
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join cases c on ca.caseid=c.id
left join person p on p.id = ca.personid
left join person p1 on cp.personid = p1.id
left join proceduretypes pt on pt.id = ca.proceduretypeid
left join users u on u.id = ca.userid
left join status st on st.id = ca.statusid
where ca.isdeleted = 0 and (ca.actionstartdate between $datefrom and $dateto) and  ca.caseid=$var3 $var13 $var28
group by ca.id
order by $var11")
or die("SELECT Error: ".mysql_error());

$num_rows = mysql_num_rows($result);

$total = mysql_query( "SELECT sum(CASE WHEN ca.actiontypeid = 3 THEN (ca.cost)*-1 ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 1 THEN (ca.cost) ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 2 THEN (ca.cost) ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 4 THEN (ca.cost) ELSE 0 END) AS total
FROM case2action ca
where ca.isdeleted = 0 and (ca.actionstartdate between $datefrom and $dateto) and  ca.caseid=$var3 $var13 $var28")
or die("SELECT Error: ".mysql_error());

$sum_total = mysql_fetch_row($total);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Task Description</th>";
if($var15 == '1')
{
echo"<th>Task Type</th>";
}
if($var16 == '1')
{
echo"<th>Associated Person</th>";
}
if($var17 == '1')
{
echo"<th>Matter</th>";
}
if($var18 == '1')
{
echo"<th>Date</th>";
}
if($var19 == '1')
{
echo"<th>Time</th>";
}
if($var20 == '1')
{
echo"<th>Duration</th>";
}
if($var21 == '1')
{
echo"<th>Status</th>";
}
if($var22 == '1')
{
echo"<th>User</th>";
}
if($var23 == '1')
{
echo"<th>Notes</th>";
}
echo"<th>Cost</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
if($row['actiontypeid'] ==  '2')
  {
echo "<td><a href='updateexpense1.php?tid=" . $row['Code'] . "'><font color='#C11B17'>".$row['Name']."</font></a></td>";
  }
if($row['actiontypeid'] ==  '3')
  {
  echo "<td><a href='updateincome1.php?tid=" . $row['Code'] . "'><font color='#347235'>".$row['Name']."</font></a></td>";
  }
if($row['actiontypeid'] == '1')
  {
 echo "<td><a href='updatetask3.php?tid=" . $row['Code'] . "'>".$row['Name']."</a></td>";
  }
if($row['actiontypeid'] == '4')
  {
 echo "<td><a href='updateofficeexpense1.php?tid=" . $row['Code'] . "'><font color='#2554C7'>".$row['Name']."</font></a></td>";
  }
if($var15 == '1')
{
  echo "<td>". $row['Type'] ."</td>";
}
if($var16 == '1')
{
  echo "<td>". $row['Person'] ."</td>";
}
if($var17 == '1')
{
  echo "<td>" . $row['Matter'] . "</td>";
}
if($var18 == '1')
{
  echo "<td>" . $row['actionstartdate'] . "</td>";
}
if($var19 == '1')
{
  echo "<td>" . $row['actionstarttime'] . "</td>";
}
if($var20 == '1')
{
  echo "<td>" . $row['duration'] . "</td>";
}
if($var21 == '1')
{
  echo "<td>" . $row['status'] . "</td>";
}
if($var22 == '1')
{
  echo "<td>" . $row['username'] . "</td>";
}
if($var23 == '1')
{
  echo "<td>" . $row['Notes'] . "</td>";
}
if($row['actiontypeid'] ==  '2')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#C11B17'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
if($row['actiontypeid'] ==  '3')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#347235'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
if($row['actiontypeid'] ==  '1')
  {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\">".number_format($row['Cost'], 2, '.', '')."&#8364;</a></td>";
  }
if($row['actiontypeid'] ==  '4')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#2554C7'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
  echo "<td><a href='deletebill1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Bill</a></td>";
  echo "</tr>";
}
  echo "<tr>";
  echo "<td><font color='#990000' size='3'>Total Sum</font></td>";
if($var15 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var16 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var17 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var18 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var19 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var20 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var21 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var22 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var23 == '1')
{
  echo "<td>&nbsp;</td>";
}
  echo "<td><font color='#990000' size='3'>".number_format($sum_total[0], 2, '.', '')."&#8364;</font></td>";
  echo "<td>&nbsp;</td>";
  echo "</tr>";
echo "</table>";

}
// Option 11
else
if($var3 == "" && $var10 != "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, ca.proceduretypeid as prid,
case when ca.personid is not null then p.descr
when cp.personid is not null then group_concat(p1.descr separator '<br />')
end as Person,
case when
ca.caseid is null then 'Matter no exist'
else c.descr
end as Matter,
case when ca.actiontypeid = 2 then 'Expense'
when ca.actiontypeid = 3 then 'Income'
when ca.actiontypeid = 4 then (select of.descr from case2action c2a left join officeexptype of on of.id = c2a.officeexptypeid where c2a.id = ca.id)
else pt.descr
end as Type,
ca.actiontypeid as actiontypeid,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, date_format(ca.duration,'%H:%i') as duration, st.descr as status, ca.notes as Notes, ca.cost as Cost
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join cases c on ca.caseid=c.id
left join person p on p.id = ca.personid
left join person p1 on cp.personid = p1.id
left join proceduretypes pt on pt.id = ca.proceduretypeid
left join users u on u.id = ca.userid
left join status st on st.id = ca.statusid
where ca.isdeleted = 0 and (ca.actionstartdate between $datefrom and $dateto) and ca.proceduretypeid=$var10 $var13 $var28
group by ca.id
order by $var11")
or die("SELECT Error: ".mysql_error());

$num_rows = mysql_num_rows($result);

$total = mysql_query( "SELECT sum(CASE WHEN ca.actiontypeid = 3 THEN (ca.cost)*-1 ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 1 THEN (ca.cost) ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 2 THEN (ca.cost) ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 4 THEN (ca.cost) ELSE 0 END) AS total
FROM case2action ca
where ca.isdeleted = 0 and (ca.actionstartdate between $datefrom and $dateto) and ca.proceduretypeid=$var10 $var13 $var28")
or die("SELECT Error: ".mysql_error());

$sum_total = mysql_fetch_row($total);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Task Description</th>";
if($var15 == '1')
{
echo"<th>Task Type</th>";
}
if($var16 == '1')
{
echo"<th>Associated Person</th>";
}
if($var17 == '1')
{
echo"<th>Matter</th>";
}
if($var18 == '1')
{
echo"<th>Date</th>";
}
if($var19 == '1')
{
echo"<th>Time</th>";
}
if($var20 == '1')
{
echo"<th>Duration</th>";
}
if($var21 == '1')
{
echo"<th>Status</th>";
}
if($var22 == '1')
{
echo"<th>User</th>";
}
if($var23 == '1')
{
echo"<th>Notes</th>";
}
echo"<th>Cost</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
if($row['actiontypeid'] ==  '2')
  {
echo "<td><a href='updateexpense1.php?tid=" . $row['Code'] . "'><font color='#C11B17'>".$row['Name']."</font></a></td>";
  }
if($row['actiontypeid'] ==  '3')
  {
  echo "<td><a href='updateincome1.php?tid=" . $row['Code'] . "'><font color='#347235'>".$row['Name']."</font></a></td>";
  }
if($row['actiontypeid'] == '1')
  {
 echo "<td><a href='updatetask3.php?tid=" . $row['Code'] . "'>".$row['Name']."</a></td>";
  }
if($row['actiontypeid'] == '4')
  {
 echo "<td><a href='updateofficeexpense1.php?tid=" . $row['Code'] . "'><font color='#2554C7'>".$row['Name']."</font></a></td>";
  }
if($var15 == '1')
{
  echo "<td>". $row['Type'] ."</td>";
}
if($var16 == '1')
{
  echo "<td>". $row['Person'] ."</td>";
}
if($var17 == '1')
{
  echo "<td>" . $row['Matter'] . "</td>";
}
if($var18 == '1')
{
  echo "<td>" . $row['actionstartdate'] . "</td>";
}
if($var19 == '1')
{
  echo "<td>" . $row['actionstarttime'] . "</td>";
}
if($var20 == '1')
{
  echo "<td>" . $row['duration'] . "</td>";
}
if($var21 == '1')
{
  echo "<td>" . $row['status'] . "</td>";
}
if($var22 == '1')
{
  echo "<td>" . $row['username'] . "</td>";
}
if($var23 == '1')
{
  echo "<td>" . $row['Notes'] . "</td>";
}
if($row['actiontypeid'] ==  '2')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#C11B17'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
if($row['actiontypeid'] ==  '3')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#347235'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
if($row['actiontypeid'] ==  '1')
  {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\">".number_format($row['Cost'], 2, '.', '')."&#8364;</a></td>";
  }
if($row['actiontypeid'] ==  '4')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#2554C7'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
  echo "<td><a href='deletebill1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Bill</a></td>";
  echo "</tr>";
}
  echo "<tr>";
  echo "<td><font color='#990000' size='3'>Total Sum</font></td>";
if($var15 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var16 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var17 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var18 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var19 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var20 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var21 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var22 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var23 == '1')
{
  echo "<td>&nbsp;</td>";
}
  echo "<td><font color='#990000' size='3'>".number_format($sum_total[0], 2, '.', '')."&#8364;</font></td>";
  echo "<td>&nbsp;</td>";
  echo "</tr>";
echo "</table>";

}
// Option 12
else
if($var3 != "" && $var10 != "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, ca.proceduretypeid as prid,
case when ca.personid is not null then p.descr
when cp.personid is not null then group_concat(p1.descr separator '<br />')
end as Person,
case when
ca.caseid is null then 'Matter no exist'
else c.descr
end as Matter,
case when ca.actiontypeid = 2 then 'Expense'
when ca.actiontypeid = 3 then 'Income'
when ca.actiontypeid = 4 then (select of.descr from case2action c2a left join officeexptype of on of.id = c2a.officeexptypeid where c2a.id = ca.id)
else pt.descr
end as Type,
ca.actiontypeid as actiontypeid,
ca.caseid as cid, date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, date_format(ca.duration,'%H:%i') as duration, st.descr as status, ca.notes as Notes, ca.cost as Cost
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join cases c on ca.caseid=c.id
left join person p on p.id = ca.personid
left join person p1 on cp.personid = p1.id
left join proceduretypes pt on pt.id = ca.proceduretypeid
left join users u on u.id = ca.userid
left join status st on st.id = ca.statusid
where ca.isdeleted = 0 and (ca.actionstartdate between $datefrom and $dateto) and ca.caseid=$var3 and ca.proceduretypeid=$var10 $var13 $var28
group by ca.id
order by $var11")
or die("SELECT Error: ".mysql_error());

$num_rows = mysql_num_rows($result);

$total = mysql_query( "SELECT sum(CASE WHEN ca.actiontypeid = 3 THEN (ca.cost)*-1 ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 1 THEN (ca.cost) ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 2 THEN (ca.cost) ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 4 THEN (ca.cost) ELSE 0 END) AS total
FROM case2action ca
where ca.isdeleted = 0 and (ca.actionstartdate between $datefrom and $dateto) and ca.caseid=$var3 and ca.proceduretypeid=$var10 $var13 $var28")
or die("SELECT Error: ".mysql_error());

$sum_total = mysql_fetch_row($total);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Task Description</th>";
if($var15 == '1')
{
echo"<th>Task Type</th>";
}
if($var16 == '1')
{
echo"<th>Associated Person</th>";
}
if($var17 == '1')
{
echo"<th>Matter</th>";
}
if($var18 == '1')
{
echo"<th>Date</th>";
}
if($var19 == '1')
{
echo"<th>Time</th>";
}
if($var20 == '1')
{
echo"<th>Duration</th>";
}
if($var21 == '1')
{
echo"<th>Status</th>";
}
if($var22 == '1')
{
echo"<th>User</th>";
}
if($var23 == '1')
{
echo"<th>Notes</th>";
}
echo"<th>Cost</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
if($row['actiontypeid'] ==  '2')
  {
echo "<td><a href='updateexpense1.php?tid=" . $row['Code'] . "'><font color='#C11B17'>".$row['Name']."</font></a></td>";
  }
if($row['actiontypeid'] ==  '3')
  {
  echo "<td><a href='updateincome1.php?tid=" . $row['Code'] . "'><font color='#347235'>".$row['Name']."</font></a></td>";
  }
if($row['actiontypeid'] == '1')
  {
 echo "<td><a href='updatetask3.php?tid=" . $row['Code'] . "'>".$row['Name']."</a></td>";
  }
if($row['actiontypeid'] == '4')
  {
 echo "<td><a href='updateofficeexpense1.php?tid=" . $row['Code'] . "'><font color='#2554C7'>".$row['Name']."</font></a></td>";
  }
if($var15 == '1')
{
  echo "<td>". $row['Type'] ."</td>";
}
if($var16 == '1')
{
  echo "<td>". $row['Person'] ."</td>";
}
if($var17 == '1')
{
  echo "<td>" . $row['Matter'] . "</td>";
}
if($var18 == '1')
{
  echo "<td>" . $row['actionstartdate'] . "</td>";
}
if($var19 == '1')
{
  echo "<td>" . $row['actionstarttime'] . "</td>";
}
if($var20 == '1')
{
  echo "<td>" . $row['duration'] . "</td>";
}
if($var21 == '1')
{
  echo "<td>" . $row['status'] . "</td>";
}
if($var22 == '1')
{
  echo "<td>" . $row['username'] . "</td>";
}
if($var23 == '1')
{
  echo "<td>" . $row['Notes'] . "</td>";
}
if($row['actiontypeid'] ==  '2')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#C11B17'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
if($row['actiontypeid'] ==  '3')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#347235'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
if($row['actiontypeid'] ==  '1')
  {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\">".number_format($row['Cost'], 2, '.', '')."&#8364;</a></td>";
  }
if($row['actiontypeid'] ==  '4')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#2554C7'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
  echo "<td><a href='deletebill1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Bill</a></td>";
  echo "</tr>";
}
  echo "<tr>";
  echo "<td><font color='#990000' size='3'>Total Sum</font></td>";
if($var15 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var16 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var17 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var18 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var19 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var20 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var21 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var22 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var23 == '1')
{
  echo "<td>&nbsp;</td>";
}
  echo "<td><font color='#990000' size='3'>".number_format($sum_total[0], 2, '.', '')."&#8364;</font></td>";
  echo "<td>&nbsp;</td>";
  echo "</tr>";
echo "</table>";

}
}
//Option 13
else
if($var2 != "")
{
if($var3 == "" && $var10 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name,
case when ca.personid is not null then p.descr
when cp.personid is not null then group_concat(p1.descr separator '<br />')
end as Person,
case when
ca.caseid is null then 'Matter no exist'
else c.descr
end as Matter,
case when ca.actiontypeid = 2 then 'Expense'
when ca.actiontypeid = 3 then 'Income'
when ca.actiontypeid = 4 then (select of.descr from case2action c2a left join officeexptype of on of.id = c2a.officeexptypeid where c2a.id = ca.id)
else pt.descr
end as Type,
ca.actiontypeid as actiontypeid,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, date_format(ca.duration,'%H:%i') as duration, st.descr as status, ca.notes as Notes, ca.cost as Cost
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join cases c on ca.caseid=c.id
left join person p on p.id = ca.personid
left join person p1 on cp.personid = p1.id
left join proceduretypes pt on pt.id = ca.proceduretypeid
left join users u on u.id = ca.userid
left join status st on st.id = ca.statusid
where ca.isdeleted = 0 and (ca.actionstartdate between $datefrom and $dateto) and (ca.personid = $var2 or cp.personid = $var2) $var13 $var28
group by ca.id
order by $var11")
or die("SELECT Error: ".mysql_error());

$num_rows = mysql_num_rows($result);

$total = mysql_query( "SELECT sum(CASE WHEN ca.actiontypeid = 3 THEN (ca.cost)*-1 ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 1 THEN (ca.cost) ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 2 THEN (ca.cost) ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 4 THEN (ca.cost) ELSE 0 END) AS total
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
where ca.isdeleted = 0 and (ca.actionstartdate between $datefrom and $dateto) and (ca.personid = $var2 or cp.personid = $var2) $var13 $var28")
or die("SELECT Error: ".mysql_error());

$sum_total = mysql_fetch_row($total);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Task Description</th>";
if($var15 == '1')
{
echo"<th>Task Type</th>";
}
if($var16 == '1')
{
echo"<th>Associated Person</th>";
}
if($var17 == '1')
{
echo"<th>Matter</th>";
}
if($var18 == '1')
{
echo"<th>Date</th>";
}
if($var19 == '1')
{
echo"<th>Time</th>";
}
if($var20 == '1')
{
echo"<th>Duration</th>";
}
if($var21 == '1')
{
echo"<th>Status</th>";
}
if($var22 == '1')
{
echo"<th>User</th>";
}
if($var23 == '1')
{
echo"<th>Notes</th>";
}
echo"<th>Cost</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
if($row['actiontypeid'] ==  '2')
  {
echo "<td><a href='updateexpense1.php?tid=" . $row['Code'] . "'><font color='#C11B17'>".$row['Name']."</font></a></td>";
  }
if($row['actiontypeid'] ==  '3')
  {
  echo "<td><a href='updateincome1.php?tid=" . $row['Code'] . "'><font color='#347235'>".$row['Name']."</font></a></td>";
  }
if($row['actiontypeid'] == '1')
  {
 echo "<td><a href='updatetask3.php?tid=" . $row['Code'] . "'>".$row['Name']."</a></td>";
  }
if($row['actiontypeid'] == '4')
  {
 echo "<td><a href='updateofficeexpense1.php?tid=" . $row['Code'] . "'><font color='#2554C7'>".$row['Name']."</font></a></td>";
  }
if($var15 == '1')
{
  echo "<td>". $row['Type'] ."</td>";
}
if($var16 == '1')
{
  echo "<td>". $row['Person'] ."</td>";
}
if($var17 == '1')
{
  echo "<td>" . $row['Matter'] . "</td>";
}
if($var18 == '1')
{
  echo "<td>" . $row['actionstartdate'] . "</td>";
}
if($var19 == '1')
{
  echo "<td>" . $row['actionstarttime'] . "</td>";
}
if($var20 == '1')
{
  echo "<td>" . $row['duration'] . "</td>";
}
if($var21 == '1')
{
  echo "<td>" . $row['status'] . "</td>";
}
if($var22 == '1')
{
  echo "<td>" . $row['username'] . "</td>";
}
if($var23 == '1')
{
  echo "<td>" . $row['Notes'] . "</td>";
}
if($row['actiontypeid'] ==  '2')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#C11B17'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
if($row['actiontypeid'] ==  '3')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#347235'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
if($row['actiontypeid'] ==  '1')
  {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\">".number_format($row['Cost'], 2, '.', '')."&#8364;</a></td>";
  }
if($row['actiontypeid'] ==  '4')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#2554C7'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
  echo "<td><a href='deletebill1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Bill</a></td>";
  echo "</tr>";
}
  echo "<tr>";
  echo "<td><font color='#990000' size='3'>Total Sum</font></td>";
if($var15 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var16 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var17 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var18 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var19 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var20 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var21 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var22 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var23 == '1')
{
  echo "<td>&nbsp;</td>";
}
  echo "<td><font color='#990000' size='3'>".number_format($sum_total[0], 2, '.', '')."&#8364;</font></td>";
  echo "<td>&nbsp;</td>";
  echo "</tr>";
echo "</table>";

}
else
//Option 14
if($var3 != "" && $var10 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name,
case when ca.personid is not null then p.descr
when cp.personid is not null then group_concat(p1.descr separator '<br />')
end as Person,
case when
ca.caseid is null then 'Matter no exist'
else c.descr
end as Matter,
case when ca.actiontypeid = 2 then 'Expense'
when ca.actiontypeid = 3 then 'Income'
when ca.actiontypeid = 4 then (select of.descr from case2action c2a left join officeexptype of on of.id = c2a.officeexptypeid where c2a.id = ca.id)
else pt.descr
end as Type,
ca.actiontypeid as actiontypeid,
ca.caseid as cid, date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, date_format(ca.duration,'%H:%i') as duration, st.descr as status, ca.notes as Notes, ca.cost as Cost
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join cases c on ca.caseid=c.id
left join person p on p.id = ca.personid
left join person p1 on cp.personid = p1.id
left join proceduretypes pt on pt.id = ca.proceduretypeid
left join users u on u.id = ca.userid
left join status st on st.id = ca.statusid
where ca.isdeleted = 0 and (ca.actionstartdate between $datefrom and $dateto) and (ca.personid = $var2 or cp.personid = $var2) and ca.caseid=$var3 $var13 $var28
group by ca.id
order by $var11")
or die("SELECT Error: ".mysql_error());

$num_rows = mysql_num_rows($result);

$total = mysql_query( "SELECT sum(CASE WHEN ca.actiontypeid = 3 THEN (ca.cost)*-1 ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 1 THEN (ca.cost) ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 2 THEN (ca.cost) ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 4 THEN (ca.cost) ELSE 0 END) AS total
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
where ca.isdeleted = 0 and (ca.actionstartdate between $datefrom and $dateto) and (ca.personid = $var2 or cp.personid = $var2) and ca.caseid=$var3 $var13 $var28")
or die("SELECT Error: ".mysql_error());

$sum_total = mysql_fetch_row($total);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Task Description</th>";
if($var15 == '1')
{
echo"<th>Task Type</th>";
}
if($var16 == '1')
{
echo"<th>Associated Person</th>";
}
if($var17 == '1')
{
echo"<th>Matter</th>";
}
if($var18 == '1')
{
echo"<th>Date</th>";
}
if($var19 == '1')
{
echo"<th>Time</th>";
}
if($var20 == '1')
{
echo"<th>Duration</th>";
}
if($var21 == '1')
{
echo"<th>Status</th>";
}
if($var22 == '1')
{
echo"<th>User</th>";
}
if($var23 == '1')
{
echo"<th>Notes</th>";
}
echo"<th>Cost</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
if($row['actiontypeid'] ==  '2')
  {
echo "<td><a href='updateexpense1.php?tid=" . $row['Code'] . "'><font color='#C11B17'>".$row['Name']."</font></a></td>";
  }
if($row['actiontypeid'] ==  '3')
  {
  echo "<td><a href='updateincome1.php?tid=" . $row['Code'] . "'><font color='#347235'>".$row['Name']."</font></a></td>";
  }
if($row['actiontypeid'] == '1')
  {
 echo "<td><a href='updatetask3.php?tid=" . $row['Code'] . "'>".$row['Name']."</a></td>";
  }
if($row['actiontypeid'] == '4')
  {
 echo "<td><a href='updateofficeexpense1.php?tid=" . $row['Code'] . "'><font color='#2554C7'>".$row['Name']."</font></a></td>";
  }
if($var15 == '1')
{
  echo "<td>". $row['Type'] ."</td>";
}
if($var16 == '1')
{
  echo "<td>". $row['Person'] ."</td>";
}
if($var17 == '1')
{
  echo "<td>" . $row['Matter'] . "</td>";
}
if($var18 == '1')
{
  echo "<td>" . $row['actionstartdate'] . "</td>";
}
if($var19 == '1')
{
  echo "<td>" . $row['actionstarttime'] . "</td>";
}
if($var20 == '1')
{
  echo "<td>" . $row['duration'] . "</td>";
}
if($var21 == '1')
{
  echo "<td>" . $row['status'] . "</td>";
}
if($var22 == '1')
{
  echo "<td>" . $row['username'] . "</td>";
}
if($var23 == '1')
{
  echo "<td>" . $row['Notes'] . "</td>";
}
if($row['actiontypeid'] ==  '2')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#C11B17'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
if($row['actiontypeid'] ==  '3')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#347235'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
if($row['actiontypeid'] ==  '1')
  {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\">".number_format($row['Cost'], 2, '.', '')."&#8364;</a></td>";
  }
if($row['actiontypeid'] ==  '4')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#2554C7'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
  echo "<td><a href='deletebill1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Bill</a></td>";
  echo "</tr>";
}
  echo "<tr>";
  echo "<td><font color='#990000' size='3'>Total Sum</font></td>";
if($var15 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var16 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var17 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var18 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var19 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var20 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var21 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var22 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var23 == '1')
{
  echo "<td>&nbsp;</td>";
}
  echo "<td><font color='#990000' size='3'>".number_format($sum_total[0], 2, '.', '')."&#8364;</font></td>";
  echo "<td>&nbsp;</td>";
  echo "</tr>";
echo "</table>";

}
// Option 15
else
if($var3 == "" && $var10 != "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, ca.proceduretypeid as prid,
case when ca.personid is not null then p.descr
when cp.personid is not null then group_concat(p1.descr separator '<br />')
end as Person,
case when
ca.caseid is null then 'Matter no exist'
else c.descr
end as Matter,
case when ca.actiontypeid = 2 then 'Expense'
when ca.actiontypeid = 3 then 'Income'
when ca.actiontypeid = 4 then (select of.descr from case2action c2a left join officeexptype of on of.id = c2a.officeexptypeid where c2a.id = ca.id)
else pt.descr
end as Type,
ca.actiontypeid as actiontypeid,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, date_format(ca.duration,'%H:%i') as duration, st.descr as status, ca.notes as Notes, ca.cost as Cost
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join cases c on ca.caseid=c.id
left join person p on p.id = ca.personid
left join person p1 on cp.personid = p1.id
left join proceduretypes pt on pt.id = ca.proceduretypeid
left join users u on u.id = ca.userid
left join status st on st.id = ca.statusid
where ca.isdeleted = 0 and (ca.actionstartdate between $datefrom and $dateto) and (ca.personid = $var2 or cp.personid = $var2) and ca.proceduretypeid=$var10 $var13 $var28
group by ca.id
order by $var11")
or die("SELECT Error: ".mysql_error());

$num_rows = mysql_num_rows($result);

$total = mysql_query( "SELECT sum(CASE WHEN ca.actiontypeid = 3 THEN (ca.cost)*-1 ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 1 THEN (ca.cost) ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 2 THEN (ca.cost) ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 4 THEN (ca.cost) ELSE 0 END) AS total
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
where ca.isdeleted = 0 and (ca.actionstartdate between $datefrom and $dateto) and (ca.personid = $var2 or cp.personid = $var2) and ca.proceduretypeid=$var10 $var13 $var28")
or die("SELECT Error: ".mysql_error());

$sum_total = mysql_fetch_row($total);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Task Description</th>";
if($var15 == '1')
{
echo"<th>Task Type</th>";
}
if($var16 == '1')
{
echo"<th>Associated Person</th>";
}
if($var17 == '1')
{
echo"<th>Matter</th>";
}
if($var18 == '1')
{
echo"<th>Date</th>";
}
if($var19 == '1')
{
echo"<th>Time</th>";
}
if($var20 == '1')
{
echo"<th>Duration</th>";
}
if($var21 == '1')
{
echo"<th>Status</th>";
}
if($var22 == '1')
{
echo"<th>User</th>";
}
if($var23 == '1')
{
echo"<th>Notes</th>";
}
echo"<th>Cost</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
if($row['actiontypeid'] ==  '2')
  {
echo "<td><a href='updateexpense1.php?tid=" . $row['Code'] . "'><font color='#C11B17'>".$row['Name']."</font></a></td>";
  }
if($row['actiontypeid'] ==  '3')
  {
  echo "<td><a href='updateincome1.php?tid=" . $row['Code'] . "'><font color='#347235'>".$row['Name']."</font></a></td>";
  }
if($row['actiontypeid'] == '1')
  {
 echo "<td><a href='updatetask3.php?tid=" . $row['Code'] . "'>".$row['Name']."</a></td>";
  }
if($row['actiontypeid'] == '4')
  {
 echo "<td><a href='updateofficeexpense1.php?tid=" . $row['Code'] . "'><font color='#2554C7'>".$row['Name']."</font></a></td>";
  }
if($var15 == '1')
{
  echo "<td>". $row['Type'] ."</td>";
}
if($var16 == '1')
{
  echo "<td>". $row['Person'] ."</td>";
}
if($var17 == '1')
{
  echo "<td>" . $row['Matter'] . "</td>";
}
if($var18 == '1')
{
  echo "<td>" . $row['actionstartdate'] . "</td>";
}
if($var19 == '1')
{
  echo "<td>" . $row['actionstarttime'] . "</td>";
}
if($var20 == '1')
{
  echo "<td>" . $row['duration'] . "</td>";
}
if($var21 == '1')
{
  echo "<td>" . $row['status'] . "</td>";
}
if($var22 == '1')
{
  echo "<td>" . $row['username'] . "</td>";
}
if($var23 == '1')
{
  echo "<td>" . $row['Notes'] . "</td>";
}
if($row['actiontypeid'] ==  '2')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#C11B17'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
if($row['actiontypeid'] ==  '3')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#347235'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
if($row['actiontypeid'] ==  '1')
  {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\">".number_format($row['Cost'], 2, '.', '')."&#8364;</a></td>";
  }
if($row['actiontypeid'] ==  '4')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#2554C7'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
  echo "<td><a href='deletebill1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Bill</a></td>";
  echo "</tr>";
}
  echo "<tr>";
  echo "<td><font color='#990000' size='3'>Total Sum</font></td>";
if($var15 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var16 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var17 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var18 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var19 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var20 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var21 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var22 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var23 == '1')
{
  echo "<td>&nbsp;</td>";
}
  echo "<td><font color='#990000' size='3'>".number_format($sum_total[0], 2, '.', '')."&#8364;</font></td>";
  echo "<td>&nbsp;</td>";
  echo "</tr>";
echo "</table>";

}
// Option 16
else
if($var3 != "" && $var10 != "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, ca.proceduretypeid as prid,
case when ca.personid is not null then p.descr
when cp.personid is not null then group_concat(p1.descr separator '<br />')
end as Person,
case when
ca.caseid is null then 'Matter no exist'
else c.descr
end as Matter,
case when ca.actiontypeid = 2 then 'Expense'
when ca.actiontypeid = 3 then 'Income'
when ca.actiontypeid = 4 then (select of.descr from case2action c2a left join officeexptype of on of.id = c2a.officeexptypeid where c2a.id = ca.id)
else pt.descr
end as Type,
ca.actiontypeid as actiontypeid,
ca.caseid as cid, date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, date_format(ca.duration,'%H:%i') as duration, st.descr as status, ca.notes as Notes, ca.cost as Cost
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join cases c on ca.caseid=c.id
left join person p on p.id = ca.personid
left join person p1 on cp.personid = p1.id
left join proceduretypes pt on pt.id = ca.proceduretypeid
left join users u on u.id = ca.userid
left join status st on st.id = ca.statusid
where ca.isdeleted = 0 and (ca.actionstartdate between $datefrom and $dateto)  and (ca.personid = $var2 or cp.personid = $var2) and ca.caseid=$var3 and ca.proceduretypeid=$var10 $var13 $var28
group by ca.id
order by $var11")
or die("SELECT Error: ".mysql_error());

$num_rows = mysql_num_rows($result);

$total = mysql_query( "SELECT sum(CASE WHEN ca.actiontypeid = 3 THEN (ca.cost)*-1 ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 1 THEN (ca.cost) ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 2 THEN (ca.cost) ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 4 THEN (ca.cost) ELSE 0 END) AS total
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
where ca.isdeleted = 0 and (ca.actionstartdate between $datefrom and $dateto)  and (ca.personid = $var2 or cp.personid = $var2) and ca.caseid=$var3 and ca.proceduretypeid=$var10 $var13 $var28")
or die("SELECT Error: ".mysql_error());

$sum_total = mysql_fetch_row($total);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Task Description</th>";
if($var15 == '1')
{
echo"<th>Task Type</th>";
}
if($var16 == '1')
{
echo"<th>Associated Person</th>";
}
if($var17 == '1')
{
echo"<th>Matter</th>";
}
if($var18 == '1')
{
echo"<th>Date</th>";
}
if($var19 == '1')
{
echo"<th>Time</th>";
}
if($var20 == '1')
{
echo"<th>Duration</th>";
}
if($var21 == '1')
{
echo"<th>Status</th>";
}
if($var22 == '1')
{
echo"<th>User</th>";
}
if($var23 == '1')
{
echo"<th>Notes</th>";
}
echo"<th>Cost</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
if($row['actiontypeid'] ==  '2')
  {
echo "<td><a href='updateexpense1.php?tid=" . $row['Code'] . "'><font color='#C11B17'>".$row['Name']."</font></a></td>";
  }
if($row['actiontypeid'] ==  '3')
  {
  echo "<td><a href='updateincome1.php?tid=" . $row['Code'] . "'><font color='#347235'>".$row['Name']."</font></a></td>";
  }
if($row['actiontypeid'] == '1')
  {
 echo "<td><a href='updatetask3.php?tid=" . $row['Code'] . "'>".$row['Name']."</a></td>";
  }
if($row['actiontypeid'] == '4')
  {
 echo "<td><a href='updateofficeexpense1.php?tid=" . $row['Code'] . "'><font color='#2554C7'>".$row['Name']."</font></a></td>";
  }
if($var15 == '1')
{
  echo "<td>". $row['Type'] ."</td>";
}
if($var16 == '1')
{
  echo "<td>". $row['Person'] ."</td>";
}
if($var17 == '1')
{
  echo "<td>" . $row['Matter'] . "</td>";
}
if($var18 == '1')
{
  echo "<td>" . $row['actionstartdate'] . "</td>";
}
if($var19 == '1')
{
  echo "<td>" . $row['actionstarttime'] . "</td>";
}
if($var20 == '1')
{
  echo "<td>" . $row['duration'] . "</td>";
}
if($var21 == '1')
{
  echo "<td>" . $row['status'] . "</td>";
}
if($var22 == '1')
{
  echo "<td>" . $row['username'] . "</td>";
}
if($var23 == '1')
{
  echo "<td>" . $row['Notes'] . "</td>";
}
if($row['actiontypeid'] ==  '2')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#C11B17'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
if($row['actiontypeid'] ==  '3')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#347235'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
if($row['actiontypeid'] ==  '1')
  {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\">".number_format($row['Cost'], 2, '.', '')."&#8364;</a></td>";
  }
if($row['actiontypeid'] ==  '4')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#2554C7'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
  echo "<td><a href='deletebill1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Bill</a></td>";
  echo "</tr>";
}
  echo "<tr>";
  echo "<td><font color='#990000' size='3'>Total Sum</font></td>";
if($var15 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var16 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var17 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var18 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var19 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var20 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var21 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var22 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var23 == '1')
{
  echo "<td>&nbsp;</td>";
}
  echo "<td><font color='#990000' size='3'>".number_format($sum_total[0], 2, '.', '')."&#8364;</font></td>";
  echo "<td>&nbsp;</td>";
  echo "</tr>";
echo "</table>";

}
}
}
}
//Option 17
if($var12 != "")
{
// billname not null
if($var1 != "")
{
if($var2 == "")
{
if($var3 == "" && $var10 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name,
case when ca.personid is not null then p.descr
when cp.personid is not null then group_concat(p1.descr separator '<br />')
end as Person,
case when
ca.caseid is null then 'Matter no exist'
else c.descr
end as Matter,
case when ca.actiontypeid = 2 then 'Expense'
when ca.actiontypeid = 3 then 'Income'
when ca.actiontypeid = 4 then (select of.descr from case2action c2a left join officeexptype of on of.id = c2a.officeexptypeid where c2a.id = ca.id)
else pt.descr
end as Type,
ca.actiontypeid as actiontypeid,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, date_format(ca.duration,'%H:%i') as duration, st.descr as status, ca.notes as Notes, ca.cost as Cost
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join cases c on ca.caseid=c.id
left join person p on p.id = ca.personid
left join person p1 on cp.personid = p1.id
left join proceduretypes pt on pt.id = ca.proceduretypeid
left join users u on u.id = ca.userid
left join status st on st.id = ca.statusid
where ca.isdeleted = 0 and ca.statusid = $var12 and (ca.actionstartdate between $datefrom and $dateto) and (ca.descr like \"%$var1%\" or u.full_name like \"%$var1%\" or ca.notes like \"%$var1%\") $var13 $var28
group by ca.id
order by $var11")
or die("SELECT Error: ".mysql_error());

$num_rows = mysql_num_rows($result);

$total = mysql_query( "SELECT sum(CASE WHEN ca.actiontypeid = 3 THEN (ca.cost)*-1 ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 1 THEN (ca.cost) ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 2 THEN (ca.cost) ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 4 THEN (ca.cost) ELSE 0 END) AS total
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join person p on p.id = ca.personid
left join person p1 on cp.personid = p1.id
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.statusid = $var12 and (ca.actionstartdate between $datefrom and $dateto) and (ca.descr like \"%$var1%\" or u.full_name like \"%$var1%\" or ca.notes like \"%$var1%\") $var13 $var28")
or die("SELECT Error: ".mysql_error());

$sum_total = mysql_fetch_row($total);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Task Description</th>";
if($var15 == '1')
{
echo"<th>Task Type</th>";
}
if($var16 == '1')
{
echo"<th>Associated Person</th>";
}
if($var17 == '1')
{
echo"<th>Matter</th>";
}
if($var18 == '1')
{
echo"<th>Date</th>";
}
if($var19 == '1')
{
echo"<th>Time</th>";
}
if($var20 == '1')
{
echo"<th>Duration</th>";
}
if($var21 == '1')
{
echo"<th>Status</th>";
}
if($var22 == '1')
{
echo"<th>User</th>";
}
if($var23 == '1')
{
echo"<th>Notes</th>";
}
echo"<th>Cost</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
if($row['actiontypeid'] ==  '2')
  {
echo "<td><a href='updateexpense1.php?tid=" . $row['Code'] . "'><font color='#C11B17'>".$row['Name']."</font></a></td>";
  }
if($row['actiontypeid'] ==  '3')
  {
  echo "<td><a href='updateincome1.php?tid=" . $row['Code'] . "'><font color='#347235'>".$row['Name']."</font></a></td>";
  }
if($row['actiontypeid'] == '1')
  {
 echo "<td><a href='updatetask3.php?tid=" . $row['Code'] . "'>".$row['Name']."</a></td>";
  }
if($row['actiontypeid'] == '4')
  {
 echo "<td><a href='updateofficeexpense1.php?tid=" . $row['Code'] . "'><font color='#2554C7'>".$row['Name']."</font></a></td>";
  }
if($var15 == '1')
{
  echo "<td>". $row['Type'] ."</td>";
}
if($var16 == '1')
{
  echo "<td>". $row['Person'] ."</td>";
}
if($var17 == '1')
{
  echo "<td>" . $row['Matter'] . "</td>";
}
if($var18 == '1')
{
  echo "<td>" . $row['actionstartdate'] . "</td>";
}
if($var19 == '1')
{
  echo "<td>" . $row['actionstarttime'] . "</td>";
}
if($var20 == '1')
{
  echo "<td>" . $row['duration'] . "</td>";
}
if($var21 == '1')
{
  echo "<td>" . $row['status'] . "</td>";
}
if($var22 == '1')
{
  echo "<td>" . $row['username'] . "</td>";
}
if($var23 == '1')
{
  echo "<td>" . $row['Notes'] . "</td>";
}
if($row['actiontypeid'] ==  '2')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#C11B17'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
if($row['actiontypeid'] ==  '3')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#347235'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
if($row['actiontypeid'] ==  '1')
  {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\">".number_format($row['Cost'], 2, '.', '')."&#8364;</a></td>";
  }
if($row['actiontypeid'] ==  '4')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#2554C7'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
  echo "<td><a href='deletebill1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Bill</a></td>";
  echo "</tr>";
}
  echo "<tr>";
  echo "<td><font color='#990000' size='3'>Total Sum</font></td>";
if($var15 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var16 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var17 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var18 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var19 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var20 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var21 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var22 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var23 == '1')
{
  echo "<td>&nbsp;</td>";
}
  echo "<td><font color='#990000' size='3'>".number_format($sum_total[0], 2, '.', '')."&#8364;</font></td>";
  echo "<td>&nbsp;</td>";
  echo "</tr>";
echo "</table>";

}
// Option 18
else
if($var3 != "" && $var10 != "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, ca.proceduretypeid as prid,
case when ca.personid is not null then p.descr
when cp.personid is not null then group_concat(p1.descr separator '<br />')
end as Person,
case when
ca.caseid is null then 'Matter no exist'
else c.descr
end as Matter,
case when ca.actiontypeid = 2 then 'Expense'
when ca.actiontypeid = 3 then 'Income'
when ca.actiontypeid = 4 then (select of.descr from case2action c2a left join officeexptype of on of.id = c2a.officeexptypeid where c2a.id = ca.id)
else pt.descr
end as Type,
ca.actiontypeid as actiontypeid,
ca.caseid as cid, date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, date_format(ca.duration,'%H:%i') as duration, st.descr as status, ca.notes as Notes, ca.cost as Cost
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join cases c on ca.caseid=c.id
left join person p on p.id = ca.personid
left join person p1 on cp.personid = p1.id
left join proceduretypes pt on pt.id = ca.proceduretypeid
left join users u on u.id = ca.userid
left join status st on st.id = ca.statusid
where ca.isdeleted = 0 and ca.statusid = $var12 and (ca.actionstartdate between $datefrom and $dateto) and (ca.descr like \"%$var1%\" or u.full_name like \"%$var1%\" or ca.notes like \"%$var1%\") and ca.caseid=$var3 and ca.proceduretypeid=$var10 $var13 $var28
group by ca.id
order by $var11")
or die("SELECT Error: ".mysql_error());

$num_rows = mysql_num_rows($result);

$total = mysql_query( "SELECT sum(CASE WHEN ca.actiontypeid = 3 THEN (ca.cost)*-1 ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 1 THEN (ca.cost) ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 2 THEN (ca.cost) ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 4 THEN (ca.cost) ELSE 0 END) AS total
FROM case2action ca
left join person p on p.id = ca.personid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.statusid = $var12 and (ca.actionstartdate between $datefrom and $dateto) and (ca.descr like \"%$var1%\" or u.full_name like \"%$var1%\" or ca.notes like \"%$var1%\") and ca.caseid=$var3 and ca.proceduretypeid=$var10 $var13 $var28")
or die("SELECT Error: ".mysql_error());

$sum_total = mysql_fetch_row($total);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Task Description</th>";
if($var15 == '1')
{
echo"<th>Task Type</th>";
}
if($var16 == '1')
{
echo"<th>Associated Person</th>";
}
if($var17 == '1')
{
echo"<th>Matter</th>";
}
if($var18 == '1')
{
echo"<th>Date</th>";
}
if($var19 == '1')
{
echo"<th>Time</th>";
}
if($var20 == '1')
{
echo"<th>Duration</th>";
}
if($var21 == '1')
{
echo"<th>Status</th>";
}
if($var22 == '1')
{
echo"<th>User</th>";
}
if($var23 == '1')
{
echo"<th>Notes</th>";
}
echo"<th>Cost</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
if($row['actiontypeid'] ==  '2')
  {
echo "<td><a href='updateexpense1.php?tid=" . $row['Code'] . "'><font color='#C11B17'>".$row['Name']."</font></a></td>";
  }
if($row['actiontypeid'] ==  '3')
  {
  echo "<td><a href='updateincome1.php?tid=" . $row['Code'] . "'><font color='#347235'>".$row['Name']."</font></a></td>";
  }
if($row['actiontypeid'] == '1')
  {
 echo "<td><a href='updatetask3.php?tid=" . $row['Code'] . "'>".$row['Name']."</a></td>";
  }
if($row['actiontypeid'] == '4')
  {
 echo "<td><a href='updateofficeexpense1.php?tid=" . $row['Code'] . "'><font color='#2554C7'>".$row['Name']."</font></a></td>";
  }
if($var15 == '1')
{
  echo "<td>". $row['Type'] ."</td>";
}
if($var16 == '1')
{
  echo "<td>". $row['Person'] ."</td>";
}
if($var17 == '1')
{
  echo "<td>" . $row['Matter'] . "</td>";
}
if($var18 == '1')
{
  echo "<td>" . $row['actionstartdate'] . "</td>";
}
if($var19 == '1')
{
  echo "<td>" . $row['actionstarttime'] . "</td>";
}
if($var20 == '1')
{
  echo "<td>" . $row['duration'] . "</td>";
}
if($var21 == '1')
{
  echo "<td>" . $row['status'] . "</td>";
}
if($var22 == '1')
{
  echo "<td>" . $row['username'] . "</td>";
}
if($var23 == '1')
{
  echo "<td>" . $row['Notes'] . "</td>";
}
if($row['actiontypeid'] ==  '2')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#C11B17'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
if($row['actiontypeid'] ==  '3')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#347235'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
if($row['actiontypeid'] ==  '1')
  {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\">".number_format($row['Cost'], 2, '.', '')."&#8364;</a></td>";
  }
if($row['actiontypeid'] ==  '4')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#2554C7'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
  echo "<td><a href='deletebill1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Bill</a></td>";
  echo "</tr>";
}
  echo "<tr>";
  echo "<td><font color='#990000' size='3'>Total Sum</font></td>";
if($var15 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var16 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var17 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var18 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var19 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var20 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var21 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var22 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var23 == '1')
{
  echo "<td>&nbsp;</td>";
}
  echo "<td><font color='#990000' size='3'>".number_format($sum_total[0], 2, '.', '')."&#8364;</font></td>";
  echo "<td>&nbsp;</td>";
  echo "</tr>";
echo "</table>";

}
// Option 19
else
if($var3 != "" && $var10 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name,
case when ca.personid is not null then p.descr
when cp.personid is not null then group_concat(p1.descr separator '<br />')
end as Person,
ca.personid as pid,
case when
ca.caseid is null then 'Matter no exist'
else c.descr
end as Matter,
case when ca.actiontypeid = 2 then 'Expense'
when ca.actiontypeid = 3 then 'Income'
when ca.actiontypeid = 4 then (select of.descr from case2action c2a left join officeexptype of on of.id = c2a.officeexptypeid where c2a.id = ca.id)
else pt.descr
end as Type,
ca.actiontypeid as actiontypeid,
ca.caseid as cid, date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, date_format(ca.duration,'%H:%i') as duration, st.descr as status, ca.notes as Notes, ca.cost as Cost
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join cases c on ca.caseid=c.id
left join person p on p.id = ca.personid
left join person p1 on cp.personid = p1.id
left join proceduretypes pt on pt.id = ca.proceduretypeid
left join users u on u.id = ca.userid
left join status st on st.id = ca.statusid
where ca.isdeleted = 0 and ca.statusid = $var12 and (ca.actionstartdate between $datefrom and $dateto) and (ca.descr like \"%$var1%\" or u.full_name like \"%$var1%\" or ca.notes like \"%$var1%\") and ca.caseid=$var3 $var13 $var28
group by ca.id
order by $var11")
or die("SELECT Error: ".mysql_error());

$num_rows = mysql_num_rows($result);

$total = mysql_query( "SELECT sum(CASE WHEN ca.actiontypeid = 3 THEN (ca.cost)*-1 ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 1 THEN (ca.cost) ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 2 THEN (ca.cost) ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 4 THEN (ca.cost) ELSE 0 END) AS total
FROM case2action ca
left join person p on p.id = ca.personid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.statusid = $var12 and (ca.actionstartdate between $datefrom and $dateto) and (ca.descr like \"%$var1%\" or u.full_name like \"%$var1%\" or ca.notes like \"%$var1%\") and ca.caseid=$var3 $var13 $var28")
or die("SELECT Error: ".mysql_error());

$sum_total = mysql_fetch_row($total);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Task Description</th>";
if($var15 == '1')
{
echo"<th>Task Type</th>";
}
if($var16 == '1')
{
echo"<th>Associated Person</th>";
}
if($var17 == '1')
{
echo"<th>Matter</th>";
}
if($var18 == '1')
{
echo"<th>Date</th>";
}
if($var19 == '1')
{
echo"<th>Time</th>";
}
if($var20 == '1')
{
echo"<th>Duration</th>";
}
if($var21 == '1')
{
echo"<th>Status</th>";
}
if($var22 == '1')
{
echo"<th>User</th>";
}
if($var23 == '1')
{
echo"<th>Notes</th>";
}
echo"<th>Cost</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
if($row['actiontypeid'] ==  '2')
  {
echo "<td><a href='updateexpense1.php?tid=" . $row['Code'] . "'><font color='#C11B17'>".$row['Name']."</font></a></td>";
  }
if($row['actiontypeid'] ==  '3')
  {
  echo "<td><a href='updateincome1.php?tid=" . $row['Code'] . "'><font color='#347235'>".$row['Name']."</font></a></td>";
  }
if($row['actiontypeid'] == '1')
  {
 echo "<td><a href='updatetask3.php?tid=" . $row['Code'] . "'>".$row['Name']."</a></td>";
  }
if($row['actiontypeid'] == '4')
  {
 echo "<td><a href='updateofficeexpense1.php?tid=" . $row['Code'] . "'><font color='#2554C7'>".$row['Name']."</font></a></td>";
  }
if($var15 == '1')
{
  echo "<td>". $row['Type'] ."</td>";
}
if($var16 == '1')
{
  echo "<td>". $row['Person'] ."</td>";
}
if($var17 == '1')
{
  echo "<td>" . $row['Matter'] . "</td>";
}
if($var18 == '1')
{
  echo "<td>" . $row['actionstartdate'] . "</td>";
}
if($var19 == '1')
{
  echo "<td>" . $row['actionstarttime'] . "</td>";
}
if($var20 == '1')
{
  echo "<td>" . $row['duration'] . "</td>";
}
if($var21 == '1')
{
  echo "<td>" . $row['status'] . "</td>";
}
if($var22 == '1')
{
  echo "<td>" . $row['username'] . "</td>";
}
if($var23 == '1')
{
  echo "<td>" . $row['Notes'] . "</td>";
}
if($row['actiontypeid'] ==  '2')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#C11B17'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
if($row['actiontypeid'] ==  '3')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#347235'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
if($row['actiontypeid'] ==  '1')
  {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\">".number_format($row['Cost'], 2, '.', '')."&#8364;</a></td>";
  }
if($row['actiontypeid'] ==  '4')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#2554C7'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
  echo "<td><a href='deletebill1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Bill</a></td>";
  echo "</tr>";
}
  echo "<tr>";
  echo "<td><font color='#990000' size='3'>Total Sum</font></td>";
if($var15 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var16 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var17 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var18 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var19 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var20 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var21 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var22 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var23 == '1')
{
  echo "<td>&nbsp;</td>";
}
  echo "<td><font color='#990000' size='3'>".number_format($sum_total[0], 2, '.', '')."&#8364;</font></td>";
  echo "<td>&nbsp;</td>";
  echo "</tr>";
echo "</table>";

}
// Option 20
else
if($var3 == "" && $var10 != "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, ca.proceduretypeid as prid,
case when ca.personid is not null then p.descr
when cp.personid is not null then group_concat(p1.descr separator '<br />')
end as Person,
case when
ca.caseid is null then 'Matter no exist'
else c.descr
end as Matter,
case when ca.actiontypeid = 2 then 'Expense'
when ca.actiontypeid = 3 then 'Income'
when ca.actiontypeid = 4 then (select of.descr from case2action c2a left join officeexptype of on of.id = c2a.officeexptypeid where c2a.id = ca.id)
else pt.descr
end as Type,
ca.actiontypeid as actiontypeid,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, date_format(ca.duration,'%H:%i') as duration, st.descr as status, ca.notes as Notes, ca.cost as Cost
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join cases c on ca.caseid=c.id
left join person p on p.id = ca.personid
left join person p1 on cp.personid = p1.id
left join proceduretypes pt on pt.id = ca.proceduretypeid
left join users u on u.id = ca.userid
left join status st on st.id = ca.statusid
where ca.isdeleted = 0 and ca.statusid = $var12 and (ca.actionstartdate between $datefrom and $dateto) and (ca.descr like \"%$var1%\" or u.full_name like \"%$var1%\" or ca.notes like \"%$var1%\") and ca.proceduretypeid=$var10 $var13 $var28
group by ca.id
order by $var11")
or die("SELECT Error: ".mysql_error());

$num_rows = mysql_num_rows($result);

$total = mysql_query( "SELECT sum(CASE WHEN ca.actiontypeid = 3 THEN (ca.cost)*-1 ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 1 THEN (ca.cost) ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 2 THEN (ca.cost) ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 4 THEN (ca.cost) ELSE 0 END) AS total
FROM case2action ca
left join person p on p.id = ca.personid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.statusid = $var12 and (ca.actionstartdate between $datefrom and $dateto) and (ca.descr like \"%$var1%\" or u.full_name like \"%$var1%\" or ca.notes like \"%$var1%\") and ca.proceduretypeid=$var10 $var13 $var28")
or die("SELECT Error: ".mysql_error());

$sum_total = mysql_fetch_row($total);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Task Description</th>";
if($var15 == '1')
{
echo"<th>Task Type</th>";
}
if($var16 == '1')
{
echo"<th>Associated Person</th>";
}
if($var17 == '1')
{
echo"<th>Matter</th>";
}
if($var18 == '1')
{
echo"<th>Date</th>";
}
if($var19 == '1')
{
echo"<th>Time</th>";
}
if($var20 == '1')
{
echo"<th>Duration</th>";
}
if($var21 == '1')
{
echo"<th>Status</th>";
}
if($var22 == '1')
{
echo"<th>User</th>";
}
if($var23 == '1')
{
echo"<th>Notes</th>";
}
echo"<th>Cost</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
if($row['actiontypeid'] ==  '2')
  {
echo "<td><a href='updateexpense1.php?tid=" . $row['Code'] . "'><font color='#C11B17'>".$row['Name']."</font></a></td>";
  }
if($row['actiontypeid'] ==  '3')
  {
  echo "<td><a href='updateincome1.php?tid=" . $row['Code'] . "'><font color='#347235'>".$row['Name']."</font></a></td>";
  }
if($row['actiontypeid'] == '1')
  {
 echo "<td><a href='updatetask3.php?tid=" . $row['Code'] . "'>".$row['Name']."</a></td>";
  }
if($row['actiontypeid'] == '4')
  {
 echo "<td><a href='updateofficeexpense1.php?tid=" . $row['Code'] . "'><font color='#2554C7'>".$row['Name']."</font></a></td>";
  }
if($var15 == '1')
{
  echo "<td>". $row['Type'] ."</td>";
}
if($var16 == '1')
{
  echo "<td>". $row['Person'] ."</td>";
}
if($var17 == '1')
{
  echo "<td>" . $row['Matter'] . "</td>";
}
if($var18 == '1')
{
  echo "<td>" . $row['actionstartdate'] . "</td>";
}
if($var19 == '1')
{
  echo "<td>" . $row['actionstarttime'] . "</td>";
}
if($var20 == '1')
{
  echo "<td>" . $row['duration'] . "</td>";
}
if($var21 == '1')
{
  echo "<td>" . $row['status'] . "</td>";
}
if($var22 == '1')
{
  echo "<td>" . $row['username'] . "</td>";
}
if($var23 == '1')
{
  echo "<td>" . $row['Notes'] . "</td>";
}
if($row['actiontypeid'] ==  '2')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#C11B17'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
if($row['actiontypeid'] ==  '3')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#347235'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
if($row['actiontypeid'] ==  '1')
  {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\">".number_format($row['Cost'], 2, '.', '')."&#8364;</a></td>";
  }
if($row['actiontypeid'] ==  '4')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#2554C7'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
  echo "<td><a href='deletebill1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Bill</a></td>";
  echo "</tr>";
}
  echo "<tr>";
  echo "<td><font color='#990000' size='3'>Total Sum</font></td>";
if($var15 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var16 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var17 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var18 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var19 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var20 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var21 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var22 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var23 == '1')
{
  echo "<td>&nbsp;</td>";
}
  echo "<td><font color='#990000' size='3'>".number_format($sum_total[0], 2, '.', '')."&#8364;</font></td>";
  echo "<td>&nbsp;</td>";
  echo "</tr>";
echo "</table>";

}
}
//Option 21
else
if($var2 != "")
{
if($var3 == "" && $var10 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name,
case when ca.personid is not null then p.descr
when cp.personid is not null then group_concat(p1.descr separator '<br />')
end as Person,
case when
ca.caseid is null then 'Matter no exist'
else c.descr
end as Matter,
case when ca.actiontypeid = 2 then 'Expense'
when ca.actiontypeid = 3 then 'Income'
when ca.actiontypeid = 4 then (select of.descr from case2action c2a left join officeexptype of on of.id = c2a.officeexptypeid where c2a.id = ca.id)
else pt.descr
end as Type,
ca.actiontypeid as actiontypeid,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, date_format(ca.duration,'%H:%i') as duration, st.descr as status, ca.notes as Notes, ca.cost as Cost
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join cases c on ca.caseid=c.id
left join person p on p.id = ca.personid
left join person p1 on cp.personid = p1.id
left join proceduretypes pt on pt.id = ca.proceduretypeid
left join users u on u.id = ca.userid
left join status st on st.id = ca.statusid
where ca.isdeleted = 0 and ca.statusid = $var12 and (ca.actionstartdate between $datefrom and $dateto)  and (ca.descr like \"%$var1%\" or u.full_name like \"%$var1%\" or ca.notes like \"%$var1%\") and (ca.personid = $var2 or cp.personid = $var2) $var13 $var28
group by ca.id
order by $var11")
or die("SELECT Error: ".mysql_error());

$num_rows = mysql_num_rows($result);

$total = mysql_query( "SELECT sum(CASE WHEN ca.actiontypeid = 3 THEN (ca.cost)*-1 ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 1 THEN (ca.cost) ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 2 THEN (ca.cost) ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 4 THEN (ca.cost) ELSE 0 END) AS total
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.statusid = $var12 and (ca.actionstartdate between $datefrom and $dateto)  and (ca.descr like \"%$var1%\" or u.full_name like \"%$var1%\" or ca.notes like \"%$var1%\") and (ca.personid = $var2 or cp.personid = $var2) $var13 $var28")
or die("SELECT Error: ".mysql_error());

$sum_total = mysql_fetch_row($total);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Task Description</th>";
if($var15 == '1')
{
echo"<th>Task Type</th>";
}
if($var16 == '1')
{
echo"<th>Associated Person</th>";
}
if($var17 == '1')
{
echo"<th>Matter</th>";
}
if($var18 == '1')
{
echo"<th>Date</th>";
}
if($var19 == '1')
{
echo"<th>Time</th>";
}
if($var20 == '1')
{
echo"<th>Duration</th>";
}
if($var21 == '1')
{
echo"<th>Status</th>";
}
if($var22 == '1')
{
echo"<th>User</th>";
}
if($var23 == '1')
{
echo"<th>Notes</th>";
}
echo"<th>Cost</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
if($row['actiontypeid'] ==  '2')
  {
echo "<td><a href='updateexpense1.php?tid=" . $row['Code'] . "'><font color='#C11B17'>".$row['Name']."</font></a></td>";
  }
if($row['actiontypeid'] ==  '3')
  {
  echo "<td><a href='updateincome1.php?tid=" . $row['Code'] . "'><font color='#347235'>".$row['Name']."</font></a></td>";
  }
if($row['actiontypeid'] == '1')
  {
 echo "<td><a href='updatetask3.php?tid=" . $row['Code'] . "'>".$row['Name']."</a></td>";
  }
if($row['actiontypeid'] == '4')
  {
 echo "<td><a href='updateofficeexpense1.php?tid=" . $row['Code'] . "'><font color='#2554C7'>".$row['Name']."</font></a></td>";
  }
if($var15 == '1')
{
  echo "<td>". $row['Type'] ."</td>";
}
if($var16 == '1')
{
  echo "<td>". $row['Person'] ."</td>";
}
if($var17 == '1')
{
  echo "<td>" . $row['Matter'] . "</td>";
}
if($var18 == '1')
{
  echo "<td>" . $row['actionstartdate'] . "</td>";
}
if($var19 == '1')
{
  echo "<td>" . $row['actionstarttime'] . "</td>";
}
if($var20 == '1')
{
  echo "<td>" . $row['duration'] . "</td>";
}
if($var21 == '1')
{
  echo "<td>" . $row['status'] . "</td>";
}
if($var22 == '1')
{
  echo "<td>" . $row['username'] . "</td>";
}
if($var23 == '1')
{
  echo "<td>" . $row['Notes'] . "</td>";
}
if($row['actiontypeid'] ==  '2')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#C11B17'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
if($row['actiontypeid'] ==  '3')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#347235'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
if($row['actiontypeid'] ==  '1')
  {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\">".number_format($row['Cost'], 2, '.', '')."&#8364;</a></td>";
  }
if($row['actiontypeid'] ==  '4')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#2554C7'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
  echo "<td><a href='deletebill1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Bill</a></td>";
  echo "</tr>";
}
  echo "<tr>";
  echo "<td><font color='#990000' size='3'>Total Sum</font></td>";
if($var15 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var16 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var17 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var18 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var19 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var20 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var21 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var22 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var23 == '1')
{
  echo "<td>&nbsp;</td>";
}
  echo "<td><font color='#990000' size='3'>".number_format($sum_total[0], 2, '.', '')."&#8364;</font></td>";
  echo "<td>&nbsp;</td>";
  echo "</tr>";
echo "</table>";

}
else
//Option 22
if($var3 != "" && $var10 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name,
case when ca.personid is not null then p.descr
when cp.personid is not null then group_concat(p1.descr separator '<br />')
end as Person,
case when
ca.caseid is null then 'Matter no exist'
else c.descr
end as Matter,
case when ca.actiontypeid = 2 then 'Expense'
when ca.actiontypeid = 3 then 'Income'
when ca.actiontypeid = 4 then (select of.descr from case2action c2a left join officeexptype of on of.id = c2a.officeexptypeid where c2a.id = ca.id)
else pt.descr
end as Type,
ca.actiontypeid as actiontypeid,
ca.caseid as cid, date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, date_format(ca.duration,'%H:%i') as duration, st.descr as status, ca.notes as Notes, ca.cost as Cost
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join cases c on ca.caseid=c.id
left join person p on p.id = ca.personid
left join person p1 on cp.personid = p1.id
left join proceduretypes pt on pt.id = ca.proceduretypeid
left join users u on u.id = ca.userid
left join status st on st.id = ca.statusid
where ca.isdeleted = 0 and ca.statusid = $var12 and (ca.actionstartdate between $datefrom and $dateto) and (ca.descr like \"%$var1%\" or u.full_name like \"%$var1%\" or ca.notes like \"%$var1%\") and (ca.personid = $var2 or cp.personid = $var2) and ca.caseid=$var3 $var13 $var28
group by ca.id
order by $var11")
or die("SELECT Error: ".mysql_error());

$num_rows = mysql_num_rows($result);

$total = mysql_query( "SELECT sum(CASE WHEN ca.actiontypeid = 3 THEN (ca.cost)*-1 ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 1 THEN (ca.cost) ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 2 THEN (ca.cost) ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 4 THEN (ca.cost) ELSE 0 END) AS total
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.statusid = $var12 and (ca.actionstartdate between $datefrom and $dateto) and (ca.descr like \"%$var1%\" or u.full_name like \"%$var1%\" or ca.notes like \"%$var1%\") and (ca.personid = $var2 or cp.personid = $var2) and ca.caseid=$var3 $var13 $var28")
or die("SELECT Error: ".mysql_error());

$sum_total = mysql_fetch_row($total);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Task Description</th>";
if($var15 == '1')
{
echo"<th>Task Type</th>";
}
if($var16 == '1')
{
echo"<th>Associated Person</th>";
}
if($var17 == '1')
{
echo"<th>Matter</th>";
}
if($var18 == '1')
{
echo"<th>Date</th>";
}
if($var19 == '1')
{
echo"<th>Time</th>";
}
if($var20 == '1')
{
echo"<th>Duration</th>";
}
if($var21 == '1')
{
echo"<th>Status</th>";
}
if($var22 == '1')
{
echo"<th>User</th>";
}
if($var23 == '1')
{
echo"<th>Notes</th>";
}
echo"<th>Cost</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
if($row['actiontypeid'] ==  '2')
  {
echo "<td><a href='updateexpense1.php?tid=" . $row['Code'] . "'><font color='#C11B17'>".$row['Name']."</font></a></td>";
  }
if($row['actiontypeid'] ==  '3')
  {
  echo "<td><a href='updateincome1.php?tid=" . $row['Code'] . "'><font color='#347235'>".$row['Name']."</font></a></td>";
  }
if($row['actiontypeid'] == '1')
  {
 echo "<td><a href='updatetask3.php?tid=" . $row['Code'] . "'>".$row['Name']."</a></td>";
  }
if($row['actiontypeid'] == '4')
  {
 echo "<td><a href='updateofficeexpense1.php?tid=" . $row['Code'] . "'><font color='#2554C7'>".$row['Name']."</font></a></td>";
  }
if($var15 == '1')
{
  echo "<td>". $row['Type'] ."</td>";
}
if($var16 == '1')
{
  echo "<td>". $row['Person'] ."</td>";
}
if($var17 == '1')
{
  echo "<td>" . $row['Matter'] . "</td>";
}
if($var18 == '1')
{
  echo "<td>" . $row['actionstartdate'] . "</td>";
}
if($var19 == '1')
{
  echo "<td>" . $row['actionstarttime'] . "</td>";
}
if($var20 == '1')
{
  echo "<td>" . $row['duration'] . "</td>";
}
if($var21 == '1')
{
  echo "<td>" . $row['status'] . "</td>";
}
if($var22 == '1')
{
  echo "<td>" . $row['username'] . "</td>";
}
if($var23 == '1')
{
  echo "<td>" . $row['Notes'] . "</td>";
}
if($row['actiontypeid'] ==  '2')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#C11B17'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
if($row['actiontypeid'] ==  '3')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#347235'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
if($row['actiontypeid'] ==  '1')
  {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\">".number_format($row['Cost'], 2, '.', '')."&#8364;</a></td>";
  }
if($row['actiontypeid'] ==  '4')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#2554C7'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
  echo "<td><a href='deletebill1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Bill</a></td>";
  echo "</tr>";
}
  echo "<tr>";
  echo "<td><font color='#990000' size='3'>Total Sum</font></td>";
if($var15 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var16 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var17 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var18 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var19 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var20 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var21 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var22 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var23 == '1')
{
  echo "<td>&nbsp;</td>";
}
  echo "<td><font color='#990000' size='3'>".number_format($sum_total[0], 2, '.', '')."&#8364;</font></td>";
  echo "<td>&nbsp;</td>";
  echo "</tr>";
echo "</table>";

}
// Option 23
else
if($var3 == "" && $var10 != "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, ca.proceduretypeid as prid,
case when ca.personid is not null then p.descr
when cp.personid is not null then group_concat(p1.descr separator '<br />')
end as Person,
case when
ca.caseid is null then 'Matter no exist'
else c.descr
end as Matter,
case when ca.actiontypeid = 2 then 'Expense'
when ca.actiontypeid = 3 then 'Income'
when ca.actiontypeid = 4 then (select of.descr from case2action c2a left join officeexptype of on of.id = c2a.officeexptypeid where c2a.id = ca.id)
else pt.descr
end as Type,
ca.actiontypeid as actiontypeid,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, date_format(ca.duration,'%H:%i') as duration, st.descr as status, ca.notes as Notes, ca.cost as Cost
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join cases c on ca.caseid=c.id
left join person p on p.id = ca.personid
left join person p1 on cp.personid = p1.id
left join proceduretypes pt on pt.id = ca.proceduretypeid
left join users u on u.id = ca.userid
left join status st on st.id = ca.statusid
where ca.isdeleted = 0 and ca.statusid = $var12 and (ca.actionstartdate between $datefrom and $dateto) and (ca.descr like \"%$var1%\" or u.full_name like \"%$var1%\" or ca.notes like \"%$var1%\") and (ca.personid = $var2 or cp.personid = $var2) and ca.proceduretypeid=$var10 $var13 $var28
group by ca.id
order by $var11")
or die("SELECT Error: ".mysql_error());

$num_rows = mysql_num_rows($result);

$total = mysql_query( "SELECT sum(CASE WHEN ca.actiontypeid = 3 THEN (ca.cost)*-1 ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 1 THEN (ca.cost) ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 2 THEN (ca.cost) ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 4 THEN (ca.cost) ELSE 0 END) AS total
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.statusid = $var12 and (ca.actionstartdate between $datefrom and $dateto) and (ca.descr like \"%$var1%\" or u.full_name like \"%$var1%\" or ca.notes like \"%$var1%\") and (ca.personid = $var2 or cp.personid = $var2) and ca.proceduretypeid=$var10 $var13 $var28")
or die("SELECT Error: ".mysql_error());

$sum_total = mysql_fetch_row($total);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Task Description</th>";
if($var15 == '1')
{
echo"<th>Task Type</th>";
}
if($var16 == '1')
{
echo"<th>Associated Person</th>";
}
if($var17 == '1')
{
echo"<th>Matter</th>";
}
if($var18 == '1')
{
echo"<th>Date</th>";
}
if($var19 == '1')
{
echo"<th>Time</th>";
}
if($var20 == '1')
{
echo"<th>Duration</th>";
}
if($var21 == '1')
{
echo"<th>Status</th>";
}
if($var22 == '1')
{
echo"<th>User</th>";
}
if($var23 == '1')
{
echo"<th>Notes</th>";
}
echo"<th>Cost</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
if($row['actiontypeid'] ==  '2')
  {
echo "<td><a href='updateexpense1.php?tid=" . $row['Code'] . "'><font color='#C11B17'>".$row['Name']."</font></a></td>";
  }
if($row['actiontypeid'] ==  '3')
  {
  echo "<td><a href='updateincome1.php?tid=" . $row['Code'] . "'><font color='#347235'>".$row['Name']."</font></a></td>";
  }
if($row['actiontypeid'] == '1')
  {
 echo "<td><a href='updatetask3.php?tid=" . $row['Code'] . "'>".$row['Name']."</a></td>";
  }
if($row['actiontypeid'] == '4')
  {
 echo "<td><a href='updateofficeexpense1.php?tid=" . $row['Code'] . "'><font color='#2554C7'>".$row['Name']."</font></a></td>";
  }
if($var15 == '1')
{
  echo "<td>". $row['Type'] ."</td>";
}
if($var16 == '1')
{
  echo "<td>". $row['Person'] ."</td>";
}
if($var17 == '1')
{
  echo "<td>" . $row['Matter'] . "</td>";
}
if($var18 == '1')
{
  echo "<td>" . $row['actionstartdate'] . "</td>";
}
if($var19 == '1')
{
  echo "<td>" . $row['actionstarttime'] . "</td>";
}
if($var20 == '1')
{
  echo "<td>" . $row['duration'] . "</td>";
}
if($var21 == '1')
{
  echo "<td>" . $row['status'] . "</td>";
}
if($var22 == '1')
{
  echo "<td>" . $row['username'] . "</td>";
}
if($var23 == '1')
{
  echo "<td>" . $row['Notes'] . "</td>";
}
if($row['actiontypeid'] ==  '2')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#C11B17'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
if($row['actiontypeid'] ==  '3')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#347235'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
if($row['actiontypeid'] ==  '1')
  {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\">".number_format($row['Cost'], 2, '.', '')."&#8364;</a></td>";
  }
if($row['actiontypeid'] ==  '4')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#2554C7'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
  echo "<td><a href='deletebill1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Bill</a></td>";
  echo "</tr>";
}
  echo "<tr>";
  echo "<td><font color='#990000' size='3'>Total Sum</font></td>";
if($var15 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var16 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var17 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var18 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var19 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var20 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var21 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var22 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var23 == '1')
{
  echo "<td>&nbsp;</td>";
}
  echo "<td><font color='#990000' size='3'>".number_format($sum_total[0], 2, '.', '')."&#8364;</font></td>";
  echo "<td>&nbsp;</td>";
  echo "</tr>";
echo "</table>";

}
// Option 24
else
if($var3 != "" && $var10 != "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, ca.proceduretypeid as prid,
case when ca.personid is not null then p.descr
when cp.personid is not null then group_concat(p1.descr separator '<br />')
end as Person,
case when
ca.caseid is null then 'Matter no exist'
else c.descr
end as Matter,
case when ca.actiontypeid = 2 then 'Expense'
when ca.actiontypeid = 3 then 'Income'
when ca.actiontypeid = 4 then (select of.descr from case2action c2a left join officeexptype of on of.id = c2a.officeexptypeid where c2a.id = ca.id)
else pt.descr
end as Type,
ca.actiontypeid as actiontypeid,
ca.caseid as cid, date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, date_format(ca.duration,'%H:%i') as duration, st.descr as status, ca.notes as Notes, ca.cost as Cost
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join cases c on ca.caseid=c.id
left join person p on p.id = ca.personid
left join person p1 on cp.personid = p1.id
left join proceduretypes pt on pt.id = ca.proceduretypeid
left join users u on u.id = ca.userid
left join status st on st.id = ca.statusid
where ca.isdeleted = 0 and ca.statusid = $var12 and (ca.actionstartdate between $datefrom and $dateto)  and (ca.descr like \"%$var1%\" or u.full_name like \"%$var1%\" or ca.notes like \"%$var1%\") and (ca.personid = $var2 or cp.personid = $var2) and ca.caseid=$var3 and ca.proceduretypeid=$var10 $var13 $var28
group by ca.id
order by $var11")
or die("SELECT Error: ".mysql_error());

$num_rows = mysql_num_rows($result);

$total = mysql_query( "SELECT sum(CASE WHEN ca.actiontypeid = 3 THEN (ca.cost)*-1 ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 1 THEN (ca.cost) ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 2 THEN (ca.cost) ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 4 THEN (ca.cost) ELSE 0 END) AS total
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.statusid = $var12 and (ca.actionstartdate between $datefrom and $dateto)  and (ca.descr like \"%$var1%\" or u.full_name like \"%$var1%\" or ca.notes like \"%$var1%\") and (ca.personid = $var2 or cp.personid = $var2) and ca.caseid=$var3 and ca.proceduretypeid=$var10 $var13 $var28")
or die("SELECT Error: ".mysql_error());

$sum_total = mysql_fetch_row($total);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Task Description</th>";
if($var15 == '1')
{
echo"<th>Task Type</th>";
}
if($var16 == '1')
{
echo"<th>Associated Person</th>";
}
if($var17 == '1')
{
echo"<th>Matter</th>";
}
if($var18 == '1')
{
echo"<th>Date</th>";
}
if($var19 == '1')
{
echo"<th>Time</th>";
}
if($var20 == '1')
{
echo"<th>Duration</th>";
}
if($var21 == '1')
{
echo"<th>Status</th>";
}
if($var22 == '1')
{
echo"<th>User</th>";
}
if($var23 == '1')
{
echo"<th>Notes</th>";
}
echo"<th>Cost</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
if($row['actiontypeid'] ==  '2')
  {
echo "<td><a href='updateexpense1.php?tid=" . $row['Code'] . "'><font color='#C11B17'>".$row['Name']."</font></a></td>";
  }
if($row['actiontypeid'] ==  '3')
  {
  echo "<td><a href='updateincome1.php?tid=" . $row['Code'] . "'><font color='#347235'>".$row['Name']."</font></a></td>";
  }
if($row['actiontypeid'] == '1')
  {
 echo "<td><a href='updatetask3.php?tid=" . $row['Code'] . "'>".$row['Name']."</a></td>";
  }
if($row['actiontypeid'] == '4')
  {
 echo "<td><a href='updateofficeexpense1.php?tid=" . $row['Code'] . "'><font color='#2554C7'>".$row['Name']."</font></a></td>";
  }
if($var15 == '1')
{
  echo "<td>". $row['Type'] ."</td>";
}
if($var16 == '1')
{
  echo "<td>". $row['Person'] ."</td>";
}
if($var17 == '1')
{
  echo "<td>" . $row['Matter'] . "</td>";
}
if($var18 == '1')
{
  echo "<td>" . $row['actionstartdate'] . "</td>";
}
if($var19 == '1')
{
  echo "<td>" . $row['actionstarttime'] . "</td>";
}
if($var20 == '1')
{
  echo "<td>" . $row['duration'] . "</td>";
}
if($var21 == '1')
{
  echo "<td>" . $row['status'] . "</td>";
}
if($var22 == '1')
{
  echo "<td>" . $row['username'] . "</td>";
}
if($var23 == '1')
{
  echo "<td>" . $row['Notes'] . "</td>";
}
if($row['actiontypeid'] ==  '2')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#C11B17'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
if($row['actiontypeid'] ==  '3')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#347235'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
if($row['actiontypeid'] ==  '1')
  {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\">".number_format($row['Cost'], 2, '.', '')."&#8364;</a></td>";
  }
if($row['actiontypeid'] ==  '4')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#2554C7'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
  echo "<td><a href='deletebill1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Bill</a></td>";
  echo "</tr>";
}
  echo "<tr>";
  echo "<td><font color='#990000' size='3'>Total Sum</font></td>";
if($var15 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var16 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var17 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var18 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var19 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var20 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var21 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var22 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var23 == '1')
{
  echo "<td>&nbsp;</td>";
}
  echo "<td><font color='#990000' size='3'>".number_format($sum_total[0], 2, '.', '')."&#8364;</font></td>";
  echo "<td>&nbsp;</td>";
  echo "</tr>";
echo "</table>";

}
}
}
//Option 25 billname null
else
if($var1 == "")
{
if($var2 == "")
{
if($var3 == "" && $var10 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name,
case when ca.personid is not null then p.descr
when cp.personid is not null then group_concat(p1.descr separator '<br />')
end as Person,
case when
ca.caseid is null then 'Matter no exist'
else c.descr
end as Matter,
case when ca.actiontypeid = 2 then 'Expense'
when ca.actiontypeid = 3 then 'Income'
when ca.actiontypeid = 4 then (select of.descr from case2action c2a left join officeexptype of on of.id = c2a.officeexptypeid where c2a.id = ca.id)
else pt.descr
end as Type,
ca.actiontypeid as actiontypeid,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, date_format(ca.duration,'%H:%i') as duration, st.descr as status, ca.notes as Notes, ca.cost as Cost
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join cases c on ca.caseid=c.id
left join person p on p.id = ca.personid
left join person p1 on cp.personid = p1.id
left join proceduretypes pt on pt.id = ca.proceduretypeid
left join users u on u.id = ca.userid
left join status st on st.id = ca.statusid
where ca.isdeleted = 0 and ca.statusid = $var12 and (ca.actionstartdate between $datefrom and $dateto) $var13 $var28
group by ca.id
order by $var11")
or die("SELECT Error: ".mysql_error());

$num_rows = mysql_num_rows($result);

$total = mysql_query( "SELECT sum(CASE WHEN ca.actiontypeid = 3 THEN (ca.cost)*-1 ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 1 THEN (ca.cost) ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 2 THEN (ca.cost) ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 4 THEN (ca.cost) ELSE 0 END) AS total
FROM case2action ca
where ca.isdeleted = 0 and ca.statusid = $var12 and (ca.actionstartdate between $datefrom and $dateto) $var13 $var28")
or die("SELECT Error: ".mysql_error());

$sum_total = mysql_fetch_row($total);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Task Description</th>";
if($var15 == '1')
{
echo"<th>Task Type</th>";
}
if($var16 == '1')
{
echo"<th>Associated Person</th>";
}
if($var17 == '1')
{
echo"<th>Matter</th>";
}
if($var18 == '1')
{
echo"<th>Date</th>";
}
if($var19 == '1')
{
echo"<th>Time</th>";
}
if($var20 == '1')
{
echo"<th>Duration</th>";
}
if($var21 == '1')
{
echo"<th>Status</th>";
}
if($var22 == '1')
{
echo"<th>User</th>";
}
if($var23 == '1')
{
echo"<th>Notes</th>";
}
echo"<th>Cost</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
if($row['actiontypeid'] ==  '2')
  {
echo "<td><a href='updateexpense1.php?tid=" . $row['Code'] . "'><font color='#C11B17'>".$row['Name']."</font></a></td>";
  }
if($row['actiontypeid'] ==  '3')
  {
  echo "<td><a href='updateincome1.php?tid=" . $row['Code'] . "'><font color='#347235'>".$row['Name']."</font></a></td>";
  }
if($row['actiontypeid'] == '1')
  {
 echo "<td><a href='updatetask3.php?tid=" . $row['Code'] . "'>".$row['Name']."</a></td>";
  }
if($row['actiontypeid'] == '4')
  {
 echo "<td><a href='updateofficeexpense1.php?tid=" . $row['Code'] . "'><font color='#2554C7'>".$row['Name']."</font></a></td>";
  }
if($var15 == '1')
{
  echo "<td>". $row['Type'] ."</td>";
}
if($var16 == '1')
{
  echo "<td>". $row['Person'] ."</td>";
}
if($var17 == '1')
{
  echo "<td>" . $row['Matter'] . "</td>";
}
if($var18 == '1')
{
  echo "<td>" . $row['actionstartdate'] . "</td>";
}
if($var19 == '1')
{
  echo "<td>" . $row['actionstarttime'] . "</td>";
}
if($var20 == '1')
{
  echo "<td>" . $row['duration'] . "</td>";
}
if($var21 == '1')
{
  echo "<td>" . $row['status'] . "</td>";
}
if($var22 == '1')
{
  echo "<td>" . $row['username'] . "</td>";
}
if($var23 == '1')
{
  echo "<td>" . $row['Notes'] . "</td>";
}
if($row['actiontypeid'] ==  '2')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#C11B17'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
if($row['actiontypeid'] ==  '3')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#347235'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
if($row['actiontypeid'] ==  '1')
  {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\">".number_format($row['Cost'], 2, '.', '')."&#8364;</a></td>";
  }
if($row['actiontypeid'] ==  '4')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#2554C7'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
  echo "<td><a href='deletebill1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Bill</a></td>";
  echo "</tr>";
}
  echo "<tr>";
  echo "<td><font color='#990000' size='3'>Total Sum</font></td>";
if($var15 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var16 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var17 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var18 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var19 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var20 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var21 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var22 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var23 == '1')
{
  echo "<td>&nbsp;</td>";
}
  echo "<td><font color='#990000' size='3'>".number_format($sum_total[0], 2, '.', '')."&#8364;</font></td>";
  echo "<td>&nbsp;</td>";
  echo "</tr>";
echo "</table>";

}
else
//Option 26
if($var3 != "" && $var10 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name,
case when ca.personid is not null then p.descr
when cp.personid is not null then group_concat(p1.descr separator '<br />')
end as Person,
case when
ca.caseid is null then 'Matter no exist'
else c.descr
end as Matter,
case when ca.actiontypeid = 2 then 'Expense'
when ca.actiontypeid = 3 then 'Income'
when ca.actiontypeid = 4 then (select of.descr from case2action c2a left join officeexptype of on of.id = c2a.officeexptypeid where c2a.id = ca.id)
else pt.descr
end as Type,
ca.actiontypeid as actiontypeid,
ca.caseid as cid, date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, date_format(ca.duration,'%H:%i') as duration, st.descr as status, ca.notes as Notes, ca.cost as Cost
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join cases c on ca.caseid=c.id
left join person p on p.id = ca.personid
left join person p1 on cp.personid = p1.id
left join proceduretypes pt on pt.id = ca.proceduretypeid
left join users u on u.id = ca.userid
left join status st on st.id = ca.statusid
where ca.isdeleted = 0 and ca.statusid = $var12 and (ca.actionstartdate between $datefrom and $dateto) and  ca.caseid=$var3 $var13 $var28
group by ca.id
order by $var11")
or die("SELECT Error: ".mysql_error());

$num_rows = mysql_num_rows($result);

$total = mysql_query( "SELECT sum(CASE WHEN ca.actiontypeid = 3 THEN (ca.cost)*-1 ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 1 THEN (ca.cost) ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 2 THEN (ca.cost) ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 4 THEN (ca.cost) ELSE 0 END) AS total
FROM case2action ca
where ca.isdeleted = 0 and ca.statusid = $var12 and (ca.actionstartdate between $datefrom and $dateto) and  ca.caseid=$var3 $var13 $var28")
or die("SELECT Error: ".mysql_error());

$sum_total = mysql_fetch_row($total);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Task Description</th>";
if($var15 == '1')
{
echo"<th>Task Type</th>";
}
if($var16 == '1')
{
echo"<th>Associated Person</th>";
}
if($var17 == '1')
{
echo"<th>Matter</th>";
}
if($var18 == '1')
{
echo"<th>Date</th>";
}
if($var19 == '1')
{
echo"<th>Time</th>";
}
if($var20 == '1')
{
echo"<th>Duration</th>";
}
if($var21 == '1')
{
echo"<th>Status</th>";
}
if($var22 == '1')
{
echo"<th>User</th>";
}
if($var23 == '1')
{
echo"<th>Notes</th>";
}
echo"<th>Cost</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
if($row['actiontypeid'] ==  '2')
  {
echo "<td><a href='updateexpense1.php?tid=" . $row['Code'] . "'><font color='#C11B17'>".$row['Name']."</font></a></td>";
  }
if($row['actiontypeid'] ==  '3')
  {
  echo "<td><a href='updateincome1.php?tid=" . $row['Code'] . "'><font color='#347235'>".$row['Name']."</font></a></td>";
  }
if($row['actiontypeid'] == '1')
  {
 echo "<td><a href='updatetask3.php?tid=" . $row['Code'] . "'>".$row['Name']."</a></td>";
  }
if($row['actiontypeid'] == '4')
  {
 echo "<td><a href='updateofficeexpense1.php?tid=" . $row['Code'] . "'><font color='#2554C7'>".$row['Name']."</font></a></td>";
  }
if($var15 == '1')
{
  echo "<td>". $row['Type'] ."</td>";
}
if($var16 == '1')
{
  echo "<td>". $row['Person'] ."</td>";
}
if($var17 == '1')
{
  echo "<td>" . $row['Matter'] . "</td>";
}
if($var18 == '1')
{
  echo "<td>" . $row['actionstartdate'] . "</td>";
}
if($var19 == '1')
{
  echo "<td>" . $row['actionstarttime'] . "</td>";
}
if($var20 == '1')
{
  echo "<td>" . $row['duration'] . "</td>";
}
if($var21 == '1')
{
  echo "<td>" . $row['status'] . "</td>";
}
if($var22 == '1')
{
  echo "<td>" . $row['username'] . "</td>";
}
if($var23 == '1')
{
  echo "<td>" . $row['Notes'] . "</td>";
}
if($row['actiontypeid'] ==  '2')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#C11B17'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
if($row['actiontypeid'] ==  '3')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#347235'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
if($row['actiontypeid'] ==  '1')
  {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\">".number_format($row['Cost'], 2, '.', '')."&#8364;</a></td>";
  }
if($row['actiontypeid'] ==  '4')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#2554C7'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
  echo "<td><a href='deletebill1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Bill</a></td>";
  echo "</tr>";
}
  echo "<tr>";
  echo "<td><font color='#990000' size='3'>Total Sum</font></td>";
if($var15 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var16 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var17 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var18 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var19 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var20 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var21 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var22 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var23 == '1')
{
  echo "<td>&nbsp;</td>";
}
  echo "<td><font color='#990000' size='3'>".number_format($sum_total[0], 2, '.', '')."&#8364;</font></td>";
  echo "<td>&nbsp;</td>";
  echo "</tr>";
echo "</table>";

}
// Option 27
else
if($var3 == "" && $var10 != "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, ca.proceduretypeid as prid,
case when ca.personid is not null then p.descr
when cp.personid is not null then group_concat(p1.descr separator '<br />')
end as Person,
case when
ca.caseid is null then 'Matter no exist'
else c.descr
end as Matter,
case when ca.actiontypeid = 2 then 'Expense'
when ca.actiontypeid = 3 then 'Income'
when ca.actiontypeid = 4 then (select of.descr from case2action c2a left join officeexptype of on of.id = c2a.officeexptypeid where c2a.id = ca.id)
else pt.descr
end as Type,
ca.actiontypeid as actiontypeid,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, date_format(ca.duration,'%H:%i') as duration, st.descr as status, ca.notes as Notes, ca.cost as Cost
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join cases c on ca.caseid=c.id
left join person p on p.id = ca.personid
left join person p1 on cp.personid = p1.id
left join proceduretypes pt on pt.id = ca.proceduretypeid
left join users u on u.id = ca.userid
left join status st on st.id = ca.statusid
where ca.isdeleted = 0 and ca.statusid = $var12 and (ca.actionstartdate between $datefrom and $dateto) and ca.proceduretypeid=$var10 $var13 $var28
group by ca.id
order by $var11")
or die("SELECT Error: ".mysql_error());

$num_rows = mysql_num_rows($result);

$total = mysql_query( "SELECT sum(CASE WHEN ca.actiontypeid = 3 THEN (ca.cost)*-1 ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 1 THEN (ca.cost) ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 2 THEN (ca.cost) ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 4 THEN (ca.cost) ELSE 0 END) AS total
FROM case2action ca
where ca.isdeleted = 0 and ca.statusid = $var12 and (ca.actionstartdate between $datefrom and $dateto) and ca.proceduretypeid=$var10 $var13 $var28")
or die("SELECT Error: ".mysql_error());

$sum_total = mysql_fetch_row($total);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Task Description</th>";
if($var15 == '1')
{
echo"<th>Task Type</th>";
}
if($var16 == '1')
{
echo"<th>Associated Person</th>";
}
if($var17 == '1')
{
echo"<th>Matter</th>";
}
if($var18 == '1')
{
echo"<th>Date</th>";
}
if($var19 == '1')
{
echo"<th>Time</th>";
}
if($var20 == '1')
{
echo"<th>Duration</th>";
}
if($var21 == '1')
{
echo"<th>Status</th>";
}
if($var22 == '1')
{
echo"<th>User</th>";
}
if($var23 == '1')
{
echo"<th>Notes</th>";
}
echo"<th>Cost</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
if($row['actiontypeid'] ==  '2')
  {
echo "<td><a href='updateexpense1.php?tid=" . $row['Code'] . "'><font color='#C11B17'>".$row['Name']."</font></a></td>";
  }
if($row['actiontypeid'] ==  '3')
  {
  echo "<td><a href='updateincome1.php?tid=" . $row['Code'] . "'><font color='#347235'>".$row['Name']."</font></a></td>";
  }
if($row['actiontypeid'] == '1')
  {
 echo "<td><a href='updatetask3.php?tid=" . $row['Code'] . "'>".$row['Name']."</a></td>";
  }
if($row['actiontypeid'] == '4')
  {
 echo "<td><a href='updateofficeexpense1.php?tid=" . $row['Code'] . "'><font color='#2554C7'>".$row['Name']."</font></a></td>";
  }
if($var15 == '1')
{
  echo "<td>". $row['Type'] ."</td>";
}
if($var16 == '1')
{
  echo "<td>". $row['Person'] ."</td>";
}
if($var17 == '1')
{
  echo "<td>" . $row['Matter'] . "</td>";
}
if($var18 == '1')
{
  echo "<td>" . $row['actionstartdate'] . "</td>";
}
if($var19 == '1')
{
  echo "<td>" . $row['actionstarttime'] . "</td>";
}
if($var20 == '1')
{
  echo "<td>" . $row['duration'] . "</td>";
}
if($var21 == '1')
{
  echo "<td>" . $row['status'] . "</td>";
}
if($var22 == '1')
{
  echo "<td>" . $row['username'] . "</td>";
}
if($var23 == '1')
{
  echo "<td>" . $row['Notes'] . "</td>";
}
if($row['actiontypeid'] ==  '2')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#C11B17'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
if($row['actiontypeid'] ==  '3')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#347235'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
if($row['actiontypeid'] ==  '1')
  {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\">".number_format($row['Cost'], 2, '.', '')."&#8364;</a></td>";
  }
if($row['actiontypeid'] ==  '4')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#2554C7'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
  echo "<td><a href='deletebill1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Bill</a></td>";
  echo "</tr>";
}
  echo "<tr>";
  echo "<td><font color='#990000' size='3'>Total Sum</font></td>";
if($var15 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var16 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var17 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var18 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var19 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var20 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var21 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var22 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var23 == '1')
{
  echo "<td>&nbsp;</td>";
}
  echo "<td><font color='#990000' size='3'>".number_format($sum_total[0], 2, '.', '')."&#8364;</font></td>";
  echo "<td>&nbsp;</td>";
  echo "</tr>";
echo "</table>";

}
// Option 28
else
if($var3 != "" && $var10 != "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, ca.proceduretypeid as prid,
case when ca.personid is not null then p.descr
when cp.personid is not null then group_concat(p1.descr separator '<br />')
end as Person,
case when
ca.caseid is null then 'Matter no exist'
else c.descr
end as Matter,
case when ca.actiontypeid = 2 then 'Expense'
when ca.actiontypeid = 3 then 'Income'
when ca.actiontypeid = 4 then (select of.descr from case2action c2a left join officeexptype of on of.id = c2a.officeexptypeid where c2a.id = ca.id)
else pt.descr
end as Type,
ca.actiontypeid as actiontypeid,
ca.caseid as cid, date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, date_format(ca.duration,'%H:%i') as duration, st.descr as status, ca.notes as Notes, ca.cost as Cost
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join cases c on ca.caseid=c.id
left join person p on p.id = ca.personid
left join person p1 on cp.personid = p1.id
left join proceduretypes pt on pt.id = ca.proceduretypeid
left join users u on u.id = ca.userid
left join status st on st.id = ca.statusid
where ca.isdeleted = 0 and ca.statusid = $var12 and (ca.actionstartdate between $datefrom and $dateto) and ca.caseid=$var3 and ca.proceduretypeid=$var10 $var13 $var28
group by ca.id
order by $var11")
or die("SELECT Error: ".mysql_error());

$num_rows = mysql_num_rows($result);

$total = mysql_query( "SELECT sum(CASE WHEN ca.actiontypeid = 3 THEN (ca.cost)*-1 ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 1 THEN (ca.cost) ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 2 THEN (ca.cost) ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 4 THEN (ca.cost) ELSE 0 END) AS total
FROM case2action ca
where ca.isdeleted = 0 and ca.statusid = $var12 and (ca.actionstartdate between $datefrom and $dateto) and ca.caseid=$var3 and ca.proceduretypeid=$var10 $var13 $var28")
or die("SELECT Error: ".mysql_error());

$sum_total = mysql_fetch_row($total);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Task Description</th>";
if($var15 == '1')
{
echo"<th>Task Type</th>";
}
if($var16 == '1')
{
echo"<th>Associated Person</th>";
}
if($var17 == '1')
{
echo"<th>Matter</th>";
}
if($var18 == '1')
{
echo"<th>Date</th>";
}
if($var19 == '1')
{
echo"<th>Time</th>";
}
if($var20 == '1')
{
echo"<th>Duration</th>";
}
if($var21 == '1')
{
echo"<th>Status</th>";
}
if($var22 == '1')
{
echo"<th>User</th>";
}
if($var23 == '1')
{
echo"<th>Notes</th>";
}
echo"<th>Cost</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
if($row['actiontypeid'] ==  '2')
  {
echo "<td><a href='updateexpense1.php?tid=" . $row['Code'] . "'><font color='#C11B17'>".$row['Name']."</font></a></td>";
  }
if($row['actiontypeid'] ==  '3')
  {
  echo "<td><a href='updateincome1.php?tid=" . $row['Code'] . "'><font color='#347235'>".$row['Name']."</font></a></td>";
  }
if($row['actiontypeid'] == '1')
  {
 echo "<td><a href='updatetask3.php?tid=" . $row['Code'] . "'>".$row['Name']."</a></td>";
  }
if($row['actiontypeid'] == '4')
  {
 echo "<td><a href='updateofficeexpense1.php?tid=" . $row['Code'] . "'><font color='#2554C7'>".$row['Name']."</font></a></td>";
  }
if($var15 == '1')
{
  echo "<td>". $row['Type'] ."</td>";
}
if($var16 == '1')
{
  echo "<td>". $row['Person'] ."</td>";
}
if($var17 == '1')
{
  echo "<td>" . $row['Matter'] . "</td>";
}
if($var18 == '1')
{
  echo "<td>" . $row['actionstartdate'] . "</td>";
}
if($var19 == '1')
{
  echo "<td>" . $row['actionstarttime'] . "</td>";
}
if($var20 == '1')
{
  echo "<td>" . $row['duration'] . "</td>";
}
if($var21 == '1')
{
  echo "<td>" . $row['status'] . "</td>";
}
if($var22 == '1')
{
  echo "<td>" . $row['username'] . "</td>";
}
if($var23 == '1')
{
  echo "<td>" . $row['Notes'] . "</td>";
}
if($row['actiontypeid'] ==  '2')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#C11B17'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
if($row['actiontypeid'] ==  '3')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#347235'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
if($row['actiontypeid'] ==  '1')
  {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\">".number_format($row['Cost'], 2, '.', '')."&#8364;</a></td>";
  }
if($row['actiontypeid'] ==  '4')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#2554C7'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
  echo "<td><a href='deletebill1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Bill</a></td>";
  echo "</tr>";
}
  echo "<tr>";
  echo "<td><font color='#990000' size='3'>Total Sum</font></td>";
if($var15 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var16 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var17 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var18 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var19 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var20 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var21 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var22 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var23 == '1')
{
  echo "<td>&nbsp;</td>";
}
  echo "<td><font color='#990000' size='3'>".number_format($sum_total[0], 2, '.', '')."&#8364;</font></td>";
  echo "<td>&nbsp;</td>";
  echo "</tr>";
echo "</table>";

}
}
//Option 29
else
if($var2 != "")
{
if($var3 == "" && $var10 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name,
case when ca.personid is not null then p.descr
when cp.personid is not null then group_concat(p1.descr separator '<br />')
end as Person,
case when
ca.caseid is null then 'Matter no exist'
else c.descr
end as Matter,
case when ca.actiontypeid = 2 then 'Expense'
when ca.actiontypeid = 3 then 'Income'
when ca.actiontypeid = 4 then (select of.descr from case2action c2a left join officeexptype of on of.id = c2a.officeexptypeid where c2a.id = ca.id)
else pt.descr
end as Type,
ca.actiontypeid as actiontypeid,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, date_format(ca.duration,'%H:%i') as duration, st.descr as status, ca.notes as Notes, ca.cost as Cost
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join cases c on ca.caseid=c.id
left join person p on p.id = ca.personid
left join person p1 on cp.personid = p1.id
left join proceduretypes pt on pt.id = ca.proceduretypeid
left join users u on u.id = ca.userid
left join status st on st.id = ca.statusid
where ca.isdeleted = 0 and ca.statusid = $var12 and (ca.actionstartdate between $datefrom and $dateto) and (ca.personid = $var2 or cp.personid = $var2) $var13 $var28
group by ca.id
order by $var11")
or die("SELECT Error: ".mysql_error());

$num_rows = mysql_num_rows($result);

$total = mysql_query( "SELECT sum(CASE WHEN ca.actiontypeid = 3 THEN (ca.cost)*-1 ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 1 THEN (ca.cost) ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 2 THEN (ca.cost) ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 4 THEN (ca.cost) ELSE 0 END) AS total
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
where ca.isdeleted = 0 and ca.statusid = $var12 and (ca.actionstartdate between $datefrom and $dateto) and (ca.personid = $var2 or cp.personid = $var2) $var13 $var28")
or die("SELECT Error: ".mysql_error());

$sum_total = mysql_fetch_row($total);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Task Description</th>";
if($var15 == '1')
{
echo"<th>Task Type</th>";
}
if($var16 == '1')
{
echo"<th>Associated Person</th>";
}
if($var17 == '1')
{
echo"<th>Matter</th>";
}
if($var18 == '1')
{
echo"<th>Date</th>";
}
if($var19 == '1')
{
echo"<th>Time</th>";
}
if($var20 == '1')
{
echo"<th>Duration</th>";
}
if($var21 == '1')
{
echo"<th>Status</th>";
}
if($var22 == '1')
{
echo"<th>User</th>";
}
if($var23 == '1')
{
echo"<th>Notes</th>";
}
echo"<th>Cost</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
if($row['actiontypeid'] ==  '2')
  {
echo "<td><a href='updateexpense1.php?tid=" . $row['Code'] . "'><font color='#C11B17'>".$row['Name']."</font></a></td>";
  }
if($row['actiontypeid'] ==  '3')
  {
  echo "<td><a href='updateincome1.php?tid=" . $row['Code'] . "'><font color='#347235'>".$row['Name']."</font></a></td>";
  }
if($row['actiontypeid'] == '1')
  {
 echo "<td><a href='updatetask3.php?tid=" . $row['Code'] . "'>".$row['Name']."</a></td>";
  }
if($row['actiontypeid'] == '4')
  {
 echo "<td><a href='updateofficeexpense1.php?tid=" . $row['Code'] . "'><font color='#2554C7'>".$row['Name']."</font></a></td>";
  }
if($var15 == '1')
{
  echo "<td>". $row['Type'] ."</td>";
}
if($var16 == '1')
{
  echo "<td>". $row['Person'] ."</td>";
}
if($var17 == '1')
{
  echo "<td>" . $row['Matter'] . "</td>";
}
if($var18 == '1')
{
  echo "<td>" . $row['actionstartdate'] . "</td>";
}
if($var19 == '1')
{
  echo "<td>" . $row['actionstarttime'] . "</td>";
}
if($var20 == '1')
{
  echo "<td>" . $row['duration'] . "</td>";
}
if($var21 == '1')
{
  echo "<td>" . $row['status'] . "</td>";
}
if($var22 == '1')
{
  echo "<td>" . $row['username'] . "</td>";
}
if($var23 == '1')
{
  echo "<td>" . $row['Notes'] . "</td>";
}
if($row['actiontypeid'] ==  '2')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#C11B17'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
if($row['actiontypeid'] ==  '3')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#347235'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
if($row['actiontypeid'] ==  '1')
  {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\">".number_format($row['Cost'], 2, '.', '')."&#8364;</a></td>";
  }
if($row['actiontypeid'] ==  '4')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#2554C7'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
  echo "<td><a href='deletebill1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Bill</a></td>";
  echo "</tr>";
}
  echo "<tr>";
  echo "<td><font color='#990000' size='3'>Total Sum</font></td>";
if($var15 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var16 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var17 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var18 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var19 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var20 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var21 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var22 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var23 == '1')
{
  echo "<td>&nbsp;</td>";
}
  echo "<td><font color='#990000' size='3'>".number_format($sum_total[0], 2, '.', '')."&#8364;</font></td>";
  echo "<td>&nbsp;</td>";
  echo "</tr>";
echo "</table>";

}
else
//Option 30
if($var3 != "" && $var10 == "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name,
case when ca.personid is not null then p.descr
when cp.personid is not null then group_concat(p1.descr separator '<br />')
end as Person,
case when
ca.caseid is null then 'Matter no exist'
else c.descr
end as Matter,
case when ca.actiontypeid = 2 then 'Expense'
when ca.actiontypeid = 3 then 'Income'
when ca.actiontypeid = 4 then (select of.descr from case2action c2a left join officeexptype of on of.id = c2a.officeexptypeid where c2a.id = ca.id)
else pt.descr
end as Type,
ca.actiontypeid as actiontypeid,
ca.caseid as cid, date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, date_format(ca.duration,'%H:%i') as duration, st.descr as status, ca.notes as Notes, ca.cost as Cost
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join cases c on ca.caseid=c.id
left join person p on p.id = ca.personid
left join person p1 on cp.personid = p1.id
left join proceduretypes pt on pt.id = ca.proceduretypeid
left join users u on u.id = ca.userid
left join status st on st.id = ca.statusid
where ca.isdeleted = 0 and ca.statusid = $var12 and (ca.actionstartdate between $datefrom and $dateto) and (ca.personid = $var2 or cp.personid = $var2) and ca.caseid=$var3 $var13 $var28
group by ca.id
order by $var11")
or die("SELECT Error: ".mysql_error());

$num_rows = mysql_num_rows($result);

$total = mysql_query( "SELECT sum(CASE WHEN ca.actiontypeid = 3 THEN (ca.cost)*-1 ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 1 THEN (ca.cost) ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 2 THEN (ca.cost) ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 4 THEN (ca.cost) ELSE 0 END) AS total
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
where ca.isdeleted = 0 and ca.statusid = $var12 and (ca.actionstartdate between $datefrom and $dateto) and (ca.personid = $var2 or cp.personid = $var2) and ca.caseid=$var3 $var13 $var28")
or die("SELECT Error: ".mysql_error());

$sum_total = mysql_fetch_row($total);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Task Description</th>";
if($var15 == '1')
{
echo"<th>Task Type</th>";
}
if($var16 == '1')
{
echo"<th>Associated Person</th>";
}
if($var17 == '1')
{
echo"<th>Matter</th>";
}
if($var18 == '1')
{
echo"<th>Date</th>";
}
if($var19 == '1')
{
echo"<th>Time</th>";
}
if($var20 == '1')
{
echo"<th>Duration</th>";
}
if($var21 == '1')
{
echo"<th>Status</th>";
}
if($var22 == '1')
{
echo"<th>User</th>";
}
if($var23 == '1')
{
echo"<th>Notes</th>";
}
echo"<th>Cost</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
if($row['actiontypeid'] ==  '2')
  {
echo "<td><a href='updateexpense1.php?tid=" . $row['Code'] . "'><font color='#C11B17'>".$row['Name']."</font></a></td>";
  }
if($row['actiontypeid'] ==  '3')
  {
  echo "<td><a href='updateincome1.php?tid=" . $row['Code'] . "'><font color='#347235'>".$row['Name']."</font></a></td>";
  }
if($row['actiontypeid'] == '1')
  {
 echo "<td><a href='updatetask3.php?tid=" . $row['Code'] . "'>".$row['Name']."</a></td>";
  }
if($row['actiontypeid'] == '4')
  {
 echo "<td><a href='updateofficeexpense1.php?tid=" . $row['Code'] . "'><font color='#2554C7'>".$row['Name']."</font></a></td>";
  }
if($var15 == '1')
{
  echo "<td>". $row['Type'] ."</td>";
}
if($var16 == '1')
{
  echo "<td>". $row['Person'] ."</td>";
}
if($var17 == '1')
{
  echo "<td>" . $row['Matter'] . "</td>";
}
if($var18 == '1')
{
  echo "<td>" . $row['actionstartdate'] . "</td>";
}
if($var19 == '1')
{
  echo "<td>" . $row['actionstarttime'] . "</td>";
}
if($var20 == '1')
{
  echo "<td>" . $row['duration'] . "</td>";
}
if($var21 == '1')
{
  echo "<td>" . $row['status'] . "</td>";
}
if($var22 == '1')
{
  echo "<td>" . $row['username'] . "</td>";
}
if($var23 == '1')
{
  echo "<td>" . $row['Notes'] . "</td>";
}
if($row['actiontypeid'] ==  '2')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#C11B17'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
if($row['actiontypeid'] ==  '3')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#347235'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
if($row['actiontypeid'] ==  '1')
  {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\">".number_format($row['Cost'], 2, '.', '')."&#8364;</a></td>";
  }
if($row['actiontypeid'] ==  '4')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#2554C7'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
  echo "<td><a href='deletebill1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Bill</a></td>";
  echo "</tr>";
}
  echo "<tr>";
  echo "<td><font color='#990000' size='3'>Total Sum</font></td>";
if($var15 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var16 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var17 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var18 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var19 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var20 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var21 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var22 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var23 == '1')
{
  echo "<td>&nbsp;</td>";
}
  echo "<td><font color='#990000' size='3'>".number_format($sum_total[0], 2, '.', '')."&#8364;</font></td>";
  echo "<td>&nbsp;</td>";
  echo "</tr>";
echo "</table>";

}
// Option 31
else
if($var3 == "" && $var10 != "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, ca.proceduretypeid as prid,
case when ca.personid is not null then p.descr
when cp.personid is not null then group_concat(p1.descr separator '<br />')
end as Person,
case when
ca.caseid is null then 'Matter no exist'
else c.descr
end as Matter,
case when ca.actiontypeid = 2 then 'Expense'
when ca.actiontypeid = 3 then 'Income'
when ca.actiontypeid = 4 then (select of.descr from case2action c2a left join officeexptype of on of.id = c2a.officeexptypeid where c2a.id = ca.id)
else pt.descr
end as Type,
ca.actiontypeid as actiontypeid,
date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, date_format(ca.duration,'%H:%i') as duration, st.descr as status, ca.notes as Notes, ca.cost as Cost
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join cases c on ca.caseid=c.id
left join person p on p.id = ca.personid
left join person p1 on cp.personid = p1.id
left join proceduretypes pt on pt.id = ca.proceduretypeid
left join users u on u.id = ca.userid
left join status st on st.id = ca.statusid
where ca.isdeleted = 0 and ca.statusid = $var12 and (ca.actionstartdate between $datefrom and $dateto) and (ca.personid = $var2 or cp.personid = $var2) and ca.proceduretypeid=$var10 $var13 $var28
group by ca.id
order by $var11")
or die("SELECT Error: ".mysql_error());

$num_rows = mysql_num_rows($result);

$total = mysql_query( "SELECT sum(CASE WHEN ca.actiontypeid = 3 THEN (ca.cost)*-1 ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 1 THEN (ca.cost) ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 2 THEN (ca.cost) ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 4 THEN (ca.cost) ELSE 0 END) AS total
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
where ca.isdeleted = 0 and ca.statusid = $var12 and (ca.actionstartdate between $datefrom and $dateto) and (ca.personid = $var2 or cp.personid = $var2) and ca.proceduretypeid=$var10 $var13 $var28")
or die("SELECT Error: ".mysql_error());

$sum_total = mysql_fetch_row($total);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Task Description</th>";
if($var15 == '1')
{
echo"<th>Task Type</th>";
}
if($var16 == '1')
{
echo"<th>Associated Person</th>";
}
if($var17 == '1')
{
echo"<th>Matter</th>";
}
if($var18 == '1')
{
echo"<th>Date</th>";
}
if($var19 == '1')
{
echo"<th>Time</th>";
}
if($var20 == '1')
{
echo"<th>Duration</th>";
}
if($var21 == '1')
{
echo"<th>Status</th>";
}
if($var22 == '1')
{
echo"<th>User</th>";
}
if($var23 == '1')
{
echo"<th>Notes</th>";
}
echo"<th>Cost</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
if($row['actiontypeid'] ==  '2')
  {
echo "<td><a href='updateexpense1.php?tid=" . $row['Code'] . "'><font color='#C11B17'>".$row['Name']."</font></a></td>";
  }
if($row['actiontypeid'] ==  '3')
  {
  echo "<td><a href='updateincome1.php?tid=" . $row['Code'] . "'><font color='#347235'>".$row['Name']."</font></a></td>";
  }
if($row['actiontypeid'] == '1')
  {
 echo "<td><a href='updatetask3.php?tid=" . $row['Code'] . "'>".$row['Name']."</a></td>";
  }
if($row['actiontypeid'] == '4')
  {
 echo "<td><a href='updateofficeexpense1.php?tid=" . $row['Code'] . "'><font color='#2554C7'>".$row['Name']."</font></a></td>";
  }
if($var15 == '1')
{
  echo "<td>". $row['Type'] ."</td>";
}
if($var16 == '1')
{
  echo "<td>". $row['Person'] ."</td>";
}
if($var17 == '1')
{
  echo "<td>" . $row['Matter'] . "</td>";
}
if($var18 == '1')
{
  echo "<td>" . $row['actionstartdate'] . "</td>";
}
if($var19 == '1')
{
  echo "<td>" . $row['actionstarttime'] . "</td>";
}
if($var20 == '1')
{
  echo "<td>" . $row['duration'] . "</td>";
}
if($var21 == '1')
{
  echo "<td>" . $row['status'] . "</td>";
}
if($var22 == '1')
{
  echo "<td>" . $row['username'] . "</td>";
}
if($var23 == '1')
{
  echo "<td>" . $row['Notes'] . "</td>";
}
if($row['actiontypeid'] ==  '2')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#C11B17'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
if($row['actiontypeid'] ==  '3')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#347235'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
if($row['actiontypeid'] ==  '1')
  {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\">".number_format($row['Cost'], 2, '.', '')."&#8364;</a></td>";
  }
if($row['actiontypeid'] ==  '4')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#2554C7'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
  echo "<td><a href='deletebill1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Bill</a></td>";
  echo "</tr>";
}
  echo "<tr>";
  echo "<td><font color='#990000' size='3'>Total Sum</font></td>";
if($var15 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var16 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var17 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var18 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var19 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var20 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var21 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var22 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var23 == '1')
{
  echo "<td>&nbsp;</td>";
}
  echo "<td><font color='#990000' size='3'>".number_format($sum_total[0], 2, '.', '')."&#8364;</font></td>";
  echo "<td>&nbsp;</td>";
  echo "</tr>";
echo "</table>";

}
// Option 32
else
if($var3 != "" && $var10 != "")
{
  $result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, ca.proceduretypeid as prid,
case when ca.personid is not null then p.descr
when cp.personid is not null then group_concat(p1.descr separator '<br />')
end as Person,
case when
ca.caseid is null then 'Matter no exist'
else c.descr
end as Matter,
case when ca.actiontypeid = 2 then 'Expense'
when ca.actiontypeid = 3 then 'Income'
when ca.actiontypeid = 4 then (select of.descr from case2action c2a left join officeexptype of on of.id = c2a.officeexptypeid where c2a.id = ca.id)
else pt.descr
end as Type,
ca.actiontypeid as actiontypeid,
ca.caseid as cid, date_format(ca.actionstartdate,'%d-%m-%Y') as actionstartdate, date_format(ca.actionstartdate,'%H:%i') as actionstarttime, u.full_name as username, date_format(ca.duration,'%H:%i') as duration, st.descr as status, ca.notes as Notes, ca.cost as Cost
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join cases c on ca.caseid=c.id
left join person p on p.id = ca.personid
left join person p1 on cp.personid = p1.id
left join proceduretypes pt on pt.id = ca.proceduretypeid
left join users u on u.id = ca.userid
left join status st on st.id = ca.statusid
where ca.isdeleted = 0 and ca.statusid = $var12 and (ca.actionstartdate between $datefrom and $dateto)  and (ca.personid = $var2 or cp.personid = $var2) and ca.caseid=$var3 and ca.proceduretypeid=$var10 $var13 $var28
group by ca.id
order by $var11")
or die("SELECT Error: ".mysql_error());

$num_rows = mysql_num_rows($result);

$total = mysql_query( "SELECT sum(CASE WHEN ca.actiontypeid = 3 THEN (ca.cost)*-1 ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 1 THEN (ca.cost) ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 2 THEN (ca.cost) ELSE 0 END)
+ sum(CASE WHEN ca.actiontypeid = 4 THEN (ca.cost) ELSE 0 END) AS total
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
where ca.isdeleted = 0 and ca.statusid = $var12 and (ca.actionstartdate between $datefrom and $dateto)  and (ca.personid = $var2 or cp.personid = $var2) and ca.caseid=$var3 and ca.proceduretypeid=$var10 $var13 $var28")
or die("SELECT Error: ".mysql_error());

$sum_total = mysql_fetch_row($total);

print "$num_rows records.";

echo"<table class='tableWithFloatingHeader'>
<thead>
<tr>
<th>Task Description</th>";
if($var15 == '1')
{
echo"<th>Task Type</th>";
}
if($var16 == '1')
{
echo"<th>Associated Person</th>";
}
if($var17 == '1')
{
echo"<th>Matter</th>";
}
if($var18 == '1')
{
echo"<th>Date</th>";
}
if($var19 == '1')
{
echo"<th>Time</th>";
}
if($var20 == '1')
{
echo"<th>Duration</th>";
}
if($var21 == '1')
{
echo"<th>Status</th>";
}
if($var22 == '1')
{
echo"<th>User</th>";
}
if($var23 == '1')
{
echo"<th>Notes</th>";
}
echo"<th>Cost</th>
<th>Delete</th>
</tr>
</thead>";
while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
if($row['actiontypeid'] ==  '2')
  {
echo "<td><a href='updateexpense1.php?tid=" . $row['Code'] . "'><font color='#C11B17'>".$row['Name']."</font></a></td>";
  }
if($row['actiontypeid'] ==  '3')
  {
  echo "<td><a href='updateincome1.php?tid=" . $row['Code'] . "'><font color='#347235'>".$row['Name']."</font></a></td>";
  }
if($row['actiontypeid'] == '1')
  {
 echo "<td><a href='updatetask3.php?tid=" . $row['Code'] . "'>".$row['Name']."</a></td>";
  }
if($row['actiontypeid'] == '4')
  {
 echo "<td><a href='updateofficeexpense1.php?tid=" . $row['Code'] . "'><font color='#2554C7'>".$row['Name']."</font></a></td>";
  }
if($var15 == '1')
{
  echo "<td>". $row['Type'] ."</td>";
}
if($var16 == '1')
{
  echo "<td>". $row['Person'] ."</td>";
}
if($var17 == '1')
{
  echo "<td>" . $row['Matter'] . "</td>";
}
if($var18 == '1')
{
  echo "<td>" . $row['actionstartdate'] . "</td>";
}
if($var19 == '1')
{
  echo "<td>" . $row['actionstarttime'] . "</td>";
}
if($var20 == '1')
{
  echo "<td>" . $row['duration'] . "</td>";
}
if($var21 == '1')
{
  echo "<td>" . $row['status'] . "</td>";
}
if($var22 == '1')
{
  echo "<td>" . $row['username'] . "</td>";
}
if($var23 == '1')
{
  echo "<td>" . $row['Notes'] . "</td>";
}
if($row['actiontypeid'] ==  '2')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#C11B17'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
if($row['actiontypeid'] ==  '3')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#347235'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
if($row['actiontypeid'] ==  '1')
  {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\">".number_format($row['Cost'], 2, '.', '')."&#8364;</a></td>";
  }
if($row['actiontypeid'] ==  '4')
   {
  echo "<td align='right'><a href='javascript: void(0)' onclick=\"popup('updatebill1.php?tid=".$row['Code']."');\"><font color='#2554C7'>".number_format($row['Cost'], 2, '.', '')."&#8364;</font></a></td>";
   }
  echo "<td><a href='deletebill1.php?q=".$row['Code']."' onclick='return confirmDelete();'>Delete Bill</a></td>";
  echo "</tr>";
}
  echo "<tr>";
  echo "<td><font color='#990000' size='3'>Total Sum</font></td>";
if($var15 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var16 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var17 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var18 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var19 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var20 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var21 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var22 == '1')
{
  echo "<td>&nbsp;</td>";
}
if($var23 == '1')
{
  echo "<td>&nbsp;</td>";
}
  echo "<td><font color='#990000' size='3'>".number_format($sum_total[0], 2, '.', '')."&#8364;</font></td>";
  echo "<td>&nbsp;</td>";
  echo "</tr>";
echo "</table>";

}
}
}
}
?>
<p><a href="billing.php">Return to Billing Options</a></p>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>
</body>
</html>
