<!-- Channels Video Slider Template Part -->
<?php $rand = rand(); ?>

<!-- <div class="blog-posts-preview-container highlight-channels ">   <div class="image-slider featured-app-module video_slider_popup-container"> -->
<div class="blog-posts-preview-container channels-video-slider">

    <div class="container">

        <div class="header-slider">

            <h2><?php echo get_sub_field('video_slider_title'); ?></h2>

        </div>

        <div class="image-slider__container video-popup-element">
            
            <img src="<?php echo IMAGES ?>/icons/prev.svg" class="prev prev_<?php echo $rand; ?>">

            <div class="slider-container slider_<?php echo $rand; ?>" id="slider_<?php echo $rand; ?>">

                <?php while( have_rows('video_slider') ) : the_row(); ?>

                    <?php $post = get_sub_field('video');?>

                    <div class="slider-single-item slider-item-click" onclick="openModalNew('<?php echo get_post_meta( $post->ID, 'url_vimeo', true); ?>')">

                        <div class="trim" style="background-image:url(<?php echo get_the_post_thumbnail_url( $post->ID, 'large'); ?>);">

                            <button class="play-video-btn" onclick="openModalNew('<?php echo get_post_meta( $post->ID, 'url_vimeo', true); ?>')">

                                <img class="icon-play"  src="<?php echo IMAGES ?>/icons/play-button.svg" alt=""> 

                            </button>

                        </div>

                        <div class="slider-single-item-content">

                            <h2 class="slider-single-title"><?php echo $post->post_title; ?></h2>

                        </div>

                    </div>

                    <?php wp_reset_postdata() ?>
                
                <?php endwhile; ?>

            </div>
        
            <img src="<?php echo IMAGES ?>/icons/next.svg" class="next next_<?php echo $rand; ?>">

        </div>

    </div>

</div>

<div id="video_slider_popup" class="modal modal-video-slider-popup modal-channels-video-slider">

    <span class="close cursor" onclick="closeNewModal()">&times;</span>

    <div class="modal-content" id="iframe-content">

        <iframe class="video" allow="autoplay" src="https://player.vimeo.com/video/327386892?app_id=122963" frameborder="0" id="iframe-popup"></iframe>

    </div>

    <div class="network-share-call-to-action social-media-popup d-none" id="js-share-call-to-action-popup">

        <img class="icon-open" style="top:10px !important" src="<?php print IMAGES; ?>/icons/share-video.svg" alt="">

    </div>

    <div class="network-skip-intro skip-intro-popup d-none" id="js-skip-intro-popup">

        <button class="skip-intro" id="js-skip-intro-popup">Skip Intro</button>

    </div>

    <div class="network-share" id="js-network-share">

        <div class="network-share__social-media social-media-popup d-none" id="js-social-media-popup">

            <img class="icon-close" style="top:10px !important" id="js-close-share-popup" src="<?php print IMAGES; ?>/icons/close-share.svg" alt="">

            <div class="network-share__social-media__content">

                <h3 class="text-white">Share This Video</h3>

                <hr>

                <?php echo do_shortcode('[easy-social-share]'); ?>

            </div>

        </div>

    </div>

</div>

<script>   
    $(document).ready(function(){
        var divs = document.getElementsByClassName("slider-single-item").length;

        if (divs <= 4 ) {
            $('.next_<?php echo $rand; ?>').remove();
            $('.prev_<?php echo $rand; ?>').remove();
        }

        $("#slider_<?php echo $rand; ?>").slick({
            infinite: true,
            slidesToShow: 4,
            slidesToScroll: 4,
            prevArrow: $(".prev_<?php echo $rand; ?>"),
            nextArrow: $(".next_<?php echo $rand; ?>"),
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
        $("#slider_<?php echo $rand ?>").not(".slick-initialized").slick("resize");
    });
</script>

<script>
    function openModalNew(src) {
        document.getElementById('video_slider_popup').style.display = "block";

        var iframe_section = $('#iframe-popup')[0];
        var i = 0;
        var skip = 5;
        var temporizador;

        $('#iframe-popup').attr('src', src);
        $('#iframe-popup').click();

        var player = new Vimeo.Player(iframe_section);

        $("#js-share-call-to-action-popup").removeClass("d-none");
        $("#js-skip-intro-popup").removeClass("d-none");
        $("#js-skip-intro-popup").css("display", "");

        setTimeout(function(){ player.play(); }, 1000);
        //player.play();

        var width = $('#iframe-popup').width();
        $('#js-share-call-to-action-popup').css({'width':width+'px'});
        $('#js-skip-intro-popup').css({'width':width+'px'});

        // Open network-share 
        $('#js-share-call-to-action-popup').click( function() {
            $('#js-share-call-to-action-popup').addClass('d-none');
            $('#js-social-media-popup').removeClass('d-none');
            var width = $("#iframe-popup").width();
            var height = $("#iframe-popup").height();
            $('#js-social-media-popup').css({'width':width+'px', 'height':height+'px'});
            player.pause();
        });

        // Close network-share
        $('#js-close-share-popup').click( function() {
            $('#js-social-media-popup').addClass('d-none');
            $('#js-share-call-to-action-popup').removeClass('d-none');
            player.play();
        });

        // Skip intro
        $('#js-skip-intro-popup').click( function () {
            //set time in 5 seg to skip intro
            player.setCurrentTime( skip ).then( function (seconds) {
                $('#js-skip-intro-popup').hide('slow');
            });
        });

        $('#js-social-media-popup').click(function(e) {
            if(e.target !== this) {
                return;
            }
            $('#js-social-media-popup').addClass('d-none');
            $('#js-share-call-to-action-popup').removeClass('d-none');
            player.play();
        });

        player.on('play', function() {
            $('#js-social-media-popup').addClass('d-none');
            $('#js-share-call-to-action-popup').removeClass('d-none');
        });

        player.on('pause', function() {
            $('#js-share-call-to-action-popup').addClass('d-none');
            $('#js-social-media-popup').removeClass('d-none');
            var width = $("#iframe-popup").width();
            var height = $("#iframe-popup").height();
            $('#js-social-media-popup').css({'width':width+'px', 'height':height+'px'});
        });

        
        player.on('progress', function( data ) {
            player.getCurrentTime().then(function(seconds) {
                if( seconds > 5 ) {
                    $('#js-skip-intro-popup').hide('slow');
                }
            });
        });

    }

    function closeNewModal() {
        var iframe_section = $('#iframe-popup')[0];
        var player = new Vimeo.Player(iframe_section);

        document.getElementById('video_slider_popup').style.display = "none";
        setTimeout(function(){ player.pause(); }, 1000); 

        $('#js-share-call-to-action-popup').addClass('d-none');
        $('#js-social-media-popup').addClass('d-none');
    }
</script>

<!-- End Channels Video Slider Template Part -->