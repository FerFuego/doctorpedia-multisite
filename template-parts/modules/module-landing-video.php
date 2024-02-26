<?php $button= get_sub_field('m-landing-video__button'); ?>

<section class="m-landing-video">

    <div class="m-landing-video__body container">

        <h2><?php echo get_sub_field('m-landing-video__title');?></h2>
    
        <div class="m-landing-video__body__container">

            <div class="shadow-content"></div>

            <div class="content" style="background-image: url('<?php echo (get_sub_field('m-landing-video__image')) ? get_sub_field('m-landing-video__image')['url'] : IMAGES . '/landing/placeholder-video.png'; ?>')">

                <a class="m-video__url video-modal-open js-videos-iframe2 d-flex justify-content-center align-items-center" href="<?php echo get_sub_field('m-landing-video__video');?>">
                
                    <img src="<?php echo IMAGES . '/crowdfunding/video-play.svg'; ?>" alt="play"><!-- play button -->

                </a>

            </div>

        </div>

    </div>

    <?php if ( $button && $button['title'] !== '' ) : ?>
        <a href="<?php echo $button['url']; ?>" target="<?php echo $button['target']; ?>" class="btn-rounded js-pre-register-modal"><?php echo $button['title']; ?> <img src="<?php echo get_template_directory_uri(); ?>/img/modules/webcast/single-right-arrow-white.svg" alt></a>
    <?php endif; ?>

</section>