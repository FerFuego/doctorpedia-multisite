<?php
    $title = get_sub_field('title_section');
    $cta = get_sub_field('call_to_action');
    $bg_color = get_sub_field('background_color');
    $slider_id = rand(0,999999);
?>
<!-- Video Slider Popup Module ACF -->
<section class="featured-videos" id="js-featuredVideoModule" style="<?php echo ($bg_color) ? 'background-color:'.$bg_color :''; ?>">

    <div class="container">

        <?php if ( $title ) : ?>

            <div class="header">
                <h2 class="title"><?php echo $title; ?></h2>

                <?php if ($cta) : ?>
                    <a href="<?php echo $cta['url']; ?>" target="<?php echo $cta['targer']; ?>">
                        <?php echo $cta['title']; ?>
                        <img src="<?php echo get_template_directory_uri()?>/img/modules/channels/single-right-arrow-blue.svg" alt="">
                    </a>
                <?php endif; ?>
            </div>

        <?php endif; ?>

        <div class="image-slider__container video-popup-element">
            
            <img src="<?php echo IMAGES ?>/icons/stroke-prev.svg" class="prev prev_<?php echo $slider_id ?>">

            <div class="slider-container slider_<?php echo $slider_id ?>" id="slider_<?php echo $slider_id ?>">

                <?php if ( get_sub_field('library_type') ) :
                        $post_videos = get_sub_field('videos');
                        if ( count( $post_videos ) > 0 ) : 
                            foreach ( $post_videos as $post_video ) :
                                set_query_var('video', $post_video['video']);
                                get_template_part('partials/video-card');
                            endforeach;
                        endif;
                    else : 
                        $post_videos_links = get_sub_field('videos_links');
                        if ( count($post_videos_links) > 0 ) : 
                            foreach ( $post_videos_links as $post_video_link ) :
                                set_query_var('placeholder_image', $post_video_link['placeholder_image']);
                                set_query_var('link_video', $post_video_link['link_video']);
                                set_query_var('title', $post_video_link['title']);
                                set_query_var('show_author', $post_video_link['show_author']);
                                set_query_var('author', $post_video_link['author']);
                                get_template_part('partials/video-card-link');
                            endforeach;
                        endif;
                endif; ?>

            </div>
        
            <img src="<?php echo IMAGES ?>/icons/stroke-next.svg" class="next next_<?php echo $slider_id ?>">

        </div>

    </div>

    <div id="video_slider_popup" class="modal modal-video-slider-popup">

        <span class="close cursor" onclick="closeNewModal()">&times;</span>

        <div class="modal-content" id="iframe-content">

            <iframe class="video" allow="autoplay" src="" frameborder="0" id="iframe-popup"></iframe>

        </div>

        <div class="network-share-call-to-action social-media-popup d-none" id="js-share-call-to-action-popup">

            <img class="icon-open" style="top:10px !important" src="<?php print IMAGES; ?>/icons/share-video.svg" alt="">

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
                console.log("pause");
            });

            
            player.on('progress', function( data ) {
                player.getCurrentTime().then(function(seconds) {
                    console.log(seconds);
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
            // Resetear boton
            //clearTimeout(temporizador);
        }
    </script>   

</section>
<!-- End Video Slider Popup Module ACF -->