<?php get_header(); ?>


	<div class="container">
		<div class="single-content">
			<?php 
				if(have_posts()):

					while(have_posts()): the_post(); 
			?>

						<article id="post-<?php the_ID(); ?>" <?php post_class('image-format no-solutions'); ?>>
							<?php if( has_post_thumbnail() ):
									$urlImg = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
								endif; 
							?>
							<div class="single-image" style="background-image: url(<?php echo $urlImg; ?>);"></div>
							<?php the_title('<h3>', '</h3>'); ?>
							<hr>
							<?php the_content('<h3 class="image-text">', '</h3>'); ?>
							<hr>
						</article>

			<?php

						//echo photography_post_navigation();//post navigation. //the_post_navigation(); changed to photography_post_navigation(); function from theme-support.php

					endwhile;

				endif;
			?>
		</div><!-- .single -->
	</div><!-- .container -->


<?php get_footer(); ?>