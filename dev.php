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
}

include("lib/header.php");
?>
 <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">
						<div class="col-md-15">
								<div class="card">
									<div class="card-body">
										<h3 class="card-title"><i class="fa fa-phone"></i> Kontak Developer</h3>
									<div class="card-body">
Silahkan hubungi kontak dibawah ini untuk mendaftar atau mengajukan pertanyaan.<br />
<br />
<b>Whatsapp:</b>081534625504 </a><br />
<b>Facebook:</b> <a href=https://www.facebook.com/mr.cakil007>Darmawan utama</a><br />
<b>Email:</b> Dulbahri258@gmail.com   							</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div><!-- theme settings -->
<?php
include("lib/footer.php");
?>
<!-- Live Chat Widget powered by https://keyreply.com/chat/ -->
<!-- Advanced options: -->
<!-- data-align="left" -->
<!-- data-overlay="true" -->
<script data-align="right" data-overlay="false" id="keyreply-script" src="//keyreply.com/chat/widget.js" data-color="#9C27B0" data-apps="JTdCJTIyd2hhdHNhcHAlMjI6JTIyMDgxNTM0NjI1NTA0JTIyLCUyMmZhY2Vib29rJTIyOiUyMm1yLmNha2lsMDA3JTIyLCUyMmVtYWlsJTIyOiUyMmR1bGJhaHJpMjU4QGdtYWlsLmNvbSUyMiU3RA=="></script>