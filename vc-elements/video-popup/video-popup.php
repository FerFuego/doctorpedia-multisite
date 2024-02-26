<?php
/* Element Description: VC videosPopup*/
 
// Element Class 
class vcvideosPopup extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_videosPopup_mapping' ) );
        add_shortcode( 'vc_videosPopup', array( $this, 'vc_videosPopup_html' ) );
    }
     
    // Element Mapping
    public function vc_videosPopup_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }
            
        // Map the block with vc_map()
        vc_map( 

            array(
                'name' => __('Videos Popup', 'text-domain'),
                'base' => 'vc_videosPopup',
                'description' => __('Videos Popup Module', 'text-domain'), 
                'category' => __('DoctorPedia Elements', 'text-domain'),   
                'icon' => get_template_directory_uri().'/img/vc-doctorpedia-logo.PNG',            
                'params' => array(
                    array(
						'type' => 'attach_image',
						'holder' => 'img',
						'class' => 'title-class',
						'heading' => __( 'Image', 'text-domain' ),
						'param_name' => 'image_1',
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
                        'type' => 'textfield',
                        'holder' => 'h3',
                        'class' => 'title-class',
                        'heading' => __( 'Title Video', 'text-domain' ),
                        'param_name' => 'title_video_1',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'General',
                    ),
                    array(
                        'type' => 'textfield',
                        'holder' => 'h3',
                        'class' => 'title-class',
                        'heading' => __( 'Link Video', 'text-domain' ),
                        'param_name' => 'link_video_1',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( 'To play the video correctly, the link should be like this: https://player.vimeo.com/video/123456789?app_id=123456789&autoplay=1&controls=0', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'General',
                    ),
                    array(
						'type' => 'attach_image',
						'holder' => 'img',
						'class' => 'title-class',
						'heading' => __( 'Image', 'text-domain' ),
						'param_name' => 'image_2',
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
                        'type' => 'textfield',
                        'holder' => 'h3',
                        'class' => 'title-class',
                        'heading' => __( 'Title Video', 'text-domain' ),
                        'param_name' => 'title_video_2',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'General',
                    ),
                    array(
                        'type' => 'textfield',
                        'holder' => 'h3',
                        'class' => 'title-class',
                        'heading' => __( 'Link Video', 'text-domain' ),
                        'param_name' => 'link_video_2',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( 'To play the video correctly, the link should be like this: https://player.vimeo.com/video/123456789?app_id=123456789&autoplay=1&controls=0', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'General',
                    ),
                    array(
						'type' => 'attach_image',
						'holder' => 'img',
						'class' => 'title-class',
						'heading' => __( 'Image', 'text-domain' ),
						'param_name' => 'image_3',
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
                        'type' => 'textfield',
                        'holder' => 'h3',
                        'class' => 'title-class',
                        'heading' => __( 'Title Video', 'text-domain' ),
                        'param_name' => 'title_video_3',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'General',
                    ),
                    array(
                        'type' => 'textfield',
                        'holder' => 'h3',
                        'class' => 'title-class',
                        'heading' => __( 'Link Video', 'text-domain' ),
                        'param_name' => 'link_video_3',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( 'To play the video correctly, the link should be like this: https://player.vimeo.com/video/123456789?app_id=123456789&autoplay=1&controls=0', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'General',
                    ),
                )
            )
        );                           
        
    } 
     
     
    // Element HTML
    public function vc_videosPopup_html( $atts ) {

        $attributes = vc_map_get_attributes($this->getShortCode(), $atts);
         // Params extraction

        extract(
            shortcode_atts(
                array(
                    'image_1' => '',
                    'title_video_1' => '',
                    'link_video_1' => '',
                    'image_2' => '',
                    'title_video_2' => '',
                    'link_video_2' => '',
                    'image_3' => '',
                    'title_video_3' => '',
                    'link_video_3' => '',
                    
                ), 
                $atts
            )
        );

        $image_1 = wp_get_attachment_image_src($image_1, 'medium');
        $image_2 = wp_get_attachment_image_src($image_2, 'medium');
        $image_3 = wp_get_attachment_image_src($image_3, 'medium');
        
        return $this->BlockHTML($image_1, $title_video_1, $link_video_1, $image_2, $title_video_2, $link_video_2, $image_3, $title_video_3, $link_video_3);
    } 

    public function BlockHTML($image_1, $title_video_1, $link_video_1, $image_2, $title_video_2, $link_video_2, $image_3, $title_video_3, $link_video_3){ 
        ob_start(); ?>
        <!-- Video-popup Module VC-->
        <div class="video-popup-element">
            <div class="container">
                <div class="header">
                    <h2>Why Doctorpedia?</h2>
                </div>
                <div class="slider-container">
                    <div class="slider-single-item slider-item-click" onclick="openModal('<?php echo $link_video_1 ?>')">
                        <div class="trim" style="background-image:url(<?php echo $image_1[0] ?>);">
                            <button class="play-video-btn" onclick="openModal('<?php echo $link_video_1 ?>')">
                                <img class="icon-play"  src="<?php echo IMAGES ?>/icons/play-button.svg" alt=""> 
                            </button>
                        </div>
                        <div class="slider-single-item-content">
                            <h2 class="slider-single-title"><?php echo $title_video_1 ?></h2>
                        </div>
                    </div>
                    <div class="slider-single-item slider-item-click" onclick="openModal('<?php echo $link_video_2 ?>')">
                        <div class="trim" style="background-image:url(<?php echo $image_2[0] ?>);">
                            <button class="play-video-btn" onclick="openModal('<?php echo $link_video_2 ?>')">
                                <img class="icon-play"  src="<?php echo IMAGES ?>/icons/play-button.svg" alt=""> 
                            </button>
                        </div>
                        <div class="slider-single-item-content">
                            <h2 class="slider-single-title"><?php echo $title_video_2 ?></h2>
                        </div>
                    </div>
                    <div class="slider-single-item slider-item-click" onclick="openModal('<?php echo $link_video_3 ?>')">
                        <div class="trim" style="background-image:url(<?php echo $image_3[0] ?>);">
                            <button class="play-video-btn" onclick="openModal('<?php echo $link_video_3 ?>')">
                                <img class="icon-play"  src="<?php echo IMAGES ?>/icons/play-button.svg" alt=""> 
                            </button>
                        </div>
                        <div class="slider-single-item-content">
                            <h2 class="slider-single-title"><?php echo $title_video_3 ?></h2>
                        </div>
                    </div>
                </div>
            </div>    
        </div>

        <div id="one" class="modal modal-video-popup">
            <span class="close cursor" onclick="closeModalVideo()">&times;</span>
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

            function openModal(src) {
                document.getElementById('one').style.display = "block";

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

            function closeModalVideo() {
                var iframe_section = $('#iframe-popup')[0];
                var player = new Vimeo.Player(iframe_section);
        
                document.getElementById('one').style.display = "none";
                setTimeout(function(){ player.pause(); }, 1000); 

                $('#js-share-call-to-action-popup').addClass('d-none');
                $('#js-social-media-popup').addClass('d-none');
            }
        </script>
        <!-- End Video-popup Module VC-->
    <?php 
        return ob_get_clean();
    }
     
} // End Element Class
 
// Element Class Init
new vcvideosPopup();

?>