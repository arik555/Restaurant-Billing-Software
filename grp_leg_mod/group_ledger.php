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
	      <!-- <li class="dropdown">
	        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Misc
	        <span class="caret"></span></a>
	        <ul class="dropdown-menu">
	          <li><a href="#">Add Brand to DataBase</a></li>
	          <li><a href="#"></a></li>
	          <li><a href="#">Page 1-3</a></li>
	        </ul>
	      </li> -->
	      <li class="active"><a href="group_ledger.php">Group Ledger</a></li>
	    </ul>
    </div>
  </div>
</nav>
<style type="text/css">
    .black {
      display: none;
    }
</style>
<?php if (isset($_POST['expnsubmit'])) {
    $exp_typ = $_POST['expense_type'];
    $exp_det = $_POST['exp_det'];
    $money = $_POST['price'];
    $dt = date('Y-m-d');

    $res = mysqli_query($db, "INSERT INTO group_ledger (exp_type, expenses_detail, dated, fk_company, cost) VALUES ('$exp_typ','$exp_det','$dt','$fk_company', '$money')") or die(mysqli_error($db));

    if($res) {
      echo "<script>alert('Expense Record Imported Successfully.');</script>";
      header('location: group_ledger.php');
    }
} ?>

<div class="container">
	<div class="row">
		<div class="col-md-6">
      <fieldset>
        <legend>ADD EXTRA EXPENSES</legend>
        <form method="POST">
        <div class="form-group">
          <select name="expense_type" required class="form-control">
            <option value="">Select Expense Type</option>
            <option value="Miscellaneous">Miscellaneous</option>
            <option value="Other">Other</option>
          </select>
        </div>
        <div class="form-group">
          <textarea class="form-control" style="resize: none;" rows="5" placeholder="Expense Detail" required name="exp_det"></textarea>
        </div>
        <div class="form-group">
          <input type="text" name="price" class="form-control" placeholder="Cost (INR)" required>
        </div>
        <div class="form-group">
          <input type="submit" name="expnsubmit" class="btn btn-success">
        </div>
      </form>
      </fieldset>
      </div>
      <div class="col-md-6">
        <fieldset>
          <legend>RECORDS</legend>
          <div class="form-inline" style="padding-bottom: 5px;" align="center">
        <div class="form-group">
          <select id="typicalSearchFilter1" class="form-control">
            <option value="">Search By</option>
            <option value="1">Expense Type</option>
            <option value="2">Expense Detail</option>
            <option value="3">Cost</option>
            <option value="4">Date</option>
          </select>
        </div>
        <div class="form-group">
          <input type="text" id="myInput1" onkeyup="myFunction1();" placeholder="Search" class="form-control">
        </div>  
      </div>
      <div style='overflow:auto; width:auto;height:200px;'>
            <table class="table table-bordered" id="myTable1">
              <tr>
                <th>SL No.</th>
                <th>Expense Type</th>
                <th>Expense Detail</th>
                <th>Cost</th>
                <th>Date</th>
              </tr>
              <?php  $arik = mysqli_query($db, "SELECT * FROM group_ledger WHERE fk_company='$fk_company'");
              $sl = 0;
              while ($sarkar = mysqli_fetch_array($arik)) { ?>
                  <tr>
                    <td><?php echo $sl = $sl+1; ?></td>
                    <td><?php echo $sarkar[1]; ?></td>
                    <td><?php echo $sarkar[2]; ?></td>
                    <td><?php echo $sarkar[3]; ?></td>
                    <td><?php echo $sarkar[4]; ?></td>
                  </tr>
              <?php } ?>
        </table>
      </div>
        </fieldset>
      </div>
	</div>
</div>
<?php require '../style/footer.php'; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<script>
$.validate({
  lang: 'en',
  modules : 'security'
});
</script>
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