<?php 
session_start();
include("functions/functions.php");
 ?>
<html>
<head>
	<title>My Online Shop</title>
	<link rel="stylesheet" type="text/css" href="styles/styles.css" media="all">
</head>
<body>

<div class="main_wrapper">
	<div class="header_wrapper">
		<a href="../index.php"><img id="logo" src="images/logo.gif"></a>
		<img id="banner" src="images/ad_banner.gif">
	</div><!-- end of header_wrapper-->
	<div class="menubar">

		<ul id="menu">
			<li><a href="../index.php">Home</a></li>
			<li><a href="../all_products.php">All Products</a></li>
			<li><a href="#">My Account</a></li>
			<li><a href="../customer_register.php">Sign Up</a></li>
			<li><a href="../cart.php">Shopping Cart</a></li>
			<li><a href="#">Contact Us</a></li>
		</ul>

		<div id="form">
			<form method="get" action="results.php" enctype="multipart/form-data">
				<input type="text" name="user_query" placeholder="Search a product">
				<input type="submit" name="search" value="Search">
			</form>
		</div>

		</div><!-- end of menubar-->
	<div class="content_wrapper">

		<div id="sidebar" <?php if(!isset($_SESSION['customer_email'])) echo "hidden"; ?> >

			

			<div id="sidebar_title">My Account:</div>
			<ul id="cats">
				<?php 
				
				
				$user = $_SESSION['customer_email'];

				$get_img = "SELECT * FROM customers WHERE customer_email='$user'";

				$run_img = mysqli_query($con, $get_img);

				$row_img = mysqli_fetch_array($run_img);

				$c_image = $row_img['customer_image'];

				$c_name = $row_img['customer_name'];

				echo "<p style='text-align: center; padding:10px 10px;'><img src='customer_images/$c_image' width='150' height='150'></p>";
				
				 ?>
				
				
				<li style='padding-top: 10px;'><a href="my_account.php?my_orders">My Orders</a></li>
				<li><a href="my_account.php?edit_account">Edit Account</a></li>
				<li><a href="my_account.php?change_pass">Change Password</a></li>
				<li><a href="my_account.php?delete_account">Delete Account</a></li>
				<li style='padding-bottom: 10px;'><a href="logout.php">Logout</a></li>

			</ul>

		</div>

		

		<div id="content_area" <?php if(!isset($_SESSION['customer_email'])) echo "style='width: 1000px; text-align: center; height: 440px;' " ?> >

			<?php cart(); ?>

			<div id="shopping_cart" <?php if(!isset($_SESSION['customer_email'])) echo "style='width: 1000px;'" ?>>

				<span style="float: right; font-size:17px; padding: 5px; line-height: 40px;">

					<?php 
					if(isset($_SESSION['customer_email'])){
					echo "<b>Welcome: </b>" . $_SESSION['customer_email'];
					}
					
					?>

					


					<?php 

					if(!(isset($_SESSION['customer_email']))){

						echo "<a href='../checkout.php' style='color: Orange'>Login</a>";
					} else {

						echo "<a href='logout.php' style='color: Orange'>Logout</a>";
					
					}

					 ?>
				</span>

			</div>

		<div id="products_box" style='margin-left: 0' <?php if(!isset($_SESSION['customer_email'])) echo "style='width: 1000px; text-align: center;'" ?>>

			<?php 
			if(!isset($_GET['my_orders'])) {
				if(!isset($_GET['edit_account'])) {
					if(!isset($_GET['change_pass'])) {
						if(!isset($_GET['delete_account'])) {
					echo "
					<h2 style='padding:20px;'>Welcome: "; if(!isset($c_name)){ echo "Guest"; } else { echo $c_name; } echo "</h2>
					<b>You can see your orders progress by clicking this <a href="; if(isset($c_name)){ echo "my_account.php?my_orders"; } else { echo "../checkout.php"; } echo ">link</a></b>";
			}
			}
			}
			} 


			 if(isset($_GET['change_pass'])){
			 	include("change_pass.php");
			 }
			  if(isset($_GET['delete_account'])){
			 	include("delete_account.php");
			 }
			  if(isset($_GET['my_orders'])){
			 	include("my_orders.php");
			 }

			  ?>

		</div>
 <?php 
			 if(isset($_GET['edit_account'])){
			 	include("edit_account.php");
			 }

?>

	</div>
	</div><!-- end of content_wrapper-->
	<div id="footer">

		<h2 style="text-align:center; padding-top:30px;">&copy; <?php echo Date('Y'); ?> by 
			<a href="http://www.IharPetrushenka.com">Ihar Petrushenka</a></h2>

	</div>
</div><!-- end of main_wrapper-->
</body>
</html>