<?php 

$server_name     = "localhost";
$username 	 = "root";
$password        = ""; //Optional
$db_name         = "ndfest";

$con = mysqli_connect($server_name, $username, $password, $db_name); //Create Connection

//Check Connection
if($con == FALSE) {

	die("<strong style='color: red;'>Connection Failed:</strong> ".mysqli_connect_error());
}

else {

	return true;
}
//End
?>
