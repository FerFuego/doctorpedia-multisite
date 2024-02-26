<section class="affiliate-be-part">
    <div class="affiliate-be-part__header">
        <h2 class="affiliate-be-part__title"><?php echo (get_sub_field('affiliate__cta_title')) ? get_sub_field('affiliate__cta_title') : __('Be part of the biggest online healthcare community', 'doctorpedia'); ?></h2>
    </div>
    <div class="affiliate-be-part__body">
        <div class="affiliate-be-part__mobile-doctors">
            <img src="<?php echo (get_sub_field('affiliate__cta__mobile_image')) ? get_sub_field('affiliate__cta__mobile_image')['url'] : IMAGES .'/affiliate/doctors-mobile.png'; ?>" alt="">
        </div>
        <div class="affiliate-be-part__left-doctors">
            <img src="<?php echo (get_sub_field('affiliate__cta__left_image')) ? get_sub_field('affiliate__cta__left_image')['url'] : IMAGES .'/affiliate/left-group.png'; ?>" alt="">
        </div>
        <div class="affiliate-be-part__form">
            <?php echo do_shortcode('[gravityform id="4" title="true" description="false" ajax="true" tabindex="53"]'); ?>
            <?php if ( get_sub_field('sponsor__image') && get_sub_field('sponsor__text') ) : ?>
                <div class="affiliate-be-part__sponsor">
                    <img src="<?php echo get_sub_field('sponsor__image')['url']; ?>" alt="sponsor">
                    <p><?php echo get_sub_field('sponsor__text'); ?></p>
                </div>
            <?php else: ?>
                <br><br>
            <?php endif; ?>
        </div>
        <div class="affiliate-be-part__right-doctors">
            <img src="<?php echo (get_sub_field('affiliate__cta__right_image')) ? get_sub_field('affiliate__cta__right_image')['url'] : IMAGES .'/affiliate/right-group.png'; ?>" alt="">
        </div>
    </div>
</section>