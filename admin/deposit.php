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

	include("../lib/header.php");
?>
					
<!-- Start content -->
                <div class="content">
                    <div class="container-fluid">

				
							<div class="col-md-12">
								<div class="card">
									<div class="card-body">
										<h3 class="card-title"><i class="fa fa-money"></i> Daftar Deposit</h3>
									</div>
									<div class="card-body">
										<?php 
										if ($msg_type == "success") {
										?>
										<div class="alert alert-icon alert-success alert-dismissible fade in" role="alert">
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											<i class="fa fa-check-circle"></i>
											<?php echo $msg_content; ?>
										</div>
										<?php
										} else if ($msg_type == "error") {
										?>
										<div class="alert alert-icon alert-danger alert-dismissible fade in" role="alert">
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											<i class="fa fa-times-circle"></i>
											<?php echo $msg_content; ?>
										</div>
										<?php
										}
										?>
										<div class="alert alert-info">
										    Jika status <span class="label label-info">Processing</span> membutuhkan konfirmasi langsung di cek aja <br />
										</div>
										<div class="col-md-6">
										</div>
										<div class="col-md-6">
										</div>
										<div class="clearfix"></div>
										<br />
										<div class="col-md-12 table-responsive">
											<table class="table table-striped table-bordered table-hover m-0">
												<thead>
													<tr>
														 <th>Date</th>
														<th>Time     </th>
														<th>Saldo Didapat</th>
														<th>Pengirim</th>
														<th>Username</th>
														<th>Status</th>
														<th>Provider</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
												<?php
// start paging config
$query_list = "SELECT * FROM history_topup ORDER BY id DESC"; // edit
$records_per_page = 10; // edit

$starting_position = 0;
if(isset($_GET["page_no"])) {
	$starting_position = ($_GET["page_no"]-1) * $records_per_page;
}
$new_query = $query_list." LIMIT $starting_position, $records_per_page";
$new_query = mysqli_query($db, $new_query);
// end paging config
												$no = 1;
											while ($data_depo = mysqli_fetch_assoc($new_query)) {
													if($data_depo['status'] == "NO") {
														$label = "warning";
													} else if($data_depo['status'] == "Processing") {
														$label = "info";
													} else if($data_depo['status'] == "Error") {
														$label = "danger";
													} else if($data_depo['status'] == "YES") {
														$label = "success";
													}
												?>
													<tr>
														<th scope="row"><?php echo $data_depo['date']; ?></th>
														<td><?= $data_depo['time'] ?></td>
															<td><?= $data_depo['amount'] ?></td>
															
															<td><?= $data_depo['no_pengirim'] ?></td>
															<td><?= $data_depo['username'] ?></td>
											                  <td><?php echo $data_depo['status']; ?></td>
											                  <td><?php echo $data_depo['provider']; ?></td>
											                   <td><?php if($data_depo['status'] == "YES"){?>
											                   <input type="submit" value="Hapus" disable="disabled" readonly>
											                  <?php } else{?>
											                      <form method="POST" action="">
											                      <input type="hidden" name="qey" value="<?= $data_depo['id']; ?>">
											                      <input type="submit" name="h" value="Hapus"></input>
											                      </form
											                      <?php }?>
											                 </td>
													</tr>
												<?php
												$no++;
												}
												?>
												</tbody>
											</table>
										</div>
										<div class="col-md-12">
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
										<div class="clearfix"></div>
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