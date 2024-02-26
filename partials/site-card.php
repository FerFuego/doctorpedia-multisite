<div class="site-card">
    <div class="site-card__img" style="background-image: linear-gradient(to top, rgba(0, 0, 0, 0.9), rgba(0, 0, 0, 0)), url(<?php echo get_the_post_thumbnail_url($site->ID, 'medium'); ?>);">
        <h3 class="site-card__img-title"><?php echo $site->post_title; ?></h3>
    </div>
    
    <div class="site-card__content">
        <a class="site-card__link" href="<?php echo normalize_link( get_field('blog_url', $site->ID) ); ?>" target="_blank">Visit Site<img src="<?php echo IMAGES ?>/icons/arrow-right-turquoise.svg" class="site-card__link-arrow"></a>
    </div>
</div>