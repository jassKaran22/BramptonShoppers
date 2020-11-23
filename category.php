<?php
session_start();
error_reporting(0);
include('includes/config.php');

//to fetch all products in particular category
$cid = intval($_GET['cid']);

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Meta -->
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	    <title>Product Category</title>

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
		
		<div class="body-content outer-top-xs">
			<div class='container'>
				<div class='row outer-bottom-sm'>
					<div class="row">
						<div class='col-md-3 sidebar'>
							<?php include('includes/side-menu.php');?>
						</div>
						
						<div class='col-md-9'>
							<div id="category" class="category-carousel hidden-xs">
								<div class="item">	
									<div class="image">
										<?php 
										//echo $qury = "SELECT categoryName FROM category WHERE id='$cid'";
										$sql = mysqli_query($con,"SELECT categoryName FROM category WHERE id='$cid'");
											while($row = mysqli_fetch_array($sql)){
												//print_r($row);
											?>
												<div class="excerpt hidden-sm hidden-md">
													<h3><?php echo htmlentities($row['categoryName']);?></h3>
												</div>
										<?php } ?>
									</div>
								</div>
							</div>
							
							<!-- display all products of category selected -->
							<div class="search-result-container">
								<div id="myTabContent" class="tab-content">
									<div class="tab-pane active" id="grid-container">
										<div class="category-product  inner-top-vs">
											<div class="row">									
											<?php
												$ret = mysqli_query($con,"select * from products where category='$cid'");
												$num = mysqli_num_rows($ret);
												if($num>0){
													while ($row=mysqli_fetch_array($ret)){
											?>							
														<div class="col-sm-6 col-md-4">
															<div class="products">				
																<div class="product">		
																	<div class="product-image">
																		<div class="image">
																			<a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>">
																				<?php if(!empty($row['image_file'])){ ?>				
																					<img src="data:image;base64,<?php echo base64_encode($row['image_file']); ?>" />
																				<?php } ?>	
																			</a>
																		</div>			                      		   
																	</div>
				
																	<div class="product-info text-left">
																		<h3 class="name">
																			<a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a>
																		</h3>
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
													<?php } 
												} else { ?>	
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
				</div>
				
				<?php include('includes/brands-slider.php');?>
			</div>
		</div>
		
		<?php include('includes/footer.php');?>
		
		<script type="text/javascript" src="assets/js/jquery-1.11.1.min.js"></script>	
		<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>	

</body>
</html>