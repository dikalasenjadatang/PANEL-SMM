<?php
require("../mainconfig.php");

if (isset($_POST['category'])) {
	$post_cat = mysqli_real_escape_string($db, $_POST['pulsa']);
	$check_service = mysqli_query($db, "SELECT * FROM services_pulsa WHERE operator = '$post_cat' AND status = 'Active' ORDER BY sid ASC");
	?>
										<div class="table-responsive">
											<table class="table table-striped table-bordered table-hover m-0">
												<thead>
													<tr>
														<th></th>
														<th>ID</th>
														<th>Layanan</th>
														<th>Harga</th>
													</tr>
												</thead>
												<tbody>
												<?php
												$check_service = mysqli_query($db, "SELECT * FROM services_pulsa WHERE operator = '$post_cat' AND status = 'Active'");
												while ($data_service = mysqli_fetch_assoc($check_service)) {
												?>
													<tr>
														<td align="center"><?php if($data_service['status'] == "Active") { ?><i class="fa fa-check"></i><?php } else { ?><i class="fa fa-times"></i><?php } ?></td>
														<th scope="row"><?php echo $data_service['id']; ?></th>
														<td><?php echo $data_service['layanan']; ?></td>
														<td>Rp <?php echo number_format($data_service['price'],0,',','.'); ?></td>
													</tr>
												<?php
												}
												?>
												</tbody>
											</table>
										</div>
<?php
}