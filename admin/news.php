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
			$checkdb_news = mysqli_query($db, "SELECT * FROM news WHERE id = '$post_id'");
			if (mysqli_num_rows($checkdb_news) == 0) {
				$msg_type = "error";
				$msg_content = "<b>Gagal:</b> Berita tidak ditemukan.";
			} else {
				$delete_news = mysqli_query($db, "DELETE FROM news WHERE id = '$post_id'");
				if ($delete_news == TRUE) {
					$msg_type = "success";
					$msg_content = "<b>Berhasil:</b> Berita deleted.";
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
										<h3 class="card-title"><i class="fa fa-info"></i> Daftar Berita</h3>
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
										<div class="col-md-6">
											<a href="<?php echo $cfg_baseurl; ?>admin/news/add.php" class="btn btn-info m-b-20"><i class="fa fa-plus"></i> Tambah</a>
										</div>
										<div class="col-md-6">
										</div>
										<div class="clearfix"></div>
										<br />
										<div class="col-md-12 table-responsive">
											<table class="table table-striped table-bordered table-hover m-0">
												<thead>
													<tr>
														<th>#</th>
														<th>Tanggal</th>
														<th>Konten</th>
														<th>Aksi</th>
													</tr>
												</thead>
												<tbody>
												<?php
// start paging config
$query_list = "SELECT * FROM news ORDER BY id DESC"; // edit
$records_per_page = 10; // edit

$starting_position = 0;
if(isset($_GET["page_no"])) {
	$starting_position = ($_GET["page_no"]-1) * $records_per_page;
}
$new_query = $query_list." LIMIT $starting_position, $records_per_page";
$new_query = mysqli_query($db, $new_query);
// end paging config
												$no = 1;
												while ($data_show = mysqli_fetch_assoc($new_query)) {
												?>
													<tr>
														<td><?php echo $no; ?></td>
														<td><?php echo $data_show['date']; ?></td>
														<td><?php echo nl2br($data_show['content']); ?></td>
														<td align="center">
														<a href="<?php echo $cfg_baseurl; ?>admin/news/edit.php?id=<?php echo $data_show['id']; ?>" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></a>
														<a href="<?php echo $cfg_baseurl; ?>admin/news/delete.php?id=<?php echo $data_show['id']; ?>" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
														</td>
													</tr>
												<?php
												$no++;
												}
												?>
												</tbody>
											</table>
											<ul class="pagination">
											<?php
// start paging link
$self = $_SERVER['PHP_SELF'];
$query_list = mysqli_query($db, $query_list);
$total_no_of_records = mysqli_num_rows($query_list);
echo "<li class='disabled'><a href='#'>Total: ".$total_no_of_records."</a></li>";
if($total_no_of_records > 0) {
	$total_no_of_pages = ceil($total_no_of_records/$records_per_page);
	$current_page = 1;
	if(isset($_GET["page_no"])) {
		$current_page = $_GET["page_no"];
	}
	if($current_page != 1) {
		$previous = $current_page-1;
		echo "<li><a href='".$self."?page_no=1'>← First</a></li>";
		echo "<li><a href='".$self."?page_no=".$previous."'><i class='fa fa-angle-left'></i> Previous</a></li>";
	}
	for($i=1; $i<=$total_no_of_pages; $i++) {
		if($i==$current_page) {
			echo "<li class='active'><a href='".$self."?page_no=".$i."'>".$i."</a></li>";
		} else {
			echo "<li><a href='".$self."?page_no=".$i."'>".$i."</a></li>";
		}
	}
	if($current_page!=$total_no_of_pages) {
		$next = $current_page+1;
		echo "<li><a href='".$self."?page_no=".$next."'>Next <i class='fa fa-angle-right'></i></a></li>";
		echo "<li><a href='".$self."?page_no=".$total_no_of_pages."'>Last →</a></li>";
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