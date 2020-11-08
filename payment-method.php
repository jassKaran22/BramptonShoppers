<?php 
session_start();
error_reporting(0);
include('includes/config.php');

if(strlen($_SESSION['login'])==0){   
	header('location:login.php');
}else{
	if (isset($_POST['submit'])) {
		mysqli_query($con,"UPDATE orders SET paymentMethod='".$_POST['paymethod']."' where userId='".$_SESSION['id']."' and paymentMethod is null ");
		unset($_SESSION['cart']);
		header('location:order-history.php');
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Meta -->
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		
	    <title>Payment</title>
	    
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
						<li><a href="home.html">Home</a></li>
						<li class='active'>Payment Method</li>
					</ul>
				</div>
			</div>
		</div>

		<div class="body-content outer-top-bd">
			<div class="container">
				<div class="checkout-box faq-page inner-bottom-sm">
					<div class="row">
						<div class="col-md-12">
							<h2>Choose Payment Method</h2>
							<div class="panel-group checkout-steps" id="accordion">
								<div class="panel panel-default checkout-step-01">
									<div class="panel-heading">
										<h4 class="unicase-checkout-title">
											Select your Payment Method
										</h4>
									</div>

									<div id="collapseOne" class="panel-collapse collapse in">
										<div class="panel-body">
											<form name="payment" method="post">
												<input type="radio" name="paymethod" value="COD" checked="checked"> COD <br /><br />
												<input type="submit" value="submit" name="submit" class="btn btn-primary">
											</form>		
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
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