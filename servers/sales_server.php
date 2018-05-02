<?php require '../auth_server.php';
# check for login here.
$fk_company = $_SESSION['user_id'];
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if (isset($_POST['sales_submit'])) {
	$dated = date('Y-m-d');
	$cust_name  = mysqli_real_escape_string($db, $_POST['cust_name']);
	#$cust_addr  = mysqli_real_escape_string($db, $_POST['cust_addr']);
	#$cust_contact  = mysqli_real_escape_string($db, $_POST['cust_contact']);
	$total_amt  = mysqli_real_escape_string($db, $_POST['total_amt']);
	$selected_item_id = $_POST['selected_item_id'];
	$quantity = $_POST['quant'];
	$rate = $_POST['rate'];
	$dis = $_POST['discount']; # simple
	$_tx = $_POST['tx_select']; # simple
	$finally_amount = $_POST['finally_amt'];
	$loop_count  = mysqli_real_escape_string($db, $_POST['cooount']);

	$sql = "INSERT INTO sales_customer (cust_name, total_amount, dated, fk_company, fk_tax_id, discount) VALUES ('$cust_name', '$total_amt', '$dated', '$fk_company', '$_tx', '$dis')";
	$res = mysqli_query($db, $sql) or die(mysqli_error($db));

	if ($res) {
		$cust_idd = mysqli_insert_id($db);
		$sql = "INSERT INTO sales_report (fk_menu_id, quantity, rate, final_rate, fk_customer_id) VALUES ";
		for ($i=0; $i < (int)$loop_count ; $i++) { 
			$sql .= "('$selected_item_id[$i]', '$quantity[$i]', '$rate[$i]', '$finally_amount[$i]', '$cust_idd'),";
		}
		$sql = rtrim($sql,",");
		$result = mysqli_query($db, $sql) or die(mysqli_error($db));
		if ($result) {
			echo "<script>window.location.assign(\"generate_.php?cust_id=$cust_idd\");</script>;";
		}		
	}


}


?>