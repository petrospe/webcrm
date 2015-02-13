<?php
session_start();
if (!isset($_SESSION['user']))
{
header("Location: login.php");
}
?>
<meta HTTP-EQUIV="REFRESH" content="0; url=person.php">
<?php

$name=$_POST['name'];
$attributeid=$_POST['attributeid'];
$occupation=$_POST['occupation'];
$company=$_POST['company'];
$street1=$_POST['street1'];
$city1=$_POST['city1'];
$zipcode1=$_POST['zipcode1'];
$phone1=$_POST['phone1'];
$phone2=$_POST['phone2'];
$mobile=$_POST['mobile'];
$fax=$_POST['fax'];
$afm=$_POST['afm'];
$email=$_POST['email'];
$website=$_POST['website'];
$notes=$_POST['notes'];
$street2=$_POST['street2'];
$city2=$_POST['city2'];
$zipcode2=$_POST['zipcode2'];
$phone3=$_POST['phone3'];
$IC=$_POST['IC'];
$doyid=$_POST['doyid'];
$ID=$_POST['ID'];
$entrypnid=md5(uniqid()); // a random 32 digits code is generated

//user
$userid=$_SESSION['userid'];

require "config.php";

$result = mysql_query( "SELECT p.descr as Name, p.attributeid as Attribute, p.occupation as Occupation, p.company as Company, p.street1 as Address, p.city1 as City, p.zipcode1 as TK, p.phone1 as Tel1, p.phone2 as Tel2, p.mobile as Cellphone, p.fax as Fax, pn.descr as notes, p.email as email, p.website as website, p.street2 as street2, p.personextra1 as city2, p.personextra2 as zipcode2, p.phone3 as phone3, p.afm as afm, p.personextra3 as IC, p.doyid as doy
FROM person p 
left join personnotes pn on pn.personid = p.id
where p.id =$ID")
or die("SELECT Error: ".mysql_error());
$row = mysql_fetch_array($result);

// check for changes on fields
if ($name != $row['Name'])
{
$query1=mysql_query("UPDATE person set descr = '$name' WHERE id = $ID") or die("UPDATE1 Error: ".mysql_error());
}
if ($attributeid != $row['Attribute'])
{
$query2=mysql_query("UPDATE person set attributeid = $attributeid WHERE id = $ID") or die("UPDATE2 Error: ".mysql_error());
}
if ($occupation != $row['Occupation'])
{
$query3=mysql_query("UPDATE person set occupation = '$occupation' WHERE id = $ID") or die("UPDATE3 Error: ".mysql_error());
}
if ($company != $row['Company'])
{
$query4=mysql_query("UPDATE person set company = '$company' WHERE id = $ID") or die("UPDATE4 Error: ".mysql_error());
}
if ($street1 != $row['Address'])
{
$query5=mysql_query("UPDATE person set street1 = '$street1' WHERE id = $ID") or die("UPDATE5 Error: ".mysql_error());
}
if ($city1 != $row['City'])
{
$query6=mysql_query("UPDATE person set city1 = '$city1' WHERE id = $ID") or die("UPDATE6 Error: ".mysql_error());
}
if ($zipcode1 != $row['TK'])
{
$query7=mysql_query("UPDATE person set zipcode1 = '$zipcode1' WHERE id = $ID") or die("UPDATE7 Error: ".mysql_error());
}
if ($phone1 != $row['Tel1'])
{
$query8=mysql_query("UPDATE person set phone1 = '$phone1' WHERE id = $ID") or die("UPDATE8 Error: ".mysql_error());
}
if ($phone2 != $row['Tel2'])
{
$query9=mysql_query("UPDATE person set phone2 = '$phone2' WHERE id = $ID") or die("UPDATE9 Error: ".mysql_error());
}
if ($mobile != $row['Cellphone'])
{
$query10=mysql_query("UPDATE person set mobile = '$mobile' WHERE id = $ID") or die("UPDATE10 Error: ".mysql_error());
}
if ($fax != $row['Fax'])
{
$query11=mysql_query("UPDATE person set fax = '$fax' WHERE id = $ID") or die("UPDATE11 Error: ".mysql_error());
}
if ($afm != $row['afm'])
{
$query12=mysql_query("UPDATE person set afm = '$afm' WHERE id = $ID") or die("UPDATE12 Error: ".mysql_error());
}
if ($email != $row['email'])
{
$query13=mysql_query("UPDATE person set email = '$email' WHERE id = $ID") or die("UPDATE13 Error: ".mysql_error());
}
if ($website != $row['website'])
{
$query14=mysql_query("UPDATE person set website = '$website' WHERE id = $ID") or die("UPDATE14 Error: ".mysql_error());
}
if ($notes == "" && $notes != $row['notes'])
{
$query15d=mysql_query("DELETE from personnotes WHERE personid = $ID") or die("DELETE15d Error: ".mysql_error());
}
if ($row['notes'] == "" && $notes != $row['notes'])
{
$query15=mysql_query("INSERT into personnotes (descr, personid, entryid, insertdate, lastupdate, userid) VALUES ('$notes', $ID, '$entrypnid', NOW(), NOW(), $userid)") or die("INSERT Error: ".mysql_error());
}
if ($notes != $row['notes'] && $row['notes'] != "")
{
$query15a=mysql_query("UPDATE personnotes set descr = '$notes' WHERE personid = $ID") or die("UPDATE15a Error: ".mysql_error());
$query15b=mysql_query("UPDATE personnotes set lastupdate = NOW() WHERE personid = $ID") or die("UPDATE15b Error: ".mysql_error());
$query15c=mysql_query("UPDATE personnotes set userid = $userid WHERE personid = $ID") or die("UPDATE15c Error: ".mysql_error());
}
if ($street2 != $row['street2'])
{
$query16=mysql_query("UPDATE person set street2 = '$street2' WHERE id = $ID") or die("UPDATE16 Error: ".mysql_error());
}
if ($city2 != $row['city2'])
{
$query17=mysql_query("UPDATE person set personextra1 = '$city2' WHERE id = $ID") or die("UPDATE17 Error: ".mysql_error());
}
if ($zipcode2 != $row['zipcode2'])
{
$query18=mysql_query("UPDATE person set personextra2 = '$zipcode2' WHERE id = $ID") or die("UPDATE18 Error: ".mysql_error());
}
if ($phone3 != $row['phone3'])
{
$query19=mysql_query("UPDATE person set phone3 = '$phone3' WHERE id = $ID") or die("UPDATE19 Error: ".mysql_error());
}
if ($IC != $row['IC'])
{
$query20=mysql_query("UPDATE person set personextra3 = '$IC' WHERE id = $ID") or die("UPDATE20 Error: ".mysql_error());
}
if ($doyid != $row['doy'])
{
$query21=mysql_query("UPDATE person set doyid = '$doyid' WHERE id = $ID") or die("UPDATE21 Error: ".mysql_error());
}
$query22=mysql_query("UPDATE person set lastupdate = NOW() WHERE id = $ID") or  die("UPDATE22 Error: ".mysql_error());
$query23=mysql_query("UPDATE person set isalmauser = $userid WHERE id = $ID") or  die("UPDATE23 Error: ".mysql_error());

echo "The data was successfully updated in your database.";
mysql_close();
?>