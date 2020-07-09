<?php
/*

	@package photography-theme

	==========================================
		IMAGE POST FORMAT
	==========================================

*/
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('studio-format-image'); ?>>

		<header class="entry-header text-center">

			<?php the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>'); // escape the url because we are inside the function so we dont whant to print?>

		</header>

		<?php //the_title('<h3 class="text-center text-photography">', '</h3>'); ?>

		<?php if( has_post_thumbnail() ): ?>

			<?php if( photography_get_attachment() ): //photography_get_attachment() function in theme-support.php
			//GO TO WP DASBOARD -> MEDIA -> SELECT LIST ICON ON THE LEFT AND UNATTACH ALL OF THE IMAGES. THAN GO TO POSTS -> SELECT A POST -> ADD MEDIA -> SELECT A PICTURE -> INSERT PHOTO -> MAKE SURE IT IS UNDER THE TEXT -> UPDATE. IF IT DOESN'T WORK REUPLOAD AN IMAGE.
			?>

				<div class="thumbnail">
					<?php the_post_thumbnail(''); ?>
				</div><!-- .thumbnail -->

				<div class="images" style="background-image: url(<?php echo photography_get_attachment(); ?>);"></div><!-- .images -->

				<div class="entry-content text-center">
					<?php the_content(); ?>
				</div> 

			<?php endif;

		else: ?>

			<div class="entry-excerpt text-center">
				<?php the_excerpt(); ?>
			</div>

		<?php endif; ?>

	</article><!-- standard WordPress markup -->
