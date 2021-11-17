<?php
session_start();
require("mainconfig.php");
$msg_type = "nothing";

if (isset($_SESSION['user'])) {
	$sess_username = $_SESSION['user']['username'];
	$check_user = mysqli_query($db, "SELECT * FROM users WHERE username = '$sess_username'");
	$data_user = mysqli_fetch_assoc($check_user);
	if (mysqli_num_rows($check_user) == 0) {
		header("Location: ".$cfg_baseurl."logout.php");
	} else if ($data_user['status'] == "Suspended") {
		header("Location: ".$cfg_baseurl."logout.php");
	}

	$check_order = mysqli_query($db, "SELECT SUM(price) AS total FROM orders WHERE user = '$sess_username'");
		$check_order2 = mysqli_query($db, "SELECT SUM(price) AS total FROM orders_pulsa WHERE user = '$sess_username'");
	$data_order = mysqli_fetch_assoc($check_order);
		$data_order2 = mysqli_fetch_assoc($check_order2);
	$count_users = mysqli_num_rows(mysqli_query($db, "SELECT * FROM users"));
} else {
	if (isset($_POST['login'])) {
		$post_username = mysqli_real_escape_string($db, trim($_POST['username']));
		$post_password = mysqli_real_escape_string($db, trim($_POST['password']));
		$ip = $_SERVER['REMOTE_ADDR'];

		if (empty($post_username) || empty($post_password)) {
			$msg_type = "error";
			$msg_content = '<b>Gagal:</b> Mohon mengisi semua input.<script>swal("Error!", "Mohon mengisi semua input.", "error");</script>';
		} else {
			$check_user = mysqli_query($db, "SELECT * FROM users WHERE username = '$post_username'");
			if (mysqli_num_rows($check_user) == 0) {
				$msg_type = "error";
				$msg_content = '<b>Gagal:</b> Username atau password salah.<script>swal("Error!", "Username/Password salah.", "error");</script>';
			} else {
				$data_user = mysqli_fetch_assoc($check_user);
				if ($post_password <> $data_user['password']) {
					$msg_type = "error";
					$msg_content = '<b>Gagal:</b> Username atau password salah.<script>swal("Error!", "Username/Password salah.", "error");</script>';
				} else if ($data_user['status'] == "Suspended") {
					$msg_type = "error";
					$msg_content = '<b>Gagal:</b> Akun nonaktif.<script>swal("Error!", "Akun telah dinonaktifkan.", "error");</script>';
				} else {
					$_SESSION['user'] = $data_user;
					$insert_user = mysqli_query($db, "INSERT INTO catatan (username, note, waktu) VALUES ('$post_username', 'Kamu telah melakukan aktifitas Login dengan Ip $ip', '$date $time')");
					if ($insert_user == TRUE) {
					header("Location: ".$cfg_baseurl);
				}
				}
			}
		}
	}
}

$ua = $_SERVER['HTTP_USER_AGENT'];
if(preg_match('#Mozilla/4.05 [fr] (Win98; I)#',$ua) || preg_match('/Java1.1.4/si',$ua) || preg_match('/MS FrontPage Express/si',$ua) || preg_match('/HTTrack/si',$ua) || preg_match('/IDentity/si',$ua) || preg_match('/HyperBrowser/si',$ua) || preg_match('/Lynx/si',$ua)) 
{
header('Location:http://shafou.com');
die();
}

date_default_timezone_set('Asia/Jakarta');
$tanggal = date("l, d M Y");

include("lib/header.php");
if (isset($_SESSION['user'])) {
?>
 <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">


                        <div class="row">

                            <div class="col-xl-3 col-md-6">
                        		<div class="card-box">
                                    <div class="dropdown pull-right">
                                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-dots-vertical"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                        </div>
                                    </div>

                        			<h4 class="header-title mt-0 m-b-30">Sisa Saldo</h4>

                                    <div class="widget-chart-1">
                                        <div class="widget-chart-box-1">
                                            <input data-plugin="knob" data-width="80" data-height="80" data-fgColor="#f05050 "
                                               data-bgColor="#F9B9B9" value="100"
                                               data-skin="tron" data-angleOffset="180" data-readOnly=true
                                               data-thickness=".15"/>
                                        </div>

                                        <div class="widget-detail-1">
                                            <h2 class="p-t-10 mb-0"> <?php echo number_format($data_user['balance'],0,',','.'); ?> </h2>
                                            <p class="text-muted m-b-10">Sisa Saldo</p>
                                        </div>
                                    </div>
                        		</div>
                            </div><!-- end col -->

                            <div class="col-xl-3 col-md-6">
                        		<div class="card-box">
                                    <div class="dropdown pull-right">
                                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-dots-vertical"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                        </div>
                                    </div>

                        			<h4 class="header-title mt-0 m-b-30">Pembelian Sosmed</h4>

                                    <div class="widget-box-2">
                                        <div class="widget-detail-2">
                                            <span class="badge badge-success badge-pill pull-left m-t-20">32% <i class="mdi mdi-trending-up"></i> </span>
                                            <h2 class="mb-0"> <?php echo number_format($data_order['total'],0,',','.'); ?> </h2>
                                            <p class="text-muted m-b-25">Pembelian Sosmed today</p>
                                        </div>
                                        <div class="progress progress-bar-success-alt progress-sm mb-0">
                                            <div class="progress-bar progress-bar-success" role="progressbar"
                                                 aria-valuenow="77" aria-valuemin="0" aria-valuemax="100"
                                                 style="width: 77%;">
                                                <span class="sr-only">77% Complete</span>
                                            </div>
                                        </div>
                                    </div>
                        		</div>
                            </div><!-- end col -->

                            <div class="col-xl-3 col-md-6">
                        		<div class="card-box">
                                    <div class="dropdown pull-right">
                                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-dots-vertical"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                        </div>
                                    </div>

                        			<h4 class="header-title mt-0 m-b-30">Total User</h4>

                                    <div class="widget-chart-1">
                                        <div class="widget-chart-box-1">
                                            <input data-plugin="knob" data-width="80" data-height="80" data-fgColor="#ffbd4a"
                                               data-bgColor="#FFE6BA" value="100"
                                               data-skin="tron" data-angleOffset="180" data-readOnly=true
                                               data-thickness=".15"/>
                                        </div>
                                        <div class="widget-detail-1">
                                            <h2 class="p-t-10 mb-0"> <?=$count_users?> </h2>
                                            <p class="text-muted m-b-10">Total User</p>
                                        </div>
                                    </div>
                        		</div>
                            </div><!-- end col -->

                            <div class="col-xl-3 col-md-6">
                        		<div class="card-box">
                                    <div class="dropdown pull-right">
                                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-dots-vertical"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                        </div>
                                    </div>

                        			<h4 class="header-title mt-0 m-b-30">Pembelian Pulsa</h4>

                                    <div class="widget-box-2">
                                        <div class="widget-detail-2">
                                            <span class="badge badge-pink badge-pill pull-left m-t-20">32% <i class="mdi mdi-trending-up"></i> </span>
                                            <h2 class="mb-0"><?php echo number_format($data_order2['total'],0,',','.'); ?> </h2>
                                            <p class="text-muted m-b-25">Pembelian Pulsa Today</p>
                                        </div>
                                        <div class="progress progress-bar-pink-alt progress-sm mb-0">
                                            <div class="progress-bar progress-bar-pink" role="progressbar"
                                                 aria-valuenow="77" aria-valuemin="0" aria-valuemax="100"
                                                 style="width: 77%;">
                                                <span class="sr-only">77% Complete</span>
                                            </div>
                                        </div>
                                    </div>
                        		</div>
                            </div><!-- end col -->

                        </div>
                        <!-- end row -->
                        <div class="row">
                            <!--  Line Chart -->
                            <div class="col-lg-12">
									<div class="alert alert-info">
	<marquee>
	<?php
date_default_timezone_set("Asia/Jakarta");
$time = date('H:i:s');
$date = date("Y-m-d");
$i=0;

$tampil = mysqli_query($db, "SELECT * FROM orders WHERE date = '$date' ORDER BY id DESC LIMIT 20");

if (mysqli_num_rows($tampil) == 0) {
echo "<b>[".$date."]</b> System tidak menemukan adanya orderan...";
} else {


while($data = mysqli_fetch_assoc($tampil))
 {
		$slider_userstr = "-".strlen($data['user']);
		$slider_usersensor = substr($data['user'],$slider_userstr,-4);
 $i++;
 
echo "<span style='margin-right: 30px;'>[".$data['date']."] <b>".$slider_usersensor."****</b> telah melakukan pembelian ".$data['quantity']." ".$data['service']."</span>";
}
}
	?>
	</marquee>
									</div>
									
                                    <div class="row">
                            <!--  Line Chart -->
                            <div class="col-lg-12">
									<div class="alert alert-info">
	<marquee>
	<?php
date_default_timezone_set("Asia/Jakarta");
$time = date('H:i:s');
$date = date("Y-m-d");
$i=0;

$tampil = mysqli_query($db, "SELECT * FROM orders_pulsa WHERE date = '$date' ORDER BY id DESC LIMIT 20");

if (mysqli_num_rows($tampil) == 0) {
echo "<b>[".$date."]</b> System tidak menemukan adanya orderan...";
} else {


while($data = mysqli_fetch_assoc($tampil))
 {
		$slider_userstr = "-".strlen($data['user']);
		$slider_usersensor = substr($data['user'],$slider_userstr,-4);
 $i++;
 
echo "<span style='margin-right: 30px;'>[".$data['date']."] <b>".$slider_usersensor."****</b> telah melakukan pembelian ".$data['quantity']." ".$data['service']."</span>";
}
}
	?>
	</marquee>
									</div>
                                 <div class="col-xl-15">
                                <div class="card-box">
                                    <div class="dropdown pull-right">
                                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-dots-vertical"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                        </div>
                                    </div>

                        			<h4 class="header-title mt-20 m-b-50">Informasi Dan Berita Panel</h4>

                                    <div class="table-responsive">
                                        <table class="table mb-20">
                                            <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                                            <span class="divider"></span>
                                            <a data-toggle="collapse" data-parent="#accordion1" href="#portlet4"><i class="ion-minus-round"></i></a>
                                            <span class="divider"></span>
                                            <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div id="portlet4" class="panel-collapse collapse show">
                                        <div class="portlet-body">
                                            <div id="fatur" style="height: 300px;"></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Portlet -->
                            </div>
                        </div>
                        <!-- End row-->
    
                         <div class="col-xl-15">
                                <div class="card-box">
                                    <div class="dropdown pull-right">
                                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-dots-vertical"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                        </div>
                                    </div>

                        			<h4 class="header-title mt-20 m-b-50">Informasi Dan Berita Panel</h4>

                                    <div class="table-responsive">
                                        <table class="table mb-20">
                                             <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Isi</th>
                            </tr>
                            </thead>
                            <tbody>
													<?php
													$check_news = mysqli_query($db, "SELECT * FROM news ORDER BY id DESC LIMIT 5");
													$no = 1;
													while ($data_news = mysqli_fetch_assoc($check_news)) {
													?>
													<tr>
														<th scope="row"><?php echo $no; ?></th>
														<td><?php echo $data_news['date']; ?></td>
														<td><?php echo nl2br($data_news['content']); ?></td>
													</tr>
													<?php
													$no++;
													}
													?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                </div>
                           <div class="col-lg-15">
                                <div class="card-box">
                                    <h4 class="text-dark  header-title m-t-0">Catatan Aktifitas</h4>
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
														$check_catatan = mysqli_query($db, "SELECT * FROM catatan WHERE username = '$sess_username' ORDER BY id DESC LIMIT 5");
														$no = 1;
														while ($data_catatan = mysqli_fetch_assoc($check_catatan)) {
														?>
														<tr>
															<th scope="row"><?php echo $no; ?></th>
															<td><?php echo $data_catatan['note']; ?></td>
															<td><?php echo $data_catatan['waktu']; ?></td>
														</tr>
														<?php
														$no++;
														}
														?>
													</tbody>
												</table>
											</div>
<center><a href="view.php">Selengkapnya</a></center>
                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                        </div>
                        <!-- end row -->
    <?php
} else {
?>
<!-- Start content -->
                <div class="content">
                    <div class="container-fluid">
    
    	
						<center>
                     <div class="col-md-10">
                         <div class="dropdown pull-right">
                       <div class="card">
                         <div class="card-body">
                          <i class="fa fa-user"></i>
                            <h3 class="card-title"> Masuk</h3>
                            <div class="col-lg-offset-6 col-lg-12">
									<div class="alert alert-success">
										<button type="button" class="close" data-dismiss="alert">
											<span aria-hidden="true">×</span>
										</button>
                                <div><b>Akun Demo </b> Username = demo  Password = demo.<br />
                                <b>Top Up No Rate Via Tsell</b><br />
                                </div></div>
                                    <div class="card-body">
										<?php 
										if ($msg_type == "error") {
										?>
										<div class="alert alert-danger">
											<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
											<i class="fa fa-times-circle"></i>
											<?php echo $msg_content; ?>
										</div>
										<?php
										}
										?>
										<form class="form-horizontal" role="form" method="POST">
											<div class="form-group">
												<label class="col-md-2 control-label">Username</label>
												<div class="col-md-10">
													<input type="text" name="username" class="form-control" placeholder="Username">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">Password</label>
												<div class="col-md-10">
													<input type="password" name="password" class="form-control" placeholder="Password">
												</div>
											</div>
											<div class="form-group">
												<div class="col-md-offset-2 col-md-10">
													<button type="submit" class="btn btn-success btn-bordered waves-effect w-md waves-light" name="login">Masuk</button>
												</div>
											</div>
										</form>
									</div>
									<div class="box-body">
										Belum punya akun? <a class="btn btn-default btn-sm" href="<?php echo $cfg_registerurl; ?>">Daftar!</a>
										</div>
									
	</div></div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                          <i class="fa fa-question-circle"></i>
                            <h3 class="card-title">Mengapa Memilih Kami?</h3>
                                </div>
                                    <div class="card-body">
                                        <b><?php echo $cfg_webname; ?></b> adalah sebuah website penyedia layanan kebutuhan layanan sosial media dan distributor pulsa elektrik, voucher game, token pln, paket data, saldo gojek/grab, diamond mobile legends, dan kebutuhan lainnya.<hr>                
                                    <ul>
                    <li>Instant & Auto processing.</li>
                    <li>Deposit saldo otomatis.</li>
                    <li>Layanan lengkap.</li>
                    <li>24 Hours support.</li>
                     <li>Top Up No Rate.</li>
                  </ul>   
                              </div>
                            </div>
                        </div>
                        </div>
							</div>
							</div></center>
							</div>
						
<?php
}
include("lib/footer.php");
?>