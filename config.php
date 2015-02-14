<?php

$servername='localhost';     // Your MySql Server Name or IP address here
$dbusername='webcrmuser';                // Login user id here
$dbpassword='webcrmV2@';                // Login password here
$dbname='webcrmv2';     // Your database name here

connecttodb($servername,$dbname,$dbusername,$dbpassword);
function connecttodb($servername,$dbname,$dbuser,$dbpassword)
{
global $link;
$link=mysql_connect ("$servername","$dbuser","$dbpassword");
if(!$link){die("Could not connect to MySQL");}
mysql_select_db("$dbname",$link) or die ("could not open db".mysql_error());
mysql_query("SET NAMES 'utf8'");
}

//permissions
if (isset($_SESSION['userid'])) {
$user_id=$_SESSION['userid'];
$permission=mysql_query("SELECT permit FROM useraccess WHERE userid = '$user_id'") or die("SELECT Error: ".mysql_error());
}
?>