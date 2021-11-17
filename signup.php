<?php
session_start();
require("mainconfig.php");
$msg_type = "nothing";

if (isset($_SESSION['user'])) {
	$sess_username = $_SESSION['user']['username'];
	$check_user = mysqli_query($db, "SELECT * FROM users WHERE username = '$sess_username'");
	$data_user = mysqli_fetch_assoc($check_user);
	if (mysqli_num_rows($check_user) == 0) {
		header("Location: ".$cfg_baseurl."logout.php");
	} else if ($data_user['status'] == "Suspended") {
		header("Location: ".$cfg_baseurl."logout.php");
	}

	$check_order = mysqli_query($db, "SELECT SUM(price) AS total FROM orders WHERE user = '$sess_username'");
	$data_order = mysqli_fetch_assoc($check_order);
} else {
	if (isset($_POST['signup'])) {
		$post_username = trim($_POST['username']);
		$post_password = trim($_POST['password']);
		$check_user = mysqli_query($db, "SELECT * FROM users WHERE username = '$post_username'");
		if (empty($post_username) || empty($post_password)) {
			$msg_type = "error";
			$msg_content = "<b>Gagal:</b> Mohon mengisi semua input.";
		} else if (mysqli_num_rows($check_user) > 0) {
			$msg_type = "error";
			$msg_content = "<b>Gagal:</b> Username sudah terdaftar.";
		} else if (strlen($post_password) < 5) {
			$msg_type = "error";
			$msg_content = "<b>Gagal:</b> Password minimal 5 karakter.";
		} else {
			$post_apikey = random(20);
			$insert_user = mysqli_query($db, "INSERT INTO users (username, password, balance, level, registered, status, api_key, uplink) VALUES ('$post_username', '$post_password', '0', 'Member', '$date', 'Active', '$post_apikey', 'free_register')");
			if ($insert_user == true) {
				$msg_type = "success";
				$msg_content = "<b>Berhasil:</b> Akun Anda berhasil didaftarkan, silahkan masuk dahulu.";
			} else {
				$msg_type = "error";
				$msg_content = "<b>Gagal:</b> Kesalahan sistem.";
			}
		}
	}
include("lib/header.php");
?>
						
 <div class="content">
                    <div class="container-fluid">					
							<div class="col-lg-15">
								<div class="card">
									<div class="card-body">
										<h3 class="panel-title"><i class="fa fa-user"></i> Daftar</h3>
									</div>
									<div class="panel-body">
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
												<label class="col-md-2 control-label">Username</label>
												<div class="col-md-10">
													<input type="text" name="username" class="form-control" placeholder="Username">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">Password</label>
												<div class="col-md-10">
													<input type="password" name="password" class="form-control" placeholder="Password">
												</div>
											</div>
											<div class="form-group">
												<div class="col-md-offset-2 col-md-10">
													<button type="submit" class="btn btn-success btn-bordered waves-effect w-md waves-light" name="login">Masuk</button>
									</div>
									<div class="panel-footer">
										Sudah punya akun? <a href="<?php echo $cfg_baseurl; ?>" class="btn btn-default btn-bordered waves-effect w-md waves-light">Masuk!</a>
									</div>
								</div>
							</div>					
							<div class="col-lg-15">
								<div class="card">
									<div class="card-body">
										<h3 class="panel-title"><i class="fa fa-question-circle"></i> Tentang Kami</h3>
									</div>
									<div class="panel-body">
										<?php echo $cfg_about; ?>
									</div>
								</div>
							</div>
						</div>
						<!-- end row -->
						<script type="text/javascript" src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script>
function getsession() {
$("#showsession").html('<center><img src="http://www.volusia.org/resources/loading-gif.gif" height="50" weight="50"/></center>');
    $.ajax({
        url    : 'sdaftar.php',
        type    : 'GET',
        dataType: 'html',
        success    : function(isi){
            $("#showsession").html(isi);
        },
    });
}
</script>
<?php
include("lib/footer.php");
}
?>