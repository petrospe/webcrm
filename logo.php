<?php

require "config.php";
  
header('Content-type: image/jpeg'); 
   
$title=mysql_query("SELECT officelogo,logoname,logotype,logosize FROM settings WHERE id=1");
$row = mysql_fetch_array($title);
echo $row['officelogo'];

?>