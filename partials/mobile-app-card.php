<?php
$taxonomytype   = $app->taxonomy . '_' . $app->term_id;
$image          = get_field( 'image', $taxonomytype );
$ratings        = calcGralRating( $app->term_id ); // Return Prom Ratings
$overall        = ($ratings) ? $ratings['rating'] : 0;
$description    = (get_term_meta($app->term_id, 'long_description', true)) ? get_term_meta($app->term_id, 'long_description', true) : $app->description;
$description    = strip_tags( $description, '<p><a><b><br><strong>');
$appLink        = get_term_meta( $app->term_id, 'app_link', true );
$sites          = get_field( 'wp_multisites', $taxonomytype );
?>

<div>
    <div class="mobile-app-card">
    
        <div class="mobile-app-card__container">
    
            <div class="mobile-app-card__img" 
                style="background-image: url('<?php echo $image; ?>');"></div>
    
            <div class="mobile-app-card__column">
    
                <a href="<?php echo get_category_link( $app->term_id ); ?>">
                    <h2 class="mobile-app-card__title"><?php echo ( strlen( $app->name ) > 30 ) ? Cadena::corta( $app->name, 30) : $app->name; ?></h2>
                </a>
    
                <div class="mobile-app-card__stars-group">
    
                    <div class="mobile-app-card__inner">
    
                        <div class="mobile-app-card__overall-score">
                            <?php echo @number_format( $overall, 1, '.', ',' ); ?>
                        </div>
    
                        <div class="mobile-app-card__star-module">
    
                            <?php for ($i=1; $i < 6; $i++) :
                                if($i <= $overall) : ?>
                                    <img class="mobile-app-card__star" src="<?php echo IMAGES . '/modules/mobile-apps/star-black.svg'; ?>" alt="Star">
                                <?php else : ?>
                                    <img class="mobile-app-card__star" src="<?php echo IMAGES . '/modules/mobile-apps/star-gray.svg'; ?>" alt="Star">
                                <?php endif;
                            endfor; ?>
    
                        </div>
                        
                    </div>
                    
                    <a class="mobile-app-card__reviews" href="<?php echo get_category_link( $app->term_id ); ?>"><?php echo $app->count; ?> Reviews</a>
                
                </div>
    
            </div>
    
            <div class="mobile-app-card__description">
                <?php echo ( strlen( $description ) > 140 ) ? Cadena::corta( $description, 140) : $description; ?>
            </div>
    
        </div>
    
        <div class="mobile-app-card__footer">
           <a class="mobile-app-card__view-review" href="<?php echo get_category_link( $app->term_id ); ?>">Overview</a>
        </div>
    
    </div>
</div>