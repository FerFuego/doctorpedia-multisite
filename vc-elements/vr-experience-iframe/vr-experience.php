<?php
/* Element Description: VC vrExperience*/
 
// Element Class 
class vcvrExperience extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_vrExperience_mapping' ) );
        add_shortcode( 'vc_vrExperience', array( $this, 'vc_vrExperience_html' ) );
    }
     
    // Element Mapping
    public function vc_vrExperience_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }    
            
        // Map the block with vc_map()
        vc_map( 

            array(
                'name' => __('VR Experience', 'text-domain'),
                'base' => 'vc_vrExperience',
                'description' => __('Iframe VR Experience Module', 'text-domain'), 
                'category' => __('DoctorPedia Elements', 'text-domain'),   
                'icon' => get_template_directory_uri().'/img/vc-doctorpedia-logo.PNG',
                'params' => array(
                    array(
                        'type' => 'textarea',
                        'holder' => 'div',
                        'class' => 'title-class',
                        'heading' => __( 'URL link VR Experience', 'text-domain' ),
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
    public function vc_vrExperience_html( $atts ) {

         // Params extraction
         extract(
            shortcode_atts(
                array(
                    'text'   => '',
                ), 
                $atts
            )
        );
                
        return $this->BlockHTML($text);
    } 

    public function BlockHTML($text){ 
        ob_start(); ?>
        <!-- Simple vrExperience Module VC -->
        <div class="container-fluid">
            <div class="row">
                <div class="vr-experience-block">
                    <iframe src="<?php echo $text ?>" allow="autoplay; microphone; camera" frameborder="false"></iframe>
                </div>
            </div>
        </div>
        <!-- End Simple vrExperience Module VC -->
    <?php 
        return ob_get_clean();
    }
     
} // End Element Class
 
// Element Class Init
new vcvrExperience();

?>