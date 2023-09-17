<?php

// Check if the script is running on Heroku (checks for the DYNO environment variable)
if (getenv('DYNO')) {
    // Running on Heroku, no need to load from .env file
} else {
    // Running locally, load from .env file
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
}

$servername=$_ENV['SERVERNAME']; // Your MySql Server Name or IP address here
$dbusername=$_ENV['DBUSERNAME']; // Login user id here
$dbpassword=$_ENV['DBPASSWORD']; // Login password here
$dbname=$_ENV['DBNAME']; // Your database name here
$dbport=$_ENV['DBPORT'];

connecttodb($servername,$dbname,$dbusername,$dbpassword,$dbport);
function connecttodb($servername, $dbname, $dbuser, $dbpassword)
{
    global $link;
    $link = mysqli_connect($servername, $dbuser, $dbpassword, $dbname, $dbport);
    
    if (!$link) {
        die("Could not connect to MySQL: " . mysqli_connect_error());
    }
    
    mysqli_set_charset($link, 'utf8');
}

function mysql_query($sql){
    //try {
        $link = mysqli_connect($_ENV['SERVERNAME'], $_ENV['DBUSERNAME'], $_ENV['DBPASSWORD'], $_ENV['DBNAME'], $_ENV['DBPORT']);
        $result = mysqli_query($link, $sql);
        if (!$result) {
            die("Query failed: " . mysqli_error($link));
        }
        return $result;
    //} catch (Exception $e) {
    //    echo 'Caught exception: ',  $e->getMessage(), "\n";
    //}
}

function mysql_error(){
    $link = mysqli_connect($_ENV['SERVERNAME'], $_ENV['DBUSERNAME'], $_ENV['DBPASSWORD'], $_ENV['DBNAME'], $_ENV['DBPORT']);
    return mysqli_error($link);
}

function mysql_real_escape_string($escapestring){
    try {
        $link = mysqli_connect($_ENV['SERVERNAME'], $_ENV['DBUSERNAME'], $_ENV['DBPASSWORD'], $_ENV['DBNAME'], $_ENV['DBPORT']);
        $result = mysqli_real_escape_string($link, $escapestring);
        return $result;
    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
}

function mysql_num_rows($mysqlqueryres){
    try {
        return $mysqlqueryres->num_rows;
    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
}

function mysql_fetch_row($mysqlqueryres){
    try {
        $row = mysqli_fetch_row($mysqlqueryres);
        return $row;
    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
}

function mysql_fetch_array($mysqlqueryres){
    try {
        $rowAssoc = mysqli_fetch_array($mysqlqueryres, MYSQLI_ASSOC);
        return $rowAssoc;
    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
}

function mysql_result($res,$row=0,$col=0){ 
    $numrows = mysqli_num_rows($res); 
    if ($numrows && $row <= ($numrows-1) && $row >=0){
        mysqli_data_seek($res,$row);
        $resrow = (is_numeric($col)) ? mysqli_fetch_row($res) : mysqli_fetch_assoc($res);
        if (isset($resrow[$col])){
            return $resrow[$col];
        }
    }
    return false;
}

function mysql_fetch_assoc($mysqlqueryres){
    try {
        $rowAssoc = mysqli_fetch_assoc($mysqlqueryres);
        return $rowAssoc;
    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
}

function mysql_close(){
    try {
        $link = mysqli_connect($_ENV['SERVERNAME'], $_ENV['DBUSERNAME'], $_ENV['DBPASSWORD'], $_ENV['DBNAME'], $_ENV['DBPORT']);
        return mysqli_close($link);
    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
}

function mysql_insert_id(){
    try {
        $link = mysqli_connect($_ENV['SERVERNAME'], $_ENV['DBUSERNAME'], $_ENV['DBPASSWORD'], $_ENV['DBNAME'], $_ENV['DBPORT']);
        return mysqli_insert_id($link);
    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
}

// Permissions
if (isset($_SESSION['userid'])) {
    $user_id = $_SESSION['userid'];
    $permission = mysqli_query($link, "SELECT permit FROM useraccess WHERE userid = '$user_id'") or die("SELECT Error: " . mysqli_error($link));
}
?>