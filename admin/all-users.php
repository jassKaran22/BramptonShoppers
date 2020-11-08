<?php
session_start();
include('include/config.php');

//check if admin login
if(strlen($_SESSION['alogin']) == 0){	
	header('location:index.php');
}else{
	
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<title>Admin| Manage Users</title>
		
		<!-- bootstrap -->
		<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
		<link type="text/css" href="css/theme.css" rel="stylesheet">
		<!-- font-awesome -->
		<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
	</head>

	<body>
		<?php include('include/header.php');?>
		<div class="wrapper">
			<div class="container">
				<div class="row">
					<?php include('include/sidebar.php');?>				
					<div class="span9">
						<div class="content">
							<div class="module">
								<div class="module-head">
									<h3>Manage Users</h3>
								</div>
								<div class="module-body table">
									<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
										<thead>
											<tr>
												<th>#</th>
												<th> Name</th>
												<th>Email </th>
												<th>Contact no</th>
												<th>Registered Date </th>										
											</tr>
										</thead>
										<tbody>
											<?php $query = mysqli_query($con,"SELECT * FROM users");
											$count = 1;
											while($row = mysqli_fetch_array($query)){
											?>									
												<tr>
													<td><?php echo htmlentities($count);?></td>
													<td><?php echo htmlentities($row['name']);?></td>
													<td><?php echo htmlentities($row['email']);?></td>
													<td> <?php echo htmlentities($row['contactno']);?></td>
													<td><?php echo htmlentities($row['regDate']);?></td>
												</tr>	
											<?php $count = $count+1; } ?>
										</tbody>		
									</table>
								</div>
							</div>						
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php include('include/footer.php');?>

		<!-- all js files -->
		<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
		<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
		<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="scripts/datatables/jquery.dataTables.js"></script>
		
		<!-- custom data tables js -->
		<script>
			$(document).ready(function() {
				$('.datatable-1').dataTable();
			});
		</script>
		
</body>

<?php } ?>