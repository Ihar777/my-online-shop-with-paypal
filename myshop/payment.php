<?php 

include("includes/db.php");
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

				$product_name = $pp_price['product_title'];

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
				
				
				}
?>

<div>

<h2 align="center">Pay now with Paypal:</h2>
<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">

  <!-- Identify your business so that you can collect the payments. -->
  <input type="hidden" name="business" value="sriniv_1293527277_biz@inbox.com"> <!-- SHOULD BE: petrushen29@yahoo.com -->

  <!-- Specify a Buy Now button. -->
  <input type="hidden" name="cmd" value="_xclick">

  <!-- Specify details about the item that buyers will purchase. -->
  <input type="hidden" name="item_name" value="<?php echo $product_name; ?>">
  <input type="hidden" name="item_number" value="<?php echo $pro_id; ?>">
  <input type="hidden" name="amount" value="<?php echo $total; ?>">
  <input type="hidden" name="quantity" value="<?php echo $qty; ?>">
  <input type="hidden" name="currency_code" value="USD">

  <input type="hidden" name="return" value="http://www.iharpetrushenka.com/myshop/paypal_success.php">
  <input type="hidden" name="cancel_return" value="http://www.iharpetrushenka.com/myshop/paypal_cancel.php">

  <!-- Display the payment button. -->
  <input type="image" name="submit" border="0"
  src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/btn_buynow_107x26.png"
  alt="Buy Now">
  <img alt="" border="0" width="1" height="1"
  src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >

</form>


</div>