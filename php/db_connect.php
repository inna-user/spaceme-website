<?php
header ("Content-Type: text / html; charset = UTF-8");
$connection = mysqli_connect( 'localhost', 'u_163_inna', '2109021090', 'db_163_spaceme');

if(!$connection){
	die("Database Connection Failed" . mysqli_error($connection));
}

//for ukrainian language
mysqli_query($connection, "SET NAMES 'utf8' COLLATE 'utf8_general_ci'");
mysqli_query($connection, "SET CHARACTER SET 'utf8'");
mysqli_query($connection, "SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'", $connection);
mysqli_set_charset('utf8',$connection);


$seleect_db = mysqli_select_db($connection, 'db_163_spaceme');
if(!$seleect_db){
	die("Database Selection Failed" . mysqli_error($connection));
}
?>