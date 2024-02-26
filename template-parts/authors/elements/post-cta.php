<div class="post-cta-container">

    <img src="<?php echo IMAGES . '/public-profile/cta-3-points.svg'; ?>" alt="cta" onclick="activeCTA(this);">
    
    <div class="post-cta-container__body d-none" id="js-cta-container">

        <a href="javascript:;" class="mr-3" onclick="copyPostProfile(this)" data-link="<?php echo get_the_permalink(get_the_ID()); ?>"><img src="<?php echo IMAGES . '/public-profile/cta-clipboad.svg'; ?>" alt="clipboard"> Copy link</a>

        <?php if ( $posttype == 'Article' || $posttype == 'article' ) : ?>
            <a href="javascript:;" class="mr-3" onclick="featurePostProfile(this)" data-id="<?php echo get_the_ID(); ?>"><img src="<?php echo IMAGES . '/public-profile/cta-brand.svg'; ?>" alt="feature"> Feature this Article</a>
        <?php elseif ( $posttype == 'Blog' ) : ?>
            <a href="javascript:;" class="mr-3" onclick="featurePostProfile(this)" data-id="<?php echo get_the_ID(); ?>"><img src="<?php echo IMAGES . '/public-profile/cta-brand.svg'; ?>" alt="feature"> Feature Content</a>
        <?php endif; ?>
        
        <a href="javascript:;" onclick="deletePostProfile(this)" data-id="<?php echo get_the_ID(); ?>"><img src="<?php echo IMAGES . '/public-profile/cta-trash.svg'; ?>" alt="delete"> Delete</a>
    
    </div>

</div>

