<?php include '../servers/company_srvr.php'; 
if (!isset($_SESSION['logged_user'])) {
	header("location: ../index.php");
}
$fk_company = $_SESSION['user_id'];

if (isset($_POST['btn-sub'])) {
	$tax_type = $_POST['tax_type'];
	if ($tax_type == 'CGST SGST') {
		$exp = explode(' ', $tax_type);
		//print_r($exp);
	}
	$tx_amt = $_POST['tx_amt'];
	$loopcount = count($tx_amt);
	if ($loopcount == 1) {
		$sql = "INSERT INTO tax_master (tax_type, tax_amount, fk_company) VALUES ('$tax_type','$tx_amt[0]','$fk_company')";
		$res = mysqli_query($db, $sql) or die(mysqli_query($db));
		//echo $sql;
		if ($res) {
			echo "<script>alert(\"Saved Successfully.\");</script>";
		}
	} else {
		$sql = "INSERT INTO tax_master (tax_type, tax_amount, tax_type2, tax_amount2, fk_company) VALUES ('$exp[0]','$tx_amt[0]','$tax_type[1]','$exp[1]','$fk_company')";
		$res = mysqli_query($db, $sql) or die(mysqli_query($db));
		//echo $sql;
		if ($res) {
			echo "<script>alert(\"Saved Successfully.\");</script>";
		}
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<?php require '../style/cdn.php'; ?>
	<title>Tax Master</title>
	<style type="text/css">
		.navbar-brand {
			font-family: Oswald;
			padding-left: 2em;
			padding-right: 2em;
			font-size: 2.3em;
		}
		.col-sm-12 {
			font-size: 1.2em;
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
	      <li class="active"><a href="tax_main.php">Tax Master</a></li>
	      <!-- <li class="dropdown">
	        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Misc
	        <span class="caret"></span></a>
	        <ul class="dropdown-menu">
	          <li><a href="#">Add Brand to DataBase</a></li>
	          <li><a href="#"></a></li>
	          <li><a href="#">Page 1-3</a></li>
	        </ul>
	      </li> -->
	    </ul>
    </div>
  </div>
</nav>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-6">
			<form method="POST">
			<fieldset>
				<legend>ADD TAX DETAILS</legend>
				<div class="form-group">
					<label>Tax Type</label>
					<select name="tax_type" class="form-control" id="tax_type_sel" onchange="formal(this.value)" required>
						<option value="">Select Tax Type</option>
						<option value="CGST SGST">CSGT &amp; SGST</option>
						<option value="IGST">IGST</option>
					</select>
				</div>
				<div class="form-group">
					<label>Tax Amount (in percent) <span id="tax_lbl"></span>  </label>
					<div  id="tx_sec">
						<input type="text" name="" class="form-control">
					</div>
				</div>
				<button type="submit" name="btn-sub" class="btn btn-success">Save</button>
			</fieldset>
			</form>
		</div>
	</div>
	<div class="row" style="padding-top: 20px;">
			<div class="col-sm-12">
				<fieldset>
			<legend align="center">YOUR TAXATION RECORDS</legend>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Sl no.</th>
							<th>Tax Type - 1</th>
							<th>Tax Amount - 1</th>
							<th>Tax Type - 2</th>
							<th>Tax Amount - 2</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php $omar = mysqli_query($db, "SELECT * FROM tax_master WHERE fk_company='$fk_company'") or die(mysqli_error($db));
						$sl = 0;
						while($record = mysqli_fetch_array($omar)) { $sl = $sl+1;?>
						<tr>
							<td><?php echo $sl; ?></td>
							<td><?php echo $record[1]; ?></td>
							<td><?php echo $record[2]; ?></td>
							<td><?php echo $record[3]; ?></td>
							<td><?php echo $record[4]; ?></td>
							<td><a href="delete.php?del=<?php echo($record[0]); ?>" style="color: red;"><span class="glyphicon glyphicon-trash"></span></a></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
				</fieldset>
			</div>
	</div>
</div>
<?php require '../style/footer.php'; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
	function formal(argument) {

		if (argument == 'CGST SGST') {
			$('#tx_sec input').remove();
			var data = '<div class="form-group" id="tx_sec"> <input type="text" name="tx_amt[]" class="form-control" required placeholder="CGST %"> </div> <input type="text" name="tx_amt[]" class="form-control" required placeholder="SGST %">';
			$('#tax_lbl').html('CGST & SGST');
			$('#tx_sec').append(data);
		} else if (argument == 'IGST') {
			$('#tx_sec input').remove();
			var data = '<input type="text" name="tx_amt[]" class="form-control" required placeholder="IGST %">'
			$('#tax_lbl').html(argument);
			$('#tx_sec').append(data);
		} else {
			$('#tx_sec input').remove();
			var data = '<input type="text" class="form-control" required>';
			$('#tax_lbl').html('');
			$('#tx_sec').append(data);
		}
	}
</script>
</body>
</html>