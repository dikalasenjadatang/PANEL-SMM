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
	}

	include("../lib/header.php");
	$msg_type = "nothing";

	
	$check_user = mysqli_query($db, "SELECT * FROM users WHERE username = '$sess_username'");
	$data_user = mysqli_fetch_assoc($check_user);
	
	if(isset($_POST['code'])) {
	    $post_code = $_POST['code'];
	    
	    $select = mysqli_query($db, "SELECT * FROM deposits_history WHERE code = '$post_code'");
	    $datana = mysqli_fetch_assoc($select);
	    
	    if(mysqli_num_rows($select) == 0) {
	        $msg_type = "error";
	        $msg_content = "<b>Gagal:</b> Data tidak di temukan.";
	    } else if($datana['status'] !== "Pending" AND $datana['status'] !== "Processing") {
             $msg_type = "error";
	        $msg_content = "<b>Gagal:</b> Data tidak bisa di batalkan.";	 
	    } else {
	        $update = mysqli_query($db, "UPDATE deposits_history set status = 'Error' WHERE code = '$post_code'");
	        if($update == TRUE) {
	            $msg_type = "success";
	            $msg_content = "Berhasil membatalkan!";
	        } else {
	            $msg_type = "error";
	            $msg_content = "GAGAL MEMBATALKAN #1";
	        }
	    }
	}

?>

	                   <div class="main-content">
<div class="container-fluid">
					                     <div class="col-md-12">
                       <div class="card">
                         <div class="card-body">
                                         <h3 class="box-title"><i class="fa fa-newspaper-o"></i> Riwayat Deposit TSEL</h3>
                                        </div>
                                                <div class="box-body table-responsive no-padding">
                                                     <table class="table table-hover">
                                                <thead>
													<tr>	
													    <th>ID Pengisian</th>
														<th>Provider</th>
														<th>Jumlah Transfer</th>
														<th>Amount</th>
														<th>No Pengirim</th>
														<th>Tanggal</th>
														<th>Waktu</th>
														<th>Status</th>
													</tr>
												</thead>
												<tbody>
												<?php
												
// start paging config
$query_order = "SELECT * FROM history_topup WHERE username = '$sess_username' ORDER BY id DESC"; // edit
$records_per_page = 30; // edit

$starting_position = 0;
if(isset($_GET["page_no"])) {
	$starting_position = ($_GET["page_no"]-1) * $records_per_page;
}
$new_query = $query_order." LIMIT $starting_position, $records_per_page";
$new_query = mysqli_query($db, $new_query);
// end paging config
												while ($data_depo = mysqli_fetch_assoc($new_query)) {
													if($data_depo['status'] == "NO") {
														$label = "warning";
														$ss1="Waiting";
													} else if($data_depo['status'] == "CANCEL") {
														$label = "danger";
															$ss1="CANCELED";
													} else if($data_depo['status'] == "YES") {
														$label = "success";
															$ss1="Success";
													}
												?>
													<tr>
													    <td width="100px"><a href="<?php echo $cfg_baseurl; ?>deposit/detail/isi.php?oid=<?php echo $data_depo['id']; ?>" class="text-bold text-aqua" title="Detail"><i class="fa fa-plus-square"></i> AUTO-<?php echo $data_depo['id']; ?></a></td>
														<td><?php if($data_depo['provider'] == "TSEL") { ?>TELKOMSEL<?php } else { ?><span class= "label label-danger"><i class="fa fa-times"></i> XXX</span><?php } ?>	</td>
														<td><?php echo number_format($data_depo['jumlah_transfer'],0,',','.'); ?></td>
														<td><?php echo number_format($data_depo['amount'],0,',','.'); ?></td>
														<td><?php echo $data_depo['no_pengirim']; ?></td>
														
														<td><?php echo $data_depo['date']; ?></td>
														<td><?php echo $data_depo['time']; ?></td>
														<td><label class="label label-<?php echo $label; ?>"><?php echo $ss1; ?></label></td>
														
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
	include("../lib/footer.php");
} else {
	header("Location: ".$cfg_baseurl);
}
?>