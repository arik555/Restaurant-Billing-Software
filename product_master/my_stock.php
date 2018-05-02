 <?php require '../servers/product_server.php';
if (!isset($_SESSION['logged_user'])) {
	header("location: ../index.php");
}
$fk_company = $_SESSION['user_id'];

$x = 0;

if (isset($_POST['stock_sub'])) {
	$dt = date('Y-m-d');
	$invt_id = $_POST['item_id'];
	$quantity = $_POST['quan_select'];
	$where_about = $_POST['where_about'];

	$arik = mysqli_query($db, "INSERT INTO stock_report (fk_inv_id, items_received_by, current_quan, dated, fk_company) VALUES ('$invt_id', '$where_about','$quantity','$dt', '$fk_company')") or die(mysqli_error($db));
	if ($arik) {
		echo "<script>alert(\"Record inserted Successfully.\");window.location.assign(\"my_stock.php\");</script>";
		header("Refresh: 0");
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<?php require '../style/cdn.php'; ?>
	<title>Welcome to Products Portal</title>
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
	      <li class="dropdown active">
	        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Product Stock Status
	        <span class="caret"></span></a>
	        <ul class="dropdown-menu">
	          <li class="active"><a href="my_stock.php">Products In Hand</a></li>
	          <li><a href="about_to_finish.php">Out of Stock</a></li>
	        </ul>
	      </li>
	      <li class="dropdown">
	        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Inventory
	        <span class="caret"></span></a>
	        <ul class="dropdown-menu">
	          <li><a href="inventory_fg.php">For Finished Goods</a></li>
	          <li><a href="inventory_rm.php">For Raw Materials</a></li>
	        </ul>
	      </li>
	      <li><a href="issueKit.php">Issue to Kitchen</a></li>
	    </ul>
    </div>
  </div>
</nav>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-10 col-sm-offset-1">
			<fieldset>
				<legend align="center">CURRENT STOCK STATUS</legend>
				<div style='overflow:auto; width:auto;height:400px;'>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>SL No.</th>
							<th>Item</th>
							<th>Brand</th>
							<th>Type</th>
							<th>Net Weight</th>
						</tr>
					</thead>
					<tbody>
						<?php $sql = "SELECT * FROM in_hand where fk_company='$fk_company' AND resultant_quantity > 0";
							$resm = mysqli_query($db, $sql) or die(mysqli_error($db));
							$sl = 0;
							while ($rex = mysqli_fetch_array($resm)) {
								echo "<tr>";
								$sl = $sl+1; ?>
								<td>
								<?php echo $sl; ?>
	          					</td>
							<?php 
								$reck = mysqli_query($db, "SELECT item_short_name, brand, item_type from inventory_card where fk_company='$fk_company' and invt_id='".$rex[1]."'") or die(mysqli_error($db));
								$rome = mysqli_fetch_array($reck);
								echo "<td>".$rome[0]."</td>";
								echo "<td>".$rome[0]."</td>";
								if($rome[2] == 'R') {
							echo "<td>Raw Material</td>"; }
							else {
								echo "<td>Finished Goods</td>";
							}
								echo "<td>".$rex[2]." ".$rex['unit']."</td>";							
								echo "</tr>";
								}
							 ?>
					</tbody>
				</table>
			</div>
			</fieldset>
		</div>
	</div>		
</div>
<?php require '../style/footer.php'; ?>
</body>
</html>