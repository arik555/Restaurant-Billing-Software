<?php include '../servers/company_srvr.php';
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
<body style="display: none;">	
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
	      <li class="active"><a href="#">Edit Company Details</a></li>
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
			<?php require 'part1.php'; ?>
		</div>
		<div class="col-sm-6 col-md-6">
			<?php require 'part2.php'; ?>
		</div>
		<button type="submit" name="company_submit" class="btn btn-success btn-block" style="font-size: 25px; font-weight: bold; color: #006400;">Save</button>
	</div>
	</form>
</div>
<?php require '../style/footer.php'; ?>
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