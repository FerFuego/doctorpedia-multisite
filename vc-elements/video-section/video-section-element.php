<?php
/* Element Description: VC VideoSection*/
 
// Element Class 
class vcVideoSection extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_videoSection_mapping' ) );
        add_shortcode( 'vc_videoSection', array( $this, 'vc_videoSection_html' ) );
    }
     
    // Element Mapping
    public function vc_videoSection_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }
            
        // Map the block with vc_map()
        vc_map( 

            array(
                'name' => __('Video Section', 'text-domain'),
                'base' => 'vc_videoSection',
                'description' => __('Video Section Module', 'text-domain'), 
                'category' => __('DoctorPedia Elements', 'text-domain'),   
                'icon' => get_template_directory_uri().'/img/vc-doctorpedia-logo.PNG',            
                'params' => array(   
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
                        'holder' => 'div',
                        'class' => 'text-class',
                        'heading' => __( 'Button Text', 'text-domain' ),
                        'param_name' => 'cta',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'General',
                    ),
                    array(
                        'type' => 'textfield',
                        'holder' => 'div',
                        'class' => 'text-class',
                        'heading' => __( 'Button Link', 'text-domain' ),
                        'param_name' => 'cta_link',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'General',
                    ),
                    array(
                        'type' => 'dropdown',
                        'holder' => 'p',
                        'class' => 'title-class',
                        'heading' => __( 'Video Type', 'text-domain' ),
                        'param_name' => 'video_type',
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'General',
                        'value' => array(
                            __('Select the type'),
                            __('Connatix'),
                            __('Vimeo'),
                        ),
                    ),
                    array(
                        "type" => "textfield",
                        "class" => "",
                        "heading" => __( "Vimeo Link Video", "my-text-domain" ),
                        "param_name" => "link_video",
                        "value" => '', 
                        "description" => __( "Copy & Paste the link of the Vimeo video", "my-text-domain" ),
                        'group' => 'Vimeo',
                    ),
                    array(
                        "type" => "textfield",
                        "class" => "",
                        "heading" => __( "Connatix script id", "my-text-domain" ),
                        "param_name" => "script_id",
                        "value" => '', 
                        "description" => __( "Copy & Paste the Connatix script id", "my-text-domain" ),
                        'group' => 'Connatix',
                    ),
                    array(
                        "type" => "textfield",
                        "class" => "",
                        "heading" => __( "Player_id Connatix", "my-text-domain" ),
                        "param_name" => "player_id",
                        "value" => '', 
                        "description" => __( "Copy & Paste the playerId of the Connatix code", "my-text-domain" ),
                        'group' => 'Connatix',
                    )
                )
            )
        );                           
        
    } 
     
     
    // Element HTML
    public function vc_videoSection_html( $atts ) {

        $attributes = vc_map_get_attributes($this->getShortCode(), $atts);
         // Params extraction
        extract(
            shortcode_atts(
                array(
                    'background'   => '',
                    'title'   => '',
                    'cta' => 'View All Videos',
                    'cta_link' => '',
                    'link_video' => '',
                    'script_id' => '',
                    'player_id' => '',
                    'video_type' => '',
                    'description' => ''
                ), 
                $atts
            )
        );

        $image = wp_get_attachment_image_src($background, 'full');
        
        $rand = rand(999, 9999);
        return $this->BlockHTML($image, $rand, $title, $link_video, $script_id, $player_id, $cta, $cta_link, $video_type, $description);
    } 

    public function BlockHTML($image, $rand, $title, $link_video, $script_id, $player_id, $cta, $cta_link, $video_type, $description){ 
        ob_start(); $check_call = ''; ?>
        <!-- Video Section Module VC -->
        <div class="video-container <?php echo ( $video_type == 'Connatix' ) ? 'video-connatix-container' : null; ?>">

            <div class="video-module js-video-module video-module-margin <?php echo ( $video_type == 'Connatix' ) ? 'video-connatix-container__subcontainer' : null; ?>">

                <div class="video-wrapper video-wrapper-section 
                    <?php echo ( have_rows('call_to_action', 'option') ) ? 'video-wrapper-limit-width' : ''; ?>
                    <?php echo ( $video_type == 'Connatix' ) ? 'video-connatix-container__video-wrapper' : null; ?> ">

                    <?php if ( $video_type == 'Connatix' ) : ?>
                        
                        <!-- Connatix -->
                        <div id="connatix-video-vc">

                            <script>!function(n){if(!window.cnx){window.cnx={},window.cnx.cmd=[];var t=n.createElement('iframe');t.display='none',t.onload=function(){var n=t.contentWindow.document;c=n.createElement('script'),c.src='//cd.connatix.com/connatix.player.js',c.setAttribute('async','1'),c.setAttribute('type','text/javascript'),n.body.appendChild(c)},n.head.appendChild(t)}}(document);</script>

                            <script id="<?php echo $script_id; ?>"></script>

                            <!-- CTA buttons right video -->
                            <?php if( have_rows('call_to_action', 'option') ): ?>
                                <div class="video-wrapper-section__sidebar">
                                    <?php while( have_rows('call_to_action', 'option') ): the_row(); ?>
                                        <div class="video-wrapper-section__sidebar__box">
                                            <p><?php the_sub_field('title'); ?></p>
                                            <a href="<?php echo get_sub_field('link')['url']; ?>" target="<?php echo get_sub_field('link')['target']; ?>"><?php echo get_sub_field('link')['title']; ?></a>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            <?php endif; ?>

                        </div>

                    <?php else : ?>

                        <iframe class="video" src=<?php echo "$link_video"; ?> frameborder="0" allow="autoplay" id="iframe-<?php echo $rand; ?>"></iframe>

                        <?php if( have_rows('call_to_action', 'option') ): ?>
                            <?php $check_call = 'add-bottom-solution'; ?>
                            <div class="video-wrapper-section__sidebar">
                                <?php while( have_rows('call_to_action', 'option') ): the_row(); ?>
                                    <div class="video-wrapper-section__sidebar__box">
                                        <p><?php the_sub_field('title'); ?></p>
                                        <a href="<?php echo get_sub_field('link')['url']; ?>" target="<?php echo get_sub_field('link')['target']; ?>"><?php echo get_sub_field('link')['title']; ?></a>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        <?php endif; ?>

                        <div id="vs-next-viddeo-<?php echo $rand; ?>" class="vs-next-video">
                            <div class="overlay">
                                <h2>Title</h2>
                                <p>Next Video >></p>
                            </div>
                        </div>
                    
                    <?php endif; ?>

                    <!-- Skip Button / Share Buttons -->
                    <div class="network-share-call-to-action d-none" id="js-share-call-to-action-<?php echo $rand; ?>">
                        <img class="icon-open icon-share-video-element "  src="<?php print IMAGES; ?>/icons/share-video.svg" alt="">
                    </div>

                    <?php if ( $video_type != 'Connatix' ) : ?>

                        <div class="network-skip-intro <?php echo $check_call; ?> d-none" id="js-skip-intro-<?php echo $rand; ?>">
                            <button class="skip-intro skip-video-element" id="js-skip-intro-<?php echo $rand; ?>">Skip Intro</button>
                        </div>

                    <?php endif; ?>

                    <div class="network-share" id="js-network-share">
                        <div class="network-share__social-media d-none" id="js-social-media-<?php echo $rand; ?>">
                            <img class="icon-close icon-close-video-element " id="js-close-share-<?php echo $rand; ?>" src="<?php print IMAGES; ?>/icons/close-share.svg" alt="">
                            <div class="network-share__social-media__content">
                                <h3 class="text-white">Share This Video</h3>
                                <hr>
                                <?php echo do_shortcode('[easy-social-share]'); ?>
                            </div>
                        </div>
                    </div>

                </div>

                <?php if ( $image ) : ?>
                    <div class="video-placeholder video-placeholder-section <?php echo (have_rows('call_to_action', 'option')) ? 'video-placeholder-limit' : ''; ?>" style="background-image:url(<?php echo $image[0] ?>)">
                        
                        <?php if ( $link_video || $script_id ) : ?>
                            <button class="play-video-btn" id="play-<?php echo $rand; ?>">
                                <img src="<?php echo IMAGES ?>/icons/play-button.svg" alt="Play Button">
                            </button>
                        <?php endif; ?>

                        <?php if(!empty($title)): ?>
                            <div class="information-box-container"> 
                                <div class="information-box d-none d-md-block">
                                    <div class="body">                                        
                                        <span><?php echo $title ?></span>
                                        <p><?php echo $description ?></p>
                                    </div>
                                    <?php if(!empty($cta_link)): ?>
                                        <div class="footer">
                                            <a href="<?php echo $cta_link ?>"><?php echo $cta ?></a>
                                        </div>
                                    <?php endif ?>
                                </div>
                            </div>
                        <?php endif ?>
                    </div>
                <?php endif; ?>
            </div>
            <?php if(!empty($title)): ?>
                <div class="title-video-container"> 
                    <div class="title-video d-block">
                        <div class="body">                                        
                            <span class="title-video-section-module"><?php echo $title ?></span>
                            <p><?php echo $description ?></p>
                        </div>
                        <?php if(!empty($cta_link)): ?>
                            <div class="footer">
                                <a href="<?php echo $cta_link ?>"><?php echo $cta ?></a>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
            <?php endif ?>
        </div>

        <script>
            $("document").ready(function(){

                <?php if ( $video_type == 'Connatix' ) : ?>

                    var width = $('#connatix-video-vc').width();
                    var height = ( width / 16 ) * 9;

                    $('#connatix-video-vc').css({
                        'height' : height + 'px',
                        'min-height' : height + 'px'
                    });

                    $("#play-<?php echo $rand; ?>").click(function(){
                        
                        $('#' + '<?php echo $script_id; ?>' ).html( 
                            cnx.cmd.push(function() { 
                                cnx({ 
                                    playerId: '<?php echo $player_id; ?>'
                                }).render( '<?php echo $script_id; ?>' ); 
                            }) 
                        );

                        $(this).closest(".js-video-module").addClass("video-module--state-play");
                        $(this).parent().fadeOut("slow");
                        $("#js-share-call-to-action-<?php echo $rand; ?>").removeClass("d-none");
                        $("#js-skip-intro-<?php echo $rand; ?>").removeClass("d-none");

                        $('#transcript').click(function(){
                            $('#tanscription').slideToggle('fast');
                            $('#transcript span').toggleClass('inactive');
                        });

                        $('#connatix-video-vc').css({'height': 'auto'}); //important don't delete

                        var width = $('#connatix-video-vc').width();
                        $('#js-share-call-to-action-<?php echo $rand; ?>').css({'width':width+'px'});
                        $('#js-skip-intro-<?php echo $rand; ?>').css({'width':width+'px'});

                        var item = $('#connatix-video-vc').attr('data-id');
                        $('#' + item).css({'opacity':'1'});
                    });

                    // open network-share 
                    $('#js-share-call-to-action-header').click( function() {
                        $('#js-share-call-to-action-header').addClass('d-none');
                        $('#js-social-media-header').removeClass('d-none');
                        var width = $('#connatix-video-vc').width();
                        var height = $('.video-wrapper').height();
                        $('#js-social-media-header').css({'width':width+'px', 'height':height+'px'});
                    });

                    // close network-share
                    $('#js-close-share-header').click( function() {
                        $('#js-social-media-header').addClass('d-none');
                        $('#js-share-call-to-action-header').removeClass('d-none');
                    });

                    // Open network-share 
                    $('#js-share-call-to-action-<?php echo $rand; ?>').click( function() {
                        $('#js-share-call-to-action-<?php echo $rand; ?>').addClass('d-none');
                        $('#js-social-media-<?php echo $rand; ?>').removeClass('d-none');
                        var width = $('#connatix-video-vc').width();
                        var height = $('#connatix-video-vc').height();
                        $('#js-social-media-<?php echo $rand; ?>').css({'width':width+'px', 'height':height+'px'});
                    });

                    // Close network-share
                    $('#js-close-share-<?php echo $rand; ?>').click( function() {
                        $('#js-social-media-<?php echo $rand; ?>').addClass('d-none');
                        $('#js-share-call-to-action-<?php echo $rand; ?>').removeClass('d-none');
                    });

                <?php else : ?>

                    var i = 0,
                        skip = 5,
                        iframe_section = $("#iframe-<?php echo $rand; ?>")[0],
                        player = new Vimeo.Player(iframe_section),
                        playlist = <?php echo json_encode( getPlaylistVideoPostType() ); ?>;

                    // Play button
                    $("#play-<?php echo $rand; ?>").click(function(){
                        $(this).closest(".js-video-module").addClass("video-module--state-play");
                        $(this).parent().fadeOut("slow");
                        $(this).parent().siblings(".video-wrapper-section").children( "iframe" ).click();
                        $("#js-share-call-to-action-<?php echo $rand; ?>").removeClass("d-none");
                        $("#js-skip-intro-<?php echo $rand; ?>").removeClass("d-none");
                        player.play();

                        $('#transcript').click(function(){
                            $('#tanscription').slideToggle('fast');
                            $('#transcript span').toggleClass('inactive');
                        });

                        var width = $('#iframe-<?php echo $rand; ?>').width();
                        $('#js-share-call-to-action-<?php echo $rand; ?>').css({'width':width+'px'});
                        $('#js-skip-intro-<?php echo $rand; ?>').css({'width':width+'px'});

                        var item = $('#iframe-<?php echo $rand; ?>').attr('data-id');
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
                    $('#js-share-call-to-action-<?php echo $rand; ?>').click( function() {
                        $('#js-share-call-to-action-<?php echo $rand; ?>').addClass('d-none');
                        $('#js-social-media-<?php echo $rand; ?>').removeClass('d-none');
                        var width = $("#iframe-<?php echo $rand; ?>").width();
                        var height = $("#iframe-<?php echo $rand; ?>").height();
                        $('#js-social-media-<?php echo $rand; ?>').css({'width':width+'px', 'height':height+'px'});
                        player.pause();
                    });

                    // Close network-share
                    $('#js-close-share-<?php echo $rand; ?>').click( function() {
                        $('#js-social-media-<?php echo $rand; ?>').addClass('d-none');
                        $('#js-share-call-to-action-<?php echo $rand; ?>').removeClass('d-none');
                        player.play();
                    });

                    // Skip intro
                    $('#js-skip-intro-<?php echo $rand; ?>').click( function () {
                        //set time in 5 seg to skip intro
                        player.setCurrentTime( skip ).then( function (seconds) {
                            $('#js-skip-intro-<?php echo $rand; ?>').hide('slow');
                        });
                    });

                    // StartNow
                    $('#vs-next-viddeo-<?php echo $rand; ?>').click( function () {
                        if( playlist[i] ){
                            player.loadVideo(playlist[i]['url']).then(function(id) {
                                $('#js-skip-intro-playlist').show('slow');
                                hideNextVideo();
                                player.play();
                            });
                            i++;
                        }
                    });

                    $('#js-social-media-<?php echo $rand; ?>').click(function(e) {
                        if(e.target !== this) {
                            return;
                        }
                        $('#js-social-media-<?php echo $rand; ?>').addClass('d-none');
                        $('#js-share-call-to-action-header').removeClass('d-none');
                        player.play();
                    });

                    player.on('play', function() {
                        hideNextVideo();
                        $('#js-social-media-<?php echo $rand; ?>').addClass('d-none');
                        $('#js-share-call-to-action-<?php echo $rand; ?>').removeClass('d-none');
                        player.getCurrentTime().then(function(seconds) {
                            if( seconds < 5 ) {
                                $('#js-skip-intro-<?php echo $rand; ?>').fadeIn();
                            }
                        });
                    });

                    player.on('pause', function() {
                        $('#js-share-call-to-action-<?php echo $rand; ?>').addClass('d-none');
                        $('#js-social-media-<?php echo $rand; ?>').removeClass('d-none');
                        var width = $("#iframe-<?php echo $rand; ?>").width();
                        var height = $("#iframe-<?php echo $rand; ?>").height();
                        $('#js-social-media-<?php echo $rand; ?>').css({'width':width+'px', 'height':height+'px'});
                    });

                    player.on('progress', function( data ) {
                        player.getCurrentTime().then(function(seconds) {
                            if( seconds > 5 ) {
                                $('#js-skip-intro-<?php echo $rand; ?>').hide('slow');
                            }
                            if( data.percent === 1 ) {
                                showNextVideo();
                            }
                        });
                    });

                    player.on('ended', function() {
                        if( playlist[i] ){
                            player.loadVideo(playlist[i]['url']).then(function(id) {
                                $('#js-skip-intro-playlist').show('slow');
                                hideNextVideo();
                                player.play();
                            }).catch(function(error) {
                                //skip error
                            });
                            i++;
                        }
                    });
                    
                    function showNextVideo() {
                        $('#vs-next-viddeo-' + <?php echo $rand; ?> + ' h2' ).html( playlist[i]['title'] );
                        $('#vs-next-viddeo-' + <?php echo $rand; ?> ).css({
                            'background-image' : 'url(' + playlist[i]['image'] + ')'
                        });
                        $('#vs-next-viddeo-' + <?php echo $rand; ?> ).fadeIn();
                    }

                    function hideNextVideo() {
                        $('#vs-next-viddeo-' + <?php echo $rand; ?> ).fadeOut();
                    }

                <?php endif; ?>

            });
        </script>
        <!-- End Video Section Module VC -->    
    <?php 
        return ob_get_clean();
    }
     
} // End Element Class

 
// Element Class Init
new vcVideoSection();

?>
