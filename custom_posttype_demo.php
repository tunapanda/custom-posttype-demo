<?php
/*
Plugin Name: Custom Posttype Demo
Plugin URI: https://github.com/tunapanda/custom-posttype-demo
GitHub Plugin URI: https://github.com/tunapanda/custom-posttype-demo
Description: A small demo of how to create a plugin that extends WordPress with a custom posttype.
Version: 0.0.1
*/

/****************************************************************************
 *
 *  PART 1 - Registering the posttype
 *
 ****************************************************************************/

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

/****************************************************************************
 *
 *  PART 2 - Showing instances of the posttype on the WordPress site.
 *
 ****************************************************************************/

/**
 * We will register this function to listen to the the_content filter. This 
 * function will be called when a user actually looks at a thing by visiting
 * its URL, also known as permalink, in the browser. It is actually called
 * when a user wants to look at any kind of post in WordPress, so we need
 * to make sure we don't mess up how other posts will appear. Once we make
 * sure that the request is actually for a thing, we can return any HTML
 * we want to represent how the thing should appear.
 */
function custom_posttype_content($content) {
	$post=get_post();

	// Make sure that we are actually requested to show a post that is an
	// instance of our custom posttype. If it isn't, just return the content
	// that was passed as a parameter, so we don't mess up other posttypes.
	if ($post->post_type!="thing")
		return $content;

	$output=
		"This is how a user sees a thing. We don't have so much information ".
		"about things, but we can tell you the title: ".
		"<b>".$post->post_title."</b><br>".
		"</b>And the id: <b>".$post->ID."</b>";

	return $output;
}

/*
 * Register the function above so that it is called on the the_content event.
 */
add_filter("the_content","custom_posttype_content");
