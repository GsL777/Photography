<!-- Custom Photography Theme Support on WordPress dashboard-->
<h1>Photography Theme Support</h1>

<?php settings_errors();//function that will print an error ?>

<form method="post" action="options.php" class="photography-general-form">
	<?php settings_fields( 'photography-theme-support' ); ?>
	<?php do_settings_sections('photography_website_theme');?>
	<?php submit_button(); ?>
</form>