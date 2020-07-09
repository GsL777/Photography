<?php get_header(); ?>

	<div id="primary-about" class="content-about">
		
		<section class="about">
			<div class="container">

				<h2 class="title text-center">About</h2>

				<div class="row">

				<?php 
					$args = array(
							'type'				=> 'post',
							'order'				=> 'ASC',
							'category_name'		=> 'about',
							'posts_per_page'	=> 1
						);

					$blogLoop = new WP_Query($args);

					if( $blogLoop->have_posts() ):
						
						while( $blogLoop->have_posts() ): $blogLoop->the_post();

						if( has_post_thumbnail() ):
							$urlImg = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
						endif; ?>

					

						<?php if( has_post_thumbnail() ): ?>

							<?php if( photography_get_attachment() ): //photography_get_attachment() function in theme-support.php
							//GO TO WP DASBOARD -> MEDIA -> SELECT LIST ICON ON THE LEFT AND UNATTACH ALL OF THE IMAGES. THAN GO TO POSTS -> SELECT A POST -> ADD MEDIA -> SELECT A PICTURE -> INSERT PHOTO -> MAKE SURE IT IS UNDER THE TEXT -> UPDATE. IF IT DOESN'T WORK REUPLOAD AN IMAGE.
							?>
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

								<div class="images" style="background-image: url(<?php echo photography_get_attachment(); ?>);"></div><!-- .images -->
								
								<?php the_content(); ?>

								<!-- <div class="images" style="background-image: url(<?php echo $urlImg; ?>);"></div><!-- .images -->
							</div><!-- .col-lg-6 -->

							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<div class="entry-content">
									<?php the_excerpt(); ?>
								</div>
							</div><!-- .col-lg-6 -->

							<?php endif;

						else: ?>

							<div class="entry-excerpt">
								<?php the_excerpt(); ?>
							</div>

						<?php endif; ?>

				<?php
						endwhile;

					endif;

					wp_reset_postdata(); //ensures that the global $post has been restored to the current post in the main query. (USE immediately after every custom WP_Query()).

					//wp_reset_query() - ensure that the main query has been reset to the original main query. (USE wp_reset_query() - immediately after every loop using query_posts()).
				?>

					</div><!-- .col-lg-6 -->
				</div><!-- .row -->	
			</div><!-- .container -->
		</section>

	</div><!-- #primary-about -->


<?php get_footer(); ?>