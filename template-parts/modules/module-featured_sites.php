
<?php
    $title = get_sub_field('title_section');
    $cta = get_sub_field('call_to_action');
    $slider_id = rand(0,999999);
?>

<section class="featured-sites" id="js-featuredSitesModule">
    <div class="container">
        <?php if ( $title ) : ?>

            <div class="header">
                <h2 class="title"><?php echo $title; ?></h2>

                <?php if ($cta) : ?>
                    <a href="<?php echo $cta['url']; ?>" target="<?php echo $cta['target']; ?>">
                        <?php echo $cta['title']; ?>
                        <img src="<?php echo get_template_directory_uri()?>/img/modules/channels/single-right-arrow-blue.svg" alt="">
                    </a>
                <?php endif; ?>
            </div>

        <?php endif; ?>

        <img src="<?php echo IMAGES ?>/icons/stroke-prev.svg" class="prev prev_<?php echo $slider_id ?>">
        
        <div class="slider-container slider_<?php echo $slider_id ?>" id="slider_<?php echo $slider_id ?>">

            <?php if ( have_rows( 'sites' ) ) : 
                while ( have_rows( 'sites' ) ) : the_row(); 

                    $site = get_sub_field('site');
                    set_query_var('site', $site);
                    get_template_part('partials/site-card');
                    
                endwhile;
            endif; ?>

        </div>
        <img src="<?php echo IMAGES ?>/icons/stroke-next.svg" class="next next_<?php echo $slider_id ?>">


    </div>
</section>


<script>   
        $("document").ready(function(){
            var divs = document.getElementsByClassName("slider-single-item").length;

            if (divs <= 3 ) {
                $('.next_<?php echo $slider_id ?>').remove();
                $('.prev_<?php echo $slider_id ?>').remove();
            }

            $("#slider_<?php echo $slider_id ?>").slick({
                infinite: true,
                slidesToShow: 3,
                slidesToScroll: 3,
                prevArrow: $(".prev_<?php echo $slider_id ?>"),
                nextArrow: $(".next_<?php echo $slider_id ?>"),
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
                        breakpoint: 768,
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
            $("#slider_<?php echo $slider_id ?>").not(".slick-initialized").slick("resize");
        });
    </script>