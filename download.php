<?php
session_start();
if (!isset($_SESSION['user']))
{
header("Location: login.php");
}
?>
<?php
if(isset($_GET['did']))
{
// if id is set then get the file with the id from database

require "config.php";

$access=mysql_result($permission, 34);
if($access != "1")
{
echo "<p><a href='#' onClick='history.go(-1);' style='text-decoration:none'>Not permitted</a></p>";
exit;
}

$id    = $_GET['did'];
$query = "SELECT filename, filetype, filesize, content " .
         "FROM document WHERE id = '$id'";

$result = mysql_query($query) or die('Error, query failed');
list($filename, $filetype, $filesize, $content) =                                  mysql_fetch_array($result);

header("Content-length: $filesize");
header("Content-type: $filetype");
header("Content-Disposition: attachment; filename=$filename");
echo $content;

mysql_close;
exit;
}

?>