<?php
	$link = get_permalink($post->ID);
	$target = "_self";
	$title = get_the_title($post->ID);	
	$date = get_the_date('M d, Y', $post->ID);	
	$body = get_the_content($post->ID);
	$summary = get_the_excerpt($post->ID);	
	$cat = get_the_category($post->ID);
	$cat = $cat[0]->slug;

	$vidid = get_field('youtube_vidid');
	$playlist = get_field('youtube_playlist');
	$vimeoid = get_field('vimeo_vidid');
	$vidFile = get_field('video_file');
	$urlOverride = get_field('url_override');

	$isVid = false;
	if($vidid != "" || $playlist != "" || $vimeoid != "" || $vidFile != "") {
		$isVid = true;
	}

	$thumb = get_the_post_thumbnail_url( $post->ID, $thumb_size );

	$headerImg = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "header" );
	$headerMobileImg = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "mobile_image" );
	$img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "large" );
	$hires = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "full" );

	if($thumb_size == 'tall') {
		$page_poster = get_field('page_poster');
		$thumb = $page_poster['sizes']['tall'];
	}
	$post_type = get_post_type( $post->ID  );
?>

<?php if($show_link) : ?>
	<?php if($urlOverride) : ?>
		<a href="<?php echo $urlOverride['url']; ?>" target="<?php echo $urlOverride['target']; ?>" class="post-override" >	
	<?php else: ?>
		<a href="<?php echo $link; ?>" data-postid="<?php echo $post->ID; ?>" class="<?php echo $cat; ?> <?php echo $post_type; ?>" >	
	<?php endif; ?>
<?php endif; ?>



<div class="thumb <?php echo $thumb_layout;?>" >

	<?php if($show_img) : ?>
		<div class="<?php echo $thumb_size;?> img-loader" data-img="<?php echo $thumb; ?>" data-title="<?php echo $title;?>"></div>
	<?php endif; ?>

	<?php if($show_title) : ?>
		<h3 class="title"><?php echo $title; ?>	</h3>
	<?php endif; ?>

	<?php if($show_date) : ?>
		<p class="date"><?php echo $date;?></p>	
	<?php endif; ?>

	<?php if($show_body) : ?>
		<p class="excerpt"><?php echo $body; ?></p>	
	<?php endif; ?>

	<?php if($show_summary) : ?>
		<p class="excerpt"><?php echo $summary;?></p>
	<?php endif; ?>

</div><!-- thumb -->
<?php if($show_link) : ?>
	</a>	
<?php endif; ?>
<div id="post-<?php echo $post->ID;?>" class="post-content" data-img="<?php echo $img[0];?>" data-img-w="<?php echo $img[1];?>" data-img-h="<?php echo $img[2]; ?>" data-header="<?php echo $headerImg[0]; ?>" data-hires="<?php echo $hires[0];?>" data-vidid="<?php echo $vidid;?>" data-vimeoid="<?php echo $vimeoid; ?>" data-vidfile="<?php echo $vidFile; ?>" data-playlist="<?php echo $playlist;?>" data-cat="<?php echo $cat;?>">
	

	<?php if($cat == "gallery" || $cat == "photography" || $cat == "photos") :?>
		<div class="holder">
			<figure>
				<figcaption>
					<div class="title"><?php echo $title;?></div>
					<div class="excerpt"><?php echo $summary; ?></div>
				</figcaption>
			</figure>
		</div>
	<?php elseif($isVid) :?>
		<div class="holder">
		<figure>
				<figcaption>
					<div class="title"><?php echo $title;?></div>
					<div class="page-content"><?php the_content(); ?></div>
				</figcaption>
			</figure>
		</div>
	<?php else: ?>
		<div class="holder">
			<div class="post-header-img"></div>
			<div class="section-title"><?php echo $title;?></div>
			<div class="date"><?php echo $date;?></div>	
			<div class="page-content"><?php the_content(); ?></div>
		</div>
	<?php endif; ?>
	

	<div data-id="<?php echo $post->ID; ?>" class="close ui fas fa-times-circle"></div>
	
	<?php include('social.php'); ?>
	<div class="right ui">
		<span class="fas fa-arrow-circle-right" aria-hidden="true" ></span>
		<span class="screen-reader-text">Next Post</span>
	</div>
	<div class="left ui">
		<span class="fas fa-arrow-circle-left" aria-hidden="true" ></span>
		<span class="screen-reader-text">Back Post</span>
	</div>
</div><!-- postContent -->
