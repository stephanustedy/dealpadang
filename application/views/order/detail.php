<div class="content-wrap">

	<div class="container clearfix">

		<div class="col_full nobottommargin">

			<div class="fancy-title title-border-color">
				<h3><span>Invoice</span></h3>
			</div>

			<div class="row">
				<div class="col-md-3 clearfix">
					<div class="panel panel-success">
						<div class="panel-heading">
							<h3 class="panel-title">Sales ID</h3>
						</div>
						<div class="panel-body">
							<?=$order['invoice_ref_num']?>
						</div>
					</div>
				</div>
				<div class="col-md-3 clearfix">
					<div class="panel panel-success">
						<div class="panel-heading">
							<h3 class="panel-title">Total Pembayaran</h3>
						</div>
						<div class="panel-body">
							Rp 50.000
						</div>
					</div>
				</div>
				<div class="col-md-3 clearfix">
					<div class="panel panel-success">
						<div class="panel-heading">
							<h3 class="panel-title">Batas Pembayaran</h3>
						</div>
						<div class="panel-body">
							17 Maret 2016
						</div>
					</div>
				</div>
				<div class="col-md-3 clearfix">
					<div class="panel panel-success">
						<div class="panel-heading">
							<h3 class="panel-title">Name</h3>
						</div>
						<div class="panel-body">
							<?=$order['user_name']?>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-6 clearfix">
					<div class="panel panel-danger">
						<div class="panel-heading">
							<h3 class="panel-title">Status Pembayaran</h3>
						</div>
						<div class="panel-body">
							Belum Dibayar
						</div>
					</div>

					<!-- Jika Sudah bayar pake style ini -->
					<!-- <div class="panel panel-success">
						<div class="panel-heading">
							<h3 class="panel-title">Panel title</h3>
						</div>
						<div class="panel-body">
							Panel content
						</div>
					</div> -->
				</div>
			</div>

		</div>

		<div class="table-responsive bottommargin">

			<table class="table cart">
				<thead>
					<tr>
						<th class="cart-product-name">Product</th>
						<th class="cart-product-price">Unit Price</th>
						<th class="cart-product-quantity">Quantity</th>
						<th class="cart-product-subtotal">Total</th>
					</tr>
				</thead>
				<tbody>
					<?php
						foreach($order['order_detail'] as $k => $v) {
					?>
						<tr class="cart_item">

							<td class="cart-product-name">
								<h5><?=$v['title']?></h5>
								<h5><?=$v['merchant_name'] . ' - ' . $v['address']?></h5>
							</td>

							<td class="cart-product-price">
								<span id="price" class="amount"><?= rupiah_format($v['price']) ?></span>
							</td>

							<td class="cart-product-quantity">
								<div class="quantity clearfix">
									<span id="price" class="amount"><?=$v['quantity']?></span>
								</div>
							</td>

							<td class="cart-product-subtotal">
								<span id="total" class="total_amount"><?=rupiah_format($v['quantity'] * $v['price']) ?></span>
							</td>
						</tr>
					<?php
					}
					?>
				</tbody>

			</table>

		</div>

		<div class="row">
			<div class="col-md-12 clearfix">
				<div class="table-responsive">
					<h4>Total Pembayaran</h4>

					<table class="table cart">
						<tbody>
							<!-- <tr class="cart_item">
								<td class="cart-product-name">
									<strong>Subtotal</strong>
								</td>

								<td class="cart-product-name">
									<span id="sub" class="amount"></span>
								</td>
							</tr>
							<tr class="cart_item">
								<td class="cart-product-name">
									<strong>Kode Unik</strong>
								</td>

								<td class="cart-product-name">
									<span class="amount">17</span>
								</td>
							</tr> -->
							<tr class="cart_item">
								<td class="cart-product-name">
									<strong>Total</strong>
								</td>

								<td class="cart-product-name">
									<span class="amount color lead"><strong><?=rupiah_format($order['total_price']) ?></strong></span>
									<span class="amount color lead"><strong id="sum"></strong></span>
								</td>
							</tr>

						</tbody>

					</table>

				</div>

			</div>
		</div> <!-- End Transfer Detail -->

		<div class="row">
			<div class="col-md-6 clearfix">
				<div class="acctitle"><i class="acc-closed icon-ok-circle"></i><i class="acc-open icon-remove-circle"></i>Direct Bank Transfer
				</div>
				<div class="acc_content clearfix">
					<div id="reviews" class="clearfix">
						<div class="clearfix">
							<div class="col_full nobottommargin">
								<ul class="iconlist">
									<li><i class="icon-play"></i> Pilih salah satu rekening di bawah: <br>
										<strong>BCA: 10101010 A/N John</strong> <br>
										<strong>Mandiri: 10101010 A/N John</strong></li>
									<li><i class="icon-play"></i> Setelah transfer, isi kolom Konfirmasi Pembayaran di samping ini atau dengan cara: <br>
									<strong>Login > My Account > Purchase History > Invoice Pembelian</strong></li>
									<li><i class="icon-play"></i> Konfirmasi pembayaran akan diproses dalam waktu 1 x 24 jam, lalu voucher dapat diprint melalui purchase history atau email.</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-6 clearfix">

				<div class="fancy-title title-dotted-border">
					<h3>Konfirmasi Pembayaran</h3>
				</div>

				<div id="contact-form-result" data-notify-type="success" data-notify-msg="<i class=icon-ok-sign></i> Message Sent Successfully!"></div>
				<?=$this->session->flashdata("error_payment")?>
				<form class="nobottommargin" id="template-contactform" name="template-contactform" action="<?php echo site_url('tx/payment_confirmation');?>" method="post">
					<input type="hidden" name="order_id" value="<?=$order['order_id']?>" />
					<div class="form-process"></div>

					<div class="col_half">
						<label for="template-contactform-name">Bank Tujuan <small>*</small></label>
						<input type="text" id="template-contactform-name" name="bank_account" value="<?=isset($bank_account) ? $bank_account : '' ?>" class="sm-form-control required" />
					</div>

					<div class="col_half col_last">
						<label for="template-contactform-email">Tanggal Transfer <small>*</small></label>
						<input type="date" id="template-contactform-email" name="payment_date" value="<?=isset($payment_date) ? $payment_date : ''?>" class="required email sm-form-control" />
					</div>

					<div class="clear"></div>

					<div class="col_full">
						<label for="template-contactform-subject">Nama Pemilik Rekening  <small>*</small></label>
						<input type="text" id="template-contactform-subject" name="sender_account_name" value="<?=isset($sender_account_name) ? $sender_account_name : ''?>" class="required sm-form-control" />
					</div>

					<div class="col_full">
						<label for="template-contactform-subject">Nominal Transfer  <small>*</small></label>
						<input type="text" id="template-contactform-subject" name="nominal_transfer" value="<?=isset($nominal_transfer) ? $nominal_transfer : '' ?>" class="required sm-form-control" />
					</div>

					<div class="clear"></div>


					<div class="col_full hidden">
						<input type="text" id="template-contactform-botcheck" name="template-contactform-botcheck" value="" class="sm-form-control" />
					</div>

					<div class="col_full">
						<button name="submit" type="submit" id="submit-button" tabindex="5" value="Submit" class="button button-3d nomargin">Konfirmasi</button>
					</div>

				</form>

				<script type="text/javascript">

					// $("#template-contactform").validate({
					// 	submitHandler: function(form) {
					// 		$('.form-process').fadeIn();
					// 		$(form).ajaxSubmit({
					// 			target: '#contact-form-result',
					// 			success: function() {
					// 				$('.form-process').fadeOut();
					// 				$('#template-contactform').find('.sm-form-control').val('');
					// 				$('#contact-form-result').attr('data-notify-msg', $('#contact-form-result').html()).html('');
					// 				SEMICOLON.widget.notifications($('#contact-form-result'));
					// 			}
					// 		});
					// 	}
					// });

				</script>

			</div><!-- Contact Form End -->

		</div><!-- End Konfirmasi -->

	</div>

</div>