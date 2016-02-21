<div class="container clearfix">
	<form id="add-merchant-form" name="add-merchant-form" class="nobottommargin" action="<?php echo site_url('merchant/add');?>" method="post">
		<?= isset($error_add_merchant) ?  $error_add_merchant : '';?>
		<h3>Add Merchant</h3>

		<div class="col_full">
			<label for="login-form-username">Merchant Name:</label>
			<input type="text" id="login-form-merchantname" name="merchant_name" value="<?php echo set_value('merchant_name'); ?>" class="form-control" />
		</div>

		<div class="col_full">
			<label for="login-form-phone">Phone Number:</label>
			<input type="text" id="login-form-phone" name="phone_number" value="<?php echo set_value('phone_number'); ?>" class="form-control" />
		</div>

		<div class="col_full">
			<label for="login-form-city">City:</label>
			<input type="text" id="login-form-city" name="city" value="<?php echo set_value('city'); ?>" class="form-control" />
		</div>

		<div class="col_full">
			<label for="login-form-address">Address:</label>
			<textarea name="address"><?php echo set_value('address'); ?></textarea>
			
		</div>

		<div class="col_full nobottommargin">
			<button class="button button-3d nomargin" id="login-form-submit" name="login-form-submit" value="login">Add Merchant</button>
		</div>

	</form>
</div>