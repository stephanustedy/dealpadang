<div class="content-wrap">

	<div class="container clearfix">

		<div class="col_one_third nobottommargin">

			<div class="well well-lg nobottommargin">
				<?= isset($error_login) ?  $error_login : '';?>
				<form id="login-form" name="login-form" class="nobottommargin" action="<?php echo site_url('login');?>" method="post">

					<h3>Login Member</h3>

					<div class="col_full">
						<label for="login-form-username">Email:</label>
						<input type="text" id="login-form-username" name="email" value="<?php echo set_value('email'); ?>" class="form-control" />
					</div>

					<div class="col_full">
						<label for="login-form-password">Password:</label>
						<input type="password" id="login-form-password" name="password" value="" class="form-control" />
					</div>

					<div class="col_full nobottommargin">
						<button class="button button-3d nomargin" id="login-form-submit" name="login-form-submit" value="login">Login</button>
						<a href="#" class="fright">Lupa Password?</a>
					</div>

				</form>
			</div>

		</div>

		<div class="col_two_third col_last nobottommargin">
			<h3>Register Member (Free)</h3>

			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde, vel odio non dicta provident sint ex autem mollitia dolorem illum repellat ipsum aliquid illo similique sapiente fugiat minus ratione.</p>
			<?= isset($error_register) ?  $error_register : '';?>
			<form id="register-form" name="register-form" class="nobottommargin" action="<?php echo base_url() . 'register';?>" method="post">

				<div class="col_half">
					<label for="register-form-name">Nama Lengkap:</label>
					<input type="text" id="register-form-name" name="full_name" value="<?php echo set_value('full_name'); ?>" class="form-control" />
				</div>

				<div class="col_half col_last">
					<label for="register-form-email">Email:</label>
					<input type="text" id="register-form-email" name="email_regis" value="<?php echo set_value('email_regis'); ?>" class="form-control" />
				</div>

				<div class="clear"></div>

				<div class="col_half col_last">
					<label for="register-form-phone">Nomor Telepon:</label>
					<input type="text" id="register-form-phone" name="phone_number" value="<?php echo set_value('phone_number'); ?>" class="form-control" />
				</div>

				<div class="clear"></div>

				<div class="col_half">
					<label for="register-form-password">Password:</label>
					<input type="password" id="register-form-password" name="password" value="" class="form-control" />
				</div>

				<div class="col_half col_last">
					<label for="register-form-repassword">Ulangi Password:</label>
					<input type="password" id="register-form-repassword" name="c_password" value="" class="form-control" />
				</div>

				<div class="clear"></div>

				<div class="col_full nobottommargin">
					<button class="button button-3d button-black nomargin" id="register-form-submit" name="register-form-submit" value="register">Register</button>
				</div>

			</form>

		</div>

	</div>

</div>