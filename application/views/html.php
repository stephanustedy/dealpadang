<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="Dealpadang" />

	<!-- Stylesheets
	============================================= -->
	<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.css'); ?>" type="text/css" />
	<link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>" type="text/css" />
	<link rel="stylesheet" href="<?= base_url('assets/css/dark.css'); ?>" type="text/css" />
	<link rel="stylesheet" href="<?= base_url('assets/css/font-icons.css'); ?>" type="text/css" />
	<link rel="stylesheet" href="<?= base_url('assets/css/animate.css'); ?>" type="text/css" />
	<link rel="stylesheet" href="<?= base_url('assets/css/magnific-popup.css'); ?>" type="text/css" />

	<?php 
		if(isset($append_css)){
			foreach($append_css as $k => $v) {
			?>
				<link rel="stylesheet" href="<?= $v ?>" type="text/css" />
			<?php
			}
		}
	?>

	<link rel="stylesheet" href="<?= base_url('assets/css/responsive.css'); ?>" type="text/css" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<!--[if lt IE 9]>
		<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
	<![endif]-->

	<!-- External JavaScripts
	============================================= -->
	<script type="text/javascript" src="<?= base_url('assets/scripts/jquery.js'); ?>"></script>
	<script type="text/javascript" src="<?= base_url('assets/scripts/plugins.js'); ?>"></script>
	


	<!-- Document Title
	============================================= -->
	<title>Login</title>

</head>

<body class="stretched">
	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">

		<!-- Top Bar
		============================================= -->
		<div id="top-bar" class="bgcolor dark">

			<div class="container clearfix">

				<div class="col_half nobottommargin hidden-xs" style="color:white;">

					<p class="nobottommargin"><strong>Call:</strong> 1800-547-2145 | <strong>Email:</strong> info@Dealpadang.com</p>

				</div>

				<div class="col_half col_last fright nobottommargin">

					<!-- Top Links
					============================================= -->
					<div class="top-links">
						<ul>
							<li>
								<?php if(isset($login_url)){ ?>
									<a href="<?=$login_url?>" style="color:white;">Login &nbsp;/&nbsp; Register</a>
								<?php } else if(isset($logout_url)){ ?>
									<a href="<?=$logout_url?>" style="color:white;">Logout</a>
									<?php  }?>
							</li>
						</ul>
					</div><!-- .top-links end -->

				</div>

			</div>

		</div><!-- #top-bar end -->

		<!-- Header
		============================================= -->
		<header id="header">

			<div id="header-wrap">

				<div class="container clearfix">

					<div id="primary-menu-trigger"><i class="icon-reorder"></i></div>

					<!-- Logo
					============================================= -->
					<div id="logo">
						<a href="scratch.html" class="standard-logo" data-dark-logo="<?= base_url('assets/images/logo-dark.png'); ?> "><img src="<?= base_url('assets/images/logo.png'); ?> " alt="Canvas Logo"></a>
						<a href="scratch.html" class="retina-logo" data-dark-logo="<?= base_url('assets/images/logo-dark@2x.png'); ?> "><img src="<?= base_url('assets/images/logo@2x.png'); ?> " alt="Canvas Logo"></a>
					</div><!-- #logo end -->

					<!-- Primary Navigation
					============================================= -->
					<nav id="primary-menu">

						<ul>
							<li <?=base_url(uri_string()) == site_url('')? 'class="current"' : ''?>><a href="<?=site_url('')?>"><div>Semua Deal</div></a></li>
							<li <?=base_url(uri_string()) == site_url('voucher/browse/restaurant')? 'class="current"' : ''?>>
								<a href="<?=site_url('voucher/browse/restaurant')?>"><div>Voucher Makan</div></a>
							</li>
							<li <?=base_url(uri_string()) == site_url('voucher/browse/product')? 'class="current"' : ''?>>
								<a href="<?=site_url('voucher/browse/product')?>"><div>Produk</div></a>
							</li>
							<li>
								<a href="#"><div>FAQ</div></a>
							</li>
							<li>
								<a href="#"><div>Mitra Deal</div></a>
							</li>
						</ul>

					

						<!-- Top Search
						============================================= -->
						<div id="top-search">
							<a href="#" id="top-search-trigger"><i class="icon-search3"></i><i class="icon-line-cross"></i></a>
							<form action="<?=site_url('voucher/search')?>" method="get">
								<input type="text" name="q" class="form-control" value="" placeholder="Cari Promo &amp; Tekan Enter..">
							</form>
						</div><!-- #top-search end -->

					</nav><!-- #primary-menu end -->

				</div>

			</div>

		</header><!-- #header end -->

		<!-- Top Bar
		============================================= -->
		<div>

			<div class="container clearfix">

				<div class="col_half">

					<!-- Top Links
					============================================= -->
					<div class="top-links">
						<ul class="header-extras">
							<li>
								<i class="i-medium i-circled i-bordered icon-thumbs-up2 nomargin"></i>
								<div class="he-text">
									Original Brands
									<span>100% Guaranteed</span>
								</div>
							</li>
							<li>
								<i class="i-medium i-circled i-bordered icon-truck2 nomargin"></i>
								<div class="he-text">
									Free Shipping
									<span>for $20 or more</span>
								</div>
							</li>
							<li>
								<i class="i-medium i-circled i-bordered icon-undo nomargin"></i>
								<div class="he-text">
									30-Day Returns
									<span>Completely Free</span>
								</div>
							</li>
						</ul>
					</div><!-- .top-links end -->

				</div>

			</div>

		</div><!-- #top-bar end -->

		
		<!-- Content
		============================================= -->
		<section id="content">
			<?= $content; ?>
		</section><!-- #content end -->

		<!-- Footer
		============================================= -->
		<footer id="footer" class="dark">

			<div class="container">

				<!-- Footer Widgets
				============================================= -->
				<div class="footer-widgets-wrap clearfix">

					<div class="col-md-12">

						<div class="col-md-4">

							<div class="widget clearfix">

								<img src="<?= base_url('assets/images/footer-widget-logo.png'); ?> " alt="" class="footer-logo">

								<p>We believe in <strong>Simple</strong>, <strong>Creative</strong> &amp; <strong>Flexible</strong> Design Standards.</p>

								<div style="background: url('<?= base_url('assets/images/world-map.png'); ?>') no-repeat center center; background-size: 100%;">
									<address>
										<strong>Headquarters:</strong><br>
										795 Kampung Duren<br>
										Padang, Indonesia<br>
									</address>
									<abbr title="Phone Number"><strong>Phone:</strong></abbr> (91) 8547 632521<br>
									<abbr title="Fax"><strong>Fax:</strong></abbr> (91) 11 4752 1433<br>
									<abbr title="Email Address"><strong>Email:</strong></abbr> info@Dealpadang.com
								</div>

							</div>

						</div>

						<div class="col-md-4">

							<div class="widget widget_links clearfix">

								<h4>Blogroll</h4>

								<ul>
									<li><a href="http://codex.wordpress.org/">Documentation</a></li>
									<li><a href="http://wordpress.org/support/forum/requests-and-feedback">Feedback</a></li>
									<li><a href="http://wordpress.org/extend/plugins/">Plugins</a></li>
									<li><a href="http://wordpress.org/support/">Support Forums</a></li>
									<li><a href="http://wordpress.org/extend/themes/">Themes</a></li>
									<li><a href="http://wordpress.org/news/">WordPress Blog</a></li>
									<li><a href="http://planet.wordpress.org/">WordPress Planet</a></li>
								</ul>

							</div>

						</div>

					

						<div class="col-md-4">
					

							<div class="widget clearfix" style="margin-bottom: -20px;">
							

								<div class="divider divider-border divider-center"><i class="icon-like"></i></div>

								<div class="row">

									<div class="col-md-6 clearfix bottommargin-sm">
										<a href="#" class="social-icon si-dark si-colored si-facebook nobottommargin" style="margin-right: 10px;">
											<i class="icon-facebook"></i>
											<i class="icon-facebook"></i>
										</a>
										<a href="#"><small style="display: block; margin-top: 3px;"><strong>Like us</strong><br>on Facebook</small></a>
									</div>
									<div class="col-md-6 clearfix">
										<a href="#" class="social-icon si-dark si-colored si-twitter nobottommargin" style="margin-right: 10px;">
											<i class="icon-twitter"></i>
											<i class="icon-twitter"></i>
										</a>
										<a href="#"><small style="display: block; margin-top: 3px;"><strong>Follow us</strong><br>on Twitter</small></a>
									</div>

								</div>
							</div>

						</div>

					</div>

				</div><!-- .footer-widgets-wrap end -->

			</div>

			<!-- Copyrights
			============================================= -->
			<div id="copyrights">

				<div class="container clearfix">

					<div class="col_half">
						Copyrights &copy; 2016 All Rights Reserved by Dealpadang.<br>
					</div>

					<div class="col_half col_last tright">
						<div class="fright clearfix">
							<a href="#" class="social-icon si-small si-borderless si-facebook">
								<i class="icon-facebook"></i>
								<i class="icon-facebook"></i>
							</a>

							<a href="#" class="social-icon si-small si-borderless si-twitter">
								<i class="icon-twitter"></i>
								<i class="icon-twitter"></i>
							</a>

							<a href="#" class="social-icon si-small si-borderless si-instagram">
								<i class="icon-instagram"></i>
								<i class="icon-instagram"></i>
							</a>						
						</div>

						<div class="clear"></div>

						<i class="icon-envelope2"></i> info@Dealpadang.com <span class="middot">&middot;</span> <i class="icon-headphones"></i> +91-11-6541-6369 <span class="middot">&middot;</span>
					</div>

				</div>

			</div><!-- #copyrights end -->

		</footer><!-- #footer end -->

	</div><!-- #wrapper end -->

	<!-- Go To Top
	============================================= -->
	<div id="gotoTop" class="icon-angle-up"></div>

	<!-- Footer Scripts
	============================================= -->
        <script type="text/javascript" src="<?= base_url('assets/scripts/functions.js'); ?>"></script>
        
        <script type="text/javascript">

		function calculate(obj){

			var sum = 0;
            var price = parseFloat($(obj).parent().parent().parent().find('.amount').text()) || 0;
            var quantity = parseInt($(obj).parent().find('.qty').val());
            var total = price * quantity;
           
            $(obj).parent().parent().parent().find('.total_amount').text(total);

            // total
            $('.total_amount').each(function() {
                sum += Number($(this).html());
            }); 

            $('#sum').html(sum);
        }

        function changeQuantity(num,obj){
            var value_to_set = parseInt($(obj).parent().find('.qty').val())+num;
            if(value_to_set<=0){$(obj).parent().find('.qty').val(0);return;}
            $(obj).parent().find('.qty').val( value_to_set);
        }

        $().ready(function(){
            $(".minus").click(function(obj){
	            changeQuantity(-1,this);
            	calculate(this);
            });

            $(".plus").click(function(){
                changeQuantity(1,this);
                calculate(this);
            });

			$(".qty").keyup(function(e){
				if (e.keyCode == 38) changeQuantity(1,this);
            		if (e.keyCode == 40) changeQuantity(-1,this);
            		calculate(this);
            });

        });

        function minmax(value, min, max) 
		{
		    if(parseInt(value) < min || isNaN(value)) 
		        return 0; 
		    else return value;
		}

	</script>
	
</body>
</html>