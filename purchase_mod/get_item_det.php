<?php require_once '../connect/config.php';

if(!empty($_POST["invt_id"])) {
	$sql = "SELECT * FROM inventory_card WHERE invt_id='".$_POST["invt_id"]."'";
	$rec = mysqli_query($db, $sql) or die(mysqli_error($db));
	$record = mysqli_fetch_array($rec);
	echo $record[1]." - ".$record[2];	
 } 

if(!empty($_POST["tx_id"])) {
	$sql = "SELECT * FROM tax_master WHERE tax_id='".$_POST["tx_id"]."'";
	$rec = mysqli_query($db, $sql) or die(mysqli_error($db));
	$record = mysqli_fetch_array($rec);
	echo (float)$record['tax_amount'] + (float)$record['tax_amount2'];	
 }

 ?>