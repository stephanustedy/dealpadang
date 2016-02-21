<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>

<div id="container">
	<?php echo validation_errors(); ?>
	<?php echo $this->session->flashdata('error'); ?> <br/>
	<form method="post" action="<?php echo site_url('voucher/add');?>" enctype="multipart/form-data">
		<input type="text" name="title"  placeholder="title" value="<?php echo set_value('title'); ?>"><br/>
		<input type="text" name="stock"  placeholder="stock" value="<?php echo set_value('stock'); ?>"><br/>
		<input type="text" name="price"  placeholder="price" value="<?php echo set_value('price'); ?>"><br/>
		<input type="text" name="normal_price"  placeholder="normal price" value="<?php echo set_value('normal_price'); ?>"><br/>

		<input type="date" name="start_date"  placeholder="start_date" value="<?php echo set_value('start_date'); ?>"><br/>
		<input type="date" name="end_date"  placeholder="end_date" value="<?php echo set_value('end_date'); ?>"><br/>

		<textarea name="description" placeholder="description"><?php echo set_value('description'); ?></textarea><br/>
		<textarea name="info" placeholder="info"><?php echo set_value('info'); ?></textarea><br/>
		<textarea name="highlight" placeholder="highlight"><?php echo set_value('highlight'); ?></textarea><br/>
		<textarea name="condition" placeholder="condition"><?php echo set_value('condition'); ?></textarea><br/>

		<button type="submit">Submit</button>

	</form>
</div>


