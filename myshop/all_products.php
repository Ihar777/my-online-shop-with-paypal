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
		<a href="index.php"><img id="logo" src="images/logo.gif"></a>
		<img id="banner" src="images/ad_banner.gif">
	</div><!-- end of header_wrapper-->
	<div class="menubar">

		<ul id="menu">
			<li><a href="index.php">Home</a></li>
			<li><a href="all_products.php">All Products</a></li>
			<li><a href="customer/my_account.php">My Account</a></li>
			<li><a href="customer_register.php">Sign Up</a></li>
			<li><a href="cart.php">Shopping Cart</a></li>
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

		<div id="sidebar">

			<div id="sidebar_title">Categories</div>
			<ul id="cats">
				<?php getCats(); ?>
			</ul>

			<div id="sidebar_title">Brands</div>
			<ul id="cats">
				<?php getBrands(); ?>
			</ul>

		</div>

		<div id="content_area">

			<div id="shopping_cart">

				<span style="float: right; font-size:18px; padding: 5px; line-height: 40px;">

					Welcome Guest! <b style="color:yellow">Shopping Cart -</b> 
					Total Items: <?php if(isset($_POST['update_cart'])) echo $_SESSION['total_items']; else total_items(); ?> 
					Total Price: <?php if(isset($_SESSION['total_price'])) echo '$' . $_SESSION['total_price']; else total_price(); ?>
					<a href="cart.php" style="color:yellow">Go to Cart</a>

				</span>

			</div>

		<div id="products_box">

			<?php

				$get_pro = "SELECT * FROM products";

	$run_pro = mysqli_query($con, $get_pro);

	while($row_pro=mysqli_fetch_array($run_pro)) {

		$pro_id = $row_pro['product_id'];
		$pro_cat = $row_pro['product_cat'];
		$pro_brand = $row_pro['product_brand'];
		$pro_title = $row_pro['product_title'];
		$pro_price = $row_pro['product_price'];
		$pro_image = $row_pro['product_image'];

		echo "
			<div id='single_product'>

				<h3>$pro_title</h3>
				<img src='admin_area/product_images/$pro_image' width='180' height='180'>
				<p><b>$$pro_price</b></p>

				<a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
				<a href='index.php?pro_id=$pro_id'><button style='float:right'>Add to Cart</button></a>

			</div>

		";

	}
	?>
		</div>


	</div>
	</div><!-- end of content_wrapper-->
	<div id="footer">

		<h2 style="text-align:center; padding-top:30px;">&copy; <?php echo Date('Y'); ?> by 
			<a href="http://www.IharPetrushenka.com">Ihar Petrushenka</a></h2>

	</div>
</div><!-- end of main_wrapper-->
</body>
</html>