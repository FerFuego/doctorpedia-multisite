<!-- Channel Simple Slider Template Part -->
<?php $rand = rand(); ?>

<div class="channel-simple-slider">
    <div class="container">

        <div class="channel-simple-slider__header">
            <h2 class="channel-simple-slider__header-title"><?php echo get_sub_field('m-channels__title'); ?></h2>
        </div>

        <div class="channel-simple-slider__body">
            
            <img src="<?php echo IMAGES ?>/icons/prev-grey.svg" class="channel-simple-slider__prev prev_<?php echo $rand; ?>">

            <div class="channel-simple-slider__slider slider_<?php echo $rand; ?>" id="slider_<?php echo $rand; ?>">
                <?php while( have_rows('items') ) : the_row(); ?>

                    <div class="channel-simple-slider__card">
                        <h2 class="channel-simple-slider__card-title"><?php echo get_sub_field('m-channels__title'); ?></h2>
                        <p class="channel-simple-slider__card-copy"><?php echo get_sub_field('m-channels__copy'); ?></p>
                        <a 
                            class="channel-simple-slider__card-cta" 
                            href="<?php echo get_sub_field('m-channels__link')['url']; ?>" 
                            class="slider-single-title" 
                            target="<?php echo get_sub_field('m-channels__link')['target']; ?>">
                                <?php echo get_sub_field('m-channels__link')['title']; ?>
                                <img src="<?php echo IMAGES. '/icons/mini-right-arrow.svg'; ?>" alt>
                        </a>
                    </div>

                    <?php wp_reset_postdata() ?>
                
                <?php endwhile; ?>
            </div>
        
            <img src="<?php echo IMAGES ?>/icons/next-grey.svg" class="channel-simple-slider__next next_<?php echo $rand; ?>">

        </div>
    </div>
</div>

<script>   
    $("document").ready(function(){
        var divs = document.getElementsByClassName("channel-simple-slider__card").length;

        if (divs <= 3 ) {
            $('.next_<?php echo $rand; ?>').remove();
            $('.prev_<?php echo $rand; ?>').remove();
        }

        $("#slider_<?php echo $rand; ?>").slick({
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 3,
            prevArrow: ( $(window).width() < 769 ) ? $('.prev_<?php echo $rand; ?>').remove() : $('.prev_<?php echo $rand; ?>'),
            nextArrow: ( $(window).width() < 769 ) ? $('.next_<?php echo $rand; ?>').remove() : $('.next_<?php echo $rand; ?>'),
            dots: ( $(window).width() < 769 ) ? true : false,
            responsive: [
                {
                    breakpoint: 1930,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                    }
                },
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                    }
                },
                {
                    breakpoint: 450,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    }
                },
            ]
        });
    });
    
    $(window).on("resize", function() {
        $("#slider_<?php echo $rand ?>").not(".slick-initialized").slick("resize");
    });
</script>
<!-- End Channel Simple Slider Template Part -->