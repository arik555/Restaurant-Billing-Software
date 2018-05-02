<?php include '../servers/company_srvr.php'; 
if (!isset($_SESSION['logged_user'])) {
	header("location: ../index.php");
}
$fk_company = $_SESSION['user_id'];
if (isset($_GET['qwerty'])) {
	if ($_GET['qwerty'] != $fk_company) {
		header("location: profile.php");
	}
	$_SESSION['editable'] = 'OK';
	$uname = $_GET['uname'];
	$pass = $_GET['pass'];
	$co_name = $_GET['co_name'];
	$user_email = $_GET['user-email'];
	$street = $_GET['street'];
	$town = $_GET['town'];
	$pin_code = $_GET['pin_code'];
	$state = $_GET['state'];
	$card = $_GET['card'];
	$card_num = $_GET['card_num'];

	$ggst_num = $_GET['ggst_num'];
	$bnk_nm = $_GET['bnk_nm'];

	$bnk_brch = $_GET['bnk_brch']; 
	$bnk_acc = $_GET['bnk_acc'];
	$bnk_ifsc = $_GET['bnk_ifsc'];
	$about = $_GET['about'];
	$fileToUpload = $_GET['fileToUpload'];
}
$edit_permit = $_SESSION['editable'];

?>
<!DOCTYPE html>
<html>
<head>
	<?php require '../style/cdn.php'; ?>
	<title>Welcome to Insert Company Details</title>
	<style>
		.panel {
		box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
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
<div id="header" class="container-fluid" style="padding: 0; background-color: #77BBBB;">
		<div class="row">
			<div class="col-sm-12" align="center">
				<img id="img" src="../logo_here/self.project.logo.here.png" class="img-responsive" style="padding: 10px;">
			</div>
		</div>
	</div>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
       <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="../index.php">BillSoft</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
	    <ul class="nav navbar-nav">
	      <li class="active"><a href="add_company.php">Edit Company Details</a></li>
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
	      <li><a href="profile.php">Company Profile</a></li>
	    </ul>
    </div>
  </div>
</nav>
<div class="container-fluid" style="padding-top: 10px;">
	<form method="POST" onsubmit="hellobrother()" enctype="multipart/form-data">
		<input type="hidden" name="loop_count" id="loop_count">
	<div class="row">
		<div class="col-sm-6 col-md-6">
			<div class="panel-group">
<div class="panel panel-primary">
    <div class="panel-heading">
    	<h4>Basic Information</h4>
    </div>
    <div class="panel-body">
    	<div class="form-group">
		  <label >UserName</label>
		  <div class="control">
		    <input class="form-control" name="uname" data-validation="length alphanumeric" data-validation-allowing="-_" data-validation-length="min5" type="text" required data-validation-error-msg-length="Minimum 5 characters" value="<?php echo($uname); ?>">
		  </div>
		</div>
		<div class="form-group">
		  <label >Password</label>
		  <div class="control">
		    <input class="form-control" type="password" name="pass_confirmation" data-validation="length" data-validation-length="min8" required data-validation-error-msg-length="Minimum 8 characters" value="<?php echo($pass); ?>">
		  </div>
		</div>
		<div class="form-group">
		  <label >Confirm Password</label>
		  <div class="control">
		    <input class="form-control" name="pass" data-validation="confirmation" type="password" data-validation-confirm="pass_confirmation" data-validation-error-msg="Password Mismatch">
		  </div>
		</div>
		<div class="form-group">
		  <label >Company's Name</label>
		  <div class="control">
		    <input class="form-control" name="co_name" data-validation="length" data-validation-length="min10" type="text" required data-validation-error-msg-length="Minimum 10 characters" value="<?php echo($co_name); ?>">
		  </div>
		</div>
		<div class="form-group">
		  <label >Email ID</label>
		  <div class="control">
		    <input class="form-control" name="user-email" data-validation="email" type="email" required value="<?php echo($user_email); ?>">
		  </div>
		</div>
    </div>
  </div>
  <div class="panel panel-primary">
    <div class="panel-heading">
		<h4>Company's Address</h4>
    </div>
    <div class="panel-body">
    	<div class="form-group">
		  <label >Street / Locality</label>
		  <div class="control">
		    <input class="form-control" name="street" data-validation="length" data-validation-length="min5" type="text" required data-validation-error-msg-length="Incorrect Street" value="<?php echo($street); ?>">
		  </div>
		</div>
		<div class="form-group">
		  <label >City / Town</label>
		  <div class="control">
		    <input class="form-control" name="town" data-validation="length" data-validation-length="min3" type="text" required data-validation-error-msg-length="Incorrect City" value="<?php echo($town); ?>">
		  </div>
		</div>
		<div class="form-group">
		  <label >Pincode</label>
		  <div class="control">
		    <input class="form-control" name="pin_code" data-validation="length number" data-validation-length="max6" type="text" required data-validation-error-msg="Incorrect Pincode" value="<?php echo($pin_code); ?>">
		  </div>
		</div>
		<div class="form-group">
		  <label >State</label>
		  <div class="control">
		    <input class="form-control" name="state" data-validation="length" data-validation-length="min3" type="text" required data-validation-error-msg-length="Incorrect State" value="<?php echo($state); ?>">
		  </div>
		</div>
    </div>
  </div>
  <div class="panel panel-primary">
    <div class="panel-heading">
		<h4>ID-related Details</h4>
    </div>
    <div class="panel-body">
		<div class="form-group">
		  <label >Card Type</label>
		  
			    <select name="card" required class="form-control" value="<?php echo($card); ?>">
			    	<option value="">Select Card</option>
			    	<option value="PAN">PAN Card</option>
			    </select>
		    
		</div>
		<div class="form-group">
		  <label >Card No.</label>
		  <div class="control">
		    <input class="form-control" name="card_num" data-validation="length alphanumeric" data-validation-length="10-16" type="text" required data-validation-error-msg-length="Incorrect Card No" value="<?php echo($card_num); ?>">
		  </div>
		</div>
		<div class="form-group">
		  <label >GST No.</label>
		  <div class="control">
		    <input class="form-control" name="ggst_num" data-validation="length alphanumeric" data-validation-length="10-16" type="text" required data-validation-error-msg-length="Incorrect GST No" value="<?php echo($ggst_num); ?>">
		  </div>
		</div>
    </div>
  </div>
</div> <!-- PANEL GROUP ENDS HERE-->
		</div>
		<div class="col-sm-6 col-md-6">
			<?php require 'part2.php'; ?>
		</div>
		<button type="submit" name="company_submit" class="btn btn-success btn-block" style="font-size: 25px; font-weight: bold; color: #006400;">Save</button>
	</div>
	</form>
</div>
<div style="padding-top: 10px;"></div>
<script src="https://code.jquery.com/jquery-3.3.1.js"
	integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
	crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<script type="text/javascript">
	$.validate({
    	lang: 'en',
    	modules : 'security'
  	});
</script>

<script type="text/javascript">
	var count = 0;

	function hellobrother() {
		var rowCount = $('#addHere tr').length;
		document.getElementById('loop_count').value = rowCount;
	}

	$(document).ready(function(){
        $('input[type="file"]').change(function(e){
            var fileName = e.target.files[0].name;
            var myspan = document.getElementById('show_file_name');
            myspan.style.display = "block";
            document.getElementById('show_file_name').innerHTML = fileName;
        });
    });

	function callmebro() {
		var html = '';
		var rowCount = $('#addHere tr').length;
		count = rowCount + 1;
		html += '<tr><td><div class="form-group"><input type="text" name="bnk_nm[]" class="form-control" required data-validation="length" data-validation-length="min8" data-validation-error-msg-length="Minimum 8 characters" id="b_name'+count+'"></div></td><td><div class="form-group"><input type="text" name="bnk_brch[]" class="form-control" required data-validation="length" data-validation-length="min5" data-validation-error-msg-length="Minimum 5 characters" id="b_branch'+count+'"></div></td><td><div class="form-group"><input type="text" name="bnk_acc[]" class="form-control" required data-validation="length" data-validation-length="14-16" data-validation-error-msg-length="Incorrect Account Number" id="b_acc'+count+'"></div></td><td><div class="form-group"><input type="text" name="bnk_ifsc[]" class="form-control" required data-validation="length alphanumeric" data-validation-length="10-15" data-validation-error-msg-length="Incorrect IFSC" id="b_ifsc'+count+'"></div></td><td><button type="button" onclick="callmebro2(this);" class="btn btn-danger"><i class="fas fa-minus"></i></button></td></tr>';
		$('#addHere').append(html);
		manual_trigger();
	}

	function callmebro2(arik) {
		arik.closest('tr').remove();
	}

	function manual_trigger() {
		$.validate({
	    	lang: 'en',
	    	modules : 'security'
  		});
	}
</script>
</body>
</html>
