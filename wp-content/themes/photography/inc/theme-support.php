<?php 

/*
	@package photography-theme

	=============================
		THEME SUPPORT OPTIONS
	=============================
*/
//Mega menu Theme Options START
//Activates all the post format in dasboard posts -> Format bar on the right. TO ACTIVATE POST FORMATS GO TO newly created PHOTOGRAPHY -> THEME OPTIONS -> select -> save changes and go to the posts.


$options =  get_option( 'post_formats' );
$formats = array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat');
$output = array();
foreach ($formats as $format){
	$output[] = ( @$options[$format] == 1 ? $format : '');
}

if( !empty($options) ){
	add_theme_support('post-formats', $output );
}

/*
//Simplified version of the code above. TO ACTIVATE POST FORMATS GO TO newly created PHOTOGRAPHY -> THEME OPTIONS -> select -> save changes and go to the posts.
$options = get_option('post_formats'); 
if (!empty($options)) { 
	add_theme_support('post-formats', array_keys($options)); 
}


//Activating theme Options PHOTOGRAPHY->THEME OPTIONS
//Theme support Custom Header. Check the boxes in Photography -> Theme Options and it will appear in dashboard Appearance
$header =  get_option( 'custom_header' );//function photography_custom_header function-admin.php 
if(@$header == 1) {
	add_theme_support('custom-header');
}

//Theme support Custom Background. Check the boxes in Photography -> Theme Options and it will appear in dashboard Appearance
$background =  get_option( 'custom_background' );//function photography_custom_background function-admin.php
if(@$background == 1) {
	add_theme_support('custom-background');
}
//Photography Theme Options END
*/

/* Activate Appearance -> header menu in WP dashboard START */
add_theme_support('custom-header'); //in WP dasboard Appearance -> Header -> Set header
/* Add in header.php file <div class="image" style="background-image: url(<?php header_image(); header_image(); - php built in function automatically prints the header image?>);"></div> and in sass set the height, width...
or just place in header.php <img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" /> */

/* Activate Appearance -> header menu in WP dashboard END */

/* Activate Appearance -> background menu in WP dashboard START */
add_theme_support('custom-background');
/* Activate Appearance -> background menu in WP dashboard END */

/*Activate the post thumbnails START*/
add_theme_support( 'post-thumbnails' );//post-thumbnails - Lets to set Featured Image in Wordpress dashboard -> Posts. Developing content.php
/*Activate the post thumbnails END*/


/*Activate Nav Menu Option in WP dashboard START*/
function photography_register_nav_menu(){
	register_nav_menu( 'primary', 'Header Navigation Menu' );//First parameter - location unique name. For two word use _, but do not use -   . Second parameter - description. 
}//add a walker.php file and require in functions.php

add_action('after_setup_theme', 'photography_register_nav_menu');//call an action to activate a function.

/*Activate Nav Menu Option END*/


/*Activate Footer navigation menu START*/
function photography_theme_setup() {

	add_theme_support('menus'); //activatíng menu's writing a string 

	//register_nav_menu('primary', 'Primary Header Navigation'); //first value - string $location, second option - string $description
	register_nav_menu('secondary', 'Footer Navigation');

}
add_action('init', 'photography_theme_setup'); //function to create the menus. Function is executed after the setup theme is triggered. Function will work 'after_setup_theme' or after the initialization 'init'
/*Activate Footer navigation menu END*/

/* Sidebar function START*/
function sidebar_widget_setup() {

	register_sidebar(
		array(	
			'name'	=> 'Sidebar',
			'id'	=> 'sidebar-1',
			'class'	=> 'custom',
			'description' => 'Standard Sidebar',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h1 class="widget-title">',
			'after_title'   => '</h1>',
		)
	);

}
add_action('widgets_init','sidebar_widget_setup');
/* Sidebar function END*/



/*
	==========================================
		BLOG LOOP CUSTOM FUNCTIONS
	==========================================
*/

function photography_get_attachment( $num = 1 ){//content-image.php entry-header style="background-image: url()"
//variable $num = 1 - if there will be declared a function without a variable the default value will be 1, but no Null and it will not break a code. Than change a 'posts_per_page' number with a variable $num.
	$featured_image = '';//$featured_image from entry-header style="background-image:url()"
		if( has_post_thumbnail() && $num == 1 ): //if the featured picture is set in WordPress dashboard.
			$featured_image = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
			//WP function wp_get_attachment_url() - retrive the url of picture if we know the ID of that specific picture.
			//get_post_thumbnail_id() - To get the id.
			//get_the_ID() - as a value to specify a post id.
		else:
			//if the picture is not set as a featured image and putted to a text area with upload media button. Than we need to put an empty variable $featured_image = ''; above all code and add an else
			$attachments = get_posts( array(
				'post_type'			=>	'attachment',// WordPress saves everything as a post type (A post, A page, attachment). 'attachment' - means that there will be only images inside.
				'posts_per_page'	=> $num,//'posts_per_page' - image to print. 1 - is a limitation of posts that is retrieving.
				'post_parent'		=> get_the_ID()//'post_parent' - declare what kind of parent we whant to check, whick post we whant to check otherwise it will retrive all the atachments we ever uploaded to WordPress.
			) );//retrive all the attachments to a specific posts. Function get_posts - get a specific list of posts asign to this current post.

			//var_dump($attachments);

			if( $attachments && $num == 1 ): //check if attachments is not empty.
				foreach ($attachments as $attachment) ://loop to access the array to navigate in it properly.
					$featured_image = wp_get_attachment_url( $attachment->ID );//we have to access id of attachment variable and navigating inside of the object array and retrive the object id that is the same value as it was written with var_dump($attachments); and was found that it is ["ID"] => int(47).
				
				endforeach;
			elseif( $attachments && $num > 1 ):
				$featured_image = $attachments; 
				
			endif;

			wp_reset_postdata();//we are not affect the blog loop that is inside index and not going to disrupt our homepage.

		endif;//GO TO WP DASBOARD -> MEDIA -> SELECT LIST ICON ON THE LEFT AND UNATTACH ALL OF THE IMAGES. THAN GO TO POSTS -> SELECT A POST -> ADD MEDIA -> SELECT A PICTURE -> INSERT PHOTO -> MAKE SURE IT IS UNDER THE TEXT -> UPDATE. IF IT DOESN'T WORK REUPLOAD AN IMAGE.

		return $featured_image;
}


/* MEGAMENU CUSTOM FIELDS SECTION in WP dashborad -> Appearance -> Menu -> Shown Options START */


//Create fields
function fields_list(){
	//menu-item-megamenu
	return array(
		'mm-megamenu'			=> 'Activate MegaMenu',
		'mm-column-divider'	=> 'Column Divider',
		'mm-divider'			=> 'Inline Divider',
		'mm-featured-image'	=> 'Featured Image',
		'mm-description'		=> 'Description'
	);
}

//Setup fields in database
function megamenu_fields($id, $item, $depth, $args){
	$fields = fields_list();
	foreach ($fields as $_key => $label):

		$key = sprintf('menu-item-%s', $_key);
		$id = sprintf('edit-%s-%s', $key, $item->ID);
		$name = sprintf('%s[%s]', $key, $item->ID);
		$value = get_post_meta($item->ID, $key, true);
		$class = sprintf('field-%s', $_key);

		?>

		<!-- description description-wide - built in classes of wordpress. Creating checkbox field in WP dashboard -> Appearance -> Menu -> Shown Options -->
		<p class="description description-wide <?php echo esc_attr($class) ?>">
			<label for="<?php echo esc_attr($id) ?>"><input type="checkbox" id="<?php echo esc_attr($id) ?>" name="<?php echo esc_attr($name) ?>" value="1" <?php echo ($value == 1) ? 'checked="checked"' : ''; ?>><?php echo esc_attr($label) ?></label>
		</p>

		<?php 

	endforeach;
}

add_action('wp_nav_menu_item_custom_fields','megamenu_fields', 10, 4);//First variable - name of WP in order to hook a specific function to this specific action. Second parameter - custom function name. Third parameter - at what point action needs to be triggered (in this case at 10). Fourth parameter - how many fields need to be passed to this function. 



//Show columns
function megamenu_columns( $columns ){
	$fields = fields_list();
	$columns = array_merge($columns, $fields);

	return $column;
}

add_filter('manage_nav-menus_columns', 'megamenu_columns', 99);



//Save/Update fields
function megamenu_save($menu_id, $menu_item_db_id, $menu_item_args){

	if( defined('DOING_AJAX') && DOING_AJAX ){
		return;
	}

	check_admin_referer( 'update-nav_menu', 'update-nav-menu-nonce' );

	$fields = fields_list();

	foreach ($fields as $_key => $label):
		$key = sprintf('menu-item-%s', $_key);

		//Sanitize the field
		if(!empty( $_POST[$key][$menu_item_db_id])){
			$value = $_POST[$key][$menu_item_db_id];
		}else{
			$value = null;
		}

		//Save and Update
		if ( !is_null($value) ){
			update_post_meta( $menu_item_db_id, $key, $value );
		}else{
			delete_post_meta( $menu_item_db_id, $key );
		}

	endforeach;

}

add_action('wp_update_nav_menu_item', 'megamenu_save', 10, 3);


//Update the walker Nav Class
function megamenu_walkernav( $walker ){
	$walker = 'MegaMenu_Walker_Edit';
	if(!class_exists($walker) ){
		require_once dirname( __FILE__ ) . '/walker-nav-menu-edit.php';

	}
	return $walker;

}


add_filter( 'wp_edit_nav_menu_walker', 'megamenu_walkernav', 99 );


/* MEGAMENU CUSTOM FIELDS SECTION END*/

