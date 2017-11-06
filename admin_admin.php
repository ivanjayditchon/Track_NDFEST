<?php 
session_start();

if(!isset($_SESSION['admin_acc_id'])) {

	header('location:error.html');
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Administrator Info</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/default.css"/>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/admincss.css"/>
	<link rel="stylesheet" href="fontawesome/css/font-awesome.min.css">
	<link rel="icon" type="image/png" href="private_image/track.png">
	<script src="bootstrap/js/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>

    <script type="text/javascript">
    	
		$(document).ready(function(){
			$('.delete_data').click(function(){
				var id = $(this).attr('id')
				var img = $(this).attr('img')
				if(confirm("Are you sure you want to delete this?")) {
					
					window.location = 'delete.php?admin_id='+id+'&admin_img='+img;

				}
				else {
					return false;
				}
				});

			$('#delete_all_admin_data').click(function(){
				if(confirm('Are you sure you want to delete all the admin data?')) {

					window.location = 'delete.php?delete_all_admin';
				}
			});
			});
			
    </script>
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
						<a href="#">
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
								<li class="welcome hidden-sm hidden-xs"><b>Welcome to Administration Area</b></li>
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

				<div id="content">
					<header>
						<h2 class="page-title"><span class="fa fa-users"></span> Administrator Information</h2>
					</header>
					
						<div class="form-wrapper-accounts">
							
							<a href="admin_form.php" class="new-user" style="float: right; margin-left: 5px; margin-bottom: 5px;"><button class="btn-sm"><span class="fa fa-plus"></span> Register new Admin</button></a>
							<a href="#" class="delete-user" id="delete_all_admin_data" style="float: right;"><button class="btn-sm"><span class="fa fa-remove"></span> Delete all Admin</button></a>
							
							<table class="table table-style" style="background-color: #fff;">
								<thead>
									<tr>
										<th>ID</th>
										<th>Acc_ID</th>
										<th>Firstname</th>
										<th>Middlename</th>
										<th>Lastname</th>
										<th>Age</th>
										<th>Gender</th>
										<th>Image</th>
										<th>Mobilenumber</th>
										<th>Address</th>
										<th colspan='2' style="text-align: center;">Action</th>	
									</tr>
									<?php 
										include('db.php');

										$sql = 'SELECT * FROM admin';
										$qry = mysqli_query($con, $sql);
										$num_rows = mysqli_num_rows($qry);

										if($num_rows > 0) { 
											while($row = mysqli_fetch_array($qry)) { ?>
											<tr>
												<td style="padding-top: 20px;"><?php echo $row['id']; ?></td>
												<td style="padding-top: 20px;"><?php echo $row['acc_id']; ?></td>
												<td style="padding-top: 20px;"><?php echo $row['admin_firstname']; ?></td>
												<td style="padding-top: 20px;"><?php echo $row['admin_middlename']; ?></td>
												<td style="padding-top: 20px;"><?php echo $row['admin_lastname']; ?></td>
												<td style="padding-top: 20px;"><?php echo $row['admin_age']; ?></td>
												<td style="padding-top: 20px;"><?php echo $row['admin_gender']; ?></td>
												<td><img src="<?php echo "admin_image/".$row['admin_image']?>" width="50" height="50"></td>
												<td style="padding-top: 20px;"><?php echo $row['admin_mobilenumber']; ?></td>
												<td style="padding-top: 20px;"><?php echo $row['admin_address']; ?></td>
												
												<td style="padding-top: 15px;"><a href="edit_admin.php?id=<?php echo $row['acc_id'] ?>"><button class="btn btn-warning btn-sm"><span class="fa fa-pencil"></span> Edit</button></a>
												<a href="#" class="delete_data" img="<?php echo $row['admin_image'] ?>" id="<?php echo $row['id'] ?>"><button class="btn btn-danger btn-sm"><span class="fa fa-trash"></span> Delete</button></a></td>
											</tr>
										<?php } 
										} 

										else {

											echo '<p>There is no admin yet!..</p>';
										}?>
										
									
								</thead>
							</table>
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