<?php
session_start();
include('include/config.php');

//check if admin login
if(strlen($_SESSION['alogin']) == 0){	
	header('location:index.php');
}else{
	//print_r($_POST);die;
	
	//to create new category
	if(isset($_POST['submit'])){
		$category = $_POST['category'];
		$description = $_POST['description'];
		$sql = mysqli_query($con,"INSERT INTO category(categoryName,categoryDescription) values('$category','$description')");
		$_SESSION['msg'] = "Category Created!";
	}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<title>Admin | Category</title>
		
		<!-- bootstrap -->
		<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
		<link type="text/css" href="css/theme.css" rel="stylesheet">
		<!-- font-awesome -->
		<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
	</head>
	
	<body>
		<?php include('include/header.php');?>
		<div class="wrapper">
			<div class="container">
				<div class="row">
					<?php include('include/sidebar.php');?>				
					<div class="span9">
						<div class="content">
							<div class="module">
								<div class="module-head">
									<h3>Category</h3>
								</div>
								<div class="module-body">
									<?php if(isset($_POST['submit'])){ ?>
										<div class="alert alert-success">
											<strong><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
										</div>
									<?php } ?>
									<br />
									<!-- form to create new category -->
									<form class="form-horizontal row-fluid" name="Category" method="post" >
										<!-- name -->
										<div class="control-group">
											<label class="control-label" for="basicinput">Category Name</label>
											<div class="controls">
												<input type="text" placeholder="Enter category Name"  name="category" class="span8 tip" required>
											</div>
										</div>
										<!-- description -->
										<div class="control-group">
											<label class="control-label" for="basicinput">Description</label>
											<div class="controls">
												<textarea class="span8" name="description" rows="5"></textarea>
											</div>
										</div>
										<!-- create button -->	
										<div class="control-group">
											<div class="controls">
												<button type="submit" name="submit" class="btn">Create</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php include('include/footer.php');?>

		<!-- all js files -->
		<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
		<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
		<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
		
	</body>
<?php } ?>