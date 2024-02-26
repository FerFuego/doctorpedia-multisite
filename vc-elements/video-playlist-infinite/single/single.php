<?php
/* Element Description: VC Slider Video Playlist Item*/
 
// Element Class 
class vcSingleVideoinfinite extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_singleVideoinfinite_mapping' ) );
        add_shortcode( 'vc_singleVideoinfinite', array( $this, 'vc_singleVideoinfinite_html' ) );
    }
     
    // Element Mapping
    public function vc_singleVideoinfinite_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }    
            
        // Map the block with vc_map()
        vc_map( 
            array(
                'name' => __('Single Video infinite', 'text-domain'),
                'base' => 'vc_singleVideoinfinite',
                'description' => __('Single Video infinite Module', 'text-domain'),
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
                        'group' => 'Video List',
                    ),
                    array(
                        'type' => 'textfield',
                        'holder' => 'h1',
                        'class' => 'title-class',
                        'heading' => __( 'Title Video', 'text-domain' ),
                        'param_name' => 'title',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Video List',
                    ),
                    array(
                        'type' => 'textfield',
                        'holder' => 'h2',
                        'class' => 'title-class',
                        'heading' => __( 'Title Section', 'text-domain' ),
                        'param_name' => 'subtitle',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Video List',
                    ),
                    array(
                        "type" => "textfield",
                        "class" => "",
                        "heading" => __( "Link Video", "my-text-domain" ),
                        "param_name" => "link_video",
                        "value" => '', 
                        "description" => __( "Copy & Paste the link of the Youtube or Vimeo video", "my-text-domain" ),
                        'group' => 'Video List',
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
                        'group' => 'Video List',
                    ),
                )
            )
        );
    }
     
    // Element HTML
    public function vc_singleVideoinfinite_html( $atts ) {
        
        $attributes = vc_map_get_attributes($this->getShortCode(), $atts);

        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'background' => '',
                    'title' => '',
                    'subtitle' => '',
                    'link_video' => '',
                    'description' => ''
                ), 
                $atts
            )
        ); 

        $rand_item = rand();

        $background = wp_get_attachment_image_src($background, 'medium');

        return $this->BlockHTML( $background, $title, $subtitle, $link_video, $description, $rand_item );

    }

    public function BlockHTML( $background, $title, $subtitle, $link_video, $description, $rand_item ) { 
        
        ob_start(); ?>
        
            <div class="slider-single-item slider-playlist-infinite" id="video_slider_<?php echo $rand_item; ?>" videourl="<?php echo $link_video; ?>">

                <div class="trim" style="background-image: url(<?php echo $background[0]; ?>)">

                    <button class="play-video-btn">

                        <img src="<?php echo IMAGES; ?>/icons/play-button.svg" alt="Play Button">

                    </button>

                </div>

                <div class="slider-single-item-content">

                    <h2><?php echo $subtitle; ?></h2>

                    <h1><?php echo $title; ?></h1>

                    <p class="hidden"><?php echo $description; ?></p>

                </div>

            </div>

    <?php 
        return ob_get_clean();
    }
     
} // End Element Class
 
// Element Class Init
new vcSingleVideoinfinite();

?>