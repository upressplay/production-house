<?php
	global $segments;
	$segments = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/')); 
	$template_uri = get_template_directory_uri();
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=<?php the_field('google_analytics', 'option'); ?>"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());

			gtag('config', '<?php the_field('google_analytics', 'option'); ?>');
		</script>

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
		<!-- theme style settings -->
		<style>
			<?php 
				$siteLogo = get_field('site_logo', 'option');
				$bodyfont = get_field('body_font', 'option');
				$webSafeFont = $bodyfont['web_safe_font'];
			?>
			body {
				background-color: <?php echo get_field('bg_color', 'option'); ?>;
				color: <?php echo get_field('body_text_color', 'option'); ?>;
				font-family: <?php echo $webSafeFont ; ?>;
			}
		</style>
	</head>
	<body <?php body_class(); ?>>	
	<header>
		<a href="/" class="nav-logo">
			<img src="<?php echo $siteLogo['image']; ?>" alt="<?php echo $siteLogo['alt_text']; ?>"/>
		</a>
		<nav>
			<div class="nav-btns">
			<?php
				$menu_items = wp_get_nav_menu_items( 'Top Menu' );
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

				   	echo '<a href="'.$url.'" target="_blank" >
                        <div class="'.$btn_class.'">
                          <span class="'.$icon_class.'" aria-hidden="true" ></span>
                          <span class="screen-reader-text">'.$title.'</span>
                        </div>
                    </a>'; 
				endforeach;
			?>
			</div>
		</nav>

		<div id="navMenuBtn" class="fa fa-bars menu-btn active" ></div>
      	<div id="navMenuCloseBtn" class="fa fa-times close-btn" ></div>
	</header>
	<div id="site">
		<div class="holder">