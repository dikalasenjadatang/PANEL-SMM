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
			$post_target = $_GET['id'];
			$check_ticket = mysqli_query($db, "SELECT * FROM tickets WHERE id = '$post_target'");
			$data_ticket = mysqli_fetch_array($check_ticket);
			if (mysqli_num_rows($check_ticket) == 0) {
				header("Location: ".$cfg_baseurl."admin/tickets.php");
			} else {
				mysqli_query($db, "UPDATE tickets SET seen_admin = '1' WHERE id = '$post_target'");
				if (isset($_POST['submit'])) {
					if ($data_ticket['status'] == "Closed") {
						$msg_type = "error";
						$msg_content = "<b>Gagal:</b> Ticket already closed.";
					} else {
						$update_ticket = mysqli_query($db, "UPDATE tickets SET status = 'Closed' WHERE id = '$post_target'");
						if ($update_ticket == TRUE) {
							$msg_type = "success";
							$msg_content = "<b>Berhasil:</b> Ticket closed.";
						} else {
							$msg_type = "error";
							$msg_content = "<b>Gagal:</b> System error.";
						}
					}
				}
				$check_ticket = mysqli_query($db, "SELECT * FROM tickets WHERE id = '$post_target'");
				$data_ticket = mysqli_fetch_array($check_ticket);
				include("../../lib/header.php");
?>
            <div class="content-page">
                <div class="content">
                    <div class="container">
                        <div class="row">
							<div class="col-xs-12">
								<div class="page-title-box">
                                    <h4 class="page-title">Tutup Tiket</h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li>
                                            <a href="#"><?php echo $cfg_webname; ?></a>
                                        </li>
                                        <li>
                                            <a href="#">Fitur Developer</a>
                                        </li>
                                        <li class="active">
                                            Tutup Tiket
                                        </li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
							</div>
						</div>

						<div class="row">
                            <div class="col-md-2"></div><div class="col-md-8">
                                <div class="panel panel-color panel-info">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><i class="mdi mdi-comment-account-outline"></i> Tutup Tiket</h3>
                                    </div>
                                    <div class="panel-body">
										<?php 
										if ($msg_type == "success") {
										?>
										<div class="alert alert-icon alert-success" role="alert">
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											<i class="fa fa-check-circle"></i>
											<?php echo $msg_content; ?>
										</div>
										<?php
										} else if ($msg_type == "error") {
										?>
										<div class="alert alert-icon alert-danger" role="alert">
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
												<label class="col-md-2 control-label">Subject</label>
												<div class="col-md-10">
													<input type="text" class="form-control" placeholder="Subject" value="<?php echo $data_ticket['subject']; ?>" readonly>
												</div>
											</div>
											<div class="form-group">
												<div class="col-md-offset-2 col-md-10">
												<button type="submit" class="btn btn-info waves-effect w-md waves-light" name="submit">Tutup</button>
											<a href="<?php echo $cfg_baseurl; ?>admin/tickets" class="btn btn-default waves-effect w-md waves-light">Kembali</a>
											    </div>
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
			header("Location: ".$cfg_baseurl."admin/tickets.php");
		}
	}
} else {
	header("Location: ".$cfg_baseurl);
}
?>