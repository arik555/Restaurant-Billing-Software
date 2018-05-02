<div class="panel-group">
<div class="panel panel-primary">
    <div class="panel-heading">
    	<h4>Basic Information</h4>
    </div>
    <div class="panel-body">
    	<div class="form-group">
		  <label >UserName</label>
		  <div class="control">
		    <input class="form-control" name="uname" data-validation="length alphanumeric" data-validation-allowing="-_" data-validation-length="min5" type="text" required data-validation-error-msg-length="Minimum 5 characters">
		  </div>
		</div>
		<div class="form-group">
		  <label >Password</label>
		  <div class="control">
		    <input class="form-control" type="password" name="pass_confirmation" data-validation="length" data-validation-length="min8" required data-validation-error-msg-length="Minimum 8 characters">
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
		    <input class="form-control" name="co_name" data-validation="length" data-validation-length="min10" type="text" required data-validation-error-msg-length="Minimum 10 characters">
		  </div>
		</div>
		<div class="form-group">
		  <label >Email ID</label>
		  <div class="control">
		    <input class="form-control" name="user-email" data-validation="email" type="email" required>
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
		    <input class="form-control" name="street" data-validation="length" data-validation-length="min5" type="text" required data-validation-error-msg-length="Incorrect Street">
		  </div>
		</div>
		<div class="form-group">
		  <label >City / Town</label>
		  <div class="control">
		    <input class="form-control" name="town" data-validation="length" data-validation-length="min3" type="text" required data-validation-error-msg-length="Incorrect City">
		  </div>
		</div>
		<div class="form-group">
		  <label >Pincode</label>
		  <div class="control">
		    <input class="form-control" name="pin_code" data-validation="length number" data-validation-length="max6" type="text" required data-validation-error-msg="Incorrect Pincode">
		  </div>
		</div>
		<div class="form-group">
		  <label >State</label>
		  <div class="control">
		    <input class="form-control" name="state" data-validation="length" data-validation-length="min3" type="text" required data-validation-error-msg-length="Incorrect State">
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
		  
			    <select name="card" required class="form-control">
			    	<option value="">Select Card</option>
			    	<option value="PAN">PAN Card</option>
			    </select>
		    
		</div>
		<div class="form-group">
		  <label >Card No.</label>
		  <div class="control">
		    <input class="form-control" name="card_num" data-validation="length alphanumeric" data-validation-length="10-16" type="text" required data-validation-error-msg-length="Incorrect Card No">
		  </div>
		</div>
		<div class="form-group">
		  <label >GST No.</label>
		  <div class="control">
		    <input class="form-control" name="ggst_num" data-validation="length alphanumeric" data-validation-length="10-16" type="text" required data-validation-error-msg-length="Incorrect GST No">
		  </div>
		</div>
    </div>
  </div>
</div> <!-- PANEL GROUP ENDS HERE-->