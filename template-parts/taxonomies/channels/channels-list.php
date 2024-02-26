<!-- Channel List Template Part -->

<?php 
    $slider_id = rand(); 
    $channel_title = get_sub_field('title_module');
    $channels = get_sub_field('channel');
?>

<div class="image-slider featured-app-module channels-container channels-container-acf <?php echo ( get_sub_field('channels_background_color') ) ? 'bg-channels-grey':''; ?>">

    <div class="channels-subcontainer-acf">

        <div class="container">
    
            <?php if ( $channel_title ) : ?>
    
                <div class="header-list">
    
                    <h2 class="title"><?php echo $channel_title; ?></h2>
    
                </div>
    
            <?php endif; ?>
    
            <div class="image-slider__container channels-container-acf__content">

                <?php if ( count($channels) > 0 ) : ?>
    
                    <img src="<?php echo IMAGES ?>/icons/stroke-prev.svg" class="prev prev_<?php echo $slider_id ?>">
                    
                    <div class="image-slider__container channels-container-acf__content slider_<?php echo $slider_id ?>" id="slider_<?php echo $slider_id ?>">
        
                        <?php foreach ($channels as $channel) : ?>
        
                            <div class="single-channel-item-container">
        
                                <?php if ( $channel['link_channel']['url'] ) : ?>
        
                                    <a href="<?php echo $channel['link_channel']['url']; ?>" target="<?php echo $channel['link_channel']['target']; ?>">
        
                                <?php endif; ?>
        
                                <div class="single-channel-item lazy" style="background-image:url(<?php echo $channel['bg_image']['url']; ?>)">
        
                                    <div class="cat-shadow"></div>
        
                                    <div class="content">
                                        
                                        <?php if ( $channel['subtitle_channel'] ) : ?>
                                            <h2><?php echo $channel['subtitle_channel'] ?></h2>
                                        <?php endif; ?>
                                        
                                        <?php if ( $channel['title_channel'] ) : ?>
                                            <h3><?php echo $channel['title_channel']; ?></h3>
                                        <?php endif; ?>
                                    </div>
                                    
                                </div>
        
                                <?php if ( $channel['link_channel']['url'] ) : ?> </a> <?php endif; ?>
        
                            </div>
        
                        <?php endforeach; ?>
        
                    </div>
                    
                    <img src="<?php echo IMAGES ?>/icons/stroke-next.svg" class="next next_<?php echo $slider_id ?>">

                <?php endif; ?>
    
            </div>
    
        </div>

    </div>

</div>

<script>   
    $(document).ready(function(){
        var divs = document.getElementsByClassName("single-channel-item-container").length;
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
            dots: (divs > 4 ) ? true : ( $(window).width() < 769 ) ? true : false,
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

<!-- End Channel List Template Part -->