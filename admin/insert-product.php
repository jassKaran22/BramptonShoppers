<?php
session_start();
include('include/config.php');

//check if admin login
if(strlen($_SESSION['alogin']) == 0){	
	header('location:index.php');
}else{	
	if(isset($_POST['submit'])){
		$category = $_POST['category'];
		$productname = $_POST['productName'];
		$productprice = $_POST['productPrice'];
		$productbrand = $_POST['productBrand'];
		$productquantity = $_POST['productquantity'];
		$productdescription = $_POST['productDescription'];
		$productimage1 = $_FILES["productimage1"]["name"];
		
		if(!empty($_FILES["productimage1"]["name"])) { 
			$image = $_FILES['productimage1']['tmp_name']; 
            $imgContent = addslashes(file_get_contents($image));
			
			$sql = mysqli_query($con,"INSERT INTO products(category, productName, productPrice, productDescription, productImage1,image_file) values('$category','$productname','$productprice','$productdescription','$productimage1','$imgContent')");
		
			if($sql){
				$insetedProduct_id = mysqli_insert_id($con);
				
				$subsql = mysqli_query($con,"INSERT INTO product_inventory(product_id,product_quantity, product_company) values('$insetedProduct_id','$productquantity','$productbrand')");
			}
			$_SESSION['msg'] = "Product Inserted!";	
		}		
	}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<title>Admin | Insert Product</title>
		
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
									<h3>Insert Product</h3>
								</div>
								<div class="module-body">
									<?php if(isset($_POST['submit'])){ ?>
										<div class="alert alert-success">
											<strong><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
										</div>
									<?php } ?>
									
									<!-- form to add new product -->
									<form class="form-horizontal row-fluid" name="insertproduct" method="post" enctype="multipart/form-data">
										<div class="control-group">
											<label class="control-label" for="basicinput">Category</label>
											<div class="controls">
												<select name="category" class="span8 tip" onChange="getSubcat(this.value);"  required>
													<option value="">Select Category</option> 
													<?php $query = mysqli_query($con,"SELECT * FROM category");
													while($row = mysqli_fetch_array($query)){ ?>
														<option value="<?php echo $row['id'];?>">
															<?php echo $row['categoryName'];?>
														</option>
													<?php } ?>
												</select>
											</div>
										</div>
										<!-- prod name -->
										<div class="control-group">
											<label class="control-label" for="basicinput">Product Name</label>
											<div class="controls">
												<input type="text" name="productName" placeholder="Enter Product Name" class="span8 tip" required>
											</div>
										</div>
										<!-- prod price -->
										<div class="control-group">
											<label class="control-label" for="basicinput">Product Price</label>
											<div class="controls">
												<input type="text" name="productPrice" placeholder="Enter Product Price" class="span8 tip" required>
											</div>
										</div>
										<!-- prod description -->
										<div class="control-group">
											<label class="control-label" for="basicinput">Product Description</label>
											<div class="controls">
												<textarea  name="productDescription"  placeholder="Enter Product Description" rows="6" class="span8 tip">
												</textarea>  
											</div>
										</div>
										<!-- prod image 1 -->
										<div class="control-group">
											<label class="control-label" for="basicinput">Product Image1</label>
											<div class="controls">
												<input type="file" name="productimage1" id="productimage1" value="" class="span8 tip" required>
											</div>
										</div>
										<!-- prod quantity -->
										<div class="control-group">
											<label class="control-label" for="basicinput">Product Quantity</label>
											<div class="controls">
												<input type="text" name="productquantity" placeholder="Enter Product Quantity" class="span8 tip" required>
											</div>
										</div>
										<!-- prod brand -->
										<div class="control-group">
											<label class="control-label" for="basicinput">Product Brand</label>
											<div class="controls">
												<input type="text" name="productBrand" placeholder="Enter Product Brand" class="span8 tip" required>
											</div>
										</div>
										<!-- insert button -->
										<div class="control-group">											
											<div class="controls">
												<button type="submit" name="submit" class="btn">Insert</button>
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
		<script src="scripts/datatables/jquery.dataTables.js"></script>
		
		<!-- custom data tables js -->
		<script>
			$(document).ready(function() {
				$('.datatable-1').dataTable();			
			});
		</script>
	
	</body>

<?php } ?>