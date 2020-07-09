<?php 
/*
	@package photography-theme


	==========================================
		AJAX FUNCTIONS
	==========================================
*/

//IF THERE IS A NEED TO CLOSE NO PRIVILAGE (FOR NOT LOGGED IN USER 1-st add-action) OR ONLY WITH PRIVILAGES (FOR LOGGED IN USER 2-st add-action) IT COULD BE COMMENTED
add_action( 'wp_ajax_nopriv_photography_load_more', 'photography_load_more' );//wp_ajax_nopriv_photography_load_more - ajax call with no privilages so even a user that is not logged can call (first parameter) photography_load_more that is equal to custom function (second parameter) photography_load_more that was created.

add_action( 'wp_ajax_photography_load_more', 'photography_load_more' ); //wp_ajax_photography_load_more - activating this action to wp_ajax function for a logged user.


// ADD ajax.php to functions.php
//FILES INCLUDE main-jquery.js, function.php(to add ajax.php), contact-form.php, shortcodes.php, theme-support.php, custom-post-type.php, contact.scss
//function photography_save_contact(); on the bottom
add_action( 'wp_ajax_nopriv_photography_save_user_contact_form', 'photography_save_contact' );//wp_ajax_nopriv_photography_save_user_contact_form - ajax call with no privilages so even a user that is not logged can call (first parameter) photography_load_more that is equal to custom function (second parameter) photography_load_more that was created. For contact-form.php file.

add_action( 'wp_ajax_photography_save_user_contact_form', 'photography_save_contact' ); //wp_ajax_photography_save_user_contact_form - activating this action to wp_ajax function for a logged user. For contact-form.php file.


//AJAX LOAD MORE START mega-menu.js.php, index.php, index.scss
function photography_load_more() {

	$paged = $_POST["page"]+1;

	$query = new WP_Query( 
		array(
			'post_type'		=> 'post',
			'post_status'	=> 'publish',//publish - avoid to grab and load all other post that is not published. (as an example: draft posts, private posts, posts waiting for a review)
			'paged'			=> $paged
		)
	);

	if( $query->have_posts() ):

		while( $query->have_posts() ): $query->the_post();

			get_template_part( 'template-parts/content', get_post_format() );//template-parts - folder where are all the content files. get-template-part function will search a folder template-parts and files with start content- .
			//get_post_format() - retrieve the_post_format of the current post that is in the post loop.

		endwhile;
		
	endif;
	
	wp_reset_postdata();
	
	die();
	
}
//AJAX LOAD MORE END




function photography_save_contact(){
	$title = wp_strip_all_tags($_POST["name"]);
	$email = wp_strip_all_tags($_POST["email"]);
	$message = wp_strip_all_tags($_POST["message"]);
	//var_dump($postID);

	//return  $title . ',' . $email . ',' . $message;

	$args = array(
		'post_title'	=> $title,
		'post_content'	=> $message,
		'post_author'	=> 1,
		'post_status'	=> 'publish',
		'post_type'		=> 'photography-contact',
		'meta_input'	=> array(
			'_contact_email_value_key' => $email
		)//meta_input - is an array of all of the meta keys meta ttributes that is declared and whant to save in custom post type
	);//when {} is used than you have a list of value, array() is used when it is an associative array.

	//echo $title . ',<br>' . $email . ',<br>' . $message;//used to check if it is working when form is filled and submitted. Than inspect on a button -> network -> clean everything -> press submit button -> press on the post request and check in the response card on the right.

	$postID = wp_insert_post( $args );//allows to save information in post type. Everything what goes through out this function is automatically sanitized.
	//$wp_error - AS A SECOND VARIABLE AFTER $args USED FOR DEVELOPING, BUT NOT GOOD FOR SELLING, BECAUSE IT PRINTS ALL THE ERRORS.


	//TO TEST if the contact form works need to go to https://mailtrap.io/ Alecaddd Part 61 - WordPress Theme Development - Local SMTP Email Server with Mailtrap. Function mailtrap($phpmailer) is in theme-support.php !!!!!
	if($postID !== 0){//Doesn't work on localhost. Need to be uploaded to live host to test the code.

		$to = get_bloginfo('admin_email');//admin email address. admin_email (attribute) could be changed in WP dashboard -> Settings -> General -> Email Address.

		$subject = 'Photography Contact Form - ' . $title;

		$headers[] = 'From: '. get_bloginfo('name') .' <'. $email .'>';//Will print - 'From: Gytis <gytislapenas@gmail.com>'
		//$headers[] - brackets means that this variable is an array.
		//get_bloginfo('name') - in dashboard -> Settings -> General -> Site Title

		$headers[] = 'Reply-To: '. $title .' <'. $email .'>';

		$headers[] = 'Content-Type: text/html: charset=UTF-8';//content type - in this case html content type

		wp_mail($to, $subject, $message, $headers);//wp_mail(); - email submission.

		echo $postID;
	} else {
		echo 0;
	}

	//echo 0; to test if works contact form in main-jquery.js ajax section success

	die();

}//add_action on the top