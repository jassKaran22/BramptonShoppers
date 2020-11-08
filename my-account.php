<?php
session_start();
error_reporting(0);
include('includes/config.php');
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Meta -->
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		
		<title>My Account</title>

	    <!-- Bootstrap -->
	    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
	    <!-- custom -->
	    <link rel="stylesheet" href="assets/css/main.css">
		<!-- font-awesome -->
		<link rel="stylesheet" href="assets/css/font-awesome.min.css">
	</head>
	
    <body class="cnt-home">	
		<!-- Header section -->
		<header class="header-style-1">
			<!-- Top menu -->
			<?php include('includes/top-header.php');?>
			<!-- Main header -->
			<?php include('includes/main-header.php');?>
			<!-- Navigation Bar -->
			<?php include('includes/menu-bar.php');?>
		</header>

		<!-- Main section -->
		<div class="body-content outer-top-bd">
			<div class="container">
				<div class="checkout-box inner-bottom-sm">
					<div class="row">
						<div class="col-md-8">
							<p> Welcome here! </p>
						</div>
						
					<?php include('includes/myaccount-sidebar.php');?>
					</div>
				</div>
				
				<?php include('includes/brands-slider.php');?>

			</div>
		</div>
		<?php include('includes/footer.php');?>
		
		<script src="assets/js/jquery-1.11.1.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>

	</body>
</html>