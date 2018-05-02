<div class="panel-group">
	<div class="panel panel-primary">
    <div class="panel-heading">
		<h4>Bank Account Details</h4>
    </div>
    <div class="panel-body table-responsive">
		<table class="table table-bordered" style="table-layout: fixed;
		width: 100%;">
			<thead>
				<tr>
					<th>Bank Name</th>
					<th>Branch</th>
					<th>A/c No.</th>
					<th>IFSC Code</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody id="addHere">
				<tr>
					<td>
					  	<div class="form-group">
					    	<input type="text" name="bnk_nm[]" data-validation="length" data-validation-length="min8" class="form-control" required data-validation-error-msg-length="Minimum 8 characters" id="b_name0">
					  	</div>
					</td>
					<td>
					  	<div class="form-group">
					    	<input type="text" name="bnk_brch[]" data-validation="length" data-validation-length="min5" class="form-control" required data-validation-error-msg-length="Minimum 5 characters" id="b_branch0">
					  	</div>
					</td>
					<td>
					  	<div class="form-group">
					    	<input type="text" name="bnk_acc[]" data-validation="length number" data-validation-length="14-16" class="form-control" required data-validation-error-msg-length="Incorrect Account Number" id="b_acc0">
					  	</div>
					</td>
					<td>
					  	<div class="form-group">
					    	<input type="text" name="bnk_ifsc[]" data-validation="length alphanumeric" data-validation-length="10-15" class="form-control" required data-validation-error-msg-length="Incorrect IFSC" id="b_ifsc0">
					  	</div>
					</td>
					<td>
						<button type="button" class="btn btn-danger disabled"><i class="fas fa-minus"></i></button>
					</td>
				</tr>
			</tbody>
		</table>
		<button type="button" onclick="callmebro()" class="btn btn-success"><i class="fas fa-plus"></i></button>
    </div>
  </div>
  <div class="panel panel-primary">
    <div class="panel-heading">
		<h4>More Details</h4>
    </div>
    <div class="panel-body">
		<div class="form-group">
		  <label >About Company</label>
		  <div class="form-group">
		    <textarea name="about" class="form-control" data-validation="length" data-validation-length="min20" rows="10" style="resize: none;" data-validation-error-msg-length="Minimum 20 characters"></textarea>
		  </div>
		</div>
		<hr>
		<label>Upload Image / Logo: </label>
		<div class="file has-name is-warning">
		  <label class="file-label">
		    <input class="form-control" type="file" name="fileToUpload" id="fileToUpload" onchange="callfilehandle(this);" accept="image/*" style="display: none;" data-validation="mime size"
			data-validation-allowing="jpg, png, gif" 
			data-validation-max-size="3M"
			data-validation-error-msg-size="You can not upload images larger than 3MB"
				data-validation-error-msg-mime="You can only upload images">
		    <span class="file-cta" style="border: 1px solid grey; padding: 4px;">
		      <span class="file-icon">
		        <i class="fas fa-upload"></i>
		      </span>
		      <span class="file-label">
		        Choose a file
		      </span>
		    </span>
		    <span class="file-name" style="font-weight: normal; display: none;" id="show_file_name">
		  
		    </span>
		  </label>
		</div>
    </div>
  </div>
</div> <!-- PANEL GROUP ENDS HERE -->
