<?php require '../servers/product_server.php';
if (!isset($_SESSION['logged_user'])) {
	header("location: ../index.php");
}
$fk_company = $_SESSION['user_id'];

if (isset($_GET['fg_id'])) {
	$sql = "DELETE FROM inventory_card WHERE fk_company='$fk_company' AND item_type='".$_GET['fg_id']."'";
	$res = mysqli_query($db, $sql) or die("Something Went Wrong");
	if ($res) {
		//mysqli_query($db, "DELETE * FROM purchase where fk_company='$fk_company'") or die("Something Went Wrong");
		echo "<script>alert('All Finished_Goods records are being deleted.'); window.location.assign('inventory_fg.php');</script>";
	}

}
if (isset($_GET['rm_id'])) {
	$sql = "DELETE FROM inventory_card WHERE fk_company='$fk_company' AND item_type='".$_GET['rm_id']."'";
	$res = mysqli_query($db, $sql) or die("Something Went Wrong");
	if ($res) {
		//mysqli_query($db, "DELETE * FROM purchase where fk_company='$fk_company'") or die("Something Went Wrong");
		echo "<script>alert('All Raw_materials records are being deleted.'); window.location.assign('inventory_rm.php');</script>";
	}
}

 ?>