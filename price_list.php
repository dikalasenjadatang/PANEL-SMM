<?php
// Recoded by Gh0Code
// Hargailah orang lain jika Anda ingin dihargai
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
}

include("lib/header.php");
?>
 <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card-box">
                                    <h4 class="text-dark  header-title m-t-0">Daftar Harga Sosmed</h4>
										<div class="alert alert-info">
												<i class="fa fa-check fa-fw"></i>: Layanan active.<br />
												<i class="fa fa-times fa-fw"></i>: Layanan not active.
											</div>
									<form class="form-horizontal" role="form" method="POST">
											<div class="form-group row">
												<label class="control-label">Kategori</label>
													<select class="form-control" id="category">
														<option value="0">Pilih salah satu...</option>
														<?php
														$check_cat = mysqli_query($db, "SELECT * FROM service ORDER BY name ASC");
														while ($data_cat = mysqli_fetch_assoc($check_cat)) {
														?>
														<option value="<?php echo $data_cat['code']; ?>"><?php echo $data_cat['name']; ?></option>
														<?php
														}
														?>
													</select>
											</div>
											<div id="note"></div>
									</form>
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
						<script type="text/javascript" src="https://code.jquery.com/jquery-1.10.2.js"></script>
	<script type="text/javascript">
$(document).ready(function() {
	$("#category").change(function() {
		var category = $("#category").val();
		$.ajax({
			url: '<?php echo $cfg_baseurl; ?>include/order_service.php',
			data: 'category=' + category,
			type: 'POST',
			dataType: 'html',
			success: function(msg) {
				$("#note").html(msg);
			}
		});
	});
});

function get_total(quantity) {
	var rate = $("#rate").val();
	var result = eval(quantity) * rate;
	$('#total').val(result);
}
	</script>
<?php
include("lib/footer.php");
?>