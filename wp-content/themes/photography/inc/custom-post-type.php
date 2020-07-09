<?php 

/*
	@package photography-theme

	=============================
		THEME CUSTOM POST TYPES
	=============================
*/

//Contact Form Options
//FILES INCLUDE main-jquery.js, function.php(to add ajax.php), contact-form.php, ajax.php, theme-support.php, shortcodes.php, contact.scss
$contact =  get_option( 'activate_contact' );//function-admin.php 
if(@$contact == 1) {//in order to activate Contact appearance on WordPress dashboard. To initialize function photography_contact_custom_post_type that is generating cutom post types
		add_action('init', 'photography_contact_custom_post_type');

		//add_filter( 'manage_yourcustomposttype_columns' );
		add_filter( 'manage_photography-contact_posts_columns', 'photography_set_contact_columns' );//update a MESSAGE option prebuilt information in WordPress dashboard. yourcustomposttype - photography-contact (write the same as in custom-post-type.php register_post_type( 'photography-contact', $args );). Changes just the middle ..._yourcustomposttype_...
		//After that need to create a function

		add_action( 'manage_photography-contact_posts_custom_column', 'photography_contact_custom_column', 10, 2 );//making to print a Message and email info after function photography_set_contact_columns( $columns ) is written and need to write a new function photography_contact_custom_column below.
		//Third value - when an action needs to be triggered. 10 is a default value for timing. The lower numbers will be written the earlier the execution of this number is triggered. 10 - meands that this will be triggered after the generation of the post type, after the creation of the filter.
		//Fourth parameter - the number of arguments that we whant to pass. By default the argument is 1, but in this case there is 2 arguments so the number is 2.

		add_action('add_meta_boxes', 'photography_contact_add_meta_box');//trigering contact metabox of photography_contact_add_meta_box function in custom-post-type.php. //Adds in message option User Email contact field.

		add_action( 'save_post', 'photography_save_contact_email_data' );// Second parameter - from function photography_save_contact_email_data.
		//trigering function photography_save_contact_email_data( $post_id ).
}

/* CONTACT Custom Post Type */
function photography_contact_custom_post_type(){//photography_contact_custom_post_type newly created function
	$labels = array(
		'name'				=>	'Messages',
		'singular_name'		=>	'Message',
		'menu_name'			=>	'Messages',
		'name_admin_bar'	=>	'Message'
	);

	$args = array(
		'labels'			=> $labels,//$labels variable from $labels array
		'show_ui'			=> true,
		'show_in_menu'		=> true,
		'capability_type'	=> 'post',
		'hierarchical'		=> false,
		'menu_position'		=> 26,//position number
		'menu_icon'			=> 'dashicons-email-alt',//icon from https://developer.wordpress.org/resource/dashicons/#email-alt . Select the icon and copy the name and paste ''.
		'supports'			=> array( 'title', 'editor', 'author' )
	);

	register_post_type( 'photography-contact', $args );
	//First Parameter - unique name of the custom post type. Second Parameter - all the parameters listed above.
}

function photography_set_contact_columns($columns){//takes all the columns from //Contact Form Options add_filter

	/*unset ( $columns['author'] );
	return $columns;*/
	$newColumns = array();
	$newColumns['title'] = 'Full Name';
	$newColumns['message'] = 'Message';
	$newColumns['email'] = 'Email';
	$newColumns['date'] = 'Date';
	return $newColumns;
}

function photography_contact_custom_column($column, $post_id){ //Contact Form Options //add_action second variable function
	switch($column){//switch creating an if. Switch is analysing a variable and creating a statement for each type of variable that could be inside this column
		case 'message':
			//message column
			echo get_the_excerpt();
			break;
		case 'email':
			//email column. Print an email written in CONTACT META BOX
			$email = get_post_meta($post_id, '_contact_email_value_key', true);//Print email information in Wp dashboard -> Message column.
			echo '<a href="mailto:'.$email.'">'.$email.'</a>';
			break;
	}
}//function to print custom info in WP dashboard -> Messages



/* CONTACT META BOXES */
//metabox in WordPress dashboard MESSAGE option
function photography_contact_add_meta_box(){
	add_meta_box('contact_email', 'User Email', 'photography_contact_email_callback', 'photography-contact', 'side');//Fourth parameter - post type id 'photography-contact' of photography_contact_custom_post_type function.
	//Fifth parameter - specify the position. 'normal' - puts it on the bottom of the screen. 'side' - puts it on a side of the screen.
	//Sixth parameter - priority options (high, core, default, low).
}//Adds in message option User Email contact field

function photography_contact_email_callback( $post ){//calling the callback function
	wp_nonce_field('photography_save_contact_email_data', 'photography_contact_email_meta_box_nonce');//wp_nonce_field - prebuilt WP functionality that generates a unique id or value. Important to avoid third parties to access or inject something to a page.
	$value = get_post_meta($post->ID, '_contact_email_value_key', true); //First value - ($post->ID)  -> access an atribute of the object array. Second value - string value of a metabox. Third value - specify if this value is a single value or an array (in this case it is single value).
	echo '<label for="photography_contact_email_field">User Email Address: </label>';
	echo '<input type="email" id="photography_contact_email_field" name="photography_contact_email_field" value="' . esc_attr($value) . '" size="25" />';// id must be the identical as it was used in label for=""; input name="" must be an identical as the input id. esc_attr() - built in function to avoid injections from third parties.
}//Adds in message option User Email contact field


//FUNCTION TO SAVE EMAIL METABOX
function photography_save_contact_email_data( $post_id ){
	if( !isset($_POST['photography_contact_email_meta_box_nonce'] ) ){
		return;//if the photography_contact_email_meta_box_nonce metabox doesn't exist the function stops with a return.
	}

	if( !wp_verify_nonce($_POST['photography_contact_email_meta_box_nonce'], 'photography_save_contact_email_data' ) ){
	//checking if photography_contact_email_meta_box_nonce is valid.
	//First value is identical to if( !isset($_POST['photography_contact_email_meta_box_nonce'] ) )
	//Second value - the name of the function.
		return;
	}

	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
		return;
	}//checking if users is saving the draft. For safety precausion with this code preventing autosave.

	if( !current_user_can( 'edit_post', $post_id )){//checking for users permission.
		return;
	}
	
	if( !isset($_POST['photography_contact_email_field']) ){//in$_POST[''] - inside must be the same as in function photography_contact_email_callback input id
		return;
	}

	$my_data = sanitize_text_field($_POST['photography_contact_email_field']);//sanitize-text_field - makes sure that nothing bad will not be saved in a database.
	update_post_meta($post_id, '_contact_email_value_key', $my_data);//First value - post_id taken from photography_contact_email_callback function. Second value - meta key ($value = get_post_meta($post->ID, '_contact_email_value_key', true);)

}//after that add a variable to function photography_contact_custom_column and echo.