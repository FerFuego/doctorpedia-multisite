<?php
/* Element Description: VC VideoShare*/
 
// Element Class 
class vcVideoShare extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_videoShare_mapping' ) );
        add_shortcode( 'vc_videoShare', array( $this, 'vc_videoShare_html' ) );
    }
     
    // Element Mapping
    public function vc_videoShare_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }
            
        // Map the block with vc_map()
        vc_map( 

            array(
                'name' => __('Video Share', 'text-domain'),
                'base' => 'vc_videoShare',
                'description' => __('Video Share Module', 'text-domain'), 
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
    public function vc_videoShare_html( $atts ) {

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
                    'description' => ''
                ), 
                $atts
            )
        );

        $image = wp_get_attachment_image_src($background, 'full');
        
        $rand = rand(999, 9999);
        return $this->BlockHTML($image, $rand, $title, $link_video, $cta, $cta_link, $description);
    } 

    public function BlockHTML($image, $rand, $title, $link_video, $cta, $cta_link, $description){ 
        ob_start(); ?>
        <!-- Video Share Module VC -->
        <div class="video-container">
            <div class="video-module js-video-module">
                <div class="video-wrapper video-wrapper-section <?php echo (have_rows('call_to_action', 'option')) ? 'video-wrapper-limit-width' : ''; ?>">
                    <iframe class="video" src=<?php echo "$link_video"; ?> frameborder="0" allow="autoplay" id="iframe-<?php echo $rand; ?>"></iframe>
                   
                    <button class="close-video-btn" id="pause-<?php echo $rand; ?>">
                        <img class="icon-close"  src="<?php echo IMAGES ?>/icons/pause-button.svg" alt=""> 
                    </button>

                    <div class="network-share-call-to-action d-none" id="js-share-call-to-action-<?php echo $rand; ?>">
                        <img class="icon-open"  src="<?php print IMAGES; ?>/icons/share-video.svg" alt="">
                    </div>

                    <div class="network-share" id="js-network-share-<?php echo $rand; ?>">
                        <div class="network-share__social-media d-none" id="js-social-media">
                            <img class="icon-close" id="js-close-share" src="<?php print IMAGES; ?>/icons/close-share.svg" alt="">
                            <div class="network-share__social-media__content">
                                <h3 class="text-white">Share This Video</h3>
                                <hr>
                                <?php echo do_shortcode('[easy-social-share]'); ?>
                            </div>
                        </div>
                    </div>

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
                <div class="video-placeholder video-placeholder-section <?php echo (have_rows('call_to_action', 'option')) ? 'video-placeholder-limit' : ''; ?>" style="background-image:url(<?php echo $image[0] ?>)">
                    <?php if($link_video): ?>
                        <button class="play-video-btn" id="play-<?php echo $rand ?>">
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
            </div>
            <?php if(!empty($title)): ?>
                <div class="title-video-container"> 
                    <div class="title-video d-block d-md-none">
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
            <div class="social-media-share">
                <h2>Share:</h2> 
                <?php echo do_shortcode('[easy-social-share]'); ?>
            </div>
        </div>
        <script>
            $("document").ready(function(){
                var iframe_section = $("#iframe-<?php echo $rand; ?>")[0];
                var player_section = new Vimeo.Player(iframe_section);
            
                $("#play-<?php echo $rand ?>").click(function(){
                    $(this).closest(".js-video-module").addClass("video-module--state-play");
                    $(this).parent().fadeOut("slow");
                    $(this).parent().siblings(".video-wrapper-section").children( "iframe" ).click();
                    $('#js-share-call-to-action-<?php echo $rand; ?>').removeClass('d-none');
                    player_section.play();
                    var width = $("#iframe-<?php echo $rand ?>").width();
                    $('#js-share-call-to-action-<?php echo $rand; ?>').css({'width':width+'px'});
                })  
            
                $("#pause-<?php echo $rand ?>").click(function(){
                    $(".video-placeholder-section .play-video-btn").parent().fadeIn("slow");
                    $( this ).parent().siblings( ".video-wrapper-section" ).children( "iframe" ).click();
                    player_section.pause();
                })

                /* New Actions */
                var iframe = $("#iframe-<?php echo $rand; ?>")[0];
                var player = new Vimeo.Player(iframe);

                $('#js-social-media').click(function(e) {
                    if(e.target !== this) {
                        return;
                    }
                    $('#js-social-media').addClass('d-none');
                    $('#js-share-call-to-action-<?php echo $rand; ?>').removeClass('d-none');
                    player_section.play();
                });

                player.on('pause', function() {
                    $('#js-share-call-to-action-<?php echo $rand; ?>').addClass('d-none');
                    $('#js-social-media').removeClass('d-none');
                    var width = $('#iframe-<?php echo $rand; ?>').width();
                    var height = $('#iframe-<?php echo $rand; ?>').height();
                    $('#js-social-media').css({'width':width+'px', 'height':height+'px'});
                });

                // open network-share 
                $('#js-share-call-to-action-<?php echo $rand; ?>').click( function() {
                    $('#js-share-call-to-action-<?php echo $rand; ?>').addClass('d-none');
                    $('#js-social-media').removeClass('d-none');
                    var width = $('#iframe-<?php echo $rand; ?>').width();
                    var height = $('#iframe-<?php echo $rand; ?>').height();
                    $('#js-social-media').css({'width':width+'px', 'height':height+'px'});
                    player_section.pause();
                });

                // close network-share
                $('#js-close-share').click( function() {
                    $('#js-social-media').addClass('d-none');
                    $('#js-share-call-to-action-<?php echo $rand; ?>').removeClass('d-none');
                    player_section.play();
                });
                
                $('.video-module .close-video-btn').click(function(){
                    $('.video-module .play-video-btn').parent().fadeIn('slow');
                    $('#video-trascript').hide('slow');
                    $( this ).parent().siblings( '.video-wrapper-section' ).children( 'iframe' ).click();
                    player_section.pause();
                });
                
                /* End Actions */
            });
        </script>
        <!-- End Video Share Module VC -->    
    <?php 
        return ob_get_clean();
    }
     
} // End Element Class

 
// Element Class Init
new vcVideoShare();

?>
