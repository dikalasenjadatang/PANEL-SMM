<?php
//takin ku sayang
require("../mainconfig.php");

$check_order = mysqli_query($db, "SELECT * FROM orders WHERE status IN ('Pending','Processing') AND provider IN ('PM')");

if (mysqli_num_rows($check_order) == 0) {
	die("Order Pending not found.");
} else {
	while($data_order = mysqli_fetch_assoc($check_order)) {
		$o_oid = $data_order['id'];
		$o_poid = $data_order['poid'];
		$o_provider = $data_order['provider'];
		if ($o_provider == "MANUAL") {
			echo "Order manual<br />";
		} else {
			
			$p_apikey = "5iyRYA8h0IdSHpGzCwKx6J91aolQLP";
			
			if ($o_provider == "PM") {
				$api_postdata = "api_key=$p_apikey&action=status&id=$o_poid";
			} else {
				die("System error!");
			}
			
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, "https://medanpedia.co.id/api/json.php");
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $api_postdata);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			$chresult = curl_exec($ch);
			curl_close($ch);
			$json_result = json_decode($chresult, true);
			$cron = $json_result['data']['start_count'];
			$remains = $json_result['data']['remains'];
			if ($o_provider == "PM") {
				if ($json_result['data']['status'] == "Pending") {
					$u_status = "Pending";
				} else if ($json_result['data']['status'] == "Processing") {
					$u_status = "Processing";
				} else if ($json_result['data']['status'] == "Error") {
					$u_status = "Error";
				} else if ($json_result['data']['status'] == "Partial") {
					$u_status = "Partial";
				} else if ($json_result['data']['status'] == "Success") {
					$u_status = "Success";
				} else {
					$u_status = "Pending";
				}
			}
			
			$update_order = mysqli_query($db, "UPDATE orders SET status = '$u_status' WHERE poid = '$o_poid'");
			$update_order = mysqli_query($db, "UPDATE orders SET start_count = '$cron' WHERE poid = '$o_poid'");
			$update_order = mysqli_query($db, "UPDATE orders SET remains = '$remains' WHERE poid = '$o_poid'");
			if ($update_order == TRUE) {
				echo "$o_poid status $u_status sisa $remains awal $cron <br />";
			} else {
				echo "Error database.";
			}
		}
	}
}
?>