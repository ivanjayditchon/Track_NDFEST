<?php

include('db.php');

if(isset($_GET['user_id'])) {

	$id  = $_GET['user_id'];
	$sql = "DELETE FROM user WHERE id = '{$id}'";
	$qry = mysqli_query($con, $sql);

	if($qry == true) {

		$img = $_GET['user_img'];
		unlink('users_image/'.$img);
		echo "<script>window.open('admin_users.php','_self')</script>";

	}

	else {

		return false;
	}
}

if(isset($_GET['admin_id'])) {

	$id  = $_GET['admin_id'];
	$sql = "DELETE FROM admin WHERE id = '{$id}'";
	$qry = mysqli_query($con, $sql);

	if($qry == true) {

		$img = $_GET['admin_img'];
		unlink('admin_image/'.$img);
		echo "<script>window.open('admin_admin.php','_self')</script>";

	}

	else {

		return false;
	}
}

if(isset($_GET['user_account_id'])) {

	$id  = $_GET['user_account_id'];
	$sql = "DELETE FROM account WHERE acc_id = '{$id}'";
	$qry = mysqli_query($con, $sql);

	if($qry == true) {

		echo "<script>window.open('admin_users_accounts.php','_self')</script>";

	}
	else {

		return false;
	}
}

if(isset($_GET['admin_account_id'])) {

	$id  = $_GET['admin_account_id'];
	$sql = "DELETE FROM account WHERE acc_id = '{$id}'";
	$qry = mysqli_query($con, $sql);

	if($qry == true) {

		echo "<script>window.open('admin_admin_accounts.php','_self')</script>";

	}

	else {

		return false;
	}
}

if(isset($_GET['delete_all_users_account'])) {
	
	$acc_type  = $_GET['delete_all_users_account'];
	$sql 	   = "DELETE FROM account WHERE acc_type = '{$acc_type}'";
	$qry 	   = mysqli_query($con, $sql);

	if($qry == true) {

		echo "<script>window.open('admin_users_accounts.php','_self')</script>";
	}
	else {

		return false;
	}
}

if(isset($_GET['delete_all_admin_account'])) {

	$acc_type = $_GET['delete_all_admin_account'];
	$sql	  = "DELETE FROM account WHERE acc_type = '{$acc_type}'";
	$qry 	  = mysqli_query($con, $sql);

	if($qry == true) {

		echo "<script>window.open('admin_admin_accounts.php','_self')</script>";
	}

	else {

		return false;
	}
}

if(isset($_GET['delete_all_users'])) {

	$sql = "DELETE FROM user";
	$qry = mysqli_query($con, $sql);

	if($qry == true) {

		$dir = 'users_image/*'; //Get all filenames

		foreach(glob($dir) as $users_image) { // Glob-> Return the array of filenames

			unlink($users_image);
		}
		
	}

	else {

		return false;
	}
}

if(isset($_GET['delete_all_admin'])) {

	$sql = "DELETE FROM admin";
	$qry = mysqli_query($con, $sql);

	if($qry == true) {

		$dir = 'admin_image/*'; // Get all filenames

		foreach(glob($dir) as $admin_image) { // Glob-> Return the array of filenames

			unlink($admin_image);
		}
	}

	else {

		return false;
	}
}
?>