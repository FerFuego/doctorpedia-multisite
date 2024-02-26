<?php
/* Element Description: VC iframe_module*/
 
// Element Class 
class vciframe_module extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_iframe_module_mapping' ) );
        add_shortcode( 'vc_iframe_module', array( $this, 'vc_iframe_module_html' ) );
    }
     
    // Element Mapping
    public function vc_iframe_module_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }    
            
        // Map the block with vc_map()
        vc_map( 

            array(
                'name' => __('Iframe Module', 'text-domain'),
                'base' => 'vc_iframe_module',
                'description' => __('Iframe Module', 'text-domain'), 
                'category' => __('DoctorPedia Elements', 'text-domain'),   
                'icon' => get_template_directory_uri().'/img/vc-doctorpedia-logo.PNG',
                'params' => array(
                    array(
                        'type' => 'textfield',
                        'holder' => 'div',
                        'class' => 'title-class',
                        'heading' => __( 'Title', 'text-domain' ),
                        'param_name' => 'title',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'group' => 'General',
                    ),
                    array(
                        'type' => 'textarea',
                        'holder' => 'div',
                        'class' => 'title-class',
                        'heading' => __( 'URL link', 'text-domain' ),
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
    public function vc_iframe_module_html( $atts ) {

         // Params extraction
         extract(
            shortcode_atts(
                array(
                    'title'  => '',
                    'text'   => '',
                ), 
                $atts
            )
        );
                
        return $this->BlockHTML($title, $text);
    } 

    public function BlockHTML($title, $text){ 
        ob_start(); ?>

        <!-- Simple iframe_module Module VC -->
        <div class="container-fluid iframe-module-container">

            <div class="container">

                <div class="header-iframe">

                    <h2><?php echo $title; ?></h2>

                </div>

                <div class="iframe-block">

                    <?php echo str_replace( '`', '',$text ); ?>

                </div>

            </div>

        </div>
        <!-- End Simple iframe_module Module VC -->

    <?php 
        return ob_get_clean();
    }
     
} // End Element Class
 
// Element Class Init
new vciframe_module();

?>