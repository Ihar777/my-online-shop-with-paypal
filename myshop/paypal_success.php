<?php 
session_start();
 ?>
 
<html>
<head>
	<title>Payment Successful!</title>
</head>
<body>

	<?php
 		include("includes/db.php");
 		include("functions/functions.php");
 		//this is all for product details
 		$total = 0;

		global $con;

		$ip = getIp();

		$sel_price = "SELECT * FROM cart WHERE ip_add = '$ip'";

		$run_price = mysqli_query($con, $sel_price);

		while($p_price = mysqli_fetch_array($run_price)) {

			$pro_id = $p_price['p_id'];

			$pro_price = "SELECT * FROM products WHERE product_id = '$pro_id'";

			$run_pro_price = mysqli_query($con, $pro_price);

			while($pp_price = mysqli_fetch_array($run_pro_price)) {

				$product_price = array($pp_price['product_price']);
				
				$product_id = $pp_price['product_id'];
				$pro_name = $pp_price['product_title'];

				$values = array_sum($product_price);

				$total += $values;

			}

		}
		
				// getting quantity of the product
				
				$get_qty = "SELECT * FROM cart WHERE p_id='$pro_id' AND ip_add='$ip'"; // STARTING FROM "AND ip_add" - ADDED BY ME!
				
				$run_qty = mysqli_query($con, $get_qty);

				$row_qty = mysqli_fetch_array($run_qty);

				$qty = $row_qty['qty'];
				
				if($qty==0){
				$qty = 1;
				} else {
				
				$qty = $qty;
				$total = $total * $qty;
				
				}
		
				// this is about the customer
		
				$user = $_SESSION['customer_email'];

				$get_c = "SELECT * FROM customers WHERE customer_email='$user'";

				$run_c = mysqli_query($con, $get_c);

				$row_c = mysqli_fetch_array($run_c);
				
				$c_id = $row_c['customer_id'];
				$c_email = $row_c['customer_email'];
				$c_name = $row_c['customer_name'];
			
				//payment details from paypal
				
				$amount = $_GET['amt'];
				$currency = $_GET['cc'];
				$trx_id = $_GET['tx']; //transition id
				$invoice = mt_rand();
				
				// inserting the payment into table
				$insert_payment = "INSERT INTO payments (amount, customer_id,product_id, trx_id, currency,payment_date) 			 VALUES('$amount','$c_id','$pro_id','$trx_id','$currency',NOW())";
				
				$run_payments = mysqli_query($con, $insert_payment);
				
				// inserting the order into table
				$insert_order = "INSERT INTO orders (p_id,c_id,qty,invoice_no,order_date,status) VALUES('$pro_id','$c_id','$qty','$invoice',NOW(),'In progress')";
				$run_order = mysqli_query($con, $insert_order);
				
				//removing products from cart
				$empty_cart = "DELETE FROM cart WHERE p_id='$ip'"; //FROM "WHERE ..." ADDED BY ME
				$run_cart = mysqli_query($con,$empty_cart);
				
			if($amount == $total){
			
			echo "<h2>Welcome " . $_SESSION['customer_email'] . "<br>" . "You payment was successful!</h2>";
			echo "<a href='http://www.iharpetrushenka.com/myshop/customer/my_account.php'>Go to your account</a>";
			} else {
			echo "<h2>Welcome, Guest. Payment failed.</h2><br>";
			echo "<a href='http://www.iharpetrushenka.com/myshop'>Go back to shop</a>";
			
			}
			
					
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			$headers .= 'From: <sales@iharpetrushenka.com/myshop>' . "\r\n";
			
			$subject = "Order Details";
			
			$message = "<html> 
			<p>
			
			Hello dear <b style='color:blue;'>$c_name</b> you have ordered some products on our website iharpetrushenka.com/myshop, please find your order details, your order will be processed shortly. Thank you!</p>
			
				<table width='600' align='center' bgcolor='#FFCC99' border='2'>
			
					<tr align='center'><td colspan='6'><h2>Your Order Details from iharpetrushenka.com/myshop</h2></td></tr>
					
					<tr align='center'>
						<th><b>S.N</b></th>
						<th><b>Product Name</b></th>
						<th><b>Quantity</b></th>
						<th><b>Paid Amount</b></th>
						<th>Invoice No</th>
					</tr>
					
					<tr align='center'>
						<td>1</td>
						<td>$pro_name</td>
						<td>$qty</td>
						<td>$amount</td>
						<td>$invoice</td>
					</tr>
			
				</table>
				
				<h3>Please go to your account and see your order details!</h3>
				
				<h2> <a href='http://www.iharpetrushenka.com/myshop'>Click here</a> to login to your account</h2>
				
				<h3> Thank you for your order @ - www.iharpetrushenka.com/myshop</h3>
				
			</html>
		
			";
			
			mail($c_email,$subject,$message,$headers);
 ?>
	

</body>
</html>
