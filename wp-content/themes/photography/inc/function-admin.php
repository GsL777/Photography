<?php 

/*
	@package photography-theme

	=====================
		ADMIN PAGE
	=====================
*/


function photography_add_admin_page(){

	//Generate photography Website Admin Page
	add_menu_page('Photography Website Theme Options', 'Photography', 'manage_options', 'photography_website', 'photography_theme_create_page', 'dashicons-editor-unlink', 110);//First parameter - Page title. Second parameter - menu title. Third parameter - Capability(capability to display options to specific users). Fourth parameter - menu slug(parameter that appears in the navigation bar to avoid errors). Fifth parameter - a function name. Sixth parameter - icon url(wordpress premade icons in https://developer.wordpress.org/resource/dashicons/#art) Need to choose the icon and paste the icon name to the Sixth parameter place. Seventh parameter - the position of a menu that specifies a location.

	//Generate Photography Admin Sub Pages
	//Photography Theme Options
	add_submenu_page('photography_website', 'Photography Theme Options', 'Theme Options', 'manage_options', 'photography_website', 'photography_theme_create_page');

	//Photography Contact Form Options
	add_submenu_page('photography_website', 'photography Contact Form', 'Contact Form', 'manage_options', 'photography_website_theme_contact', 'photography_contact_form_page');

	//Photography CSS Options
	add_submenu_page('photography_website', 'photography CSS Options', 'Custom CSS', 'manage_options', 'photography_website_css', 'photography_theme_settings_page');
}

add_action('admin_menu', 'photography_add_admin_page');//Activate this function. First value - when to trigger this function (in this case during the generation of admin_menu). Second value - the name of the function that must be triggered.

//Activate custom settings
add_action( 'admin_init', 'photography_custom_settings' );//adding into photography_add_admin_page, because of the safety precautions


//Activate custom settings
function photography_custom_settings(){

	//Theme Support Options
	register_setting('photography-theme-support', 'post_formats');

	add_settings_section( 'photography-theme-options', 'Theme Options', 'photography_theme_options', 'photography_website_theme' );

	add_settings_field( 'post_formats', 'Post Formats', 'photography_post_formats', 'photography_website_theme', 'photography-theme-options' );


	//Custom Header in Theme Support Options
	register_setting('photography-theme-support', 'custom_header');	

	add_settings_field('custom-header', 'Custom Header', 'photography_custom_header', 'photography_website_theme', 'photography-theme-options');


	//Custom Background in Theme Support Options
	register_setting('photography-theme-support', 'custom_background');
	
	add_settings_field('custom-background', 'Custom Background', 'photography_custom_background', 'photography_website_theme', 'photography-theme-options');


	//Contact Form Options
	register_setting( 'photography-contact-options', 'activate_contact' );//photography-contact-form.php and custom-post-type.php files.

	add_settings_section( 'photography-contact-section', 'Contact Form', 'photography_contact_section', 'photography_website_theme_contact' );

	add_settings_field( 'activate-form', 'Activate Contact Form', 'photography_activate_contact', 'photography_website_theme_contact', 'photography-contact-section' );

	//Custom CSS Options
	register_setting( 'photography-custom-css-options', 'website_css', 'photography_sanitize_custom_css');//photography-custom-css.php
	//PUT IN header.php that it will be displayed and will work.

	add_settings_section( 'photography-custom-css-section', 'Custom CSS', 'photography_custom_css_section_callback', 'photography_website_css' ); //photography_website_css - from function photography_add_admin_page(), //Photography CSS Options section.
	//photography-custom-css.php

	add_settings_field( 'custom-css', 'Insert your Custom CSS', 'photography_custom_css_callback', 'photography_website_css', 'photography-custom-css-section' );
}


//Post Formats
function photography_post_formats(){
	$options =  get_option( 'post_formats' );
	$formats = array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat');
	$output = '';
	foreach ($formats as $format){
		$checked = ( @$options[$format] == 1 ? 'checked' : '');//@ - means if this variable exists
		$output .= '<label><input type="checkbox" id="' . $format . '" name="post_formats['.$format.']" value="1" '. $checked .' />' . $format . '</label><br>';
	}
	echo $output;//in a callback function for specific settings field have to echo
}//dashboard -> Photography -> Theme Options to turn on or off in POSTS -> All posts -> Find post



function photography_custom_header(){
	$options = get_option( 'custom_header' );
	$output = '';

	$checked = ( @$options == 1 ? 'checked' : '' );
	echo '<label><input type="checkbox" id="custom_header" name="custom_header" value="1" '.$checked.' /> Activate the Custom Header</label>';
}//Activate a theme support in inc -> theme-support.php file



function photography_custom_background(){
	$options = get_option( 'custom_background' );
	$output = '';

	$checked = ( @$options == 1 ? 'checked' : '' );
	echo '<label><input type="checkbox" id="custom_background" name="custom_background" value="1" '.$checked.' /> Activate the Custom Background</label>';
}//Activate a theme support in inc -> theme-support.php file



//Photography Theme Options
function photography_theme_options(){
	echo 'Activate and Deactivate specific Theme Support Options';
}


//Contact Options Functions
function photography_contact_section(){
	echo 'Activate and Deactivate the Built-in Contact Form';
}

//Custom Contact Form
function photography_activate_contact(){//variables from function photography_custom_settings Theme Support Options
	$options =  get_option( 'activate_contact' );
	$checked = ( @$options == 1 ? 'checked' : '');

	echo '<label><input type="checkbox" id="activate_contact" name="activate_contact" value="1" '. $checked .' /></label>';
}//Appears in WP dashboard -> photography


//Photography CSS Info
function photography_custom_css_section_callback(){
	echo 'Customize Photography Theme with your own CSS';
}

//Photography CSS Options
function photography_custom_css_callback(){
	$css = get_option( 'website_css' );
	$css = ( empty($css) ? '/* Photography Theme Custom CSS */' : $css );
	//echo '<textarea placeholder="Sunset Custom Css" >'.$css.'</textarea>';
	echo '<div id="customCss">'.$css.'</div><textarea id="website_css" name="website_css" style="display:none;visibility:hidden;">'.$css.'</textarea>';
}//div id must be the same as in admin-js -> photography.custom_css.js in ace.edit() section.
//Contact CSS Options

//Photography CSS Sanitization
function photography_sanitize_custom_css ($input){//Custom CSS Options,register_setting Third parameter.
	//$output = esc_textarea( $input );//sanitize an input. Function incodes all the information in database. //sanitize the input of textarea
	$output = sanitize_textarea_field( $input );//UPDATE FOR esc_textarea($input);
	return $output;
}

//Template submenu functions
function photography_theme_create_page(){ //the same name as Fifth Value in function photography_add_admin_page().
	//echo '<h1>photography Theme Options</h1>';
	require_once( get_template_directory() . '/inc/templates/photography-admin.php' );
}

//Photography Contact Options
function photography_contact_form_page(){
	require_once( get_template_directory() . '/inc/templates/photography-contact-form.php' );
}

//Photography CSS Options
function photography_theme_settings_page() {
	require_once( get_template_directory() . '/inc/templates/photography-custom-css.php' );
}

?>