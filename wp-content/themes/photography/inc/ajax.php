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
	$archive = $_POST["archive"];

	$args =	array(
		'post_type'		=> 'post',
		'post_status'	=> 'publish',//publish - avoid to grab and load all other post that is not published. (as an example: draft posts, private posts, posts waiting for a review)
		'paged'			=> $paged //$paged is the variable used to update WP_Query and grab the current post
	);

	//Archive.php START
	if( $archive != '0' ): //we have different type of pagination in archive than could extend the arguments array to accept another parameter. Another parameter could be injected that could be a category, a tag parameter, author parameter. The archive is passing as an example data-page="/category/updates/".
	/*$archive != '0' - have to be as a string, not as a integer, because $archive changes between the string and a number that could create some issues and it is not going to work(in portfolio.js it is defined as a string in var archive = that.data('archive'); and as an integer archive=0 if( typeof archive === 'undefined' ){
		archive = 0;
	}). */
			
		$archVal = explode( '/', $archive );//Need to explode url to split the first section that indicates what type of archive you are looking at(if we are looking at category, a tag or an author). The second parameter - indicates what type of search we have to do(that means if we are in the category, this is the name of a cagery. If we are in a tag than we have a name of the tag.... ).
		//explode - lets split a string based on a unique parameter. So we need to specify which parameter we whant to use to explode the string. In this case we are using "/" as a First Parameter. Second parameter - variable that we whant to explode.

		$flipped = array_flip($archVal);//OPTIMIZATION 1 in_array(), because in_array puts a very bit load on a network load time
		
		//check if in the array there is the value "category". If there a value category we signed a type of "category_name" then retrive the $currKey. So where the "category" and in which key location is(in this case category is in the location 3 of the array) and need to retrive what it is after the "category", because the category is the type and we need the value that is the next number. So we are adding the "category" in array_keys + 1.
		switch( isset( $flipped ) ):
			case $flipped["category"]:
				$type = "category_name";
				$key = "category";
				break;

			case $flipped["tag"]:
				$type = "tag";
				$key = $type;
				break;

			case $flipped["author"]:
				$type = "author";
				$key = $type;
				break;
		endswitch;
		
		$currKey = array_keys( $archVal, $key );
		$nextKey = $currKey[0]+1;
		$value = $archVal[ $nextKey ];
			
		$args[ $type ] = $value;


		//check page trail and remove "page" value (as example .../page2/page3)
		//check if in archive there is something in array that was exploded with the '/' in $archVal.
		//if( in_array("page", $archVal) )
		if( isset( $flipped["page"] ) ):
			$pageVal = explode( 'page', $archive );
			$page_trail = $pageVal[0];
		else:
			$page_trail = $archive;
		endif;

	else:
		$page_trail = '/';
	endif;
	//Archive.php END


	$query = new WP_Query( $args );

	if( $query->have_posts() ):

		echo '<div class="page-limit" data-page="' . $page_trail . 'page/' . $paged . '/">';//index.php file.//data-page="/page/' . $paged . '" - default pagination structure.

		while( $query->have_posts() ): $query->the_post();

			get_template_part( 'template-parts/content', get_post_format() );//template-parts - folder where are all the content files. get-template-part function will search a folder template-parts and files with start content- .
			//get_post_format() - retrieve the_post_format of the current post that is in the post loop.

		endwhile;

		echo '</div>';
		
	endif;
	
	wp_reset_postdata();
	
	die();
	
}
//AJAX LOAD MORE END

function photography_check_paged( $num = null ){//default attribute that has to be declared, because in index.php page-limit class function photography_check_paged() the variable inside the brackets is not declared. Variable $num = null declared not to trigger any error.
	$output = '';

	if( is_paged() ) {//is_paged() - boolean detection if is there a page and the page is not equal to zero than it will be true.
		$output = 'page/' . get_query_var( 'paged' ); //And if it is true than $output variable could be updated.
	}

	if($num == 1){
		$paged = ( get_query_var( 'paged' ) == 0 ? 1 : get_query_var( 'paged' ) ); //in the inline if statement check if the paged is equal to zero than the result will be 1, otherwise if the paged is not equal to zero it will be equal to paged.
		//$output = 'page/' . get_query_var( 'paged' ); - this 'paged' value starts at zero and jumps directly to two.
		return $paged;
	}else {
		return $output;
	}

}//remembers the location of what location the user is currently looking //function echo in index.php


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