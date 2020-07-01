<?php 
	get_header(); 


	if ( have_posts() ) {
		while ( have_posts() ) {

			the_post(); 

			$output = ""; 

			$section_link = get_sub_field('section_page');
			$page_poster = get_field('page_poster');
			$content = get_the_content();

			$header = get_the_post_thumbnail_url($post->ID, "header");
			if($header == "") {
				$header = $defaultHeader;	
			} 
			?>
			<div class="header-img img-loader" data-img="<?php echo $header; ?>"></div> 
			<?php if( !is_front_page() ) : ?>
				<h1 class="section-title"> <?php echo get_the_title(); ?> </h1>	
			<?php endif; ?>

			
			<div class="page-header">
			
		    <?php if($page_poster != "" || have_rows('page_links') ) :
		    	if(!empty_content($content)) : ?>
			    	<div class="page-content">
			    		<?php echo $content; ?> 
			    	</div><!-- page-content -->
			<?php endif; ?>

		    	<div class="info">
				<?php if($page_poster != "") : ?>
					<a href="<?php echo $page_poster['sizes']['large']; ?>" class="poster" target="_blank"> 
						<img src="<?php echo $page_poster['sizes']['medium'];?>">
					</a>
				<?php endif; ?>
				
				<?php if( have_rows('page_links') ) :	?>	
					<div class="links"> 
						<?php while( have_rows('page_links') ) :
							the_row(); ?>
							<a href="<?php echo get_sub_field('page_link'); ?>" target="_blank" class="headline-font"> 
							<?php echo get_sub_field('page_link_txt'); ?>
							</a>
						<?php endwhile; ?>
			    	</div>
				<?php endif; ?>
				
				<?php include('social.php'); ?>
			    </div><!-- .info -->

				<?php else: ?>
		    		<div class="page-content"> 
		    			<?php the_content(); ?> 
		    		</div><!-- page-content -->
		    	
			<?php endif; ?>
			 
		   
			</div><!-- pageHeader --> 

			<?php 
				if( is_page('resume')) : 
					include('resume.php');
				endif;
			?>

			<?php if( have_rows('page_gallery') ) :	?>	 
		    	<?php while( have_rows('page_gallery') ) :

		    		the_row(); 

		       		$section_title = get_sub_field('section_title');
		       		$section_link = get_sub_field('section_page');
		       		if($section_title != "") : ?>

						<?php if($section_link != "") : ?>
							<div class="section-title-link">
							<a href="<?php echo $section_link; ?>"> 
							<h2 class="section-title rainbow">
								<?php echo $section_title.' ';?>
							</h2>
							</a></div>
						<?php else: ?>
							<h2 class="section-title rainbow"> <?php echo $section_title;?> </h2>
						<?php endif; ?>
						
					<?php endif; ?>
					<div class="page-row"> 
					<?php 
					$thumb_style = get_sub_field('thumb_style'); 
		       		$thumb_size = $thumb_style['thumb_size'];
		       		$show_img = false;
		       		$show_title = false;
		       		$show_date = false;
		       		$show_body = false;
		       		$show_summary = false;
		       		$show_link = false;

		       		foreach( $thumb_style['thumb_elements'] as $el ) {
		       			if($el == "img") $show_img = true;
		       			if($el == "title") $show_title = true;
		       			if($el == "date") $show_date = true;
		       			if($el == "body") $show_body = true;
		       			if($el == "summary") $show_summary = true;
		       			if($el == "link") $show_link = true;
		       		}

		       		$thumb_layout = $thumb_style['thumb_layout']; 
		       		
		       		$post_objects = get_sub_field('page_objects');

					foreach ( $post_objects as $post_object ) {
						foreach ( $post_object as $post) {
							setup_postdata( $post );

							include( locate_template( 'post.php', false, false ) ); 

							wp_reset_postdata();	
						}
					} ?>
					</div> 

				<?php endwhile; ?>
				<?php endif; ?>
			
			<?php 

			
		}
	}

	get_footer();
?>