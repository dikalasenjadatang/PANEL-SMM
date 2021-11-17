<?php
require("mainconfig.php");
header("Content-Type: application/json");

if (isset($_POST['key']) AND isset($_POST['service'])) {
	$post_key = mysqli_real_escape_string($db, trim($_POST['key']));
	$post_service = $_POST['service'];
	if (empty($post_key) || empty($post_service)) {
		$array = array("error" => "Incorrect request");
		$print = json_encode($array);
print_r($print);
	} else {
		$check_user = mysqli_query($db, "SELECT * FROM users WHERE api_key = '$post_key'");
		$data_user = mysqli_fetch_assoc($check_user);
		if (mysqli_num_rows($check_user) == 1) {
			$username = $data_user['username'];
			if ($post_service == "sosmed") {
			    $serq = mysqli_query($db,"SELECT * FROM services order by id ");
			    $isinya = mysqli_num_rows($serq);
			    
  $i=0;
			    while($rowss = mysqli_fetch_assoc($serq)){
			      $data[$i]['no'] = $rowss['id'];
			    $data[$i]['category'] = $rowss['category']; 
			    $data[$i]['name'] = $rowss['service'];
			    $data[$i]['note'] = $rowss['note'];
			    $data[$i]['min'] = $rowss['min'];
			    $data[$i]['max'] = $rowss['max'];
			    $data[$i]['price'] = $rowss['price'];
			    $i++;
			    }
			}else if ($post_service == "pulsa") {
			       $serq = mysqli_query($db,"SELECT * FROM services_pulsa order by id ");
			    $isinya = mysqli_num_rows($serq);
			    
  $i=0;
			    while($rowss = mysqli_fetch_assoc($serq)){
			      $data[$i]['no'] = $rowss['id'];
			    $data[$i]['category'] = $rowss['oprator']; 
			    $data[$i]['price'] = $rowss['price'];
			    $i++;
			    }
			   
			}
			 
			    $print = json_encode($data);
print_r($print);
		} else{
		    	$array = array("error" => "API KEY NOT FOUND");
		    	$print = json_encode($array);
print_r($print);
		}
	}
	
} else{
	$array = array("error" => "Incorrect request");
	$print = json_encode($array);
print_r($print);
}

