<?php
/**
 * Register custom forms
 */
if( function_exists('acf_register_form') ) {

	acf_register_form(array(
		'id'		=> 'new-user-review',
		'form' 		=> true,
		'post_id'	=> 'new',
		'new'		=> array(
			'post_type'		=> 'user-reviews',
			'post_status'	=> 'draft'
		),
		'post_title'	=> false,
		'post_content'	=> false,
		'submit_value'	=> __("Submit Review", 'acf'),
		'updated_message' => __("Submit Review", 'acf'),
		'html_submit_button' => '<div class="g-recaptcha" data-sitekey="' . CAPTCHA_SITE_KEY . '"></div><p class="add-review-modal__approval pr-3">*Your review needs to be approved by an administrator before others can see it*</p><div class="add-review-modal__group d-flex align-items-center justify-content-end"><input type="submit" class="btn-download btn-download--teal" value="Submit Review"></div>',
		'field_groups'	=> array('group_rip54321'),
		'recaptcha' => true
	));

	add_filter( 'acf/update_value/type=text', 'wp_kses_post', 10, 1 );
	add_filter( 'acf/update_value/type=textarea', 'wp_kses_post', 10, 1 );
	add_filter( 'acf/update_value/type=wysiwyg', 'wp_kses_post', 10, 1 );
	add_filter( 'acf/update_value/type=password', 'wp_kses_post', 10, 1 );
	add_filter( 'acf/update_value/type=radio', 'wp_kses_post', 10, 1 );
	add_filter( 'acf/update_value/type=oembed', 'wp_kses_post', 10, 1 );
	add_filter( 'acf/update_value/type=select', 'wp_kses_post', 10, 1 );

}