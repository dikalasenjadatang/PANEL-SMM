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
			$check_target = mysqli_query($db, "SELECT * FROM services WHERE sid = '$post_sid'");
			$data_target = mysqli_fetch_assoc($check_target);
			if (mysqli_num_rows($check_target) == 0) {
				header("Location: ".$cfg_baseurl."admin/services.php");
			} else {
				include("../../lib/header.php");
?>
						<div class="col-md-12">
								<div class="card">
									<div class="card-body">
										<h3 class="card-title"><i class="fa fa-eye"></i> Detail Layanan</h3>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table class="table table-striped table-bordered table-hover m-0">
												<tr>
													<th>Service ID</th>
													<td><?php echo $data_target['sid']; ?></td>
												</tr>
												<tr>
													<th>Service Name</th>
													<td><?php echo $data_target['service']; ?></td>
												</tr>
												<tr>
													<th>Category</th>
													<td>
														<?php
														$check_cat = mysqli_query($db, "SELECT * FROM service_cat WHERE code = '$data_target[category]'");
														$data_cat = mysqli_fetch_array($check_cat);
														?>
														<?php echo $data_cat['name']; ?>
													</td>
												</tr>
												<tr>
													<th>Note</th>
													<td><?php echo nl2br($data_target['note']); ?></td>
												</tr>
												<tr>
													<th>Min. Order</th>
													<td><?php echo number_format($data_target['min'],0,',','.'); ?></td>
												</tr>
												<tr>
													<th>Max. Order</th>
													<td><?php echo number_format($data_target['max'],0,',','.'); ?></td>
												</tr>
												<tr>
													<th>Price/K</th>
													<td><?php echo number_format($data_target['price'],0,',','.'); ?></td>
												</tr>
												<tr>
													<th>Provider ID</th>
													<td><?php echo $data_target['pid']; ?></td>
												</tr>
												<tr>
													<th>Provider Code</th>
													<td><?php echo $data_target['provider']; ?></td>
												</tr>
												<tr>
													<th>Status</th>
													<td><?php echo $data_target['status']; ?></td>
												</tr>
											</table>
										</div>
										<a href="<?php echo $cfg_baseurl; ?>admin/services.php" class="btn btn-info m-t-20">Kembali ke daftar</a>
									</div>
								</div>
							</div>
						</div>
						<!-- end row -->
<?php
				include("../../lib/footer.php");
			}
		} else {
			header("Location: ".$cfg_baseurl."admin/services.php");
		}
	}
} else {
	header("Location: ".$cfg_baseurl);
}
?>