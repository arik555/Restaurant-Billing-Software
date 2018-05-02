<?php require '../servers/sales_server.php'; 

if (!isset($_SESSION['logged_user'])) {
	header("location: ../index.php");
}
$fk_company = $_SESSION['user_id'];

if (!isset($_GET['cust_id'])) {
	header("location: sales_invoice_master.php");
}
$customer_id = $_GET['cust_id'];
$rock = mysqli_query($db, "SELECT * FROm sales_customer WHERE sales_cust_id='$customer_id' and fk_company='$fk_company'") or die(mysqli_error($db));
if (mysqli_num_rows($rock) < 1) {
	header("location: sales_invoice_master.php");
}
$some = 0.00;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Print Preview</title>
	<link href="https://fonts.googleapis.com/css?family=Do+Hyeon|Gugi|Ubuntu" rel="stylesheet">
	<style type="text/css">
		h2 {
			font-family: 'Do Hyeon';
		}
		h1 {
			font-family: 'Gugi';
			letter-spacing: 2px;
		}
		#det {
			font-weight: normal;
		}
		/*body {
			max-width: 50%;
			font-size: 0.2em;
		}*/ 
	</style>
</head>
<body onload="window.print();">
<h4 style="font-family: 'Gugi'; letter-spacing: 4px; font-size: 1.5em; margin: 0px;" align="center"><?php $arik = mysqli_query($db, "SELECT * FROM company_details WHERE company_id='$fk_company'") or die(mysqli_error($db));
	$rumour = mysqli_fetch_array($arik);
	echo $rumour['company_name']; ?></h4>	<h4 style="font-size: 0.9em;margin: 0px;"align="center"><span id="det"><?php echo $rumour[5].", ".$rumour[6].", ".$rumour[7].", ".$rumour[8]."." ?></span></h4>	<table width="100%" class="table table-condensed" style="font-size: 0.9em;margin: 0px;">		<tr>			<td width="50%"><strong>Food Licence No: </strong><?php echo $rumour[10]; ?></td>			<td width="50%" align="right"><strong>GST No: </strong><?php echo $rumour['gst']; ?></td>		</tr>		</table>
	<h4 style="font-size: 0.9em;margin: 0px;"align="center">Invoice No. <span id="det"><?php echo "$fk_company".sprintf("%'.09d", $customer_id); ?></span></h4>
<section>
<style type="text/css">
	p {
		font-family: Oswald;
		font-size: 1.5em;
	}
	th, td {
		font-size: 0.9em;
	}		.table > tbody > tr > .no-line {		border-top: none;	}	.table > thead > tr > .no-line {		border-bottom: none;	}	.table > tbody > tr > .thick-line {		border-top: 2px solid;	}
</style>
<?php $sql = "SELECT * FROM sales_customer WHERE sales_cust_id='$customer_id'";
$res = mysqli_query($db, $sql) or die(mysqli_error($db)); ##########  GET CUSTOMER DETAILS  ###########
$record = mysqli_fetch_array($res);  ?>	<table width="100%" class="table table-condensed" style="font-size: 0.9em;margin: 0px;">		<tr>			<td width="50%"><strong>Customer Name / Table No: </strong><?php echo $record['cust_name']; ?></td>			<td width="50%" align="right"><strong>Date: </strong><?php echo $record['dated']; ?></td>		</tr>	</table><hr>
    <table width="100%" class="table table-condensed" style="font-size: 0.9em;margin: 0px;">		<thead>            <tr>        		<td width="60%"><strong>Item Name</strong></td>        		<td width="8%" align="center"><strong>Qty</strong></td>        		<td width="12%" align="right"><strong>Price</strong></td>        		<td width="20%" align="right"><strong>Amount</strong></td>            </tr>    	</thead>
		
		<?php $sql2 = "SELECT * FROM sales_report 
		WHERE fk_customer_id='$customer_id'";
		$res2 = mysqli_query($db, $sql2) or die(mysqli_error($db));
		while ($record2 = mysqli_fetch_array($res2)) { 
			$res3 = mysqli_query($db, "SELECT * FROM menu_card WHERE menu_id='".$record2[1]."'") or die(mysqli_error($db));
			$item = mysqli_fetch_array($res3); ?>
		<tr>
			<td align="left"><?php echo $item['level_5']; ?></td>
			<td align="center"><?php echo $record2['quantity']; ?></td>
			<td align="right"><?php echo $record2['rate']; ?></td>
			<td align="right"><?php echo $record2['final_rate']; $some = $some+(float)$record2['final_rate']; ?></td>
		</tr>
		<?php } ?>
	</table>
	<hr>	<table width="100%" class="table table-condensed" style="font-size: 0.9em;margin: 0px;">		<tr>			<td width="80%" align="right"><strong>Sub Total:</strong></td>			<td width="20%" align="right"><?php echo $some;?></td>		</tr><?php $omar = mysqli_query($db, "SELECT * FROM tax_master where tax_id='".$record['fk_tax_id']."'") or die(mysqli_error($db)); $rope = mysqli_fetch_array($omar);//echo $rope['tax_type']." @ ".$rope['tax_amount']." %"."<br>".$rope['tax_type2']." @ ".$rope['tax_amount2']." %"; ?>		<tr>			<td width="80%" align="right"><strong>Tax: CGST @ 2.5 %:</strong></td>			<td width="20%" align="right"></td>		</tr>		<tr>			<td width="80%" align="right"><strong>SGST @ 2.5 %:</strong></td>			<td width="20%" align="right"></td>		</tr>		<tr>			<td width="80%" align="right"><strong>Amount Payable:</strong></td>			<td width="20%" align="right"><?php echo round($record['total_amount']);?></td>		</tr>	</table><hr>	<table width="100%" class="table table-condensed" style="font-size: 0.9em;margin: 0px;padding-top: 25px">		<tr>			<td width="50%"><strong>Powered By Simplified</strong></td>			<td width="50%" align="right"><strong>Authorised Signatory</strong></td>		</tr>	</table>	
</section>
</body>
</html>
<?php 

/*

<td align="center"><?php 
			$omar = mysqli_query($db, "SELECT * FROM tax_master where tax_id='".$record2['fk_tax_id']."'") or die(mysqli_error($db));
			$hold = mysqli_fetch_array($omar);
			echo $hold['tax_type']." @ ".$hold['tax_amount']." %"; ?></td>

*/



 ?>