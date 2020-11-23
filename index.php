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

	    <title>BramptonShoppers</title>

	    <!-- Bootstrap -->
	    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
	    <!-- custom -->
	    <link rel="stylesheet" href="assets/css/main.css">
		<!-- font-awesome -->
		<link rel="stylesheet" href="assets/css/font-awesome.min.css">
	</head>
	
    <body class="cnt-home">	
		<header class="header-style-1">
			<?php include('includes/top-header.php');?>
			<?php include('includes/main-header.php');?>
			<?php include('includes/menu-bar.php');?>
		</header>
		
		<div class="body-content outer-top-xs" id="top-banner-and-menu">
			<div class="container">
				<div class="furniture-container homepage-container">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-3 sidebar">
							<?php include('includes/side-menu.php');?>
						</div>
						
						<div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder">
							<div id="hero" class="homepage-slider3">
								<div class="slide1">
									<img style="height: 410px;" src="assets/images/sliders/banner2.jpg">
								</div>								
							</div>	
						
							<!-- Inidividual products (according to category) -->
							
							<!-- first row -->
							<div class="sections prod-slider-small outer-top-small">
								<div class="row">
									<div class="col-md-6">
										<section class="section">
											<h3 class="section-title">Electronics</h3>
											<div class="owl-carousssel outer-top-xs">
												<?php
												$ret=mysqli_query($con,"select * from products where category=1 limit 2");
												while ($row=mysqli_fetch_array($ret)) 
												{
												?>
													<div class="item item-carousel">
														<div class="products">
															<div class="product">
																<!-- product image -->
																<div class="product-image">
																	<div class="image">
																		<a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>">
																			<?php if(!empty($row['image_file'])){ ?>
																				<img width="200" src="data:image;charset=utf8;base64,<?php echo base64_encode($row['image_file']); ?>" />
																			<?php }?>	
																		</a>
																	</div>
																</div>
																<!-- prod info -->
																<div class="product-info text-left">
																	<h3 class="name"><a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a></h3>
																	<div class="product-price">	
																		<span class="price"><?php echo htmlentities($row['productPrice']);?></span>		
																	</div>
																	<div class="product-details">	
																		<a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>">Check Details</a>
																	</div>
																</div>
															</div>
														</div>
													</div>
												<?php } ?>	
											</div>
										</section>
									</div>
									<div class="col-md-6">
										<section class="section">
											<h3 class="section-title">Fashion</h3>
											<div class="owl-carousssel outer-top-xs">
												<?php
												$ret=mysqli_query($con,"select * from products where category=2 limit 2");
												while ($row=mysqli_fetch_array($ret)) 
												{
												?>
													<div class="item item-carousel">
														<div class="products">
															<div class="product">
																<!-- product image -->
																<div class="product-image">
																	<div class="image">
																		<a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>">
																			<?php if(!empty($row['image_file'])){ ?>
																				<img width="200" src="data:image;charset=utf8;base64,<?php echo base64_encode($row['image_file']); ?>" />
																			<?php } ?>
																		</a>	
																	</div>
																</div>	
																<!-- prod info -->
																<div class="product-info text-left">
																	<h3 class="name"><a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a></h3>
																	<div class="product-price">	
																		<span class="price"><?php echo htmlentities($row['productPrice']);?></span>		
																	</div>
																	<div class="product-details">	
																		<a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>">Check Details</a>
																	</div>
																</div>
															</div>
														</div>
													</div>
												<?php } ?>	
											</div>
										</section>
									</div>
								</div>
							</div>

							<!-- second row -->
							<div class="sections prod-slider-small outer-top-small">
								<div class="row">
									<!-- first row -->
									<div class="col-md-6">
										<section class="section">
											<h3 class="section-title">Books</h3>
											<div class="owl-carousssel outer-top-xs">
												<?php
												$ret=mysqli_query($con,"select * from products where category=3 limit 2");
												while ($row=mysqli_fetch_array($ret)) 
												{
												?>
													<div class="item item-carousel">
														<div class="products">
															<div class="product">
																<!-- product image -->
																<div class="product-image">
																	<div class="image">
																		<a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>">
																			<?php if(!empty($row['image_file'])){ ?>
																				<img width="200" src="data:image;charset=utf8;base64,<?php echo base64_encode($row['image_file']); ?>" />
																			<?php } ?>		
																		</a>
																	</div>
																</div>
																<!-- prod info -->
																<div class="product-info text-left">
																	<h3 class="name"><a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a></h3>
																	<div class="product-price">	
																		<span class="price"><?php echo htmlentities($row['productPrice']);?></span>		
																	</div>
																	<div class="product-details">	
																		<a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>">Check Details</a>
																	</div>
																</div>
															</div>
														</div>
													</div>
												<?php } ?>	
											</div>
										</section>
									</div>
									<div class="col-md-6">
										<section class="section">
											<h3 class="section-title">Households</h3>
											<div class="owl-carousssel outer-top-xs">
												<?php
												$ret=mysqli_query($con,"select * from products where category=4 limit 2");
												while ($row=mysqli_fetch_array($ret)) 
												{
												?>
													<div class="item item-carousel">
														<div class="products">
															<div class="product">
																<!-- product image -->
																<div class="product-image">
																	<div class="image">
																		<a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>">
																			<?php if(!empty($row['image_file'])){ ?>
																				<img width="200" src="data:image;charset=utf8;base64,<?php echo base64_encode($row['image_file']); ?>" />
																			<?php } ?>	
																		</a>
																	</div>
																</div>	
																<!-- prod info -->
																<div class="product-info text-left">
																	<h3 class="name"><a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a></h3>
																	<div class="product-price">	
																		<span class="price"><?php echo htmlentities($row['productPrice']);?></span>		
																	</div>
																	<div class="product-details">	
																		<a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>">Check Details</a>
																	</div>
																</div>
															</div>
														</div>
													</div>
												<?php } ?>	
											</div>
										</section>
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