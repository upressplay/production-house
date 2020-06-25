<?php
	global $segments;
	$segments = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/')); 
	$template_uri = get_template_directory_uri();
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<?php the_field('google_analytics', 'option'); ?>

		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width" />
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="<?php echo $template_uri; ?>/css/main.min.css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.1/TweenMax.min.js"></script>

		<script src="<?php echo get_template_directory_uri(); ?>/js/main.min.js"></script>
		<link href="https://fonts.googleapis.com/css?family=Domine:400,700" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Ultra" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
		<?php wp_head(); ?>
		<?php 
			$siteLogo = get_field('site_logo', 'option');
			$bodyFont = get_field('body_font', 'option');
			if($bodyFont['font_link'] != "") {
				echo $bodyFont['font_link'];
			}
			$headlineFont = get_field('headline_font', 'option');
			if($headlineFont['font_link'] != "") {
				echo $headlineFont['font_link'];
			}

			$subFont = get_field('sub_font', 'option');
			if($subFont['font_link'] != "") {
				echo $subFont['font_link'];
			}

			$navFont = get_field('nav_font', 'option');
			if($navFont['font_link'] != "") {
				echo $navFont['font_link'];
			}
			global $defaultHeader;
			$defaultHeader = get_field('default_header', 'option')['sizes']['header'];

			
		?>
		
		<style>
			
			body {
				background-color: <?php echo get_field('bg_color', 'option'); ?>;
				color: <?php echo $bodyFont['color']; ?>;
				<?php echo $bodyFont['font_family']; ?>;
			}
			.section-title,
			.section-title-link,
			figcaption .title
			{	
				<?php echo $headlineFont['font_family']; ?>;
				font-weight: <?php echo $headlineFont['font_weight'] ?>;
				color: <?php echo $headlineFont['color']; ?>;
			}
			.section-title-link:hover {
				color:<?php echo $headlineFont['roll_color']; ?>;
				background-color:<?php echo $headlineFont['color']; ?>;
			}
			.thumb .info .title {
				<?php echo $subFont['font_family']; ?>;
				font-weight: <?php echo $subFont['font_weight'] ?>;
				color: <?php echo $subFont['color']; ?>;
			}
			nav {
				background-color:<?php echo $navFont['roll_color']; ?>;
			}
			.nav-btn,
			.nav-btn:link,
			.nav-btn:visited,
			.nav-btn:active,
			.social-btn,
			.social-btn:link,
			.social-btn:visited,
			.social-btn:active
			{
				<?php echo $navFont['font_family']; ?>;
				color:<?php echo $navFont['color']; ?>;
				background-color:<?php echo $navFont['roll_color']; ?>;
			}

			.nav-btn:hover,
			.social-btn:hover
			{
				color:<?php echo $navFont['roll_color']; ?>;
				background-color:<?php echo $navFont['color']; ?>;	
			}
		</style>
		<!-- theme style settings -->
	</head>
	<body <?php body_class(); ?>>	
	<header>
		<a href="/" class="nav-logo">
			<img src="<?php echo $siteLogo['image']; ?>" alt="<?php echo $siteLogo['alt_text']; ?>"/>
		</a>
		<nav>
			<div class="nav-btns">
			<?php
				$menu_items = wp_get_nav_menu_items( 'Main Menu' );
				foreach ( (array) $menu_items as $key => $menu_item ) :
				   	$title = $menu_item->title;
				    $url = $menu_item->url;
				    $attr_title = $menu_item->attr_title;
				    $btn_class = "nav-btn";
				    if($attr_title == $segments[0]) $btn_class = $btn_class . " active"; ?>
					<a href="<?php echo $url; ?>" class="<?php echo $btn_class; ?>"><?php echo $title; ?></a>
					
			<?php endforeach; ?>
			</div>
			<div class="social-btns">
			<?php
				$btn_class;
				$menu_items = wp_get_nav_menu_items( 'Social Menu' );
				foreach ( (array) $menu_items as $key => $menu_item ) :
				    $title = $menu_item->title;
				    $url = $menu_item->url;
				    $attr_title = $menu_item->attr_title;
				    $icon_class = get_field('icon_class', $menu_item);
					$btn_class = "social-btn";
					
					?>
				   	<a href="<?php echo $url; ?>" class="<?php echo $btn_class; ?>" target="_blank" >
						<i class="<?php echo $icon_class; ?>" aria-hidden="true" ></i>
						<span class="sr-only"><?php echo $title; ?></span>
                    </a>
			<?php endforeach; ?>
			</div>
		</nav>

		<div class="fa fa-bars menu-btn active" ></div>
      	<div class="fa fa-times close-btn" ></div>
	</header>
	<div id="site">
		<div class="holder">