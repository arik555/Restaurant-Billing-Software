<?php require '../auth_server.php';
# check for login here
$fk_company = $_SESSION['user_id'];

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


if (isset($_POST['purchase_submit'])) {
	$date = date('Y-m-d');
	$vendor_invoice = mysqli_real_escape_string($db, $_POST['v_inv_no']);
	$vendor_name = mysqli_real_escape_string($db, $_POST['v_name']);
	$vendor_pan = mysqli_real_escape_string($db, $_POST['v_pan_no']);
	$vendor_contact = mysqli_real_escape_string($db, $_POST['v_cont']);
	$vendor_address = mysqli_real_escape_string($db, $_POST['v_addr']);
	# $puchase_order_number = mysqli_real_escape_string($db, test_input($_POST['pur_order_no']));
	$_chosen_item = $_POST['selected_item_id'];
	$_weights = $_POST['tot_weight']; # array
	$_per_weight = $_POST['weig'];
	$_quantity = $_POST['quan']; # array
	$_price = $_POST['prise']; # array
	$_discount = $_POST['dis']; # simple
	$_tax = $_POST['tx_select']; # simple
	$_final_sum = $_POST['finally_amount']; # array
	$tot_amt = mysqli_real_escape_string($db, test_input($_POST['total_amount']));
	$count = $_POST['count_val'];

	# inserting data into `purchase` table

	$sql = "INSERT INTO purchase (vendor_invoice, vendor_name, vendor_pan, vendor_contact, vendor_address, date_of_order, total_amount, fk_company, discount, fk_tax_id) VALUES ('$vendor_invoice','$vendor_name','$vendor_pan','$vendor_contact','$vendor_address','$date', '$tot_amt', '$fk_company', '$_discount', '$_tax')";

	$res = mysqli_query($db, $sql) or die(mysqli_error($db));

	if ($res) {
		$purchase_detail_last_id = mysqli_insert_id($db);
		$sql = "INSERT INTO invoice (fk_invt_id, quantity, weight_per_qty, price, final_amount, fk_purchase_id, fk_company, net_weight, wt_unit) VALUES ";
		#$sql2 = "INSERT INTO in_hand (fk_inv_id, resultant_quantity, fk_company) VALUES ";
		for ($i=0; $i < (int)$count ; $i++) {
				# inserting data into `invoice` table
			$x = $_weights[$i];
			$y = explode(' ', $x);
			$save_weight = $y[0];
			$weight_unit = $y[1];
			$sql .= "('$_chosen_item[$i]','$_quantity[$i]','$_per_weight[$i]','$_price[$i]', '$_final_sum[$i]','$purchase_detail_last_id', '$fk_company', '$save_weight', '$weight_unit'),";
			
			#$sql2 .= "('$_chosen_item[$i]', '$_quantity[$i]', '$fk_company'),";
			$tttt = "SELECT * FROM `in_hand` WHERE fk_inv_id='$_chosen_item[$i]' and fk_company='$fk_company'";
			$row = mysqli_query($db, $tttt);
			if (mysqli_num_rows($row) == 1) {
				$recording = mysqli_fetch_array($row);
				$now_weight = $recording[2] + $_quantity[$i];
				mysqli_query($db, "UPDATE in_hand SET resultant_quantity='$now_weight' WHERE fk_inv_id='".$_chosen_item[$i]."'")or die(mysqli_error($db));
			}else if (mysqli_num_rows($row) == 0) {
				mysqli_query($db, "INSERT INTO in_hand (fk_inv_id, resultant_quantity, fk_company, unit) 
		    VALUES ('$_chosen_item[$i]','$save_weight','$fk_company', '$weight_unit')")or die(mysqli_error($db));
			}
			
		}
		$sql = rtrim($sql,",");
		//echo $sql;
		mysqli_query($db, $sql) or die(mysqli_error($db));
		
		echo "<script>alert('Inserted successfully.'); window.location.assign('purchase_list.php');</script>";
		//header('location: purchase_list.php');
	}

}


?>