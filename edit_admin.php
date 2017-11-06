<?php

session_start();
include('db.php');

$_SESSION['msg'] = '';

$id = $_GET['id'];

$sql 	  	= "SELECT * FROM admin WHERE acc_id = '{$id}'";
$qry 	  	= mysqli_query($con, $sql);
$num_rows 	= mysqli_num_rows($qry);
$row 	  	= mysqli_fetch_array($qry);
$firstname 	= $row['admin_firstname'];
$middlename = $row['admin_middlename'];
$lastname 	= $row['admin_lastname'];
$gender 	= $row['admin_gender'];
$year_level = $row['admin_year_level'];
$college 	= $row['admin_college'];
$age 		= $row['admin_age'];
$mobile_num = $row['admin_mobilenumber'];
$address 	= $row['admin_address'];
$old_image 	= $row['admin_image'];

if(isset($_POST['update'])) {

	$firstname 	= $_POST['firstname'];
	$middlename = $_POST['middlename'];
	$lastname 	= $_POST['lastname'];
	$age 		= $_POST['age'];
	$gender 	= $_POST['gender'];
	$mobile_num = $_POST['mobile'];
	$address 	= $_POST['address'];
	$year_level = $_POST['year-level'];
	$college 	= $_POST['college'];

	//Image Validation
	$file_tmp  = $_FILES['image']['tmp_name'];
	$file_name = $_FILES['image']['name'];
	$file_type = $_FILES['image']['type'];
	$file_size = $_FILES['image']['size'];
	$file_path = "image/".$file_name;

	//Validation
    $mobileValidation = "/^[0-9]+$/";
    $ageValidation 	  = "/^[0-9]+$/";


	if(empty($firstname) || empty($lastname) || empty($middlename) || empty($age) || empty($gender) || empty($mobile_num) || empty($address)) {

		$_SESSION['msg'] = '<div class="alert alert-danger"><a href="#" class="close">&times</a>Please fill all the detailes below</div>';
	}

	else {

        if(!preg_match($mobileValidation,$mobile_num)) {
            
            $_SESSION['msg']="<div class='alert alert-danger'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Mobilenumber is not valid..!</div>";
        }
        
        else if(!(strlen($mobile_num)==11))	{
            
            $_SESSION['msg']="<div class='alert alert-danger'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Mobilenumber atleast 11 digits..!</div>";
        }
        
        else {

        	if($file_name == '') {

		       	$sql = "UPDATE admin SET admin_firstname='$firstname', admin_middlename='$middlename', admin_lastname='$lastname', admin_gender='$gender', admin_year_level='$year_level', admin_college='$college', admin_age='$age', admin_mobilenumber='$mobile_num', admin_address='$address' WHERE acc_id = '{$id}'";
				$qry = mysqli_query($con, $sql);

		        $_SESSION['msg'] = "<div class='alert alert-success'><a href='#' class='close'>&times</a>Yeeeyyyy, Admin info. has been Successfully Updated..</div>";
	        		}

	       	else {

	        	if($file_type == 'image/jpeg' || $file_type == 'image/jpg' || $file_type == 'image/pneg' || $file_type == 'image/png' || $file_type == 'image/gif') {

	        		if($file_size < 400000) {
	        			
	        			unlink('image/'.$old_image);
	        			move_uploaded_file($file_tmp, $file_path);
				       	$sql 	= "UPDATE admin SET admin_firstname='$firstname', admin_middlename='$middlename', admin_lastname='$lastname', admin_gender='$gender', admin_year_level='$year_level', admin_college='$college', admin_age='$age', admin_mobilenumber='$mobile_num', admin_address='$address', admin_image='$file_name' WHERE acc_id = '$id'";
				       	$qry 	= mysqli_query($con, $sql);

				        $_SESSION['msg'] = "<div class='alert alert-success'><a href='#' class='close'>&times</a>Yeeyyy, Successfully Updated..</div>";

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
	<title>Update Admin</title>
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
						<a href="edit_admin_account.php">
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
										<input type="text" name="firstname" id="firstname" class="form-control" value="<?php echo $firstname; ?>">
									</div>
									<div class="col-md-4">
										<label for="middlename">Middlename:</label>
										<input type="text" name="middlename" id="middlename" class="form-control" value="<?php echo $middlename; ?>">
									</div>
									<div class="col-md-4">
										<label for="lastname">Lastname:</label>
										<input type="text" name="lastname" id="lastname" class="form-control" value="<?php echo $lastname; ?>">
									</div>
								</div>
								<div class="row">
									<div class="col-md-12" style="margin-top: 20px;">
										<label for="age">Age:</label>
										<input type="number" name="age" id="age" class="form-control" value="<?php echo $age; ?>">
									</div>
								</div>
								<div class="row" style="margin-top: 20px; margin-bottom: 20px;">
									<div class="col-md-12">
										<label for="gender">Gender:</label>
										<select name="gender" class="form-control">
											<option><?php echo $gender; ?></option>
											<option value="male">Male</option>
											<option value="female">Female</option>
										</select>
									</div>
								</div>
								<div class="row" style="margin-top: 20px; margin-bottom: 20px;">
									<div class="col-md-12">
										<label for="year-level">Year-level:</label>
									 	<select name="year-level" id="year-level" class="form-control">
									 		<option><?php echo $year_level; ?></option>
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
										<label for="college">College:</label>
										<select name="college" id="college" class="form-control">
											<option><?php echo $college; ?></option>
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
										<label for="mobile">Mobile number:</label>
										<input type="text" name="mobile" id="mobile" class="form-control" value="<?php echo $mobile_num; ?>">
									</div>
								</div>
								<div class="row">
									<div class="col-md-12" style="margin-top: 20px;">
										<label for="address">Address:</label>
										<input type="text" name="address" id="address" class="form-control" value="<?php echo $address; ?>">
									</div>
								</div>
								<div class="row">
									<div class="col-md-12" style="margin-top: 20px;">
										<label>Image:</label>
										<img src="<?php echo "image/".$old_image; ?>" width="100" style="margin-bottom: 10px;">
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