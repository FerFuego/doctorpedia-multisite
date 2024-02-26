<?php
/* Element Description: VC sponsorModule*/
 
// Element Class 
class vcsponsorModule extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_sponsorModule_mapping' ) );
        add_shortcode( 'vc_sponsorModule', array( $this, 'vc_sponsorModule_html' ) );
    }
     
    // Element Mapping
    public function vc_sponsorModule_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }
            
        // Map the block with vc_map()
        vc_map( 

            array(
                'name' => __('Sponsor Module', 'text-domain'),
                'base' => 'vc_sponsorModule',
                'description' => __('Sponsor Module', 'text-domain'), 
                'category' => __('DoctorPedia Elements', 'text-domain'),   
                'icon' => get_template_directory_uri().'/img/vc-doctorpedia-logo.PNG',            
                'params' => array(
                    array(
                        'type' => 'textfield',
                        'holder' => 'span',
                        'class' => 'title-class',
                        'heading' => __( 'Sponsor Name', 'text-domain' ),
                        'param_name' => 'sponsor_name',
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
                        'type' => 'textfield',
                        'holder' => '',
                        'class' => 'title-class',
                        'heading' => __( 'Button Text', 'text-domain' ),
                        'param_name' => 'button_text',
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
                        'heading' => __( 'Button Link', 'text-domain' ),
                        'param_name' => 'button_link',
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
                        "type" => "textfield",
                        "class" => "",
                        "heading" => __( "Link Video", "my-text-domain" ),
                        "param_name" => "link_video",
                        "value" => '', 
                        "description" => __( "Copy & Paste the link of the Youtube or Vimeo video", "my-text-domain" ),
                        'group' => 'General',
                    )
                )
            )
        );                           
        
    } 
     
     
    // Element HTML
    public function vc_sponsorModule_html( $atts ) {

        $attributes = vc_map_get_attributes($this->getShortCode(), $atts);
         // Params extraction
        extract(
            shortcode_atts(
                array(
                    'sponsor_name'   => '',
                    'title'   => '',
                    'description'   => '',
                    'button_text'   => 'Visit Sponsor Website',
                    'button_link'   => '',
                    'background'   => '',
                    'link_video' => ''
                ), 
                $atts
            )
        );

        $rand = rand(999, 9999);

        $image = wp_get_attachment_image_src($background, 'large');
        
        return $this->BlockHTML($sponsor_name, $title, $description, $button_text, $button_link, $background, $link_video, $image, $rand);
    }

    public function BlockHTMl($sponsor_name, $title, $description, $button_text, $button_link, $background, $link_video, $image, $rand){ 
        ob_start(); ?>
        <!-- Sponsor Module VC -->
        <div class="container">
            <div class="sponsors colored-sponsor">
                <div class="sponsors--float">
                    <h2 class="title">Sponsored</h2>
                </div>
                <div class="row">
                    <div class="description col-md-5 order-12 order-md-1">
                        <span><?php echo $sponsor_name ?></span>
                        <h1><?php echo $title ?></h1>
                        <p><?php echo $description ?></p>
                        <a href="<?php echo $button_link ?>"><?php echo $button_text ?></a>
                    </div>
                    <div class="col-md-7 order-1 order-md-12">
                        <div class="video-module">
                            <div class="video-wrapper-sponsor">
                                <iframe class="video" src=<?php echo "$link_video"; ?> id="iframe-video-sponsor" frameborder="0" allow="autoplay"></iframe>
                            </div>
                            <div class="video-placeholder video-placeholder-sponsor" style="background-image:url(<?php echo $image[0] ?>)">
                                <?php if($link_video): ?>
                                    <button class="play-video-btn" id="play-video-sponsor-<?php echo $rand ?>">
                                        <img src="<?php echo IMAGES ?>/icons/play-button.svg" alt="Play Button">
                                    </button>
                                <?php endif; ?>
                            </div>

                            <!-- Skip Button / Share Buttons -->
                            <div class="network-share-call-to-action d-none" id="js-share-call-to-action-sponsor">
                                <img class="icon-open icon-share-sponsor"  src="<?php print IMAGES; ?>/icons/share-video.svg" alt="">
                            </div>

                            <div class="network-skip-intro d-none" id="js-skip-intro-sponsor">
                                <button class="skip-intro" id="js-skip-intro-sponsor">Skip Intro</button>
                            </div>

                            <div class="network-share" id="js-network-share">
                                <div class="network-share__social-media d-none" id="js-social-media-sponsor">
                                    <img class="icon-close icon-close-sponsor" id="js-close-share-sponsor" src="<?php print IMAGES; ?>/icons/close-share.svg" alt="">
                                    <div class="network-share__social-media__content add-custom-style">
                                        <h3 class="text-white text-sponsor">Share This Video</h3>
                                        <hr class="line-separate-sponsor">
                                        <?php echo do_shortcode('[easy-social-share]'); ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>

            $("document").ready(function() {

                var iframe_sponsor = $(".video-wrapper-sponsor iframe")[0];
                var player = new Vimeo.Player(iframe_sponsor);
                var i = 0;
                var skip = 5;

                // First play button
                $('#play-video-sponsor-<?php echo $rand ?>').click(function(){
                    $(this).parent().fadeOut('slow');
                    $('#video-trascript').fadeIn();
                    $(this).parent().siblings('.video-wrapper').children( 'iframe' ).click();
                    $('#js-share-call-to-action-sponsor').removeClass('d-none');
                    $('#js-skip-intro-sponsor').removeClass('d-none');
                    setTimeout(function(){ player.play(); }, 1000);

                    $('#transcript').click(function(){
                        $('#tanscription').slideToggle('fast');
                        $('#transcript span').toggleClass('inactive');
                    });

                    var width = $('#iframe-video-sponsor').width();
                    $('#js-share-call-to-action-sponsor').css({'width':width+'px'});
                    $('#js-skip-intro-sponsor').css({'width':width+'px'});

                    var item = $('#iframe-video-sponsor').attr('data-id');
                    $('#' + item).css({'opacity':'1'});
                        
                });

                // Button pause
                $('.video-module .close-video-btn').click(function(){
                    $('.video-module .play-video-btn').parent().fadeIn('slow');
                    $('#video-trascript').hide('slow');
                    $( this ).parent().siblings( '.video-wrapper-section' ).children( 'iframe' ).click();
                    player.pause();
                });

                // Open network-share 
                $('#js-share-call-to-action-sponsor').click( function() {
                    $('#js-share-call-to-action-sponsor').addClass('d-none');
                    $('#js-social-media-sponsor').removeClass('d-none');
                    var width = $("#iframe-video-sponsor").width();
                    var height = $("#iframe-video-sponsor").height();
                    $('#js-social-media-sponsor').css({'width':width+'px', 'height':height+'px'});
                    player.pause();
                });

                // Close network-share
                $('#js-close-share-sponsor').click( function() {
                    $('#js-social-media-sponsor').addClass('d-none');
                    $('#js-share-call-to-action-sponsor').removeClass('d-none');
                    player.play();
                });

                // Skip intro
                $('#js-skip-intro-sponsor').click( function () {
                    //set time in 5 seg to skip intro
                    player.setCurrentTime( skip ).then( function (seconds) {
                        $('#js-skip-intro-sponsor').hide('slow');
                    });
                });

                $('#js-social-media-sponsor').click(function(e) {
                    if(e.target !== this) {
                        return;
                    }
                    $('#js-social-media-sponsor').addClass('d-none');
                    $('#js-share-call-to-action-sponsor').removeClass('d-none');
                    player.play();
                });

                player.on('play', function() {
                    $('#js-social-media-sponsor').addClass('d-none');
                    $('#js-share-call-to-action-sponsor').removeClass('d-none');
                });

                player.on('pause', function() {
                    $('#js-share-call-to-action-sponsor').addClass('d-none');
                    $('#js-social-media-sponsor').removeClass('d-none');
                    var width = $("#iframe-video-sponsor").width();
                    var height = $("#iframe-video-sponsor").height();
                    $('#js-social-media-sponsor').css({'width':width+'px', 'height':height+'px'});
                });

                player.on('progress', function( data ) {
                    player.getCurrentTime().then(function(seconds) {
                        if( seconds > 5 ) {
                            $('#js-skip-intro-sponsor').hide('slow');
                        }
                    });
                });


            });

       


        </script>
        <!-- END Sponsor Module VC -->


    <?php 
        return ob_get_clean();
    }
     
} // End Element Class

 
// Element Class Init
new vcsponsorModule();

?>
