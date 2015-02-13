<?php
session_start();
if (!isset($_SESSION['user']))
{
header("Location: login.php");
}
?>
<meta HTTP-EQUIV="REFRESH" content="0; url=files.php">
<?php

require "config.php";

//file table entries

$fileName = $_FILES['path']['name'];
$tmpName  = $_FILES['path']['tmp_name'];
$fileSize = $_FILES['path']['size'];
$fileType = $_FILES['path']['type'];

$fp      = fopen($tmpName, 'r');
$content = fread($fp, filesize($tmpName));
$content = addslashes($content);
fclose($fp);

if(!get_magic_quotes_gpc())
{
    $fileName = addslashes($fileName);
}
$MAX_FILE_SIZE=$_POST['MAX_FILE_SIZE']; //This value has to be the same as in the HTML form file
$personid=$_POST['personid']; //This value has to be the same as in the HTML form file
$caseid=$_POST['caseid']; //This value has to be the same as in the HTML form file
$SetType=$_POST['action']; //This value has to be the same as in the HTML form file
$lite=$_POST['lite']; //This value has to be the same as in the HTML form file
$descr=$_POST['descr']; //This value has to be the same as in the HTML form file
$userid=$_SESSION['userid'];
$entryid=md5(uniqid()); // a random 32 digits code is generated

// check for an empty string and display a message.
if ($fileSize  >= $MAX_FILE_SIZE)
  {
  echo "<p><a href='javascript:' onclick='history.go(-1); return false' style='text-decoration: none;'>Upload not permitted. File larger than 2Mb</a></p>";
  exit;
  }

if ($caseid != "")
{
if ($descr == "")
{
$descr = $fileName;

//insert to document
$sql1=mysql_query("INSERT INTO document (descr,createdate,content,userid,doctypeid,caseid,entryid,istemplate,isdeleted,filename,filetype,filesize) VALUES ('$descr',NOW(),'$content','$userid','$SetType','$caseid','$entryid','$lite',0,'$fileName','$fileType','$fileSize')") or die("INSERT cases Error: ".mysql_error()); /*contacts is the name of the MySQL table where the form data will be saved.
name and email are the respective table fields*/
}
else if ($descr != "")
{
//insert to document
$sql2=mysql_query("INSERT INTO document (descr,createdate,content,userid,doctypeid,caseid,entryid,istemplate,isdeleted,filename,filetype,filesize) VALUES ('$descr',NOW(),'$content','$userid','$SetType','$caserid','$entryid','$lite',0,'$fileName','$fileType','$fileSize')") or die("INSERT cases Error: ".mysql_error()); /*contacts is the name of the MySQL table where the form data will be saved.
name and email are the respective table fields*/
}
}
if ($caseid == "")
{
if ($descr == "")
{
$descr = $fileName;

//insert to document
$sql1=mysql_query("INSERT INTO document (descr,createdate,content,userid,doctypeid,personid,entryid,istemplate,isdeleted,filename,filetype,filesize) VALUES ('$descr',NOW(),'$content','$userid','$SetType','$personid','$entryid','$lite',0,'$fileName','$fileType','$fileSize')") or die("INSERT cases Error: ".mysql_error()); /*contacts is the name of the MySQL table where the form data will be saved.
name and email are the respective table fields*/
}
else if ($descr != "")
{
//insert to document
$sql2=mysql_query("INSERT INTO document (descr,createdate,content,userid,doctypeid,personid,entryid,istemplate,isdeleted,filename,filetype,filesize) VALUES ('$descr',NOW(),'$content','$userid','$SetType','$personid','$entryid','$lite',0,'$fileName','$fileType','$fileSize')") or die("INSERT cases Error: ".mysql_error()); /*contacts is the name of the MySQL table where the form data will be saved.
name and email are the respective table fields*/
}
}

echo "The form data was successfully added to your database.";
mysql_close();
?>