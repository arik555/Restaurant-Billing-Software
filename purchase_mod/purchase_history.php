<?php require '../servers/purchase_server.php';
if (!isset($_SESSION['logged_user'])) {
	header("location: ../index.php");
}
$fk_company = $_SESSION['user_id'];
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
	      <li><a href="purchase_list.php">Purchase</a></li>
	      <!-- <li class="dropdown">
	        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Misc
	        <span class="caret"></span></a>
	        <ul class="dropdown-menu">
	          <li><a href="#">Add Brand to DataBase</a></li>
	          <li><a href="#"></a></li>
	          <li><a href="#">Page 1-3</a></li>
	        </ul>
	      </li> -->
	      <li class="active"><a href="purchase_history.php">Purchase History</a></li>
	    </ul>
    </div>
  </div>
</nav>
<style type="text/css">
    .black {
      display: none;
    }
</style>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
        <!--	<div class="form-inline" align="center" style="padding-bottom: 5px;">
				<div class="form-group">
					<select id="typicalSearchFilter1" class="form-control">
						<option value="">Search By</option>
						<option value="1">Brand</option>
						<option value="2">Category</option>
						<option value="3">ItemName</option>
						<option value="3">Color</option>
						<option value="3">Size</option>
						<option value="3"></option>
						<option value="3"></option>
					</select>
				</div>
				<div class="form-group">
					<input type="text" id="myInput1" onkeyup="myFunction1()" placeholder="Search" class="form-control">
				</div>	
			</div> -->
        <div class="panel-group">
          <?php $sql="SELECT * from purchase where fk_company='$fk_company' ORDER BY pur_id desc";
          $arik = mysqli_query($db, $sql) or die(mysqli_error($db));
          while ($sarkar = mysqli_fetch_array($arik)) { $pur = $sarkar[0]; ?>
          <div class="panel panel-warning">
            <div class="panel-heading">
              <h4> <u style="font-size: 1.2em;">Vendor Details</u>
                <small style="float: right; font-size: 0.9em;"><?php echo $sarkar['date_of_order']; ?></small><br><br>
              <span id="topic">Invoice No. <span id="sub_topic"><?php echo $sarkar['vendor_invoice']; ?></span><br>
            <span id="topic">Name:</span> <span id="sub_topic"><?php echo $sarkar['vendor_name']; ?></span><br>
          <span id="topic">PAN No.</span> <span id="sub_topic"><?php echo $sarkar['vendor_pan']; ?></span><br>
        <span id="topic">Address:</span> <span id="sub_topic"><?php echo $sarkar['vendor_contact']; ?></span><br>
      <span id="topic">Contact:</span> <span id="sub_topic"><?php echo $sarkar['vendor_address']; ?></span><br></h4>
            </div>
            <div class="panel-body">
              <p style="font-size: 1.3em; font-weight: bold;"><u>Purchase Details</u></p>
          <table class="table table-bordered" id="myTable1">
            <thead>
              <tr>
                <th>SL No.</th>
                <th>Item</th>
                <th>Brand</th>
                <th style="color: blue;">Quantity</th>
                <th>Weight per Qty.</th>
                <th>Net Weight</th>
                <th>Price</th>
                <th>Amount</th>
              </tr>
            </thead>
            <tbody id="oyehoy">
              <?php $sql="SELECT * FROM invoice where fk_purchase_id='$pur'";
              $res = mysqli_query($db, $sql) or die(mysqli_error($db));
              $sl = 0;
              if (mysqli_num_rows($res) > 0) {
              while ($row = mysqli_fetch_array($res)) { ?>
                <tr>
                  <td align="center"><?php echo $sl = $sl + 1; ?></td>
                  <td align="center">
                    <?php $query = "SELECT * FROM inventory_card where invt_id='".$row[1]."'";
                    $rec = mysqli_query($db, $query) or die(mysqli_error($db));
                    $record = mysqli_fetch_array($rec);
                    echo $record[1]; ?>
                  </td>
                  <td align="center">
                    <?php echo $record['brand']; ?>
                  </td>
                  <td align="center"><?php echo $row['quantity']; ?></td>
                  <td align="center"><?php echo $row['weight_per_qty']; ?></td>
                  <td align="center"><?php echo $row['net_weight']." ".$row['wt_unit']; ?></td>
                  <td align="center"><?php echo round($row['final_amount'], 2); ?></td>
                  <td><?php echo round($row['final_amount'], 2); ?></td>
                </tr>
              <?php } }?>
            </tbody>
            </table>
            <hr>
             <div style="position: relative; font-size: 1em;" align="right">Discount: <?php echo $sarkar['discount']; ?>%<br> Tax: <?php $omar = mysqli_query($db, "SELECT * FROM tax_master where tax_id='".$sarkar['fk_tax_id']."'") or die(mysqli_error($db)); $rope = mysqli_fetch_array($omar);
                  echo $rope['tax_type']." @ ".$rope['tax_amount']." %"."<br>".$rope['tax_type2']." @ ".$rope['tax_amount2']." %"; ?><br></div>
            <div style="position: relative; font-size: 1.3em;" align="right">Sub Total: <?php echo $sarkar['total_amount']; ?>*<br>(inclusive of all taxes)</div>
            </div>
          </div>
          <?php } ?>
        </div>
          	
      </div>
	</div>
</div>
<?php require '../style/footer.php'; ?>
<script type="text/javascript">
  
  var x = $('#oyehoy').html();
  if (x == '') {
    $('.panel').remove();
  }
 


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