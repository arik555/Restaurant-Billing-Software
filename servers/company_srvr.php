<?php require '../auth_server.php';
# check for login here.
$fk_company = $_SESSION['user_id'];

if (isset($_POST['company_submit'])) {

	$loop_count = $_POST['loop_count'];
	$date = date('Y-m-d');
	$username = mysqli_real_escape_string($db, $_POST['uname']);
	$password = mysqli_real_escape_string($db, $_POST['pass']);
	$company_name = mysqli_real_escape_string($db, $_POST['co_name']);
	$email_ID = mysqli_real_escape_string($db, $_POST['user-email']);
	$locality = mysqli_real_escape_string($db, $_POST['street']);
	$city = mysqli_real_escape_string($db, $_POST['town']);
	$pincode = mysqli_real_escape_string($db, $_POST['pin_code']);
	$state = mysqli_real_escape_string($db, $_POST['state']);
	$card_type = mysqli_real_escape_string($db, $_POST['card']);
	$card_no = mysqli_real_escape_string($db, $_POST['card_num']);
	$bank_name = $_POST['bnk_nm'];
	$bank_branch = $_POST['bnk_brch'];
	$bank_account = $_POST['bnk_acc'];
	$bank_ifsc = $_POST['bnk_ifsc'];
	$about_company = mysqli_real_escape_string($db, $_POST['about']);
	$gst_no = mysqli_real_escape_string($db, $_POST['ggst_num']);
	# $x = mysqli_real_escape_string($db, $_POST['']);


	################################
		//FILE_UPLODE MECHANISM
	$target_dir = "../logo_here/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
	#################################
	$fhandle = $_FILES["fileToUpload"]["name"];
	
	$sql = "INSERT INTO `company_details` (`username`, `password`, `email_ID`, `company_name`, `street`, `city`, `pincode`, `state`, `card_type`, `card_number`, `about`, `dated`, `gst`) VALUES ('$username','$password','$email_ID','$company_name','$locality','$city','$pincode','$state','$card_type','$card_no','$about_company','$date', '$gst_no')";
	$res = mysqli_query($db, $sql) or die(mysqli_error($db));

	if ($res) {
		$com_last_id = mysqli_insert_id($db);
		$sql = "";
		$sql = "INSERT INTO `bank_details` (`bank_name`, `bank_branch`, `bank_account`, `bank_ifsc`, `fk_company`) VALUES";
		for ($i=0; $i < $loop_count; $i++) { 
			$sql .= "('$bank_name[$i]','$bank_branch[$i]','$bank_account[$i]','$bank_ifsc[$i]', '$com_last_id'),";
		}
		$sql = rtrim($sql, ",");
		mysqli_query($db, $sql) or die(mysqli_error($db));

		$sql = "INSERT INTO logo (logo_file_name, fk_company) VALUES ('$fhandle', '$com_last_id')";
		mysqli_query($db, $sql) or die(mysqli_error($db));

		echo "<script>alert('Inserted Successfully');</script>";
		header('add_company.php');
	}

}




?>