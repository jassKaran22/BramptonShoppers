<?php 
//echo 'working';
//print_r($_SESSION);die;
?>

	<div class="top-bar animate-dropdown">
		<div class="container">
			<div class="header-top-inner">
				<div class="cnt-account">
					<ul class="list-unstyled">
						<?php if(strlen($_SESSION['login']))
						{ 
							//echo 'hav user data';die;	
						?>
							<li><a href="#">Hello - <?php echo $_SESSION['username'];?></a></li>
						<?php } ?>
							<li><a href="my-account.php">My Account</a></li>
							<li><a href="my-cart.php">My Cart</a></li>
						<?php if(strlen($_SESSION['login'])==0)
						{   
							//echo 'when no user data';die;	
						?>
							<li><a href="login.php">Login</a></li>
						<?php }
						else{ ?>
							<li><a href="logout.php">Logout</a></li>
						<?php } ?>	
					</ul>
				</div>						
				<div class="clearfix"></div>
			</div>
		</div>
	</div>