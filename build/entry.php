
<div id="headerImg">
	<img src="<?php if ( has_post_thumbnail() ) { the_post_thumbnail_url(); } ?>"/>
</div>
<h1 class="pageSecTitle"> <?php the_title(); ?> </h1>
<?php include('social.php'); ?>
<article class="pageBody">
	<?php the_content(); ?>

</article>
<div class="page-nav">
	<?php previous_post_link('%link', '<i class="fas fa-caret-square-left"></i>', TRUE); ?>  <?php next_post_link('%link', '<i class="fas fa-caret-square-right"></i>', TRUE); ?> 
</div> 