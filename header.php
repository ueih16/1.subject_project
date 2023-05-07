<div id='header_div'>
	<ul>
		<li>
			<a href="index.php">
				Trang chủ
			</a>
		</li>
		<?php if (empty($_SESSION['id'])) { ?>
			<li>
				<a href="signin.php">
					Đăng nhập
				</a>
			</li>
			<li>
				<a href="signup.php">
					Đăng ký
				</a>
			</li>
			
		<?php }else{ ?>
			<li>
				Xin chào bạn <?php echo $_SESSION['name'] ?>, 
				<a href="signout.php">
					đăng xuất
				</a>
			</li>
			<li>
				<a href="view_cart.php">
					Xem giỏ hàng
				</a>
			</li>
		<?php } ?>
	</ul>
	<?php if (isset($_SESSION['error'])): ?>
		<h3 align="center" id="h3-error">
			<?php 
				echo $_SESSION['error'];
				unset($_SESSION['error']);
			?>
		</h3>	
	<?php endif ?>
	<?php if (isset($_SESSION['noti'])): ?>
		<h3 align="center" id="h3-noti">
			<?php 
				echo $_SESSION['noti'];
				unset($_SESSION['noti']);
			?>
		</h3>	
	<?php endif ?>
	<?php if (isset($_SESSION['success'])): ?>
		<h3 align="center" id="h3-success">
			<?php 
				echo $_SESSION['success'];
				unset($_SESSION['success']);
			?>
		</h3>	
	<?php endif ?>	
</div>
