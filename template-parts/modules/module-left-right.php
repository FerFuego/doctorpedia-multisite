<?php
    //ACF
    $order = get_sub_field('m-left_right__content_order');
    $title = get_sub_field('m-left_right__title');
    $iconTitle = get_sub_field('m-left_right__icon_title');
    $subtitle = get_sub_field('m-left_right__subtitle');
    $copy = get_sub_field('m-left_right__copy');
    $image = get_sub_field('m-left_right__image');
?>

<section class="m-left-right">

    <div class="m-left-right__container custom-container">

    <div class="m-left-right__content<?php if($order): ?> m-left-right__content--change-order<?php endif; ?>">

            <?php if($title): ?>

                <h2 class="m-left-right__title">
                    
                    <?php echo $title; ?>

                    <?php if($iconTitle): ?>

                        <img class="m-left-right__icon-title" src="<?php echo $iconTitle['url']; ?>" alt="<?php echo $iconTitle['alt']; ?>">

                    <?php endif; ?>
                
                </h2>
            
            <?php endif; ?>

            <?php if($subtitle): ?>

                <h3 class="m-left-right__subtitle"><?php echo $subtitle; ?></h3>

            <?php endif; ?>

            <?php if($copy): ?>

                <p class="m-left-right__copy"><?php echo $copy; ?></h3>

            <?php endif; ?>

            <?php if ( have_rows( 'm-left_right__check_list' ) ) :?>

                <div class="m-left-right__check-list<?php if($copy): ?> m-left-right__check-list--has-copy<?php endif; ?>">

                    <?php while ( have_rows('m-left_right__check_list') ) : the_row();
                        //ACF
                        $item = get_sub_field('m-left_right__item');?>
    
                        <p class="m-left-right__item"><?php echo $item; ?></p>
                        
                    <?php endwhile;?>

                </div>

            <?php endif; ?>

        </div>

        <?php if($image): ?>
        
            <img class="m-left-right__image" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">

        <?php endif; ?>

    </div>

</section>