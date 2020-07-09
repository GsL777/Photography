<?php 
	/*
		This is the template for the footer

		@package photography-theme
	*/
?>

<footer class="footer">
	<div class="container text-center text-md-left">
		<div class="row text-center text-md-left mt-3 pb-3">

			<div class="col-xl-3 col-lg-3 col-md-3 mx-auto mt-3">
				<h6 class="footer-title text-uppercase mb-4 font-weight-bold">Photography</h6>
				<p>Professional photography services for your daily use, websites, marketing purposes. We are high quality photography team that will capture top quality product. By your request we can make a high resolution image album.</p>
			</div><!-- .col-xl-3 -->

      
			<div class="col-xl-2 col-lg-2 col-md-3 mx-auto mt-3">
				<h6 class="footer-title text-uppercase mb-4 font-weight-bold">Useful links</h6>
				<?php 
					wp_nav_menu(
						array(
							'theme_location'	=> 'secondary',//theme_location - has to be the same name as specified in functions.php (register_nav_menu (first value - string $location)).
							'menu_class'		=> 'links'
						)
					);
				?>
			</div><!-- .col-xl-2 -->


			<!-- <hr class="w-100 clearfix d-md-none"> -->


			<div class="col-xl-3 col-lg-3 col-md-4 mx-auto mt-3">
				<h6 class="footer-title text-uppercase mb-4 font-weight-bold">Contact</h6>
				<p>
					<i class="fa fa-home mr-3"></i> Address, 10012, UK</p>
				<p>
					<i class="fa fa-envelope mr-3"></i> info@gmail.com</p>
				<p>
					<i class="fa fa-phone mr-3"></i> + 01 234 567 88</p>
			</div><!-- .col-xl-3 -->
		</div><!-- .row -->
    

		<hr>


		<div class="row d-flex align-items-center">
			<div class="col-lg-6 col-md-7">
				<p class="text-center text-md-left"><strong>&copy; 2020 Copyright</strong>
				</p>
			</div><!-- .col-lg-6 -->

			<div class="col-lg-6 col-md-5">
				<div class="socials">
					<i class="fa fa-facebook fa-2x" aria-hidden="true"></i>
					<i class="fa fa-twitter fa-2x" aria-hidden="true"></i>
					<i class="fa fa-linkedin fa-2x" aria-hidden="true"></i>
					<i class="fa fa-instagram fa-2x" aria-hidden="true"></i>
				</div><!-- .socials -->
			</div><!-- .col-lg-6 -->
	    </div><!-- .row -->
	</div><!-- .container -->
</footer>

	<?php wp_footer(); ?>
	</body>
</html>