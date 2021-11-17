<?php
require("../mainconfig.php");

if (isset($_POST['category'])) {
	$post_cat = mysqli_real_escape_string($db, $_POST['category']);
	$check_service = mysqli_query($db, "SELECT * FROM services WHERE category = '$post_cat' AND status = 'Active' ORDER BY sid ASC");
	?>
										<div class="table-responsive">
											<table class="table table-striped table-bordered table-hover m-0">
												<thead>
													<tr>
														<th></th>
														<th>ID</th>
														<th>Layanan</th>
														<th>Harga/1000</th>
														<th>Min</th>
														<th>Max</th>
													</tr>
												</thead>
												<tbody>
												<?php
												$check_service = mysqli_query($db, "SELECT * FROM services WHERE category = '$post_cat' AND status = 'Active'");
												while ($data_service = mysqli_fetch_assoc($check_service)) {
												?>
													<tr>
														<td align="center"><?php if($data_service['status'] == "Active") { ?><i class="fa fa-check"></i><?php } else { ?><i class="fa fa-times"></i><?php } ?></td>
														<th scope="row"><?php echo $data_service['id']; ?></th>
														<td><?php echo $data_service['service']; ?></td>
														<td>Rp <?php echo number_format($data_service['price'],0,',','.'); ?></td>
														<td><?php echo number_format($data_service['min'],0,',','.'); ?></td>
														<td><?php echo number_format($data_service['max'],0,',','.'); ?></td>
													</tr>
												<?php
												}
												?>
												</tbody>
											</table>
										</div>
<?php
}