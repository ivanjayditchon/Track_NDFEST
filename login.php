<?php 

session_start();

include('db.php');

if(isset($_POST['submit'])) {

	$email    = mysqli_real_escape_string($con,($_POST['email']));
	$password = mysqli_real_escape_string($con,($_POST['password']));

	$sql 		= "SELECT * FROM account WHERE acc_email = '{$email}' AND acc_password = '{$password}'";
	$qry 		= mysqli_query($con, $sql);
	$num_rows 	= mysqli_num_rows($qry);
 
	if(empty($email) || empty($password)) {

		echo "<script>alert('Please fill all the fields')</script>";
		echo "<script>window.open('index.php','_self')</script>";
	}

	else {

		if($num_rows < 1) {

			echo "<script>alert('Invalid Emailaddress or Password')</script>";
			echo "<script>window.open('index.php','_self')</script>";
		}

		else {

			if($row = mysqli_fetch_array($qry)) {

				if($row['acc_type'] == "admin") {

					//Create Session Data
					$_SESSION['admin_acc_id'] 		= $row['acc_id'];
					$_SESSION['admin_acc_email']		= $row['acc_email'];
					$_SESSION['admin_acc_password']	= $row['acc_password'];
					header('location:admin_index.php');
				}

				else {

					$_SESSION['user_acc_id'] 		= $row['acc_id'];
					$_SESSION['user_acc_email']		= $row['acc_email'];
					$_SESSION['user_acc_password'] 	= $row['acc_password'];
					header('location:user_index.php');
				}
			}
		}
	}
}


?>