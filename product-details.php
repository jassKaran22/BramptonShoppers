<?php 
session_start();
error_reporting(0);
include('includes/config.php');

//add product to cart
if(isset($_GET['action']) && $_GET['action']=="add"){
	$id = intval($_GET['id']);
	if(isset($_SESSION['cart'][$id])){
		$_SESSION['cart'][$id]['quantity']++;
	}else{
		$sql_p = "SELECT * FROM products WHERE id={$id}";
		$query_p = mysqli_query($con,$sql_p);
		if(mysqli_num_rows($query_p)!=0){
			$row_p = mysqli_fetch_array($query_p);
			$_SESSION['cart'][$row_p['id']] = array("quantity" => 1, "price" => $row_p['productPrice']);
					//echo "<script>alert('Product has been added to the cart')</script>";
		echo "<script type='text/javascript'> document.location ='my-cart.php'; </script>";
		}else{
			$message="Product ID is invalid";
		}
	}
}
$pid = intval($_GET['pid']);

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		
		<title>Product Details</title>
	    
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
					<?php
					//echo $pid;
					//echo $sql = "SELECT category.categoryName as catname,products.productName as pname from products join category on category.id=products.category where products.id='$pid'";die;
					
					$ret = mysqli_query($con,"SELECT category.categoryName as catname,products.productName as pname from products join category on category.id=products.category where products.id='$pid'");
					while ($rw = mysqli_fetch_array($ret)) {
					?>
						<ul class="list-inline list-unstyled">
							<li><a href="index.php">Home</a></li>
							<li><?php echo htmlentities($rw['catname']);?></a></li>
							<li class='active'><?php echo htmlentities($rw['pname']);?></li>
						</ul>
					<?php }?>
				</div>
			</div>
		</div>
		
		<div class="body-content outer-top-xs">
			<div class='container'>
				<div class='row single-product outer-bottom-sm '>
					<!-- menu(on left side) -->					
					<div class="col-md-3 sidebar">
						<?php include('includes/side-menu.php');?>
					</div>
					
					<?php 
					//echo $pid;die;
					//echo $quer = "SELECT p.category, p.productName, p.productPrice, p.productDescription, p.productImage1,pi.product_quantity, pi.product_company FROM products p join product_inventory pi ON p.id = pi.product_id WHERE p.id='$pid'";die;
					
					$ret = mysqli_query($con,"SELECT p.id,p.category, p.productName, p.productPrice, p.productDescription, p.productImage1, p.image_file,pi.product_quantity, pi.product_company FROM products p join product_inventory pi ON p.id = pi.product_id WHERE p.id='$pid'");
					while($row = mysqli_fetch_array($ret)){
					?>	
						<div class='col-md-9'>
							<div class="row">
								<div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
									<div class="product-item-holder size-big single-product-gallery small-gallery">
										<div class="single-product-gallery-thumbs gallery-thumbs">
											<div id="owl-single-product-thumbnails">
												<div class="item">
													<a class="horizontal-thumb">
														<?php if(!empty($row['image_file'])){ ?>
															<img width="200" src="data:image;charset=utf8;base64,<?php echo base64_encode($row['image_file']); ?>" />
														<?php } ?>
													</a>
												</div>
											</div>
										</div>
									</div>
								</div>
								
								<div class='col-sm-6 col-md-7 product-info-block'>
									<div class="product-info">
										<h1 class="name"><?php echo htmlentities($row['productName']);?></h1>
										<div class="stock-container info-container m-t-10">
											<div class="row">
												<div class="col-sm-4">
													<div class="stock-box">
														<span class="label">Availability :</span>
													</div>	
												</div>
												<div class="col-sm-8">
													<div class="stock-box">
														<span class="value"><?php echo htmlentities($row['product_quantity']);?> Pieces</span>
													</div>	
												</div>
											</div>	
										</div>

										<div class="stock-container info-container m-t-10">
											<div class="row">
												<div class="col-sm-4">
													<div class="stock-box">
														<span class="label">Product Brand :</span>
													</div>	
												</div>
												<div class="col-sm-8">
													<div class="stock-box">
														<span class="value"><?php echo htmlentities($row['product_company']);?></span>
													</div>	
												</div>
											</div>	
										</div>

										<div class="price-container info-container m-t-20">
											<div class="row">
												<div class="col-sm-6">
													<div class="price-box">
														<span class="price"><?php echo htmlentities($row['productPrice']);?></span>
													</div>
												</div>
											</div>
										</div>
										
										<div class="description-container">										
											<span class="label">Description :</span>
											<div id="description" class="tab-pane in active">
												<div class="product-tab">
													<p class="text"><?php echo $row['productDescription'];?></p>
												</div>	
											</div>
										</div>
										
										<div class="quantity-container info-container">
											<div class="row">									
												<div class="col-sm-2">
													<span class="label">Qty :</span>
												</div>
												
												<div class="col-sm-2">
													<div class="cart-quantity">
														<div class="quant-input">
															<input readonly type="text" value="1">
														</div>
													</div>
												</div>

												<div class="col-sm-7">
													<?php if($row['product_quantity']!= 0 ){?>
														<a href="product-details.php?page=product&action=add&id=<?php echo $row['id']; ?>" class="btn btn-primary"><i class="fa fa-shopping-cart inner-right-vs"></i> ADD TO CART</a>
													<?php } else {?>
															<div class="action" style="color:red">Out of Stock</div>
													<?php } ?>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>	
					<?php } ?>
				</div>		
				<?php include('includes/brands-slider.php');?>
			</div>
		</div>
		<?php include('includes/footer.php');?>

		<!-- all js files -->
		<script src="assets/js/jquery-1.11.1.min.js"></script>		
		<script src="assets/js/bootstrap.min.js"></script>
		
	</body>
</html>