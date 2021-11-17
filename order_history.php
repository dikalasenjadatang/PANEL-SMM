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
?>
 <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">	
						
							<div class="col-lg-12">
								<div class="card">
									<div class="card-body">
										<h3 class="card-title"><i class="fa fa-history"></i> Riwayat Pemesanan Sosial Media</h3>
									</div>
									<div class="card-body">
										<div class="alert alert-info">
											<i class="fa fa-globe"></i>: Dipesan melalui website.<br />
											<i class="fa fa-random"></i>: Dipesan melalui API.
										</div>
										<div class="table-responsive">
											<table class="table table-striped table-bordered table-hover m-0">
												<thead>
													<tr>
														<th></th>
														<th>Order ID</th>
														<th>Layanan</th>
														<th>Link</th>
														<th>Jumlah</th>
														<th>Jumlah Awal</th>
														<th>Sisa</th>
														<th>Harga</th>
														<th>Status</th>
														<th>Refund</th>
													</tr>
												</thead>
												<tbody>
												<?php
// start paging config
$query_order = "SELECT * FROM orders WHERE user = '$sess_username' ORDER BY id DESC"; // edit
$records_per_page = 30; // edit

$starting_position = 0;
if(isset($_GET["page_no"])) {
	$starting_position = ($_GET["page_no"]-1) * $records_per_page;
}
$new_query = $query_order." LIMIT $starting_position, $records_per_page";
$new_query = mysqli_query($db, $new_query);
// end paging config
												while ($data_order = mysqli_fetch_assoc($new_query)) {
													if($data_order['status'] == "Pending") {
														$label = "warning";
													} else if($data_order['status'] == "Processing") {
														$label = "info";
													} else if($data_order['status'] == "Error") {
														$label = "danger";
													} else if($data_order['status'] == "Partial") {
														$label = "danger";
													} else if($data_order['status'] == "Success") {
														$label = "success";
													}
												?>
													<tr>
														<td align="center"><?php if($data_order['place_from'] == "API") { ?><i class="fa fa-random"></i><?php } else { ?><i class="fa fa-globe"></i><?php } ?></td>
														<td><?php echo $data_order['oid']; ?></td>
														<td><?php echo $data_order['service']; ?></td>
														<td><?php echo $data_order['link']; ?></td>
														<td><?php echo number_format($data_order['quantity'],0,',','.'); ?></td>
														<td><?php echo number_format($data_order['start_count'],0,',','.'); ?></td>
														<td><?php echo number_format($data_order['remains'],0,',','.'); ?></td>
														<td>Rp <?php echo number_format($data_order['price'],0,',','.'); ?></td>
														<td align="center"><label class="label label-<?php echo $label; ?>"><?php echo $data_order['status']; ?></label></td>
														<td align="center"><label class="label label-<?php if($data_order['refund'] == 0) { echo "danger"; } else { echo "success"; } ?>"><?php if($data_order['refund'] == 0) { ?><i class="fa fa-times"></i><?php } else { ?><i class="fa fa-check"></i><?php } ?></label></td>
													</tr>
												<?php
												}
												?>
												</tbody>
											</table>
										</div>
										<ul class="pagination">
											<?php
// start paging link
$self = $_SERVER['PHP_SELF'];
$query_order = mysqli_query($db, $query_order);
$total_no_of_records = mysqli_num_rows($query_order);
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
						<!-- end row -->
<?php
	include("lib/footer.php");
} else {
	header("Location: ".$cfg_baseurl);
}
?>