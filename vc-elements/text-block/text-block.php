<?php
/* Element Description: VC TextBlock*/
 
// Element Class 
class vcTextBlock extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_textBlock_mapping' ) );
        add_shortcode( 'vc_textBlock', array( $this, 'vc_textBlock_html' ) );
    }
     
    // Element Mapping
    public function vc_textBlock_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }    
            
        // Map the block with vc_map()
        vc_map( 

            array(
                'name' => __('Text Block', 'text-domain'),
                'base' => 'vc_textBlock',
                'description' => __('Text Block Module', 'text-domain'), 
                'category' => __('DoctorPedia Elements', 'text-domain'),   
                'icon' => get_template_directory_uri().'/img/vc-doctorpedia-logo.PNG',
                'params' => array(
                    array(
                        'type' => 'textarea',
                        'holder' => 'div',
                        'class' => 'title-class',
                        'heading' => __( 'Text', 'text-domain' ),
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
    public function vc_textBlock_html( $atts ) {

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
        <!-- Simple TextBlock Module VC -->
        <div class="container">
            <div class="row">
                <div class="text-block">
                    <p><?php echo $text ?></p>
                </div>
            </div>
        </div>
        <!-- End Simple TextBlock Module VC -->
    <?php 
        return ob_get_clean();
    }
     
} // End Element Class
 
// Element Class Init
new vcTextBlock();

?>