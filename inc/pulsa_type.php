<?php
require("../mainconfig.php");

if (isset($_POST['type'])) {
	$post_cat = mysqli_real_escape_string($db, $_POST['type']);
	$check_service = mysqli_query($db, "SELECT * FROM service_dog WHERE type = '$post_cat' ORDER BY name ASC");
	?>
	<option value="0">Select one...</option>
	<?php
	while ($data_service = mysqli_fetch_assoc($check_service)) {
	?>
	<option value="<?php echo $data_service['code'];?>"><?php echo $data_service['name'];?></option>
	<?php
	}
} else {
?>
<option value="0">Error.</option>
<?php
}