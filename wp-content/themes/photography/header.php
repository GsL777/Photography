<?php 
	/*
		This is the template for the header

		@package photography-theme
	*/
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<title><?php bloginfo('name'); ?><?php wp_title('|'); ?></title><!-- To set a page title go to dashboard Settings -> General -> write in a Site Title a title. It can be seen with an inspect -->
	<meta name="description" content="<?php bloginfo('description'); ?>">
	<meta charset="<?php bloginfo( 'charset' ); //print the bloginfo charset?>">
	<meta name="viewport" content="width=device-width, initial-scale=1"><!-- for responsive devices to print full screen -->
	<link rel="profile" href="http://gmpg.org/xfn/11"> <!-- necessary for html5 validation  -->
	<?php if( is_singular() && pings_open( get_queried_object() ) ): //check if this page is not an archive, search result or generic blog loop ?>
		<link rel="pingback" href="<?php bloginfo('pingback_url'); //pingback_url - for page to scale up on search engine result page (SERP)?>">
	<?php endif; ?>
	<?php wp_head(); ?>
</head>

	<?php 
		//ON WORDPRESS DASHBOARD -> Photography -> CUSTOM CSS a custom css code could be written
		$custom_css = esc_attr(get_option( 'website_css' ));//website_css - unique handler from function-admin.php //Custom CSS Options
		if(!empty($custom_css) ):
			echo '<style>' . $custom_css . '</style>';
		endif;
	?>

	<body <?php body_class(); //body_class(); - WP prints automatically to what style is used?>>

	<!-- TURN OFF DASHBOARD ON WEBSITE(TO MAKE WEBSITE FASTER): WP dashboard -> Users -> Admin -> Uncheck Toolbar 'Show Toolbar when viewing site'-->

	<header id="masthead" class="site-header" role="banner">

		<div class="container-fluid p-0">
			<nav id="site-navigation" class="navbar navbar-expand-lg navbar-light mega-menu navbar-megamenu" role="navigation">

				<div class="container-fluid">

					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="navbar-name" rel="home">
						<img src="http://localhost/Photography/wp-content/themes/photography/assets/img/ar-camera.png" alt="" />
					</a>

					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#megaMenu" aria-controls="megaMenu" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>

					<div class="collapse navbar-collapse" id="megaMenu">
						<?php 
							if ( has_nav_menu( 'primary' ) ) :
								wp_nav_menu(
									array(
										'theme_location'	=> 'primary',
										'container'			=> false,
										'menu_class'		=> 'nav navbar-nav ml-auto',
										'walker'			=> new Walker_Nav_primary()
									)
								);
							endif;
						?>
					</div><!-- .collapse -->
				</div><!-- .container-fluid -->
			</nav>
		</div><!-- .container-fluid -->
	</header>

	<div class="header" style="background-image: url(<?php header_image(); //header_image(); - php built in function automatically prints the header image. Write a function design_register_nav_menu in theme-support.php before adding image in WP dashboard -> Appearance -> Header ?>);">
		<h2><?php bloginfo( 'name' ); //prints info from WP Dashboard -> Settings -> General -> Site Title ?></h2> 
		<h4><b><?php bloginfo( 'description' ); //prints info from WP Dashboard -> Settings -> General -> Tagline?></b></h4>
	</div><!-- .header -->

	<!-- <img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" /> -->