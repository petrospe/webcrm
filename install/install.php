<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>
Installation
</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="../images/favicon.ico" />
<style>
body,a { font-family: Georgia, serif; font-size: 18px; font-weight: 600; text-align: center; background-color:#c4c4c4; color: #3a3a3a; line-height: 200%;}
</style>
</head>
<body>
<?php

/*
 * Restore MySQL dump using PHP
 */
  
// Name of the file
$filename = 'a904abMS.sql';
// MySQL host
$mysql_host = ($_POST['servername']);
// Root user
$mysql_rootname = ($_POST['rootname']);
// Root password
$mysql_rootpasswd = ($_POST['rootpasswd']);
// MySQL username
$mysql_username = ($_POST['username']);
// MySQL password
$mysql_password = ($_POST['passwd']);
// Database name
$mysql_database = ($_POST['database']);

if (!empty($_POST['rootname'])) {
// Create connection
$conn = new mysqli($mysql_host, $mysql_rootname, $mysql_rootpasswd);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
// Create database
$createuser = "CREATE USER " .$mysql_username."@" .$mysql_host." IDENTIFIED BY '" .$mysql_password."'";
$createdb = "CREATE DATABASE IF NOT EXISTS " .$mysql_database;
$grantdb = "GRANT ALL ON " .$mysql_database.". * TO " .$mysql_username."@" .$mysql_host;
if ($conn->query($createuser) === TRUE) {
    echo "User created successfully. ";
    if ($conn->query($createdb) === TRUE) {
        echo "Database created successfully. ";
        if ($conn->query($grantdb) === TRUE) {
            echo "Permissions granted successfully. ";
            } else {
            echo "Permissions query failed " . $grantdb;
            exit();
            }
        } else {
        echo "Database query failed " . $createdb;
        exit();
        }
    } else {
    echo "User query failed " . $createuser;
    exit();
    }
        
$conn->close();
}
// Reconnect to MySQL server
$mysqli = new mysqli($mysql_host, $mysql_username, $mysql_password, $mysql_database) or die('Error connecting to MySQL server: ' . mysqli_error());

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
  }

// Drop the existing tables
$mysqli->query('SET foreign_key_checks = 0');
if ($result = $mysqli->query("SHOW TABLES"))
{
    while($row = $result->fetch_array(MYSQLI_NUM))
    {
        $mysqli->query('DROP TABLE IF EXISTS '.$row[0]);
    }
}

$mysqli->query('SET foreign_key_checks = 1');


// Insert sql data to database
// Temporary variable, used to store current query
$templine = '';
// Read in entire file
$lines = file($filename);
// Loop through each line
foreach ($lines as $line)
{
    // Skip it if it's a comment
    if (substr($line, 0, 2) == '--' || $line == '')
        continue;
 
    // Add this line to the current segment
    $templine .= $line;
    // If it has a semicolon at the end, it's the end of the query
    if (substr(trim($line), -1, 1) == ';')
    {
        // Perform the query
        mysqli_query($mysqli, $templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysqli_error() . '<br /><br />');
        // Reset temp variable to empty
        $templine = '';
    }
}

// Create config.php file
$connection = 'config.php';
$fp = fopen($connection, 'w') or die( 'Unable to open file!' );
$txt = "<?php\n";
fwrite($fp, $txt);
$txt = "\n";
fwrite($fp, $txt);
$txt = "\$servername='$mysql_host'; // Your MySql Server Name or IP address here\n";
fwrite($fp, $txt);
$txt = "\$dbusername='$mysql_username'; // Login user id here\n";
fwrite($fp, $txt);
$txt = "\$dbpassword='$mysql_password'; // Login password here\n";
fwrite($fp, $txt);
$txt = "\$dbname='$mysql_database'; // Your database name here\n";
fwrite($fp, $txt);
$txt = "\n";
fwrite($fp, $txt);
$txt = "connecttodb(\$servername,\$dbname,\$dbusername,\$dbpassword);\n";
fwrite($fp, $txt);
$txt = "function connecttodb(\$servername,\$dbname,\$dbuser,\$dbpassword)\n";
fwrite($fp, $txt);
$txt = "{\n";
fwrite($fp, $txt);
$txt = "global \$link;\n";
fwrite($fp, $txt);
$txt = "\$link=mysql_connect (\"\$servername\",\"\$dbuser\",\"\$dbpassword\");\n";
fwrite($fp, $txt);
$txt = "if(!\$link){die(\"Could not connect to MySQL\");\n";
fwrite($fp, $txt);
$txt = "}\n";
fwrite($fp, $txt);
$txt = "mysql_select_db(\"\$dbname\",\$link) or die (\"could not open db\".mysql_error());\n";
fwrite($fp, $txt);
$txt = "mysql_query(\"SET NAMES 'utf8'\");\n";
fwrite($fp, $txt);
$txt = "}\n";
fwrite($fp, $txt);
$txt = "\n";
fwrite($fp, $txt);
$txt = "//permissions\n";
fwrite($fp, $txt);
$txt = "if (isset(\$_SESSION['userid'])) {\n";
fwrite($fp, $txt);
$txt = "\$user_id=\$_SESSION['userid'];\n";
fwrite($fp, $txt);
$txt = "\$permission=mysql_query(\"SELECT permit FROM useraccess WHERE userid = '\$user_id'\") or die(\"SELECT Error: \".mysql_error());\n";
fwrite($fp, $txt);
$txt = "}\n";
fwrite($fp, $txt);
$txt = "?>";
fwrite($fp, $txt);
fclose($fp);
chmod($connection, 0777);

$mysqli->close();

echo 'Installation complete<br/>';
echo 'Move the <span style="color:#c00000">config.php</span> into root directory<br/>';
echo 'Now it is safe to Delete the install folder<br/>';
echo 'Go to <a href="../"" style="color:#c00000">Login</a>';
?>
</body>
</html>