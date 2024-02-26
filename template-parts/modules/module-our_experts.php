<section class="module-our-experts" id="js-ourExpertsModule" style="background-color:<?php echo get_sub_field('background_color'); ?>;">

    <div class="module-our-experts__header">
        <h2><?php echo get_sub_field('title_section'); ?></h2>
        <p class="copy"><?php echo get_sub_field('subtitle_section'); ?></p>
    </div>

    <div class="module-our-experts__body container" id="js-doctorDirectory">
        <?php if ( have_rows( 'experts' ) ) : 
            while ( have_rows('experts' ) ) : the_row();
                $expert = get_sub_field('expert');
                set_query_var( 'user', $expert );
                get_template_part( 'partials/expert-card' );
            endwhile;
        endif; ?>
    </div>

    <?php if ( get_sub_field('view_all_link') ) : ?>
        <div class="module-our-experts__footer">
            <a href="<?php echo get_sub_field('view_all_link')['url']; ?>" target="<?php echo get_sub_field('view_all_link')['target'];?>" class="btn-rounded bg-primary-pink">
                <?php echo get_sub_field('view_all_link')['title']; ?>
                <img src="<?php echo IMAGES . '/modules/webcast/single-right-arrow-white.svg'; ?>" alt>
            </a>
        </div>
    <?php endif; ?>

</section>