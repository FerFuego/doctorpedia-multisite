<section class="m-landing-plataform" id="plataform">
    <div class="m-landing-plataform__primary_box container">
        <h3 class="m-landing-plataform__title"><?php echo get_sub_field('m-landing-plataform__title');?></h3>
        <p class="m-landing-plataform__copy"><?php echo get_sub_field('m-landing-plataform__copy');?></p>
    </div>

    <div class="m-landing-plataform__secondary_box container">
        <div class="img-box-platform" index="1">
            <img src="<?php echo ( get_sub_field('m-landing-plataform__left-image') ) ? get_sub_field('m-landing-plataform__left-image')['url'] : IMAGES . '/landing/mockup1.png'; ?>" alt="picture">
        </div>

        <div class="img-box-platform" index="2">
            <img src="<?php echo ( get_sub_field('m-landing-plataform__center-image') ) ? get_sub_field('m-landing-plataform__center-image')['url'] : IMAGES . '/landing/mockup2.png'; ?>" alt="picture">
        </div>

        <div class="img-box-platform" index="3">
            <?php if ( get_sub_field('m-landing-plataform__right-image') ) : ?>
                <video style="width: 270px; margin-top: -62px;" muted autoplay>
                    <source src="<?php echo get_sub_field('m-landing-plataform__right-image') . '?autoplay=1';?>" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            <?php else : ?>
                <span></span>
                <img src="<?php echo IMAGES . '/landing/mockup3.png'; ?>" alt="picture">
            <?php endif; ?>
        </div>
    </div>

    <a href="<?php echo esc_url(home_url('/platform-register')); ?>" target="_blank" class="btn-rounded">Build Your Profile <img src="<?php echo get_template_directory_uri(); ?>/img/modules/webcast/single-right-arrow-white.svg" alt></a>

</section>

<script>
    /**
     * Loop videos landing page
     */
    jQuery('video').on('ended', function () {
        this.load();
        this.play();      
    })
</script>