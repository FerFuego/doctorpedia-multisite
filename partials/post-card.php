
<div class="blog-card slider-single-item">
    <div class="blog-card__img" style="background-image:url(<?php echo get_the_post_thumbnail_url($article->ID, 'medium'); ?>);"></div>
    <div class="blog-card__content">
        <h3 class="blog-card__title"><?php echo $article->post_title; ?></h3>
        <p class="blog-card__copy"><?php echo custom_trim_excerpt( $article->ID, null, 20 ); ?></p>
        <a href="<?php echo get_permalink($article->ID); ?>" class="blog-card__link">Read Blog</a>        
    </div>
</div>