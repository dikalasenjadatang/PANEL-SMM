<?php
session_start();
require("mainconfig.php");

if (isset($_SESSION['user'])) {
	$sess_username = $_SESSION['user']['username'];
	$check_user = mysqli_query($db, "SELECT * FROM users WHERE username = '$sess_username'");
	$data_user = mysqli_fetch_assoc($check_user);
	if (mysqli_num_rows($check_user) == 0) {
		header("Location: ".$cfg_baseurl."logout.php");
	} else if ($data_user['status'] == "Suspended") {
		header("Location: ".$cfg_baseurl."logout.php");
	}

	include("lib/header.php");
	$msg_type = "nothing";

	if (isset($_POST['submit'])) {
		$post_subject = $_POST['subject'];
		$post_message = $_POST['message'];
		if (empty($post_subject) || empty($post_message)) {
			$msg_type = "error";
			$msg_content = '<b>Gagal:</b> Mohon mengisi smua input .<script>swal("Error!", "Mohon mengisi semua input.", "error");</script>';
		} else if (strlen($post_subject) > 200) {
			$msg_type = "error";
			$msg_content = '<b>Gagal:</b> subject max 200 .<script>swal("Error!", "subject max 200.", "error");</script>';
		} else if (strlen($post_message) > 500) {
			$msg_type = "error";
			$msg_content = '<b>Gagal:</b> Pesan max 500 .<script>swal("Error!", " Pesan max 500.", "error");</script>';
		} else {
			$insert_ticket = mysqli_query($db, "INSERT INTO tickets (user, subject, message, datetime, last_update, status) VALUES ('$sess_username', '$post_subject', '$post_message', '$date $time', '$date $time', 'Pending')");
			if ($insert_ticket == TRUE) {
				$msg_type = "success";
				$msg_content = '<b>Berhasil:</b> Ticket Berhasil Dibuat .<script>swal("Success!", " Ticket berhasil dibuat .", "success");</script>';
			} else {
				$msg_type = "error";
				$msg_content = "<b>Gagal:</b> System error.";
			}
		}
	}
?>
 <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">
                       <div class="col-md-12">
                       <div class="card">
                         <div class="card-body">
                                    <h4 class="page-title">Tiket Bantuan </h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li>
                                            <a href="#"><?php echo $cfg_webname; ?></a>
                                        </li>
                                        <li class="active">
                                          Tiket Bantuan 
                                        </li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
							</div>
						</div>

                         <div class="col-md-12">
                       <div class="card">
                         <div class="card-body">
                                        <h3 class="panel-title"><i class="mdi mdi-comment-account-outline"></i> Tiket Bantuan </h3>
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
										<form class="form-horizontal" role="form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
											<div class="form-group">
												<label class="col-md-2 control-label">Subject</label>
												<div class="col-md-10">
													<input type="text" name="subject" class="form-control" placeholder="Subject">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">Message</label>
												<div class="col-md-10">
													<textarea name="message" class="form-control" placeholder="Tulis keluhan anda beserta Order ID" rows="3"></textarea>
												</div>
											</div>
											<div class="form-group">
											    <div class="col-md-offset-2 col-md-10">
											        
											<button type="submit" class="btn btn-info" name="submit">Buat Tiket</button>
											<button type="reset" class="btn btn-default">Ulangi</button>

											</div>
											</div>
										</form>
									</div>
								</div>
							</div>
                             <div class="col-md-12">
                       <div class="card">
                         <div class="card-body">
                                        <h3 class="panel-title"><i class="mdi mdi-comment-account-outline"></i> Riwayat Tiket </h3>
                                    </div>
                                    <div class="panel-body">
										<div class="table-responsive m-t-0">
                                    <table id="myTable" class="table table-bordered table-striped">
												<thead>
													<tr>
														<th>Subject</th>
														<th>Status</th>
														<th>Last Update</th>
													</tr>
												</thead>
												<tbody>
<?php
// start paging config
$query_parent = "SELECT * FROM tickets WHERE user = '$sess_username' ORDER BY id DESC"; // edit
$records_per_page = 20; // edit

$starting_position = 0;
if(isset($_GET["page_no"])) {
	$starting_position = ($_GET["page_no"]-1) * $records_per_page;
}
$new_query = $query_parent." LIMIT $starting_position, $records_per_page";
$new_query = mysqli_query($db, $new_query);
$now_records = mysqli_num_rows($new_query);
// end paging config

if ($now_records == 0) {
?>
													<tr>
														<td colspan="3">No data</td>
													</tr>
<?php
} else {
	while ($data_show = mysqli_fetch_assoc($new_query)) {
		if($data_show['status'] == "Closed") {
			$label = "danger";
		} else if($data_show['status'] == "Responded") {
			$label = "success";
		} else if($data_show['status'] == "Waiting") {
			$label = "info";
		} else {
			$label = "warning";
		}
?>
													<tr>
														<td><?php if($data_show['seen_user'] == 0) { ?><label class="label label-warning">NEW!</label><?php } ?> <a href="<?php echo $cfg_baseurl; ?>ticket_open.php?id=<?php echo $data_show['id']; ?>"><?php echo $data_show['subject']; ?></a></td>
														<td><label class="label label-<?php echo $label; ?>"><?php echo $data_show['status']; ?></label></td>
														<td><?php echo $data_show['last_update']; ?></td>
													</tr>
<?php
	}
}
?>
												</tbody>
											</table>
											<ul class="pagination">
<?php
// start paging link
$self = $_SERVER['PHP_SELF'];
$query_parent = mysqli_query($db, $query_parent);
$total_records = mysqli_num_rows($query_parent);
echo "<li class='disabled'><a>Total: ".$total_records."</a></li>";
if($total_records > 0) {
	$total_pages = ceil($total_records/$records_per_page);
	$current_page = 1;
	if(isset($_GET["page_no"])) {
		$current_page = $_GET["page_no"];
		if ($current_page < 1) {
			$current_page = 1;
		}
	}
	if($current_page > 1) {
		$previous = $current_page-1;
		echo "<li><a href='".$self."?page_no=1'>← First</a></li>";
		echo "<li><a href='".$self."?page_no=".$previous."'><i class='fa fa-angle-left'></i> Previous</a></li>";
	}
	// limit page
	$limit_page = $current_page+3;
	$limit_show_link = $total_pages-$limit_page;
	if ($limit_show_link < 0) {
		$limit_show_link2 = $limit_show_link*2;
		$limit_link = $limit_show_link - $limit_show_link2;
		$limit_link = 3 - $limit_link;
	} else {
		$limit_link = 3;
	}
	$limit_page = $current_page+$limit_link;
	// end limit page
	// start page
	if ($current_page == 1) {
		$start_page = 1;
	} else if ($current_page > 1) {
		if ($current_page < 4) {
			$min_page  = $current_page-1;
		} else {
			$min_page  = 3;
		}
		$start_page = $current_page-$min_page;
	} else {
		$start_page = $current_page;
	}
	// end start page
	for($i=$start_page; $i<=$limit_page; $i++) {
		if($i==$current_page) {
			echo "<li class='active'><a href='".$self."?page_no=".$i."'>".$i."</a></li>";
		} else {
			echo "<li><a href='".$self."?page_no=".$i."'>".$i."</a></li>";
		}
	}
	if($current_page!=$total_pages) {
		$next = $current_page+1;
		echo "<li><a href='".$self."?page_no=".$next."'>Next <i class='fa fa-angle-right'></i></a></li>";
		echo "<li><a href='".$self."?page_no=".$total_pages."'>Last →</a></li>";
	}
}
// end paging link
?>
										</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
<?php
	include("lib/footer.php");
} else {
	header("Location: ".$cfg_baseurl);
}
?>