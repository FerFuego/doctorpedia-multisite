<?php

//Register "container" content element. It will hold all your inner (child) content elements
vc_map(
    array(
        "name" => __("Video Playlist Infinite", "my-text-domain"),
        "base" => "vc_video_slider_infinite",
        "as_parent" => array('only' => 'vc_singleVideoinfinite'),
        'description' => __('Video playlist infinite Module', 'text-domain'),
        "content_element" => true,
        "show_settings_on_create" => false,
        "is_container" => true,
        'category' => __('DoctorPedia Elements', 'text-domain'),   
        'icon' => get_template_directory_uri().'/img/vc-doctorpedia-logo.PNG',
        "js_view" => 'VcColumnView',
        'params' => array(
            array(
                'type' => 'textfield',
                'holder' => 'span',
                'class' => 'title-class',
                'heading' => __( 'Subtitle', 'text-domain' ),
                'param_name' => 'subtitle',
                'value' => __( '', 'text-domain' ),
                'description' => __( '', 'text-domain' ),
                'admin_label' => false,
                'weight' => 0,
                'group' => 'General',
            ),    
            array(
                'type' => 'textfield',
                'holder' => '',
                'class' => 'title-class',
                'heading' => __( 'Title', 'text-domain' ),
                'param_name' => 'title',
                'value' => __( '', 'text-domain' ),
                'description' => __( '', 'text-domain' ),
                'admin_label' => false,
                'weight' => 0,
                'group' => 'General',
            ), 
            array(
                'type' => 'textarea',
                'holder' => '',
                'class' => 'title-class',
                'heading' => __( 'Description', 'text-domain' ),
                'param_name' => 'description',
                'value' => __( '', 'text-domain' ),
                'description' => __( '', 'text-domain' ),
                'admin_label' => false,
                'weight' => 0,
                'group' => 'General',
            ), 
            array(
                'type' => 'attach_image',
                'holder' => 'img',
                'class' => 'title-class',
                'heading' => __( 'Background Image', 'text-domain' ),
                'param_name' => 'background',
                'value' => '',
                'description' => __( '', 'text-domain' ),
                'dependency' => array(
                    'element' => 'source',
                    'value' => 'media_library',
                ),
                'admin_label' => false,
                'group' => 'General',
            ),
            array(
                'type' => 'dropdown',
                'holder' => 'p',
                'class' => 'title-class',
                'heading' => __( 'Background Color', 'text-domain' ),
                'param_name' => 'bg_color',
                'description' => __( '', 'text-domain' ),
                'admin_label' => false,
                'weight' => 0,
                'group' => 'General',
                'value' => array(
                    __('',''),
                    __('White','White'),
                    __('Grey','Grey')
                ),
            ),
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => __( "Link Video", "my-text-domain" ),
                "param_name" => "link_video",
                "value" => '', 
                "description" => __( "Copy & Paste the link of the Youtube or Vimeo video", "my-text-domain" ),
                'group' => 'General',
            ),
            array(
                'type' => 'textfield',
                'holder' => 'span',
                'class' => 'title-class',
                'heading' => __( 'Playlist Details', 'text-domain' ),
                'param_name' => 'details',
                'value' => __( '', 'text-domain' ),
                'description' => __( 'Ej: 5 videos playlist (15:30)', 'text-domain' ),
                'admin_label' => false,
                'weight' => 0,
                'group' => 'General',
            )
        )
    )
);

//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_vc_video_slider_infinite extends WPBakeryShortCodesContainer {
	}
}

if(!function_exists('wbc_video_slider_infinite_output')){
    
    function wbc_video_slider_infinite_output( $atts, $content = null){

        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'subtitle' => '',
                    'title' => '',
                    'description' => '',
                    'background' => '',
                    'bg_color' => '',
                    'link_video' => '',
                    'details' => ''
                ), 
                $atts
            )
        );

        $rand = rand(999, 9999);

        $bg_color = ($bg_color == 'Grey') ? '#f2f2f2' : '#ffffff';

        $background = wp_get_attachment_image_src($background, 'medium');

        return customVideo_slider_infiniteHtml( $title, $subtitle, $rand, $description, $background, $bg_color, $link_video, $details, do_shortcode( $content ));
    }
    add_shortcode( 'vc_video_slider_infinite' , 'wbc_video_slider_infinite_output' );

    function customVideo_slider_infiniteHtml( $title, $subtitle, $rand, $description, $background, $bg_color, $link_video, $details, $data ){
        ob_start(); ?>

        <!-- Video Playlist Infinite Module VC -->
        <div class="playlist-container" style="background-color: <?php echo $bg_color ?>">

            <div class="container">

                <div class="sponsors video-playlist <?php echo ( is_front_page() ) ? 'playlist-margin-cero' : 'playlist-margin-top'; ?>">

                    <div class="row">

                        <div id="description-playlist" class="description col-md-5 order-12 order-md-1">

                            <h1><?php echo $title; ?></h1>

                            <p><?php echo $description; ?></p>

                        </div>

                        <div class="col-md-7 order-1 order-md-12 video-bg">

                            <div class="video-module video-module-playlist">

                                <div class="video-wrapper-playlist">

                                    <iframe id="playlist_principal" class="video" src=<?php echo "$link_video"; ?> frameborder="0" allow="autoplay"></iframe>

                                </div>
                            
                                <div class="network-share-call-to-action d-none" id="js-share-call-to-action-playlist">

                                    <img class="icon-open icon-share-playlist"  src="<?php print IMAGES; ?>/icons/share-video.svg" alt="">

                                </div>

                                <div class="network-skip-intro d-none" id="js-skip-intro-playlist">

                                    <button class="skip-intro" id="js-skip-intro-playlist">Skip Intro</button>

                                </div>

                                <div class="network-share" id="js-network-share-playlist">

                                    <div class="network-share__social-media d-none" id="js-social-media-playlist">

                                        <img class="icon-close icon-close-playlist" id="js-close-share-playlist" src="<?php print IMAGES; ?>/icons/close-share.svg" alt="">

                                        <div class="network-share__social-media__content">

                                            <h3 class="text-white">Share This Video</h3>

                                            <hr>

                                            <?php echo do_shortcode('[easy-social-share image="'.$background[0].'" custom-image="'.$background[0].'" title="'.$title.'" message="'.$description.'"]'); ?>

                                        </div>

                                    </div>

                                </div>

                                <div class="video-placeholder video-placeholder-playlist" style="background-image:url(<?php echo $background[0]; ?>)">

                                    <button class="play-video-btn">

                                        <img src="<?php echo IMAGES; ?>/icons/play-button.svg" alt="Play Button">

                                    </button>

                                </div>

                            </div>

                            <p class="playlist-text text-center text-md-left"><?php echo $details; ?></p>

                        </div>

                    </div>

                    <div class="d-none d-md-block">  

                        <hr>

                    </div>

                </div>

            </div>

            <div class="video-playlist-module-slider">

                <div class="container">

                    <div class="slider-container">

                        <img src="<?php echo IMAGES; ?>/icons/prev.svg" class="prev prev_<?php echo $rand; ?>">

                        <div id="slider_video_playlist_<?php echo $rand; ?>" class="slider_video_playlist slides slides_grid">

                            <?php echo $data; ?>

                        </div>
                        
                        <img src="<?php echo IMAGES; ?>/icons/next.svg" class="next next_<?php echo $rand; ?>">

                    </div>

                </div>    

            </div>

        </div>

        <script>
            $(document).ready(function(){
                $("#slider_video_playlist_<?php echo $rand; ?>").slick({
                    infinite: true,
                    slidesToShow: 4,
                    slidesToScroll: 4,
                    centerMode: ( $(window).width() < 769 ) ? true : false,
                    prevArrow: ( $(window).width() < 769 ) ? false : $(".prev_<?php echo $rand; ?>"),
                    nextArrow: ( $(window).width() < 769 ) ? false : $(".next_<?php echo $rand; ?>"),
                    dots: false,
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

                $(window).on("resize", function() {
                    $("#slider_video_playlist_<?php echo $rand; ?>").not(".slick-initialized").slick("resize");
                });
            });

            $(document).ready(function(){

                var divs = document.getElementsByClassName("slider-playlist-infinite").length;

                if (divs <= 4 ) {
                    $('.next_<?php echo $rand; ?>').remove();
                    $('.prev_<?php echo $rand; ?>').remove();
                }

                var iframe_playlist = $(".video-wrapper-playlist iframe")[0];
                var player = new Vimeo.Player(iframe_playlist);
                var i = 0;
                var skip = 5;
                let playlist = [];
                
                $('.slider-playlist-infinite').each(function(){
                    playlist.push( $(this).attr('videourl') );
                });

                $(".video-placeholder-playlist .play-video-btn").click(function(){
                    $(this).parent().fadeOut("slow");
                    $(this).parent().siblings(".video-wrapper-playlist").children( "iframe" ).click();
                
                    $('#js-share-call-to-action-playlist').removeClass('d-none');
                    $('#js-skip-intro-playlist').removeClass('d-none');
                    $("#js-skip-intro-playlist").css("display", "");
                    $('#js-skip-intro-playlist').show('slow');
                    
                    setTimeout(function() { player.play(); }, 1000);

                    $('#transcript').click(function(){
                        $('#tanscription').slideToggle('fast');
                        $('#transcript span').toggleClass('inactive');
                    });

                    var width = $('#playlist_principal').width();
                    $('#js-share-call-to-action-playlist').css({'width':width+'px'});
                    $('#js-skip-intro-playlist').css({'width':width+'px'});
                })  

                // Slider Items
                $(".slider-playlist-infinite").click(function(){
                    var src = $(this).attr("videourl");
                    var title = $(".slider-single-item-content", this).children("h1").clone();
                    var text = $(".slider-single-item-content", this).children("p").clone();
                    $("#playlist_principal").attr("src", src);
                    $("#description-playlist h1").replaceWith("<h1>"+ title[0].innerText+"</h1>");
                    $("#description-playlist p").replaceWith("<p>"+ text[0].innerText+"</p>");
                    $(".video-placeholder-playlist").fadeOut("slow");
                    
                    $(this).parent().siblings(".video-wrapper-playlist").children( "iframe" ).click();
                    setTimeout(function(){ player.play(); }, 1000);

                    $('#js-share-call-to-action-playlist').removeClass('d-none');
                    $('#js-skip-intro-playlist').removeClass('d-none');
                    $("#js-skip-intro-playlist").css("display", "");
                    var width = $('#playlist_principal').width();
                    $('#js-share-call-to-action-playlist').css({'width':width+'px'});
                    $('#js-skip-intro-playlist').css({'width':width+'px'});

                    //$('.slider-single-item').css({'opacity':'0.6'});
                    $(this).css({'opacity':'1'});
                })  

                $(".video-wrapper-playlist .close-video-btn").click(function(){
                    $(".video-placeholder-playlist").fadeIn("slow");
                    $( this ).parent().siblings( ".video-wrapper-playlist" ).children( "iframe" ).click();
                    player.pause();
                });

                //Btn pause
                $('.video-module .close-video-btn').click(function(){
                    $('.video-module .play-video-btn').parent().fadeIn('slow');
                    $('#video-trascript').hide('slow');
                    $( this ).parent().siblings( '.video-wrapper-section' ).children( 'iframe' ).click();
                    player.pause();
                });

                // open network-share 
                $('#js-share-call-to-action-playlist').click( function() {
                    $('#js-share-call-to-action-playlist').addClass('d-none');
                    $('#js-social-media-playlist').removeClass('d-none');
                    var width = $('#playlist_principal').width();
                    var height = $('#playlist_principal').height();
                    $('#js-social-media-playlist').css({'width':width+'px', 'height':height+'px'});
                    player.pause();
                });

                // close network-share
                $('#js-close-share-playlist').click( function() {
                    $('#js-social-media-playlist').addClass('d-none');
                    $('#js-share-call-to-action-playlist').removeClass('d-none');
                    player.play();
                });

                //Skip intro
                $('#js-skip-intro-playlist').click( function () {
                    //set time in 5 seg to skip intro
                    player.setCurrentTime( skip ).then( function (seconds) {
                        $('#js-skip-intro-playlist').hide('slow');
                    });
                });

                $('#js-social-media-playlist').click(function(e) {
                    if(e.target !== this) {
                        return;
                    }
                    $('#js-social-media-playlist').addClass('d-none');
                    $('#js-share-call-to-action-playlist').removeClass('d-none');
                    player.play();
                });

                player.on('play', function() {
                    $('#js-social-media-playlist').addClass('d-none');
                    $('#js-share-call-to-action-playlist').removeClass('d-none');
                });

                player.on('pause', function() {
                    $('#js-share-call-to-action-playlist').addClass('d-none');
                    $('#js-social-media-playlist').removeClass('d-none');
                    var width = $('#playlist_principal').width();
                    var height = $('#playlist_principal').height();
                    $('#js-social-media-playlist').css({'width':width+'px', 'height':height+'px'});
                });

                player.on('progress', function( data ) {
                    player.getCurrentTime().then(function(seconds) {
                        if( seconds > 5 ) {
                            $('#js-skip-intro-playlist').hide('slow');
                        }
                    });
                });

                //Finish function
                player.on('ended', function() {
                    if( playlist[i] ){
                        player.loadVideo(playlist[i]).then(function(id) {
                            $('#js-skip-intro-playlist').show('slow');
                            sliderItemsPlay( i );
                        }).catch(function(error) {
                            console.log( error.name);
                        });
                        setTimeout(function(){ player.play(); }, 1000);
                        i++;
                    }
                });

                function sliderItemsPlay( id ) {            
                    var title = $('#video_slider_' + id).children('.slider-single-item-content').children('h2').clone()
                    var description = $('#video_slider_' + id).children('.slider-single-item-content').children('p').clone();
                    $('#video_slider_' + id).css({'opacity':'1'});

                    $("#description-playlist h1").replaceWith("<h1>"+ title[0].innerText+"</h1>");
                    $("#description-playlist p").replaceWith("<p>"+ description[0].innerText+"</p>");

                    ('#js-share-call-to-action-playlist').removeClass('d-none');
                    $('#js-skip-intro-playlist').removeClass('d-none');
                    $("#js-skip-intro-playlist").css("display", "");
                    $('#js-skip-intro-playlist').show('slow');

                    var width = $('#playlist_principal').width();
                    $('#js-share-call-to-action-playlist').css({'width':width+'px'});
                    $('#js-skip-intro-playlist').css({'width':width+'px'});
                }

            })
        </script>
        <!-- End Video Playlist Infinite Module VC -->
        
        <?php
        return ob_get_clean();
    }
}
?>