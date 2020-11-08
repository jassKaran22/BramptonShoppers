<?php 
session_start();
error_reporting(0);
include('includes/config.php');

//print_r($_POST);die;
$find = "%{$_POST['product']}%";

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Meta -->
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		
	    <title>Search Result</title>

	    <!-- Bootstrap Core CSS -->
	    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
	    <link rel="stylesheet" href="assets/css/main.css">
	    <!-- Fonts -->
		<link rel="stylesheet" href="assets/css/font-awesome.min.css">
		<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
	</head>
    
	<body class="cnt-home">	
		<header class="header-style-1">
			<?php include('includes/top-header.php');?>
			<?php include('includes/main-header.php');?>
			<?php include('includes/menu-bar.php');?>
		</header>
		
		<div class="breadcrumb">
			<div class="container">
				<div class="breadcrumb-inner">
					<ul class="list-inline list-unstyled">
						<li><a href="home.html">Home</a></li>
						<li class='active'>Search Result</li>
					</ul>
				</div>
			</div>
		</div>
		
		<div class="body-content outer-top-xs">
			<div class='container'>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-3 sidebar">
						<?php include('includes/side-menu.php');?>
					</div>
					
					<div class='col-md-9'>
						<div id="category" class="category-carousel hidden-xs">
							<div class="item">	
								<div class="image"></div>								
							</div>
						</div>
						
						<div class="search-result-container">
							<div id="myTabContent" class="tab-content">
								<div class="tab-pane active" id="grid-container">
									<div class="category-product  inner-top-vs">
										<div class="row">									
											<?php
											//echo $find;die;
											//echo $qry = "select * from products where productName like '$find'";
											$ret = mysqli_query($con,"select * from products where productName like '$find'");
											$num = mysqli_num_rows($ret);
											
											if($num>0){
												while ($row=mysqli_fetch_array($ret)) { ?>
													<div class="col-sm-6 col-md-4">
														<div class="products">				
															<div class="product">		
																<div class="product-image">
																	<div class="image">
																		<a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>">
																			<img src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>">
																		</a>
																	</div>			                      		   
																</div>
											
																<div class="product-info text-left">
																	<h3 class="name">
																		<a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a>
																	</h3>
																		
																	<div class="product-price">	
																		<span class="price">
																			<?php echo htmlentities($row['productPrice']);?>			
																		</span>
																	</div>
																	
																	<div class="product-details">
																		<a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>">Check Details</a>
																	</div>
																</div>
															</div>
														</div>
													</div>
												<?php } 
											} else {?>
											<div class="col-sm-6 col-md-4 wow fadeInUp"> 
												<h3>No Product Found</h3>
											</div>
											<?php } ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>	
				<?php include('includes/brands-slider.php');?>
			</div>
		</div>
		<?php include('includes/footer.php');?>
		
		<!-- al js -->
		<script src="assets/js/jquery-1.11.1.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		
	</body>
</html>