<?php
/* Element Description: VC AdsSection*/
 
// Element Class 
class vcAdsSection extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {

        add_action( 'init', array( $this, 'vc_adsSection_mapping' ) );

        add_shortcode( 'vc_adsSection', array( $this, 'vc_adsSection_html' ) );

    }
     
    // Element Mapping
    public function vc_adsSection_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {

                return;

        }
            
        // Map the block with vc_map()
        vc_map( 

            array(
                'name' => __('Ads', 'text-domain'),
                'base' => 'vc_adsSection',
                'description' => __('Ads Module', 'text-domain'), 
                'category' => __('DoctorPedia Elements', 'text-domain'),   
                'icon' => get_template_directory_uri().'/img/vc-doctorpedia-logo.PNG',            
            )
        );                           
        
    } 
     
     
    // Element HTML
    public function vc_adsSection_html( $atts ) {
        
        return $this->BlockHTML();
         
    } 

    public function BlockHTML() { 

        ob_start(); ?>

        <!-- Ads Section Module VC -->

        <div class="container ads-container">

            <div class="adv adv-top" id="adUnit_1"></div>

        </div>

        <!-- End Ads Section Module VC -->

    <?php 

        return ob_get_clean();

    }
     
} // End Element Class
 
// Element Class Init
new vcAdsSection();

?>