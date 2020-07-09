<article id="post-<?php the_ID(); ?>" <?php post_class('archive'); ?>>

	<header class="entry-header">
		<?php the_title( sprintf('<h1 class="entry-title"><a href="%s">', esc_url(get_permalink() ) ),'</a> </h1>' ); ?>

		<small>Posted on: <?php the_time('F j, Y'); ?> at <?php the_time('g:i, a'); ?>, in<?php the_category(); ?></small>
	</header>


	<div class="row">
		<?php if(has_post_thumbnail() ): ?>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

					<?php if( photography_get_attachment()  ): //photography_get_attachment() function in theme-support.php
					//GO TO WP DASBOARD -> MEDIA -> SELECT LIST ICON ON THE LEFT AND UNATTACH ALL OF THE IMAGES. THAN GO TO POSTS -> SELECT A POST -> ADD MEDIA -> SELECT A PICTURE -> INSERT PHOTO -> MAKE SURE IT IS UNDER THE TEXT -> UPDATE. IF IT DOESN'T WORK REUPLOAD AN IMAGE.
					?>

						<div class="thumbnail">
							<?php the_post_thumbnail(''); ?>
						</div><!-- .thumbnail -->

						<div class="images" style="background-image: url(<?php echo photography_get_attachment(); ?>);"></div><!-- .images -->

						<div class="entry-content">
							<?php the_excerpt(); ?>
						</div><!-- .col-sm-8 -->

					<?php endif; ?>

			</div><!-- .col-sm-4 -->


		<?php else: ?>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<?php the_excerpt(); ?>
			</div><!-- .col-xs-12 -->

		<?php endif; ?>
	</div><!-- .row -->

</article>