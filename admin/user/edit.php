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
	} else if ($data_user['level'] != "Developers") {
		header("Location: ".$cfg_baseurl);
	} else {
		if (isset($_GET['username'])) {
			$post_username = $_GET['username'];
			$checkdb_user = mysqli_query($db, "SELECT * FROM users WHERE username = '$post_username'");
			$datadb_user = mysqli_fetch_assoc($checkdb_user);
			if (mysqli_num_rows($checkdb_user) == 0) {
				header("Location: ".$cfg_baseurl."admin/users.php");
			} else {
				if (isset($_POST['edit'])) {
					$post_status = $_POST['status'];
					$post_password = $_POST['password'];
					$post_balance = $_POST['balance'];
					$post_level = $_POST['level'];
					if (empty($post_password)) {
						$msg_type = "error";
						$msg_content = "<b>Gagal:</b> Mohon mengisi semua input.";
					} else if ($post_level != "Member" AND $post_level != "Reseller" AND $post_level != "Admin" AND $post_level != "Agen") {
						$msg_type = "error";
						$msg_content = "<b>Gagal:</b> Input tidak sesuai.";
					} else if ($post_status != "Active" AND $post_status != "Suspended") {
						$msg_type = "error";
						$msg_content = "<b>Gagal:</b> Input tidak sesuai.";
					} else {
						$update_user = mysqli_query($db, "UPDATE users SET password = '$post_password', balance = '$post_balance', level = '$post_level', status = '$post_status' WHERE username = '$post_username'");
						if ($update_user == TRUE) {
							$msg_type = "success";
							$msg_content = "<b>Berhasil:</b> Pengguna berhasil diubah.<br /><b>Username:</b> $post_username<br /><b>Password:</b> $post_password<br /><b>Level:</b> $post_level<br /><b>Status:</b> $post_status<br /><b>Saldo:</b> Rp ".number_format($post_balance,0,',','.');
						} else {
							$msg_type = "error";
							$msg_content = "<b>Gagal:</b> Error system.";
						}
					}
				}
				$checkdb_user = mysqli_query($db, "SELECT * FROM users WHERE username = '$post_username'");
				$datadb_user = mysqli_fetch_assoc($checkdb_user);
				include("../../lib/header.php");
?>
						<div class="col-md-12">
								<div class="card">
									<div class="card-body">
										<h3 class="card-title"><i class="fa fa-edit"></i> Ubah Pengguna</h3>
									</div>
									<div class="card-body">
										<?php 
										if ($msg_type == "success") {
										?>
										<div class="alert alert-icon alert-success alert-dismissible fade in" role="alert">
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											<i class="fa fa-check-circle"></i>
											<?php echo $msg_content; ?>
										</div>
										<?php
										} else if ($msg_type == "error") {
										?>
										<div class="alert alert-icon alert-danger alert-dismissible fade in" role="alert">
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											<i class="fa fa-times-circle"></i>
											<?php echo $msg_content; ?>
										</div>
										<?php
										}
										?>
										<form class="form-horizontal" role="form" method="POST">
											<div class="form-group">
												<label class="col-md-2 control-label">Username</label>
												<div class="col-md-10">
													<input type="text" class="form-control" placeholder="Username" value="<?php echo $datadb_user['username']; ?>" readonly>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">Password</label>
												<div class="col-md-10">
													<input type="text" name="password" class="form-control" placeholder="Password" value="<?php echo $datadb_user['password']; ?>">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">Level</label>
												<div class="col-md-10">
													<select class="form-control" name="level">
														<option value="<?php echo $datadb_user['level']; ?>"><?php echo $datadb_user['level']; ?> (Selected)</option>
														<option value="Member">Member</option>
														<option value="Agen">Agen</option>
														<option value="Reseller">Reseller</option>
														<option value="Admin">Admin</option>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">Status</label>
												<div class="col-md-10">
													<select class="form-control" name="status">
														<option value="<?php echo $datadb_user['status']; ?>"><?php echo $datadb_user['status']; ?> (Selected)</option>
														<option value="Active">Active</option>
														<option value="Suspended">Suspended</option>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">Saldo</label>
												<div class="col-md-10">
													<input type="number" name="balance" class="form-control" placeholder="Balance" value="<?php echo $datadb_user['balance']; ?>">
												</div>
											</div>
											<a href="<?php echo $cfg_baseurl; ?>admin/users.php" class="btn btn-info btn-bordered waves-effect w-md waves-light">Kembali ke daftar</a>
											<div class="pull-right">
												<button type="reset" class="btn btn-danger btn-bordered waves-effect w-md waves-light">Ulangi</button>
												<button type="submit" class="btn btn-success btn-bordered waves-effect w-md waves-light" name="edit">Ubah</button>
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
			header("Location: ".$cfg_baseurl."admin/users.php");
		}
	}
} else {
	header("Location: ".$cfg_baseurl);
}
?>