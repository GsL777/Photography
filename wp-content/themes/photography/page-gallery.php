<?php get_header(); ?>

<div id="primary-gallery" class="content-gallery">

	<section class="gallery">

		<div class="container">
			<h4 class="title text-center">Gallery</h4>

			<div class="row">

		<?php 

		$currentPage = (get_query_var('paged')) ? get_query_var('paged') : 1;

		$args = array(
			'order' => 'ASC',
			'category_name'=> 'Gallery',
			'posts_per_page' => 6, 
			'paged' => $currentPage
		);

		query_posts($args);

		if(have_posts() ): 

			$i = 0;

			while( have_posts() ): the_post(); ?>
			
			<?php 
				if($i == 0): $column = 12; 
				elseif($i > 0 && $i <= 2): $column = 6;
				elseif($i > 1 && $i <= 3): $column = 12;
				elseif($i > 3): $column = 6;
				endif;
			?>

				<div class="col-lg-<?php echo $column; ?> col-md-<?php echo $column; ?> col-sm-12 col-xs-12">
					<?php if( has_post_thumbnail() ):
						$urlImg = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
					endif; ?>
					<div class="images" style="background-image: url(<?php echo $urlImg; ?>);"></div>
				</div><!-- .col-lg-12 -->

			<?php 
			$i++; 
			endwhile;
			?>

		<?php 
			endif;
			wp_reset_query();
		?>	

			</div><!-- .row -->
		</div><!-- .container -->
	</section>
</div><!-- #primary-gallery -->

<?php get_footer(); ?>