<?php
//selected product id
$pid = intval($_GET['pid']); 

?>

<div class="side-menu animate-dropdown outer-bottom-xs">
    <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Categories</div>  
	<!-- get page url -->
	<?php $current_page = $_SERVER['REQUEST_URI'];
		//print_r($current_page);
		$url = parse_url($current_page, PHP_URL_QUERY);
		$catId = substr($url, 4);
		//die;
	?>
    <nav class="yamm megamenu-horizontal" role="navigation">
        <ul class="nav">
            <li class="dropdown menu-item">
				<?php 
				if($pid != ''){
					$quer_prod_table = mysqli_query($con,"SELECT category from products where id='$pid'");
					
					while ($rw = mysqli_fetch_array($quer_prod_table)) {
						$category_id = $rw['category'];
						
						//echo $qr = "SELECT id,categoryName FROM category limit 4";	
						$sql = mysqli_query($con,"SELECT id,categoryName FROM category");
						while($row = mysqli_fetch_array($sql)){  
							if($row['id'] == $category_id){
								$cls= 'active';
							}else{
								$cls= '';
							}
						?>
							
							<a href="category.php?cid=<?php echo $row['id'];?>" class="dropdown-toggle <?php echo $cls;?>"><i class="icon fa fa-desktop fa-fw"></i>
							<?php echo $row['categoryName'];?></a>
						<?php }  
					}
				}else{ 
					//echo $qr = "SELECT id,categoryName FROM category limit 4";	
					$sql = mysqli_query($con,"SELECT id,categoryName FROM category");
					while($row = mysqli_fetch_array($sql)){    
						//print_r($row);
						if($row['id'] == $catId){
							$cls= 'active';
						}else{
							$cls= '';
						}
					?>
					<a href="category.php?cid=<?php echo $row['id'];?>" class="dropdown-toggle <?php echo $cls;?>"><i class="icon fa fa-desktop fa-fw"></i>
					<?php echo $row['categoryName'];?></a>
                <?php }                        	
				}?>
			</li>
		</ul>
    </nav>
</div>