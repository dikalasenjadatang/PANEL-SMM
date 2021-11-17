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
										<h3 class="panel-title"><i class="fa fa-random"></i> Dokumentasi API</h3>
									</div>
									<div class="panel-body">
										<table class="table table-bordered">
											<tbody>
												<tr>
													<td>HTTP Method</td>
													<td>POST</td>
												</tr>
												<tr>
													<td>API URL</td>
													<td><?php echo $cfg_baseurl; ?>api_pulsa.php</td>
												</tr>
												<tr>
													<td>Response format</td>
													<td>JSON</td>
												</tr>
												<tr>
													<td>Example PHP Code</td>
													<td><a href="<?php echo $cfg_baseurl; ?>api_example_pulsa.php" target="blank">Example</a></td>
												</tr>
											</tbody>
										</table>
									</div>
									<div class="panel-footer">
										<h3 class="panel-title">Method <font color="red">add</font> (Place order)</h3>
									</div>
									<div class="panel-body">
										<table class="table table-bordered">
											<thead>
												<tr>
													<th>Parameters</th>
													<th>Description</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>key</td>
													<td>Your API key</td>
												</tr>
												<tr>
													<td>action</td>
													<td>add</td>
												</tr>
												<tr>
													<td>service</td>
													<td>Service ID <a href="<?php echo $cfg_baseurl; ?>price_list_pulsa.php">Check at price list</a></td>
												</tr>
												<tr>
													<td>phone</td>
													<td>Your Phone Number</td>
												</tr>
											</tbody>
										</table>
<b>Example Response</b><br />
<pre>
IF ORDER SUCCESS

{
  "order_id":"12345"
}

IF ORDER FAIL

{
  "error":"Incorrect request"
}
</pre>
									</div>
									<div class="panel-footer">
										<h3 class="panel-title">Method <font color="red">status</font> (Check order status)</h3>
									</div>
									<div class="panel-body">
										<table class="table table-bordered">
											<thead>
												<tr>
													<th>Parameters</th>
													<th>Description</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>key</td>
													<td>Your API key</td>
												</tr>
												<tr>
													<td>action</td>
													<td>status</td>
												</tr>
												<tr>
													<td>order_id</td>
													<td>Your order id</td>
												</tr>
											</tbody>
										</table>
<b>Example Response</b><br />
<pre>
IF CHECK STATUS SUCCESS

{
  "charge":"10000",
  "status":"Success",
  "sn":"12345678910"
}

IF CHECK STATUS FAIL

{
  "error":"Incorrect request"
}
</pre>
									</div>
									<div class="panel-footer text-right">
										<span>API System by CodeW</span>
									</div>
								</div>
							</div>
						</div>
						<!-- end row -->
<?php
include("lib/footer.php");
?>