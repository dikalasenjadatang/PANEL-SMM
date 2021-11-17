<?php
require("../mainconfig.php");

if (isset($_POST['service'])) {
	$post_sid = mysqli_real_escape_string($db, $_POST['service']);
	$check_service = mysqli_query($db, "SELECT * FROM services_diamond WHERE id = '$post_sid' AND status = 'Active'");
	if (mysqli_num_rows($check_service) == 1) {
		$data_service = mysqli_fetch_assoc($check_service);
		$result = $data_service['price'];
		echo $result;
	} else {
		die("0");
	}
} else {
	die("0");
}