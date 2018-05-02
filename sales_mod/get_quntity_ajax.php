<?php require_once '../connect/config.php';

if(!empty($_POST["inv_id"])) {
	$sql = "SELECT * FROM invoice WHERE invoice_id='".$_POST["inv_id"]."'";
	echo $sql;
	$rec = mysqli_query($db, $sql) or die(mysqli_error($db));
	echo "<option value=''>Select Quantity</option>";
	$record = mysqli_fetch_array($rec);
	for($i=1;$i<=(int)$record[6];$i++) { ?>
		<option value="<?php echo($i); ?>"><?php echo($i); ?></option>
<?php } } ?>