<?php require '../servers/sales_server.php';

if (!isset($_SESSION['logged_user'])) {
	header("location: ../index.php");
}
$fk_company = $_SESSION['user_id'];

/*

$arik = mysqli_query($db, "SELECT * FROM menu_card WHERE fk_company='$fk_company'") or die(mysqli_error($db));
if (mysqli_num_rows($arik) > 0) {
	echo "<script>alert(\"You have already uploaded the Excel Sheet earlier.\");</script>";
} else {
	echo "<script>alert(\"No record Found yet.\");</script>";
}
*/

require '../sheetHandler/Classes/PHPExcel/IOFactory.php';

if (isset($_POST['upld_sub'])) {
	if (isset($_POST['col_names'])) {
		$column_names = $_POST['col_names']; # array
		$column_type = $_POST['col_type'];
		$sql_query = "CREATE TABLE `menu_mod` (";
		for ($i=0; $i < count($column_names); $i++) { 
			$sql_query .= $column_names[$i].' '.$column_type[$i].',';
		}
		$sql_query .= ')';
		echo $sql_query;
	}
	

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
	$sql = "INSERT INTO menu_card (menu_id, level_1, level_2, level_3, level_4, level_5, price, fk_company) VALUES ";
	for ($i=2; $i <= $max_row ; $i++) {  
		$rowData = $sheet->rangeToArray('A' . $i . ':' . $max_col . $i);
			//print_r($rowData);
		$sql .= "('NULL','".$rowData[0][1]."', '".$rowData[0][2]."', '".$rowData[0][3]."', '".$rowData[0][4]."', '".$rowData[0][5]."', '".$rowData[0][6]."', '$fk_company'),";
	}
	$sql = rtrim($sql, ",");
	//echo $sql;
	$res = mysqli_query($db, $sql) or die("Something Went Wrong. The file was not uploaded. Please contact admin.");
	if ($res) {
		echo "<script>alert(\"Upload Success!\"); window.location.assign(\"menu_mod.php\")</script>";
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<?php require '../style/cdn.php'; ?>
	<title>ADD ITEMS FOR SALE</title>
	<style>
		#show {
			padding-top: 5px;
		}

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
	      <li><a href="sales.php">Sales</a></li>
	      <!-- <li class="dropdown">
	        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Misc
	        <span class="caret"></span></a>
	        <ul class="dropdown-menu">
	          <li><a href="#">Add Brand to DataBase</a></li>
	          <li><a href="#"></a></li>
	          <li><a href="#">Page 1-3</a></li>
	        </ul>
	      </li> 
	      <li><a href="#">Add Product</a></li>
	      <li><a href="#">Add Product Brand / Category</a></li> -->
	      <li><a href="sales_invoice_master.php">Show Invoice List</a></li>
	      <li class="active"><a href="menu_mod.php">Sales Inventory</a></li>
	    </ul>
    </div>
  </div>
</nav>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-5 col-sm-offset-3">
			<fieldset>
				<legend>UPLOAD SECTION FOR <span style="color: blue;">SALES ITEMS</span></legend>
				<p>Strictly in the following format:</p>
				<img src="../logo_here/menu_item_figure.png" class="img-responsive img-thumbnail">
				<form method="POST" enctype="multipart/form-data">
					<div class="form-inline">
						<input type="file" name="fileMenu" id="fileMenu" required class="form-control" accept=".xlsx, .xls">
					</div>
					<div class="form-group">
						<p><input type="submit" name="upld_sub" class="btn btn-primary">
						<a href="../sampleSheet/menu.xlsx" style="padding-left: 10px;">Click Here</a> to download sample file.</p>
					</div>
				</form>
			</fieldset>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<fieldset>
				<legend align="center">YOUR SELLING ITEM RECORDS</legend>
				<div style='overflow:auto; width:auto;height:400px;'>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Sl No.</th>
							<th>Level-1</th>
							<th>Level-2</th>
							<th>Level-3</th>
							<th>Level-4</th>
							<th>Brand</th>
							<th>Price</th>
						</tr>
					</thead>
					<tbody>
						<?php $arik = mysqli_query($db, "SELECT * FROM menu_card WHERE fk_company='$fk_company'");
						$sl = 0;
						while ($sarkar = mysqli_fetch_array($arik)) { $sl = $sl+1;
						 	echo "<tr>";
						 	echo "<td>".$sl."</td>";
						 	echo "<td>".$sarkar[1]."</td>";
						 	echo "<td>".$sarkar[2]."</td>";
						 	echo "<td>".$sarkar[3]."</td>";
						 	echo "<td>".$sarkar[4]."</td>";
						 	echo "<td>".$sarkar[5]."</td>";
						 	echo "<td>".$sarkar[6]."</td>";
						 	echo "</tr>";
						 } ?>
					</tbody>
				</table>
				</div>
			</fieldset>
		</div>
	</div>
</div>
<?php require '../style/footer.php'; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<script>
$.validate({
	lang: 'en',
  modules : 'file'
});
</script>
</body>
</html>