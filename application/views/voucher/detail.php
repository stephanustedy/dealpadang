
<div class="container clearfix">
	<h1><?=$title?></h1>
	<ol class="breadcrumb">
		<li><a href="#">Home</a></li>
		<li><a href="#">Shop</a></li>
		<li class="active">Shop Single</li>
	</ol>
</div>

<div class="content-wrap">

	<div class="container clearfix">

		<div class="single-product">

			<div class="product">

				<div class="col_two_fifth">

					<!-- Product Single - Gallery
					============================================= -->
					<div class="product-image bottommargin">
						<div class="fslider" data-pagi="false" data-arrows="false" data-thumbs="true">
							<div class="flexslider">
								<div class="slider-wrap" data-lightbox="gallery">
									<?php
										foreach($images as $image){
									?>
										<div class="slide" data-thumb="<?=site_url('images/voucher/' . $image['image_url'])?>">
											<a href="" title="<?=$title?>" data-lightbox="gallery-item">
												<img src="<?=site_url('images/voucher/' . $image['image_url'])?>" alt="<?=$title?>">
											</a>
										</div>
									<?php
										}
									?>
								</div>
							</div>
						</div>
						<div class="sale-flash">50% Off*</div>
						<div class="stock-flash">Sold 78</div>
					</div><!-- Product Single - Gallery End -->

					<!-- Product Single - Meta
					============================================= -->
					<div class="panel panel-default events-meta">
						<div class="panel-heading">
							<h3 class="panel-title">Merchant</h3>
						</div>
						<?php
							foreach($details as $detail){
						?>
							<div class="panel-body">
								<ul class="iconlist nobottommargin">
									<li><i class="icon-shop"></i> <?=$detail['merchant_name']?></li>
									<li><i class="icon-map-marker2"></i> <?=$detail['city']?></li>
									<li><i class="icon-phone3"></i> <strong><?=$detail['phone_number']?></strong></li>
								</ul>
							</div>
						<?php
							}
						?>
					</div><!-- Product Single - Meta End -->

					<!-- Count time
					============================================= -->

					<div class="entry-overlay bottommargin">
						<h4><span>Waktu Tersisa</span></h4><div id="event-countdown" class="countdown"></div>
					</div>
					<script>
						jQuery(document).ready( function($){
							var eventStartDate = new Date();
							eventStartDate = new Date(2016, 2, 31);
							$('#event-countdown').countdown({until: eventStartDate});
						});
					</script>

					<!-- Product Single - Share
					============================================= -->
					<div class="si-share noborder clearfix">
						<span>Share:</span>
						<div>
							<a href="#" class="social-icon si-borderless si-facebook">
								<i class="icon-facebook"></i>
								<i class="icon-facebook"></i>
							</a>
							<a href="#" class="social-icon si-borderless si-twitter">
								<i class="icon-twitter"></i>
								<i class="icon-twitter"></i>
							</a>
						</div>
					</div><!-- Product Single - Share End -->

					

				</div> <!-- End col_two_fifth -->

				<div class="col_two_fifth product-desc">

					<!-- Product Single - Price
					============================================= -->
					<div class="product-price"><del><?=$details[0]['normal_price_fmt']?></del> <ins><?=$details[0]['price_fmt']?></ins></div><!-- Product Single - Price End -->

					<div class="clear"></div>
					<div class="line"></div>

					<!-- Product Single - Quantity & Cart Button
					============================================= -->
					<form class="cart nobottommargin clearfix" method="get" action="<?=site_url('tx/order_confirmation')?>">
						<input type="hidden" name="id" value="<?=$voucher_id?>" />
						<button type="submit" class="add-to-cart button nomargin">BELI</button>
					</form><!-- Product Single - Quantity & Cart Button End -->

					<div class="clear"></div>
					<div class="line"></div>

					<!-- Product Single - Short Description
					============================================= -->
					<p><?=$description?></p>

					<!-- Google Maps
					============================================= -->

					<section id="google-map" class="gmap" style="height: 290px;"></section>

						<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
						<script type="text/javascript" src="js/jquery.gmap.js"></script>

						<script type="text/javascript">

							jQuery('#google-map').gMap({

								address: 'Melbourne, Australia',
								maptype: 'ROADMAP',
								zoom: 14,
								markers: [
									{
										address: "Melbourne, Australia",
										html: '<div style="width: 300px;"><h4 style="margin-bottom: 8px;">Hi, we\'re <span>Envato</span></h4><p class="nobottommargin">Our mission is to help people to <strong>earn</strong> and to <strong>learn</strong> online. We operate <strong>marketplaces</strong> where hundreds of thousands of people buy and sell digital goods every day, and a network of educational blogs where millions learn <strong>creative skills</strong>.</p></div>',
										icon: {
											image: "images/map-icon-red.png",
											iconsize: [32, 39],
											iconanchor: [32,39]
										}
									}
								],
								doubleclickzoom: false,
								controls: {
									panControl: true,
									zoomControl: true,
									mapTypeControl: true,
									scaleControl: false,
									streetViewControl: false,
									overviewMapControl: false
								}

							});

						</script> <!-- End Google Maps -->

				</div> <!-- col_two_fifth product-desc -->

				<div class="col_one_fifth col_last">

					<a href="#" title="Brand Logo" class="hidden-xs"><img class="image_fade" src="images/shop/brand.jpg" alt="Brand Logo"></a>

					<div class="divider divider-center"><i class="icon-circle-blank"></i></div>

					<div class="feature-box fbox-plain fbox-dark fbox-small">
						<div class="fbox-icon">
							<i class="icon-thumbs-up2"></i>
						</div>
						<h3>100% Original</h3>
						<p class="notopmargin">We guarantee you the sale of Original Brands.</p>
					</div>

					<div class="feature-box fbox-plain fbox-dark fbox-small">
						<div class="fbox-icon">
							<i class="icon-credit-cards"></i>
						</div>
						<h3>Payment Options</h3>
						<p class="notopmargin">We accept Visa, MasterCard and American Express.</p>
					</div>

					<div class="feature-box fbox-plain fbox-dark fbox-small">
						<div class="fbox-icon">
							<i class="icon-truck2"></i>
						</div>
						<h3>Free Shipping</h3>
						<p class="notopmargin">Free Delivery to 100+ Locations on orders above $40.</p>
					</div>

					<div class="feature-box fbox-plain fbox-dark fbox-small">
						<div class="fbox-icon">
							<i class="icon-undo"></i>
						</div>
						<h3>30-Days Returns</h3>
						<p class="notopmargin">Return or exchange items purchased within 30 days.</p>
					</div>

				</div>

				<div class="col_full nobottommargin">

					<div class="tabs clearfix nobottommargin" id="tab-1">

						<ul class="tab-nav clearfix">
							<li><a href="#tabs-1"><i class="icon-align-justify2"></i><span class="hidden-xs"> Promo Info</span></a></li>
							<li><a href="#tabs-2"><i class="icon-check"></i><span class="hidden-xs"> Highlights</span></a></li>
							<li><a href="#tabs-3"><i class="icon-info-sign"></i><span class="hidden-xs"> Conditions</span></a></li>
						</ul>

						<div class="tab-container">

							<div class="tab-content clearfix" id="tabs-1">
								<p><?=$info?></p>
							</div><!-- Promo info tab end -->

							<div class="tab-content clearfix" id="tabs-2">
								<?=$highlight?>
							</div> <!-- Highlights tab end -->

							<div class="tab-content clearfix" id="tabs-3">
								<?=$voucher_condition?>
							</div> <!-- Conditions tab end -->

						</div> <!-- Tab container end -->

					</div>

				</div>

			</div>

		</div>

		<div class="clear"></div><div class="line"></div>

		<div class="col_full nobottommargin">

			<div class="fancy-title title-border-color">
				<h3><span>Deal Lainnya</span></h3>
			</div>	

			<div class="col-md-3 bottommargin-lg">
				<div class="feature-box center media-box fbox-bg">
					<div class="fbox-media">
						<img src="images/1.jpg" alt="Image">
					</div>
					<div class="sale-flash">50% Off*</div>
					<div class="stock-flash">Sold 78</div>
					<div class="fbox-desc">
						<h3>Men's Footwear<span class="subtitle">
							<div class="product-price">
								<del>$24.99</del> <ins>$12.49</ins>
							</div>
							</span>
						</h3>
						<p><a href="detail-product.html" class="btn btn-default">Detail</a></p>
					</div>
				</div>
			</div>

			<div class="col-md-3 bottommargin-lg">
				<div class="feature-box center media-box fbox-bg">
					<div class="fbox-media">
						<img src="images/1.jpg" alt="Image">
					</div>
					<div class="stock-flash">Sold 36</div>
					<div class="fbox-desc">
						<h3>Men's Footwear<span class="subtitle">
							<div class="product-price">$39.99</div>
							</span>
						</h3>
						<p><a href="detail-product.html" class="btn btn-default">Detail</a></p>
					</div>
				</div>
			</div>

			<div class="col-md-3 bottommargin-lg">
				<div class="feature-box center media-box fbox-bg">
					<div class="fbox-media">
						<img src="images/1.jpg" alt="Image">
					</div>
					<div class="sale-flash">50% Off*</div>
					<div class="stock-flash">Sold 98</div>
					<div class="fbox-desc">
						<h3>Men's Footwear<span class="subtitle">
							<div class="product-price">
								<del>$24.99</del> <ins>$12.49</ins>
							</div>
							</span>
						</h3>
						<p><a href="detail-product.html" class="btn btn-default">Detail</a></p>
					</div>
				</div>
			</div>

			<div class="col-md-3 bottommargin-lg">
				<div class="feature-box center media-box fbox-bg">
					<div class="fbox-media">
						<img src="images/1.jpg" alt="Image">
					</div>
					<div class="sale-flash">50% Off*</div>
					<div class="stock-flash">Sold 98</div>
					<div class="fbox-desc">
						<h3>Men's Footwear<span class="subtitle">
							<div class="product-price">
								<del>$24.99</del> <ins>$12.49</ins>
							</div>
							</span>
						</h3>
						<p><a href="detail-product.html" class="btn btn-default">Detail</a></p>
					</div>
				</div>
			</div>

		</div> <!-- End voucher Deal Terbaru -->

	</div>

</div>