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
	} else if ($data_user['level'] != "Admin") {
		header("Location: ".$cfg_baseurl);
	} else {
		if (isset($_GET['code'])) {
			$post_code = $_GET['code'];
			$checkdb_order = mysqli_query($db, "SELECT * FROM deposits WHERE code = '$post_code' AND status NOT IN ('Success','Error')");
			$datadb_order = mysqli_fetch_assoc($checkdb_order);
			if (mysqli_num_rows($checkdb_order) == 0) {
				header("Location: ".$cfg_baseurl."admin/deposits.php");
			} else {
				include("../../lib/header.php");
?>
						<div class="page-header">
			  <h2>Terima Permintaan Deposit</h2>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?php echo $cfg_baseurl; ?>"><?php echo $cfg_webname; ?></a></li>
					<li class="breadcrumb-item active">Terima Permintaan Deposit</li>
				</ol>
			</div>

						<div class="main-content">
<div class="container-fluid">
					                     <div class="col-md-12">
                       <div class="card">
                         <div class="card-body">
                        <div class="card-heading  card-primary">
                            Terima Permintaan Deposito
                        </div>
                        <div class="card-block">
										<?php 
										if ($msg_type == "success") {
										?>
										<div class="alert alert-success alert-dismissible" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><?php echo $msg_content; ?></div>
										<?php
										} else if ($msg_type == "error") {
										?>
										<div class="alert alert-danger alert-dismissible" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><?php echo $msg_content; ?></div>
										<?php
										}
										?>
										<form class="form-horizontal" role="form" method="POST" action="<?php echo $cfg_baseurl; ?>admin/deposits.php">
											<div class="form-group">
												<label>Kode</label>
													<input type="text" class="form-control" value="<?php echo $datadb_order['code']; ?>" name="code" readonly>
											</div>
											<div class="form-group">
												<label>Pengguna</label>
													<input type="text" class="form-control" value="<?php echo $datadb_order['user']; ?>" readonly>
											</div>
											<div class="form-group">
												<label>Saldo didapat</label>
													<input type="text" class="form-control" value="<?php echo $datadb_order['balance']; ?>" readonly>
											</div>
											<a href="<?php echo $cfg_baseurl; ?>admin/deposits.php" class="btn btn-info btn-bordered waves-effect w-md waves-light">Kembali ke daftar</a>
											<div class="pull-right">
												<button type="submit" class="btn btn-success btn-bordered waves-effect w-md waves-light" name="accept">Submit</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
						<!-- end row -->
<?php
				include("../../lib/footer.php");
			}
		} else {
			header("Location: ".$cfg_baseurl."admin/deposit.php");
		}
	}
} else {
	header("Location: ".$cfg_baseurl);
}
?>