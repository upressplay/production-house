<?php 
	$vidid = get_field('youtube_vidid');
	$playlist = get_field('youtube_playlist');
	$vimeoid = get_field('vimeo_vidid');
	$vidFile = get_field('video_file');
?>
<?php if ( has_post_thumbnail() ) : ?>
	<div class="header-img" data-img="<?php the_post_thumbnail_url('header'); ?>"></div>
<?php endif; ?>
<h1 class="section-title"> <?php the_title(); ?> </h1>
<?php include('social.php'); ?>
<article class="page-content">
	
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
	<div class="page-nav">
		<?php previous_post_link('%link', '<i class="fas fa-caret-square-left"></i>', TRUE); ?>  <?php next_post_link('%link', '<i class="fas fa-caret-square-right"></i>', TRUE); ?> 
	</div> 
</article>