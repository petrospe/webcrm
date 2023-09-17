<?php

$envFilePath = __DIR__ . '/.env';

// Check if the .env file exists
if (file_exists($envFilePath)) {
    // Read the .env file and parse its contents
    $envContents = file_get_contents($envFilePath);
    $envVariables = preg_split('/\r\n|\r|\n/', $envContents);

    foreach ($envVariables as $envVariable) {
        // Split the line into key and value
        list($key, $value) = explode('=', $envVariable, 2);

        // Set the environment variable
        if ($key && $value) {
            $_ENV[$key] = $value;
            putenv("$key=$value");
        }
    }
} else {
    die('.env file not found.');
}

$servername=$_ENV['SERVERNAME']; // Your MySql Server Name or IP address here
$dbusername=$_ENV['DBUSERNAME']; // Login user id here
$dbpassword=$_ENV['DBPASSWORD']; // Login password here
$dbname=$_ENV['DBNAME']; // Your database name here

connecttodb($servername,$dbname,$dbusername,$dbpassword);
function connecttodb($servername,$dbname,$dbuser,$dbpassword)
{
global $link;
$link=mysql_connect ("$servername","$dbuser","$dbpassword");
if(!$link){die("Could not connect to MySQL");
}
mysql_select_db("$dbname",$link) or die ("could not open db".mysql_error());
mysql_query("SET NAMES 'utf8'");
}

//permissions
if (isset($_SESSION['userid'])) {
$user_id=$_SESSION['userid'];
$permission=mysql_query("SELECT permit FROM useraccess WHERE userid = '$user_id'") or die("SELECT Error: ".mysql_error());
}
?>