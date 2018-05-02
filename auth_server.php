<?php require 'connect/config.php'; 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_POST['login_submit'])) {
	$user = $_POST['login_user'];
	$pass = $_POST['login_pass'];

	$sql = "SELECT * FROM company_details WHERE username='$user' and password='$pass'";
	$res = mysqli_query($db, $sql) or die(mysqli_error($db));
	$record = mysqli_fetch_array($res);
	if (mysqli_num_rows($res) == 1) {
		$_SESSION['logged_user'] = $user;
		$_SESSION['user_id'] = $record[0];
		//echo $_SESSION['logged_user'];
		header('location: index.php');
	}
}

?>