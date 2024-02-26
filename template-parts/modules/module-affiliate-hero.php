<?php
    //ACF
    $form = get_sub_field('affiliate__form');
    $formCta = get_sub_field('affiliate__form_cta');
    $contentType = get_sub_field('affiliate__content_type');
    $contentCtaType = get_sub_field('affiliate__cta_content_type');
    $mediaType = get_sub_field('affiliate__media_type');
    $title = get_sub_field('affiliate__title');
    $copy = get_sub_field('affiliate__copy');
?>

<section class="affiliate-hero">

    <div class="affiliate-hero__container custom-container">

        <?php if(!$contentType): ?>

            <div class="affiliate-hero__form">

                <?php echo do_shortcode('[gravityform id="' . $form . '" title="true" description="false" ajax="true" tabindex="49"]'); ?>

                <?php if ( get_sub_field('sponsor__image') && get_sub_field('sponsor__text') ) : ?>

                    <div class="affiliate-hero__sponsor">

                        <img src="<?php echo get_sub_field('sponsor__image')['url']; ?>" alt="sponsor">

                        <p><?php echo get_sub_field('sponsor__text'); ?></p>

                    </div>

                <?php else: ?>

                    <br><br>

                <?php endif; ?>

            </div>

        <?php else: ?>

            <div class="affiliate-hero__content">

                <h2 class="affiliate-hero__title"><?php echo $title; ?></h2>

                <p class="affiliate-hero__copy"><?php echo $copy; ?></p>

                <?php if ($contentCtaType) : ?>

                    <!-- Buttons -->
                    <div class="affiliate-hero__buttons">
    
                        <?php if ( have_rows( 'affiliate__buttons' ) ) :
        
                            while ( have_rows('affiliate__buttons') ) : the_row(); 
        
                                $button = get_sub_field('affiliate__button');?>
                                
                                    <a class="affiliate-hero__button btn" href="<?php echo $button['url']; ?>" target="<?php echo $button['target']; ?>"><?php echo $button['title']; ?></a>
        
                            <?php endwhile;
        
                        endif; ?>
            
                    </div>
                    <!-- Buttons -->

                <?php else : ?>

                    <!-- Form -->
                    <div class="affiliate-hero__form affiliate-hero__form--cta">
                        <?php echo do_shortcode('[gravityform id="' . $formCta . '" title="true" description="false" ajax="true" tabindex="49"]'); ?>
                    </div>

                    <?php if ( get_sub_field('sponsor__image_cta') && get_sub_field('sponsor__text_cta') ) : ?>

                        <div class="affiliate-hero__sponsor">

                            <img src="<?php echo get_sub_field('sponsor__image_cta')['url']; ?>" alt="sponsor">

                            <p><?php echo get_sub_field('sponsor__text_cta'); ?></p>

                        </div>

                    <?php endif; ?>
                    <!-- Form -->

                <?php endif; ?>

            </div>

        <?php endif; ?>


        <div class="affiliate-hero__video">

            <?php if ( !get_sub_field('affiliate__video-type') && !$mediaType ) : ?> 

                <!-- Video Autoplay -->
                <div class="video_popup">

                    <?php if ( get_sub_field('affiliate__video_autoplay') ) : ?>
                        <video style="width: 350px;" muted loop autoplay>
                            <source src="<?php echo get_sub_field('affiliate__video_autoplay') . '?autoplay=1';?>" type="video/mp4">
                            <source src="<?php echo get_sub_field('affiliate__video_autoplay') . '?autoplay=1';?>" type="video/quicktime">
                            Your browser does not support the video tag.
                        </video>
                    <?php endif; ?>

                </div>

            <?php else : ?>

                <?php if (get_sub_field('affiliate__image')) : ?>
                    <img class="affiliate-hero__image <?php echo (get_sub_field('affiliate__image_mobile')) ? 'hidden-xs':''; ?>" src="<?php echo get_sub_field('affiliate__image')['url']; ?>" alt="desktop">
                <?php endif; ?>

                <?php if (get_sub_field('affiliate__image_mobile')) : ?>
                    <img class="affiliate-hero__image affiliate-hero__image--mobile" src="<?php echo get_sub_field('affiliate__image_mobile')['url']; ?>" alt="mobile">
                <?php endif; ?>

                <!-- Video PopUp -->
                <div class="video_popup" style="<?php if(!$mediaType){ echo 'border-radius: 10px; '; }?>background-image: url(<?php echo (get_sub_field('affiliate__image')) ? get_sub_field('affiliate__image')['url'] : IMAGES . '/affiliate/video-hala.jpg'; ?>)">

                    <?php if ( get_sub_field('affiliate__video') && !$mediaType ) : ?>
                        <a class="js-videos-iframe-3" href="<?php echo get_sub_field('affiliate__video');?>">
                            <img class="video_popup__cta" src="<?php echo IMAGES . '/affiliate/white-play.svg'; ?>">
                        </a>
                    <?php endif ?>

                </div>

            <?php endif; ?>

        </div>

    </div>

</section>