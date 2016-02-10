<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
</head>
<body>

<div id="container">
	<?php echo validation_errors(); ?>

	<form method="post" action="<?php echo base_url() . 'register';?>">
		<input type="text" name="email"  placeholder="email" value="<?php echo set_value('email'); ?>"><br/>
		<input type="password" name="password"  placeholder="password"/><br/>
		<input type="password" name="c_password"  placeholder="confirm password"/><br/>
		<input type="text" name="full_name"  placeholder="full name" value="<?php echo set_value('full_name'); ?>"/><br/>
		<input type="date" name="birthdate"  placeholder="birthdate" value="<?php echo set_value('birthdate'); ?>"/><br/>
		<input type="radio" name="gender" id="male" value="male" checked="true"/>
		<label for="male">male</label>
		<input type="radio" name="gender" id="female" value="female"/>
		<label for="female">female</label><br/>

		<button type="submit">Submit</button>

	</form>
</div>

</body>
</html>