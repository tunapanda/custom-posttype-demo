<?php
/*
Plugin Name: Custom Posttype Demo
Plugin URI: https://github.com/tunapanda/custom-posttype-demo
GitHub Plugin URI: https://github.com/tunapanda/custom-posttype-demo
Description: A small demo of how to create a plugin that extends WordPress with a custom posttype.
Version: 0.0.1
*/

/**
 * This is the function we will later register to listen to the WordPress
 * init action. In the function, we call the register_post_type function
 * in WordPress. Our custom posttype represents "things", and the code will
 * make it possible for the administrator to create new things in the
 * WordPress administration interface. Each thing will have a title, but
 * it will not be possible to attach any other information about each thing.
 * It is possible to change this, and the register_post_type function has many
 * options to change how the custom posttype behaves. See the reference docs
 * for more info:
 *
 * https://codex.wordpress.org/Function_Reference/register_post_type
 */
function custom_posttype_init() {
	register_post_type("thing",array(
		"labels"=>array(
			"name"=>"Things",
			"singular_name"=>"Thing",
			"add_new_item"=>"Add new Thing",
			"not_found"=>"No Things found.",
			"edit_item"=>"Edit Thing",
		),
		"public"=>true,
		"supports"=>array("title"),
	));
}

/*
 * Register the function above so that it is called on the init event.
 */
add_action("init","custom_posttype_init");
