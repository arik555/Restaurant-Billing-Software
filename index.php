<?php require 'auth_server.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<?php require 'style/cdn.php'; ?>
	<link rel="stylesheet" type="text/css" href="style/spl_index.css">
	<title>Welcome to Dashboard</title>
</head>
<body>
	
<?php if (isset($_SESSION['logged_user'])) {
$fk_company = $_SESSION['user_id'];
 ?>
<style type="text/css">
	body {
		background-color: #fff !important;
	}
	#contents {
		background: url(https://loading.io/assets/img/transparent.png);
		padding-bottom: 100px;
		margin: auto;
	}
	ul li {
		position: relative !important;
		list-style-type: none !important;
		float: left !important;
		margin-left: 10px !important;
		margin-bottom: 15px !important;
	}
	a {
		text-decoration: none;
		color: #fff;
	}
	.btn {
		box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
	}
	#header {
		height: 250px !important;
	}
</style><!-- #664848; #78a15a-->
<div id="header" class="container-fluid" style="padding: 0;margin: 0;">
	<div class="row">
		<div class="col-sm-12" align="center">
			<?php $hare = mysqli_query($db, "SELECT * FROM logo WHERE fk_company='$fk_company'");
			$krishna = mysqli_fetch_array($hare); ?>
			<img id="img" src="logo_here/<?php echo($krishna[1]); ?>" class="img-responsive">
		</div>
	</div>
</div>
<link rel="stylesheet" type="text/css" href="http://unicorn-ui.com/buttons/css/buttons.css">
<div class="container-fluid" style="padding-top: 20px;" id="contents">
	<div class="row">
		<div class="col-sm-12">
		<ul>
			<li><a href="company_master/profile.php" class="btn button-3d button-royal button-rounded button-giant button-longshadow-right">Company</a></li>
			<li><a href="product_master/my_stock.php" class="btn button-3d button-primary button-rounded button-giant button-longshadow-right">Product / Inventory</a></li>
			<li><a href="tax_master/tax_main.php" class="btn button-3d button-royal button-rounded button-giant button-longshadow-right">Tax Master</a></li>
			<li><a href="purchase_mod/purchase_list.php" class="btn button-3d button-primary button-rounded button-giant button-longshadow-right">Purchase</a></li>
			<li><a class="btn button-3d button-royal button-rounded button-giant button-longshadow-right" onclick="window.open('sales_mod/sales.php', '_blank');">Sales</a></li>
			<li><a href="grp_leg_mod/group_ledger.php" class="btn button-3d button-primary button-rounded button-giant button-longshadow-right">Group-Ledger</a></li>
			<li><a href="reports/display_reports.php" class="btn button-3d button-royal button-rounded button-giant button-longshadow-right">Reports</a></li>
			<li><a href="servers/logout_server.php" class="btn button-3d button-caution button-rounded button-giant button-longshadow-right">LOGOUT</a></li>
		</ul>
		</div>
</div>
</div>
<?php } else { ?><div id="header" class="container-fluid" style="padding: 0; background-color: #77BBBB;">
		<div class="row">
			<div class="col-sm-12" align="center">
				<img id="img" src="logo_here/self.project.logo.here.png" class="img-responsive" style="padding: 10px;">
			</div>
		</div>
	</div>
<style type="text/css">
	body{
		background-color: #448ed3;
	}
	input {
		width: 230px !important;
	}
</style>
<div class="wrap" style="margin-top: 100px;">
	<form method="POST">
		<input type="text" name="login_user"  placeholder="Username">
		<input type="password" name="login_pass" placeholder="Password"><br>
		<input type="submit" name="login_submit" value="Login">
	</form>
</div>
<?php } ?>
<?php require 'style/footer.php'; ?>
</body>
</html>