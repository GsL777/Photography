<?php get_header(); ?>


	<div id="primary-contact" class="content-contact">

		<div class="container">

			<h2 class="title text-center">Contact</h2>
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 input-form">

					<?php 
						$args = array(
							'page_id'	=> '68'
						);

						$lastBlog = new WP_Query($args);

						if( $lastBlog->have_posts() ):
							
							while( $lastBlog->have_posts() ): $lastBlog->the_post();

								// get_template_part('template-parts/content', 'page');
					?>

								<article id="post-<?php the_ID(); ?>" class="<?php post_class(); ?>">
									<div class="entry-content">
										<?php the_content(); ?>
									</div><!-- .entry-content -->
								</article>

					<?php 
							endwhile;

						endif;

						wp_reset_postdata();
					?>

				</div><!-- .col-lg-6 -->

				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="map">
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d8353.041162467309!2d-0.08168484082637376!3d51.50635428155449!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48760349331f38dd%3A0xa8bf49dde1d56467!2sLondono%20Taueris!5e0!3m2!1slt!2suk!4v1592759720917!5m2!1slt!2suk" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
					</div>
				</div><!-- .col-lg-6 -->
			</div><!-- .row -->
		</div><!-- .container -->

	</div><!-- .primary-contact -->


<?php get_footer(); ?>