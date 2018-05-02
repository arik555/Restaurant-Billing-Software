 <?php require '../servers/sales_server.php'; 

if (!isset($_SESSION['logged_user'])) {
	header("location: ../index.php");
}
$fk_company = $_SESSION['user_id'];

?>

<!DOCTYPE html>
<html>
<head>
	<?php require '../style/cdn.php'; ?>
	<title>Sales Invoices</title>
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
	      <li class="active"><a href="sales_invoice_master.php">Show Invoice List</a></li>
	      <li><a href="menu_mod.php">Sales Inventory</a></li>
	    </ul>
    </div>
  </div>
</nav>
	<h1>Sales Invoices</h1>
	<hr>
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-sm-offset-2">
				<div class="form-inline">
					<div class="form-group">
				<select id="typicalSearchFilter1" class="form-control">
					<option value="">Search By</option>
					<option value="1">Date</option>
					<option value="2">InvoiceNo</option>
					<option value="3">Amount</option>
				</select>
				</div>
				<div class="form-group">
				<input type="text" id="myInput1" onkeyup="myFunction1()" placeholder="Search" class="form-control">
				</div>	
				</div> <br>
					<table class="table table-striped" id="myTable1">
						<thead>
							<tr>
								<th>SL No.</th>
								<th>Date</th>
								<th>Invoice No.</th>
								<th>Total Amount</th>
							</tr>
						</thead>
						<tbody>
							<?php $result = mysqli_query($db, "SELECT * FROM sales_customer where fk_company='$fk_company' ORDER BY sales_cust_id desc") or die(mysqli_error($db));
							$i = 0;
							while($rok = mysqli_fetch_array($result)) { ?>
								<tr>
									<td><?php echo $i = $i+1; ?></td>
									<td><a href="generate_.php?cust_id=<?php echo($rok[0]); ?>"><?php echo $rok['dated']; ?></a></td>
									<td><a href="generate_.php?cust_id=<?php echo($rok[0]); ?>"><?php echo $fk_company.sprintf("%'.09d", $rok[0]); ?></a></td>
									<td><a href="generate_.php?cust_id=<?php echo($rok[0]); ?>"><?php echo $rok['total_amount']; ?></a></td>
								</tr>
							<?php }	?>
						</tbody>
					</table>
				
			</div>
		</div>
	</div>
	<?php require '../style/footer.php'; ?>
<script src="https://code.jquery.com/jquery-3.3.1.js"
	integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
	crossorigin="anonymous"></script>
	<script type="text/javascript">
		function myFunction1() {
		  var input, filter, table, tr, td, i, tab;
		  tab = document.getElementById('typicalSearchFilter1').value;
		  input = document.getElementById("myInput1");
		  filter = input.value.toUpperCase();
		  table = document.getElementById("myTable1");
		  tr = table.getElementsByTagName("tr");
		  for (i = 0; i < tr.length; i++) {
		    td = tr[i].getElementsByTagName("td")[tab];
		    if (td) {
		      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
		        tr[i].style.display = "";
		      } else {
		        tr[i].style.display = "none";
		      }
		    }       
		  }
		}
	</script>
</body>
</html>