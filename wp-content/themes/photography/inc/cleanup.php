<?php 

/*
	@package photography-theme

	==================================================
		REMOVE GENERATOR VERSION NUMBER
	==================================================

*/

/* Remove version string from js and css */
function remove_wp_version_strings( $src ){

	global $wp_version;
	parse_str( parse_url($src, PHP_URL_QUERY), $query );//access the string and remove the version. PHP_URL_QUERY - checks for php version in the head. Whatever result is is parse_url it will be stored in $query.
	if (!empty( $query['ver'] ) && $query['ver'] === $wp_version ){ //ver - actual code in inspector link href and with [] we are accessing an array.
		$src = remove_query_arg('ver', $src);
	}
	return $src;
}

add_filter( 'script_loader_src', 'remove_wp_version_strings' ); //First value - filter that we whant to call (it calls all the scripts that we whant to call in the footer). Second value - function name.

add_filter( 'style_loader_src', 'remove_wp_version_strings' );

/* Remove metatag generator from header */
//REMOVES WORDPRESS VERSION (for safety reasons) FROM HEADER
function remove_meta_version(){
	return '';
}

add_filter( 'the_generator', 'remove_meta_version');//meta name="generator" so first parameter must be the_generator. Second parameter - function name (in this case modeling_remove_meta_version).

?>