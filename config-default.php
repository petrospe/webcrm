<?php

$servername='localhost'; // Your MySql Server Name or IP address here
$dbusername='c384i1B28EHm'; // Login user id here
$dbpassword='5q86EA2g297G'; // Login password here
$dbname='a904abMS'; // Your database name here

connecttodb($servername,$dbname,$dbusername,$dbpassword);
function connecttodb($servername,$dbname,$dbuser,$dbpassword)
{
global $link;
$link=mysql_connect ("$servername","$dbuser","$dbpassword");
if(!$link){die("Could not connect to MySQL");
}
mysql_select_db("$dbname",$link) or die ("could not open db".mysql_error());
mysql_query("SET NAMES 'utf8'");
}

//permissions
if (isset($_SESSION['userid'])) {
$user_id=$_SESSION['userid'];
$permission=mysql_query("SELECT permit FROM useraccess WHERE userid = '$user_id'") or die("SELECT Error: ".mysql_error());
}
?>