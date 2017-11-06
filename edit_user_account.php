<?php 

session_start();

$_SESSION['msg'] = '';

include('db.php');

$id = $_GET['id'];
//Select the data of the selected row
$sql 		= "SELECT * FROM account WHERE acc_id = '{$id}'";
$qry 		= mysqli_query($con, $sql);
$num_rows 	= mysqli_num_rows($qry);
$row 		= mysqli_fetch_array($qry);
$email  	= $row['acc_email'];
$password 	= $row['acc_password'];

//End

if(isset($_POST['update'])) {

	$email  	= $_POST['email'];
	$password 	= $_POST['password'];
	
	//Empty fields
	if(empty($email) || empty($password)) {

		$_SESSION['msg'] = '<div class="alert alert-danger"><a href="#" class="close">&times</a>Please fill out all fields!...</div>';

	}
	//End

	else {

       	$sql = "UPDATE account SET acc_email = '$email', acc_password = '$password' WHERE acc_id = '{$id}'";
        $qry = mysqli_query($con, $sql);

        $_SESSION['msg'] = '<div class="alert alert-success"><a href="#" class="close">&times</a>Yeeeheyy, Account has been Successfully Updated...</div>';
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
							<form action="#" method="post">
								<div class="row">
										<div class="col-md-6">
										<label for="email">EmailAddress:</label>
										<input type="email" name="email" id="email" class="form-control" value="<?php echo $email; ?>">
										</div>
										<div class="col-md-6">
											<label for="password">Password:</label>
											<input type="text" name="password" id="middlename" class="form-control" value="<?php echo $password ?>">
										</div>
										<p></p>
									</div>
										<div class="row" style="text-align: center; font-family: fira code; margin-top: 25px; margin-bottom: 20px;">
										<input type="submit" name="update" class="btn btn-danger" value="Update">
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