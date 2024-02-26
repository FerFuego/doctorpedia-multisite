<?php
/* Element Description: VC HeaderSection*/
 
// Element Class 
class vcHeaderSection extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_headerSection_mapping' ) );
        add_shortcode( 'vc_headerSection', array( $this, 'vc_headerSection_html' ) );
    }
     
    // Element Mapping
    public function vc_headerSection_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }
            
        // Map the block with vc_map()
        vc_map( 
            array(
                'name' => __('Header Section', 'text-domain'),
                'base' => 'vc_headerSection',
                'description' => __('Header Section Module', 'text-domain'), 
                'category' => __('DoctorPedia Elements', 'text-domain'),   
                'icon' => get_template_directory_uri().'/img/vc-doctorpedia-logo.PNG',            
                'params' => array(   
                    array(
                        'type' => 'attach_image',
                        'holder' => 'img',
                        'class' => 'title-class',
                        'heading' => __( 'Background', 'text-domain' ),
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
                        'holder' => 'h1',
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
                        'holder' => 'div',
                        'class' => 'text-class',
                        'heading' => __( 'Text', 'text-domain' ),
                        'param_name' => 'text',
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
                    ),
                    array(
                        'type' => 'textfield',
                        'class' => 'title-class',
                        'heading' => __( 'Title Post', 'text-domain' ),
                        'param_name' => 'title_post_1',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Complementary',
                    ),
                    array(
                        'type' => 'vc_link',
                        'class' => 'title-class',
                        'heading' => __( 'Link Post', 'text-domain' ),
                        'param_name' => 'link_btn_1',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Complementary',
                    ),
                    array(
                        'type' => 'textfield',
                        'class' => 'title-class',
                        'heading' => __( 'Title Post', 'text-domain' ),
                        'param_name' => 'title_post_2',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Complementary',
                    ),
                    array(
                        'type' => 'vc_link',
                        'class' => 'title-class',
                        'heading' => __( 'Link Post', 'text-domain' ),
                        'param_name' => 'link_btn_2',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Complementary',
                    ),
                    array(
                        'type' => 'textfield',
                        'class' => 'title-class',
                        'heading' => __( 'Title Post', 'text-domain' ),
                        'param_name' => 'title_post_3',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Complementary',
                    ),
                    array(
                        'type' => 'vc_link',
                        'class' => 'title-class',
                        'heading' => __( 'Link Post', 'text-domain' ),
                        'param_name' => 'link_btn_3',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Complementary',
                    ),
                    array(
                        'type' => 'textfield',
                        'class' => 'title-class',
                        'heading' => __( 'Title Post', 'text-domain' ),
                        'param_name' => 'title_post_4',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Complementary',
                    ),
                    array(
                        'type' => 'vc_link',
                        'class' => 'title-class',
                        'heading' => __( 'Link Post', 'text-domain' ),
                        'param_name' => 'link_btn_4',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Complementary',
                    ),

                )
            )
        );                           
        
    } 
     
     
    // Element HTML
    public function vc_headerSection_html( $atts ) {

        $attributes = vc_map_get_attributes($this->getShortCode(), $atts);
         // Params extraction
        extract(
            shortcode_atts(
                array(
                    'background'   => '',
                    'title'   => '',
                    'text' => '',
                    'cta' => 'View All Videos',
                    'cta_link' => '',
                    'video_type' => '',
                    'link_video' => '',
                    'player_id' => '',
                    'script_id' => '',
                    'title_post_1' => '',
                    'link_btn_1' => '',
                    'title_post_2' => '',
                    'link_btn_2' => '',
                    'title_post_3' => '',
                    'link_btn_3' => '',
                    'title_post_4' => '',
                    'link_btn_4' => ''
                ), 
                $atts
            )
        );

        $bg = wp_get_attachment_image_src($background, 'full');
        $rand = rand(999, 9999);
                
        return $this->BlockHTMl($bg, $rand, $title, $text, $video_type, $cta, $cta_link, $link_video, $script_id, $player_id, $title_post_1, $link_btn_1, $title_post_2, $link_btn_2, $title_post_3, $link_btn_3, $title_post_4, $link_btn_4);
         
    }


    public function BlockHTML($bg, $rand, $title, $text, $video_type, $cta, $cta_link, $link_video, $script_id, $player_id, $title_post_1, $link_btn_1, $title_post_2, $link_btn_2, $title_post_3, $link_btn_3, $title_post_4, $link_btn_4){ 
        ob_start(); ?>
        <!-- Header Play Module VC-->
        <div class="home-slider video-container <?php echo ( $video_type == 'Connatix' ) ? 'header-connatix-container' : null; ?>" >
            <div class="container-video <?php echo ( $video_type == 'Connatix' ) ? 'header-connatix-container__subcontainer' : null; ?>" >
                <div class="bg-video video-module <?php echo (have_rows('call_to_action', 'option')) ? 'video-hero-multisite video-module--state-play' : null; ?>" id="bg-video">

                    <div class="video-wrapper video-wrapper-home video-wrapper-section multisite-hero 
                        
                        <?php echo ( $video_type != 'Connatix' && have_rows('call_to_action', 'option')) ? 'video-wrapper-limit-width' : null; ?>
                        
                        <?php echo ( $video_type == 'Connatix' ) ? 'header-connatix-container__video-wrapper' : null; ?> ">

                        <?php if ( $video_type == 'Connatix' ) : ?>
                        
                            <!-- Connatix -->
                            <div id="connatix">

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

                            <iframe class="video" id="iframe_header_section" src=<?php echo "$link_video"; ?> frameborder="0" allow="autoplay"></iframe>

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

                            <div id="hs-next-viddeo-<?php echo $rand; ?>" class="hs-next-video">
                                <div class="overlay">
                                    <h2>Title</h2>
                                    <p>Next Video >></p>
                                </div>
                            </div>
                            
                        <?php endif; ?>
                            
                    </div>

                    <div class="network-share-call-to-action d-none" id="js-share-call-to-action-header"  >
                        <img class="icon-open icon-share-header-video"  src="<?php print IMAGES; ?>/icons/share-video.svg" alt="">
                    </div>

                    <?php if ( $video_type != 'Connatix' ) : ?>

                        <div class="network-skip-intro d-none <?php echo (wp_is_mobile() ? 'header-skip-buttom' : ''); ?>" id="js-skip-intro-header">
                            <button class="skip-intro skip-intro-header" id="js-skip-intro--header">Skip Intro</button>
                        </div>

                    <?php endif; ?>

                    <div class="network-share" id="js-network-share-playlist"  >
                        <div class="network-share__social-media d-none" id="js-social-media-header" >
                            <img class="icon-close icon-close-header-video" id="js-close-share-header" src="<?php print IMAGES; ?>/icons/close-share.svg" alt="">
                            <div class="network-share__social-media__content">
                                <h3 class="text-white">Share This Video</h3>
                                <hr>
                                <?php echo do_shortcode('[easy-social-share]'); ?>
                            </div>
                        </div>
                    </div>


                    <div class="information-box-container">
                        <div class="information-box d-none d-md-block">
                            <div class="body">
                                <h1><?php echo $title ?></h1>
                                <p><?php echo $text ?></p>
                            </div>
                            <?php if(!empty($cta_link)): ?>
                                <div class="footer">
                                    <a href="<?php echo $cta_link ?>"><?php echo $cta ?></a>
                                </div>
                            <?php endif ?>
                        </div>
                        <div class="bg-container" style="background-image:url(<?php echo $bg[0] ?>); background-size: cover; background-repeat: no-repeat;"></div>
                        <button class="play-video-btn">
                            <img src="<?php echo IMAGES ?>/icons/play-button.svg" alt="Play Button">
                        </button>
                    </div>
                </div>
                <div class="information-box d-block d-md-none">
                    <div class="body">
                        <h1><?php echo $title ?></h1>
                        <p><?php echo $text ?></p>
                    </div>
                    <div class="footer">
                        <a href="<?php echo esc_url( home_url( '/' ) ) ?>video-hub"><?php echo $cta ?></a>
                    </div>
                </div>
            </div>

            <?php if ($link_btn_1 && $link_btn_2 && $link_btn_3 && $link_btn_4) : ?>

                <div class="home-slider-footer">
                    <div class="container">
                        <div class="box-container">
                            <div>
                                <h2><?php echo $title_post_1 ?></h2>
                                <div class="link-home-slider">
                                    <?php $a = explode('|', $link_btn_1); ?>
                                    <a href="<?php echo urldecode(str_replace('url:','', $a[0])) ?>" target="<?php echo urldecode(str_replace('target:','', $a[2])) ?>"><?php echo urldecode(str_replace('title:','', $a[1])) ?></a>
                                </div>
                            </div>
                            <div>
                                <h2><?php echo $title_post_2 ?></h2>
                                <div class="link-home-slider">
                                    <?php $a = explode('|', $link_btn_2); ?>
                                    <a href="<?php echo urldecode(str_replace('url:','', $a[0])) ?>" target="<?php echo urldecode(str_replace('target:','', $a[2])) ?>"><?php echo urldecode(str_replace('title:','', $a[1])) ?></a>
                                </div>
                            </div>
                            <div>
                                <h2><?php echo $title_post_3 ?></h2>
                                <div class="link-home-slider">
                                    <?php $a = explode('|', $link_btn_3); ?>
                                    <a href="<?php echo urldecode(str_replace('url:','', $a[0])) ?>" target="<?php echo urldecode(str_replace('target:','', $a[2])) ?>"><?php echo urldecode(str_replace('title:','', $a[1])) ?></a>
                                </div>
                            </div>
                            <div>
                                <h2><?php echo $title_post_4 ?></h2>
                                <div class="link-home-slider">
                                    <?php $a = explode('|', $link_btn_4); ?>
                                    <a href="<?php echo urldecode(str_replace('url:','', $a[0])) ?>" target="<?php echo urldecode(str_replace('target:','', $a[2])) ?>"><?php echo urldecode(str_replace('title:','', $a[1])) ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endif;?>
        </div>

        <script>
            $("document").ready(function() {
            
                <?php if ( $video_type == 'Connatix' ) : ?>

                    var width = $('#connatix').width();
                    var height = ( width / 16 ) * 9;
                    
                    $('#connatix').css({
                        'height' : height + 'px',
                        'min-height' : height + 'px'
                    });

                    $(".information-box-container .play-video-btn").click( function(){

                        $('#' + '<?php echo $script_id; ?>' ).html( 
                            cnx.cmd.push(function() { 
                                cnx({ 
                                    playerId: '<?php echo $player_id; ?>',
                                }).render( '<?php echo $script_id; ?>' ); 
                            }) 
                        );

                        $(this).parent().fadeOut("slow");
                        $("#sub-menu, .home-slider-footer").fadeOut("slow");
                        $( this ).parent().siblings( ".video-wrapper-home" ).children( "iframe" ).click();
                        
                        $('#connatix').css({'height': 'auto'}); //important don't delete
    
                        $('#js-share-call-to-action-header').removeClass('d-none');
                        $('#js-skip-intro-header').removeClass('d-none');

                        $('#js-network-share-playlist').css({'width':'100px', 'height':'100%;'});
    
                        var width = $('#connatix').width();
                        $('#js-share-call-to-action-header').css({'width':width + 'px'});
                        $('#js-skip-intro-header').css({'width':'85%'});

                    });

                    // open network-share 
                    $('#js-share-call-to-action-header').click( function() {
                        $('#js-share-call-to-action-header').addClass('d-none');
                        $('#js-social-media-header').removeClass('d-none');
                        var width = $('#connatix').width();
                        var height = $('.video-wrapper').height();
                        $('#js-social-media-header').css({'width':width+'px', 'height':height+'px'});
                    });

                    // close network-share
                    $('#js-close-share-header').click( function() {
                        $('#js-social-media-header').addClass('d-none');
                        $('#js-share-call-to-action-header').removeClass('d-none');
                    });

                <?php else : ?>

                    var iframe_home = $(".video-wrapper-home iframe")[0],
                        player = new Vimeo.Player(iframe_home),
                        i = 0,
                        skip = 5,
                        video = $('#bg-video'),
                        videoTopPos = video.offset().top,
                        videoHeight = video.height(),
                        videoBottomPos = videoTopPos + videoHeight,
                        playlist = <?php echo json_encode( getPlaylistVideoPostType() ); ?>;

                    $(".information-box-container .play-video-btn").click(function(){
                        $(this).parent().fadeOut("slow");
                        $("#sub-menu, .home-slider-footer").fadeOut("slow");
                        $( this ).parent().siblings( ".video-wrapper-home" ).children( "iframe" ).click();
                        player.play();
    
                        $(window).scroll(function() {
                            if( $( window ).scrollTop() > videoBottomPos - 75 ) {
                                $(".information-box-container .play-video-btn").parent().fadeIn("slow");
                                $("#sub-menu, .home-slider-footer").fadeIn("slow");
                                $('#js-share-call-to-action-header').addClass('d-none');
                                $('#js-skip-intro-header').addClass('d-none');
                                $('#js-social-media-header').addClass('d-none');
                                player.pause();
                                $( this ).parent().siblings( ".video-wrapper-home" ).children( "iframe" ).click();
                            }
                        });
    
                        $('#js-share-call-to-action-header').removeClass('d-none');
                        $('#js-skip-intro-header').removeClass('d-none');
                        
                        setTimeout(function() { player.play(); }, 1000);
    
                        var width = $('#iframe_header_section').width();
                        $('#js-share-call-to-action-header').css({'width':width+'px'});
                        $('#js-skip-intro-header').css({'width':width+'px'});
    
                    });

                    //Btn pause
                    $(".bg-video .close-video-btn").click(function() {
                        $(".information-box-container .play-video-btn").parent().fadeIn("slow");
                        $("#sub-menu, .home-slider-footer").fadeIn("slow");
                        $( this ).parent().siblings( ".video-wrapper-home" ).children( "iframe" ).click();
                        player.pause();
                    }) 

                    //Btn pause
                    $('.video-module .close-video-btn').click(function(){
                        $('.video-module .play-video-btn').parent().fadeIn('slow');
                        $('#video-trascript').hide('slow');
                        $( this ).parent().siblings( '.video-wrapper-section' ).children( 'iframe' ).click();
                        player.pause();
                    });

                    // open network-share 
                    $('#js-share-call-to-action-header').click( function() {
                        $('#js-share-call-to-action-header').addClass('d-none');
                        $('#js-social-media-header').removeClass('d-none');
                        var width = $('#iframe_header_section').width();
                        var height = $('#iframe_header_section').height();
                        $('#js-social-media-header').css({'width':width+'px', 'height':height+'px'});
                        player.pause();
                    });

                    // close network-share
                    $('#js-close-share-header').click( function() {
                        $('#js-social-media-header').addClass('d-none');
                        $('#js-share-call-to-action-header').removeClass('d-none');
                        player.play();
                    });

                    //Skip intro
                    $('#js-skip-intro-header').click( function () {
                        //set time in 5 seg to skip intro
                        player.setCurrentTime( skip ).then( function (seconds) {
                            $('#js-skip-intro-header').hide('slow');
                        });
                    });

                    // StartNow
                    $('#hs-next-viddeo-<?php echo $rand; ?>').click( function () {
                        if( playlist[i] ){
                            player.loadVideo(playlist[i]['url']).then(function(id) {
                                $('#js-skip-intro-playlist').show('slow');
                                hideNextVideo();
                                player.play();
                            });
                            i++;
                        }
                    });

                    // Play
                    $('#js-social-media-header').click(function(e) {
                        if(e.target !== this) {
                            return;
                        }
                        $('#js-social-media-header').addClass('d-none');
                        $('#js-share-call-to-action-header').removeClass('d-none');
                        player.play();
                    });

                    player.on('play', function() {
                        hideNextVideo();
                        $('#js-social-media-header').addClass('d-none');
                        $('#js-share-call-to-action-header').removeClass('d-none');
                        player.getCurrentTime().then(function(seconds) {
                            if( seconds < 5 ) {
                                $('#js-skip-intro-header').fadeIn();
                            }
                        });
                    });

                    player.on('pause', function() {
                        $('#js-share-call-to-action-header').addClass('d-none');
                        $('#js-social-media-header').removeClass('d-none');
                        var width = $('#iframe_header_section').width();
                        var height = $('#iframe_header_section').height();
                        $('#js-social-media-header').css({'width':width+'px', 'height':height+'px'});
                    });

                    player.on('progress', function( data ) {
                        console.log( data );
                        player.getCurrentTime().then(function(seconds) {
                            if( seconds > 5 ) {
                                $('#js-skip-intro-header').hide('slow');
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
                        $('#hs-next-viddeo-' + <?php echo $rand; ?> + ' h2' ).html( playlist[i]['title'] );
                        $('#hs-next-viddeo-' + <?php echo $rand; ?> ).css({
                            'background-image' : 'url(' + playlist[i]['image'] + ')'
                        });
                        $('#hs-next-viddeo-' + <?php echo $rand; ?> ).fadeIn();
                    }

                    function hideNextVideo() {
                        $('#hs-next-viddeo-' + <?php echo $rand; ?> ).fadeOut();
                    }
                    
                <?php endif; ?>

            });

        </script>  
        <!-- End Header Play Module VC-->  
    <?php 
        return ob_get_clean();
    }
} // End Element Class
 
// Element Class Init
new vcHeaderSection();

?>
