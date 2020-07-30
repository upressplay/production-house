<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<?php 

	$vidid = get_field('youtube_vidid');
	$playlist = get_field('youtube_playlist');
	$vimeoid = get_field('vimeo_vidid');
	$vidFile = get_field('video_file');
	$isVid = false;
	if($vidid != "" || $playlist != "" || $vimeoid != "" || $vidFile != "") {
		$isVid = true;
	}
	$header = get_the_post_thumbnail_url($post->ID, "header");
	if($header == "") {
		$header = $defaultHeader;	
	} 
	?>
	<div class="header-img img-loader" data-img="<?php echo $header; ?>"></div>
	<h1 class="section-title"> <?php the_title(); ?> </h1>
	<?php include('social.php'); ?>
	<article class="page-content">
		<?php if($isVid) : ?>
			<div class="vid">
			<?php 
				$vidEmbed;
				if($vidid != "") {
					$vidEmbed = '<iframe src="https://www.youtube.com/embed/'.$vidid.'" width="100%" height="100%" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
				}

				if($playlist != "") {
					$vidEmbed = '<iframe src="https://www.youtube.com/embed/videoseries?list='.$playlist.'" width="100%" height="100%" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
				}

				if($vimeoid != "") {
					$vidEmbed = '<iframe src="https://player.vimeo.com/video/'.$vimeoid.'" width="100%" height="100%" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>';
				}
				if($vidFile != "") {
					$vidEmbed = '<video width="100%" height="100%" controls autoplay><source src="'.$vidFile.'" type="video/mp4">Your browser does not support the video tag.</video>';
				}
				echo $vidEmbed;
			?>
			
			</div>
			<div class="vid-content">
				<?php the_content(); ?>
			</div>
		<?php else : ?>
		<?php the_content(); ?>
		<?php endif; ?>
		<?php include('post-nav.php'); ?>
	</article>
<?php endwhile; endif; ?>
	
<?php get_footer(); ?>
