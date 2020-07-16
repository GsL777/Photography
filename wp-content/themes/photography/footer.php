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

				<?php 
					$args = array(
						'type'				=> 'post',
						'order'				=> 'ASC',
						'category_name'		=> 'About',
						'posts_per_page'	=> 1
					);

					$blogLoop = new WP_Query($args);

					if( $blogLoop->have_posts() ):
						
						while( $blogLoop->have_posts() ): $blogLoop->the_post();
				
							the_title('<h6 class="footer-title text-uppercase mb-4 font-weight-bold">', '</h6>');

							the_content();

						endwhile;

					endif;

					wp_reset_postdata(); //ensures that the global $post has been restored to the current post in the main query. (USE immediately after every custom WP_Query()).

					//wp_reset_query() - ensure that the main query has been reset to the original main query. (USE wp_reset_query() - immediately after every loop using query_posts()).
				?>

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
						<i class="fa fa-home mr-3"></i> Address, 10012, UK
					</p>
					<p>
						<i class="fa fa-envelope mr-3"></i> info@gmail.com
					</p>
					<p>
						<i class="fa fa-phone mr-3"></i> + 01 234 567 88
					</p>
				</div><!-- .col-xl-3 -->
			</div><!-- .row -->


			<hr>


			<div class="row d-flex align-items-center">
				<div class="col-lg-6 col-md-6">
					<p class="text-center text-md-left"><strong>&copy; 2020 - <?php echo year(); //function in theme-support.php ?> Copyright</strong>
					</p>
				</div><!-- .col-lg-6 -->

				<div class="col-lg-6 col-md-6 footer-style">
					<?php echo social_btn();//function in theme-support.php ?><!-- .socials -->
				</div><!-- .col-lg-6 -->
		    </div><!-- .row -->
		</div><!-- .container -->
	</footer>


	<?php wp_footer(); ?>
	</body>
</html>