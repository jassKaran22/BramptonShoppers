<?php 
session_start();
error_reporting(0);
include('includes/config.php');

//to update the quantity of products
if(isset($_POST['submit'])){
	if(!empty($_SESSION['cart'])){
		foreach($_POST['quantity'] as $key => $val){
			if($val == 0){
				unset($_SESSION['cart'][$key]);
			}else{
				$_SESSION['cart'][$key]['quantity'] = $val;
			}
		}
		echo "<script>alert('Your Cart has been Updated');</script>";
	}
}
// Code for Remove a Product from Cart
if(isset($_POST['remove_code'])){
	if(!empty($_SESSION['cart'])){
		foreach($_POST['remove_code'] as $key){	
			unset($_SESSION['cart'][$key]);
		}
		echo "<script>alert('Product has been removed from your cart');</script>";
	}
}

// code for insert product in order table
if(isset($_POST['ordersubmit'])){
		
	if(strlen($_SESSION['login'])==0){   
		header('location:login.php');
	}else{
		$quantity = $_POST['quantity'];
		$pdd = $_SESSION['pid'];
		$value = array_combine($pdd,$quantity);

		foreach($value as $qty=> $values){
			mysqli_query($con,"INSERT INTO orders(userId,productId,quantity) VALUES('".$_SESSION['id']."','$qty','$values')");
			header('location:payment-method.php');
		}
	}
}

//code to insert address 
if(isset($_POST['insertadress'])){
	//billing details
	$baddress = $_POST['billingaddress'];
	$bstate = $_POST['bilingstate'];
	$bcity = $_POST['billingcity'];
	$bpincode = $_POST['billingpincode'];
	
	//shipping details
	$saddress = $_POST['shippingaddress'];
	$sstate = $_POST['shippingstate'];
	$scity = $_POST['shippingcity'];
	$spincode = $_POST['shippingpincode'];
	
	//logged-in user id
	$userId = $_SESSION['id'];
	
	$check = mysqli_query($con, "SELECT * FROM user_billing_shipping_details WHERE user_id = ".$userId);
	$row = mysqli_num_rows($check);
	//echo $row;die;
	
	if( $row == 0){
		$query = mysqli_query($con,"INSERT INTO user_billing_shipping_details(user_id,billing_address, billing_city, billing_state, billing_postalCode,shipping_address,shipping_city,shipping_state,shipping_postalCode) VALUES('$userId','$baddress','$bcity','$bstate','$bpincode','$saddress','$scity','$sstate','$spincode')");
		if($query){
			echo "<script>alert('Address has been added');</script>";
		}	
	}else{
		echo "<script>alert(' not added');</script>";
	}
}

// code for billing address updation
if(isset($_POST['update'])){
	$baddress = $_POST['billingaddress'];
	$bstate = $_POST['bilingstate'];
	$bcity = $_POST['billingcity'];
	$bpincode = $_POST['billingpincode'];
	$userId = $_SESSION['id'];
	$adresId = $_POST['adres_id'];
	
	$query = mysqli_query($con,"UPDATE user_billing_shipping_details SET billing_address='$baddress',billing_city='$bcity',billing_state='$bstate',billing_postalCode='$bpincode' WHERE user_id='".$userId."' AND user_adres_id='".$adresId."'");
	if($query){
		echo "<script>alert('Billing Address has been updated');</script>";
	}
}

// code for Shipping address updation
if(isset($_POST['shipupdate'])){
	$saddress = $_POST['shippingaddress'];
	$sstate = $_POST['shippingstate'];
	$scity = $_POST['shippingcity'];
	$spincode = $_POST['shippingpincode'];
	$userId = $_SESSION['id'];
	$adresId = $_POST['adres_id'];

	$query = mysqli_query($con,"UPDATE user_billing_shipping_details SET shipping_address='$saddress',shipping_city='$scity',shipping_state='$sstate',shipping_postalCode='$spincode' WHERE user_id='".$userId."'AND user_adres_id='".$adresId."'");
	if($query){
		echo "<script>alert('Shipping Address has been updated');</script>";
	}	
}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Meta -->
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		
	    <title>My Cart</title>
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
									<?php if(!empty($_SESSION['cart'])){?>
										<table class="table table-bordered">
											<thead>
												<tr>
													<th class="cart-romove item">Remove</th>
													<th class="cart-description item">Image</th>
													<th class="cart-product-name item">Product Name</th>
													<th class="cart-qty item">Quantity</th>
													<th class="cart-sub-total item">Price Per unit</th>
													<th class="cart-sub-total item">Shipping Charge</th>
													<th class="cart-total last-item">Grandtotal</th>
												</tr>
											</thead>
											<tfoot>
												<tr>
													<td colspan="7">
														<div class="shopping-cart-btn">
															<span class="cart_buttons">
																<a href="index.php" class="btn btn-upper btn-primary outer-left-xs">Continue Shopping</a>
																
																<?php
																if(strlen($_SESSION['login'])==0){   
																	$btndisplay = 'hidebuton';
																}else{ 
																	$query = mysqli_query($con,"select * from user_billing_shipping_details where user_id='".$_SESSION['id']."'");
													
																	$row = mysqli_num_rows($query);
																	if($row == 0){
																		$btndisplay = 'hidebuton';
																	}else{
																		$btndisplay = 'displaybuton';
																	}	
																}?>
																<input type="submit" name="submit" value="Update shopping cart" class="btn btn-upper btn-primary pull-right outer-right-xs <?php echo $btndisplay?>">
															</span>
														</div>
													</td>
												</tr>
											</tfoot>
											<tbody>
												<?php
												$pdtid = array();
												
												$sql = "SELECT * FROM products WHERE id IN(";
												foreach($_SESSION['cart'] as $id => $value){
														$sql .=$id. ",";
												}
												$sql = substr($sql,0,-1) . ") ORDER BY id ASC";
												$query = mysqli_query($con,$sql);
												
												$totalprice = 0;
												$totalqunty = 0;
												
												if(!empty($query)){
													while($row = mysqli_fetch_array($query)){
														
														$quantity = $_SESSION['cart'][$row['id']]['quantity'];
														
														$price = ltrim($row['productPrice'],'$');
														
														$subtotal = $_SESSION['cart'][$row['id']]['quantity']*$price;
														
														$totalprice += $subtotal;
														
														$_SESSION['qnty'] = $totalqunty+=$quantity;

														array_push($pdtid,$row['id']);
												?>

													<tr>
														<td class="romove-item"><input type="checkbox" name="remove_code[]" value="<?php echo htmlentities($row['id']);?>" /></td>
														
														<td class="cart-image">
															<a class="entry-thumbnail" href="detail.html">
																<img src="admin/productimages/<?php echo $row['id'];?>/<?php echo $row['productImage1'];?>" alt="" width="114" height="146">
															</a>
														</td>
														
														<td class="cart-product-name-info">
															<h4 class='cart-product-description'>
																<a href="product-details.php?pid=<?php echo htmlentities($pd=$row['id']);?>" >
																	<?php echo $row['productName'];
																	$_SESSION['sid'] = $pd; ?>
																</a>
															</h4>
														</td>
														
														<td class="cart-product-quantity">
															<div class="quant-input">
																<input id="qunatity" type="text" value="<?php echo $_SESSION['cart'][$row['id']]['quantity']; ?>" name="quantity[<?php echo $row['id']; ?>]">	 
															</div>
														</td>
														
														<td class="cart-product-sub-total">
															<span class="cart-sub-total-price"><?php echo $row['productPrice']; ?>.00</span></td>
															
														<td class="cart-product-sub-total">
															<span class="cart-sub-total-price">$0.00</span>
														</td>

														<td class="cart-product-grand-total">
															<span class="cart-grand-total-price">$<?php echo ($_SESSION['cart'][$row['id']]['quantity']*$price
															); ?>.00</span>
														</td>
													</tr>
												<?php } }
												$_SESSION['pid'] = $pdtid; ?>
											</tbody>
										</table>
									</div>
								</div>
									
								<!-- Billing Address -->
								<?php
								if(strlen($_SESSION['login'])==0){   
									$displaysection = 'hidesection';
								}else{ 
									$displaysection = 'displaysection';
								}?>
								<div class="col-md-4 col-sm-12 estimate-ship-tax <?php echo $displaysection;?>">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>
													<span class="estimate-title">Billing Address</span>
												</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>
													<div class="form-group">
														<?php //echo $q = "select * from user_billing_shipping_details where user_id='".$_SESSION['id']."'";die;
														$query = mysqli_query($con,"select * from user_billing_shipping_details where user_id='".$_SESSION['id']."'");
														
														$row = mysqli_num_rows($query);
														
														if($row == 0){ ?>
															<div class="form-group">
																<label class="info-title" for="Billing Address">Billing Address<span>*</span></label>
																<textarea class="form-control unicase-form-control text-input"  name="billingaddress" required="required"><?php echo $row['billing_address'];?></textarea>
															</div>
															
															<div class="form-group">
																<label class="info-title" for="Billing City">Billing City <span>*</span></label>
																<input type="text" class="form-control unicase-form-control text-input" id="billingcity" name="billingcity" required="required" value="<?php echo $row['billing_city'];?>" >
															</div>
															
															<div class="form-group">
																<label class="info-title" for="Billing State ">Billing State  <span>*</span></label>
																<input type="text" class="form-control unicase-form-control text-input" id="bilingstate" name="bilingstate" value="<?php echo $row['billing_state'];?>" required>
															</div>
															
															<div class="form-group">
																<label class="info-title" for="Billing Pincode">Billing Pincode <span>*</span></label>
																<input type="text" class="form-control unicase-form-control text-input" id="billingpincode" name="billingpincode" required="required" value="<?php echo $row['billing_postalCode'];?>" >
															</div>
															
														<?php }else{ 
															while($row = mysqli_fetch_array($query)){?>
																<div class="form-group">
																<input type="hidden" value="<?php echo $row['user_adres_id'];?>" name="adres_id" />
																<label class="info-title" for="Billing Address">Billing Address<span>*</span></label>
																<textarea class="form-control unicase-form-control text-input"  name="billingaddress" required="required"><?php echo $row['billing_address'];?></textarea>
															</div>
															
															<div class="form-group">
																<label class="info-title" for="Billing City">Billing City <span>*</span></label>
																<input type="text" class="form-control unicase-form-control text-input" id="billingcity" name="billingcity" required="required" value="<?php echo $row['billing_city'];?>" >
															</div>
															
															<div class="form-group">
																<label class="info-title" for="Billing State ">Billing State  <span>*</span></label>
																<input type="text" class="form-control unicase-form-control text-input" id="bilingstate" name="bilingstate" value="<?php echo $row['billing_state'];?>" required>
															</div>
															
															<div class="form-group">
																<label class="info-title" for="Billing Pincode">Billing Pincode <span>*</span></label>
																<input type="text" class="form-control unicase-form-control text-input" id="billingpincode" name="billingpincode" required="required" value="<?php echo $row['billing_postalCode'];?>" >
															</div>
															
															<button type="submit" name="update" class="btn-upper btn btn-primary checkout-page-button">Update</button>
															<?php } ?>
														<?php } ?>
													</div>
												</td>
											</tr>
										</tbody>
									</table>
								</div>

								<!-- Shipping Address -->
								<div class="col-md-4 col-sm-12 estimate-ship-tax <?php echo $displaysection;?>">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>
													<span class="estimate-title">Shipping Address</span>
												</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>
													<div class="form-group">
													<?php
													$query = mysqli_query($con,"select * from user_billing_shipping_details where user_id='".$_SESSION['id']."'");
													
													$row = mysqli_num_rows($query);
														
													if($row == 0){ ?>
														<div class="form-group">
															<label class="info-title" for="Shipping Address">Shipping Address<span>*</span></label>
															<textarea class="form-control unicase-form-control text-input"  name="shippingaddress" required="required"><?php echo $row['shipping_address'];?></textarea>
														</div>
														
														<div class="form-group">
															<label class="info-title" for="Billing City">Shipping City <span>*</span></label>
															<input type="text" class="form-control unicase-form-control text-input" id="shippingcity" name="shippingcity" required="required" value="<?php echo $row['shipping_city'];?>" >
														</div>
														
														<div class="form-group">
															<label class="info-title" for="Billing State ">Shipping State  <span>*</span></label>
															<input type="text" class="form-control unicase-form-control text-input" id="shippingstate" name="shippingstate" value="<?php echo $row['shipping_state'];?>" required>
														</div>
														
														<div class="form-group">
															<label class="info-title" for="Billing Pincode">Shipping Pincode <span>*</span></label>
															<input type="text" class="form-control unicase-form-control text-input" id="shippingpincode" name="shippingpincode" required="required" value="<?php echo $row['shipping_postalCode'];?>" >
														</div>
														
														<button type="submit" name="insertadress" class="btn-upper btn btn-primary checkout-page-button">Insert</button>
													<?php }else{  
														while($row=mysqli_fetch_array($query)){	?>
														<div class="form-group">
															<input type="hidden" value="<?php echo $row['user_adres_id'];?>" name="adres_id" />
															<label class="info-title" for="Shipping Address">Shipping Address<span>*</span></label>
															<textarea class="form-control unicase-form-control text-input"  name="shippingaddress" required="required"><?php echo $row['shipping_address'];?></textarea>
														</div>
														
														<div class="form-group">
															<label class="info-title" for="Billing City">Shipping City <span>*</span></label>
															<input type="text" class="form-control unicase-form-control text-input" id="shippingcity" name="shippingcity" required="required" value="<?php echo $row['shipping_city'];?>" >
														</div>
														
														<div class="form-group">
															<label class="info-title" for="Billing State ">Shipping State  <span>*</span></label>
															<input type="text" class="form-control unicase-form-control text-input" id="shippingstate" name="shippingstate" value="<?php echo $row['shipping_state'];?>" required>
														</div>
														
														<div class="form-group">
															<label class="info-title" for="Billing Pincode">Shipping Pincode <span>*</span></label>
															<input type="text" class="form-control unicase-form-control text-input" id="shippingpincode" name="shippingpincode" required="required" value="<?php echo $row['shipping_postalCode'];?>" >
														</div>
														
														<button type="submit" name="shipupdate" class="btn-upper btn btn-primary checkout-page-button">Update</button>
														<?php } ?>
													<?php } ?>
													</div>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
								
								<!-- grand total -->
								<div class="col-md-4 col-sm-12 cart-shopping-total">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>
													<div class="cart-grand-total">
														Grand Total<span class="inner-left-md"><?php echo $_SESSION['tp']="$totalprice". ".00"; ?></span>
													</div>
												</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>
													<div class="cart-checkout-btn pull-right">
														<?php
														if(strlen($_SESSION['login'])==0){   ?> 
															<a href="http://localhost/BramptonShoppers/login.php" class="btn btn-primary">PROCCED TO CHEKOUT</a>
														<?php }else{ ?>
															<button type="submit" name="ordersubmit" class="btn btn-primary">PROCCED TO CHEKOUT</button>
														<?php }?>
													</div>
												</td>
											</tr>
										</tbody>
									</table>
								<?php } else {
									echo "Your shopping Cart is empty";
								}?>
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