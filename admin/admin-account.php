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
		
		<title>Admin</title>
		
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
								<h3>Welcome Admin!</h3>
							</div>
							<div class="module-body">
								Admin can use this section to insert any category and product.
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

</body>

<?php } ?>