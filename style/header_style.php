<style type="text/css">
	
</style><!-- #664848; #78a15a-->
<div id="header" class="container-fluid" style="padding: 0; background-color: brown;">
	<div class="row">
		<div class="col-sm-12" align="center">
			<?php $hare = mysqli_query($db, "SELECT * FROM logo WHERE fk_company='$fk_company'");
			$krishna = mysqli_fetch_array($hare); ?>
			<img id="img" src="../logo_here/<?php echo($krishna[1]); ?>" class="img-responsive">
		</div>
	</div>
</div>