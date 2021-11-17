<?php
//takin ku sayang
require("../mainconfig.php");

$check_order = mysqli_query($db, "SELECT * FROM orders WHERE status IN ('Pending','Processing') AND provider IN ('SMP')");

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
					$p_apikey = "dcd963697d585eebe4629c1e472eb6b3424474a2";
			
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, "https://solosmartpedia.com/api/user?type=get_status_sosmed&id_order=$o_poid");
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST,'GET');
			curl_setopt($ch, CURLOPT_HTTPHEADER,array('X-API-KEY:'.$p_apikey));
			$result = curl_exec($ch);
			$gets = json_decode($result);
			curl_close($ch);
                $status = $gets->data->status;
                $start_count =  $gets->data->start_count;
                $remains =  $gets->data->remains;
					
			if ($o_provider == "SMP") {
				if ($status == "Pending") {
					$u_status = "Pending";
				} else if ($status == "Processing") {
					$u_status = "Processing";
				} else if ($status == "Error") {
					$u_status = "Error";
				} else if ($status == "Partial") {
					$u_status = "Partial";
				} else if ($status == "Completed") {
					$u_status = "Success";
				} else {
					$u_status = "Pending";
				}
			}
			
			$update_order = mysqli_query($db, "UPDATE orders SET status = '$u_status' WHERE poid = '$o_poid'");
			$update_order = mysqli_query($db, "UPDATE orders SET start_count = '$start_count' WHERE poid = '$o_poid'");
			$update_order = mysqli_query($db, "UPDATE orders SET remains = '$remains' WHERE poid = '$o_poid'");
			if ($update_order == TRUE) {
				echo "$o_poid status $u_status sisa $remains awal $start_count <br />";
			} else {
				echo "Error database.";
			}
		}
	}
}
?>