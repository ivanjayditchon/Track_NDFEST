<?php 

$server_name = 'localhost';
$username 	 = 'root';
$password    = ''; //Optional
$db 		 = 'db_name';

$con = mysqli_connect($server_name, $username, $password, $db);

if($con == FALSE) {

	die('Connection failed:' .mysqli_error());
}

else {

	return true;
}

?>