<?php
session_start();
require("../../mainconfig.php");
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
		if (isset($_GET['code'])) {
			$post_code = $_GET['code'];
			$sql_code = mysqli_query($db, "SELECT * FROM deposits_history WHERE code = '$post_code'");
			$data_code = mysqli_fetch_assoc($sql_code);
			$get_balance = $data_code['get_balance'];
			$balance_user = $data_code['user'];
			
			if(empty($data_code['link_confirm'])) {
			    $bukti = "Belum di konfirmasi";
			} else {
			    $bukti = $data_code['link_confirm'];
			}
			if(mysqli_num_rows($sql_code) == 0) {
			    header("Location: ".$cfg_baseurl."admin/deposit.php");
			} else if($data_code['status'] == "Success" OR $data_code['status']== "Error") {
			    header("Location: ".$cfg_baseurl."admin/deposit.php");
			} else {
			    if(isset($_POST['edit'])) {
			        $post_status = $_POST['status'];
			        
			        if($post_status !== "Pending" AND $post_status !== "Processing" AND $post_status !== "Error" AND $post_status !== "Success") {
			            $msg_type = "error";
			            $msg_content = "<b>Gagal:</b> Status salah";
			        } else {
			            if($_POST['status'] == "Success") {
			            $update = mysqli_query($db, "UPDATE deposits_history set status = '$post_status' WHERE code = '$post_code'");
			            $update = mysqli_query($db, "UPDATE users set balance = balance+$get_balance WHERE username = '$balance_user'");
			            if($update == TRUE) {
			                $msg_type = "success";
			                $msg_content = "<b>Berhasil:</b> Saldo sudah di tambahkan ke <b><i class='ahyar'>".$data_code['user']."</i></b> dengan jumlah $get_balance dan status sudah di update.";
			            } else {
			                $msg_type = "error";
			                $msg_content = "system error #1";
			            }
			        } else {
			            $update = mysqli_query($db, "UPDATE deposits_history set status = '$post_status' WHERE code = '$post_code'");
			            if($update == TRUE) {
                             $msg_type = "success";
			                $msg_content = "<b>Berhasil:</b> Update berhasil";			                
			            } else {
                            $msg_type = "error";
			                $msg_content = "system error #2";			              
			            }
			        }
			    }
			    }
				include("../../lib/header.php");
?>
					

						<div class="col-md-12">
								<div class="card">
									<div class="card-body">
										<h3 class="card-title"><i class="fa fa-edit"></i> Ubah Deposit</h3>
									</div>
									<div class="card-body">
									    <div class="alert alert-info">
									        - Kalo Status di ganti jadi sukses <br />
									        - Saldo otomatis masuk ke userna
									    </div>
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
										<form class="form-horizontal" role="form" method="POST">
											<div class="form-group">
												<label class="col-md-2 control-label">Kode Deposit</label>
												<div class="col-md-10">
													<input type="text" class="form-control" placeholder="Kode Deposit" value="<?php echo $_GET['code']; ?>" readonly>
												</div>
											</div>
                                       <div class="form-group">
												<label class="col-md-2 control-label">Pengguna</label>
												<div class="col-md-10">
													<input type="text" name="users" class="form-control" placeholder="Jumlah TF" value="<?php echo $data_code['user']; ?>" readonly>
												</div>
											</div>
                                        <div class="form-group">
												<label class="col-md-2 control-label">Pengirim</label>
												<div class="col-md-10">
													<input type="text" name="sending" class="form-control" placeholder="Pengirim" value="<?php echo $data_code['pengirim']; ?>" readonly>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">Jumlah Transfer</label>
												<div class="col-md-10">
													<input type="number" name="quantitytf" class="form-control" placeholder="Jumlah TF" value="<?php echo $data_code['quantity']; ?>" readonly>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">Saldo yang didapat</label>
												<div class="col-md-10">
													<input type="number" name="balanceget" class="form-control" placeholder="Get Balance" value="<?php echo $data_code['get_balance']; ?>" readonly>
												</div>
											</div>
                                      <div class="form-group">
												<label class="col-md-2 control-label">Metode</label>
												<div class="col-md-10">
													<input type="text" name="metode" class="form-control" placeholder="Metode" value="<?php echo $data_code['method']; ?>" readonly>
												</div>
											</div>
                                      <div class="form-group">
												<label class="col-md-2 control-label">Bukti Transfer</label>
												<div class="col-md-10">
													<input type="text" name="BUKTI TF" class="form-control" placeholder="Bukti TF" value="<?php echo $bukti; ?>" readonly>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">Status</label>
												<div class="col-md-10">
													<select class="form-control" name="status">
														<option value="<?php echo $data_code['status']; ?>"><?php echo $data_code['status']; ?> (Selected)</option>
														<option value="Pending">Pending</option>
														<option value="Processing">Processing</option>
														<option value="Error">Error</option>
														<option value="Success">Success</option>
													</select>
												</div>
											</div>
											<a href="<?php echo $cfg_baseurl; ?>admin/deposit.php" class="btn btn-info btn-bordered waves-effect w-md waves-light">Kembali ke daftar</a>
											<div class="pull-right">
												<button type="reset" class="btn btn-danger btn-bordered waves-effect w-md waves-light">Ulangi</button>
												<button type="submit" class="btn btn-success btn-bordered waves-effect w-md waves-light" name="edit">Ubah</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
						<!-- end row -->
						<? } ?>
<?php
	include("../../lib/footer.php");
		} else {
     	header("Location: ".$cfg_baseurl."admin/deposit.php");
		}
	}
} else {
	header("Location: ".$cfg_baseurl);
}
?>