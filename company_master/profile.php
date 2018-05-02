<?php include '../servers/company_srvr.php'; 
if (!isset($_SESSION['logged_user'])) {
	header("location: ../index.php");
}
$fk_company = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html>
<head>
	<?php require '../style/cdn.php'; ?>
	<title>Welcome Company Details</title>
	<style>
		.navbar-brand {
			font-family: Oswald;
			padding-left: 2em;
			padding-right: 2em;
			font-size: 2.3em;
		}
		#doc {
			font-family: 'Gugi';
		}
		#abt {
			font-family: 'Quicksand';
			font-size: 1.1em;
		}
		body{
			overflow-x: hidden;
		}
		label {
			font-family: 'Ubuntu';
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
	      <li><a href="#">Edit Company Details</a></li>
	      <li class="active"><a href="profile.php">Company Profile</a></li>
	    </ul>
    </div>
  </div>
</nav>
<?php $sql = "SELECT * FROM logo WHERE fk_company ='$fk_company'";
$res = mysqli_query($db, $sql) or die(mysqli_error($db));
$record = mysqli_fetch_array($res);
$logo_fname = $record[1];
$sql = "SELECT * FROM company_details WHERE company_id='$fk_company'";
$res = mysqli_query($db, $sql) or die(mysqli_error($db));
$row = mysqli_fetch_array($res); ?>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-4">
			<img src="../logo_here/<?php echo($logo_fname); ?>" class="img-responsive img-thumbnail" alt="Cinque Terre">
		</div>
		<div class="col-sm-6">
			<h1 align="center" style="font-family: 'Montserrat';"><?php echo $row['company_name']; ?></h1>
		<fieldset>
			<legend style="font-size: 1.3em; font-weight: bold; padding-top: 30px; font-family: 'Montserrat';">Company's Credentials</legend>
			<div class="container">
				<div class="row">
					<div class="col-sm-3">
						<label>Username: </label><span id="doc"><?php echo " ".$row[1]; ?></span><br>
						<!-- <label>Password: </label><span id="doc"><?php echo " ".$row[2]; ?></span><br> -->
						<label>Email ID: </label><span id="doc"><?php echo " ".$row[3]; ?></span><br>
						<label>Company Name: </label><span id="doc"><?php echo " ".$row[4]; ?></span><br>
					</div>
					<div class="col-sm-4">
						<label>Address: </label><span id="doc"><?php echo " ".$row[5].", ".$row[6].", ".$row[7].", ".$row[8]."."; ?></span><br>
						<label>Identity: </label><span id="doc"><?php echo " ".$row[9]." : ".$row[10]; ?></span><br><span id="doc"><?php echo "GST No : ".$row['gst']; ?></span><br>
						<label>Connected with Us: </label><span id="doc"><?php echo " Since ".$row[12]; ?></span>
					</div>
				</div>
			</div>
		</fieldset>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6 col-sm-offset-4">
			<fieldset>
			<legend style="font-size: 1.3em; font-weight: bold; padding-top: 30px; font-family: 'Montserrat';">Company's Bank Info</legend>
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<table class="table tabel-striped">
							<tr>
								<th>Bank Name</th>
								<th>Branch</th>
								<th>Account No.</th>
								<th>IFSC Code</th>
							</tr>
							<?php $result = mysqli_query($db, "SELECT * FROM bank_details WHERE fk_company='$fk_company'");
						while ($remem = mysqli_fetch_array($result)) { ?>
							<tr>
								<td><?php echo $remem['bank_name']; ?></td>
								<td><?php echo $remem['bank_branch']; ?></td>
								<td><?php echo $remem['bank_account']; ?></td>
								<td><?php echo $remem['bank_ifsc']; ?></td>
							</tr>
						<?php } ?>
						</table>
					</div>
				</div>
			</div>
		</fieldset>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12" align="center">
			<h2 style="font-family: 'Montserrat';"><u>About Company</u></h2>
			<p id="abt"><?php echo $row[11]; ?></p>
		</div>
	</div>
</div>
<?php require '../style/footer.php'; ?>
<script type="text/javascript">
	
</script>
</body>
</html>