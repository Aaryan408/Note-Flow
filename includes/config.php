<?php

define('DB_NAME', 'note');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', 'localhost'); 

$conn = mysqli_connect('localhost','root','','note') or die(mysqli_error());

// Establish database connection.
try
{
$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASSWORD,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
}
catch (PDOException $e)
{
exit("Error: " . $e->getMessage());
}

?>
