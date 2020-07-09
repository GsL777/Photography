<?php get_header(); ?>

<div class="container">
	<div class="row">
		<div class="col-lg-8 col-sm-7 col-xs-12">

			<div class="row">
				<?php 
					if(have_posts() ): 
						while(have_posts()): the_post(); ?>
						<?php get_template_part('template-parts/content', 'search'); ?>
						<?php endwhile;
					endif;
				?>
			</div><!-- .row -->

		</div> <!-- .col-lg-8 -->

		<div class="col-lg-4 col-sm-5 col-xs-12">
			<?php get_sidebar(); ?>
		</div><!-- .col-lg-4 -->
	</div><!-- .row -->
</div><!-- .container -->

<?php get_footer(); ?>