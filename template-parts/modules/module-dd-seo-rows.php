<div class="seo-rows">
    <div class="seo-rows__container">
        <?php if ( have_rows( 'dd_seo_items_rows' ) ) : 
            while ( have_rows('dd_seo_items_rows' ) ) : the_row();
                $card_icon = get_sub_field('card_icon'); 
                $card_title = get_sub_field('card_title'); 
                $card_copy = get_sub_field('card_copy'); 
            ?>
                <div class="seo-card">
                
                    <?php if ( $card_icon ) : ?>
                        <div class="seo-card__icon">
                            <img class="seo-card__img" src="<?php echo $card_icon['url']; ?>" alt="<?php echo $card_icon['title']; ?>">
                        </div>
                    <?php endif; ?>
                
                    <?php if ( $card_title ) : ?>
                        <h2 class="seo-card__title"><?php echo $card_title; ?></h2>
                    <?php endif; ?>
                
                    <?php if ( $card_copy ) : ?>
                        <p class="seo-card__copy"><?php echo $card_copy; ?></p>
                    <?php endif; ?>
                    
                </div>
            <?php endwhile;
        endif; ?>
    </div>
</div>