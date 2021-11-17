<?php
session_start();
require("mainconfig.php");

if (isset($_SESSION['user'])) {
	$sess_username = $_SESSION['user']['username'];
	$check_user = mysqli_query($db, "SELECT * FROM users WHERE username = '$sess_username'");
	$data_user = mysqli_fetch_assoc($check_user);
	if (mysqli_num_rows($check_user) == 0) {
		header("Location: ".$cfg_baseurl."logout.php");
	} else if ($data_user['status'] == "Suspended") {
		header("Location: ".$cfg_baseurl."logout.php");
	}

	include("lib/header.php");
	$msg_type = "nothing";

	if (isset($_POST['order'])) {
		$post_service = $_POST['service'];
		$post_quantity = $_POST['quantity'];
		$post_link = trim($_POST['link']);
		$check_service = mysqli_query($db, "SELECT * FROM services WHERE sid = '$post_service' AND status = 'Active'");
       

		$data_service = mysqli_fetch_assoc($check_service);

        $check_orders = mysqli_query($db, "SELECT * FROM orders WHERE link = '$post_link' AND status IN ('Pending','Processing')");
        $data_orders = mysqli_fetch_assoc($check_orders);
		$rate = $data_service['price'] / 1000;
		$price = $rate*$post_quantity;
		$oid = random_number(3).random_number(4);
		$service = $data_service['service'];
		$provider = $data_service['provider'];
		$pid = $data_service['pid'];

		$check_provider = mysqli_query($db, "SELECT * FROM provider WHERE code = '$provider'");
		$data_provider = mysqli_fetch_assoc($check_provider);

		if (empty($post_service) || empty($post_link) || empty($post_quantity)) {
			$msg_type = "error";
			$msg_content = "<b>Gagal:</b> Mohon mengisi input.";
		} else if (mysqli_num_rows($check_orders) == 1) {
		    $msg_type = "error";
		    $msg_content = "<b>Gagal:</b> Terdapat Orderan Username Yang Sama Dan berstatus Pending/Processing.";
		} else if (mysqli_num_rows($check_service) == 0) {
			$msg_type = "error";
			$msg_content = "<b>Gagal:</b> Layanan tidak ditemukan.$post_service.$post_quantity.$post_link;";
		} else if (mysqli_num_rows($check_provider) == 0) {
			$msg_type = "error";
			$msg_content = "<b>Gagal:</b> Server Maintenance.";
		} else if ($post_quantity < $data_service['min']) {
			$msg_type = "error";
			$msg_content = "<b>Gagal:</b> Jumlah minimal adalah ".$data_service['min'].".";
		} else if ($post_quantity > $data_service['max']) {
			$msg_type = "error";
			$msg_content = "<b>Gagal:</b> Jumlah maksimal adalah ".$data_service['max'].".";
		} else if ($data_user['balance'] < $price) {
			$msg_type = "error";
			$msg_content = "<b>Gagal:</b> Saldo Anda tidak mencukupi untuk melakukan pembelian ini.";
		} else {

			// api data
			$api_link = $data_provider['link'];
			$api_key = $data_provider['api_key'];
			// end api data

			if ($provider == "MANUAL") {
				$api_postdata = "";
			} else if ($provider == "ILH") {
                $postdata = "api_key=$api_key&action=add&service=$pid&target=$post_link&quantity=$post_quantity";
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $api_link);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                $chresult = curl_exec($ch);
                echo $chresult;
                curl_close($ch);
                    $json_result = json_decode($chresult);
			} else if ($provider == "SMP") {
                    final class Rest{
                    	public  $url = 'https://solosmartpedia.com/api/';
                    	public  $apikey = 'ODhiNWM4YTczMzQyZTYxNjc3N2JiNTcxZGNlMDNjNGUzNDFiNGQ5OQ==';
                    	
                    	public function get_method($method,$data){
                    		return json_decode($this->curl($method,$this->url.'/user?'.http_build_query($data)));
                    	}
                    	
                    	public function order_sosmed($method,$data){
                    		return json_decode($this->curl($method,$this->url.'/sosmed',array_merge(array('X-API-KEY'=>trim($this->apikey)),$data)));
                    	}
                    	
                    	public function order_pulsa($method,$data){
                    		return json_decode($this->curl($method,$this->url.'/pulsa',array_merge(array('X-API-KEY'=>trim($this->apikey)),$data))); ////
                    	}
                    
                    	
                    	private function curl($method,$end_point,$data=''){
                    		//inisialisasi;
                    		$ch = curl_init($end_point);
                    		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
                    		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
                    		curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
                    		curl_setopt($ch, CURLOPT_HEADER,0);
                    		curl_setopt($ch, CURLOPT_CUSTOMREQUEST,$method);
                    		curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT x.y; Win64; x64; rv:10.0) Gecko/20100101 Firefox/10.0');
                    		switch($method){
                    			case 'POST':
                    			curl_setopt($ch,CURLOPT_POST,1);
                    			curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data));
                    			break;
                    			case 'GET':
                    			curl_setopt($ch, CURLOPT_HTTPHEADER,array('X-API-KEY:'.$this->apikey));
                    			break;
                    		}
                    		$result = curl_exec($ch);
                    		curl_close($ch);
                    		return $result;
                    	}
                    }

                    $apix = new Rest();
                    $orderx = $apix->order_sosmed('POST',array('type'=>'order','service'=>$pid,'target'=>$post_link,'quantity'=>$post_quantity)); 
                    $orderx_id = $orderx->id_order;
                 
			} else {
				die("System Error!");
			}

			if ($provider != "MANUAL" AND $provider == "PM" AND $json_result->status == false) {
				$msg_type = "error";
				$msg_content = "<b>Failed:</b> ".$json_result->data->msg." .";
			}else if($provider != "MANUAL" AND $provider == "SMP" AND $orderx->status == 'false'){
			        $msg_type = "error";
			    	$msg_content = "<b>Failed:</b> ".$orderx->message.$pid." .";
			} else {
				if ($provider == "ILH") {
					$poid = $json_result->data->id;
				}else if ($provider == "SMP") {
					$poid = $orderx->id_order;
				}else if ($provider == "MANUAL") {
					$poid = $oid;
				}
				$update_user = mysqli_query($db, "UPDATE users SET balance = balance-$price WHERE username = '$sess_username'");
				if ($update_user == TRUE) {
					$insert_order = mysqli_query($db, "INSERT INTO orders (oid, poid, user, service, link, quantity, price, status, date, provider, place_from) VALUES ('$oid', '$poid', '$sess_username', '$service', '$post_link', '$post_quantity', '$price', 'Pending', '$date', '$provider', 'WEB')");
					if ($insert_order == TRUE) {
						$msg_type = "success";
						$msg_content = "<b>Pesanan telah diterima.</b><br /><b>Layanan:</b> $service<br /><b>Link:</b> $post_link<br /><b>Jumlah:</b> ".number_format($post_quantity,0,',','.')."<br /><b>Biaya:</b> Rp ".number_format($price,0,',','.');
					} else {
						$msg_type = "error";
						$msg_content = "<b>Gagal:</b> Error system (2).";
					}
				} else {
					$msg_type = "error";
					$msg_content = "<b>Gagal:</b> Error system (1).";
				}
			}
		}
	}
	
	$check_user = mysqli_query($db, "SELECT * FROM users WHERE username = '$sess_username'");
	$data_user = mysqli_fetch_assoc($check_user);
?>
 <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">					
							<div class="col-lg-15">
								<div class="card">
									<div class="card-body">
										<h3 class="card-title"><i class="fa fa-shopping-cart"></i> Pesanan Baru</h3>
									</div>
									<div class="panel-body">
										<?php 
										if ($msg_type == "success") {
										?>
										<div class="alert alert-success">
											<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
											<i class="fa fa-check-circle"></i>
											<?php echo $msg_content; ?>
										</div>
										<?php
										} else if ($msg_type == "error") {
										?>
										<div class="alert alert-danger">
											<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
											<i class="fa fa-times-circle"></i>
											<?php echo $msg_content; ?>
										</div>
										<?php
										}
										?>
										<form class="form-horizontal" role="form" method="POST">
											<div class="form-group">
												<label class="col-md-2 control-label">Kategori</label>
												<div class="col-md-10">
													<select class="form-control" id="category">
														<option value="0">Pilih salah satu...</option>
													   <option value="Best"> BEST SERVICE CHEAP SALE</option>
                                          <option value="Facebook Auto Likes - 30 Days Subscription"> Facebook Auto Likes - 30 Days Subscription</option>
                                          <option value="Facebook Followers / Friends / Group Members"> Facebook Followers / Friends / Group Members</option>
                                          <option value="Facebook Page Likes"> Facebook Page Likes</option>
                                          <option value="Facebook Post Likes / Comments / Shares / Events"> Facebook Post Likes / Comments / Shares / Events</option>
                                          <option value="Facebook Video Views / Live Stream"> Facebook Video Views / Live Stream</option>
                                          <option value="Instagram Auto Comments / Impressions / Saves"> Instagram Auto Comments / Impressions / Saves</option>
                                          <option value="Instagram Auto Likes"> Instagram Auto Likes</option>
                                          <option value="Instagram Auto Likes - 30 Days Subscription"> Instagram Auto Likes - 30 Days Subscription</option>
                                          <option value="Instagram Auto Likes - 7 Days Subscription"> Instagram Auto Likes - 7 Days Subscription</option>
                                          <option value="Instagram Auto Likes [Per Minute]"> Instagram Auto Likes [Per Minute]</option>
                                          <option value="Instagram Auto Views"> Instagram Auto Views</option>
                                          <option value="Instagram Comments"> Instagram Comments</option>
                                          <option value="Instagram Comments Random"> Instagram Comments Random</option>
                                          <option value="Instagram Followers [Refill] [Guaranteed] [NonDrop"> Instagram Followers [Refill] [Guaranteed] [NonDrop]</option>
                                          <option value="Instagram Followers Indonesia"> Instagram Followers Indonesia</option>
                                          <option value="Instagram Followers No Refill/Not Guaranteed"> Instagram Followers No Refill/Not Guaranteed</option>
                                          <option value="Instagram Likes"> Instagram Likes</option>
                                          <option value="Instagram Likes Indonesia"> Instagram Likes Indonesia</option>
                                          <option value="Instagram Live Video"> Instagram Live Video</option>
                                          <option value="Instagram Mentions"> Instagram Mentions</option>
                                          <option value="Instagram Story / Impressions / Saves"> Instagram Story / Impressions / Saves</option>
                                          <option value="Instagram TV"> Instagram TV</option>
                                          <option value="Instagram Views"> Instagram Views</option>
                                          <option value="Linkedin"> Linkedin</option>
                                          <option value="Musical.ly"> Musical.ly</option>
                                          <option value="Pinterest"> Pinterest</option>
                                          <option value="Soundcloud"> Soundcloud</option>
                                          <option value="Twitter Auto Likes / Retweets"> Twitter Auto Likes / Retweets</option>
                                          <option value="Twitter Followers"> Twitter Followers</option>
                                          <option value="Twitter Likes"> Twitter Likes</option>
                                          <option value="Twitter Likes/Favorites"> Twitter Likes/Favorites</option>
                                          <option value="Twitter Poll Votes"> Twitter Poll Votes</option>
                                          <option value="Twitter Retweet"> Twitter Retweets</option>
                                          <option value="Website Traffic"> Website Traffic</option>
                                          <option value="Youtube"> Youtube</option>
                                          <option value="Youtube Likes / Comments / Favs..."> Youtube Likes / Comments / Favs...</option>
                                          <option value="Youtube Live Stream"> Youtube Live Stream</option>
                                          <option value="Youtube Subscribers"> Youtube Subscribers</option>
                                          <option value="Youtube Views"> Youtube Views</option>
                                          <option value="Youtube Views [HR] [JAM TAYANG]"> Youtube Views [HR] [JAM TAYANG]</option>
                      
													</select>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">Layanan</label>
												<div class="col-md-10">
													<select class="form-control" name="service" id="service">
														<option value="0">Pilih kategori...</option>
													</select>
												</div>
											</div>
											<div id="note">
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">Link/Target</label>
												<div class="col-md-10">
													<input type="text" name="link" class="form-control" placeholder="Link/Target">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">Jumlah</label>
												<div class="col-md-10">
													<input type="number" name="quantity" class="form-control" placeholder="Jumlah" onkeyup="get_total(this.value).value;">
												</div>
											</div>
											
											<input type="hidden" id="rate" value="0">
											<div class="form-group">
												<label class="col-md-2 control-label">Total Harga</label>
												<div class="col-md-10">
													<input type="number" class="form-control" id="total" readonly>
												</div>
											</div>
											<div class="form-group col-md-2">
											<button type="submit" class="pull-right btn btn-success btn-bordered waves-effect w-md waves-light" name="order">Buat Pesanan</button></div>
										</form>
									</div>
								</div>
							</div>
							<div class="col-md-15">
								<div class="card">
									<div class="card-body">
										<h3 class="card-title"><i class="fa fa-info-circle"></i> Informasi</h3>
									</div>
									<div class="card-body">
										<ul>
											<li>Masukkan link/target yang benar.</li>
											<li>Akun target harus bersifat publik/tidak privat.</li>
										</ul>
									</div>
								</div>
							
						
						<!-- end row -->
						<script type="text/javascript" src="https://code.jquery.com/jquery-1.10.2.js"></script>
	<script type="text/javascript">
$(document).ready(function() {
	$("#category").change(function() {
		var category = $("#category").val();
		$.ajax({
			url: '<?php echo $cfg_baseurl; ?>inc/order_service.php',
			data: 'category=' + category,
			type: 'POST',
			dataType: 'html',
			success: function(msg) {
				$("#service").html(msg);
			}
		});
	});
	$("#service").change(function() {
		var service = $("#service").val();
		$.ajax({
			url: '<?php echo $cfg_baseurl; ?>inc/order_note.php',
			data: 'service=' + service,
			type: 'POST',
			dataType: 'html',
			success: function(msg) {
				$("#note").html(msg);
			}
		});
		$.ajax({
			url: '<?php echo $cfg_baseurl; ?>inc/order_rate.php',
			data: 'service=' + service,
			type: 'POST',
			dataType: 'html',
			success: function(msg) {
				$("#rate").val(msg);
			}
		});
	});
});

function get_total(quantity) {
	var rate = $("#rate").val();
	var result = eval(quantity) * rate;
	$('#total').val(result);
}
	</script>
<?php
	include("lib/footer.php");
} else {
	header("Location: ".$cfg_baseurl);
}
?>