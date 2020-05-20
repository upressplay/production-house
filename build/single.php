<?php 
	get_header(); 
	$cat = get_the_category($post->ID);
	$catSlug = $cat[0]->slug;
	$catName = $cat[0]->name;
	?>

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<?php if ($catSlug == "videos") {
				get_template_part( 'entry-videos' );	
			} else {
				get_template_part( 'entry' );
			} 
		?>
	<?php endwhile; endif; ?>
	
<?php get_footer(); ?>
