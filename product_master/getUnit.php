<?php require_once '../connect/config.php';


if(isset($_POST["i_id"])) {
	$x = $_POST["i_id"];
	$resm = mysqli_query($db, "SELECT resultant_quantity, unit from in_hand WHERE in_hand_id='$x'") or die(mysqli_error($db));
	$record = mysqli_fetch_array($resm);
	echo $record[0]." ".$record[1];
}

 ?>