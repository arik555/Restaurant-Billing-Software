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
		@media screen and (max-width: 480px) {
			#myTable1 {
				width: auto;
			}
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
	      <li class="active"><a href="purchase_list.php">Purchase</a></li>
	      <!-- <li class="dropdown">
	        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Misc
	        <span class="caret"></span></a>
	        <ul class="dropdown-menu">
	          <li><a href="#">Add Brand to DataBase</a></li>
	          <li><a href="#"></a></li>
	          <li><a href="#">Page 1-3</a></li>
	        </ul>
	      </li> -->
	      <li><a href="purchase_history.php">Purchase History</a></li>
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
		<div class="row">
			<div class="col-sm-12">
				<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" onsubmit="hellobrother()">
				<div class="panel-group">
					<div class="panel panel-success">
						<div class="panel-heading">
							<h4>Vendor Details<small class="text-muted" style="float: right;"><?php echo date('Y-m-d'); ?></small></h4>
						</div>
						<div class="panel-body">
							<div class="container-fluid">
								<div class="row">
									<div class="col-sm-4">
										<div class="form-group">
											<label>Vendor Invoice No.</label>
											<input type="text" name="v_inv_no" class="form-control" required data-validation="length" data-validation-length="min1" data-validation-error-msg="Required Field">
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label>Vendor's Name</label>
											<input type="text" name="v_name" class="form-control" required data-validation="length" data-validation-length="min3" data-validation-error-msg="Minimum 3 characters">
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label>Vendor's GST No.</label>
											<input type="text" name="v_pan_no" class="form-control">
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label>Vendor's Contact</label>
											<input type="text" name="v_cont" class="form-control" required data-validation="number" data-validation-length="10" 
											data-validation-error-msg="Invalid Mobile No.">
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label>Vendor's Address</label>
											<input type="text" name="v_addr" class="form-control" required data-validation="length" data-validation-length="min3" data-validation-error-msg="Minimum 3 characters">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="panel panel-success">
						<div class="panel-heading">
							<h4>Invoice Details</h4>
						</div>
						<div class="panel-body">
							<div class="container-fluid" style="padding: 0;">
								<div class="row">
									<div class="col-sm-12">
										<div class="table-responsive">
											<table class="table table-bordered">
												<thead>
													<tr>
														<th width="20%">Particulars</th>
														<th>Weight</th>
														<th>Unit Price</th>
														<th>Amount</th>
													</tr>
												</thead>
												<input type="hidden" name="count_val" id="omg" required="False">
												<tbody id="addHere">
													<tr>
														<td>
															<div class="form-group">
																<button type="button" class="btn btn-default btn-lg" data-toggle="modal" data-target="#myModal1">Select Product</button>
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
																<div class="input-group">
																<input type="text" name="weig[]" class="form-control" id="wazan_1" placeholder="Net Weight per pack. (with units)" onkeyup="rady();" style="width: 100%" data-validation="number" data-validation-length="min1" data-validation-allowing="float" data-validation-decimal-separator="."
											data-validation-error-msg="Numeric values only">
																<span class="input-group-addon" style="padding: 1px;">
																	<select name="units[]" id="un_1" style="padding-top: 4px;padding-bottom: 4px;" onchange="rady();">
																		<option value="KG">KG</option>
																		<option value="G">G</option> 
																		<option value="L">L</option>
																		<option value="mL">mL</option>
																	</select>
																</span> 
																</div>
																<label style="padding-top: 5px;">Quantity</label>
																<input type="text" name="quan[]" class="form-control" id="quantity_1" required placeholder="No. of Packets" onkeyup="rady();" data-validation="number" data-validation-length="min1" 
											data-validation-error-msg="Numeric values only">
																<br>
																<input type="text" name="tot_weight[]" readonly="readonly" placeholder="Overall Weight" class="form-control" id="fwaz_1">
															</div>
														</td>
														<td>
															<div class="form-group">
																<input type="text" name="prise[]" class="form-control" id="price_1" required data-validation="number" data-validation-length="min1" data-validation-allowing="float" data-validation-decimal-separator="." data-validation-error-msg="Invalid Price">
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
										        <input type="text" name="finally_amount[]" class="form-control readonly" id="final_amt_1" required>
											</div>
											<button type="button" class="btn btn-danger disabled" style="float: right;padding-top: 10px;"><i class="fas fa-minus"></i></button>
										</div>
															
														</td>
													</tr>
												</tbody>
											</table>
										<div class="form-group">
											<button type="button" onclick="callmebro()" class="btn btn-success"><i class="fas fa-plus"></i></button>
										</div>
									<div class="col-sm-6 col-md-6 col-lg-6 col-sm-offset-3">
											<div class="form-group">
												<label>Tax</label>
											<select id="tx_" name="tx_select" required class="form-control" onchange="formalajax(this.value)">
												<option value="">Select Tax Type</option>
												<option value="0">None</option>
<?php $omar = mysqli_query($db, "SELECT * FROM tax_master where fk_company='$fk_company'");
while ($show = mysqli_fetch_array($omar)) { if ($show[3] == '') { echo "<option value=".$show[0].">".$show[1]." @ ".$show[2]."</option>";
							 } else { echo "<option value=".$show[0].">".$show[1]." @ ".$show[2]." & ".$show[3]." @ ".$show[4]."</option>"; } }?>
											</select>
											<input type="hidden" name="tax_amt" id="tx_amt">
										</div>
										<div class="form-group">
											<label>Discount</label>
												<input type="text" name="dis" class="form-control" id="disc_" value="0.00" required data-validation="number" data-validation-length="min1" data-validation-allowing="range[0.0;100.0],float" data-validation-decimal-separator="."
											 data-validation-error-msg="Invalid Discount">
										</div>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-btn">
										          <button class="btn btn-primary" type="button" onclick="mytotal()">
										            <i class="fas fa-calculator"></i>
										          </button>
										        </div>
												<input type="text" name="total_amount" class="form-control readonly" placeholder="Total" id="tot" required>
											</div>
										</div>
									</div>
										
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div> <!-- PANEL GRP ENDS HERE-->
				<button type="submit" class="btn btn-success btn-block" name="purchase_submit" style="font-size: 25px; font-weight: bold; color: #006400;">Save</button>
				</form>
			</div>
		</div>		
	</div>
<style type="text/css">
	.black {
		display: none;
	}
</style>
<section id="modal_is_here">
<div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <!--<button type="button" class="close" data-dismiss="modal" onclick="cross();">&times;</button> -->
          <h4 class="modal-title">Select Your Product Below</h4>
        </div>
        <div class="modal-body" id="original_placement">
        	<!--<div class="form-inline" style="padding-bottom: 5px;" align="center">
				<div class="form-group">
					<select id="typicalSearchFilter1" class="form-control">
						<option value="1">Item</option>
						<option value="2">Brand</option>
					</select>
				</div>
				<div class="form-group">
					<input type="text" id="myInput1" onkeyup="myFunction1(getCount());" placeholder="Search" class="form-control">
				</div>	
			</div>-->
			<table class="table table-bordered" id="myTable1">
				<thead>
					<tr>
						<th>SL No.</th>
						<th>Item Name</th>
						<th>Brand</th>
						<th>Type</th>
					</tr>
				</thead>
				<tbody id="filter_here">
					<?php $res = mysqli_query($db, "SELECT * FROM inventory_card WHERE fk_company='$fk_company'") or die(mysqli_error($db));
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
							<td><?php if ($record["item_type"] == 'R') {
								echo "Raw Materials";
							} else {
								echo "Finished Goods"; } ?></td>
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
<?php require '../style/footer.php'; ?>
</section>
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

		$.validate({
		    lang: 'en',
		    module: 'security'
		 });

		function check_values() {
			var rowCount = getCount();
			var X = $("input[type='radio'][name='optradio"+rowCount+"']:checked").val();
			//alert("Inside Get Menu Id "+X+rowCount);
			var mydiv = document.getElementById('show_prod_div'+rowCount);
			if (X) {
				mydiv.style.display = 'block';
				//alert("Inside get put");
				document.getElementById('prod_info'+rowCount).value = X;
				document.getElementById('main_id'+rowCount).value = X;
				getItemDetail(X);
			}
		}


		function rady() {
		 	var c = getCount();
		 	//alert(c);
				var weight = $('#wazan_'+c).val();
				var qqq = $('#quantity_'+c).val();
				if (weight == 0 || weight == "") {
					weight = 1;
					var x = document.getElementById('quantity_'+c).value;
					document.getElementById('fwaz_'+c).value = x*weight;
					document.getElementById('fwaz_'+c).value += " "+document.getElementById('un_'+c).value;
				}
				else if (qqq == 0 || qqq == "") {
					qqq = 1;
					var x = document.getElementById('wazan_'+c).value;
					document.getElementById('fwaz_'+c).value = x*qqq;
					document.getElementById('fwaz_'+c).value += " "+document.getElementById('un_'+c).value;
				}
				else {
					var x = document.getElementById('quantity_'+c).value;
					var y = document.getElementById('wazan_'+c).value;
					document.getElementById('fwaz_'+c).value = x*weight;
					document.getElementById('fwaz_'+c).value += " "+document.getElementById('un_'+c).value;
				}
		 }

		var count = 0;

		function hellobrother() {
			var rowCount = $('#addHere tr').length;
			var x = document.getElementById('prod_info'+rowCount).value;
			document.getElementById('omg').value = rowCount;
		}

		function callmebro() {
			var rowCount = $('#addHere tr').length;
			var prev_data = document.getElementById('final_amt_'+rowCount).value;
			if ( prev_data == "") {
				alert("Calculate First the Particulars and then add more.");
				return false;
			}
		count = rowCount + 1;
		var html = '';
		html += '<tr> <td> <div class="form-group"> <button type="button" class="btn btn-default btn-lg" data-toggle="modal" data-target="#myModal'+count+'">Select Product</button> <br> <input type="hidden" name="selected_item_id[]" id="main_id'+count+'"> <br> <div id="show_prod_div'+count+'" style="display: none;"> <label>You\'ve Selected: </label> <input type="text" id="prod_info'+count+'" class="form-control" name="the_id" readonly="readonly"> </div> </div> </td> <td> <div class="form-group"> <div class="input-group"> <input type="text" name="weig[]" class="form-control" id="wazan_'+count+'" placeholder="Net Weight per pack. (with units)" onkeyup="rady();" style="width: 100%" data-validation="number" data-validation-length="min1" data-validation-allowing="float" data-validation-decimal-separator="." data-validation-error-msg="Numeric values only"> <span class="input-group-addon" style="padding: 1px;"> <select name="units[]" id="un_'+count+'" style="padding-top: 4px;padding-bottom: 4px;" onchange="rady();"> <option value="KG">KG</option> <option value="G">G</option> <option value="L">L</option> <option value="mL">mL</option></select> </span> </div> <br> <div class="form-group"> <label>Quantity</label> <input type="text" name="quan[]" class="form-control" id="quantity_'+count+'" required placeholder="No. of Packets" onkeyup="rady();" data-validation="number" data-validation-length="min1" data-validation-error-msg="Numeric values only"> </div> <br> <input type="text" name="tot_weight[]" readonly="readonly" placeholder="Overall Weight" class="form-control" id="fwaz_'+count+'"> </div> </td> <td> <div class="form-group"> <input type="text" name="prise[]" class="form-control" id="price_'+count+'" required data-validation="number" data-validation-length="min1" data-validation-allowing="float" data-validation-decimal-separator="." data-validation-error-msg="Invalid Price"> </div> <td><div class="form-group"> <div class="input-group"> <div class="input-group-btn"> <button class="btn btn-primary" type="button" onclick="calc(getCount());"> <i class="fas fa-calculator"></i> </button> </div> <input type="text" name="finally_amount[]" class="form-control" id="final_amt_'+count+'" readonly="readonly" required> </div> <button type="button" class="btn btn-danger" style="float: right;padding-top: 10px;" onclick="callmebro2(this)"><i class="fas fa-minus"></i></button> </div> </td> </tr>';
		$('#addHere').append(html);
		html = '';
		html += '<div class="modal fade" id="myModal'+count+'" role="dialog"> <div class="modal-dialog modal-lg"> <!-- Modal content--> <div class="modal-content" data-backdrop="static" style="padding: 0;"> <div class="modal-header"> <!--<button type="button" class="close" data-dismiss="modal" onclick="cross();">&times;</button> --> <h4 class="modal-title">Select Your Product Below</h4> </div> <div class="modal-body" id="original_placement"><!-- <div class="form-inline" style="padding-bottom: 5px;" align="center"> <div class="form-group"> <select id="typicalSearchFilter'+count+'" class="form-control"> <option value="1">Item</option> <option value="2">Brand</option> <option value="3">Type</option> </select> </div> <div class="form-group"> <input type="text" id="myInput'+count+'" onkeyup="myFunction1(getCount());" placeholder="Search" class="form-control"> </div> </div>--> <table class="table table-bordered" id="myTable'+count+'"> <thead> <tr> <th>SL No.</th> <th>Item Name</th> <th>Brand</th> <th>Type</th> </tr> </thead> <tbody id="filter_here"> <?php $res = mysqli_query($db, "SELECT * FROM inventory_card WHERE fk_company='$fk_company'") or die(mysqli_error($db)); $sl = 0; while($record = mysqli_fetch_array($res)) { ?> <tr> <td> <label class="radio-inline"> <input type="radio" name="optradio1" value="<?php echo($record[0]); ?>"><?php echo $sl = $sl + 1; ?> </label> </td> <td><?php echo $record[1]; ?></td> <td><?php echo $record[2]; ?></td> <td><?php if ($record["item_type"] == 'R') { echo "Raw Materials"; } else { echo "Finished Goods"; } ?></td> </tr> <?php } ?> </tbody> </table> </div> <div class="modal-footer"> <button type="button" class="btn btn-success" data-dismiss="modal" onclick="check_values();">OK</button> </div> </div> </div> </div>';
		$('#modal_is_here').append(html);
		manualtrigger(getCount());
		
	}

	function manualtrigger(val) {
		$.validate({
		    lang: 'en',
		    module: 'security'
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
		arik.closest('tr').remove();
	}

	function calc(arik) {
		var x = 0.00;
		//var y = 0.00;
		//var t = 0.00;
		var z = 0.00;
		var q = 0.00;
		q = $('#quantity_'+arik).val();
		x = $('#price_'+arik).val();
		//y = $('#disc_'+arik).val();
		//t = $('#tx_amt'+arik).val();
		//z = x - ((y / 100) * x) + ((t / 100) * x);
		document.getElementById('final_amt_'+arik).value = x*q;
		var yo = document.getElementById('final_amt_'+arik).value;
		if (yo == 'NaN' || yo == '0') {
			document.getElementById('final_amt_'+arik).value = '';
		}
	}

	function getItemDetail(val) {
		var c = getCount();
		//alert("Inside Get Item value");
		$.ajax({
			type: "POST",
			url: "get_item_det.php",
			data:'invt_id='+val,
			success: function(data){
				$("#prod_info"+c).val(data);
			}
		});
	}

	function getCount() {
		var rowCount = $('#addHere tr').length;
		return rowCount;
	}

	function mytotal() {
		var s = 0.00;
		var values = $("input[name='finally_amount[]']").map(function(){return $(this).val();}).get();
		for (var i = values.length - 1; i >= 0; i--) {
			s += parseFloat(values[i]);
		}
		y = $('#disc_').val();
		t = $('#tx_amt').val();
		s = s - ((y / 100) * s);
		s = s + ((t / 100) * s);
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

	function formalajax(val) {
		var c = getCount();
		//alert("Inside Get Item Name");
		$.ajax({
			type: "POST",
			url: "get_item_det.php",
			data:'tx_id='+val,
			success: function(data){
				//alert(data);
				$("#tx_amt").val(data);
			}
		});
	}
	</script>
</body>
</html>