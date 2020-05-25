
<?php if ( has_post_thumbnail() ) : ?>
	<div class="header-img" data-img="<?php the_post_thumbnail_url('header'); ?>"></div>
<?php endif; ?>
<h1 class="section-title"> <?php the_title(); ?> </h1>
<?php include('social.php'); ?>
<article class="page-content">

1111
	<?php the_content(); ?>
</article>
<div class="page-nav">
	<?php previous_post_link('%link', '<i class="fas fa-caret-square-left"></i>', TRUE); ?>  <?php next_post_link('%link', '<i class="fas fa-caret-square-right"></i>', TRUE); ?> 
</div> 