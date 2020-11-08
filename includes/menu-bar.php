<?php
//selected product id
$pid = intval($_GET['pid']); 

?>

<div class="header-nav animate-dropdown">
    <div class="container">
        <div class="yamm navbar navbar-default" role="navigation">
            <div class="navbar-header">
                <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
			
			<!-- get page url -->
			<?php $current_page = $_SERVER['REQUEST_URI'];
				//print_r($current_page);
				$url = parse_url($current_page, PHP_URL_QUERY);
				$catId = substr($url, 4);
				//die;
			?>
            <div class="nav-bg-class">
                <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
					<div class="nav-outer">
						<ul class="nav navbar-nav">
							<!-- active page highlight -->
							<?php if($url==''){
								//echo 'index';
								$class = 'active';
								$cls = '';
							}else{
								//echo 'cat';
								$cls = 'active';
								$class = '';
							} ?>
							<li class="dropdown yamm-fw <?php echo $class;?>">
								<a href="index.php" data-hover="dropdown" class="dropdown-toggle">Home</a>
							</li> 
							<?php 
							if($pid != ''){
								$quer_prod_table = mysqli_query($con,"SELECT category from products where id='$pid'");
								
								while ($rw = mysqli_fetch_array($quer_prod_table)) {
									$category_id = $rw['category'];
									
									$sql = mysqli_query($con,"SELECT id,categoryName FROM category limit 5");
									while($row=mysqli_fetch_array($sql)){ 
										if($row['id'] == $category_id){
											$cls= 'active';
										}else{
											$cls= '';
										}
									?>
										<li class="dropdown yamm <?php echo $cls;?>">
											<a href="category.php?cid=<?php echo $row['id'];?>"> <?php echo $row['categoryName'];?></a>
										</li>
									<?php }	
								}	
							}else{
								$sql = mysqli_query($con,"SELECT id,categoryName FROM category limit 5");
								while($row=mysqli_fetch_array($sql)){ 
									if($row['id'] == $catId){
										$cls= 'active';
									}else{
										$cls= '';
									}
								?>
									<li class="dropdown yamm <?php echo $cls;?>">
										<a href="category.php?cid=<?php echo $row['id'];?>"> <?php echo $row['categoryName'];?></a>
									</li>
								<?php }
							} ?>		
						</ul>
						<div class="clearfix"></div>				
					</div>
				</div>
            </div>
        </div>
    </div>
</div>