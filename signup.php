<?php

session_start();
include('db.php');

$_SESSION['msg'] = '';

if(isset($_POST['register'])) {

	$firstname 	= mysqli_real_escape_string($con, $_POST['firstname']);
	$middlename = mysqli_real_escape_string($con, $_POST['middlename']);
	$lastname 	= mysqli_real_escape_string($con, $_POST['lastname']);
	$age 		= mysqli_real_escape_string($con, $_POST['age']);
	@$gender 	= mysqli_real_escape_string($con, $_POST['gender']);
	$email 		= mysqli_real_escape_string($con, $_POST['email']);
	$password 	= mysqli_real_escape_string($con, $_POST['password']);
	$c_password = mysqli_real_escape_string($con, $_POST['c_password']);
	$mobile_num = mysqli_real_escape_string($con, $_POST['mobile']);
	$address 	= mysqli_real_escape_string($con, $_POST['address']);
	$acc_type   = "user";

	//Image Validation
	$file_tmp  = $_FILES['image']['tmp_name'];
	$file_name = $_FILES['image']['name'];
	$file_type = $_FILES['image']['type'];
	$file_size = $_FILES['image']['size'];
	$file_path = "users_image/".$file_name;

	//Validation
	$emailValidation  = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$/";
    $mobileValidation = "/^[0-9]+$/";
    $ageValidation 	  = "/^[0-9]+$/";

    $sql = "SELECT * FROM account WHERE acc_email = '{$email}'";
    $qry = mysqli_query($con, $sql);
    $check_email = mysqli_num_rows($qry);


	if(empty($firstname) || empty($lastname) || empty($middlename) || empty($age) || empty($gender) || empty($email) || empty($password) || empty($c_password) || empty($mobile_num) || empty($address)) {

		$_SESSION['msg'] = '<div class="alert alert-danger"><a href="#" class="close">&times</a>Please fill all the detailes below</div>';
	}

	else {

		if($check_email > 0) {

    		$_SESSION['msg'] = '<div class="alert alert-danger"><a class="close">&times</a>Your Emailaddress is already exist! Try another one..</div>';
    	}

    	else if(!preg_match($emailValidation,$email)) {
            
            $_SESSION['msg']="<div class='alert alert-danger'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Your Emailaddress is not a valid EmailAddress..!</div>";
        }

        else if(!preg_match($mobileValidation,$mobile_num)) {
            
            $_SESSION['msg']="<div class='alert alert-danger'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Mobilenumber is not valid..!</div>";
        }
        
        else if(!(strlen($mobile_num)==11))	{
            
            $_SESSION['msg']="<div class='alert alert-danger'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Mobilenumber atleast 11 digits..!</div>";
        }

        else if($password != $c_password) {
            
            $_SESSION['msg'] = "<div class='alert alert-danger'>
             <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times</a><strong>Confirmation password</strong> didnt matched..!</div>";
        }
        
        else if(!($file_type == 'image/jpeg' || $file_type == 'image/pneg' || $file_type == 'image/gif')) {

        	$_SESSION['msg'] = "<div class='alert alert-danger'><a href='#' class='close'>&times</a>Invalid file type!...</div>";
        }
        
        else if($file_size > 400000) {

          	$_SESSION['msg'] = "<div class='alert alert-danger'><a href='#' class='close'>&times</a>Your file is to large!...</div>";		
        }

        else {

        		move_uploaded_file($file_tmp, $file_path);
				$sql 	= "INSERT INTO `account`(`acc_id`, `acc_type`, `acc_email`, `acc_password`) VALUES (NULL,'$acc_type','$email','$password')";
        		$qry 	= mysqli_query($con, $sql);
        		$acc_id = $_SESSION['acc_id'] = mysqli_insert_id($con);

        		$sql 	= "INSERT INTO `user`(`id`, `acc_id`, `user_firstname`, `user_middlename`, `user_lastname`, `user_age`, `user_gender`, `user_image`, `user_mobile`, `user_address`) VALUES (NULL,'$acc_id','$firstname','$middlename','$lastname','$age','$gender','$file_name','$mobile_num','$address')";
        		$qry 	= mysqli_query($con, $sql);

        		$_SESSION['msg'] = "<div class='alert alert-success'><a href='#' class='close'>&times</a>Successfully Register!, If you want to SignIn just click <a href='index.php' style='text-decoration: none;'>here</a></div>";
        }
    }
}
 
?>



<!DOCTYPE html>
<html>
<head>
	<title>Signup</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"/>
	<link rel="stylesheet" href="fontawesome/css/font-awesome.min.css">
	<link rel="icon" type="image/png" href="private_image/track.png">
	<script src="js/jquery2.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container-fluid">
		<div class="col-md-2"></div>
		<div class="col-md-8">
		<br>
		<?php if(isset($_SESSION['msg'])) {

					echo $_SESSION['msg'];

				} ?>
		<form action="#" method="post" enctype="multipart/form-data">
			<div class="panel" style="border: 1px solid #1ab394; margin-top: 20px;">
				<div class="panel-heading" style="background-color: #1ab394; color: #fff">SignUp</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-4">
							<label for="firstname">Firstname:</label>
							<input type="text" name="firstname" id="firstname" class="form-control" value="<?php echo isset($_POST['firstname']) ? $_POST['firstname'] : ''; ?>">
						</div>
						<div class="col-md-4">
							<label for="middlename">Middlename:</label>
							<input type="text" name="middlename" id="middlename" class="form-control" value="<?php echo isset($_POST['middlename']) ? $_POST['middlename'] : ''; ?>">
						</div>
						<div class="col-md-4">
							<label for="lastname">Lastname:</label>
							<input type="text" name="lastname" id="lastname" class="form-control" value="<?php echo isset($_POST['lastname']) ? $_POST['lastname'] : ''; ?>">
						</div>
					</div>
					<div class="row">
						<div class="col-md-12" style="margin-top: 20px;">
							<label for="age">Age:</label>
							<input type="number" name="age" id="age" class="form-control" value="<?php echo isset($_POST['age']) ? $_POST['age'] : ''; ?>">
						</div>
					</div>
					<div class="row" style="margin-top: 20px; margin-bottom: 20px;">
						<div class="col-md-12">
							<label for="gender">Gender:</label>
							<input type="radio" name="gender" id="gender" value="male">Male
							<input type="radio" name="gender" id="gender" value="female">Female
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<label for="email">EmailAddress:</label>
							<input type="email" name="email" id="email" class="form-control" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
						</div>
					</div>
					<div class="row">
						<div class="col-md-12" style="margin-top: 20px;">
							<label for="password">Password:</label>
							<input type="password" name="password" id="password" class="form-control" value="<?php echo isset($_POST['password']) ? $_POST['password'] : ''; ?>">
						</div>
					</div>
					<div class="row">
						<div class="col-md-12" style="margin-top: 20px;">
							<label for="cpassword">Confirm Password:</label>
							<input type="password" name="c_password" id="cpassword" class="form-control" value="<?php echo isset($_POST['c_password']) ? $_POST['c_password'] : ''; ?>">
						</div>
					</div>
					<div class="row">
						<div class="col-md-12" style="margin-top: 20px;">
							<label for="mobile">Mobile number:</label>
							<input type="text" name="mobile" id="mobile" class="form-control" value="<?php echo isset($_POST['mobile']) ? $_POST['mobile'] : ''; ?>">
						</div>
					</div>
					<div class="row">
						<div class="col-md-12" style="margin-top: 20px;">
							<label for="address">Address:</label>
							<input type="text" name="address" id="address" class="form-control" value="<?php echo isset($_POST['address']) ? $_POST['address'] : ''; ?>">
						</div>
					</div>
					<div class="row">
						<div class="col-md-12" style="margin-top: 20px;">
							<label>Image:</label>
							<input type="file" name="image" class="form-control">
						</div>
					</div>
					<div class="row" style="text-align: center; font-family: fira code; margin-top: 20px;">
						<input type="submit" name="register" class="btn btn-danger" value="Register">
					</div>
				</div>
				<div class="panel-footer"><center><i>TrackNDFest 2k18</i></center></div>
			</div>
			</form>
		</div>
	</div>
</body>
</html>