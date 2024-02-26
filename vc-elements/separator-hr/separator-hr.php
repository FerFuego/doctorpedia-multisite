<?php
/* Element Description: VC SeparatorHR*/
 
// Element Class 
class vcSeparatorHR extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_separatorHR_mapping' ) );
        add_shortcode( 'vc_separatorHR', array( $this, 'vc_separatorHR_html' ) );
    }
     
    // Element Mapping
    public function vc_separatorHR_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }    
            
        // Map the block with vc_map()
        vc_map( 

            array(
                'name' => __('Separator HR', 'text-domain'),
                'base' => 'vc_separatorHR',
                'description' => __('Separator HR Module', 'text-domain'), 
                'category' => __('DoctorPedia Elements', 'text-domain'),   
                'icon' => get_template_directory_uri().'/img/vc-doctorpedia-logo.PNG',     
            )
        );                           
        
    } 
     
     
    // Element HTML
    public function vc_separatorHR_html( $atts ) {
        
        return $this->BlockHTML();
         
    } 

    public function BlockHTML(){ 
        ob_start(); ?>
        <!-- Simple Line Separator Module -->
        <div class="container">
            <hr class="separator">
        </div>
        <!-- End Simple Line Separator Module -->
    <?php 
        return ob_get_clean();
    }
     
} // End Element Class
 
// Element Class Init
new vcSeparatorHR();

?>