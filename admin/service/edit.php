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
				if (isset($_POST['edit'])) {
					$post_cat = $_POST['category'];
					$post_service = $_POST['service'];
					$post_note = $_POST['note'];
					$post_min = $_POST['min'];
					$post_max = $_POST['max'];
					$post_price = $_POST['price'];
					$post_pid = $_POST['pid'];
					$post_provider = $_POST['provider'];
					$post_status = $_POST['status'];
					if (empty($post_service) || empty($post_note) || empty($post_min) || empty($post_max) || empty($post_price) || empty($post_pid) || empty($post_provider)) {
						$msg_type = "error";
						$msg_content = "<b>Gagal:</b> Mohon mengisi input.";
					} else if ($post_status != "Active" AND $post_status != "Not active") {
						$msg_type = "error";
						$msg_content = "<b>Gagal:</b> Input tidak sesuai.";
					} else {
						$update_service = mysqli_query($db, "UPDATE services SET category = '$post_cat', service = '$post_service', note = '$post_note', min = '$post_min', max = '$post_max', price = '$post_price', status = '$post_status', pid = '$post_pid', provider = '$post_provider' WHERE sid = '$post_sid'");
						if ($update_service == TRUE) {
							$msg_type = "success";
							$msg_content = "<b>Berhasil:</b> Layanan berhasil diubah.<br /><b>Service ID:</b> $post_sid<br /><b>Service Name:</b> $post_service<br /><b>Category:</b> $post_cat<br /><b>Note:</b> $post_note<br /><b>Min:</b> ".number_format($post_min,0,',','.')."<br /><b>Max:</b> ".number_format($post_max,0,',','.')."<br /><b>Price/1000:</b> Rp ".number_format($post_price,0,',','.')."<br /><b>Provider ID:</b> $post_pid<br /><b>Provider Code:</b> $post_provider<br /><b>Status:</b> $post_status";
						} else {
							$msg_type = "error";
							$msg_content = "<b>Gagal:</b> Error system.";
						}
					}
				}
				$checkdb_service = mysqli_query($db, "SELECT * FROM services WHERE sid = '$post_sid'");
				$datadb_service = mysqli_fetch_assoc($checkdb_service);
				include("../../lib/header.php");
?>
						<div class="col-md-12">
								<div class="card">
									<div class="card-body">
										<h3 class="card-title"><i class="fa fa-edit"></i> Ubah Layanan</h3>
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
												<label class="col-md-2 control-label">Service ID</label>
												<div class="col-md-10">
													<input type="text" class="form-control" placeholder="Service ID" value="<?php echo $datadb_service['sid']; ?>" readonly>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">Service Name</label>
												<div class="col-md-10">
													<input type="text" class="form-control" name="service" placeholder="Service Name" value="<?php echo $datadb_service['service']; ?>">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">Category</label>
												<div class="col-md-10">
													<select class="form-control" name="category">
														<option value="<?php echo $datadb_service['category']; ?>"><?php echo $datadb_service['category']; ?> (Selected)</option>
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
												<label class="col-md-2 control-label">Note</label>
												<div class="col-md-10">
													<input type="text" class="form-control" name="note" placeholder="Note" value="<?php echo $datadb_service['note']; ?>">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">Min Order</label>
												<div class="col-md-10">
													<input type="number" class="form-control" name="min" placeholder="Min Order" value="<?php echo $datadb_service['min']; ?>">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">Max Order</label>
												<div class="col-md-10">
													<input type="number" class="form-control" name="max" placeholder="Max Order" value="<?php echo $datadb_service['max']; ?>">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">Price/1000</label>
												<div class="col-md-10">
													<input type="number" class="form-control" name="price" placeholder="Price/1000" value="<?php echo $datadb_service['price']; ?>">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">Provider ID</label>
												<div class="col-md-10">
													<input type="text" class="form-control" name="pid" placeholder="Provider ID" value="<?php echo $datadb_service['pid']; ?>">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">Provider Code</label>
												<div class="col-md-10">
													<select class="form-control" name="provider">
														<option value="<?php echo $datadb_service['provider']; ?>"><?php echo $datadb_service['provider']; ?> (Selected)</option>
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
											<div class="form-group">
												<label class="col-md-2 control-label">Status</label>
												<div class="col-md-10">
													<select class="form-control" name="status">
														<option value="<?php echo $datadb_service['status']; ?>"><?php echo $datadb_service['status']; ?> (Selected)</option>
														<option value="Active">Active</option>
														<option value="Not active">Not active</option>
													</select>
												</div>
											</div>
											<a href="<?php echo $cfg_baseurl; ?>admin/services.php" class="btn btn-info btn-bordered waves-effect w-md waves-light">Kembali ke daftar</a>
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
			header("Location: ".$cfg_baseurl."admin/news.php");
		}
	}
} else {
	header("Location: ".$cfg_baseurl);
}
?>