<?php require '../servers/product_server.php';
if (!isset($_SESSION['logged_user'])) {
	header("location: ../index.php");
}
$fk_company = $_SESSION['user_id'];
$tot_q = 0;
$tot_amt = 0;
if (isset($_POST['intvl_rpt'])) {
	
	if (isset($_SESSION['value'])) {
		unset($_SESSION['value']);
		$s = $_POST['report_interval'];
		if ($s == '1') {
			$_SESSION['value'] = '1 DAY';
		}
		if ($s == '2') {
			$_SESSION['value'] = '7 DAY';
		}
		if ($s == '3') {
			$_SESSION['value'] = '1 MONTH';
		}
		if ($s == '4') {
			$_SESSION['value'] = '4 MONTH';
		}
		if ($s == '5') {
			$_SESSION['value'] = '12 MONTH';
		}
	} else {
		$s = $_POST['report_interval'];
		if ($s == '1') {
			$_SESSION['value'] = '1 DAY';
		}
		if ($s == '2') {
			$_SESSION['value'] = '7 DAY';
		}
		if ($s == '3') {
			$_SESSION['value'] = '1 MONTH';
		}
		if ($s == '4') {
			$_SESSION['value'] = '4 MONTH';
		}
		if ($s == '5') {
			$_SESSION['value'] = '12 MONTH';
		}
	}
	header("location: display_reports.php");

}
?>
<!DOCTYPE html>
<html>
<head><?php require '../style/cdn.php'; ?>
	<title>Welcome to Reports Portal</title>
	<style type="text/css">
		.navbar-brand {
			font-family: Oswald;
			padding-left: 2em;
			padding-right: 2em;
			font-size: 2.3em;
		}
	</style>
</head>
<body>
	<?php require '../style/header_style.php'; ?>	
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
       <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="../index.php">FooDrive</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
	    <ul class="nav navbar-nav">
	      <li class="active"><a href="display_reports.php">Sales Report</a></li>
	      <!-- <li class="dropdown active">
	        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Inventory
	        <span class="caret"></span></a>
	        <ul class="dropdown-menu">
	          <li><a href="inventory_fg.php">For Finished Goods</a></li>
	          <li class="active"><a href="inventory_rm.php">For Raw Materials</a></li>
	        </ul>
	      </li>
	      <li><a href="issueKit.php">Issue to Kitchen</a></li> -->
	    </ul>
    </div>
  </div>
</nav>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<form method="POST">
				<div class="form-group">
					<select name="report_interval" class="form-control" required>
						<option value="">Select Report Interval</option>
						<option value="1">Today</option>
						<option value="2">Weekly</option>
						<option value="3">Monthly</option>
						<option value="4">Quaterly</option>
						<option value="5">Yearly</option>
					</select>
				</div>
				<div class="form-group">
					<input type="submit" name="intvl_rpt" value="Show" class="btn btn-primary">
				</div>
			</form>
		</div>
	</div>
	<?php 
/* DATE QUERIES
SELECT * FROM jokes WHERE date > DATE_SUB(NOW(), INTERVAL 1 DAY) ORDER BY score DESC;        
SELECT * FROM jokes WHERE date > DATE_SUB(NOW(), INTERVAL 1 WEEK) ORDER BY score DESC;
SELECT * FROM jokes WHERE date > DATE_SUB(NOW(), INTERVAL 1 MONTH) ORDER BY score DESC;
*/	

	 ?>
	<div class="row" style="padding-top: 20px;">
		<div class="col-sm-12">
			<fieldset>
				<legend id="leg_rp" align="center">
					<?php if (isset($_SESSION['value'])) {
						$x = $_SESSION['value'];
						if ($x == '1 DAY') {
							echo "YOUR DAILY REPORTS";
						}
						if ($x == '7 DAY') {
							echo "YOUR WEEKLY REPORTS";
						}
						if ($x == '1 MONTH') {
							echo "YOUR MONTHLY REPORTS";
						}
						if ($x == '4 MONTH') {
							echo "YOUR QUATERLY REPORTS";
						}
						if ($x == '12 MONTH') {
							echo "YOUR YEARLY REPORTS";
						}
					} ?>

				</legend>
				<div style='overflow:auto; width:auto;height:400px;'>
				<table class="table table-bordered">
					<tr>
						<th>SL No.</th>
						<th>Date</th>
						<th>Sold Item</th>
						<th>Quantity</th>
						<th>Rate (per qty)</th>
						<th>Amount</th>
					</tr>
				<?php if (isset($_SESSION['value'])) {
					
					$sess = $_SESSION['value'];
				$sql = "SELECT * FROM sales_customer where fk_company='$fk_company' and dated > DATE_SUB(NOW(), INTERVAL $sess) ORDER BY sales_cust_id DESC";
				//echo $sql;
				$tot_q = 0;
				$tot_amt = 0;
				$sl = 0;
				$rec = mysqli_query($db, $sql) or die(mysqli_error($db));
				while ($boom = mysqli_fetch_array($rec)) { 
					$res = mysqli_query($db, "SELECT SUM(quantity), fk_menu_id, fk_customer_id, SUM(final_rate), rate FROM sales_report GROUP BY fk_menu_id"); while ( $row = mysqli_fetch_array($res)) { if ($row['fk_customer_id'] == $boom[0]) { ?>
				 	<tr>
						<td><?php $sl = $sl+1; echo $sl; ?></td>
						<td><?php echo $boom['dated'];  ?></td>
						<td><?php $rok = mysqli_query($db, "SELECT * FROM menu_card WHERE menu_id='".$row['fk_menu_id']."'"); $rock = mysqli_fetch_array($rok);
							echo $rock['level_5']; ?>
						</td>
						<td><?php echo $row[0]; $tot_q = $tot_q + $row[0]; ?></td>
						<td><?php echo $row[4]; ?></td>
						<td><?php echo $row[3]; $tot_amt = $tot_amt + $row[3]; ?></td>
					</tr>
				<?php } } } } else {
					echo "<tr>No record found.</tr>";
				} ?>
				
				<tr><?php if ($tot_amt != 0 && $tot_q != 0) {
					echo "<th colspan=\"6\" class=\"text-right h4\">Total Quantity: ".$tot_q." & Total Profit: Rs.".$tot_amt."</th>";
				} ?></tr>
				</table>
			</div>
			</fieldset>
		</div>
	</div>
</div>
<?php require '../style/footer.php'; ?>
<?php 
/*
$y = 2;
$x = "SELECT SUM(quantity), fk_menu_id, fk_customer_id FROM sales_report GROUP BY fk_menu_id";
echo $x;
$res = mysqli_query($db, $x) or die(mysqli_error($db));
while ($each = mysqli_fetch_array($res)) {
	if (condition) {
		# code...
	}
	print_r($each);
	echo "<br>";
} */
 ?>
</body>
</html>