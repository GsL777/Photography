<?php
/*

	@package photography-theme

	==========================================
		STANDARD POST FORMAT
	==========================================

*/

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('studio-format-standard'); ?>><!-- if a WordPress has the get_ in front of a function it needs an echo, in this case  insert the_ID(); -->
	<header class="entry-header text-center">
		
		<?php the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>'); // escape the url because we are inside the function so we don't whant to print?>

	</header>

	<div class="entry-content">

		<?php if( has_post_thumbnail() ): ?>

			<div class="thumbnail">
				<?php the_post_thumbnail(''); ?>
			</div><!-- .thumbnail -->

			<div class="entry-content text-center">
				<?php the_content(); ?>
			</div>

		<?php else: ?>

			<div class="entry-excerpt text-center">
				<?php the_excerpt(); ?>
			</div>

		<?php endif; ?>

	</div><!-- .entry-content -->

</article><!-- standard WordPress markup -->

