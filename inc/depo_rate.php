<?php
require("../mainconfig.php");

if (isset($_POST['method'])) {
	$method = mysqli_real_escape_string($db, $_POST['method']);
	$check_service = mysqli_query($db, "SELECT * FROM deposit_method WHERE id = '$method'");
	if (mysqli_num_rows($check_service) == 1) {
		$data_service = mysqli_fetch_assoc($check_service);
		$result = $data_service['rate'];
		echo $result;
	} else {
		die("0");
	}
} else {
	die("0");
}