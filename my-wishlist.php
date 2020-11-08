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
		
	    <title>My Wishlist</title>
		
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
		<!-- breadcrumb section -->
		<div class="breadcrumb">
			<div class="container">
				<div class="breadcrumb-inner">
					<ul class="list-inline list-unstyled">
						<li><a href="index.php">Home</a></li>
						<li class='active'>Wishlist</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- Main section -->
		<div class="body-content outer-top-bd">
			<div class="container">
				<div class="my-wishlist-page inner-bottom-sm">
					<div class="row">
						<div class="row">
							<div class="col-md-12 my-wishlist">
								<div class="table-responsive">
									<table class="table">
									<thead>
										<tr>
											<th colspan="4">MY Wishlist</th>
										</tr>
									</thead>
									<tbody>
											<tr>
												<td class="col-md-2">
													<img src="admin/productimages" alt="" width="60" height="100">
												</td>
												<td class="col-md-6">
													<div class="product-name">
														<a href="#">
															abc
														</a>
													</div>
													<div class="price">$0</div>
												</td>
												<td class="col-md-2">
													<a href="#" class="btn-upper btn btn-primary">Add to cart</a>
												</td>
												<td class="col-md-2 close-btn">
													<a href="#" class=""><i class="fa fa-times"></i></a>
												</td>
											</tr>
											<tr>
												<td style="font-size: 18px; font-weight:bold ">Your Wishlist is Empty</td>
											</tr>
										<?php } ?>
									</tbody>	
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<?php include('includes/brands-slider.php');?>
			</div>
		</div>
		
		<?php include('includes/footer.php');?>
		<script type="text/javascript" src="assets/js/jquery-1.11.1.min.js"></script>	
		<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
	
	</body>
</html>