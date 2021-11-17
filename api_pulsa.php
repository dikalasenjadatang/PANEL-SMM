<?php
require("mainconfig.php");
header("Content-Type: application/json");

if (isset($_POST['key']) AND isset($_POST['action'])) {
	$post_key = mysqli_real_escape_string($db, trim($_POST['key']));
	$post_action = $_POST['action'];
	$post_action = $_POST['action'];
	if (empty($post_key) || empty($post_action)) {
		$array = array("error" => "Incorrect request");
	} else {
		$check_user = mysqli_query($db, "SELECT * FROM users WHERE api_key = '$post_key'");
		$data_user = mysqli_fetch_assoc($check_user);
		if (mysqli_num_rows($check_user) == 1) {
			$username = $data_user['username'];
			if ($post_action == "add") {
				if (isset($_POST['service']) AND isset($_POST['phone'])) {
					$post_service = $_POST['service'];
					$post_phone = $_POST['phone'];
					if (empty($post_service) || empty($post_phone)) {
						$array = array("error" => "Incorrect request");
					} else {
						$check_service = mysqli_query($db, "SELECT * FROM services_pulsa WHERE id = '$post_service' AND status = 'Active'");
						$data_service = mysqli_fetch_assoc($check_service);
						if (mysqli_num_rows($check_service) == 0) {
							$array = array("error" => "Service not found");
						} else {
							$oid = random_number(5);
							$price = $data_service['price'];
							$service = $data_service['name'];
							$pid = $data_service['pid'];
							if ($data_user['balance'] < $price) {
								$array = array("error" => "Low Balance");
							} else {
							   
$key = "5iyRYA8h0IdSHpGzCwKx6J91aolQLP"; // your api key
$postdata = "api_key=$key&action=order&service=$pid&data=$post_phone";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://medanpedia.co.id/pulsa/json.php");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$chresult = curl_exec($ch);
curl_close($ch);
$json_result = json_decode($chresult, true);
$poid = $json_result['data']['id'];
			if (!$poid) {
			    $msg = $json_result['data']['msg'];
									$array = array("error" => "Server maintenance : $msg");
								} else {
									$update_user = mysqli_query($db, "UPDATE users SET balance = balance-$price WHERE username = '$username'");
									if ($update_user == TRUE) {
										$insert_order = mysqli_query($db, "INSERT INTO orders_pulsa (oid, pid, user, service, phone, price, status, date, place_from) VALUES ('$oid', '$poid', '$username', '$service', '$post_phone', '$price', 'Pending', '$date', 'API')");
										if ($insert_order == TRUE) {
											$array = array("order_id" => "$oid");
										} else {
											$array = array("error" => "System error");
										}
									} else {
										$array = array("error" => "System error");
									}
								}
							}
						}
					}
				} else {
					$array = array("error" => "Incorrect request");
				}
			} else if ($post_action == "status") {
				if (isset($_POST['order_id'])) {
					$post_oid = $_POST['order_id'];
					$post_oid = $_POST['order_id'];
					$check_order = mysqli_query($db, "SELECT * FROM orders_pulsa WHERE oid = '$post_oid' AND user = '$username'");
					$data_order = mysqli_fetch_array($check_order);
					if (mysqli_num_rows($check_order) == 0) {
						$array = array("error" => "Order not found");
					} else {
						$array = array("charge" => $data_order['price'], "status" => $data_order['status'], "Phone" => $data_order['phone'], "No SN" => $data_order['sn']);
					}
				} else {
					$array = array("error" => "Incorrect request");
				}
			} else {
				$array = array("error" => "Wrong action");
			}
		} else {
			$array = array("error" => "Invalid API key");
		}
	}
} else {
	$array = array("error" => "Incorrect request");
}

$print = json_encode($array);
print_r($print);