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

	// widget
	$check_worder = mysqli_query($db, "SELECT SUM(price) AS total FROM orders");
	$data_worder = mysqli_fetch_assoc($check_worder);
	$check_worder = mysqli_query($db, "SELECT * FROM orders");
	$count_worder = mysqli_num_rows($check_worder);
?>
<!-- Start content -->
                <div class="content">
                    <div class="container-fluid">
                          <section class="card">
								<div class=" m-l-none m-r-none bg-light lter">
									<div class="col-sm-12 padder-v b-r b-light lt">
										<span class="fa-stack fa-2x pull-left m-r-sm">
											<i class="fa fa-circle fa-stack-2x text-info"></i>
											<i class="fa fa-shopping-cart fa-stack-1x text-white"></i>
										</span>
										<a class="clear" href="#">
											<span class="h3 block m-t-xs">
												<strong><?php echo number_format($data_worder['total'],0,',','.'); ?> (Dari <?php echo number_format($count_worder,0,',','.'); ?> pesanan)</strong>
											</span>
											<small class="text-muted text-uc">Total Seluruh Pembelian Pengguna</small>
										</a>
									</div>
								</section>	
			
						

					
							<div class="col-md-12">
								<div class="card">
									<div class="card-body">
										<h3 class="card-title"><i class="fa fa-shopping-cart"></i> Daftar Pesanan</h3>
									</div>
									<div class="card-body">
										<div class="alert alert-info">
											<i class="fa fa-globe fa-fw"></i>: Dipesan dari website.<br />
											<i class="fa fa-random fa-fw"></i>: Dipesan dari API.
										</div>
										<div class="col-md-6">
										</div>
										<div class="col-md-6">
											<form method="GET">
											<div class="input-group m-b-20">
												<input type="text" name="search" class="form-control input-sm" placeholder="Cari order id">
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
														<th></th>
														<th>OID</th>
														<th>Pengguna</th>
														<th>Layanan</th>
														<th>Target</th>
														<th>Jumlah</th>
														<th>Harga</th>
														<th>OID Provider</th>
														<th>Provider</th>
														<th>Status</th>
														<th>Refund</th>
														<th>Aksi</th>
													</tr>
												</thead>
												<tbody>
												<?php
// start paging config
if (isset($_GET['search'])) {
	$search = $_GET['search'];
	$query_list = "SELECT * FROM orders WHERE oid LIKE '%$search%' ORDER BY id DESC"; // edit
} else {
	$query_list = "SELECT * FROM orders ORDER BY id DESC"; // edit
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
													if($data_show['status'] == "Pending") {
														$label = "warning";
													} else if($data_show['status'] == "Processing") {
														$label = "info";
													} else if($data_show['status'] == "Error") {
														$label = "danger";
													} else if($data_show['status'] == "Partial") {
														$label = "danger";
													} else if($data_show['status'] == "Success") {
														$label = "success";
													}
												?>
													<tr>
														<td align="center"><?php if($data_show['place_from'] == "API") { ?><i class="fa fa-random"></i><?php } else { ?><i class="fa fa-globe"></i><?php } ?></td>
														<td><?php echo $data_show['oid']; ?></td>
														<td><?php echo $data_show['user']; ?></td>
														<td><?php echo $data_show['service']; ?></td>
														<td><input type="text" class="form-control" value="<?php echo $data_show['link']; ?>" style="width: 200px;"></td>
														<td><?php echo number_format($data_show['quantity'],0,',','.'); ?></td>
														<td><?php echo number_format($data_show['price'],0,',','.'); ?></td>
														<td><?php echo $data_show['poid']; ?></td>
														<td><?php echo $data_show['provider']; ?></td>
														<td><label class="label label-<?php echo $label; ?>"><?php echo $data_show['status']; ?></label></td>
														<td><label class="label label-<?php if($data_show['refund'] == 0) { echo "danger"; } else { echo "success"; } ?>"><?php if($data_show['refund'] == 0) { ?><i class="fa fa-times"></i><?php } else { ?><i class="fa fa-check"></i><?php } ?></label></td>
														<td align="center">
														<a href="<?php echo $cfg_baseurl; ?>admin/order/edit.php?oid=<?php echo $data_show['oid']; ?>" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></a>
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