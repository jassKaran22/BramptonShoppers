<?php 
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
    {   
header('location:login.php');
}
else{

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Meta -->
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		
	    <title>Order History</title>
	    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
	    <link rel="stylesheet" href="assets/css/main.css">
	    <!-- fonts -->
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
						<li><a href="#">Home</a></li>
						<li class='active'>Shopping Cart</li>
					</ul>
				</div>
			</div>
		</div>

		<div class="body-content outer-top-xs">
			<div class="container">
				<div class="row inner-bottom-sm">
					<div class="shopping-cart">
						<div class="col-md-12 col-sm-12 shopping-cart-table ">
							<div class="table-responsive">
								<form name="cart" method="post">	
									<table class="table table-bordered">
										<thead>
											<tr>
												<th class="cart-romove item">#</th>
												<th class="cart-description item">Image</th>
												<th class="cart-product-name item">Product Name</th>
												<th class="cart-qty item">Quantity</th>
												<th class="cart-sub-total item">Price Per unit</th>
												<th class="cart-total item">Grandtotal</th>
												<th class="cart-total item">Payment Method</th>
												<th class="cart-description item">Order Date</th>
											</tr>
										</thead>
										
										<tbody>
											<?php $query = mysqli_query($con,"SELECT products.productImage1 as pimg1,products.image_file as imageFile,products.productName as pname,products.id as proid,orders.productId as opid,orders.quantity as qty,products.productPrice as pprice,orders.paymentMethod as paym,orders.orderDate as odate,orders.id as orderid FROM orders JOIN products ON orders.productId=products.id WHERE orders.userId='".$_SESSION['id']."' AND orders.paymentMethod is not null");
											
											$cnt=1;
											
											while($row=mysqli_fetch_array($query)){ ?>
												<tr>
													<td><?php echo $cnt;?></td>
													<td class="cart-image">
														<a class="entry-thumbnail" href="detail.html">
															<img width="84" height="146" src="data:image;charset=utf8;base64,<?php echo base64_encode($row['imageFile']); ?>" />
														</a>
													</td>
													<td class="cart-product-name-info">
														<h4 class='cart-product-description'><a href="product-details.php?pid=<?php echo $row['opid'];?>">
														<?php echo $row['pname'];?></a></h4>
													</td>
													<td class="cart-product-quantity">
														<?php echo $qty=$row['qty']; ?>   
													</td>
													<td class="cart-product-sub-total"><?php echo $price=$row['pprice']; ?>  </td>
													<td class="cart-product-grand-total">$<?php echo (($qty*ltrim($price,'$')));?></td>
													<td class="cart-product-sub-total"><?php echo $row['paym']; ?>  </td>
													<td class="cart-product-sub-total"><?php echo $row['odate']; ?>  </td>
												</tr>
												<?php $cnt=$cnt+1;} ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</form>
					
					<?php echo include('includes/brands-slider.php');?>
				</div>
			</div>	
			<?php include('includes/footer.php');?>

			<!-- all js -->
			<script src="assets/js/jquery-1.11.1.min.js"></script>	
			<script src="assets/js/bootstrap.min.js"></script>

	</body>
</html>
<?php } ?>
