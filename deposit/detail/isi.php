<?php
session_start();
require("../../mainconfig.php");
$msg_type = "nothing";

if (isset($_SESSION['user'])) {
	$sess_username = $_SESSION['user']['username'];
	$check_user = mysqli_query($db, "SELECT * FROM users WHERE username = '$sess_username'");
	$data_user = mysqli_fetch_assoc($check_user);
	if (mysqli_num_rows($check_user) == 0) {
		header("Location: ".$cfg_baseurl."logout.php");
	} else if ($data_user['status'] == "Suspended") {
		header("Location: ".$cfg_baseurl."logout.php");
	} else {
		if (isset($_GET['oid'])) {
			$post_oid = $_GET['oid'];
			$checkdb_order = mysqli_query($db, "SELECT * FROM history_topup WHERE id = '$post_oid'");
				while ($datadb_order = mysqli_fetch_assoc($checkdb_order)) {
													if($datadb_order['status'] == "NO") {
														$label = "warning";
														$ss1="Waiting";
													} else if($datadb_order['status'] == "CANCEL") {
														$label = "danger";
															$ss1="CANCELED";
													} else if($datadb_order['status'] == "YES") {
														$label = "success";
															$ss1="Success";
													}
			if (mysqli_num_rows($checkdb_order) == 0) {
				header("Location: ".$cfg_baseurl."deposit/deposit_history.php");
				
			} else {
				include("../../lib/header.php");
				
?>
										
<div class="row">
	<div class="col-md-offset-2 col-md-8">
	    <a href="<?php echo $cfg_baseurl; ?>deposit/" class="btn btn-warning m-b-10"><i class="fa fa-arrow-left"></i> Kembali</a>
	    <br><br>
            <div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">
										<h3 class="panel-title">DETAIL DEPOSIT/  AUTO-<?php echo $datadb_order['id']; ?></h3>
									</div>
					<div class="box-body table-responsive no-padding">
				        <table class="table table-striped">

												<tr>
													<td><b>ID Deposit</b></td>
													<td><code>AUTO-<?php echo $datadb_order['id']; ?></code></td>
												</tr>
												<tr>
													<td><b>Pengisi</b></td>
													<td><?php echo $datadb_order['username']; ?> (<?php echo $datadb_order['no_pengirim']; ?>)</td>
												</tr>
												<tr>
													<td><b>Tujuan</b></td>
													<td>0853-5766-8834</td> <!--- Ubah Nomor Kalean ---->
												</tr>
												<tr>
													<td><b>Jumlah Transfer</b></td>
													<td><?php echo number_format($datadb_order['jumlah_transfer'],0,',','.'); ?></td>
												</tr>
												<tr>
													<td><b>Saldo Didapat</b></td>
													<td><?php echo number_format($datadb_order['amount'],0,',','.'); ?></td>
												</tr>
												<tr>
													<td><b>Provider</b></td>
													<td><?php echo $datadb_order['provider']; ?></td>
												</tr>
												<tr>
													<td><b>Date</b></td>
													<td><?php echo $datadb_order['date']; ?> (<?php echo $datadb_order['time']; ?>)</td>
												</tr>
												<tr>
													<td><b>Status</b></td>
													<td><label class="label label-<?php echo $label; ?>"><?php echo $ss1; ?></label></td>
												</tr>
												
											</table>
											
										</div>
									</div>
									</div>
									</div>
<?php
				include("../../lib/footer.php");
			}}
		} else {
			header("Location: ".$cfg_baseurl."deposit/deposit_history");
		}
	}
} else {
	header("Location: ".$cfg_baseurl);
}
?>