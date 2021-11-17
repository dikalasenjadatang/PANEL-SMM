<?php
session_start();
require("../mainconfig.php");

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
	$check_wtransfer = mysqli_query($db, "SELECT SUM(quantity) AS total FROM transfer_balance");
	$data_wtransfer = mysqli_fetch_assoc($check_wtransfer);
?>
<!-- Start content -->
                <div class="content">
                    <div class="container-fluid">
                             <section class="card">
								<div class=" m-l-none m-r-none bg-light lter">
									<div class="col-sm-12 padder-v b-r b-light lt">
										<span class="fa-stack fa-2x pull-left m-r-sm">
											<i class="fa fa-circle fa-stack-2x text-info"></i>
											<i class="fa fa-usd fa-stack-1x text-white"></i>
										</span>
										<a class="clear" href="#">
											<span class="h3 block m-t-xs">
												<strong>Rp <?php echo number_format($data_wtransfer['total'],0,',','.'); ?></strong>
											</span>
											<small class="text-muted text-uc">Total Seluruh Transfer Saldo</small>
										</a>
									</div>
								</section>	
			

	
							<div class="col-md-12">
								<div class="card">
									<div class="card-body">
										<h3 class="card-title"><i class="fa fa-money"></i> Riwayat Transfer Saldo</h3>
									</div>
									<div class="card-body">
										<div class="col-md-12 table-responsive">
											<table class="table table-striped table-bordered table-hover m-0">
												<thead>
													<tr>
														<th>Tanggal</th>
														<th>Pengirim</th>
														<th>Penerima</th>
														<th>Jumlah</th>
													</tr>
												</thead>
												<tbody>
												<?php
// start paging config
$query_list = "SELECT * FROM transfer_balance ORDER BY id DESC"; // edit
$records_per_page = 30; // edit

$starting_position = 0;
if(isset($_GET["page_no"])) {
	$starting_position = ($_GET["page_no"]-1) * $records_per_page;
}
$new_query = $query_list." LIMIT $starting_position, $records_per_page";
$new_query = mysqli_query($db, $new_query);
// end paging config
												while ($data_show = mysqli_fetch_assoc($new_query)) {
												?>
													<tr>
														<td><?php echo $data_show['date']; ?></td>
														<td><?php echo $data_show['sender']; ?></td>
														<td><?php echo $data_show['receiver']; ?></td>
														<td>Rp <?php echo number_format($data_show['quantity'],0,',','.'); ?></td>
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