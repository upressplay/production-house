<?php 
	$header = get_the_post_thumbnail_url($post->ID);
	if($header == "") {
		$header = $defaultHeader;	
	} 
?>
<div class="header-img img-loader" data-img="<?php echo $header; ?>"></div>
<h1 class="section-title headline-font"> <?php the_title(); ?> </h1>
<?php include('social.php'); ?>
<article class="page-content">
	<?php the_content(); ?>
	<?php include('post-nav.php'); ?>
</article>
