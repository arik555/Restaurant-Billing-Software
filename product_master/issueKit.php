<?php require '../servers/product_server.php';
if (!isset($_SESSION['logged_user'])) {
	header("location: ../index.php"); 
}
$fk_company = $_SESSION['user_id'];

$x = 0;

if (isset($_POST['stock_sub'])) {
	$dt = date('Y-m-d');
	$inHandID = $_POST['item_id'];
	#$quantity = $_POST['quan_select'];
	$quantity = $_POST['weight_select'];
	$uunit = $_POST['unit_here'];
	$where_about = $_POST['where_about'];

	
	$sql = "SELECT * FROM in_hand WHERE fk_company='$fk_company' AND in_hand_id='".$inHandID."'";
	$soho = mysqli_query($db, $sql) or die(mysqli_error($db));
	$record = mysqli_fetch_array($soho);
			$subtract = $record[2] - $quantity;
			if ($subtract <= 0) {
				$subtract = 0;
			}
			mysqli_query($db, "UPDATE in_hand SET `resultant_quantity`='$subtract' WHERE in_hand_id='".$inHandID."'") or die(mysqli_error($db)); 

	$arik = mysqli_query($db, "INSERT INTO stock_report (fk_inv_id, items_received_by, current_quan, dated, fk_company, unit) VALUES ('".$record[1]."', '$where_about','$quantity','$dt', '$fk_company', '$uunit')") or die(mysqli_error($db));
	if ($arik) {
		echo "<script>alert(\"Record inserted Successfully.\");window.location.assign(\"issueKit.php\");</script>";
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
	      <li class="dropdown">
	        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Product Stock Status
	        <span class="caret"></span></a>
	        <ul class="dropdown-menu">
	          <li><a href="my_stock.php">Products In Hand</a></li>
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
	      <li class="active"><a href="issueKit.php">Issue to Kitchen</a></li>
	    </ul>
    </div>
  </div>
</nav>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-5 col-sm-offset-3">
			<fieldset>
				<legend>ISSUE TO KITCHEN</legend>
				<form method="POST">
					<div class="form-group">
						<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal1">Select Stock Item</button>
					</div>
					<div style="display: none;" id="myspan" class="form-group">
						<label>You've Selected</label>
						<input type="text" id="prod_name" 
						class="form-control" readonly="readonly" placeholder="Your Selected Item Here">
					</div>
						<input type="hidden" name="item_id" id="item_id">
					<!-- <div class="form-group">
						<select name="quan_select" id="quan_select" class="form-control" required>
							<option value="">Select Quantity</option>
						</select>
						<br>
					</div> -->
					<div class="form-group">
						<label>Choose Net Weight <span id="max_wt"></span></label>
						<input type="text" name="weight_select" id="weight_select" class="form-control" required data-validation="number" data-validation-decimal-separator="." data-validation-error-msg="Choose appropiate weight" >
						<input type="hidden" name="unit_here" id="wt_unit">
					</div>
					<div class="form-group">
						<textarea name="where_about" placeholder="Define its' WhereAbout" required style="resize: none;" rows="5" class="form-control" readonly="readonly">Kitchen</textarea>
					</div>
					<div class="form-group">
						<input type="submit" name="stock_sub" class="btn btn-info" value="Go">
					</div>
				</form>
			</fieldset>
		</div>
	</div>
	<div class="row" style="padding-top: 17px;">
		<div class="col-sm-12">
			<fieldset>
				<legend align="center">YOUR PREV. ISSUED ITEMS</legend>
				<div style='overflow:auto; width:auto;height:400px;'>
				<table class="table table-border" id="myTable2">
				<thead>
					<tr>
						<th>Sl No.</th>
						<th>Date</th>
						<th>Item Name</th>
						<th>Brand</th>
						<th>Type</th>
						<th>Sent to</th>
						<th>Net Weight</th>
					</tr>
				</thead>
				<tbody>					<?php $arik = mysqli_query($db, "SELECT * FRom stock_report WHERE fk_company='$fk_company'") or die(mysqli_error($db)); $sl=0; while ($sarkar = mysqli_fetch_array($arik)) { $sl = $sl+1; ?>
					<tr>
						<td><?php echo $sl; ?></td>
						<td><?php echo $sarkar['dated']; ?></td>
						<td><?php $query = mysqli_query($db, "SELECT * FRom inventory_card WHERE invt_id='".$sarkar[1]."'") or die(mysqli_error($db)); $room = mysqli_fetch_array($query); echo $room[1]; ?></td>
						<td><?php echo $room['brand']; ?></td>
						<td><?php if($room[5] == 'R') {
							echo "Raw Material"; }
							else {
								echo "Finished Goods";
							}
						?></td>
						<td><?php echo $sarkar[2]; ?></td>
						<td><?php echo $sarkar[3]." ".$sarkar['unit']; ?></td>
						
					</tr>
					<?php }  ?>
					</tbody>
				</table>
				</div>
			</fieldset>
		</div>
	</div>
</div>
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
        	<div class="form-inline" style="padding-bottom: 5px;" align="center">
				<div class="form-group">
					<select id="typicalSearchFilter1" class="form-control">
						<option value="1">Item</option>
						<option value="2">Brand</option>
						<option value="3">Net Weight</option>
					</select>
				</div>
				<div class="form-group">
					<input type="text" id="myInput1" onkeyup="myFunction1()" placeholder="Search" class="form-control">
				</div>	
			</div>
			<table class="table table-bordered" id="myTable1">
				<thead>
					<tr>
						<th>SL No.</th>
						<th>Item</th>
						<th>Brand</th>
						<th>Type</th>
						<th>Net Weight</th>
					</tr>
				</thead>
				
				<tbody id="filter_here">
					<?php $sql = "SELECT * FROM in_hand where fk_company='$fk_company' AND resultant_quantity > 0";
							$resm = mysqli_query($db, $sql) or die(mysqli_error($db));
							$sl = 0;
							while ($rex = mysqli_fetch_array($resm)) {
								echo "<tr>";
								$sl = $sl+1; ?>
								<td>
									<label class="radio-inline">
								      <input type="radio" name="optradio1" value="<?php echo($rex[0]); ?>"><?php echo $sl; ?>
								    </label>
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
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal" onclick="check_values();">OK</button>
        </div>
      </div>
    </div>
</div>
</section>
<?php require '../style/footer.php'; ?>
<script type="text/javascript">
	$(document).ready(function(){
		$.validate({
		    lang: 'en',
		    module: 'security'
		  });
		$('#myTable2').DataTable();
	})

	function check_values() {
		var X = $("input[type='radio'][name='optradio1']:checked").val();
		//alert("Inside Get Menu Id "+X);
		var mydiv = document.getElementById('myspan');
		if (X) {
			mydiv.style.display = 'block';
			//alert("Inside get put");
			document.getElementById('item_id').value = X;
			getItemName(X);
			//getItemQTY(X);
			getUnit(X);
		}
	}
/*
	function getItemQTY(val) {
		alert("Inside ajax"+val);
		$.ajax({
			type: "POST",
			url: "get_item_QTY.php",
			data:'invty_id='+val,
			success: function(data){
				alert(data);
				$("#quan_select").html(data);
			}
		});
	}

	function getItemQTY(val) {
		//alert("Inside ajax"+val);
		$.ajax({
			type: "POST",
			url: "get_item_QTY.php",
			data:'inven_tory_id='+val,
			success: function(data){
				//alert(data);
				var x = '(max '+data;
				$("#max_wt").html(x);
				$("#weight_select").attr("data-validation-allowing", 'range[1;'+data+']');
				getUnit(val);
			}
		});
	}
*/
	function getUnit(val) {
		alert("Inside ajax"+val);
		$.ajax({
			type: "POST",
			url: "getUnit.php",
			data:'i_id='+val,
			success: function(data){
				alert(data);//return data;
				var x = '(max '+data+')';
				var whole = data.split(" ");
				var y = whole[1];
				alert(y);
				$("#max_wt").html('');
				$("#max_wt").append(x);
				$("#wt_unit").val(y);
				$('#weight_select').attr("data-validation-allowing", "range[1;"+whole[0]+"],float");
			}
		});
	}

	function getItemName(val) {
		//alert("Inside ajax"+val);
		$.ajax({
			type: "POST",
			url: "get_item_QTY.php",
			data:'inven_id='+val,
			success: function(data){
				$("#prod_name").val(data);
			}
		});
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