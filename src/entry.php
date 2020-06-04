
<?php if ( has_post_thumbnail() ) : ?>
	<div class="header-img img-loader" data-img="<?php the_post_thumbnail_url('header'); ?>"></div>
<?php endif; ?>
<h1 class="section-title"> <?php the_title(); ?> </h1>
<?php include('social.php'); ?>
<article class="page-content">
	<?php the_content(); ?>
	<?php include('post-nav.php'); ?>
</article>
