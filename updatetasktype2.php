<?php
session_start();
if (!isset($_SESSION['user']))
{
header("Location: login.php");
}
?>
<meta HTTP-EQUIV="REFRESH" content="0; url=adminsettings.php">
<?php
error_reporting(E_ALL);
 ini_set("display_errors",1);

require "config.php";

//person table entries
$tasktypename=$_POST['tasktypename']; //This value has to be the same as in the HTML form file
$inttasktypename=$_POST['inttasktypename']; //This value has to be the same as in the HTML form file
$extrafield1=$_POST['extrafield1']; //This value has to be the same as in the HTML form file
$queryfield1=$_POST['queryfield1']; //This value has to be the same as in the HTML form file
$extrafield2=$_POST['extrafield2']; //This value has to be the same as in the HTML form file
$queryfield2=$_POST['queryfield2']; //This value has to be the same as in the HTML form file
$extrafield3=$_POST['extrafield3']; //This value has to be the same as in the HTML form file
$queryfield3=$_POST['queryfield3']; //This value has to be the same as in the HTML form file
$extrafield4=$_POST['extrafield4']; //This value has to be the same as in the HTML form file
$queryfield4=$_POST['queryfield4']; //This value has to be the same as in the HTML form file
$extrafield5=$_POST['extrafield5']; //This value has to be the same as in the HTML form file
$queryfield5=$_POST['queryfield5']; //This value has to be the same as in the HTML form file
$queryfield6=$_POST['queryfield6']; //This value has to be the same as in the HTML form file
$extrafield6=$_POST['extrafield6']; //This value has to be the same as in the HTML form file
$queryfield7=$_POST['queryfield7']; //This value has to be the same as in the HTML form file
$extrafield7=$_POST['extrafield7']; //This value has to be the same as in the HTML form file
$queryfield8=$_POST['queryfield8']; //This value has to be the same as in the HTML form file
$extrafield8=$_POST['extrafield8']; //This value has to be the same as in the HTML form file
$queryfield9=$_POST['queryfield9']; //This value has to be the same as in the HTML form file
$extrafield9=$_POST['extrafield9']; //This value has to be the same as in the HTML form file
$queryfield10=$_POST['queryfield10']; //This value has to be the same as in the HTML form file
$extrafield10=$_POST['extrafield10']; //This value has to be the same as in the HTML form file
$id=$_POST['id']; //This value has to be the same as in the HTML form file

// check for an empty string and display a message.
  if ($tasktypename == "")
   {
   echo "<p><a  href='inserttasktype.php' style='text-decoration: none;'>Please  enter a Task Type Name ...</a></p>";
  exit;
   }
  
 //select update row before
$result=mysql_query("SELECT  id, descr, en_descr, lbl_ef1, lbl_ef2, lbl_ef3, lbl_ef4, lbl_ef5,  lbl_ef6, lbl_ef7, lbl_ef8, lbl_ef9, lbl_ef10, txt_ef1_sql, txt_ef2_sql,  txt_ef3_sql, txt_ef4_sql, txt_ef5_sql, txt_ef6_sql, txt_ef7_sql,  txt_ef8_sql, txt_ef9_sql, txt_ef10_sql FROM proceduretypes WHERE id =  $id") or die("SELECT Error: ".mysql_error()); /*contacts is the name of the MySQL table where the form data will be saved.
name and email are the respective table fields*/
 
$row=mysql_fetch_array($result);
  
//update section
if ($tasktypename != $row['descr'])
{
  $update1=mysql_query("UPDATE proceduretypes SET descr = '$tasktypename' WHERE id = $id") or die("UPDATE Error: ".mysql_error()); /*contacts is the name of the MySQL table where the form data will be saved.
name and email are the respective table fields*/
}
if ($inttasktypename != $row['en_descr'])
{
  $update2=mysql_query("UPDATE proceduretypes SET en_descr = '$inttasktypename' WHERE id = $id") or die("UPDATE Error: ".mysql_error()); /*contacts is the name of the MySQL table where the form data will be saved.
 name and email are the respective table fields*/
}
if ($extrafield1 != $row['lbl_ef1'])
{
  $updateextra1=mysql_query("UPDATE proceduretypes SET lbl_ef1 = '$extrafield1' WHERE id = $id") or die("UPDATE Error: ".mysql_error()); /*contacts is the name of the MySQL table where the form data will be saved.
name and email are the respective table fields*/
}
if ($extrafield2 != $row['lbl_ef2'])
{
  $updateextra2=mysql_query("UPDATE proceduretypes SET lbl_ef2 = '$extrafield2' WHERE id = $id") or die("UPDATE Error: ".mysql_error()); /*contacts is the name of the MySQL table where the form data will be saved.
 name and email are the respective table fields*/
}
if ($extrafield3 != $row['lbl_ef3'])
 {
   $updateextra3=mysql_query("UPDATE proceduretypes SET lbl_ef3 = '$extrafield3' WHERE id = $id") or die("UPDATE Error: ".mysql_error()); /*contacts is the name of the MySQL table where the form data will be saved.
 name and email are the respective table fields*/
 }  
if ($extrafield4 != $row['lbl_ef4'])
 {
   $updateextra4=mysql_query("UPDATE proceduretypes SET lbl_ef4 = '$extrafield4' WHERE id = $id") or die("UPDATE Error: ".mysql_error()); /*contacts is the name of the MySQL table where the form data will be saved.
 name and email are the respective table fields*/
 }  
if ($extrafield5 != $row['lbl_ef5'])
 {
   $updateextra5=mysql_query("UPDATE proceduretypes SET lbl_ef5 = '$extrafield5' WHERE id = $id") or die("UPDATE Error: ".mysql_error()); /*contacts is the name of the MySQL table where the form data will be saved.
 name and email are the respective table fields*/
 }  
if ($extrafield6 != $row['lbl_ef6'])
 {
   $updateextra6=mysql_query("UPDATE proceduretypes SET lbl_ef6 = '$extrafield6' WHERE id = $id") or die("UPDATE Error: ".mysql_error()); /*contacts is the name of the MySQL table where the form data will be saved.
 name and email are the respective table fields*/
 }  
if ($extrafield7 != $row['lbl_ef7'])
 {
   $updateextra7=mysql_query("UPDATE proceduretypes SET lbl_ef7 = '$extrafield7' WHERE id = $id") or die("UPDATE Error: ".mysql_error()); /*contacts is the name of the MySQL table where the form data will be saved.
 name and email are the respective table fields*/
 }  
if ($extrafield8 != $row['lbl_ef8'])
 {
   $updateextra8=mysql_query("UPDATE proceduretypes SET lbl_ef8 = '$extrafield8' WHERE id = $id") or die("UPDATE Error: ".mysql_error()); /*contacts is the name of the MySQL table where the form data will be saved.
 name and email are the respective table fields*/
 }  
if ($extrafield9 != $row['lbl_ef9'])
 {
   $updateextra9=mysql_query("UPDATE proceduretypes SET lbl_ef9 = '$extrafield9' WHERE id = $id") or die("UPDATE Error: ".mysql_error()); /*contacts is the name of the MySQL table where the form data will be saved.
 name and email are the respective table fields*/
 }  
if ($extrafield10 != $row['lbl_ef10'])
 {
   $updateextra10=mysql_query("UPDATE proceduretypes SET lbl_ef10 = '$extrafield10' WHERE id = $id") or die("UPDATE Error: ".mysql_error()); /*contacts is the name of the MySQL table where the form data will be saved.
 name and email are the respective table fields*/
 }  
if ($queryfield1 != $row['txt_ef1_sql'])
 {
   $updatequery1=mysql_query("UPDATE proceduretypes SET txt_ef1_sql = '$queryfield1' WHERE id = $id") or die("UPDATE Error: ".mysql_error()); /*contacts is the name of the MySQL table where the form data will be saved.
 name and email are the respective table fields*/
 }  
if ($queryfield2 != $row['txt_ef2_sql'])
  {
    $updatequery2=mysql_query("UPDATE proceduretypes SET txt_ef2_sql = '$queryfield2' WHERE id = $id") or die("UPDATE Error: ".mysql_error()); /*contacts is the name of the MySQL table where the form data will be saved.
  name and email are the respective table fields*/
  }    
if ($queryfield3 != $row['txt_ef3_sql'])
  {
    $updatequery3=mysql_query("UPDATE proceduretypes SET txt_ef3_sql = '$queryfield3' WHERE id = $id") or die("UPDATE Error: ".mysql_error()); /*contacts is the name of the MySQL table where the form data will be saved.
  name and email are the respective table fields*/
  }    
if ($queryfield4 != $row['txt_ef4_sql'])
  {
    $updatequery4=mysql_query("UPDATE proceduretypes SET txt_ef4_sql = '$queryfield4' WHERE id = $id") or die("UPDATE Error: ".mysql_error()); /*contacts is the name of the MySQL table where the form data will be saved.
  name and email are the respective table fields*/
  }
if ($queryfield5 != $row['txt_ef5_sql'])
  {
    $updatequery5=mysql_query("UPDATE proceduretypes SET txt_ef5_sql = '$queryfield5' WHERE id = $id") or die("UPDATE Error: ".mysql_error()); /*contacts is the name of the MySQL table where the form data will be saved.
  name and email are the respective table fields*/
  }  
if ($queryfield6 != $row['txt_ef6_sql'])
  {
    $updatequery6=mysql_query("UPDATE proceduretypes SET txt_ef6_sql = '$queryfield6' WHERE id = $id") or die("UPDATE Error: ".mysql_error()); /*contacts is the name of the MySQL table where the form data will be saved.
  name and email are the respective table fields*/
  }  
if ($queryfield7 != $row['txt_ef7_sql'])
  {
    $updatequery7=mysql_query("UPDATE proceduretypes SET txt_ef7_sql = '$queryfield7' WHERE id = $id") or die("UPDATE Error: ".mysql_error()); /*contacts is the name of the MySQL table where the form data will be saved.
  name and email are the respective table fields*/
  }    
if ($queryfield8 != $row['txt_ef8_sql'])
  {
    $updatequery8=mysql_query("UPDATE proceduretypes SET txt_ef8_sql = '$queryfield8' WHERE id = $id") or die("UPDATE Error: ".mysql_error()); /*contacts is the name of the MySQL table where the form data will be saved.
  name and email are the respective table fields*/
  }    
if ($queryfield9 != $row['txt_ef9_sql'])
  {
    $updatequery9=mysql_query("UPDATE proceduretypes SET txt_ef9_sql = '$queryfield9' WHERE id = $id") or die("UPDATE Error: ".mysql_error()); /*contacts is the name of the MySQL table where the form data will be saved.
  name and email are the respective table fields*/
  }    
if ($queryfield10 != $row['txt_ef10_sql'])
  {
    $updatequery10=mysql_query("UPDATE proceduretypes SET txt_ef10_sql = '$queryfield10' WHERE id = $id") or die("UPDATE Error: ".mysql_error()); /*contacts is the name of the MySQL table where the form data will be saved.
  name and email are the respective table fields*/
  }

echo "The form data was successfully added to your database.";
mysql_close();
?>