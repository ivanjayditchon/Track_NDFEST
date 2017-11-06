<?php 

session_start();

$_SESSION['msg'] = '';

include('db.php');

$id = $_GET['id'];
//Select the data of the selected row
$sql 		= "SELECT * FROM user WHERE acc_id = '{$id}'";
$qry 		= mysqli_query($con, $sql);
$num_rows 	= mysqli_num_rows($qry);
$row 		= mysqli_fetch_array($qry);
$firstname  = $row['user_firstname'];
$middlename = $row['user_middlename'];
$lastname 	= $row['user_lastname'];
$age 		= $row['user_age'];
$gender 	= $row['user_gender'];
$old_image 	= $row['user_image'];
$mobile_num = $row['user_mobile'];
$address  	= $row['user_address'];
//End

if(isset($_POST['update'])) {

	$firstname  = $_POST['firstname'];
	$middlename = $_POST['middlename'];
	$lastname 	= $_POST['lastname'];
	$age 		= $_POST['age'];
	$gender 	= $_POST['gender'];
	$mobile_num = $_POST['mobile'];
	$address 	= $_POST['address'];

	//Input Validation(mobilenumber & age)
	$mobileValidation = "/^[0-9]+$/";
    $ageValidation 	  = "/^[0-9]+$/";
    //End

    //Image
    $file_tmp  = $_FILES['image']['tmp_name'];
	$file_name = $_FILES['image']['name'];
	$file_type = $_FILES['image']['type'];
	$file_size = $_FILES['image']['size'];
	$file_path = "image/".$file_name;
	//End
	
	//Empty fields
	if(empty($firstname) || empty($middlename) || empty($lastname) || empty($age) || empty($gender) || empty($mobile_num) || empty($address)) {

		$_SESSION['msg'] = '<div class="alert alert-danger"><a href="#" class="close">&times</a>Please fill out all fields!...</div>';

	}
	//End

	else {

		if(!preg_match($mobileValidation, $mobile_num)) {

			$_SESSION['msg'] = '<div class="alert alert-danger"><a href="#" class="close">&times</a>Mobilenumber is not a valid!...</div>';
		}

		else if(!(strlen($mobile_num)==11))	{
            
            $_SESSION['msg']="<div class='alert alert-danger'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Mobilenumber atleast 11 digits..!</div>";
        }

        else {

        	//If image is empty can update other data
        	if($file_name == '') {
        	
        		$sql = "UPDATE user SET user_firstname='$firstname', user_middlename='$middlename', user_lastname='$lastname', user_age='$age', user_gender='$gender', user_mobile='$mobile_num', user_address='$address' WHERE acc_id = '{$id}'";
        		$qry 	= mysqli_query($con, $sql);

        		$_SESSION['msg'] = "<div class='alert alert-success'><a href='#' class='close'>&times</a>Yeeheeyyy, User Info. has been Successfully Updated!..</div>";
        	}
        	//End

        	//If image is not empty
        	else {

        		if($file_type == 'image/jpeg' || $file_type == 'image/pneg' || $file_type == 'image/gif'){

        			if($file_size < 400000) {

    					unlink('image/'.$old_image);
		        		move_uploaded_file($file_tmp, $file_path);
		        		$sql = "UPDATE user SET user_firstname='$firstname', user_middlename='$middlename', user_lastname='$lastname', user_age='$age', user_gender='$gender', user_image='$file_name', user_mobile='$mobile_num', user_address='$address' WHERE acc_id = '{$id}'";
		        		$qry 	= mysqli_query($con, $sql);

		        		$_SESSION['msg'] = "<div class='alert alert-success'><a href='#' class='close'>&times</a>Yeeheey, Account has been Successfully Updated!..</div>";
		        	}
		        	else {

		        		$_SESSION['msg'] = "<div class='alert alert-danger'><a href='#' class='close'>&times</a>Your file is to large!...</div>";		
		        	}	
        		}

        		else {

        			$_SESSION['msg'] = "<div class='alert alert-danger'><a href='#' class='close'>&times</a>Invalid file type!...</div>";
        		}
        	}
        	//End
        }
	}
}

?>




<!DOCTYPE html>
<html>
<head>
	<title>Update User</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/default.css"/>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/adminstyle.css"/>
	<link rel="stylesheet" href="fontawesome/css/font-awesome.min.css">
	<link rel="icon" type="image/png" href="private_image/track.png">
	<script src="bootstrap/js/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
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
					<li class="link active">
						<a href="#">
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
					<li class="link">
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
						<h2 class="page-title"><span class="fa fa-users"></span> Users Information</h2>
					</header>
					
						<div class="form-wrapper-accounts">
							<?php 
								if(isset($_SESSION['msg'])) {

									echo $_SESSION['msg'];
								}
							?>
							<div class="panel" style="border: 1px solid #1ab394; margin-top: 20px;">
							<div class="panel-heading" style="background-color: #1ab394; color: #fff">Edit User</div>
							<div class="panel-body">
							<form action="#" method="post" enctype="multipart/form-data">
								<div class="row">
									<div class="col-md-4">
										<label for="firstname">Firstname:</label>
										<input type="text" name="firstname" id="firstname" class="form-control" value="<?php echo $firstname; ?>">
										</div>
										<div class="col-md-4">
											<label for="middlename">Middlename:</label>
											<input type="text" name="middlename" id="middlename" class="form-control" value="<?php echo $middlename ?>">
										</div>
										<div class="col-md-4">
											<label for="lastname">Lastname:</label>
											<input type="text" name="lastname" id="lastname" class="form-control" value="<?php echo $lastname ?>">
										</div>
									</div>
									<div class="row">
										<div class="col-md-12" style="margin-top: 20px;">
											<label for="age">Age:</label>
											<input type="number" name="age" id="age" class="form-control" value="<?php echo $age ?>">
										</div>
									</div>
									<div class="row" style="margin-top: 20px; margin-bottom: 20px;">
										<div class="col-md-12">
											<label for="gender">Gender:</label>
											<select name="gender" id="gender" class="form-control">
												<option><?php echo $gender ?></option>
												<option>Male</option>
												<option>Female</option>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12" style="margin-top: 20px;">
											<label for="mobile">Mobile number:</label>
											<input type="text" name="mobile" id="mobile" class="form-control" value="<?php echo $mobile_num ?>">
										</div>
									</div>
									<div class="row">
										<div class="col-md-12" style="margin-top: 20px;">
											<label for="address">Address:</label>
											<input type="text" name="address" id="address" class="form-control" value="<?php echo $address ?>">
										</div>
									</div>
									<div class="row">
										<div class="col-md-12" style="margin-top: 20px;">
											<label>Image:</label>
											<img src="<?php echo "image/".$row['user_image'] ?>" width="80" style="margin-bottom: 10px;">
											<input type="file" name="image" class="form-control">
										</div>
									</div>
									<div class="row" style="text-align: center; font-family: fira code; margin-top: 20px;">
										<input type="submit" name="update" class="btn btn-danger" value="Update">
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