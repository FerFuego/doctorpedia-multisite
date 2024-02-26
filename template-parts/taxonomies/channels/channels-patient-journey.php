<!-- Channel Patient Journey ACF -->
<?php $rand = rand(); ?>
<div class="channels-patient-journey">
    <div class="container">
        <img class="channels-patient-journey__arrow channels-patient-journey__prev prev_<?php echo $rand ?>" src="<?php echo IMAGES ?>/arrow-left.svg">
        <div class="channels-patient-journey__slider" id="slider_patient_journey_<?php echo $rand ?>">
            <?php while( have_rows('patient_journey') ) : the_row(); ?>
                <div class="channels-patient-journey__item">
                    <a href="<?php echo get_sub_field('call_to_action')['url']; ?>" target="<?php echo get_sub_field('call_to_action')['target']; ?>">
                        <div class="channels-patient-journey__video" style="background-image: url(<?php echo get_sub_field('preview_image')['sizes']['medium']; ?>); background-color: grey;">
                            <!-- <img class="channels-patient-journey__play" src="<?php //echo IMAGES .'/play-patient-journey.svg'; ?>" alt="Play"> -->
                        </div>
                    </a>
                    <div class="channels-patient-journey__content">
                        <div class="channels-patient-journey__channel"><?php echo get_sub_field('channel_name'); ?></div>
                        <h3 class="channels-patient-journey__title">
                            <?php echo get_sub_field('intro_title'); ?> 
                            <span><?php echo get_sub_field('title'); ?></span>
                        </h3>
                        <a class="channels-patient-journey__cta" href="<?php echo get_sub_field('call_to_action')['url']; ?>" target="<?php echo get_sub_field('call_to_action')['target']; ?>"><?php echo get_sub_field('call_to_action')['title']; ?></a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
        <img  class="channels-patient-journey__arrow channels-patient-journey__next next_<?php echo $rand ?>" src="<?php echo IMAGES ?>/arrow-right.svg">
    </div>   
</div>

<script>   
    $(window).on("resize", function() {
        $("#slider_patient_journey_<?php echo $rand ?>").not(".slick-initialized").slick("resize");
    });

    $(document).ready( function () {
        $("#slider_patient_journey_<?php echo $rand ?>").slick({
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            prevArrow: ( $(window).width() < 1024 ) ? $('.prev_<?php echo $rand; ?>').remove() : $('.prev_<?php echo $rand; ?>'),
            nextArrow: ( $(window).width() < 1024 ) ? $('.next_<?php echo $rand; ?>').remove() : $('.next_<?php echo $rand; ?>'),
            dots: false,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        dots: true,
                        arrows: false
                    }
                },
            ]
        });        
    });
</script>
<!-- End Channel Patient Journey ACF -->