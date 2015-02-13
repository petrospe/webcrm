<?php
session_start();
if (!isset($_SESSION['user']))
{
header("Location: login.php");
}
?>
<?php
error_reporting(E_ALL);
 ini_set("display_errors",1);

require "config.php";

mysql_query("SET NAMES 'utf8'");

$result = mysql_query( "SELECT ca.id as Code, ca.descr as Name, pt.descr as Type,
case when ca.personid is not null then p.descr
when cp.personid is not null then group_concat(p1.descr separator '<br>')
end as Person,
case when
ca.caseid is null then 'Matter no exist'
else c.descr
end as Matter,ca.actionstartdate as actionstartdate, u.full_name as username, ADDTIME(ca.actionstartdate,(date_format(ca.duration,'%H:%i')))as endtime
FROM case2action ca
left join casetoperson cp on ca.caseid = cp.caseid
left join cases c on ca.caseid=c.id
left join person p on p.id = ca.personid
left join person p1 on cp.personid = p1.id
left join proceduretypes pt on pt.id = ca.proceduretypeid
left join users u on u.id = ca.userid
where ca.isdeleted = 0 and ca.actiontypeid = 1
group by ca.id
order by ca.actionstartdate desc");

$events = array();
while ($row = mysql_fetch_assoc($result)) {
$eventarray['id'] = $row['Code'];
$eventarray['title'] = $row['Name'];
$eventarray['start'] = $row['actionstartdate'];
$eventarray['end'] = $row['endtime'];
$eventarray['Person'] = $row['Person'];
$eventarray['url'] = "updatetask4.php?tid=$row[Code]";
$eventarray['allDay'] = false;
$events[] = $eventarray;
}
  echo json_encode($events);
?>
