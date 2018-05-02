<?php require_once '../connect/config.php';

if(!empty($_POST["menu_id"])) {
	$sql = "SELECT * FROM menu_card WHERE menu_id='".$_POST["menu_id"]."'";
	$rec = mysqli_query($db, $sql) or die(mysqli_error($db));
	$record = mysqli_fetch_array($rec);
	echo $record['level_5'];	
 } 

if(!empty($_POST["m_id"])) {
	$sql = "SELECT * FROM menu_card WHERE menu_id='".$_POST["m_id"]."'";
	$rec = mysqli_query($db, $sql) or die(mysqli_error($db));
	$record = mysqli_fetch_array($rec);
	echo $record['price'];	
 }

if(!empty($_POST["tx_id"])) {
	$sql = "SELECT * FROM tax_master WHERE tax_id='".$_POST["tx_id"]."'";
	$rec = mysqli_query($db, $sql) or die(mysqli_error($db));
	$record = mysqli_fetch_array($rec);
	echo (float)$record['tax_amount'] + (float)$record['tax_amount2'];	
 }


 ?>