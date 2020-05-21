<?php 
	get_header(); 


	if ( have_posts() ) {
		while ( have_posts() ) {

			the_post(); 

			$output = ""; 

			$section_link = get_sub_field('section_page');
			$page_poster = get_field('page_poster');
			$content = get_the_content();
			$cats = get_categories();
			
			if ( has_post_thumbnail() ) : ?>
				<div class="headerImg" style="background-image:url(<?php echo  get_the_post_thumbnail_url($post->ID, "header");?>)"></div> 
			<?php endif; ?>
			<?php if( !is_front_page() ) : ?>
				<h1 class="pageSecTitle rainbow"> <?php echo get_the_title(); ?> </h1>	
			<?php endif; ?>

			
			<div class="pageHeader">
			
		    <?php if($page_poster != "" || have_rows('page_links') ) :
		    	if(!empty_content($content)) : ?>
			    	<div class="pageInfoBody">
			    		<?php echo $content; ?> 
			    	</div><!-- pageInfoBody -->
			<?php endif; ?>

		    	<div class="pageInfo">
				<?php if($page_poster != "") : ?>
					<a href="<?php echo $page_poster['sizes']['large']; ?>" class="pagePoster" target="_blank"> 
						<img src="<?php echo $page_poster['sizes']['medium'];?>">
					</a>
				<?php endif; ?>
				
				<?php if( have_rows('page_links') ) :	?>	
					<div class="pageLinks"> 
						<?php while( have_rows('page_links') ) :
							the_row(); ?>
							<a href="<?php echo get_sub_field('page_link'); ?>" target="_blank" class="pageLink"> 
							<?php echo get_sub_field('page_link_txt'); ?>
							</a>
						<?php endwhile; ?>
			    	</div>
				<?php endif; ?>
				
				<?php include('social.php'); ?>
			    </div><!-- pageInfo -->

				<?php else: ?>
			    <?php if(!empty_content($content)) : ?>
		    		<div class="pageBody"> 
		    			<?php echo $content; ?> 
		    		</div><!-- pageBody -->
				<?php endif; ?>
		    	
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
							<div class="pageSecTitleLink">
							<a href="<?php echo $section_link; ?>"> 
							<h2 class="pageSecTitle rainbow">
								<?php echo $section_title.' ';?>
							</h2>
							</a></div>
						<?php else: ?>
							<h2 class="pageSecTitle rainbow"> <?php echo $section_title;?> </h2>
						<?php endif; ?>
						
					<?php endif; ?>
					<div class="pageRow"> 
					<?php 
					$thumb_style = get_sub_field('thumb_style'); 
		       		$thumb_size = 'pageThumb'.$thumb_style['thumb_size'];
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
			<div id="postOverlay"></div><!-- postOverlay -->
			<?php 

			foreach ( $cats as $cat ) :

				 $cat_name =$cat->name;

				if( is_page($cat_name)) :
					global $post;
					$args = array( 'category_name' => $cat_name,  'numberposts' => 100, ); ?>
					<div class="pageRow">
					<?php
					$category_posts = get_posts( $args );

					$posts_count = count($category_posts);
					foreach ( $category_posts as $post ) :
						setup_postdata( $post ); 
						$show_link = true;
						$show_img = true;
		       			$show_title = true;
		       			$show_date = true;
		       			$show_body = false;
		       			$show_summary = true;
		       			$thumb_size = 'pageThumbRect';
		       			$thumb_layout = "Vert";
		       			if($cat_name == "News") {
		       				$thumb_size = 'pageThumbSq';
		       				$thumb_layout = "Horz";	
		       			}

		       			if($cat_name == "Gallery") {
		       				$thumb_size = 'pageThumbSqSm';
		       				$thumb_layout = "Sm";
		       				$show_title = false;
		       				$show_date = false;
		       				$show_summary = false;
		       			}
		       			if($cat_name == "Team") {
		       				$show_link = false;
		       				$show_date = false;
		       				$thumb_size = 'pageThumbSq';
		       				$thumb_layout = "Horz";	
		       			}
		       			if($cat_name == "Services") {
		       				$show_link = false;
		       				$show_date = false;
		       				$show_body = true;
		       				$show_summary = false;
		       			}

						include( locate_template( 'post.php', false, false ) ); 	

					endforeach;
					
					wp_reset_postdata(); ?>
					</div> 
				<?php endif;
			endforeach;
		}
	}

	get_footer();
?>