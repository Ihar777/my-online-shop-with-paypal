<table width = "795" align = "center" bgcolor = "Pink">

	<tr align="center">
		<td colspan="6"><h2>View All Payments Here</h2></td>
	</tr>

	<tr align="center" bgcolor="SkyBlue">
		<th>S.N.</th>
		<th>Customer Email</th>
		<th>Product (S)</th>
		<th>Paid Amount</th>
		<th>Transaction ID</th>
		<th>Payment Date</th>
	</tr>
	<?php 
	include("includes/db.php");
				

	$get_payment = "SELECT * FROM payments";

	$run_payment = mysqli_query($con, $get_payment);

	$i = 0;

	while($row_payment = mysqli_fetch_array($run_payment)){

		$amount = $row_payment['amount'];
		$trx_id = $row_payment['trx_id'];
		$payment_date = $row_payment['payment_date'];
		$pro_id = $row_payment['product_id'];
		$c_id = $row_payment['customer_id'];
		$i++;

		
		$get_pro = "SELECT * FROM products WHERE product_id='$pro_id'";
		$run_pro = mysqli_query($con,$get_pro);
		
		$row_pro = mysqli_fetch_array($run_pro);
		
		$pro_image = $row_pro['product_image'];
		$pro_title = $row_pro['product_title'];

		$get_c = "SELECT * FROM customers WHERE customer_id='$c_id'";
		$run_c = mysqli_query($con, $get_c);

		$row_c = mysqli_fetch_array($run_c);

		$c_email = $row_c['customer_email'];

	 ?>
	 <tr align="center">
	 	<td><?php echo $i; ?></td>
	 	<td><?php echo $c_email; ?></td>
	 	<td><?php echo $pro_title; ?><br>	
	 	<img src="../admin_area/product_images/<?php echo $pro_image; ?>" width="60" height="60">
	 	</td>	 	
	 	<td><?php echo $amount; ?></td>
	 	<td><?php echo $trx_id; ?></td>
	 	<td><?php echo $payment_date; ?></td>
	 </tr>

	 <?php }  ?>

</table>