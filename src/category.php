<?php 
    get_header(); 
    $cat = get_the_category();
    $cat_name = $cat[0]->name;
?>

<div class="header-img img-loader" data-img="<?php echo $defaultHeader; ?>"></div> 
<h1 class="section-title headline-font"> <?php echo $cat_name; ?> </h1>	
<div class="category">
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
       $thumb_size = 'rect';
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
   if($cat_name == "Videos") {
        $show_date = false;
        $show_body = false;
        $show_summary = false;
    }
   include( locate_template( 'post.php', false, false ) ); 
?>
<?php endwhile; endif; ?>
</div>

<?php include('page-nav.php'); ?>
<?php get_footer(); ?>