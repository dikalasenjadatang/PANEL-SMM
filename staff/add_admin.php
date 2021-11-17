<?php
session_start();
require("../mainconfig.php");
$msg_type = "nothing";

if (isset($_SESSION['user'])) {
	$sess_username = $_SESSION['user']['username'];
	$check_user = mysqli_query($db, "SELECT * FROM users WHERE username = '$sess_username'");
	$data_user = mysqli_fetch_assoc($check_user);
	if (mysqli_num_rows($check_user) == 0) {
		header("Location: ".$cfg_baseurl."logout.php");
	} else if ($data_user['status'] == "Suspended") {
		header("Location: ".$cfg_baseurl."logout.php");
	} else if ($data_user['level'] == "Reseller" OR $data_user['level'] == "Admin") {
		header("Location: ".$cfg_baseurl);
	} else {
		$post_balance = $cfg_admin_bonus; // bonus reseller
		$post_price = $cfg_admin_price; // price reseller for registrant
		if (isset($_POST['add'])) {
			$post_username = trim($_POST['username']);
			$post_password = $_POST['password'];

			$checkdb_user = mysqli_query($db, "SELECT * FROM users WHERE username = '$post_username'");
			$datadb_user = mysqli_fetch_assoc($checkdb_user);
			if (empty($post_username) || empty($post_password)) {
				$msg_type = "error";
				$msg_content = "<b>Gagal:</b> Mohon mengisi semua input.";
			} else if (mysqli_num_rows($checkdb_user) > 0) {
				$msg_type = "error";
				$msg_content = "<b>Gagal:</b> Username $post_username sudah terdaftar dalam database.";
			} else if ($data_user['balance'] < $post_price) {
				$msg_type = "error";
				$msg_content = "<b>Gagal:</b> Saldo Anda tidak mencukupi untuk melakukan pendaftaran Admin.";
			} else {
				$post_api = random(20);
				$update_user = mysqli_query($db, "UPDATE users SET balance = balance-$post_price WHERE username = '$sess_username'");
				$insert_user = mysqli_query($db, "INSERT INTO users (username, password, balance, level, registered, status, api_key, uplink) VALUES ('$post_username', '$post_password', '$post_balance', 'Admin', '$date', 'Active', '$post_api', '$sess_username')");
				if ($insert_user == TRUE) {
					$msg_type = "success";
					$msg_content = "<h>Selamat</h> Admin telah ditambahkan.<br /> Di <b>REDIR-PEDIA</b> Gunakan Dengan Bijak! <br /><b>Username:</b> $post_username<br /><b>Password:</b> $post_password<br /><b>Level:</b> Admin<br /><b>Saldo:</b> Rp ".number_format($post_balance,0,',','.');
				} else {
					$msg_type = "error";
					$msg_content = "<b>Gagal:</b> Error system.";
				}
			}
		}

	include("../lib/header.php");
?>
				<!-- Start content -->
                <div class="content">
                    <div class="container-fluid">
							<div class="col-md-12">
								<div class="card">
									<div class="card-body">
										<h3 class="card-title"><i class="fa fa-plus"></i> Tambah Admin</h3>
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
											<div class="alert alert-info">
												- Saldo Anda terpotong Rp <?php echo number_format($post_price,0,',','.'); ?> untuk pendaftaran 1 Admin.<br />
												- Admin baru akan mendapat saldo Rp. <?php echo number_format($post_balance,0,',','.'); ?>.
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">Username</label>
												<div class="col-md-10">
													<input type="text" name="username" class="form-control" placeholder="Username">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">Password</label>
												<div class="col-md-10">
													<input type="text" name="password" class="form-control" placeholder="Password">
												</div>
											</div>
											<div class="pull-right">
												<button type="reset" class="btn btn-danger btn-bordered waves-effect w-md waves-light">Ulangi</button>
												<button type="submit" class="btn btn-success btn-bordered waves-effect w-md waves-light" name="add">Tambah</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
						<!-- end row -->
<?php
	include("../lib/footer.php");
	}
} else {
	header("Location: ".$cfg_baseurl);
}
?>