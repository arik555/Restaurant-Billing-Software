<?php require '../servers/product_server.php';
if (!isset($_SESSION['logged_user'])) {
	header("location: ../index.php");
}
$fk_company = $_SESSION['user_id'];
$hello = mysqli_query($db, "SELECT * FROM company_details WHERE company_id='$fk_company'");
$world = mysqli_fetch_array($hello);

/*
$omg = array();

$arik = mysqli_query($db, "SELECT DISTINCT(fk_inv_id) FROM stock_report where fk_company='$fk_company'") or die(mysqli_error($db));
while ($sar = mysqli_fetch_array($arik)) {
	//print_r($sar);
	//echo "<script>alert('Loop');</script>";
	//echo $sar[0];
	$hello = mysqli_query($db, "SELECT SUM(current_quan) FROM stock_report where fk_inv_id = '".$sar[0]."'") or die(mysqli_error($db));
		while ($hex = mysqli_fetch_array($hello)) {
			array_push($omg, array($sar[0], $hex[0]));
		}

}
print_r($omg);
*/
require '../sheetHandler/Classes/PHPExcel/IOFactory.php';

if (isset($_POST['upld_sub2'])) {
	$inputfilename = $_FILES["fileMenu"]["tmp_name"];
	$exceldata = array();
	
	try {
		PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
		$inputfiletype = PHPExcel_IOFactory::identify($inputfilename);
		$objReader = PHPExcel_IOFactory::createReader($inputfiletype);
		$objPHPExcel = $objReader->load($inputfilename);
	} catch (Exception $e) {
		die('Something Went Wrong');
	}

	$sheet = $objPHPExcel->getSheet(0);
	$max_row = $sheet->getHighestRow();
	$max_col = $sheet->getHighestDataColumn();

//echo $max_row."<br>".$max_col; # 313 and G
	$sql = "INSERT INTO inventory_card (invt_id, item_short_name, item_full_name, item_description, brand, item_type, fk_company) VALUES ";
	for ($i=2; $i <= $max_row ; $i++) {  
		$rowData = $sheet->rangeToArray('A' . $i . ':' . $max_col . $i);
			//print_r($rowData);
		$sql .= "('NULL','".$rowData[0][0]."', '".$rowData[0][1]."', '".$rowData[0][2]."', '".$rowData[0][3]."', 'FG', '$fk_company'),";
	}
	$sql = rtrim($sql, ",");
	//echo $sql;
	$res = mysqli_query($db, $sql) or die("Something Went Wrong. The file was not uploaded. Please contact admin.");
	if ($res) {
		echo "<script>alert(\"Upload Success!\"); window.location.assign(\"inventory_fg.php\")</script>";
	}
}

?>
<!DOCTYPE html>
<html>
<head><?php require '../style/cdn.php'; ?>
	<title>Welcome to Inventory Portal</title>
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
	      <li class="dropdown">
	        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Product Stock Status
	        <span class="caret"></span></a>
	        <ul class="dropdown-menu">
	          <li><a href="my_stock.php">Products In Hand</a></li>
	          <li><a href="about_to_finish.php">Out of Stock</a></li>
	        </ul>
	      </li>
	      <li class="dropdown active">
	        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Inventory
	        <span class="caret"></span></a>
	        <ul class="dropdown-menu">
	          <li class="active"><a href="inventory_fg.php">For Finished Goods</a></li>
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
		<div class="col-sm-5 col-sm-offset-3"> 
			<fieldset>
				<legend>UPLOAD YOUR <spam style="color: blue;">FINISHED GOODS</spam> EXCEL FILE</legend>
				<p>Strictly in the following format:</p>
				<img src="../logo_here/inventory.png" class="img-responsive img-thumbnail">
				<form method="POST" enctype="multipart/form-data">
					<div class="form-inline">
						<input type="file" name="fileMenu" id="fileMenu" required class="form-control" accept=".xlsx, .xls" >
					</div>
					<div class="form-group">
						<p><input type="submit" name="upld_sub2" style="padding-left: 10px;" class="btn btn-primary"><a href="../sampleSheet/SAMPLE_SHEET.xlsx" style="padding-left: 10px;">Click Here</a> to download sample file.</p>
					</div>
					<div class="form-group">
						<button type="button" class="btn btn-danger" onclick="ALERTME();">Delete all My Finished Goods</button>
					</div>
				</form>
			</fieldset>
		</div>
	</div>
	<div class="row" style="padding-top: 15px;">
		<div class="col-sm-12">
			<fieldset>
				<legend>YOUR FINISHED GOODS INV. RECORDS</legend>
				<div style='overflow:auto; width:auto;height:400px;'>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Sl No.</th>
							<th>Item Short Name</th>
							<th>Item Full Name</th>
							<th>Item Description</th>
							<th>Brand</th>
						</tr>
					</thead>
					<tbody>
						<?php $arik = mysqli_query($db, "SELECT * FROM inventory_card WHERE fk_company='$fk_company' and item_type='FG'");
						$sl = 0;
						while ($sarkar = mysqli_fetch_array($arik)) { $sl = $sl+1;
						 	echo "<tr>";
						 	echo "<td>".$sl."</td>";
						 	echo "<td>".$sarkar[1]."</td>";
						 	echo "<td>".$sarkar[2]."</td>";
						 	echo "<td>".$sarkar[3]."</td>";
						 	echo "<td>".$sarkar[4]."</td>";
						 	echo "</tr>";
						 } ?>
					</tbody>
				</table></div>
			</fieldset>
			
		</div>
	</div>
</div>
<?php require '../style/footer.php'; ?>
<script>
$.validate({
	lang: 'en',
  modules : 'file'
});

function ALERTME() {
	var person = prompt("Enter your password");
	if (!person || person != '<?php echo($world[2]); ?>') {
		window.location.assign("#");
	} else {
		window.location.assign("del_record.php?fg_id=FG");
	}
}
</script>
</body>
</html>
