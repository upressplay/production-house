<div class="social"> 
    <div class="page-social-btn share-btn" data-type="facebook" data-title="<?php echo get_the_title($post->ID) ?>" data-url="<?php echo get_permalink($post->ID) ?>" data-desc="<?php echo strip_tags(get_field('synopsis')); ?>">
        <span class="fab fa-facebook-square" aria-hidden="true" ></span>
        <span class="screen-reader-text">Facebook</span>
    </div>
    <div class="page-social-btn share-btn" data-type="twitter" data-title="<?php echo get_the_title($post->ID) ?>"  data-url="<?php echo get_permalink($post->ID) ?>" data-desc="<?php echo strip_tags(get_field('synopsis')); ?>">
        <span class="fab fa-twitter-square" aria-hidden="true" ></span>
        <span class="screen-reader-text">Twitter</span>
    </div>
</div><!-- social -->