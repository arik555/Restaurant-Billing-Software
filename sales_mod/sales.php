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
	<title id="tit">Sales Portal</title>
	<style type="text/css">
		.navbar-brand {
			font-family: Oswald;
			padding-left: 2em;
			padding-right: 2em;
			font-size: 2.3em;
		}
	</style>
	<link rel="stylesheet" type="text/css" href="http://unicorn-ui.com/buttons/css/buttons.css">
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
	      <li class="active"><a href="sales.php">Sales</a></li>
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
	      <li><a href="menu_mod.php">Sales Inventory</a></li>
	    </ul>
    </div>
  </div>
</nav>
<style type="text/css">
	.form-control[readonly] {
		background-color: #fff !important;
	}
	#addHere .form-control {
		width: auto;
	}
</style>
<div class="container-fluid">
	<form method="POST" onsubmit="hellobrother()" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<div class="row">
		<div class="col-sm-12">
			<div class="panel-group">
				<div class="panel panel-info">
					<div class="panel-heading">
						<h4>Customer Information <small class="text-muted" style="float: right;"><?php echo date('Y-m-d'); ?></small></h4>
					</div>
					<div class="panel-body">
						<div class="container-fluid">
							<div class="row">
								<div class="col-sm-4">
									<input type="hidden" name="cooount" id="omg">
									<div class="form-group">
										<label>Customer Name / Table No.</label>
										<input type="text" name="cust_name" class="form-control" required data-validation="length" data-validation-length="min1" 
											data-validation-error-msg="Invalid Customer Name or Table No." onkeyup="aniket(this.value)">
									</div>
								</div>
								<!-- <div class="col-sm-4">
									<div class="form-group">
										<label>Customer Address</label>
										<input type="text" name="cust_addr" class="form-control" required>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group">
										<label>Customer Contact</label>
										<input type="text" name="cust_contact" class="form-control" required>
									</div>
								</div> -->
							</div>
						</div>
					</div>
				</div>
				<div class="panel panel-info">
					<div class="panel-heading">
						<h4>Items Information</h4>
					</div>
					<div class="panel-body table-responsive">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>Products / Items</th>
									<th>Plate / Piece</th>
									<th>Rate</th>
									<th>Amount</th>
								</tr>
							</thead>
							<tbody id="addHere">
								<tr>
									<td>
										<div class="form-group">
											<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal1">Select Product</button>
											<br>
											<input type="hidden" name="selected_item_id[]" id="main_id1">
											<br>
											<div id="show_prod_div1" style="display: none;">
												<label>You've Selected: </label>
												<input type="text" id="prod_info1" class="form-control" name="the_id" readonly="readonly">
											</div>
										</div>
									</td>
									<td>
										<div class="form-group"> 
											<input type="text" class="form-control" required id="quan_select1" name="quant[]" data-validation="number" data-validation-length="min1" 
											data-validation-error-msg="Invalid Quantity" onkeyup="afraid(this.id)">
										</div>
									</td>
									<td>
										<div class="form-group">
											<input type="text" name="rate[]" class="form-control readonly" id="price1" required>
										</div>
									</td>
									<td>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-btn">
										          <button class="btn btn-primary" type="button" onclick="calc(getCount());">
										            <i class="fas fa-calculator"></i>
										          </button>
										        </div>
										        <input type="text" name="finally_amt[]" class="form-control readonly" id="fsum1" required>
											</div>
											<button type="button" class="btn btn-danger" style="float: right;padding-top: 10px;" onclick="callmebro2(this)"><i class="fas fa-minus"></i></button>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
						<div class="form-group">
							<button class="btn btn-success" type="button" onclick="add_more();"><i class="fas fa-plus"></i></button>
						</div>
						<div class="col-sm-6 col-md-6 col-lg-6 col-sm-offset-3">
							 <div class="form-group"><label>Tax</label><select name="tx_select" required class="form-control" onchange="formalajax(this.value)"><option value="">Select Tax Type</option><?php $omar = mysqli_query($db, "SELECT * FROM tax_master where fk_company='$fk_company'"); while ($show = mysqli_fetch_array($omar)) { if ($show[3] == '') { echo "<option value=".$show[0].">".$show[1]." @ ".$show[2]."</option>";
							 } else { echo "<option value=".$show[0].">".$show[1]." @ ".$show[2]." & ".$show[3]." @ ".$show[4]."</option>"; } }?><option value="0">None</option></select>
							 	<input type="hidden" name="tax_amt" id="tx_amt">
							 </div>
							 <div class="form-group">
							 	<label>Discount</label>
									<input type="text" name="discount" class="form-control" id="disc" value="0.00" required data-validation="number" data-validation-length="min1" data-validation-allowing="range[0.0;100.0],float" data-validation-decimal-separator="." data-validation-error-msg="Invalid Discount">
							</div>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-btn">
							          <button class="btn btn-primary" type="button" onclick="mytotal()">
							            <i class="fas fa-calculator"></i>
							          </button>
							        </div>
									<input type="text" name="total_amt" class="form-control readonly" placeholder="Total" id="tot" required>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div> <!--PANEL GRP ENDS HERE -->
			<button type="submit" class="btn btn-success btn-block" name="sales_submit" style="font-size: 25px; font-weight: bold; color: #006400;">OK</button>
		</div>
	</div>
	</form>
</div>
<script type="text/javascript">
	function afraid(argument) {
		//alert(argument);
		var lastChar = argument.substr(argument.length -1);
		var q = document.getElementById('quan_select'+lastChar+'').value;
		var p = document.getElementById('price'+lastChar+'').value;
		document.getElementById('fsum'+lastChar+'').value = p*q;
	}
function aniket(singh) {
	if (singh == '') {
		$("#tit").html("Sales");
	} else {
		$("#tit").html(singh);
	}
}

	function hellobrother() {
			var rowCount = $('#addHere tr').length;
			document.getElementById('omg').value = rowCount;
		}
</script>
<style>
	.black {
		display: none;
	}
	@media screen and (max-width: 480px) {
		#myTable1 {
			width: auto;
		}
	}
</style>
<section id="modal_is_here">
<div class="modal fade container-fluid" id="myModal1" role="dialog" data-backdrop="static" style="padding: 0;">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <!--<button type="button" class="close" data-dismiss="modal" onclick="cross();">&times;</button> -->
          <h4 class="modal-title">Select Your Product Below</h4>
        </div>
        <div class="modal-body table-responsive" id="original_placement">
        	<!-- <div class="form-inline" style="padding-bottom: 5px;" align="center">
				<div class="form-group">
					<select id="typicalSearchFilter1" class="form-control">
						<option value="1">SL No.</option>
						<option value="5">ItemName</option>
						<option value="6">Price</option>
					</select>
				</div>
				<div class="form-group">
					<input type="text" id="myInput1" onkeyup="myFunction1(getCount())" placeholder="Search" class="form-control">
				</div>	
			</div> -->
			<table class="table table-bordered" id="myTable1">
				<thead>
					<tr>
						<th>SL No.</th>
						<th>Label-1</th>
						<th>Label-2</th>
						<th>Label-3</th>
						<th>Label-4</th>
						<th>Item Name</th>
						<th>Price</th>
					</tr>
				</thead>
				<tbody id="filter_here">
					<?php $res = mysqli_query($db, "SELECT * FROM menu_card WHERE fk_company='$fk_company'") or die(mysqli_error($db));
					$sl = 0;
					while($record = mysqli_fetch_array($res)) { ?>
						<tr>
							<td>
								<label class="radio-inline">
							      <input type="radio" name="optradio1" value="<?php echo($record[0]); ?>"><?php echo $sl = $sl + 1; ?>
							    </label>
          					</td>
							<td><?php echo $record[1]; ?></td>
							<td><?php echo $record[2]; ?></td>
							<td><?php echo $record[3]; ?></td>
							<td><?php echo $record[4]; ?></td>
							<td><?php echo $record[5]; ?></td>
							<td><?php echo $record[6]; ?></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal" onclick="check_values();">OK</button>
        </div>
      </div>
    </div>
</div>
</section>
<?php require '../style/footer.php';
 ?>
<script type="text/javascript">
	$(document).ready(function(){ 
		$('#myTable1').DataTable();
		$('#myModal1').on('shown.bs.modal', function() {
		  $('input[type="search"]').focus();
		});
		$(".readonly").on('keydown paste', function(e){
		        e.preventDefault();
		    });
	});
	var count = 0;

	$.validate({
		lang: 'en',
	  modules : 'security'
	});

	function check_values() {
		var rowCount = $('#addHere tr').length;
		var X = $("input[type='radio'][name='optradio"+rowCount+"']:checked").val();
		//alert("Inside Get Menu Id "+X);
		var mydiv = document.getElementById('show_prod_div'+rowCount);
		if (X) {
			mydiv.style.display = 'block';
			//alert("Inside get put");
			document.getElementById('prod_info'+rowCount).value = X;
			document.getElementById('main_id'+rowCount).value = X;
			getItemPrice(X);
			getItemName(X);
			$('input[id=quan_select'+rowCount+']').focus();
		}
	}

	function add_more() {
		var rowCount = $('#addHere tr').length;
		for(var i=)
		//alert(rowCount);
		/*var prev_data = document.getElementById('fsum'+rowCount).value;
		if ( prev_data == "") {
			alert("Calculate the amount for item "+rowCount+"");
			return false;
		}*/
		count = rowCount + 1;
		var html = '';
		html += '<tr> <td> <div class="form-group"> <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal'+count+'">Select Product</button> <br> <input type="hidden" name="selected_item_id[]" id="main_id'+count+'"> <br> <div id="show_prod_div'+count+'" style="display: none;"> <label>You\'ve Selected: </label> <input type="text" id="prod_info'+count+'" class="form-control" name="the_id" readonly="readonly"> </div> </div> </td> <td> <div class="form-group"> <input type="text" class="form-control" required id="quan_select'+count+'" name="quant[]" data-validation="number" data-validation-length="min1" data-validation-error-msg="Numeric values only" onkeyup="afraid(this.id)"> </div> </td> <td> <div class="form-group"> <input type="text" name="rate[]" class="form-control" id="price'+count+'" required readonly> </div> </td> <td><div class="form-group"> <div class="input-group"> <div class="input-group-btn"> <button class="btn btn-primary" type="button" onclick="calc(getCount());"> <i class="fas fa-calculator"></i> </button> </div> <input type="text" name="finally_amt[]" class="form-control" id="fsum'+count+'" readonly="readonly" required> </div> <button type="button" class="btn btn-danger" style="float: right;padding-top: 10px;" onclick="callmebro2(this)"><i class="fas fa-minus"></i></button> </div> </td> </tr>';
		$('#addHere').append(html);
		html = '';
		html += '<section id="modal_is_here"> <div class="modal fade" id="myModal'+count+'" role="dialog" data-backdrop="static" style="padding: 0;"> <div class="modal-dialog modal-lg"> <!-- Modal content--> <div class="modal-content"> <div class="modal-header"> <h4 class="modal-title">Select Your Product Below</h4> </div> <div class="modal-body" id="original_placement"><!-- <div class="form-inline" style="padding-bottom: 5px;" align="center"> <div class="form-group"> <select id="typicalSearchFilter'+count+'" class="form-control"> <option value="5">ItemName</option> <option value="6">Price</option> </select> </div> <div class="form-group"> <input type="text" id="myInput'+count+'" onkeyup="myFunction1(getCount())" placeholder="Search" class="form-control"> </div> </div> --> <table class="table table-bordered" id="myTable'+count+'"> <thead> <tr> <th>SL No.</th> <th>Label-1</th> <th>Label-2</th> <th>Label-3</th> <th>Label-4</th> <th>Item Name</th> <th>Price</th> </tr> </thead> <tbody id="filter_here"> <?php $res = mysqli_query($db, "SELECT * FROM menu_card WHERE fk_company='$fk_company'") or die(mysqli_error($db)); $sl = 0; while($record = mysqli_fetch_array($res)) { ?> <tr> <td> <label class="radio-inline"> <input type="radio" name="optradio'+count+'" value="<?php echo($record[0]); ?>"><?php echo $sl = $sl + 1; ?> </label> </td> <td><?php echo $record[1]; ?></td> <td><?php echo $record[2]; ?></td> <td><?php echo $record[3]; ?></td> <td><?php echo $record[4]; ?></td> <td><?php echo $record[5]; ?></td> <td><?php echo $record[6]; ?></td> </tr> <?php } ?> </tbody> </table> </div> <div class="modal-footer"> <button type="button" class="btn btn-success" data-dismiss="modal" onclick="check_values();">OK</button> </div> </div> </div> </div> </section>';
		$('#modal_is_here').append(html);
		manualtrigger(getCount());
	}

	function manualtrigger(val) {
		$.validate({
			lang: 'en',
		  modules : 'security'
		});

		$('#myTable'+val+'').DataTable();
		$('#myModal'+val+'').modal('show');
		//jQuery("button[data-target = myModal"+val+"]")[0].click();
		$('#myModal'+val+'').on('shown.bs.modal', function() {
		  $('input[type="search"]').focus();
		});
		$(".readonly").on('keydown paste', function(e){
		        e.preventDefault();
		    });
	}

	function callmebro2(arik) {
		if (getCount() > 1) {
			arik.closest('tr').remove();
		}
		document.getElementById('tot').value = '';
	}

	function calc(arik) { // edit left
		var x = 0.00;
		var y = 0.00;
		var z = 0.00;
		var q = 0.00;
		q = $('#quan_select'+arik).val();
		//alert(q);
		x = $('#price'+arik).val();
		//alert(x);
		document.getElementById('fsum'+arik).value = x*q;
		if (document.getElementById('fsum'+arik).value == 'NaN' || document.getElementById('fsum'+arik).value == '0') {
			document.getElementById('fsum'+arik).value = '';
		}
	}

	function getCount() {
		var rowCount = $('#addHere tr').length;
		return rowCount;
	}
/*
	function getState(val) {
		var c = getCount();
		$.ajax({
			type: "POST",
			url: "get_quntity_ajax.php",
			data:'inv_id='+val,
			success: function(data){
				$("#quan_select"+c).html(data);
			}
		});
	}
*/

	function formalajax(val) {
		var c = getCount();
		//alert("Inside Get Item Name");
		$.ajax({
			type: "POST",
			url: "get_item_name.php",
			data:'tx_id='+val,
			success: function(data){
				//alert(data);
				$("#tx_amt").val(data);
			}
		});
	}

	function getItemName(val) {
		var c = getCount();
		//alert("Inside Get Item Name");
		$.ajax({
			type: "POST",
			url: "get_item_name.php",
			data:'menu_id='+val,
			success: function(data){
				$("#prod_info"+c).val(data);
			}
		});
	}

	function getItemPrice(val) {
		var c = getCount();
		//alert("Inside Get Item value");
		$.ajax({
			type: "POST",
			url: "get_item_name.php",
			data:'m_id='+val,
			success: function(data){
				$("#price"+c).val(data);
			}
		});
	}

	function mytotal() {
		var s = 0.00;
		var values = $("input[name='finally_amt[]']").map(function(){return $(this).val();}).get();
		for (var i = values.length - 1; i >= 0; i--) {
			s += parseFloat(values[i]);
		}
		t = $('#disc').val();
		y = $('#tx_amt').val();
		s = s - ((t / 100) * s);
		s = s + ((y / 100) * s);
		document.getElementById('tot').value = s;
		var text = document.getElementById('tot').value;
		if (text == 'NaN' || text == '0') {
			document.getElementById('tot').value = '';
		}
	}

	function myFunction1(arik) {
	  var input, filter, table, tr, td, i, tab;
	  tab = document.getElementById('typicalSearchFilter'+arik).value;
	  input = document.getElementById("myInput"+arik);
	  filter = input.value.toUpperCase();
	  table = document.getElementById("myTable"+arik);
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