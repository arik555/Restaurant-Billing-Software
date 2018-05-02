<?php require 'tax_main.php'; 

if (isset($_GET['del'])) {
	mysqli_query($db, "DELETE FROM tax_master WHERE tax_id='".$_GET['del']."'");
	echo "<script>alert('TAX RECORD DELETED.'); window.location.assign('tax_main.php');</script>";
}



?>