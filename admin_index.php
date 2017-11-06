<?php 
session_start();

if(!isset($_SESSION['admin_acc_id'])) {

	header('location:error.html');
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>ADMINISTRATOR</title>
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
					<li class="link active">
						<a href="#">
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
					<li class="link"> 	
						<a href="admin_admin.php">
						<span class="fa fa-lock" aria-hidden="true"></span>
						<span class="hidden-sm hidden-xs">Administrator</span>
						</a>
					</li>
					<li class="link"> 	
						<a href="admin_admin_accounts.php">
						<span class="fa fa-lock" aria-hidden="true"></span>
						<span class="hidden-sm hidden-xs">Admin Accounts</span>
						</a>
					</li>
					<li class="link">
						<a href="settings.php">
						<span class="fa fa-cog" aria-hidden="true"></span>
						<span class="hidden-sm hidden-xs">Settings</span>
						</a>
					</li>
				</ul>
			</div>
			
			<div class="col-md-10 display-table-cell valign-top box">
				<div class="row">
					<header id="nav-header" class="clearfix">
						<div class="col-md-5 search">
							<a href="">DASHBOARD</a>
						</div>
						<div class="col-md-7">
							<ul class="pull-right">
								<li class="welcome hidden-sm hidden-xs"><strong>Welcome to Administration Area</strong></li>
								<li>
									<a href="#"><span class="fa fa-envelope" aria-hidden="true"></span>
									<span class="label label-warning">0</span></a>
								</li>
								<li>
								<a href="logout.php" class="logout">
								<span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>
								Logout</a>
								</li>
							</ul>
						</div>
					</header>
				</div>

				<div id="dashboard-con">
					<div class="row">
						<div class="col-md-6 dashboard-left-cell">
							<div class="admin-content-con">
								<header class="clearfix">
									<h5>Sociocultural</h5>
									<a href="#"><button class="pull-right btn btn-sm"><span class="fa fa-plus"></span> New Category</button></a>
								</header>
								<table class="table table-striped">
									<thead>
										<tr>
											<th>Categories</th>
											<th>Teams
											<th>Actions</th>
										</tr>
									</thead>
									<body>
										<tr>
											<td>Dance Sport</td>
											<td>CCS. CBA, CAS. CHS. CED. CEN</td>
											<td>
												<a><button class="btn btn-xs btn-primary">View</button></a>
												<a><button class="btn btn-xs btn-warning">Edit</button></a>
												<a><button class="btn btn-xs btn-danger">Delete</button></a>
											</td>
										</tr>
										<tr>
											<td>Battle of the Band</td>
											<td>CCS. CBA, CAS. CHS. CED. CEN</td>
											<td>
												<a><button class="btn btn-xs btn-primary">View</button></a>
												<a><button class="btn btn-xs btn-warning">Edit</button></a>
												<a><button class="btn btn-xs btn-danger">Delete</button></a>
											</td>
										</tr>
										<tr>
											<td>Singing Contest</td>
											<td>CCS. CBA, CAS. CHS. CED. CEN</td>
											<td>
												<a><button class="btn btn-xs btn-primary">View</button></a>
												<a><button class="btn btn-xs btn-warning">Edit</button></a>
												<a><button class="btn btn-xs btn-danger">Delete</button></a>
											</td>
										</tr>
										<tr>
											<td>Dance Contest</td>
											<td>CCS. CBA, CAS. CHS. CED. CEN</td>
											<td>
												<a><button class="btn btn-xs btn-primary">View</button></a>
												<a><button class="btn btn-xs btn-warning">Edit</button></a>
												<a><button class="btn btn-xs btn-danger">Delete</button></a>
											</td>
										</tr>
										<tr>
											<td>Impersonation</td>
											<td>CCS. CBA, CAS. CHS. CED. CEN</td>
											<td>
												<a><button class="btn btn-xs btn-primary">View</button></a>
												<a><button class="btn btn-xs btn-warning">Edit</button></a>
												<a><button class="btn btn-xs btn-danger">Delete</button></a>
											</td>
										</tr>
									</body>
								</table>
								<footer>
									<a href="#" class="pull-right text-link"><span class="fa fa-folder-open"></span> View all Details</a>
								</footer>
							</div>
						</div>
						
						<div class="col-md-6 dashboard-right-cell">
							<div class="admin-content-con">
								<header class="clearfix">
									<h5>Academic</h5>
									<a href="#"><button class="pull-right btn btn-sm"><span class="fa fa-plus"></span> New Category</button></a>
								</header>
								<table class="table table-striped">
									<thead>
										<tr>
											<th>Categories</th>
											<th>Teams
											<th>Actions</th>
										</tr>
									</thead>
									<body>
										<tr>
											<td>Debate</td>
											<td>CCS. CBA, CAS. CHS. CED. CEN</td>
											<td>
												<a><button class="btn btn-xs btn-primary">View</button></a>
												<a><button class="btn btn-xs btn-warning">View</button></a>
												<a><button class="btn btn-xs btn-danger">View</button></a>
											</td>
										</tr>
										<tr>
											<td>Quiz Bowl</td>
											<td>CCS. CBA, CAS. CHS. CED. CEN</td>
											<td>
												<a><button class="btn btn-xs btn-primary">View</button></a>
												<a><button class="btn btn-xs btn-warning">Edit</button></a>
												<a><button class="btn btn-xs btn-danger">Delete</button></a>
											</td>
										</tr>
									</body>
								</table>
								<footer>
									<a href="" class="pull-right text-link"><span class="fa fa-folder-open"></span> 	View all Details</a>
								</footer>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12">
							<div class="admin-content-con">
								<header class="clearfix">
									<h5>Sports</h5>
									<a href="#"><button class="pull-right btn btn-sm"><span class="fa fa-plus"></span> New Category</button></a>
								</header>
								<table class="table table-bordered">
									<thead>
										<tr>
											<th>Categories</th>
											<th>Teams</th>
											<th>Regulations</th>
											<th>Violations</th>
											<th>Actions</th>
										</tr>
									</thead>
									<body>
										<tr>
											<td>Basketball</td>
											<td>CCS. CBA, CAS. CHS. CED. CEN</td>
											<td>Coaching Box, Assistant <p>Coaches, Sporting</p> Behavior, <p>No Dunking During Warm-up Periods,</p> Running Clock Option</td>
											<td><p>Backcourt, Carrying, DoubleDribble, Traveling</p>
											<p>Defensive three-second rule, Five seconds rule</p>
											<p>Shot Clock, Three seconds rule</p>
											<p>Other Violations: Basket interface, Goaltending</p></td>
											<td>
												<a><button class="btn btn-xs btn-primary" style="margin-top: 50px;">View</button></a>
												<a><button class="btn btn-xs btn-warning" style="margin-top: 50px;">Edit</button></a>
												<a><button class="btn btn-xs btn-danger" style="margin-top: 50px;">Delete</button></a>
											</td>
										</tr>
										<tr>
											<td>Volleyball</td>
											<td>CCS. CBA, CAS. CHS. CED. CEN</td>
											<td>Coaching Box, Assistant <p>Coaches, Sporting</p> Behavior, <p>No Dunking During Warm-up Periods,</p> Running Clock Option</td>
											<td><p>Backcourt, Carrying, DoubleDribble, Traveling</p>
											<p>Defensive three-second rule, Five seconds rule</p>
											<p>Shot Clock, Three seconds rule</p>
											<p>Other Violations: Basket interface, Goaltending</p></td>
											<td>
												<a><button class="btn btn-xs btn-primary" style="margin-top: 50px;">View</button></a>
												<a><button class="btn btn-xs btn-warning" style="margin-top: 50px;">Edit</button></a>
												<a><button class="btn btn-xs btn-danger" style="margin-top: 50px;">Delete</button></a>
											</td>
										</tr>
										
									</body>
								</table>
								<footer>
									<a href="" class="pull-right text-link"><span class="fa fa-folder-open"></span> View all Details</a>
								</footer>
							</div>
						</div>
					</div>
				</div>

				<!--footer-->
				<div class="row hidden-sm hidden-xs">
					<footer id="footer">
						Administration Panel <b>Copyright</b> &copy; 2018</div>
					</footer>
				</div>
			</div>	
		</div>
	</div>
</body>
</html>	
