<?php
session_start();
error_reporting(0);
include('includes/config.php');

// For User Registration Form
if(isset($_POST['register']))
{
	//print_r($_POST);
	$name = $_POST['name'];
	$email = $_POST['email'];
	$contactno = $_POST['contact'];
	$password = md5($_POST['password']);
	
	//echo $sql = "insert into users(name,email,contactno,password) values('$name','$email','$contactno','$password')";
	$query = mysqli_query($con,"insert into users(name,email,contactno,password) values('$name','$email','$contactno','$password')");
	if($query)
	{
		//echo 'here';die;
		echo "<script>alert('Registered Successfully!');</script>";
	}
	else{
		//echo 'in else';die;
		echo "<script>alert('Please try again!');</script>";
	}
}


// For User login form
if(isset($_POST['login']))
{
	//print_r($_POST);
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	//echo $sql = "SELECT * FROM users WHERE email='$email' and password='$password'";
	$query = mysqli_query($con,"SELECT * FROM users WHERE email='$email' and password='$password'");
	$num = mysqli_fetch_array($query);
	//echo $num;
	
	if($num>0)
	{
		//echo 'here I am!';die;
		//print_r($_SERVER);die;
		$after_login_page ="my-cart.php";
		$_SESSION['login'] = $_POST['email'];
		$_SESSION['id'] = $num['id'];
		$_SESSION['username'] = $num['name'];
		$host = $_SERVER['HTTP_HOST'];
		$uri = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
		header("location:http://$host$uri/$after_login_page");
		exit();
	}
	else
	{
		//echo 'in else condition';die;
		$on_loginfail_page = "login.php";
		$email = $_POST['email'];		
		$host = $_SERVER['HTTP_HOST'];
		$uri = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
		header("location:http://$host$uri/$on_loginfail_page");
		$_SESSION['errmsg'] = "Invalid Email or Password";
		exit();
	}
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		
	    <title>SignIn & Registration</title>

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
		<!-- Breadcrumb section -->
		<div class="breadcrumb">
			<div class="container">
				<div class="breadcrumb-inner">
					<ul class="list-inline list-unstyled">
						<li><a href="home.html">Home</a></li>
						<li class='active'>Authentication</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- Main section -->
		<div class="body-content outer-top-bd">
			<div class="container">
				<div class="sign-in-page inner-bottom-sm">
					<div class="row">
						<!-- Log In Form Starts -->			
						<div class="col-md-6 col-sm-6 sign-in">
							<h4 class="">SIGN IN</h4>
							<form id="loginForm" class="register-form outer-top-xs" method="post">
								<span style="color:red;" >
									<?php
									echo htmlentities($_SESSION['errmsg']);
									?>
									<?php
									echo htmlentities($_SESSION['errmsg'] = "");
									?>
								</span>
								<!-- For user email -->
								<div class="form-group">
									<label class="info-title" for="exampleInputEmail1">Email <span>*</span></label>
									<input type="email" name="email" class="form-control unicase-form-control text-input" id="exampleInputEmail1" required>
								</div>
								<!-- For user password -->
								<div class="form-group">
									<label class="info-title" for="exampleInputPassword1">Password <span>*</span></label>
									<input type="password" name="password" class="form-control unicase-form-control text-input" id="exampleInputPassword1" required>
								</div>
								<button id="login_button" type="submit" class="btn-upper btn btn-primary checkout-page-button" name="login">Login</button>
							</form>					
						</div>


						<!-- Registration Form Starts-->
						<div class="col-md-6 col-sm-6 create-new-account">
							<h4 class="checkout-subtitle">CREATE AN ACCOUNT</h4>
							<form class="register-form outer-top-xs" role="form" method="post" name="register">
								<!-- For user name -->
								<div class="form-group">
									<label class="info-title" for="name">Full Name <span>*</span></label>
									<input type="text" class="form-control unicase-form-control text-input" id="name" name="name" required>
								</div>
								<!-- For user email -->
								<div class="form-group">
									<label class="info-title" for="exampleInputEmail2">Email Address <span>*</span></label>
									<input type="email" class="form-control unicase-form-control text-input" id="email" name="email" required>
								</div>
								<!-- For user contact -->
								<div class="form-group">
									<label class="info-title" for="contactno">Contact No. <span>*</span></label>
									<input type="text" class="form-control unicase-form-control text-input" id="contactno" name="contact" maxlength="10" required>
									<span id="contact_valid" style="color: red; display: none;">Please enter numbers only!</span>
								</div>
								<!-- For user password -->
								<div class="form-group">
									<label class="info-title" for="password">Password <span>*</span></label>
									<input type="password" class="form-control unicase-form-control text-input" id="password" name="password" required>
								</div>
								<button type="submit" name="register" class="btn-upper btn btn-primary checkout-page-button" id="register">Sign Up</button>
							</form>		
						</div>	
					</div>
				</div>
				<?php include('includes/brands-slider.php');?>
			</div>
		</div>
		
		<?php include('includes/footer.php');?> 
	
		<script type="text/javascript" src="assets/js/jquery-1.11.1.min.js"></script>	
		<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
		
		<!-- custom js -->
		<script>
		$(document).ready(function(){
			//check if login details are inserted
			$('#login_button').on('click',function(){
				if($("#exampleInputEmail1").val() == ""){
					$("#exampleInputEmail1").addClass('warningClass');
					$("#exampleInputPassword1").removeClass('warningClass');
					return false;
				}else if($("#exampleInputPassword1").val() == ""){
					$('#exampleInputEmail1').removeClass('warningClass');
					$("#exampleInputPassword1").addClass('warningClass');
					return false;
				}else{
					return true;
				}
			});	
			//check if signup details are inserted
			$('#register').on('click',function(){
				if($("#name").val() == ""){
					$("#name").addClass('warningClass');
					$("#email").removeClass('warningClass');
					$("#contactno").removeClass('warningClass');
					$("#password").removeClass('warningClass');
					return false;
				}else if($("#email").val() == ""){
					$("#email").addClass('warningClass');
					$('#name').removeClass('warningClass');
					$("#contactno").removeClass('warningClass');
					$("#password").removeClass('warningClass');
					return false;
				}else if($("#contactno").val() == ""){
					$("#contactno").addClass('warningClass');
					$('#name').removeClass('warningClass');
					$("#email").removeClass('warningClass');
					$("#password").removeClass('warningClass');
					return false;
				}else if($("#password").val() == ""){
					$("#password").addClass('warningClass');
					$('#name').removeClass('warningClass');
					$("#email").removeClass('warningClass');
					$("#contactno").removeClass('warningClass');
					return false;
				}else{
					return true;
				}	
			});	
			
			//check for contact number: containing number only
			$("#contactno").keyup(function(){
				var contact = $(this).val();
				var numericReg = /^\d*[0-9](|.\d*[0-9]|,\d*[0-9])?$/;
				if(!(numericReg.test(contact))){
					$('#contact_valid').css('display','block');
					$('#password').attr('disabled', 'disabled');
					$('#register').attr('disabled', 'disabled');
				}else{
					$('#contact_valid').css('display','none');
					$('#password').removeAttr('disabled');
					$('#register').removeAttr('disabled');
				}
			});				
		});
		</script>

</body>
</html>