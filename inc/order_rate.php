<?php
require("../mainconfig.php");

if (isset($_POST['service'])) {
	$post_sid = mysqli_real_escape_string($db, $_POST['service']);
	$check_service = mysqli_query($db, "SELECT * FROM services WHERE sid = '$post_sid' AND status = 'Active'");
	if (mysqli_num_rows($check_service) > 0) {
		$data_service = mysqli_fetch_assoc($check_service);
		$result = $data_service['price'] / 1000;
		echo $result;
	} else {
		die("0");
	}
} else {
	die("0");
}