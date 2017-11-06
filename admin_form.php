	<?php

session_start();
include('db.php');

if(!isset($_SESSION['admin_acc_id'])) {

	header('location:error.html');
}

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
	$year_level = mysqli_real_escape_string($con, $_POST['year-level']);
	$college 	= mysqli_real_escape_string($con, $_POST['college']);
	$acc_type   = "admin";

	//Image Validation
	$file_tmp  = $_FILES['image']['tmp_name'];
	$file_name = $_FILES['image']['name'];
	$file_type = $_FILES['image']['type'];
	$file_size = $_FILES['image']['size'];
	$file_path = "admin_image/".$file_name;

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

    		$_SESSION['msg'] = '<div class="alert alert-danger"><a href="#" class="close">&times</a>Your <strong>Emailaddress</strong> is already exist! Try another one..</div>';
    	}

    	else if(!preg_match($emailValidation,$email)) {
            
            $_SESSION['msg']="<div class='alert alert-danger'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Your Emailaddress is not a valid EmailAddress!...</div>";
        }

        else if(!preg_match($mobileValidation,$mobile_num)) {
            
            $_SESSION['msg']="<div class='alert alert-danger'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Mobilenumber is not valid!...</div>";
        }
        
        else if(!(strlen($mobile_num)==11))	{
            
            $_SESSION['msg']="<div class='alert alert-danger'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Mobilenumber atleast 11 digits!...</div>";
        }

        else if($password != $c_password) {
            
            $_SESSION['msg'] = "<div class='alert alert-danger'>
             <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times</a><strong>Confirmation password</strong> didnt match to your <strong>Password</strong>!...</div>";
        }
        
        else {

        	if($file_name == '') {
	        
	        	move_uploaded_file($file_tmp, $file_path);
				$sql 	= "INSERT INTO `account`(`acc_id`, `acc_type`, `acc_email`, `acc_password`) VALUES (NULL,'$acc_type','$email','$password')";
		        $qry 	= mysqli_query($con, $sql);
		        $acc_id = $_SESSION['acc_id'] = mysqli_insert_id($con);

		       	$sql 	= "INSERT INTO `admin`(`id`, `acc_id`, `admin_firstname`, `admin_middlename`, `admin_lastname`, `admin_gender`, `admin_year_level`, `admin_college`, `admin_age`, `admin_mobilenumber`, `admin_address`) VALUES (NULL,$acc_id,'$firstname','$middlename','$lastname','$gender','$year_level','$college','$age','$mobile_num','$address')";
		       	$qry 	= mysqli_query($con, $sql);

		        $_SESSION['msg'] = "<div class='alert alert-success'><a href='#' class='close'>&times</a>Successfully Registered!..</div>";
	        		}

	       	else {

	        	if($file_type == 'image/jpeg' || $file_type == 'image/jpg' || $file_type == 'image/pneg' || $file_type == 'image/png' || $file_type == 'image/gif') {

	        		if($file_size < 400000) {
	        		
	        			move_uploaded_file($file_tmp, $file_path);
						$sql 	= "INSERT INTO `account`(`acc_id`, `acc_type`, `acc_email`, `acc_password`) VALUES (NULL,'$acc_type','$email','$password')";
				        $qry 	= mysqli_query($con, $sql);
				        $acc_id = $_SESSION['acc_id'] = mysqli_insert_id($con);

				       	$sql 	= "INSERT INTO `admin`(`id`, `acc_id`, `admin_firstname`, `admin_middlename`, `admin_lastname`, `admin_gender`, `admin_year_level`, `admin_college`, `admin_age`, `admin_mobilenumber`, `admin_address`, `admin_image`) VALUES (NULL,$acc_id,'$firstname','$middlename','$lastname','$gender','$year_level','$college','$age','$mobile_num','$address','$file_name')";
				       	$qry 	= mysqli_query($con, $sql);

				        $_SESSION['msg'] = "<div class='alert alert-success'><a href='#' class='close'>&times</a>Yeeyyy, Successfully Register..</div>";

	        		}

	        		else {

	        			$_SESSION['msg'] = '<div class="alert alert-danger"><a>&times</a>Your file is to large!...</div>';
	        		}
	        	}

	        	else {

	        		$_SESSION['msg'] = '<div class="alert alert-danger"><a>&times</a>Invalid file type!...</div>';
	        	}
	        }
        }
    }
}
 
?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin Accounts</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/default.css"/>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/admincss.css"/>
	<link rel="stylesheet" href="fontawesome/css/font-awesome.min.css">
	<script src="bootstrap/js/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="icon" type="image/png" href="private_image/track.png">
</head>
<body>
	<div class="container-fluid display-table">
		<div class="row display-table-row">
			
			<div class="col-md-2 display-table-cell valign-top" id="side-menu">
				<h1 class="hidden-sm hidden-xs">Admin<span>Panel</span></h1>
				<ul>
					<li class="link">
						<a href="admin_index.php">
						<span class="fa fa-dashboard" aria-hidden="true"></span>
						<span class="hidden-sm hidden-xs">Dashboard</span>
						</a>
					</li>
					
					<li class="link">
						<a href="#college" data-toggle="collapse" aria-controls="college">
						<span class="fa fa-university" aria-hidden="true"></span>
						<span class="hidden-sm hidden-xs">Colleges</span>
						<span class="label label-success pull-right hidden-xs hidden-sm ">6</span>
						</a>
						<ul class="collapse collapseable" id="college">
							<li><a href="#">CCS</a></li>
							<li><a href="#">CBA</a></li>
							<li><a href="#">CAS</a></li>
							<li><a href="#">CHS</a></li>
							<li><a href="#">CEN</a></li>
							<li><a href="#">CED</a></li>
						</ul>
					</li>
					<li class="link">
						<a href="#events" data-toggle="collapse" aria-controls="events">
						<span class="fa fa-flag" aria-hidden="true"></span>
						<span class="label label-success pull-right hidden-xs hidden-sm">5</span>
						<span class="hidden-sm hidden-xs">Events</span>
						</a>
						<ul class="collapse collapseable" id="events">
							<li><a href="#">Sports</a></li>
							<li><a href="#">Academic</a></li>
							<li><a href="#">Socio-Cultural</a></li>
							<li><a href="#">Pageant</a></li>
							<li><a href="#">Pinoygames</a></li>
						</ul>
					</li>
					<li class="link">
						<a href="admin_users.php">
						<span class="fa fa-users" aria-hidden="true"></span>
						<span class="hidden-sm hidden-xs">Users</span>
						</a>
					</li>
					<li class="link">
						<a href="admin_users_accounts.php">
						<span class="fa fa-address-book-o" aria-hidden="true"></span>
						<span class="hidden-sm hidden-xs">Users Accounts</span>
						</a>
					</li>
					<li class="link active">
						<a href="admin_admin.php">
						<span class="fa fa-lock" aria-hidden="true"></span>
						<span class="hidden-sm hidden-xs">Administrator</span>
						</a>
					</li>
					<li class="link">
						<a href="#">
						<span class="fa fa-lock" aria-hidden="true"></span>
						<span class="hidden-sm hidden-xs">Admin Accounts</span>
						</a>
					</li>
					<li class="link">
						<a href="#">
						<span class="fa fa-cog" aria-hidden="true"></span>
						<span class="hidden-sm hidden-xs">Settings</span>
						</a>
					</li>
				</ul>
			</div>
			
			<div class="col-md-10 display-table-cell valign-top box">
				<div class="row">
					<header id="nav-header" class="clearfix">
						<div class="col-md-5"></div>
						<div class="col-md-7">
							<ul class="pull-right">
								<li class="welcome hidden-sm hidden-xs">Welcome to Administration Area</li>
								<li>
									<a href="#"><span class="fa fa-envelope" aria-hidden="true"></span>
									<span class="label label-warning">0</span></a>
								</li>
								<li>
								<a href="#" class="logout">
								<span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>
								Logout</a>
								</li>
							</ul>
						</div>
					</header>
				</div>

				<div id="content">
					<header>
						<h2 class="page-title"><span class="fa fa-user"></span> New Administrator</h2>
					</header>
					
						<div class="form-wrapper-accounts">
							<?php if(isset($_SESSION['msg'])) {

								echo $_SESSION['msg'];

							} ?>
							<form action="#" method="post" enctype="multipart/form-data">
								<div class="panel" style="border: 1px solid #1ab394; margin-top: 20px;">
								<div class="panel-heading" style="background-color: #1ab394; color: #fff">Form</div>
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
								<div class="row" style="margin-top: 20px; margin-bottom: 20px;">
									<div class="col-md-12">
										<label for="year-level">Year-level:</label>
									 	<select name="year-level" id="year-level" class="form-control">
									 		<option value="1st-year">1st-year</option>
									 		<option value="2nd-year">2nd-year</option>
									 		<option value="3rd-year">3rd-year</option>
									 		<option value="4th-year">4th-year</option>
									 		<option value="5th-year">5th-year</option>
									 	</select>
									</div>
								</div>
								<div class="row" style="margin-top: 20px; margin-bottom: 20px;">
									<div class="col-md-12">
										<label for="gender">College:</label>
										<select name="college" id="college" class="form-control">
									 		<option value="College of Computer Studies">College of Computer Studies</option>
									 		<option value="College of Business and Accountancy">College of Business and Accountancy</option>
									 		<option value="College of Engineering">College of Engineering</option>
									 		<option value="College of Education">College of Education</option>
									 		<option value="College of Health and Sciences">College of Health and Sciences</option>
									 		<option value="College of Arts and Science">College of Arts and Science</option>
									 	</select>
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


				<!--footer-->
				<div class="row hidden-sm hidden-xs">
					<footer id="footer">
						<i>Administration Panel <b>Copyright</b> &copy; 2018</i></div>
					</footer>
				</div>
			</div>	
		</div>
	</div>
</body>
</html>