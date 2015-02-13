<?php
session_start();
if (!isset($_SESSION['user']))
{
header("Location: login.php");
}
?>
<meta HTTP-EQUIV="REFRESH" content="0; url=adminsettings.php">
<?php

require "config.php";

//person table entries
$tasktypename=mysql_real_escape_string($_POST['tasktypename']); //This value has to be the same as in the HTML form file
$inttasktypename=mysql_real_escape_string($_POST['inttasktypename']); //This value has to be the same as in the HTML form file
$extrafield1=mysql_real_escape_string($_POST['extrafield1']); //This value has to be the same as in the HTML form file
$queryfield1=mysql_real_escape_string($_POST['queryfield1']); //This value has to be the same as in the HTML form file
$extrafield2=mysql_real_escape_string($_POST['extrafield2']); //This value has to be the same as in the HTML form file
$queryfield2=mysql_real_escape_string($_POST['queryfield2']); //This value has to be the same as in the HTML form file
$extrafield3=mysql_real_escape_string($_POST['extrafield3']); //This value has to be the same as in the HTML form file
$queryfield3=mysql_real_escape_string($_POST['queryfield3']); //This value has to be the same as in the HTML form file
$extrafield4=mysql_real_escape_string($_POST['extrafield4']); //This value has to be the same as in the HTML form file
$queryfield4=mysql_real_escape_string($_POST['queryfield4']); //This value has to be the same as in the HTML form file
$extrafield5=mysql_real_escape_string($_POST['extrafield5']); //This value has to be the same as in the HTML form file
$queryfield5=mysql_real_escape_string($_POST['queryfield5']); //This value has to be the same as in the HTML form file
$queryfield6=mysql_real_escape_string($_POST['queryfield6']); //This value has to be the same as in the HTML form file
$extrafield6=mysql_real_escape_string($_POST['extrafield6']); //This value has to be the same as in the HTML form file
$queryfield7=mysql_real_escape_string($_POST['queryfield7']); //This value has to be the same as in the HTML form file
$extrafield7=mysql_real_escape_string($_POST['extrafield7']); //This value has to be the same as in the HTML form file
$queryfield8=mysql_real_escape_string($_POST['queryfield8']); //This value has to be the same as in the HTML form file
$extrafield8=mysql_real_escape_string($_POST['extrafield8']); //This value has to be the same as in the HTML form file
$queryfield9=mysql_real_escape_string($_POST['queryfield9']); //This value has to be the same as in the HTML form file
$extrafield9=mysql_real_escape_string($_POST['extrafield9']); //This value has to be the same as in the HTML form file
$queryfield10=mysql_real_escape_string($_POST['queryfield10']); //This value has to be the same as in the HTML form file
$extrafield10=mysql_real_escape_string($_POST['extrafield10']); //This value has to be the same as in the HTML form file

// check for an empty string and display a message.
  if ($tasktypename == "")
   {
   echo "<p><a href='inserttasktype.php' style='text-decoration: none;'>Please enter a Task Type Name ...</a></p>";
  exit;
   }

//first step insert
$sql=mysql_query("INSERT INTO proceduretypes (descr,en_descr,lbl_ef1,lbl_ef2,lbl_ef3,lbl_ef4,lbl_ef5,lbl_ef6,lbl_ef7,lbl_ef8,lbl_ef9,lbl_ef10,txt_ef1_sql,txt_ef2_sql,txt_ef3_sql,txt_ef4_sql,txt_ef5_sql,txt_ef6_sql,txt_ef7_sql,txt_ef8_sql,txt_ef9_sql,txt_ef10_sql) VALUES  ('$tasktypename','$inttasktypename','$extrafield1','$extrafield2','$extrafield3','$extrafield4','$extrafield5','$extrafield6','$extrafield7','$extrafield8','$extrafield9','$extrafield10','$queryfield1','$queryfield2','$queryfield3','$queryfield4','$queryfield5','$queryfield6','$queryfield7','$queryfield8','$queryfield9','$queryfield10')") or die("INSERT person Error: ".mysql_error()); /*contacts is the name of the MySQL table where the form data will be saved.
name and email are the respective table fields*/
  
echo "The form data was successfully added to your database.";
mysql_close();
?>