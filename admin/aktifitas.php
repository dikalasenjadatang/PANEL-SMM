<?php
// Recoded by Gh0Code
// Hargailah orang lain jika Anda ingin dihargai
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
?>
 <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card-box">
                                    <h4 class="text-dark  header-title m-t-0">Aktifitas Pengguna </h4>
											<div class="table-responsive">
												<table class="table table-striped table-bordered table-hover m-0">
													<thead>
														<tr>
															<th>#</th>
															<th>Catatan</th>
															<th>Waktu</th>
														</tr>
													</thead>
													<tbody>
														<?php
// start paging config
$query_list = "SELECT * FROM catatan ORDER BY id DESC"; // edit
$records_per_page = 30; // edit

$starting_position = 0;
if(isset($_GET["page_no"])) {
	$starting_position = ($_GET["page_no"]-1) * $records_per_page;
}
$new_query = $query_list." LIMIT $starting_position, $records_per_page";
$new_query = mysqli_query($db, $new_query);
// end paging config
												while ($data_show = mysqli_fetch_assoc($new_query)) {
            $string = $data_show['note'];
            $hasil = str_replace("Kamu", "Username ".$data_show['username']."", $string);
														?>
														<tr>
															<th scope="row"><?php echo $data_show['id']; ?></th>
															<td><?php echo $hasil; ?></td>
															<td><?php echo $data_show['waktu']; ?></td>
														</tr>
														<?php
														$no++;
														}
														?>
													</tbody>
												</table>
											</div>
										<div class="table-responsive">
										<nav class="m-t-20">
											<ul class="pagination">
											<?php
// start paging link
$self = $_SERVER['PHP_SELF'];
$query_list = mysqli_query($db, $query_list);
$total_no_of_records = mysqli_num_rows($query_list);
echo "<li class='page-item disabled'><a href='#' class='page-link'>Total: ".$total_no_of_records."</a></li>";
if($total_no_of_records > 0) {
	$total_no_of_pages = ceil($total_no_of_records/$records_per_page);
	$current_page = 1;
	if(isset($_GET["page_no"])) {
		$current_page = $_GET["page_no"];
	}
	if($current_page != 1) {
		$previous = $current_page-1;
		echo "<li class='page-item'><a class='page-link' href='".$self."?page_no=1'>← First</a></li>";
		echo "<li class='page-item'><a class='page-link' href='".$self."?page_no=".$previous."'><i class='fa fa-angle-left'></i> Previous</a></li>";
	}
	for($i=1; $i<=$total_no_of_pages; $i++) {
		if($i==$current_page) {
			echo "<li class='page-item active'><a class='page-link' href='".$self."?page_no=".$i."'>".$i."</a></li>";
		} else {
			echo "<li class='page-item'><a class='page-link' href='".$self."?page_no=".$i."'>".$i."</a></li>";
		}
	}
	if($current_page!=$total_no_of_pages) {
		$next = $current_page+1;
		echo "<li class='page-item'><a class='page-link' href='".$self."?page_no=".$next."'>Next <i class='fa fa-angle-right'></i></a></li>";
		echo "<li class='page-item'><a class='page-link' href='".$self."?page_no=".$total_no_of_pages."'>Last →</a></li>";
	}
}
// end paging link
											?>
											</ul>
										</nav>
										</div>
                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->


                    </div>
                    <!-- end container -->
                </div>
                <!-- end content -->

                <footer class="footer">
                    <div class="pull-left">2018 ~ <a href="javascript:void(0);"><?php echo $cfg_webname; ?></a></div>
                    <div class="pull-right"><span class="hide-phone">Create With <i class="fa fa-heart"></i> by <a href="http://facebook.com/adminfatur">Gh0Code</a></span></div>
                </footer>
<?php
	include("../lib/footer.php");
	}
} else {
	header("Location: ".$cfg_baseurl);
}
?>