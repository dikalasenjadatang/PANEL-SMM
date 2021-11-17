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
		$post_phone = trim($_POST['phone']);
        $post_ke = $_POST['ke'];
		$check_service = mysqli_query($db, "SELECT * FROM services_pulsa WHERE id = '$post_service' AND status = 'Active'");
		$data_service = mysqli_fetch_assoc($check_service);

		$price = $data_service['price'];
		$oid = rand(00000,99999);
		$service = $data_service['name'];
		$pid = $data_service['code'];

		if (empty($post_service) || empty($post_phone)) {
			$msg_type = "error";
			$msg_content = "<b>Gagal:</b> Mohon mengisi input.";
		} else if (mysqli_num_rows($check_service) == 0) {
			$msg_type = "error";
			$msg_content = "<b>Gagal:</b> Layanan tidak ditemukan.";
		} else if ($data_user['balance'] < $price) {
			$msg_type = "error";
			$msg_content = "<b>Gagal:</b> Saldo Anda tidak mencukupi untuk melakukan pembelian ini.";
		} else {
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
        return json_decode($this->curl($method,$this->url.'/pulsa',array_merge(array('X-API-KEY'=>trim($this->apikey)),$data)));
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

#ALL IN ONE
$api = new Rest();
$json_result = $order_pulsa = $api->order_pulsa('POST',array('type'=>'order','code'=>$pid,'nomer'=>$post_phone,'typecore'=>'PULSA','no'=>$post_ke)); 
$order_id = $json_result->id_order;
$msg = $json_result->message;
			if (!isset($order_id)) {
				$msg_type = "error";
				$msg_content = "<b>Gagal:</b> Server Maintenance. $msg";
			
			} else {
				$update_user = mysqli_query($db, "UPDATE users SET balance = balance-$price WHERE username = '$sess_username'");
				if ($update_user == TRUE) {
					$insert_order = mysqli_query($db, "INSERT INTO orders_pulsa (oid, user, service, phone, price, status, date, place_from, pid) VALUES ('$oid', '$sess_username', '$service', '$post_phone', '$price', 'Pending', '$date', 'WEB', '$order_id')");
					if ($insert_order == TRUE) {
						$msg_type = "success";
						$msg_content = "<b>Pesanan telah diterima.</b><br /><b>Layanan:</b> $service<br /><b>id order:</b> $order_id<br /><b>No. HP:</b> $post_phone<br /><b>Biaya:</b> Rp ".number_format($price,0,',','.');
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
	$order_id = $json_result->order_id;
		$update_order = mysqli_query($db, "UPDATE orders_pulsa SET pid = '$order_id' WHERE username = '$sess_username'");
		
	$check_user = mysqli_query($db, "SELECT * FROM users WHERE username = '$sess_username'");
	$data_user = mysqli_fetch_assoc($check_user);
?>
 <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">
							<div class="col-md-15">
								<div class="card">
									<div class="card-body">
										<h3 class="card-title"><i class="fa fa-tag"></i> Pesan Pulsa</h3>
									</div>
									<div class="card-body">
										<?php 
										if ($msg_type == "success") {
										?>
										<div class="alert alert-success alert-dismissible" role="alert">
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											<i class="fa fa-check-circle"></i>
											<?php echo $msg_content; ?>
										</div>
										<?php
										} else if ($msg_type == "error") {
										?>
										<div class="alert alert-icon alert-danger" role="alert">
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											<i class="fa fa-times-circle"></i>
											<?php echo $msg_content; ?>
										</div>
										<?php
										}
										?>
										<div class="panel-body">
																						<div class="alert alert-info">
											    <i>* Pastikan telah memasukan nomer handphone secara benar, apabila terjadi kesalahan nomer. pihak Kami tidak akan refund transaksi</i>
											</div>
									<form role="form" method="POST">
									    <div class="form-group">
												<label class="control-label">Category</label>
												<select class="form-control" id="operator">
												<option value="0">Pilih salah satu...</option>
												            <option value="PLN"> PLN</option>
															<option value="XL"> Pulsa Xl</option>
															<option value="SMARTFREN"> Pulsa Smartfren</option>
															<option value="TELKOMSEL"> Pulsa Telkomsel</option>
															<option value="TRI"> Pulsa Three</option>
															<option value="INDOSAT"> Pulsa Indosat</option>
															<option value="AXIS"> Pulsa Axis</option>
															<option value="PULSA BOLT"> Pulsa Bolt</option>
																<option value="DRIVE"> Drive</option>
																	<option value="BOLT"> Bolt</option>
																											<option value="GAME"> Game</option>
																									<option value="AXIS AIGO (AKTIVASI *838*KODE#)">AXIS AIGO (AKTIVASI *838*KODE#)</option>
																									<option value="AXIS DATA BRONET">AXIS DATA BRONET</option>
																									
<option value="BOLT KUOTA"> BOLT KUOTA</option>	

<option value="GOJEK"> GOJEK</option>

<option value="GRAB"> GRAB</option>

<option value="INDOSAT DATA EXTRA"> INDOSAT DATA EXTRA</option>

<option value="iTunes Gift Card">iTunes Gift Card</option>

<option value="SPEEDY (@WIFI ID)">SPEEDY (@WIFI ID)</option>
	
<option value="TRI TRANSFER PULSA">TRI TRANSFER PULSA</option>																						
														</select>
											</div>
											<div class="form-group">
												<label class="control-label">Layanan</label>
												<select class="form-control" name="service" id="pulsa">
														<option value="0">Pilih kategori...</option>
												</select>
											</div>
											<div class="form-group">
												<label class="control-label">Data</label>
												<input type="text" name="phone" class="form-control" placeholder="No.HP/No Meter/ID PLN">
											</div>
												<div class="form-group">
												<label class="control-label">Urutan</label>
											<select class="form-control" id="operator" name="ke">
												<option value="1">1</option>
													<option value="2">2</option>
														<option value="3">3</option>
															<option value="4">4</option>
																<option value="5">5</option>
												            
											
														</select>
											</div>
											<div class="form-group">
												<label class="control-label">Total Harga</label>
												<input type="number" class="form-control" id="total" readonly>
												</div>
												<div class="form-group">
												<button type="submit" class="btn btn-success btn-bordered waves-effect w-md waves-light" name="order">Buat Pesanan</button>
											</div>
											</div>
											</div>
											</div>    </section>
						<!-- end row -->
<?php
	include("lib/footer.php");
} else {
	header("Location: ".$cfg_baseurl);
}
?>