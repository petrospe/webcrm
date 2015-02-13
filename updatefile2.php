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
$SetType=$_POST['action']; //This value has to be the same as in the HTML form file
$lite=$_POST['lite']; //This value has to be the same as in the HTML form file
$descr=$_POST['descr']; //This value has to be the same as in the HTML form file
$userid=$_SESSION['userid'];
$entryid=md5(uniqid()); // a random 32 digits code is generated
$fileid=$_POST['fileid']; //This value has to be the same as in the HTML form file

// check for an empty string and display a message.
if ($fileSize  >= $MAX_FILE_SIZE && $fileName != "")
  {
  echo "<p><a href='javascript:' onclick='history.go(-1); return false' style='text-decoration: none;'>Upload not permitted. File larger than 2Mb</a></p>";
  exit;
  }

//compare statements
 $result = mysql_query( "SELECT d.id as Code, d.descr as Description,
d.filename as Filename, d.content as Content, d.filesize as Filesize, d.filetype as Filetype, d.userid as username, d.doctypeid as Doctype,
d.personid as Person, d.caseid as Matter, d.istemplate as Template
FROM document d
WHERE d.isdeleted = 0 and d.id = $fileid") or die("SELECT Error: ".mysql_error());
$row = mysql_fetch_array($result);

if ($descr == "" && $fileName != "")
{
//update document
$sql1=mysql_query("UPDATE document set descr = '$fileName' WHERE id = $fileid") or die("UPDATE1 document Error: ".mysql_error()); /*contacts is the name of the MySQL table where the form data will be saved.
name and email are the respective table fields*/
}
if ($descr != $row['Description'] && $descr != "")
{
//update document
$sql2=mysql_query("UPDATE document set descr = '$descr' WHERE id = $fileid") or die("UPDATE2 document Error: ".mysql_error()); /*contacts is the name of the MySQL table where the form data will be saved.
name and email are the respective table fields*/
}
if ($SetType != $row['Doctype'])
{
//update document
$sql3=mysql_query("UPDATE document set doctypeid = '$SetType' WHERE id = $fileid") or die("UPDATE3 document Error: ".mysql_error()); /*contacts is the name of the MySQL table where the form data will be saved.
name and email are the respective table fields*/
}
if ($lite != $row['Template'])
{
//update document
$sql4=mysql_query("UPDATE document set istemplate = '$lite' WHERE id = $fileid") or die("UPDATE4 document Error: ".mysql_error()); /*contacts is the name of the MySQL table where the form data will be saved.
name and email are the respective table fields*/
}
if ($userid != $row['username'])
{
//update document
$sql5=mysql_query("UPDATE document set userid = $userid WHERE id = $fileid") or die("UPDATE5 document Error: ".mysql_error()); /*contacts is the name of the MySQL table where the form data will be saved.
name and email are the respective table fields*/
}
if ($fileName != "")
{
if ($fileSize != $row['Filesize'] || $fileName != $row['Filename'] || $fileType != $row['Filetype'])
{
$sql6=mysql_query("UPDATE document set content = '$content' WHERE id = $fileid") or die("UPDATE6 document Error: ".mysql_error()); /*contacts is the name of the MySQL table where the form data will be saved.
name and email are the respective table fields*/
$sql7=mysql_query("UPDATE document set filename = '$fileName' WHERE id = $fileid") or die("UPDATE7 document Error: ".mysql_error()); /*contacts is the name of the MySQL table where the form data will be saved.
name and email are the respective table fields*/
$sql8=mysql_query("UPDATE document set filesize = '$fileSize' WHERE id = $fileid") or die("UPDATE8 document Error: ".mysql_error()); /*contacts is the name of the MySQL table where the form data will be saved.
name and email are the respective table fields*/
$sql9=mysql_query("UPDATE document set filetype = '$fileType' WHERE id = $fileid") or die("UPDATE9 document Error: ".mysql_error()); /*contacts is the name of the MySQL table where the form data will be saved.
name and email are the respective table fields*/
}
}
if ($descr != $row['Description'] || $SetType != $row['Doctype'] || $fileName != "" || $userid != $row['username'] || $lite != $row['Template'])
{
//update document
$sql10=mysql_query("UPDATE document set modifydate = NOW() WHERE id = $fileid") or die("UPDATE10 document Error: ".mysql_error()); /*contacts is the name of the MySQL table where the form data will be saved.
name and email are the respective table fields*/
}
echo "The form data was successfully added to your database.";
mysql_close();
?>