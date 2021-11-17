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
  <div class="col-xl-15">
                                <div class="card-box">
                                    <div class="dropdown pull-right">
                                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-dots-vertical"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                        </div>
                                    </div>

                        			<h4 class="header-title mt-20 m-b-50">TOP PEMBELIHAN SOSMED</h4>

                                    <div class="table-responsive">
                                        <table class="table mb-20">
													<thead>
							
													<tr>
														<th>No</th>
														<th>Username</th>
														<th>Total & Jumlah</th>
													</tr>
												</thead>
												<tbody>
													<?php
													//FHIKO CYKA EUE 
                                                    date(dmy);	
													$no = 1;
										          	$datak = $db->query("SELECT a.username as users, b.user , SUM(b.price) as total FROM users a INNER JOIN orders b ON a.username = b.user where user = a.username and b.status ='Success' GROUP BY b.user ORDER BY total DESC LIMIT 5");
											   	    while($use = mysqli_fetch_array($datak)){
											   	         $query = $db->query("SELECT SUM(price) AS hadiah from orders where (date BETWEEN  date(now()) and date_add(date(NOW()), INTERVAL +7 DAY)) and status = 'Success' and user = '$use[users]' ");
												         while($dat = mysqli_fetch_array($query)){
											   	         $hadiah = $dat['hadiah'] / 1000 * 25 ; 
											   	    ?>
											   	    
													<tr>
													    
														<th scope="row"><?php echo $no; ?></th>
														<td><?php echo $use['users']; ?></td>
														<td>Rp <?php echo number_format($use['total'],0,",",".");?></td>
													</tr>
													<?php $no++; } }?>
												</tbody>
											</table>
										</div>
									</div>
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

                        			<h4 class="header-title mt-20 m-b-50">TOP PEMBELIHAN PULSA</h4>

                                    <div class="table-responsive">
                                        <table class="table mb-20">
													<thead>
							
													<tr>
														<th>No</th>
														<th>Username</th>
														<th>Total & Jumlah</th>
													</tr>
												</thead>
												<tbody>
													<?php
													//FHIKO CYKA EUE 
                                                    date(dmy);	
													$no = 1;
										          	$datak = $db->query("SELECT a.username as users, b.user , SUM(b.price) as total FROM users a INNER JOIN orders_pulsa b ON a.username = b.user where user = a.username and b.status ='Success' GROUP BY b.user ORDER BY total DESC LIMIT 5");
											   	    while($use = mysqli_fetch_array($datak)){
											   	         $query = $db->query("SELECT SUM(price) AS hadiah from orders_pulsa where (date BETWEEN  date(now()) and date_add(date(NOW()), INTERVAL +7 DAY)) and status = 'Success' and user = '$use[users]' ");
												         while($dat = mysqli_fetch_array($query)){
											   	         $hadiah = $dat['hadiah'] / 1000 * 25 ; 
											   	    ?>
											   	    
													<tr>
													    
														<th scope="row"><?php echo $no; ?></th>
														<td><?php echo $use['users']; ?></td>
														<td>Rp <?php echo number_format($use['total'],0,",",".");?></td>
													</tr>
													<?php $no++; } }?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- end row -->
<?php
include("lib/footer.php");
?>