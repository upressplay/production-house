<?php get_header(); 
$cat = get_the_category();
$cat_name =$cat->name;
echo $cat_name;
?>
<div class="">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<?php 
    
    $show_link = true;
    $show_img = true;
    $show_title = true;
    $show_date = true;
    $show_body = false;
    $show_summary = true;
    $thumb_size = 'rect';
    $thumb_layout = "vert";
   if($cat_name == "News") {
       $thumb_size = 'sq';
       $thumb_layout = "horz";	
   }

   if($cat_name == "Gallery") {
       $thumb_size = 'sqsm';
       $thumb_layout = "sm";
       $show_title = false;
       $show_date = false;
       $show_summary = false;
   }
   if($cat_name == "Team") {
       $show_link = false;
       $show_date = false;
       $thumb_size = 'sq';
       $thumb_layout = "horz";	
   }
   if($cat_name == "Services") {
       $show_link = false;
       $show_date = false;
       $show_body = true;
       $show_summary = false;
   }
   include( locate_template( 'post.php', false, false ) ); 
?>
<?php endwhile; endif; ?>
</div>

<?php get_footer(); ?>