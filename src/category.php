<?php 
    get_header(); 

    $show_link = true;
    $show_img = true;
    $show_title = true;
    $show_date = true;
    $show_body = false;
    $show_summary = true;
    $thumb_size = 'rect';
    $thumb_layout = "vert";

    foreach ($categorySettings as &$header) {
        $term_id = $cat[0]->term_id;
        $headerCat = $header['category'];
        if($cat[0]->term_id == $header['category']) {

            $show_link = false;
            $show_img = false;
            $show_title = false;
            $show_date = false;
            $show_body = false;
            $show_summary = false;
            
            foreach ($header['thumb_style']['thumb_elements'] as &$el) {
                if($el == "img") $show_img = true;
                if($el == "title") $show_title = true;
                if($el == "date") $show_date = true;
                if($el == "body") $show_body = true;
                if($el == "summary") $show_summary = true;
                if($el == "link") $show_link = true;
            }
            $thumb_size = $header['thumb_style']['thumb_size'];
            $thumb_layout = $header['thumb_style']['thumb_layout'];
        }
    }
?>

<div class="header-img img-loader" data-img="<?php echo $defaultHeader; ?>" data-img-mobile="<?php echo $defaultMobileHeader; ?>" data-title="<?php echo $cat_name; ?>"></div> 
<h1 class="section-title headline-font"> <?php echo $cat_name; ?> </h1>	
<div class="category">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<?php 
    
    
   include( locate_template( 'post.php', false, false ) ); 
?>
<?php endwhile; endif; ?>
</div>

<?php include('page-nav.php'); ?>
<?php get_footer(); ?>