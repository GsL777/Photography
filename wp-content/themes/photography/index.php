<?php
/*
	@package photography-theme
*/

get_header(); ?>

	<div id="primary" class="content-main">
		<main id="main" class="site-main" role="main">

			<div class="container ">
				<div class="row">
					<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 photography-posts-container"> <!-- .photography-posts-container - custom class to have a place to print a post. Used in photography.js-->
						
					<?php 
					if( have_posts() ):
						while( have_posts() ): the_post();

							get_template_part( 'template-parts/content', get_post_format() );//template-part - folder where are all the content files. get-template-part function will search a folder template-parts and files with start content- .
							//get_post_format() - retrieve the_post_format of the current post that is in the post loop.

						endwhile;
					endif;
					?>

					</div><!-- .col-lg-8 -->

					<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 sidebar-design">
						<?php get_sidebar(); ?>
					</div><!-- .col-lg-4 -->


				</div><!-- .row -->
			</div><!-- .container -->


			<div class="container text-center"><!--  In WP dashboard -> Settings -> Reading -> Set the number of posts -->
				<a class="btn-photography-load photography-load-more" data-page="1" data-url="<?php echo admin_url('admin-ajax.php'); ?>">
					<span class="photography-icon photography-loading dashicons dashicons-image-rotate"></span><!-- Use span inside <a><a/> not to override any classes or not to trigger any error  -->
					<span class="text">Load More</span><!--  text in mega-menu.js  -->
				</a>
			</div><!-- .container -->

		</main>
	</div><!-- #primary -->


<?php get_footer(); ?>