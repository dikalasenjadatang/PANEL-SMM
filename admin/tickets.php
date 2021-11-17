<?php
session_start();
require("../mainconfig.php");
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
		if (isset($_POST['delete'])) {
			$post_id = $_POST['id'];
			$checkdb_user = mysqli_query($db, "SELECT * FROM tickets WHERE id = '$post_id'");
			if (mysqli_num_rows($checkdb_user) == 0) {
				$msg_type = "error";
				$msg_content = "<b>Gagal:</b> Ticket not found in database.";
			} else {
				$delete_ticket = mysqli_query($db, "DELETE FROM tickets WHERE id = '$post_id'");
				$delete_ticket = mysqli_query($db, "DELETE FROM tickets_message WHERE ticket_id = '$post_id'");
				if ($delete_ticket == TRUE) {
					$msg_type = "success";
					$msg_content = "<b>Berhasil:</b> Ticket dihapus.";
				}
			}
		}

	include("../lib/header.php");
?>
<!-- Start content -->
                <div class="content">
                    <div class="container-fluid">
            <div class="col-md-12">
                       <div class="card">
                         <div class="card-body">
                                    <h4 class="page-title">Kelola Tiket</h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li>
                                            <a href="#"><?php echo $cfg_webname; ?></a>
                                        </li>
                                        <li>
                                            <a href="#">Fitur Developer</a>
                                        </li>
                                        <li class="active">
                                           Kelola Tiket
                                        </li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
							</div>
						</div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-color panel-info">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><i class="mdi mdi-comment-account-outline"></i> Daftar Tiket</h3>
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
										<div class="col-md-6">
										</div>
										<div class="col-md-6">
											<form method="GET">
											<div class="input-group m-b-20">
												<input type="text" name="search" class="form-control" placeholder="Cari nama layanan">
												<span class="input-group-btn">
													<button type="submit" class="btn waves-effect waves-light btn-info"><i class="fa fa-search"></i></button>
												</span>
											</div>
											</form>
										</div>
										<div class="clearfix"></div>
										<br />
										<div class="col-md-12 table-responsive">
											<table class="table table-striped table-bordered table-hover m-0">
												<thead>
													<tr>
														<th>Status</th>
														<th>Subject</th>
														<th>User</th>
														<th>Date Received</th>
														<th>Last Update</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
<?php
// start paging config
if (isset($_GET['search'])) {
	$search = $_GET['search'];
	$query_list = "SELECT * FROM tickets WHERE subject LIKE '%$search%' ORDER BY id DESC"; // edit
} else {
	$query_list = "SELECT * FROM tickets ORDER BY id DESC"; // edit
}
$records_per_page = 30; // edit

$starting_position = 0;
if(isset($_GET["page_no"])) {
	$starting_position = ($_GET["page_no"]-1) * $records_per_page;
}
$new_query = $query_list." LIMIT $starting_position, $records_per_page";
$new_query = mysqli_query($db, $new_query);
// end paging config
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
														<td><label class="label label-<?php echo $label; ?>"><?php echo $data_show['status']; ?></label></td>
														<td><?php if($data_show['seen_admin'] == 0) { ?><label class="label label-warning">NEW!</label><?php } ?> <?php echo $data_show['subject']; ?></td>
														<td><?php echo $data_show['user']; ?></td>
														<td><?php echo $data_show['datetime']; ?></td>
														<td><?php echo $data_show['last_update']; ?></td>
														<td align="center">
														<a href="<?php echo $cfg_baseurl; ?>admin/ticket/reply.php?id=<?php echo $data_show['id']; ?>" class="btn btn-xs btn-success"><i class="fa fa-reply"></i></a>
														<a href="<?php echo $cfg_baseurl; ?>admin/ticket/close.php?id=<?php echo $data_show['id']; ?>" class="btn btn-xs btn-custom"><i class="fa fa-times"></i></a>
														<a href="<?php echo $cfg_baseurl; ?>admin/ticket/delete.php?id=<?php echo $data_show['id']; ?>" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
														</td>
													</tr>
<?php
}
?>
												</tbody>
											</table>
											<ul class="pagination">
<?php
// start paging link
$self = $_SERVER['PHP_SELF'];
$query_list = mysqli_query($db, $query_list);
$total_records = mysqli_num_rows($query_list);
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
						<!-- end row -->
<?php
	include("../lib/footer.php");
	}
} else {
	header("Location: ".$cfg_baseurl);
}
?>