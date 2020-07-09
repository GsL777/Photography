<?php get_header(); ?>

<div class="container archive-main">
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
			<div class="text-center no-margin">

				<?php if(have_posts() ): ?>
					
					<header class="page-header">
						<?php 
							the_archive_title('<h1 class="page-title">', '</h1>');
							the_archive_description('<div class="taxonomy-description">', '</div>');
						?>
					</header>

					<?php while(have_posts()): the_post(); ?>

						<?php get_template_part('template-parts/content', 'archive'); ?>

					<?php endwhile; ?>

				<?php endif; ?>

			</div><!-- .row -->
		</div><!-- .col-lg-8 -->

		<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<?php get_sidebar(); //sidebar in WP Dashboard ->Appearance -> widget. function sidebar_widget_setup() in theme-support.php?>
		</div><!-- .col-lg-4 -->

	</div><!-- .row -->
</div><!-- .container -->

<?php get_footer(); ?>