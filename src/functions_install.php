<?php

add_image_size( 'header', 1600, 600, array( 'top', 'center' ) );
add_image_size( 'pageThumbRect', 400, 200, array( 'center', 'center' ) );
add_image_size( 'pageThumbSq', 400, 400, array( 'center', 'center' ) );
add_image_size( 'pageThumbSqSm', 200, 200, array( 'center', 'center' ) );
add_image_size( 'pageThumbTall', 400, 600, array( 'top', 'center' ) );



function productionhouse_setup()
{
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );

	global $content_width;

	if ( ! isset( $content_width ) ) $content_width = 640;

	register_nav_menus(
		array( 'top' => __( 'Top Menu' ) ),
		array( 'social' => __( 'Social Links Menuu' ) )
	);

	update_option( 'fresh_site', '1' );

	$starter_conten1 = array(

		'posts' => array(
			'home' => array(
				'post_type' => 'page', 
			),
			'about' => array(
				'post_type' => 'page', 
			),
			'gallery' => array(
				'post_type' => 'page', 
			),
			'news' => array(
				'post_type' => 'page', 
			),
			'services' => array(
				'post_type' => 'page', 
			),
			'contact' => array(
				'post_type' => 'page', 
			)
		)

	);
	$starter_content = array(

		'posts' => array(
			'home' => array(
				'thumbnail' => '{{image-home-header}}',
				'post_type' => 'page', 
				'post_title' => _x( 'Home', 'Theme starter content' ),
				'post_content' => _x( 'Welcome to your site! This is your homepage, which is what most visitors will see when they come to your site for the first time.', 'Theme starter content' ),

			),
			'about' => array(
				'thumbnail' => '{{image-about-header}}',
				'post_type' => 'page', 
				'post_title' => _x( 'About', 'Theme starter content' ),
				'post_content' => _x( 'Welcome to your site! This is your homepage, which is what most visitors will see when they come to your site for the first time.', 'Theme starter content' ),
			),
			'gallery' => array(
				'thumbnail' => '{{image-gallery-header}}',
				'post_type' => 'page', 
				'post_title' => _x( 'Gallery', 'Theme starter content' ),
				'post_content' => _x( 'Welcome to your site! This is your homepage, which is what most visitors will see when they come to your site for the first time.', 'Theme starter content' ),
			),
			'news' => array(
				'thumbnail' => '{{image-news-header}}',
				'post_type' => 'page', 
				'post_title' => _x( 'News', 'Theme starter content' ),
				'post_content' => _x( 'Welcome to your site! This is your homepage, which is what most visitors will see when they come to your site for the first time.', 'Theme starter content' ),
			),
			'services' => array(
				'thumbnail' => '{{image-services-header}}',
				'post_type' => 'page', 
				'post_title' => _x( 'Services', 'Theme starter content' ),
				'post_content' => _x( 'Welcome to your site! This is your homepage, which is what most visitors will see when they come to your site for the first time.', 'Theme starter content' ),
			),
			'contact' => array(
				'thumbnail' => '{{image-contact-header}}',
				'post_type' => 'page', 
				'post_title' => _x( 'Contact', 'Theme starter content' ),
				'post_content' => _x( 'Welcome to your site! This is your homepage, which is what most visitors will see when they come to your site for the first time.', 'Theme starter content' ),
			),
		),

		// Create the custom image attachments used as post thumbnails for pages.
		'attachments' => array(
			'image-home-header' => array(
				'post_title' => _x( 'Home Header', 'Theme starter content', 'productionhouse' ),
				'file' => 'img/ph_home_header.jpg', // URL relative to the template directory.
			),
			'image-about-header' => array(
				'post_title' => _x( 'About Header', 'Theme starter content', 'productionhouse' ),
				'file' => 'img/ph_about_header.jpg',
			),
			'image-gallery-header' => array(
				'post_title' => _x( 'Gallery Header', 'Theme starter content', 'productionhouse' ),
				'file' => 'img/ph_gallery_header.jpg',
			),
			'image-news-header' => array(
				'post_title' => _x( 'News Header', 'Theme starter content', 'productionhouse' ),
				'file' => 'img/ph_news_header.jpg',
			),
			'image-services-header' => array(
				'post_title' => _x( 'Services Header', 'Theme starter content', 'productionhouse' ),
				'file' => 'img/ph_services_header.jpg',
			),
			'image-contact-header' => array(
				'post_title' => _x( 'Contact Header', 'Theme starter content', 'productionhouse' ),
				'file' => 'img/ph_contact_header.jpg',
			),
		),

		// Default to a static front page and assign the front and posts pages.
		'options' => array(
			'show_on_front' => 'page',
			'page_on_front' => '{{home}}',
			'page_for_posts' => '{{blog}}',
		),

		// Set up nav menus for each of the two areas registered in the theme.
		'nav_menus' => array(
			// Assign a menu to the "top" location.
			'top' => array(
				'name' => __( 'Top Menu', 'productionhouse' ),
				'items' => array(
					'link_home', // Note that the core "home" page is actually a link in case a static front page is not used.
					'page_about',
					'page_gallery',
					'page_news',
					'page_services',
					'page_contact',
				),
			),

			// Assign a menu to the "social" location.
			'social' => array(
				'name' => __( 'Social Menu', 'productionhouse' ),
				'items' => array(
					'link_facebook',
					'link_twitter',
					'link_instagram',
				),
			),
		),
	);

	$starter_content = apply_filters( 'productionhouse_starter_content', $starter_content );
	add_theme_support( 'starter-content', $starter_content );
	//add_theme_support( 'starter-content');

	//var_dump($starter_content);
}

add_action( 'after_setup_theme', 'productionhouse_setup' );

add_action( 'wp_enqueue_scripts', 'ph_load_scripts' );

function ph_load_scripts()
{
	wp_enqueue_script( 'jquery' );
}



add_filter( 'the_title', 'ph_title' );

function ph_title( $title ) {
	if ( $title == '' ) {
	return '&rarr;';
	} else {
	return $title;
	}
}



add_filter( 'wp_title', 'ph_filter_wp_title' );

function ph_filter_wp_title( $title )
{
	return $title . esc_attr( get_bloginfo( 'name' ) );
}




add_action('get_header', 'remove_admin_login_header');

function remove_admin_login_header() {
	remove_action('wp_head', '_admin_bar_bump_cb');
}

function empty_content($str) {
    return trim(str_replace('&nbsp;','',strip_tags($str,'<img>'))) == '';
}

add_filter('acf/settings/path', 'my_acf_settings_path');
 
function my_acf_settings_path( $path ) {
 
    // update path
    $path = get_stylesheet_directory() . '/plugins/acf/';
    
    // return
    return $path;
    
}

add_filter('acf/settings/dir', 'my_acf_settings_dir');
 
function my_acf_settings_dir( $dir ) {
 
    // update path
    $dir = get_stylesheet_directory_uri() . '/plugins/acf/';
    
    // return
    return $dir;
    
}

include_once( get_stylesheet_directory() . '/plugins/acf/acf.php' );

add_filter('acf/settings/save_json', 'my_acf_json_save_point');
 
function my_acf_json_save_point( $path ) {
    
    // update path
    $path = get_stylesheet_directory() . '/acf-json';
    
    
    // return
    return $path;
    
}

add_filter('acf/settings/load_json', 'my_acf_json_load_point');

function my_acf_json_load_point( $paths ) {
    
    // remove original path (optional)
    unset($paths[0]);
    
    
    // append path
    $paths[] = get_stylesheet_directory() . '/acf-json';
    
    // return
    return $paths;
    
}



function theme_settings_page()
{
    ?>
	    <div class="wrap">
	    <h1>Theme Panel</h1>
	    <form method="post" action="options.php">
	        <?php
	            settings_fields("section");
	            do_settings_sections("theme-options");      
	            submit_button(); 
	        ?>          
	    </form>
		</div>
	<?php
}

function add_theme_menu_item()
{
	add_menu_page("Production House", "Production House", "manage_options", "theme-panel", "theme_settings_page", null, 2);
}

add_action("admin_menu", "add_theme_menu_item");

function logo_display()
{
	?>
        <input type="file" name="logo" /> 
        <?php echo get_option('logo'); ?>
   <?php
}

function handle_logo_upload()
{
	if(!empty($_FILES["demo-file"]["tmp_name"]))
	{
		$urls = wp_handle_upload($_FILES["logo"], array('test_form' => FALSE));
	    $temp = $urls["url"];
	    return $temp;   
	}
	  
	return $option;
}

function favicon_img()
{
	?>
        <input type="file" name="logo" /> 
        <?php echo get_option('logo'); ?>
   <?php
}

function handle_favicon_upload()
{
	if(!empty($_FILES["demo-file"]["tmp_name"]))
	{
		$urls = wp_handle_upload($_FILES["favi"], array('test_form' => FALSE));
	    $temp = $urls["url"];
	    return $temp;   
	}
	  
	return $option;
}

function bg_color()
{
	?>
    	<input type="color" name="bg_color" value="#000">
    <?php
}

function headline_color()
{
	?>
    	<input type="color" name="headline_color" value="#fff">
    <?php
}
function body_color()
{
	?>
    	<input type="color" name="body_color" value="#fff">
    <?php
}

function footer_color()
{
	?>
    	<input type="color" name="footer_color" value="#fff">
    <?php
}

function footer_font_color()
{
	?>
    	<input type="color" name="footer_font_color" value="#fff">
    <?php
}

function display_twitter_element()
{
	?>
    	<input type="text" name="twitter_url" id="twitter_url" value="<?php echo get_option('twitter_url'); ?>" />
    <?php
}

function display_facebook_element()
{
	?>
    	<input type="text" name="facebook_url" id="facebook_url" value="<?php echo get_option('facebook_url'); ?>" />
    <?php
}

function display_instagram_element()
{
	?>
    	<input type="text" name="facebook_url" id="instagram_url" value="<?php echo get_option('instagram_url'); ?>" />
    <?php
}



function display_theme_panel_fields()
{
	add_settings_section("section", "All Settings", null, "theme-options");

	add_settings_field("logo", "Logo", "logo_display", "theme-options", "section");
	add_settings_field("favicon", "Favicon", "favicon_img", "theme-options", "section");
	add_settings_field("background-color", "Background Color", "bg_color", "theme-options", "section");
	add_settings_field("headline-color", "Headline Color", "headline_color", "theme-options", "section");
	add_settings_field("body-color", "Body Copy Color", "body_color", "theme-options", "section");
	add_settings_field("footer-color", "Footer Background Color", "footer_color", "theme-options", "section");
	add_settings_field("footer-font-color", "Footer Font Color", "footer_font_color", "theme-options", "section");
	
	add_settings_field("twitter_url", "Twitter Profile Url", "display_twitter_element", "theme-options", "section");
    add_settings_field("facebook_url", "Facebook Profile Url", "display_facebook_element", "theme-options", "section");
    add_settings_field("instagram_url", "Instagram Profile Url", "display_instagram_element", "theme-options", "section");

    register_setting("section", "twitter_url");
    register_setting("section", "facebook_url");
    register_setting("section", "instagram_url");
}

add_action("admin_init", "display_theme_panel_fields");


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
