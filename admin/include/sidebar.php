	<div class="span3">
		<div class="sidebar">
			<!-- get page url -->
			<?php $current_page = $_SERVER['REQUEST_URI'];
				//print_r($current_page);
				$url = basename($current_page);
				$pageName = substr($url, 0, -4);
				//die;
				
				if($pageName == 'all-users'){
					$class = 'active';
					$cls = '';
					$activeCls = '';
				}else if($pageName == 'category'){
					$cls = 'active';
					$class = '';
					$activeCls = '';
				}else if($pageName == 'insert-product'){
					$activeCls = 'active';
					$class = '';
					$cls = '';
				}else{
					$activeCls = '';
					$class = '';
					$cls = '';
				}
			?>
		
			<ul class="widget widget-menu unstyled">
				<li>
					<a class="<?php echo $class;?>" href="all-users.php">
						<i class="menu-icon icon-group"></i>
						All users
					</a>
				</li>
			</ul>
					
			<ul class="widget widget-menu unstyled">
				<li><a class="<?php echo $cls;?>" href="category.php"><i class="menu-icon icon-tasks"></i> Create Category </a></li>
				<li><a class="<?php echo $activeCls;?>" href="insert-product.php"><i class="menu-icon icon-paste"></i>Insert Product </a></li>
			</ul>

			<ul class="widget widget-menu unstyled">
				<li><a href="logout.php"><i class="menu-icon icon-signout"></i>Logout</a></li>
			</ul>
		</div>
	</div>
