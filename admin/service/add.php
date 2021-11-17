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
		if (isset($_POST['add'])) {
			$post_sid = $_POST['sid'];
			$post_cat = $_POST['category'];
			$post_service = $_POST['service'];
			$post_note = $_POST['note'];
			$post_min = $_POST['min'];
			$post_max = $_POST['max'];
			$post_price = $_POST['price'];
			$post_pid = $_POST['pid'];
			$post_provider = $_POST['provider'];

			$checkdb_service = mysqli_query($db, "SELECT * FROM services WHERE sid = '$post_sid'");
			$datadb_service = mysqli_fetch_assoc($checkdb_service);
			if (empty($post_sid) || empty($post_service) || empty($post_note) || empty($post_min) || empty($post_max) || empty($post_price) || empty($post_pid) || empty($post_provider)) {
				$msg_type = "error";
				$msg_content = "<b>Gagal:</b> Mohon mengisi semua input.";
			} else if (mysqli_num_rows($checkdb_service) > 0) {
				$msg_type = "error";
				$msg_content = "<b>Gagal:</b> Service ID $post_sid sudah terdaftar di database.";
			} else {
				$insert_service = mysqli_query($db, "INSERT INTO services (sid, category, service, note, min, max, price, status, pid, provider) VALUES ('$post_sid', '$post_cat', '$post_service', '$post_note', '$post_min', '$post_max', '$post_price', 'Active', '$post_pid', '$post_provider')");
				if ($insert_service == TRUE) {
					$msg_type = "success";
					$msg_content = "<b>Berhasil:</b> Layanan berhasil ditambahkan.<br /><b>Service ID:</b> $post_sid<br /><b>Service Name:</b> $post_service<br /><b>Category:</b> $post_cat<br /><b>Note:</b> $post_note<br /><b>Min:</b> ".number_format($post_min,0,',','.')."<br /><b>Max:</b> ".number_format($post_max,0,',','.')."<br /><b>Price/1000:</b> Rp ".number_format($post_price,0,',','.')."<br /><b>Provider ID:</b> $post_pid<br /><b>Provider Code:</b> $post_provider";
				} else {
					$msg_type = "error";
					$msg_content = "<b>Gagal:</b> Error system.";
				}
			}
		}

	include("../../lib/header.php");
?>
						<div class="col-md-12">
								<div class="card">
									<div class="card-body">
										<h3 class="card-title"><i class="fa fa-plus"></i> Tambah Layanan</h3>
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
												<label class="col-md-2 control-label">Category</label>
												<div class="col-md-10">
													<select class="form-control" name="category">
														<?php
														$check_cat = mysqli_query($db, "SELECT * FROM service_cat ORDER BY name ASC");
														while ($data_cat = mysqli_fetch_assoc($check_cat)) {
														?>
														<option value="<?php echo $data_cat['code']; ?>"><?php echo $data_cat['name']; ?></option>
														<?php
														}
														?>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">Service ID</label>
												<div class="col-md-10">
													<input type="number" name="sid" class="form-control" placeholder="Service ID">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">Service Name</label>
												<div class="col-md-10">
													<input type="text" name="service" class="form-control" placeholder="Service Name">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">Note</label>
												<div class="col-md-10">
													<input type="text" name="note" class="form-control" placeholder="Etc: Input username, Input link">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">Min Order</label>
												<div class="col-md-10">
													<input type="number" name="min" class="form-control" placeholder="Min Order">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">Max Order</label>
												<div class="col-md-10">
													<input type="number" name="max" class="form-control" placeholder="Min Order">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">Price/1000</label>
												<div class="col-md-10">
													<input type="number" name="price" class="form-control" placeholder="Etc: 30000">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">Provider ID</label>
												<div class="col-md-10">
													<input type="number" name="pid" class="form-control" placeholder="Provider ID">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">Provider Code</label>
												<div class="col-md-10">
													<select class="form-control" name="provider">
														<?php
														$check_prov = mysqli_query($db, "SELECT * FROM provider");
														while ($data_prov = mysqli_fetch_assoc($check_prov)) {
														?>
														<option value="<?php echo $data_prov['code']; ?>"><?php echo $data_prov['code']; ?></option>
														<?php
														}
														?>
													</select>
												</div>
											</div>
											<a href="<?php echo $cfg_baseurl; ?>admin/services.php" class="btn btn-info btn-bordered waves-effect w-md waves-light">Kembali ke daftar</a>
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
	include("../../lib/footer.php");
	}
} else {
	header("Location: ".$cfg_baseurl);
}
?>