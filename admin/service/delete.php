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
		if (isset($_GET['sid'])) {
			$post_sid = $_GET['sid'];
			$checkdb_service = mysqli_query($db, "SELECT * FROM services WHERE sid = '$post_sid'");
			$datadb_service = mysqli_fetch_assoc($checkdb_service);
			if (mysqli_num_rows($checkdb_service) == 0) {
				header("Location: ".$cfg_baseurl."admin/services.php");
			} else {
				include("../../lib/header.php");
?>
						<div class="col-md-12">
								<div class="card">
									<div class="card-body">
										<h3 class="card-title"><i class="fa fa-trash"></i> Hapus Layanan</h3>
									</div>
									<div class="panel-body">
										<form class="form-horizontal" role="form" method="POST" action="<?php echo $cfg_baseurl; ?>admin/services.php">
											<div class="form-group">
												<label class="col-md-2 control-label">Service ID</label>
												<div class="col-md-10">
													<input type="text" class="form-control" name="sid" placeholder="Service ID" value="<?php echo $datadb_service['sid']; ?>" readonly>
												</div>
											</div>
											<a href="<?php echo $cfg_baseurl; ?>admin/services.php" class="btn btn-info btn-bordered waves-effect w-md waves-light">Kembali ke daftar</a>
											<button type="submit" class="pull-right btn btn-success btn-bordered waves-effect w-md waves-light" name="delete">Hapus</button>
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