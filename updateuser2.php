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

$id=$_POST['id'];
$full_name=$_POST['full_name'];
$user_name=$_POST['user_name'];
$user_email=$_POST['user_email'];
$country=$_POST['country'];
$lite=$_POST['lite'];

require "config.php";

$query=mysql_query("SELECT id, full_name, user_name, user_email, joined, country, user_activated FROM users WHERE id =$id");
$row=mysql_fetch_array($query);
$formVars = array();

//update user details if it needed
if ($full_name != $row['full_name'])
{
$query1=mysql_query("UPDATE users SET full_name = '$full_name' WHERE id =$id ") or die("UPDATE1 users Error: ".mysql_error()); /*contacts is the name of the MySQL table where the form data will be saved.
name and email are the respective table fields*/
}
if ($user_name != $row['user_name'])
{
$query2=mysql_query("UPDATE users SET user_name = '$user_name' WHERE id =$id ") or die("UPDATE2 users Error: ".mysql_error()); /*contacts is the name of the MySQL table where the form data will be saved.
name and email are the respective table fields*/
}
if ($user_email != $row['user_email'])
{
$query3=mysql_query("UPDATE users SET user_email = '$user_email' WHERE id =$id ") or die("UPDATE3 users Error: ".mysql_error()); /*contacts is the name of the MySQL table where the form data will be saved.
name and email are the respective table fields*/
}
if ($country != $row['country'])
{
$query4=mysql_query("UPDATE users SET country = '$country' WHERE id =$id ") or die("UPDATE4 users Error: ".mysql_error()); /*contacts is the name of the MySQL table where the form data will be saved.
name and email are the respective table fields*/
}
if ($lite != $row['user_activated'])
{
$query4=mysql_query("UPDATE users SET user_activated = '$lite' WHERE id =$id ") or die("UPDATE5 users Error: ".mysql_error()); /*contacts is the name of the MySQL table where the form data will be saved.
name and email are the respective table fields*/
}

echo "The form data was successfully added to your database.";
mysql_close();
?>