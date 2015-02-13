<?php
session_start();
if (!isset($_SESSION['user']))
{
  header("Location: login.php");
}
?>
<?php
  
require "config.php";

mysql_query("SET NAMES 'utf8'");

$descr=mysql_real_escape_string($_POST['title']);
$userid=$_SESSION['userid'];
$actionstartdate=$_POST['dt'];
$entryid=md5(uniqid()); // a random 32 digits code is generated
  
  if(isset($_POST['task'])) {
       switch($_POST['task']) {
       
       case 'create':
       mysql_query("INSERT INTO case2action (descr,userid,entryid,actionstartdate,actiontypeid,procedureid,calendar,duration) VALUES ('$descr', '$userid', '$entryid', '$actionstartdate', 1,1,1,'1980-01-01 02:00:00' )") or die("INSERT case2action Error: ".mysql_error());
       
       break;
       
       case 'update':
       mysql_query("UPDATE case2action SET actionstartdate = DATE_ADD(actionstartdate,INTERVAL ".$_POST['dayChange']." DAY) WHERE id=".$_POST['eventSent']['id']."");
       mysql_query("UPDATE case2action SET actionstartdate = DATE_ADD(actionstartdate,INTERVAL ".$_POST['timeChange']." MINUTE) WHERE id=".$_POST['eventSent']['id']."");

       break;
       
       case 'updateTime':
       
       mysql_query("UPDATE case2action SET duration = DATE_ADD(duration,INTERVAL ".$_POST['timeChange']." MINUTE) WHERE id=".$_POST['eventSent']['id']."");
         
       break;

      }
  }
