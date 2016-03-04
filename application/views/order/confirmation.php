<div class="content-wrap">

	<div class="container clearfix">
		<form method="post" action="<?=site_url('tx/checkout')?>">
			<div class="table-responsive bottommargin">
				<h2><?=$voucher['title']?></h2>
				<br/>
				<?php echo $this->session->flashdata('error'); ?> <br/>
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
						<input type="hidden" id="voucher_id" name="voucher_id" value="<?=$voucher['voucher_id']?>"/>
						<?php
							foreach ($voucher['details'] as $detail) {
						?>
							<tr class="cart_item">

								<td class="cart-product-name">
									<h5><?=$detail['merchant_name']?></h5>
									<h5><?=$detail['address']?></h5>
								</td>

								<td class="cart-product-price">
									<span id="price" class="amount"><?=$detail['price_fmt']?></span>
								</td>

								<td class="cart-product-quantity">
									<div class="quantity clearfix">
										<input type="hidden" id="voucher_detail_id" name="voucher_detail_id[]" value="<?=$detail['voucher_detail_id']?>"/>
										<input type="button" value="-" class="minus" field="quantity">
										<input type="text" id="quantity" name="quantity[]" value="0" class="qty" onkeyup="this.value = minmax(this.value, 0, 100)"/>
										<input type="button" value="+" class="plus" field="quantity">
									</div>
								</td>

								<td class="cart-product-subtotal">
									Rp <span id="total" class="total_amount"></span>
								</td>
							</tr>
						<?php
							}
						?>
		
					</tbody>

				</table>

			</div>

			<div class="col-md-6 clearfix">
				<div class="acctitle"><i class="acc-closed icon-ok-circle"></i><i class="acc-open icon-remove-circle"></i>Direct Bank Transfer
				</div>
				<div class="acc_content clearfix">Donec sed odio dui. Nulla vitae elit libero, a pharetra augue. Nullam id dolor id nibh ultricies vehicula ut id elit. Integer posuere erat a ante venenatis dapibus posuere velit aliquet.
				</div>
			</div>
			<div class="col-md-6 clearfix">
				<div class="table-responsive">
					<h4>Total Pembayaran</h4>

					<table class="table cart">
						<tbody>
							<tr class="cart_item">
								<td class="cart-product-name">
									<strong>Total</strong>
								</td>

								<td class="cart-product-name">
									<span class="amount color lead"><strong>Rp </strong></span>
									<span class="amount color lead"><strong id="sum"></strong></span>
								</td>
							</tr>

							<tr class="cart_item">
								<td colspan="6">
									<div class="row clearfix">
										<div class="col-md-12 col-xs-12 nopadding" align="right">
											<button type="submit" class="add-to-cart button nomargin">LANJUTKAN</button>
										</div>
									</div>
								</td>
							</tr>
						</tbody>

					</table>

				</div>

			</div>
		</form>


	</div>

</div>