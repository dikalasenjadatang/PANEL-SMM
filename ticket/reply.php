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
					$post_message = $_POST['message'];
					if ($data_ticket['status'] == "Closed") {
						$msg_type = "error";
						$msg_content = "<b>Gagal:</b> Ticket closed.";
					} else if (empty($post_message)) {
						$msg_type = "error";
						$msg_content = "<b>Gagal:</b> Please fill all input.";
					} else if (strlen($post_message) > 500) {
						$msg_type = "error";
						$msg_content = "<b>Gagal:</b> Maximum message is 500 characters.";
					} else {
						$last_update = "$date $time";
						$insert_ticket = mysqli_query($db, "INSERT INTO tickets_message (ticket_id, sender, user, message, datetime) VALUES ('$post_target', 'Admin', '$data_ticket[user]', '$post_message', '$last_update')");
						$update_ticket = mysqli_query($db, "UPDATE tickets SET last_update = '$last_update', seen_user = '0', status = 'Responded' WHERE id = '$post_target'");
						if ($insert_ticket == TRUE) {
							$msg_type = "success";
							$msg_content = "<b>Berhasil:</b> Message sent.";
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
                                    <h4 class="page-title">Balas Tiket</h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li>
                                            <a href="#"><?php echo $cfg_webname; ?></a>
                                        </li>
                                        <li>
                                            <a href="#">Fitur Developer</a>
                                        </li>
                                        <li class="active">
                                            Balas Tiket
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
                                        <h3 class="panel-title"><i class="mdi mdi-comment-account-outline"></i> Balas Tiket</h3>
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
										<div style="max-height: 400px; overflow: auto;">
											<div class="alert alert-info alert-white">
												<b><?php echo $data_ticket['user']; ?></b><br /><?php echo nl2br($data_ticket['message']); ?><br /><i class="text-muted" style="font-size: 10px;"><?php echo $data_ticket['datetime']; ?></i>
											</div>
<?php
$check_message = mysqli_query($db, "SELECT * FROM tickets_message WHERE ticket_id = '$post_target'");
while ($data_message = mysqli_fetch_array($check_message)) {
	if ($data_message['sender'] == "Admin") {
		$msg_alert = "success";
		$msg_text = "text-right";
		$msg_sender = "Admin";
	} else {
		$msg_alert = "info";
		$msg_text = "";
		$msg_sender = $data_message['user'];
	}
?>
											<div class="alert alert-<?php echo $msg_alert; ?> alert-white <?php echo $msg_text; ?>">
												<b><?php echo $msg_sender; ?></b><br /><?php echo nl2br($data_message['message']); ?><br /><i class="text-muted" style="font-size: 10px;"><?php echo $data_message['datetime']; ?></i>
											</div>
<?php
}
?>
										</div>
									</div>
									<div class="panel-footer">
									    <div class="panel-body">
										<form class="form-horizontal" role="form" method="POST">
											<div class="form-group">
												<div class="col-md-12">
													<textarea name="message" class="form-control" placeholder="Message" rows="3"></textarea>
												</div>
											</div>
											<a href="<?php echo $cfg_baseurl; ?>admin/tickets.php" class="btn btn-default">Kembali</a>
											<button type="submit" class="pull-right btn btn-info" name="submit">Balas</button>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
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