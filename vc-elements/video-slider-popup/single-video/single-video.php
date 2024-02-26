<?php
/* Element Description: VC Slider Sites Item*/
 
// Element Class 
class vcSingleVideoPopup extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_singleVideoPopup_mapping' ) );
        add_shortcode( 'vc_singleVideoPopup', array( $this, 'vc_singleVideoPopup_html' ) );
    }
     
    // Element Mapping
    public function vc_singleVideoPopup_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }    
            
        // Map the block with vc_map()
        vc_map( 
            array(
                'name' => __('Single Video Popup', 'text-domain'),
                'base' => 'vc_singleVideoPopup',
                'description' => __('Single Video Popup Module', 'text-domain'),
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
                )
            )
        );
    }
     
    // Element HTML
    public function vc_singleVideoPopup_html( $atts ) {
        
        $attributes = vc_map_get_attributes($this->getShortCode(), $atts);

        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'image_1' => '',
                    'title_video_1' => '',
                    'link_video_1' => '',
                ), 
                $atts
            )
        );

        $image_1 = wp_get_attachment_image_src($image_1, 'medium');

        return $this->BlockHTML( $image_1, $title_video_1, $link_video_1 );

    }

    public function BlockHTML( $image_1, $title_video_1, $link_video_1 ) { 
        
        ob_start(); ?>

        <div class="slider-single-item slider-item-click" onclick="openModalNew('<?php echo $link_video_1; ?>')">

            <div class="trim" style="background-image:url(<?php echo $image_1[0]; ?>);">

                <button class="play-video-btn" onclick="openModalNew('<?php echo $link_video_1; ?>')">

                    <img class="icon-play"  src="<?php echo IMAGES ?>/icons/play-button.svg" alt=""> 

                </button>

            </div>

            <div class="slider-single-item-content">

                <h2 class="slider-single-title"><?php echo $title_video_1; ?></h2>

            </div>

        </div>

    <?php 
        return ob_get_clean();
    }
     
} // End Element Class
 
// Element Class Init
new vcSingleVideoPopup();

?>