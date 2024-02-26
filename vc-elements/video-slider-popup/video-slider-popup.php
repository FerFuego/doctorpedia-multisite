<?php

//Register "container" content element. It will hold all your inner (child) content elements
vc_map(
    array(
        "name" => __("Video Slider Popup", "my-text-domain"),
        "base" => "vc_video_slider_popup",
        "as_parent" => array('only' => 'vc_singleVideoPopup'),
        'description' => __('Video slider popup Module', 'text-domain'),
        "content_element" => true,
        "show_settings_on_create" => false,
        "is_container" => true,
        'category' => __('DoctorPedia Elements', 'text-domain'),   
        'icon' => get_template_directory_uri().'/img/vc-doctorpedia-logo.PNG',
        "js_view" => 'VcColumnView',
        'params' => array(
            array(
                'type' => 'textfield',
                'class' => 'title-class',
                'heading' => __( 'Title', 'text-domain' ),
                'param_name' => 'title',
                'value' => __( '', 'text-domain' ),
                'description' => __( '', 'text-domain' ),
                'admin_label' => false,
                'weight' => 0,
                'group' => 'General',
            ),
        ),
    )
);

//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_vc_video_slider_popup extends WPBakeryShortCodesContainer {
	}
}

if(!function_exists('wbc_video_slider_popup_output')){
    
    function wbc_video_slider_popup_output( $atts, $content = null){

        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'title' => '',
                ), 
                $atts
            )
        );

        $slider_id = rand();

        return customVideo_slider_popupHtml( $title, $slider_id, do_shortcode( $content ));
    }
    add_shortcode( 'vc_video_slider_popup' , 'wbc_video_slider_popup_output' );

    function customVideo_slider_popupHtml($title, $slider_id, $data){
        ob_start(); ?>
        
        <!-- Video Slider Popup Module VC -->
        <div class="image-slider featured-app-module video_slider_popup-container">

            <div class="container">

                <?php if ( $title ) : ?>

                    <div class="header">

                        <h2 class="title"><?php echo $title; ?></h2>

                    </div>

                <?php endif; ?>

                <div class="image-slider__container video-popup-element">
                    
                    <img src="<?php echo IMAGES ?>/icons/stroke-prev.svg" class="prev prev_<?php echo $slider_id ?>">

                    <div class="slider-container slider_<?php echo $slider_id ?>" id="slider_<?php echo $slider_id ?>">

                        <?php echo $data; ?>

                    </div>
                
                    <img src="<?php echo IMAGES ?>/icons/stroke-next.svg" class="next next_<?php echo $slider_id ?>">

                </div>

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

            <!-- <div class="network-skip-intro skip-intro-popup d-none" id="js-skip-intro-popup">

                <button class="skip-intro" id="js-skip-intro-popup">Skip Intro</button>

            </div> -->

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
            $("document").ready(function(){
                var divs = document.getElementsByClassName("slider-single-item").length;

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
        <!-- End Video Slider Popup Module VC -->
       
    <?php
        return ob_get_clean();
    }
}

?>