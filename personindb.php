<?php
session_start();
if (!isset($_SESSION['user']))
{
header("Location: login.php");
}
?>
<meta HTTP-EQUIV="REFRESH" content="0; url=person.php">
<?php

require "config.php";

//person table entries
$FullName=mysql_real_escape_string($_POST['FullName']); //This value has to be the same as in the HTML form file
$Street1=mysql_real_escape_string($_POST['Street1']); //This value has to be the same as in the HTML form file
$Occupation=mysql_real_escape_string($_POST['Occupation']); //This value has to be the same as in the HTML form file
$Company=mysql_real_escape_string($_POST['Company']); //This value has to be the same as in the HTML form file
$City1=mysql_real_escape_string($_POST['City1']); //This value has to be the same as in the HTML form file
$ZipCode1=mysql_real_escape_string($_POST['ZipCode1']); //This value has to be the same as in the HTML form file
$Phone1=mysql_real_escape_string($_POST['Phone1']); //This value has to be the same as in the HTML form file
$Phone2=mysql_real_escape_string($_POST['Phone2']); //This value has to be the same as in the HTML form file
$Cellphone=mysql_real_escape_string($_POST['Cellphone']); //This value has to be the same as in the HTML form file
$Fax=mysql_real_escape_string($_POST['Fax']); //This value has to be the same as in the HTML form file
$Street2=mysql_real_escape_string($_POST['Street2']); //This value has to be the same as in the HTML form file
$City2=mysql_real_escape_string($_POST['City2']); //This value has to be the same as in the HTML form file
$ZipCode2=mysql_real_escape_string($_POST['ZipCode2']); //This value has to be the same as in the HTML form file
$Phone3=mysql_real_escape_string($_POST['Phone3']); //This value has to be the same as in the HTML form file
$afm=mysql_real_escape_string($_POST['afm']); //This value has to be the same as in the HTML form file
$email=mysql_real_escape_string($_POST['email']); //This value has to be the same as in the HTML form file
$website=mysql_real_escape_string($_POST['website']); //This value has to be the same as in the HTML form file
$SetAttribute=mysql_real_escape_string($_POST['SetAttribute']); //This value has to be the same as in the HTML form file
$IC=mysql_real_escape_string($_POST['IC']); //This value has to be the same as in the HTML form file
$doyid=mysql_real_escape_string($_POST['doyid']); //This value has to be the same as in the HTML form file
$entryid=md5(uniqid()); // a random 32 digits code is generated 

//personnotes table entries
$Notes=mysql_real_escape_string($_POST['notes']); //This value has to be the same as in the HTML form file
$entrypnid=md5(uniqid()); // a random 32 digits code is generated 

//user
$userid=$_SESSION['userid'];

// check for an empty string and display a message.
if ($FullName == "")
  {
  echo "<p><a href='insertperson.php' style='text-decoration: none;'>Please enter a Person Name ...</a></p>";
  exit;
  }

//first step insert
$sql1=mysql_query("INSERT INTO person (descr,street1,occupation,company,city1,phone1, zipcode1, phone2,mobile,fax, street2, personextra1, personextra2,phone3,afm,email,website,attributeid,personextra3,doyid,entryid,lastupdate, isalmauser) VALUES ('$FullName','$Street1','$Occupation','$Company','$City1','$Phone1','$ZipCode1','$Phone2','$Cellphone','$Fax','$Street2','$City2','$ZipCode2','$Phone3','$afm','$email','$website','$SetAttribute','$IC','$doyid','$entryid',NOW(),'$userid')") or die("INSERT person Error: ".mysql_error()); /*contacts is the name of the MySQL table where the form data will be saved.
name and email are the respective table fields*/

// check for an empty string and display a message.
if ($Notes == "")
  {
  echo "The form data was successfully added to your database.
  <a href='person.php'>Back to Person's table</a>";
   exit;
  }
$id=mysql_insert_id();

//second insert notes
$sql2=mysql_query("INSERT INTO personnotes (personid, descr, entryid, insertdate, userid) values ('$id','$Notes','$entrypnid',NOW(),'$userid')") or die("INSERT notes Error: ".mysql_error());;

echo "The form data was successfully added to your database.";
mysql_close();
?>