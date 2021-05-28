<?php   
$dbhost = "localhost"; //server name localhost or 127.0.0.1
$dbuser = "root";      //User name default root 
$dbpass = "root";  //Password reset at start of uniserver yours is "root"
$dbname = "guitarshop";      //Database name

$db = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname); 
if(!$db) {die("Error connecting to Database");}
?>