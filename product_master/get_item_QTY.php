<?php require_once '../connect/config.php';


if(!empty($_POST["invty_id"])) {
	$temp = 0;
	$sql = "SELECT * FROM in_hand WHERE in_hand_id='".$_POST["invty_id"]."'";
			$resm = mysqli_query($db, $sql) or die(mysqli_error($db));
			$sl = 0;
			$record = mysqli_fetch_array($resm);
			$temp = $record[2];
?>
	<option value="">Select Quantity</option>
<?php
	for ($i=1; $i <= $temp; $i++) {
?>
	<option value="<?php echo($i); ?>"><?php echo($i); ?></option>
<?php 
	}
}

if(!empty($_POST["inven_tory_id"])) {
	$x = 0;
	$resm = mysqli_query($db, "SELECT DISTINCT(fk_invt_id) FROM invoice where fk_invt_id='".$_POST['inven_tory_id']."'") or die(mysqli_error($db));
	while ($rex = mysqli_fetch_array($resm)) {
	$rock = mysqli_query($db, "SELECT SUM(net_weight) FROM invoice Where fk_invt_id='".$rex[0]."'") or die(mysqli_error($db));
		while ($each = mysqli_fetch_array($rock)) {
			$x = (int)$each[0]; //30
		}
	}
	echo $x;
}

if(!empty($_POST["i_id"])) {
	$x = '';
	$resm = mysqli_query($db, "SELECT DISTINCT(fk_invt_id) FROM invoice where fk_invt_id='".$_POST['i_id']."'") or die(mysqli_error($db));
	while ($rex = mysqli_fetch_array($resm)) {
	$rock = mysqli_query($db, "SELECT SUM(net_weight), wt_unit FROM invoice Where fk_invt_id='".$rex[0]."'") or die(mysqli_error($db));
		while ($each = mysqli_fetch_array($rock)) {
			$x = $each[1]; //30
		}
	}
	echo $x;
}



if(!empty($_POST["inven_id"])) {
	$arik = mysqli_query($db, "SELECT * From inventory_card WHERE invt_id=(SELECT fk_inv_id from in_hand where in_hand_id='".$_POST["inven_id"]."')") or die(mysqli_error($db));;
	$sarkar = mysqli_fetch_array($arik); 
	echo $sarkar['item_short_name']." - ".$sarkar['brand'];
}

 ?>