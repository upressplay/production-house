<?php

add_image_size( 'header', 1600, 600, array( 'top', 'center' ) );
add_image_size( 'rect', 400, 200, array( 'center', 'center' ) );
add_image_size( 'sq', 400, 400, array( 'center', 'center' ) );
add_image_size( 'sqsm', 200, 200, array( 'center', 'center' ) );
add_image_size( 'tall', 400, 600, array( 'top', 'center' ) );

add_action( 'after_setup_theme', 'phsetup' );

function phsetup()
{
	load_theme_textdomain( 'lhp', get_template_directory() . '/languages' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );

	global $content_width;

	if ( ! isset( $content_width ) ) $content_width = 640;
	register_nav_menus(
		array( 'main-menu' => __( 'Main Menu', 'lhp' ) )
	);
}





function empty_content($str) {
    return trim(str_replace('&nbsp;','',strip_tags($str,'<img>'))) == '';
}

function ph_insert_category() {
	wp_insert_term(
		'News',
		'category',
		array(
		  'description'	=> 'Use this for the News Page.',
		  'slug' 		=> 'news'
		)
	);

	wp_insert_term(
		'Gallery',
		'category',
		array(
		  'description'	=> 'Use this for Gallery Images.',
		  'slug' 		=> 'gallery'
		)
	);

	wp_insert_term(
		'Videos',
		'category',
		array(
		  'description'	=> 'Use this for Videos.',
		  'slug' 		=> 'videos'
		)
	);

	wp_insert_term(
		'Services',
		'category',
		array(
		  'description'	=> 'Use this for Service Types.',
		  'slug' 		=> 'services'
		)
	);

	wp_insert_term(
		'Team',
		'category',
		array(
		  'description'	=> 'Use this for Team Members.',
		  'slug' 		=> 'team'
		)
	);
}
add_action( 'after_setup_theme', 'ph_insert_category' );

add_action('get_header', 'remove_admin_login_header');

function remove_admin_login_header() {
	remove_action('wp_head', '_admin_bar_bump_cb');
}

add_action('acf/init', 'my_acf_op_init');
function my_acf_op_init() {

    // Check function exists.
    if( function_exists('acf_add_options_page') ) {

        // Register options page.
        $option_page = acf_add_options_page(array(
            'page_title'    => __('Production House Settings'),
            'menu_title'    => __('Production House'),
            'menu_slug'     => 'ph-settings',
            'capability'    => 'edit_posts',
            'redirect'      => false
        ));
    }
}




