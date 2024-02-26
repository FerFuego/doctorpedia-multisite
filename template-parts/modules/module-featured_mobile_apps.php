<?php
    $title = get_sub_field('title_section');
    $cta = get_sub_field('call_to_action');
    $slider_id = rand(0,999999);
?>
<section class="featured-mobile-apps" id="js-featuredMobileAppsModule">
    <div class="featured-mobile-apps__container">

        <?php if ( $title ) : ?>
            <div class="featured-mobile-apps__header">
                <h2 class="featured-mobile-apps__title"><?php echo $title; ?></h2>
                <?php if ($cta) : ?>
                    <a class="featured-mobile-apps__link" href="<?php echo $cta['url']; ?>" target="<?php echo $cta['target']; ?>">
                        <?php echo $cta['title']; ?>
                        <img class="featured-mobile-apps__arrow" src="<?php echo get_template_directory_uri()?>/img/modules/channels/single-right-arrow-pink.svg" alt="">
                    </a>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php if ( have_rows( 'mobile_apps' ) ) : ?>
            <img src="<?php echo IMAGES . '/icons/stroke-prev.svg'; ?>" class="featured-mobile-apps__prev prev_<?php echo $slider_id ?>">
            <div class="slider-container slider_<?php echo $slider_id ?>" id="slider_<?php echo $slider_id ?>">
                <?php while ( have_rows('mobile_apps' ) ) : the_row();
                    $app = get_sub_field('mobile_app'); 
                    set_query_var('app', $app);
                    get_template_part('partials/mobile-app-card');
                endwhile; ?>
            </div>
            <img src="<?php echo IMAGES . '/icons/stroke-next.svg'; ?>" class="featured-mobile-apps__next next_<?php echo $slider_id ?>">
        <?php endif; ?>

        <div class="featured-mobile-apps__footer">
            <a class="featured-mobile-apps__footer-btn btn-rounded bg-primary-pink" href="<?php echo get_sub_field('call_to_action')['url']; ?>" target="<?php echo get_sub_field('call_to_action')['target'];?>">
                <?php echo get_sub_field('call_to_action')['title']; ?>
                <img class="featured-mobile-apps__footer-arrow" src="<?php echo IMAGES . '/modules/webcast/single-right-arrow-white.svg'; ?>">
            </a>
        </div>

    </div>
</section>

<script>   
    $(document).ready(function(){
        var divs = document.getElementsByClassName("mobile-app-card").length;
        if (divs <= 4 ) {
            $('.next_<?php echo $slider_id ?>').remove();
            $('.prev_<?php echo $slider_id ?>').remove();
        }
        $("#slider_<?php echo $slider_id ?>").slick({
            infinite: true,
            slidesToShow: 4,
            slidesToScroll: 4,
            prevArrow: $(".prev_<?php echo $slider_id ?>"),
            nextArrow: $(".next_<?php echo $slider_id ?>"),
            dots: ( $(window).width() < 769 ) ? true : false,
            responsive: [
                {
                    breakpoint: 1930,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 4,
                    }
                },
                {
                    breakpoint: 1200,
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
                    breakpoint: 860,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                    }
                },
                {
                    breakpoint: 490,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    }
                },
            ]
        });
    });
    $(window).on("resize", function() {
        $("#slider_<?php echo $slider_id ?>").not(".slick-initialized").slick("resize");
    });
</script>