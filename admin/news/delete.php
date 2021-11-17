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
		if (isset($_GET['id'])) {
			$post_id = $_GET['id'];
			$checkdb_news = mysqli_query($db, "SELECT * FROM news WHERE id = '$post_id'");
			$datadb_news = mysqli_fetch_assoc($checkdb_news);
			if (mysqli_num_rows($checkdb_news) == 0) {
				header("Location: ".$cfg_baseurl."admin/news.php");
			} else {
				include("../../lib/header.php");
?>
						<div class="col-md-12">
								<div class="card">
									<div class="card-body">
										<h3 class="card-title"><i class="fa fa-trash"></i> Hapus Berita</h3>
									</div>
									<div class="card-body">
										<form class="form-horizontal" role="form" method="POST" action="<?php echo $cfg_baseurl; ?>admin/news.php">
											<input type="hidden" name="id" value="<?php echo $datadb_news['id']; ?>">
											<div class="form-group">
												<label class="col-md-2 control-label">Konten</label>
												<div class="col-md-10">
													<textarea class="form-control" placeholder="Content" readonly><?php echo $datadb_news['content']; ?></textarea>
												</div>
											</div>
											<a href="<?php echo $cfg_baseurl; ?>admin/news.php" class="btn btn-info btn-bordered waves-effect w-md waves-light">Kembali ke daftar</a>
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