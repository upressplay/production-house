<?php
	$link = get_permalink($post->ID);
	$title = get_the_title($post->ID);	
	$date = get_the_date('M d, Y', $post->ID);	
	$body = get_the_content($post->ID);
	$summary = get_the_excerpt($post->ID);	
	$cat = get_the_category($post->ID);
	$cat = $cat[0]->slug;

	$vidid = get_field('youtube_vidid');
	$playlist = get_field('youtube_playlist');
	$vimeoid = get_field('vimeo_vidid');

	$thumb = get_the_post_thumbnail_url( $post->ID, $thumb_size );
	//$img = get_the_post_thumbnail_url( $post->ID );

	$img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "large" );

	if($thumb_size == 'pageThumbTall') {
		$page_poster = get_field('page_poster');
		$thumb = $page_poster['sizes']['medium'];
	}

?>

<?php if($show_link) : ?>
	<a href="<?php echo $link; ?>" data-postid="<?php echo $post->ID; ?>" class="<?php echo $cat; ?> post" >	
<?php endif; ?>

<div class="pageThumb<?php echo $thumb_layout;?>" >
<?php if($show_img) : ?>
	<div class="<?php echo $thumb_size;?>"><img src="<?php echo $thumb; ?>" alt="<?php echo $title;?>"/></div>	
<?php endif; ?>
<?php if($show_title || $show_date || $show_body || $show_summary) : ?>
	<div class="pageThumbInfo">	
	<?php if($show_title) : ?>
		<h3 class="pageThumbTitle"><?php echo $title; ?>	
	<?php endif; ?>
	<?php if($show_date) : ?>
		<div class="pageThumbDate"><?php echo $date;?></div>	
	<?php endif; ?>
	<?php if($show_title) : ?>
		</h3><!-- pageThumbTitle -->	
	<?php endif;?>
	<?php if($show_body) : ?>
		<div class="pageThumbBody"><?php echo $body; ?></div>	
	<?php endif; ?>
	<?php if($show_summary) : ?>
		<div class="pageThumbBody"><?php echo $summary;?></div>
	<?php endif; ?>
	</div><!-- pageThumbInfo -->
	<?php endif; ?>

</div><!-- pageThumb -->
<?php if($show_link) : ?>
	</a>	
<?php endif; ?>

<div id="<?php echo $post->ID;?>" class="postContent" data-hires="<?php echo $img[0];?>'" data-hires-w="<?php echo $img[1];?>" data-hires-h="<?php echo $img[2]; ?>" data-vidid="<?php echo $vidid;?>" data-vimeoid="<?php echo $vimeoid; ?>" data-playlist="<?php echo $playlist;?>" data-cat="<?php echo $cat;?>">
	<?php if($cat != "videos" && $cat != "gallery") :?>
		<div class="pageSecTitle"><?php echo $title;?></div>
		<div class="pageThumbDate"><?php echo $date;?></div>	

		<div class="pageBody"><?php echo $body; ?></div>
	<?php endif; ?>
	<div data-id="<?php echo $post->ID; ?>" class="postClose fas fa-times-circle"></div>';
	<?php include('social.php'); ?>
	<div class="rightArrow">
		<span class="fas fa-arrow-circle-right" aria-hidden="true" ></span>
		<span class="screen-reader-text">Next Post</span>
	</div>
	<div class="leftArrow">
		<span class="fas fa-arrow-circle-left" aria-hidden="true" ></span>
		<span class="screen-reader-text">Back Post</span>
	</div>
</div><!-- postContent -->
