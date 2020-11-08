<?php
session_start();
error_reporting(0);
include("include/config.php");

//check admin login
if(isset($_POST['submit'])){
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	$ret = mysqli_query($con,"SELECT * FROM admin WHERE username='$username' and password='$password'");
	$num = mysqli_fetch_array($ret);
	
	if($num>0){
		//echo 'if sucess';die;
		$after_login_page = "admin-account.php";//
		$_SESSION['alogin'] = $_POST['username'];
		$_SESSION['id'] = $num['id'];
		$host = $_SERVER['HTTP_HOST'];
		$uri = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
		header("location:http://$host$uri/$after_login_page");
		exit();
	}else{
		//echo 'if fail';die;
		$_SESSION['errmsg'] = "Invalid username or password";
		$login_fail_page = "index.php";
		$host  = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
		header("location:http://$host$uri/$login_fail_page");
		exit();
	}
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<title>Admin login</title>
		
		<!-- bootstrap -->
		<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
		<link type="text/css" href="css/theme.css" rel="stylesheet">
		<!-- font-awesome -->
		<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
	</head>
	
	<body>
		<div class="navbar navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
						<i class="icon-reorder shaded"></i>
					</a>
					<a class="brand" href="index.php">
						BramptonShoppers | Admin
					</a>
					<div class="nav-collapse collapse navbar-inverse-collapse">
						<ul class="nav pull-right">
							<li><a href="http://localhost/shopEverything"></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<div class="wrapper">
			<div class="container">
				<div class="row">
					<div class="module module-login span4 offset4">
						<form class="form-vertical" method="post">
							<div class="module-head">
								<h3>Sign In</h3>
							</div>
							<span style="color:red;" ><?php echo htmlentities($_SESSION['errmsg']); ?><?php echo htmlentities($_SESSION['errmsg']="");?></span>
							<div class="module-body">
								<div class="control-group">
									<div class="controls row-fluid">
										<input class="span12" type="text" id="inputEmail" name="username" placeholder="Username">
									</div>
								</div>
								<div class="control-group">
									<div class="controls row-fluid">
										<input class="span12" type="password" id="inputPassword" name="password" placeholder="Password">
									</div>
								</div>
							</div>
							<div class="module-foot">
								<div class="control-group">
									<div class="controls clearfix">
										<button type="submit" class="btn btn-primary pull-right" name="submit">Login</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<div class="footer">
			<div class="container">
			<b class="copyright">&copy; BramptonShoppers</b>
			</div>
		</div>
	
		<!-- all js files -->
		<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
		<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
		<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	
	</body>