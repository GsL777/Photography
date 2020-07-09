<!-- FILES INCLUDE main-jquery.js, function.php(to add ajax.php), shortcodes.php, ajax.php, theme-support.php, custom-post-type.php, design-contact-form.php, contact.scss -->

<!-- in design-contact-form.php write a comment <p>Use this <strong>shortcode</strong> to activate the Contact Form inside a Page or Post</p>
<p><code>[contact_form]</code></p> -->

<form id="ContactForm" class="contact-form" action="#" method="post" data-url="<?php echo admin_url('admin-ajax.php'); ?>">

	<div class="form-row">

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-0">

			<div class="input-style width form-group">

				<label for="name">Name*</label>

				<input type="text" class="input js-input" name="name" id="name">
				
				<span class="input-highlight"></span>

				<small class="text-danger form-control-msg">Your name is Required</small>

			</div><!-- .form-group -->

		</div><!-- .col-md-12 -->

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-0">

			<div class="input-style width form-group">

				<label for="email">Email*</label>

				<input type="email" class="input js-input" name="email" id="email">
				
				<span class="input-highlight"></span>

				<small class="text-danger form-control-msg">Your Email is Required</small>

			</div><!-- .form-group -->

		</div><!-- .col-md-12 -->

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-0">

			<div class="input-style width form-group">

				<label for="message">Message*</label>

				<textarea name="message" id="message" class="input"></textarea>
				
				<span class="input-highlight"></span>

				<small class="text-danger form-control-msg">A message is Required</small>

			</div><!-- .form-group -->

		</div><!-- .col-md-12 -->

	</div><!-- .form-row -->

	<div class="col-md-10 mx-auto mt-4">

		<button type="submit" class="submit-btn btn-lrg btn-danger btn-block button-send">Submit</button>

		<small class="text-info form-control-msg js-form-submission">Submission in process, please wait...</small>

		<small class="success form-control-msg js-form-success">Message was successfully submitted!</small>

		<small class="text-danger form-control-msg js-form-error">There was a problem with the Contact Form, please try again!</small>

	</div><!-- .col-md-10 -->

</form><!-- .contact-form -->