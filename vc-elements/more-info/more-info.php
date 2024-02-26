<?php
/* Element Description: VC MoreInfo*/
 
// Element Class 
class vcMoreInfo extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_moreInfo_mapping' ) );
        add_shortcode( 'vc_moreInfo', array( $this, 'vc_moreInfo_html' ) );
    }
     
    // Element Mapping
    public function vc_moreInfo_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }    
            
        // Map the block with vc_map()
        vc_map( 

            array(
                'name' => __('More Info', 'text-domain'),
                'base' => 'vc_moreInfo',
                'description' => __('More Info Module', 'text-domain'), 
                'category' => __('DoctorPedia Elements', 'text-domain'),   
                'icon' => get_template_directory_uri().'/img/vc-doctorpedia-logo.PNG',
                'params' => array(
                    array(
                        'type' => 'attach_image',
                        'holder' => 'img',
                        'class' => 'title-class',
                        'heading' => __( 'Icono', 'text-domain' ),
                        'param_name' => 'icon',
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
                        'type' => 'textarea',
                        'holder' => 'div',
                        'class' => 'title-class',
                        'heading' => __( 'Textarea', 'text-domain' ),
                        'param_name' => 'text',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'group' => 'General',
                    ),
                )
            )
        );
    }
     
     
    // Element HTML
    public function vc_moreInfo_html( $atts ) {

        $attributes = vc_map_get_attributes($this->getShortCode(), $atts);

        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'icon' => '',
                    'text'   => '',
                ), 
                $atts
            )
        );

        $image = wp_get_attachment_image_src($icon, 'medium');          
        
        return $this->BlockHTML($image, $text);
    } 

    public function BlockHTML($image, $text){ 
        ob_start(); ?>
        <!-- Simple MoreInfo Module VC -->
        <div class="row more-info">
            <div class="container">
                <div class=" text-center">
                    <div><img src="<?php echo $image[0] ?>"></div> 
                    <div class="text-block"><?php echo $text ?></div>
                </div>
            </div>
        </div>
        <!-- End Simple MoreInfo Module VC -->
    <?php 
        return ob_get_clean();
    }
     
} // End Element Class
 
// Element Class Init
new vcMoreInfo();

?>