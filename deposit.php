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

	
	$check_user = mysqli_query($db, "SELECT * FROM users WHERE username = '$sess_username'");
	$data_user = mysqli_fetch_assoc($check_user);
	
	$check_depo = mysqli_query($db, "SELECT * FROM history_topup WHERE user = '$sess_username' AND status = 'NO'");
	
	if(isset($_POST['deposit'])) {
	 $post_method = $_POST['method'];
	 $post_quantity = $_POST['quantity'];
	 $post_pengirim = $_POST['sending'];
	 $post_code = "RP-DEPOSIT-".random(6)."";
	 
	 $query_depo = mysqli_query($db, "SELECT * FROM deposits_method WHERE id = '$post_method'");
	 $ppx = mysqli_query($db,"SELECT * FROM history_topup where username = '$sess_username' AND status = 'NO'");
	 $data_depo = mysqli_fetch_assoc($query_depo);
	 
	 $getbalance = $post_quantity*$data_depo['rate'];
	 
	 if(preg_match("/./", $post_quantity)) {
	  $post_quantity = str_replace(".","", $post_quantity);
	 }
	 
	 
	 if(empty($post_method) AND empty($post_quantity)) {
	    $msg_type = "error";
	    $msg_content = "<b>Gagal:</b> Mohon lengkapi semua input.";
	 } else if($post_quantity < 5000) {
	    $msg_type = "error";
	    $msg_content = "<b>Gagal:</b> Minimal topup adalah 5.000";
	 }else if(mysqli_num_rows($ppx) > 0) {
	    $msg_type = "error";
	    $msg_content = "<b>Gagal:</b> Masih ada deposit pending, segera lakukan pembayaran atau menghapus request deposit jika tidak diinginkan.";
	 } else {
	    $insert_depo = mysqli_query($db, "INSERT INTO history_topup (provider, amount, jumlah_transfer, username, no_pengirim, date, time, status, type) VALUES ('TSEL', '$post_quantity', '$post_quantity', '$sess_username', '$post_pengirim','$date','$time', 'NO','WEB')");
	    if($insert_depo == TRUE) {
	     $msg_type = "success";
	     $msg_content = "<b>Berhasil:</b> Permintaan Deposit Berhasil. <br /> Metode : ".$data_depo['method']." <br /> 
	         Nomor Pengirim : $post_pengirim <br /> 
	         Mohon Transfer ke nomor penerima:+6285264520165 ".$data_depo['note']." dengan jumlah ".$post_quantity." Dan anda akan mendapatkan saldo $getbalance <br /> Jika sudah Transfer Tunggu 5-10 Menit Deposit Akan Automatis Masuk <br />";
	     echo '';
	     } else {
	     $msg_type = "error";
	     $msg_content = "<b>Gagal:</b> System error #1";	     
	 }
}
}
?>

<?php if (mysqli_num_rows($check_depo) == 1 or mysqli_num_rows($check_depo) > 1){
 ?>
 <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">
					                     <div class="col-lg-15">
								<div class="card">
									<div class="card-body">
										<i class="fa fa-block"></i> Anda tidak dapat akses
									</div>
									<div class="card-body">
									    <b>- Anda masih memiliki deposit yang pending segera selesaikan.</b> <br />
									    <b>- Silahkan klick link <a href="<?php echo $cfg_baseurl; ?>deposit_history.php"; ?>Berikut</a> Untuk menyelesaikan deposit anda.</b> <br /> <br />
									    	<div id="pesan"></div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script>
            var url = "<?php echo $cfg_baseurl; ?>deposit_history.php"; // url tujuan
            var count = 5; // dalam detik
            function countDown() {
                if (count > 0) {
                    count--;
                    var waktu = count + 1;
                    $('#pesan').html('<b>- Anda akan di redirect ke ' + url + ' dalam ' + waktu + ' detik untuk menyelesaikan deposit anda. </b>');
                    setTimeout("countDown()", 1000);
                } else {
                    window.location.href = url;
                }
            }
            countDown();
        </script>
</div></div></div></div>
<?php
} else {
?>
 <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">
					                  <div class="col-lg-15">
								<div class="card"><br />
								    <div class="col-lg-offset-6 col-lg-12">
								<CenteR></CenteR>	<div class="alert alert-success">
										<button type="button" class="close" data-dismiss="alert">
											<span aria-hidden="true">×</span>
										</button>
                                <div>Usahakan Baca Ketentuan Deposit Dulu Sebelum Top Up Automatis.<br />
                                Jumlah Deposit = Jumlah Saldo<br />
                                <b>Nomer Penerima:+6285264520165</b><br />
                                </div></div></CenteR>
									<div class="card-body">
									<div class="card-body bg-default txt-white">
										<i class="fa fa-money"></i> Deposito Saldo
									</div>
									<div class="card-body">
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
												<label class="col-md-2 control-label">Metode</label>
												<div class="col-md-10">
													<select class="form-control" name="method" id="depomethod">
														<option value="0">Pilih salah satu...</option>
														<br />
<?php
														$check_met = mysqli_query($db, "SELECT * FROM deposits_method WHERE tipe = 'Pulsa' ORDER BY id ASC");
														while ($data_met = mysqli_fetch_assoc($check_met)) {
														?>
														<option value="<?php echo $data_met['id']; ?>"><?php echo $data_met['method']; ?></option>
												
														<?php
														}
														?>
</optgroup>																												
													</select>
												</div>
											</div>
                                      	<div class="form-group">
												<label class="col-md-4 control-label">No Pengirim Wajib (628**)</label>
												<div class="col-md-10">
													<input type="text" name="sending" class="form-control" placeholder="62822320***">
												</div>
											</div>
											<input type="hidden" id="rate" value="0">
											<div class="form-group">
												<label class="col-md-2 control-label">Jumlah</label>
												<div class="col-md-10">
													<input type="number" name="quantity" id="target" class="form-control" placeholder="Jumlah" >
												</div>
											</div>
										
											
<script src="http://ilhpedia.xyz/assets/js/jquery-min.js"></script>
<script>
    $( "#target" ).keyup(function() {
        var saldo =  $( "#target" ).val();
         $( "#total" ).val(saldo)
});
</script>
											<button type="submit" class="pull-right btn btn-success btn-bordered waves-effect w-md waves-light" name="deposit">Buat Permintaan Deposit</button>
										</form>
<div class="clearfix"></div>
									</div>
								</div>
							</div>
							<div class="col-lg-15">
								<div class="card">
									<div class="card-body">
										<i class="fa fa-info-circle"></i> Peraturan Deposit Automatis
									</div>
									<div class="card-body">
										<ul>
										    <li><b>Pastikan anda mentransfer (WAJIB) Sesuai dengan nominal yang telah ditentukan. BALANCE akan masuk otomatis 5-10mnit apabila transfer sesuai nominal yg telah ditentukan.</li></b>
										    <li><b>No Pengirim Wajib Menggunakan 62 Jangan 08</li></b>
										    <li><b>Minimal Deposit Rp. 5.000 .</li></b>
										    <li><b>Jumlah Deposit = Jumlah Saldo.</li></b>
											<li><b>Jangan Input Deposit yang sama, jika Deposit sebelumnya belum Selesai. Harap tunggu status <span class="label bg-success">YES</span>.</li></b>
											<li><b>Jika anda tidak konfirmasi deposit di menu konfirmasi dalam waktu 1x24jam, maka deposit anda dianggap <span class="label bg-danger">NO (ERROR)</span></b></li>
                                     	<li><b>Jika butuh bantuan silahkan hubungi Admin</b></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<!-- end row -->
<?php
}
	include("lib/footer.php");
} else {
	header("Location: ".$cfg_baseurl);
}
?>