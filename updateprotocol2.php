<?php
session_start();
if (!isset($_SESSION['user']))
{
header("Location: login.php");
}
?>
<meta HTTP-EQUIV="REFRESH" content="0; url=protocol.php">
<?php
require "config.php";

//task table entries
$id=$_POST['id']; //This value has to be the same as in the HTML form file
$fromid=$_POST['personidfrom']; //This value has to be the same as in the HTML form file
$toid=$_POST['personidto']; //This value has to be the same as in the HTML form file
$caseid=$_POST['caseid']; //This value has to be the same as in the HTML form file
$day=$_POST['day']; //This value has to be the same as in the HTML form file
$month=$_POST['month']; //This value has to be the same as in the HTML form file
$year=$_POST['year']; //This value has to be the same as in the HTML form file
$hour=$_POST['hour']; //This value has to be the same as in the HTML form file
$minute=$_POST['minute']; //This value has to be the same as in the HTML form file
$actionstartdate=$year.$month.$day.$hour.$minute.'00'; //Action start date
$userid=$_SESSION['userid'];
$sendtypeid=$_POST['sendtypeid']; //This value has to be the same as in the HTML form file
$notes=$_POST['notes']; //This value has to be the same as in the HTML form file
$aacode=$_POST['aacode']; //This value has to be the same as in the HTML form file

//Check updated fields

$sql="SELECT ca.id as Code, ca.descr as Name, aacode as aacode, ca.sendtypeid as sndtypeid, ca.userid as userid,
case when p1.descr is null then 'Person no exist' else p1.descr end as personfrom, ca.fromid as person1id,
case when p2.descr is null then 'Person no exist' else p2.descr end as personto, ca.toid as person2id,
case when c.descr is null then 'Matter no exist' else c.descr end as matter, ca.caseid as matterid,
date_format(ca.actionstartdate,'%d') as taday, date_format(ca.actionstartdate,'%m') as tamonth, date_format(ca.actionstartdate,'%Y') as tayear, date_format(ca.actionstartdate,'%H') as tahour, date_format(ca.actionstartdate,'%i') as taminute, u.full_name as username, ca.notes as Notes, ca.pinout as pinout,
case when st.descr is null then 'Unknown' else st.descr end as sendtype
FROM case2action ca
left join cases c on ca.caseid=c.id
left join person p1 on p1.id = ca.fromid
left join person p2 on p2.id = ca.toid
left join sendtype st on st.id = ca.sendtypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.id=$id
group by ca.id";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$formVars = array();

if($userid != $row['userid'])
{
$sql1=mysql_query("UPDATE case2action set userid = $userid WHERE id = $id") or die("UPDATE1 Error: ".mysql_error());
}
if($caseid != $row['matterid'])
{
$sql2=mysql_query("UPDATE case2action set caseid = $caseid WHERE id = $id") or die("UPDATE2 Error: ".mysql_error());
}
if ($day != $row['taday'] || $month != $row['tamonth'] || $year != $row['tayear'] || $hour != $row['tahour'] || $minute != $row['taminute'])
{
$sql3=mysql_query("UPDATE case2action set actionstartdate =  '$actionstartdate' WHERE id = $id") or die("UPDATE3 Error: ".mysql_error());
}
if ($notes != $row['Notes'])
{
$sql4=mysql_query("UPDATE case2action set notes = '$notes' WHERE id = $id") or die("UPDATE4 Error: ".mysql_error());
}
if ($fromid != $row['person1id'])
{
$sql5=mysql_query("UPDATE case2action set fromid = $fromid WHERE id = $id") or die("UPDATE5 Error: ".mysql_error());
}
if ($toid != $row['person2id'])
{
$sql6=mysql_query("UPDATE case2action set toid = $toid WHERE id = $id") or die("UPDATE6 Error: ".mysql_error());
}
if ($sendtypeid != $row['sndtypeid'])
{
$sql7=mysql_query("UPDATE case2action set sendtypeid = $sendtypeid WHERE id = $id") or die("UPDATE7 Error: ".mysql_error());
}
if ($aacode != $row['aacode'])
{
$sql8=mysql_query("UPDATE case2action set aacode = '$aacode' WHERE id = $id") or die("UPDATE8 Error: ".mysql_error());
}
echo "The form data was successfully added to your database.";
mysql_close();
?>