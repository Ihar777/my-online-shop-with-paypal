<?php 
ob_start();
$timezome = date_default_timezone_set("Europe/Minsk");
$con = mysqli_connect("localhost", "", "", "ecommerce");

if(mysqli_connect_errno()){
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

?>